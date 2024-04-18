<?php
/**
 * @package   The_Grid
 * @author    Themeone <themeone.master@gmail.com>
 * @copyright 2015 Themeone
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
	exit;
}

class The_Grid_Admin {

	const VIEW_GRID_HEADER   = "grid-header";
	const VIEW_GRID_BANNER1  = "grid-banner1";
	const VIEW_GRID_BANNER2  = "grid-banner2";
	const VIEW_GRID_BANNER3  = "grid-banner3";
	const VIEW_GRID_BANNER4  = "grid-banner4";
	const VIEW_GRID_BANNER5  = "grid-banner5";
	const VIEW_GRID_BANNER6  = "grid-banner6";
	const VIEW_GRID_INFOBOX  = "grid-infobox";
	const VIEW_GRID_PREVIEW  = "grid-preview";
	const VIEW_GRID_LIST     = "grid-list";
	const VIEW_GRID_SETTINGS = "grid-settings";
	const VIEW_GRID_INFO     = "grid-info";
	const VIEW_GRID_CONFIG   = "grid-config";
	const VIEW_GRID_IMPORT   = "grid-import";
	const VIEW_GRID_EXPORT   = "grid-export";
	const VIEW_GRID_FOOTER   = "grid-footer";
	const VIEW_GRID_FORMAT   = "grid-format";

	const VIEW_SKIN_BUILDER  = "skin-builder";
	const VIEW_SKIN_OVERVIEW = "skins-overview";

	// Instance of this class.
	protected $plugin_slug = TG_SLUG;
	protected $current_post;
	protected static $view;

	/**
	* Initialization
	* @since 1.0.0
	*/
	public function __construct() {

		$this->includes();
		$this->init_hooks();

	}

	/**
	* Includes core files for Backend/Frontend.
	* @since 1.0.0
	* @modified 1.3.0
	*/
	public function includes() {

		// load metabox class for grid settings
		require_once(TG_PLUGIN_PATH . '/includes/metabox/tomb.php');
		// load class admin ajax function
		require_once(TG_PLUGIN_PATH . '/backend/admin-ajax.php');
		// load class for admin grid preview
		require_once(TG_PLUGIN_PATH . '/backend/admin-grid-preview.php');
		// load class for grid skins preview
		require_once(TG_PLUGIN_PATH . '/backend/admin-skins-preview.php');
		// load class for skin generator
		require_once(TG_PLUGIN_PATH . '/backend/admin-skin-generator.php');

	}

	/**
	* Hook into actions and filters
	* @since 1.0.0
	* @modified 1.3.0
	*/
	public function init_hooks() {

		// Remove admin notices
		add_action('admin_notices', array(&$this, 'remove_notices_start'));
		add_action('admin_notices', array(&$this, 'remove_notices_end'), 999);
		// Dismiss notices
		add_action( 'wp_ajax_tg_dismiss_admin_notice', array(&$this, 'dismiss_admin_notice'));
		// Hide the_grid_ custom fields
		add_filter('is_protected_meta',  array($this, 'hide_the_grid_custom_fields'), 10, 3);
		// add custom css for admin
		add_action('admin_head', array(&$this, 'the_grid_admin_css'));
		// add custom js for admin
		add_action('admin_head', array(&$this, 'the_grid_admin_js'));
		// Build admin menu/pages
		add_action('admin_menu', array($this, 'add_plugin_admin_menu'));
		// Add The Grid metaboxes on post types
		add_action('admin_init', array($this, 'add_grid_metabox'));
		// Load admin style sheet and JavaScript.
		add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
		// Delete grid transients when post created/updated/deleted
		add_action('save_post', array($this, 'delete_transient_on_save'), 10, 3);

	}

	/**
	* Remove notices start
	* @since 1.3.0
	*/
	public function remove_notices_start() {

		// get current admin screen
		$screen = get_current_screen();
		// if screen is a part of The Grid plugin page
		if (strpos($screen->id, $this->plugin_slug) !== false) {
			// Turn on output buffering
			ob_start();
		}

	}

	/**
	* Remove notices end
	* @since 1.3.0
	*/
	public function remove_notices_end() {

		// get current admin screen
		$screen = get_current_screen();
		// if screen is a part of The Grid plugin page
		if (strpos($screen->id, $this->plugin_slug) !== false) {
			// Get current buffer contents and delete current output buffer
			$content = ob_get_contents();
			ob_clean();
		}

		global $tg_admin_notices;

		$dismiss_notices = get_option('tg_admin_notices');

		if (!isset($dismiss_notices['tg-wpgridbuilder-notice']) || !$dismiss_notices['tg-wpgridbuilder-notice']) {

			$tg_admin_notices = '<div class="notice tg-admin-notice is-dismissible" data-notice-id="tg-wpgridbuilder-notice">';
				$tg_admin_notices .= '<a href="https://wpgridbuilder.com/" target="_blank" rel="noreferrer noopener">';
					$tg_admin_notices .= '<div>';
					$tg_admin_notices .= '<img src="' . TG_PLUGIN_URL . 'backend/assets/images/wp-grid-builder.svg" width="180" height="42" alt="">';
					$tg_admin_notices .= '</div>';
					$tg_admin_notices .= '<p>'. __( "Need an <strong>advanced grid and filtering plugin</strong> for WordPress?", "tg-text-domain" ) .'</p>';
				$tg_admin_notices .= '</a>';
			$tg_admin_notices .= '</div>';

			echo  $tg_admin_notices;

		}

	}

	/**
	* Dismiss admin notices
	* @since 1.3.0
	*/
	public function dismiss_admin_notice() {

		if (isset($_POST['id']) && !empty($_POST['id'])) {
			$notices = (array) get_option('tg_admin_notices');
			$notices[$_POST['id']] = true;
			update_option('tg_admin_notices', $notices);
		}

		wp_die();

	}

	/**
	* Hide the grid custom post type custom meta data fields
	* @since 1.4.0
	*/
	public function hide_the_grid_custom_fields( $protected, $meta_key, $meta_type ) {

		if (strpos($meta_key, 'the_grid_') !== false) {
			return true;
		}

		return $protected;

	}

	/**
	* Delete grid transient on save_post action
	* @since 2.0.5
	* @modified 2.2.0
	*/
	public function delete_transient_on_save($post_id, $post, $update) {

		// Autosave, do nothing
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        	return;
		}

		//get all grids which have the current post type
		$posts = get_posts(array(
			'post_type'      => 'the_grid',
			'post_status'    => 'any',
			'posts_per_page' => -1,
			'fields'         => 'ids',
			'meta_key'       => 'the_grid_post_type',
			'meta_query'   => array(
				'relation' => 'AND',
				array(
					'key'     => 'the_grid_post_type',
					'value'   => $post->post_type,
					'compare' => 'LIKE'
				),
				array(
					'key'     => 'the_grid_source_type',
					'value'   => 'post_type',
					'compare' => 'LIKE'
				)
			)
		));

		if ($posts) {

			// transient SQL
			global $wpdb;
			$sql = "SELECT `option_name` AS `name`, `option_value` AS `value`
					FROM  $wpdb->options
					WHERE `option_name` LIKE '%_transient_timeout_%'
					ORDER BY `option_name`";

			$transients = $wpdb->get_results($sql);

			if ($transients) {

				// loop through each transient option
				foreach ($transients as $transient) {

					// if transient option name matched then delete it (only if can expire)
					if (strpos($transient->name, 'tg_grid') !== false) {

						foreach($posts as $post) {

							if (strpos($transient->name, (string) $post) !== false) {
								$name = str_replace('_transient_timeout_','',$transient->name);
								delete_transient($name);
								break;
							}

						}

					}

				}

			}

		}

	}

	/**
	* Register admin menu in Dashboard menu.
	* @since 1.0.0
	* @modified 1.3.0
	*/
	public function add_plugin_admin_menu() {

		// add The Grid menu page
		add_menu_page(
			'The Grid',
			'The Grid',
			'manage_options',
			$this->plugin_slug,
			array($this, 'display_plugin_admin_overview_page'),
			$this->the_grid_icon()
		);

		// remove edit and add new button
		remove_submenu_page( 'edit.php?post_type='.$this->plugin_slug, 'post-new.php?post_type='.$this->plugin_slug );

		// add grid settings submenu page
		add_submenu_page(
			null,
			'Grid Settings',
			__('Grid Settings', 'tg-text-domain'),
			'manage_options',
			$this->plugin_slug.'_settings',
			array($this, 'display_plugin_admin_grid_settings_page')
		);

		// add skins overview submenu page
		add_submenu_page(
			$this->plugin_slug,
			'Skin Builder',
			__('Skin Builder', 'tg-text-domain'),
			'manage_options',
			$this->plugin_slug.'_skins_overview',
			array($this, 'display_plugin_admin_skin_overview_page')
		);

		// add skin builder page
		add_submenu_page(
			null,
			'Skin Builder',
			__('Skin Builder', 'tg-text-domain'),
			'manage_options',
			$this->plugin_slug.'_skin_builder',
			array($this, 'display_plugin_admin_skin_builder_page')
		);

		// add import/export submenu page
		add_submenu_page(
			$this->plugin_slug,
			'Import/Export',
			__('Import/Export', 'tg-text-domain'),
			'manage_options',
			$this->plugin_slug.'_import_export',
			array($this, 'display_plugin_admin_export_import_page')
		);

		// add global settings submenu page
		add_submenu_page(
			$this->plugin_slug,
			'Global Settings',
			__('Global Settings', 'tg-text-domain'),
			'manage_options',
			$this->plugin_slug.'_global_settings',
			array($this, 'display_plugin_admin_settings_page')
		);

	}

	/**
	* Include admin page for layout
	* @since 1.0.0
	*/
	public function display_plugin_admin_overview_page() {

		require_once('views/'.self::VIEW_GRID_HEADER.'.php');
		require_once('views/'.self::VIEW_GRID_BANNER1.'.php');
		require_once('views/'.self::VIEW_GRID_INFO.'.php');
		require_once('views/'.self::VIEW_GRID_LIST.'.php');
		require_once('views/'.self::VIEW_GRID_FOOTER.'.php');

	}

	/**
	* Include admin page import/export for layout
	* @since 1.0.0
	*/
	public function display_plugin_admin_export_import_page() {

		require_once('views/'.self::VIEW_GRID_HEADER.'.php');
		require_once('views/'.self::VIEW_GRID_BANNER2.'.php');
		require_once('views/'.self::VIEW_GRID_EXPORT.'.php');
		require_once('views/'.self::VIEW_GRID_IMPORT.'.php');
		require_once('views/'.self::VIEW_GRID_FOOTER.'.php');

	}

	/**
	* Include admin page global settings for layout
	* @since 1.0.0
	*/
	public function display_plugin_admin_settings_page() {

		require_once('views/'.self::VIEW_GRID_HEADER.'.php');
		require_once('views/'.self::VIEW_GRID_BANNER3.'.php');
		require_once('views/'.self::VIEW_GRID_SETTINGS.'.php');
		require_once('views/'.self::VIEW_GRID_FOOTER.'.php');

	}

	/**
	* Include grid settings page
	* @since 1.3.0
	*/
	public function display_plugin_admin_grid_settings_page(){

		require_once('views/'.self::VIEW_GRID_HEADER.'.php');
		require_once('views/'.self::VIEW_GRID_BANNER4.'.php');
		require_once('views/'.self::VIEW_GRID_CONFIG.'.php');
		require_once('views/'.self::VIEW_GRID_PREVIEW.'.php');
		require_once('views/'.self::VIEW_GRID_FOOTER.'.php');

	}

	/**
	* Include grid skins overview page
	* @since 1.3.0
	*/
	public function display_plugin_admin_skin_overview_page(){

		require_once('views/'.self::VIEW_GRID_HEADER.'.php');
		require_once('views/'.self::VIEW_GRID_BANNER6.'.php');
		require_once('views/'.self::VIEW_SKIN_OVERVIEW.'.php');
		require_once('views/'.self::VIEW_GRID_FOOTER.'.php');

	}

	/**
	* Include grid skin builder page
	* @since 1.3.0
	*/
	public function display_plugin_admin_skin_builder_page(){

		require_once('views/'.self::VIEW_GRID_HEADER.'.php');
		require_once('views/'.self::VIEW_GRID_BANNER5.'.php');
		require_once('views/'.self::VIEW_SKIN_BUILDER.'.php');
		require_once('views/'.self::VIEW_GRID_FOOTER.'.php');

	}

	/**
	* Add grid metabox on post types
	* @since 1.0.0
	*/
	public function add_grid_metabox() {

		require_once(TG_PLUGIN_PATH . '/backend/views/'.self::VIEW_GRID_FORMAT.'.php');

	}

	/**
	* Add css icon admin menu
	* @since 1.0.0
	*/
	public function the_grid_admin_css()  {

		echo '<style type="text/css">.wp-has-submenu.toplevel_page_the_grid img{position:relative;top:-2px}.tg-admin-notice,.tg-wrap .tg-admin-notice{z-index:1;margin:0 1px;border-left:4px solid #0069ff}.tg-admin-notice{padding:12px;color:inherit}.tg-admin-notice a{display:flex;align-items:center;outline:0;box-shadow:none;transition:.3s ease}.tg-admin-notice a:hover{opacity:.8;transform:translate(8px)}.tg-admin-notice p{color:#34495e;font-size:16px;line-height:28px}.tg-admin-notice p strong{color:#0069ff;font-weight:700}.tg-admin-notice *{text-decoration:none}.tg-admin-notice img{margin:0 24px 0 16px}.tg-admin-notice .tg-coupon{color:#fff;background:#0069ff;padding:2px 8px;border-radius:4px;font-size:15px;font-weight:700}@media screen and (max-width:479px){.tg-admin-notice{padding:12px!important}.tg-admin-notice a{flex-direction:column}}</style>';


	}

	/**
	* Add css icon admin menu
	* @since 1.0.0
	*/
	public function the_grid_admin_js()  {

		echo '<script type="text/javascript">
		jQuery(document).ready(function($) {
			$(document).on("click", ".tg-admin-notice .notice-dismiss", function ( event ) {
				event.preventDefault();
				var $this   = $(this);
				var $notice = $this.closest(".tg-admin-notice");
				if(!$notice.length && $notice.data("notice-id")){
					return;
				}
				$.post(ajaxurl, {
					action: "tg_dismiss_admin_notice",
					url: ajaxurl,
					id: $notice.data("notice-id")
				});
			});
		});
		</script>';

	}

	/**
	* Add menu icon
	* @since 1.5.0
	*/
	public function the_grid_icon() {

		$icon = sprintf(
			'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 95 95">
				<path fill="currentColor" d="M82.536 35.62c-9.087-9.087-24.06-8.824-33.473.587l-.006-.005-17.034 17.032.007.004c9.09 9.09 24.059 8.83 33.477-.586L46.335 71.824 27.608 53.102l19.174-19.171-7.958-7.96 7.96 7.96.439-.443c8.985-9.424 9.334-23.844.678-32.504l-17.032 17.03-.004-.004-19.171 19.173c-8.229 8.231-7.77 21.997 1.03 30.806l-.004.004 18.725 18.723c9.088 9.09 23.111 9.787 31.342 1.561l19.168-19.172c9.415-9.414 9.674-24.393.581-33.485z"/>
			</svg>'
		);

		// phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions.obfuscation_base64_encode
		return 'data:image/svg+xml;base64,' . base64_encode( $icon );

	}

	/**
	* Enqueue admin scripts
	* @since 1.0.0
	* @modified 1.3.0
	*/
	public function enqueue_admin_scripts() {

		// get current admin screen
		$screen = get_current_screen();

		if (strpos($screen->id, $this->plugin_slug) !== false) {

			// Wordpress Color Picker & Media Upload scripts
      		wp_enqueue_script('wp-color-picker');
			wp_enqueue_style('wp-color-picker');
			wp_enqueue_media();

			// enqueue skin builder script/styles
			if (strpos($screen->id, 'the_grid_skin_builder') !== false) {

				// Wordpress Resizable script
				wp_enqueue_script('jquery-ui-resizable');

				wp_enqueue_style($this->plugin_slug .'-admin-page-styles', TG_PLUGIN_URL . 'backend/assets/css/admin-page.css', array(), TG_VERSION);
				wp_enqueue_style($this->plugin_slug .'-admin-builder', TG_PLUGIN_URL . 'backend/assets/css/admin-builder.css', array(), TG_VERSION);
				wp_enqueue_script($this->plugin_slug . '-admin-builder-js', TG_PLUGIN_URL . 'backend/assets/js/admin-builder.js', array('jquery'), TG_VERSION, true);

			}

			// enqueue css stylesheets
			wp_enqueue_style($this->plugin_slug .'-admin-post-styles', TG_PLUGIN_URL . 'backend/assets/css/admin-post.css', array(), TG_VERSION);
			wp_enqueue_style($this->plugin_slug .'-admin-page-styles', TG_PLUGIN_URL . 'backend/assets/css/admin-page.css', array(), TG_VERSION);

			// enqueue js scripts
			wp_enqueue_script($this->plugin_slug . '-admin-post-js', TG_PLUGIN_URL . 'backend/assets/js/admin-post.js', array('jquery'), TG_VERSION);
			wp_localize_script($this->plugin_slug . '-admin-post-js', 'tg_admin_global_var', array('url' => admin_url( 'admin-ajax.php' ),'nonce' => wp_create_nonce( 'tg_admin_nonce' )));

		}


	}

}

new The_Grid_Admin;
