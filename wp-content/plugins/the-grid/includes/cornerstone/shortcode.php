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

global $wp_query;

if ( ( isset($_SERVER['QUERY_STRING']) && strpos($_SERVER['QUERY_STRING'], 'action=cs_render_element') !== false ) || ( isset( $wp_query->query_vars[ 'cornerstone-endpoint' ] ) && defined( 'DOING_AJAX' ) ) ) {
	echo '<div class="tg-error-msg">The Grid - Preview not available in Cornerstone</div>';
} else {
	echo The_Grid( $name );
}
