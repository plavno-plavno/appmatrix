<?php

/**
 * Copied from Walker_Nav_Menu_Edit class in core
 *
 * Create HTML list of nav menu input items.
 *
 * @package WordPress
 * @since 3.0.0
 * @uses Walker_Nav_Menu
 */
class CustomField extends Walker_Nav_Menu
{

    /**
     * @see Walker_Nav_Menu::start_lvl()
     * @since 3.0.0
     *
     * @param string $output Passed by reference.
     */
    function start_lvl(&$output, $depth = 0, $args = array())
    {

    }

    /**
     * @see Walker_Nav_Menu::end_lvl()
     * @since 3.0.0
     *
     * @param string $output Passed by reference.
     */
    function end_lvl(&$output, $depth = 0, $args = array())
    {

    }

    /**
     * @see Walker::start_el()
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item Menu item data object.
     * @param int $depth Depth of menu item. Used for padding.
     * @param object $args
     */
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        global $_wp_nav_menu_max_depth;
        $_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        ob_start();
        $item_id = esc_attr($item->ID);
        $removed_args = array(
            'action',
            'customlink-tab',
            'edit-menu-item',
            'menu-item',
            'page-tab',
            '_wpnonce',
        );

        $original_title = '';
        if ('taxonomy' == $item->type) {
            $original_title = get_term_field('name', $item->object_id, $item->object, 'raw');
            if (is_wp_error($original_title))
                $original_title = false;
        } elseif ('post_type' == $item->type) {
            $original_object = get_post($item->object_id);
            $original_title = $original_object->post_title;
        }

        $classes = array(
            'menu-item menu-item-depth-' . $depth,
            'menu-item-' . esc_attr($item->object),
            'menu-item-edit-' . ((isset($_GET['edit-menu-item']) && $item_id == $_GET['edit-menu-item']) ? 'active' : 'inactive'),
        );

        $title = $item->title;

        if (!empty($item->_invalid)) {
            $classes[] = 'menu-item-invalid';
            /* translators: %s: title of menu item which is invalid */
            $title = sprintf(esc_html__('%s (Invalid)', 'themo'), $item->title);
        } elseif (isset($item->post_status) && 'draft' == $item->post_status) {
            $classes[] = 'pending';
            /* translators: %s: title of menu item in draft status */
            $title = sprintf(esc_html__('%s (Pending)', 'themo'), $item->title);
        }

        $title = empty($item->label) ? $title : $item->label;
        ?>
    <li id="menu-item-<?php echo esc_attr($item_id); ?>" class="<?php echo esc_attr(implode(' ', $classes)); ?>">
        <dl class="menu-item-bar">
            <dt class="menu-item-handle">
                <span class="item-title"><?php echo esc_html($title); ?></span>
                <span class="item-controls">
                    <span class="item-type"><?php echo esc_html($item->type_label); ?></span>
                    <span class="item-order hide-if-js">
                        <a href="<?php
                        echo esc_url(wp_nonce_url(
                            add_query_arg(
                                array(
                                    'action' => 'move-up-menu-item',
                                    'menu-item' => $item_id,
                        ), remove_query_arg($removed_args,  esc_url( admin_url('nav-menus.php')))
                            ), 'move-menu_item'
                        ));
                        ?>" class="item-move-up"><abbr
                                title="<?php esc_attr_e('Move up', 'themo'); ?>">&#8593;</abbr></a>
                        |
                        <a href="<?php
                        echo esc_url(wp_nonce_url(
                            add_query_arg(
                                array(
                                    'action' => 'move-down-menu-item',
                                    'menu-item' => $item_id,
                        ), remove_query_arg($removed_args, esc_url(admin_url('nav-menus.php')))
                            ), 'move-menu_item'
                        ));
                        ?>" class="item-move-down"><abbr
                                                         title="<?php esc_attr_e('Move down', 'themo'); ?>">&#8595;</abbr></a>
                    </span>
                    <a class="item-edit" id="edit-<?php echo esc_attr($item_id); ?>"
                       title="<?php esc_attr_e('Edit Menu Item', 'themo'); ?>" href="<?php
        echo esc_url( (isset($_GET['edit-menu-item']) && $item_id == $_GET['edit-menu-item']) ? esc_url(admin_url('nav-menus.php')) : add_query_arg('edit-menu-item', $item_id, remove_query_arg($removed_args, esc_url(admin_url('nav-menus.php#menu-item-settings-' . $item_id)))));
                    ?>"><?php esc_html_e('Edit Menu Item', 'themo'); ?></a>
                </span>
            </dt>
        </dl>

        <div class="menu-item-settings" id="menu-item-settings-<?php echo esc_attr($item_id); ?>">
            <?php if ('custom' == $item->type) : ?>
                <p class="field-url description description-wide">
                    <label for="edit-menu-item-url-<?php echo esc_attr($item_id); ?>">
                        <?php esc_html_e('URL', 'themo'); ?><br/>
                        <input type="text" id="edit-menu-item-url-<?php echo esc_attr($item_id); ?>"
                               class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo esc_attr($item_id); ?>]"
                               value="<?php echo esc_attr($item->url); ?>"/>
                    </label>
                </p>
            <?php endif; ?>
            <p class="description description-thin">
                <label for="edit-menu-item-title-<?php echo esc_attr($item_id); ?>">
                    <?php esc_html_e('Navigation Label', 'themo'); ?><br/>
                    <input type="text" id="edit-menu-item-title-<?php echo esc_attr($item_id); ?>"
                           class="widefat edit-menu-item-title" name="menu-item-title[<?php echo esc_attr($item_id); ?>]"
                           value="<?php echo esc_attr($item->title); ?>"/>
                </label>
            </p>
            <p class="description description-thin">
                <label for="edit-menu-item-attr-title-<?php echo esc_attr($item_id); ?>">
                    <?php esc_html_e('Title Attribute', 'themo'); ?><br/>
                    <input type="text" id="edit-menu-item-attr-title-<?php echo esc_attr($item_id); ?>"
                           class="widefat edit-menu-item-attr-title"
                           name="menu-item-attr-title[<?php echo esc_attr($item_id); ?>]"
                           value="<?php echo esc_attr($item->post_excerpt); ?>"/>
                </label>
            </p>
            <p class="field-link-target description">
                <label for="edit-menu-item-target-<?php echo esc_attr($item_id); ?>">
                    <input type="checkbox" id="edit-menu-item-target-<?php echo esc_attr($item_id); ?>" value="_blank"
                           name="menu-item-target[<?php echo esc_attr($item_id); ?>]"<?php checked($item->target, '_blank'); ?> />
                    <?php esc_html_e('Open link in a new window/tab', 'themo'); ?>
                </label>
            </p>
            <p class="field-css-classes description description-thin">
                <label for="edit-menu-item-classes-<?php echo esc_attr($item_id); ?>">
                    <?php esc_html_e('CSS Classes (optional)', 'themo'); ?><br/>
                    <input type="text" id="edit-menu-item-classes-<?php echo esc_attr($item_id); ?>"
                           class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo esc_attr($item_id); ?>]"
                           value="<?php echo esc_attr(implode(' ', $item->classes)); ?>"/>
                </label>
            </p>
            <p class="field-xfn description description-thin">
                <label for="edit-menu-item-xfn-<?php echo esc_attr($item_id); ?>">
                    <?php esc_html_e('Link Relationship (XFN)', 'themo'); ?><br/>
                    <input type="text" id="edit-menu-item-xfn-<?php echo esc_attr($item_id); ?>"
                           class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo esc_attr($item_id); ?>]"
                           value="<?php echo esc_attr($item->xfn); ?>"/>
                </label>
            </p>
            <p class="field-description description description-wide">
                <label for="edit-menu-item-description-<?php echo esc_attr($item_id); ?>">
                    <?php esc_html_e('Description', 'themo'); ?><br/>
                    <textarea id="edit-menu-item-description-<?php echo esc_attr($item_id); ?>"
                              class="widefat edit-menu-item-description" rows="3" cols="20"
                              name="menu-item-description[<?php echo esc_attr($item_id); ?>]"><?php echo esc_html($item->description); // textarea_escaped  ?></textarea>
                    <span
                        class="description"><?php esc_html_e('The description will be displayed in the menu if the current theme supports it.', 'themo'); ?></span>
                </label>
            </p>
            <?php
            /*
             * This is the added field
             */
            ?>
            <p class="description description-thin">
                <label for="edit-menu-item-anchor-<?php echo esc_attr($item_id); ?>">
                    <?php esc_html_e('Anchor', 'themo'); ?><br/>
                    <input type="text" id="edit-menu-item-anchor-<?php echo esc_attr($item_id); ?>"
                           class="widefat edit-menu-item-anchor" name="menu-item-anchor[<?php echo esc_attr($item_id); ?>]"
                           value="<?php echo esc_attr($item->anchor); ?>"/>
                </label>
            </p>
            <p class="description description-thin">
                <label for="edit-menu-item-link-<?php echo esc_attr($item_id); ?>">
                    <?php esc_html_e("Don't link", 'themo'); ?><br/>
                    <input type="checkbox" id="edit-menu-item-link-<?php echo esc_attr($item_id); ?>"
                           class="widefat edit-menu-item-link" name="menu-item-link[<?php echo esc_attr($item_id); ?>]"
                           value="true" <?php echo($item->link == "true" ? "checked" : "") ?> />
                </label>
            </p>
            <p class="mega-menu-checkbox description description-thin">
                <label for="edit-menu-item-mega-menu-<?php echo esc_attr($item_id); ?>">
                    <?php esc_html_e("Mega menu", 'themo'); ?><br/>
                    <input type="checkbox" id="edit-menu-item-mega-menu-<?php echo esc_attr($item_id); ?>"
                           class="widefat edit-menu-item-mega-menu" name="menu-item-mega-menu[<?php echo esc_attr($item_id); ?>]"
                           value="true" <?php echo($item->mega_menu == "true" ? "checked" : "") ?> />
                </label>
            </p>
            <p class="description description-thin">
                <label for="edit-menu-item-icon-<?php echo esc_attr($item_id); ?>">
                    <?php esc_html_e("Icon", 'themo'); ?><br/>
                    <?php
                    $icon = array(
                        "nothing" => esc_html__("Nothing", 'themo'),//&#x > &#x
                        'fa-adjust' => '&#xf042',
                        'fa-adn' => '&#xf170',
                        'fa-align-center' => '&#xf037',
                        'fa-align-justify' => '&#xf039',
                        'fa-align-left' => '&#xf036',
                        'fa-align-right' => '&#xf038',
                        'fa-ambulance' => '&#xf0f9',
                        'fa-anchor' => '&#xf13d',
                        'fa-android' => '&#xf17b',
                        'fa-angellist' => '&#xf209',
                        'fa-angle-double-down' => '&#xf103',
                        'fa-angle-double-left' => '&#xf100',
                        'fa-angle-double-right' => '&#xf101',
                        'fa-angle-double-up' => '&#xf102',
                        'fa-angle-down' => '&#xf107',
                        'fa-angle-left' => '&#xf104',
                        'fa-angle-right' => '&#xf105',
                        'fa-angle-up' => '&#xf106',
                        'fa-apple' => '&#xf179',
                        'fa-archive' => '&#xf187',
                        'fa-area-chart' => '&#xf1fe',
                        'fa-arrow-circle-down' => '&#xf0ab',
                        'fa-arrow-circle-left' => '&#xf0a8',
                        'fa-arrow-circle-o-down' => '&#xf01a',
                        'fa-arrow-circle-o-left' => '&#xf190',
                        'fa-arrow-circle-o-right' => '&#xf18e',
                        'fa-arrow-circle-o-up' => '&#xf01b',
                        'fa-arrow-circle-right' => '&#xf0a9',
                        'fa-arrow-circle-up' => '&#xf0aa',
                        'fa-arrow-down' => '&#xf063',
                        'fa-arrow-left' => '&#xf060',
                        'fa-arrow-right' => '&#xf061',
                        'fa-arrow-up' => '&#xf062',
                        'fa-arrows' => '&#xf047',
                        'fa-arrows-alt' => '&#xf0b2',
                        'fa-arrows-h' => '&#xf07e',
                        'fa-arrows-v' => '&#xf07d',
                        'fa-asterisk' => '&#xf069',
                        'fa-at' => '&#xf1fa',
                        'fa-backward' => '&#xf04a',
                        'fa-ban' => '&#xf05e',
                        'fa-bar-chart' => '&#xf080',
                        'fa-barcode' => '&#xf02a',
                        'fa-bars' => '&#xf0c9',
                        'fa-beer' => '&#xf0fc',
                        'fa-behance' => '&#xf1b4',
                        'fa-behance-square' => '&#xf1b5',
                        'fa-bell' => '&#xf0f3',
                        'fa-bell-o' => '&#xf0a2',
                        'fa-bell-slash' => '&#xf1f6',
                        'fa-bell-slash-o' => '&#xf1f7',
                        'fa-bicycle' => '&#xf206',
                        'fa-binoculars' => '&#xf1e5',
                        'fa-birthday-cake' => '&#xf1fd',
                        'fa-bitbucket' => '&#xf171',
                        'fa-bitbucket-square' => '&#xf172',
                        'fa-bold' => '&#xf032',
                        'fa-bolt' => '&#xf0e7',
                        'fa-bomb' => '&#xf1e2',
                        'fa-book' => '&#xf02d',
                        'fa-bookmark' => '&#xf02e',
                        'fa-bookmark-o' => '&#xf097',
                        'fa-briefcase' => '&#xf0b1',
                        'fa-btc' => '&#xf15a',
                        'fa-bug' => '&#xf188',
                        'fa-building' => '&#xf1ad',
                        'fa-building-o' => '&#xf0f7',
                        'fa-bullhorn' => '&#xf0a1',
                        'fa-bullseye' => '&#xf140',
                        'fa-bus' => '&#xf207',
                        'fa-calculator' => '&#xf1ec',
                        'fa-calendar' => '&#xf073',
                        'fa-calendar-o' => '&#xf133',
                        'fa-camera' => '&#xf030',
                        'fa-camera-retro' => '&#xf083',
                        'fa-car' => '&#xf1b9',
                        'fa-caret-down' => '&#xf0d7',
                        'fa-caret-left' => '&#xf0d9',
                        'fa-caret-right' => '&#xf0da',
                        'fa-caret-square-o-down' => '&#xf150',
                        'fa-caret-square-o-left' => '&#xf191',
                        'fa-caret-square-o-right' => '&#xf152',
                        'fa-caret-square-o-up' => '&#xf151',
                        'fa-caret-up' => '&#xf0d8',
                        'fa-cc' => '&#xf20a',
                        'fa-cc-amex' => '&#xf1f3',
                        'fa-cc-discover' => '&#xf1f2',
                        'fa-cc-mastercard' => '&#xf1f1',
                        'fa-cc-paypal' => '&#xf1f4',
                        'fa-cc-stripe' => '&#xf1f5',
                        'fa-cc-visa' => '&#xf1f0',
                        'fa-certificate' => '&#xf0a3',
                        'fa-chain-broken' => '&#xf127',
                        'fa-check' => '&#xf00c',
                        'fa-check-circle' => '&#xf058',
                        'fa-check-circle-o' => '&#xf05d',
                        'fa-check-square' => '&#xf14a',
                        'fa-check-square-o' => '&#xf046',
                        'fa-chevron-circle-down' => '&#xf13a',
                        'fa-chevron-circle-left' => '&#xf137',
                        'fa-chevron-circle-right' => '&#xf138',
                        'fa-chevron-circle-up' => '&#xf139',
                        'fa-chevron-down' => '&#xf078',
                        'fa-chevron-left' => '&#xf053',
                        'fa-chevron-right' => '&#xf054',
                        'fa-chevron-up' => '&#xf077',
                        'fa-child' => '&#xf1ae',
                        'fa-circle' => '&#xf111',
                        'fa-circle-o' => '&#xf10c',
                        'fa-circle-o-notch' => '&#xf1ce',
                        'fa-circle-thin' => '&#xf1db',
                        'fa-clipboard' => '&#xf0ea',
                        'fa-clock-o' => '&#xf017',
                        'fa-cloud' => '&#xf0c2',
                        'fa-cloud-download' => '&#xf0ed',
                        'fa-cloud-upload' => '&#xf0ee',
                        'fa-code' => '&#xf121',
                        'fa-code-fork' => '&#xf126',
                        'fa-codepen' => '&#xf1cb',
                        'fa-coffee' => '&#xf0f4',
                        'fa-cog' => '&#xf013',
                        'fa-cogs' => '&#xf085',
                        'fa-columns' => '&#xf0db',
                        'fa-comment' => '&#xf075',
                        'fa-comment-o' => '&#xf0e5',
                        'fa-comments' => '&#xf086',
                        'fa-comments-o' => '&#xf0e6',
                        'fa-compass' => '&#xf14e',
                        'fa-compress' => '&#xf066',
                        'fa-copyright' => '&#xf1f9',
                        'fa-credit-card' => '&#xf09d',
                        'fa-crop' => '&#xf125',
                        'fa-crosshairs' => '&#xf05b',
                        'fa-css3' => '&#xf13c',
                        'fa-cube' => '&#xf1b2',
                        'fa-cubes' => '&#xf1b3',
                        'fa-cutlery' => '&#xf0f5',
                        'fa-database' => '&#xf1c0',
                        'fa-delicious' => '&#xf1a5',
                        'fa-desktop' => '&#xf108',
                        'fa-deviantart' => '&#xf1bd',
                        'fa-digg' => '&#xf1a6',
                        'fa-dot-circle-o' => '&#xf192',
                        'fa-download' => '&#xf019',
                        'fa-dribbble' => '&#xf17d',
                        'fa-dropbox' => '&#xf16b',
                        'fa-drupal' => '&#xf1a9',
                        'fa-eject' => '&#xf052',
                        'fa-ellipsis-h' => '&#xf141',
                        'fa-ellipsis-v' => '&#xf142',
                        'fa-empire' => '&#xf1d1',
                        'fa-envelope' => '&#xf0e0',
                        'fa-envelope-o' => '&#xf003',
                        'fa-envelope-square' => '&#xf199',
                        'fa-eraser' => '&#xf12d',
                        'fa-eur' => '&#xf153',
                        'fa-exchange' => '&#xf0ec',
                        'fa-exclamation' => '&#xf12a',
                        'fa-exclamation-circle' => '&#xf06a',
                        'fa-exclamation-triangle' => '&#xf071',
                        'fa-expand' => '&#xf065',
                        'fa-external-link' => '&#xf08e',
                        'fa-external-link-square' => '&#xf14c',
                        'fa-eye' => '&#xf06e',
                        'fa-eye-slash' => '&#xf070',
                        'fa-eyedropper' => '&#xf1fb',
                        'fa-facebook' => '&#xf09a',
                        'fa-facebook-square' => '&#xf082',
                        'fa-fast-backward' => '&#xf049',
                        'fa-fast-forward' => '&#xf050',
                        'fa-fax' => '&#xf1ac',
                        'fa-female' => '&#xf182',
                        'fa-fighter-jet' => '&#xf0fb',
                        'fa-file' => '&#xf15b',
                        'fa-file-archive-o' => '&#xf1c6',
                        'fa-file-audio-o' => '&#xf1c7',
                        'fa-file-code-o' => '&#xf1c9',
                        'fa-file-excel-o' => '&#xf1c3',
                        'fa-file-image-o' => '&#xf1c5',
                        'fa-file-o' => '&#xf016',
                        'fa-file-pdf-o' => '&#xf1c1',
                        'fa-file-powerpoint-o' => '&#xf1c4',
                        'fa-file-text' => '&#xf15c',
                        'fa-file-text-o' => '&#xf0f6',
                        'fa-file-video-o' => '&#xf1c8',
                        'fa-file-word-o' => '&#xf1c2',
                        'fa-files-o' => '&#xf0c5',
                        'fa-film' => '&#xf008',
                        'fa-filter' => '&#xf0b0',
                        'fa-fire' => '&#xf06d',
                        'fa-fire-extinguisher' => '&#xf134',
                        'fa-flag' => '&#xf024',
                        'fa-flag-checkered' => '&#xf11e',
                        'fa-flag-o' => '&#xf11d',
                        'fa-flask' => '&#xf0c3',
                        'fa-flickr' => '&#xf16e',
                        'fa-floppy-o' => '&#xf0c7',
                        'fa-folder' => '&#xf07b',
                        'fa-folder-o' => '&#xf114',
                        'fa-folder-open' => '&#xf07c',
                        'fa-folder-open-o' => '&#xf115',
                        'fa-font' => '&#xf031',
                        'fa-forward' => '&#xf04e',
                        'fa-foursquare' => '&#xf180',
                        'fa-frown-o' => '&#xf119',
                        'fa-futbol-o' => '&#xf1e3',
                        'fa-gamepad' => '&#xf11b',
                        'fa-gavel' => '&#xf0e3',
                        'fa-gbp' => '&#xf154',
                        'fa-gift' => '&#xf06b',
                        'fa-git' => '&#xf1d3',
                        'fa-git-square' => '&#xf1d2',
                        'fa-github' => '&#xf09b',
                        'fa-github-alt' => '&#xf113',
                        'fa-github-square' => '&#xf092',
                        'fa-gittip' => '&#xf184',
                        'fa-glass' => '&#xf000',
                        'fa-globe' => '&#xf0ac',
                        'fa-google' => '&#xf1a0',
                        'fa-google-plus' => '&#xf0d5',
                        'fa-google-plus-square' => '&#xf0d4',
                        'fa-google-wallet' => '&#xf1ee',
                        'fa-graduation-cap' => '&#xf19d',
                        'fa-h-square' => '&#xf0fd',
                        'fa-hacker-news' => '&#xf1d4',
                        'fa-hand-o-down' => '&#xf0a7',
                        'fa-hand-o-left' => '&#xf0a5',
                        'fa-hand-o-right' => '&#xf0a4',
                        'fa-hand-o-up' => '&#xf0a6',
                        'fa-hdd-o' => '&#xf0a0',
                        'fa-header' => '&#xf1dc',
                        'fa-headphones' => '&#xf025',
                        'fa-heart' => '&#xf004',
                        'fa-heart-o' => '&#xf08a',
                        'fa-history' => '&#xf1da',
                        'fa-home' => '&#xf015',
                        'fa-hospital-o' => '&#xf0f8',
                        'fa-html5' => '&#xf13b',
                        'fa-ils' => '&#xf20b',
                        'fa-inbox' => '&#xf01c',
                        'fa-indent' => '&#xf03c',
                        'fa-info' => '&#xf129',
                        'fa-info-circle' => '&#xf05a',
                        'fa-inr' => '&#xf156',
                        'fa-instagram' => '&#xf16d',
                        'fa-ioxhost' => '&#xf208',
                        'fa-italic' => '&#xf033',
                        'fa-joomla' => '&#xf1aa',
                        'fa-jpy' => '&#xf157',
                        'fa-jsfiddle' => '&#xf1cc',
                        'fa-key' => '&#xf084',
                        'fa-keyboard-o' => '&#xf11c',
                        'fa-krw' => '&#xf159',
                        'fa-language' => '&#xf1ab',
                        'fa-laptop' => '&#xf109',
                        'fa-lastfm' => '&#xf202',
                        'fa-lastfm-square' => '&#xf203',
                        'fa-leaf' => '&#xf06c',
                        'fa-lemon-o' => '&#xf094',
                        'fa-level-down' => '&#xf149',
                        'fa-level-up' => '&#xf148',
                        'fa-life-ring' => '&#xf1cd',
                        'fa-lightbulb-o' => '&#xf0eb',
                        'fa-line-chart' => '&#xf201',
                        'fa-link' => '&#xf0c1',
                        'fa-linkedin' => '&#xf0e1',
                        'fa-linkedin-square' => '&#xf08c',
                        'fa-linux' => '&#xf17c',
                        'fa-list' => '&#xf03a',
                        'fa-list-alt' => '&#xf022',
                        'fa-list-ol' => '&#xf0cb',
                        'fa-list-ul' => '&#xf0ca',
                        'fa-location-arrow' => '&#xf124',
                        'fa-lock' => '&#xf023',
                        'fa-long-arrow-down' => '&#xf175',
                        'fa-long-arrow-left' => '&#xf177',
                        'fa-long-arrow-right' => '&#xf178',
                        'fa-long-arrow-up' => '&#xf176',
                        'fa-magic' => '&#xf0d0',
                        'fa-magnet' => '&#xf076',
                        'fa-male' => '&#xf183',
                        'fa-map-marker' => '&#xf041',
                        'fa-maxcdn' => '&#xf136',
                        'fa-meanpath' => '&#xf20c',
                        'fa-medkit' => '&#xf0fa',
                        'fa-meh-o' => '&#xf11a',
                        'fa-microphone' => '&#xf130',
                        'fa-microphone-slash' => '&#xf131',
                        'fa-minus' => '&#xf068',
                        'fa-minus-circle' => '&#xf056',
                        'fa-minus-square' => '&#xf146',
                        'fa-minus-square-o' => '&#xf147',
                        'fa-mobile' => '&#xf10b',
                        'fa-money' => '&#xf0d6',
                        'fa-moon-o' => '&#xf186',
                        'fa-music' => '&#xf001',
                        'fa-newspaper-o' => '&#xf1ea',
                        'fa-openid' => '&#xf19b',
                        'fa-outdent' => '&#xf03b',
                        'fa-pagelines' => '&#xf18c',
                        'fa-paint-brush' => '&#xf1fc',
                        'fa-paper-plane' => '&#xf1d8',
                        'fa-paper-plane-o' => '&#xf1d9',
                        'fa-paperclip' => '&#xf0c6',
                        'fa-paragraph' => '&#xf1dd',
                        'fa-pause' => '&#xf04c',
                        'fa-paw' => '&#xf1b0',
                        'fa-paypal' => '&#xf1ed',
                        'fa-pencil' => '&#xf040',
                        'fa-pencil-square' => '&#xf14b',
                        'fa-pencil-square-o' => '&#xf044',
                        'fa-phone' => '&#xf095',
                        'fa-phone-square' => '&#xf098',
                        'fa-picture-o' => '&#xf03e',
                        'fa-pie-chart' => '&#xf200',
                        'fa-pied-piper' => '&#xf1a7',
                        'fa-pied-piper-alt' => '&#xf1a8',
                        'fa-pinterest' => '&#xf0d2',
                        'fa-pinterest-square' => '&#xf0d3',
                        'fa-plane' => '&#xf072',
                        'fa-play' => '&#xf04b',
                        'fa-play-circle' => '&#xf144',
                        'fa-play-circle-o' => '&#xf01d',
                        'fa-plug' => '&#xf1e6',
                        'fa-plus' => '&#xf067',
                        'fa-plus-circle' => '&#xf055',
                        'fa-plus-square' => '&#xf0fe',
                        'fa-plus-square-o' => '&#xf196',
                        'fa-power-off' => '&#xf011',
                        'fa-print' => '&#xf02f',
                        'fa-puzzle-piece' => '&#xf12e',
                        'fa-qq' => '&#xf1d6',
                        'fa-qrcode' => '&#xf029',
                        'fa-question' => '&#xf128',
                        'fa-question-circle' => '&#xf059',
                        'fa-quote-left' => '&#xf10d',
                        'fa-quote-right' => '&#xf10e',
                        'fa-random' => '&#xf074',
                        'fa-rebel' => '&#xf1d0',
                        'fa-recycle' => '&#xf1b8',
                        'fa-reddit' => '&#xf1a1',
                        'fa-reddit-square' => '&#xf1a2',
                        'fa-refresh' => '&#xf021',
                        'fa-renren' => '&#xf18b',
                        'fa-repeat' => '&#xf01e',
                        'fa-reply' => '&#xf112',
                        'fa-reply-all' => '&#xf122',
                        'fa-retweet' => '&#xf079',
                        'fa-road' => '&#xf018',
                        'fa-rocket' => '&#xf135',
                        'fa-rss' => '&#xf09e',
                        'fa-rss-square' => '&#xf143',
                        'fa-rub' => '&#xf158',
                        'fa-scissors' => '&#xf0c4',
                        'fa-search' => '&#xf002',
                        'fa-search-minus' => '&#xf010',
                        'fa-search-plus' => '&#xf00e',
                        'fa-share' => '&#xf064',
                        'fa-share-alt' => '&#xf1e0',
                        'fa-share-alt-square' => '&#xf1e1',
                        'fa-share-square' => '&#xf14d',
                        'fa-share-square-o' => '&#xf045',
                        'fa-shield' => '&#xf132',
                        'fa-shopping-cart' => '&#xf07a',
                        'fa-sign-in' => '&#xf090',
                        'fa-sign-out' => '&#xf08b',
                        'fa-signal' => '&#xf012',
                        'fa-sitemap' => '&#xf0e8',
                        'fa-skype' => '&#xf17e',
                        'fa-slack' => '&#xf198',
                        'fa-sliders' => '&#xf1de',
                        'fa-slideshare' => '&#xf1e7',
                        'fa-smile-o' => '&#xf118',
                        'fa-sort' => '&#xf0dc',
                        'fa-sort-alpha-asc' => '&#xf15d',
                        'fa-sort-alpha-desc' => '&#xf15e',
                        'fa-sort-amount-asc' => '&#xf160',
                        'fa-sort-amount-desc' => '&#xf161',
                        'fa-sort-asc' => '&#xf0de',
                        'fa-sort-desc' => '&#xf0dd',
                        'fa-sort-numeric-asc' => '&#xf162',
                        'fa-sort-numeric-desc' => '&#xf163',
                        'fa-soundcloud' => '&#xf1be',
                        'fa-space-shuttle' => '&#xf197',
                        'fa-spinner' => '&#xf110',
                        'fa-spoon' => '&#xf1b1',
                        'fa-spotify' => '&#xf1bc',
                        'fa-square' => '&#xf0c8',
                        'fa-square-o' => '&#xf096',
                        'fa-stack-exchange' => '&#xf18d',
                        'fa-stack-overflow' => '&#xf16c',
                        'fa-star' => '&#xf005',
                        'fa-star-half' => '&#xf089',
                        'fa-star-half-o' => '&#xf123',
                        'fa-star-o' => '&#xf006',
                        'fa-steam' => '&#xf1b6',
                        'fa-steam-square' => '&#xf1b7',
                        'fa-step-backward' => '&#xf048',
                        'fa-step-forward' => '&#xf051',
                        'fa-stethoscope' => '&#xf0f1',
                        'fa-stop' => '&#xf04d',
                        'fa-strikethrough' => '&#xf0cc',
                        'fa-stumbleupon' => '&#xf1a4',
                        'fa-stumbleupon-circle' => '&#xf1a3',
                        'fa-subscript' => '&#xf12c',
                        'fa-suitcase' => '&#xf0f2',
                        'fa-sun-o' => '&#xf185',
                        'fa-superscript' => '&#xf12b',
                        'fa-table' => '&#xf0ce',
                        'fa-tablet' => '&#xf10a',
                        'fa-tachometer' => '&#xf0e4',
                        'fa-tag' => '&#xf02b',
                        'fa-tags' => '&#xf02c',
                        'fa-tasks' => '&#xf0ae',
                        'fa-taxi' => '&#xf1ba',
                        'fa-tencent-weibo' => '&#xf1d5',
                        'fa-terminal' => '&#xf120',
                        'fa-text-height' => '&#xf034',
                        'fa-text-width' => '&#xf035',
                        'fa-th' => '&#xf00a',
                        'fa-th-large' => '&#xf009',
                        'fa-th-list' => '&#xf00b',
                        'fa-thumb-tack' => '&#xf08d',
                        'fa-thumbs-down' => '&#xf165',
                        'fa-thumbs-o-down' => '&#xf088',
                        'fa-thumbs-o-up' => '&#xf087',
                        'fa-thumbs-up' => '&#xf164',
                        'fa-ticket' => '&#xf145',
                        'fa-times' => '&#xf00d',
                        'fa-times-circle' => '&#xf057',
                        'fa-times-circle-o' => '&#xf05c',
                        'fa-tint' => '&#xf043',
                        'fa-toggle-off' => '&#xf204',
                        'fa-toggle-on' => '&#xf205',
                        'fa-trash' => '&#xf1f8',
                        'fa-trash-o' => '&#xf014',
                        'fa-tree' => '&#xf1bb',
                        'fa-trello' => '&#xf181',
                        'fa-trophy' => '&#xf091',
                        'fa-truck' => '&#xf0d1',
                        'fa-try' => '&#xf195',
                        'fa-tty' => '&#xf1e4',
                        'fa-tumblr' => '&#xf173',
                        'fa-tumblr-square' => '&#xf174',
                        'fa-twitch' => '&#xf1e8',
                        'fa-twitter' => '&#xf099',
                        'fa-twitter-square' => '&#xf081',
                        'fa-umbrella' => '&#xf0e9',
                        'fa-underline' => '&#xf0cd',
                        'fa-undo' => '&#xf0e2',
                        'fa-university' => '&#xf19c',
                        'fa-unlock' => '&#xf09c',
                        'fa-unlock-alt' => '&#xf13e',
                        'fa-upload' => '&#xf093',
                        'fa-usd' => '&#xf155',
                        'fa-user' => '&#xf007',
                        'fa-user-md' => '&#xf0f0',
                        'fa-users' => '&#xf0c0',
                        'fa-video-camera' => '&#xf03d',
                        'fa-vimeo-square' => '&#xf194',
                        'fa-vine' => '&#xf1ca',
                        'fa-vk' => '&#xf189',
                        'fa-volume-down' => '&#xf027',
                        'fa-volume-off' => '&#xf026',
                        'fa-volume-up' => '&#xf028',
                        'fa-weibo' => '&#xf18a',
                        'fa-weixin' => '&#xf1d7',
                        'fa-wheelchair' => '&#xf193',
                        'fa-wifi' => '&#xf1eb',
                        'fa-windows' => '&#xf17a',
                        'fa-wordpress' => '&#xf19a',
                        'fa-wrench' => '&#xf0ad',
                        'fa-xing' => '&#xf168',
                        'fa-xing-square' => '&#xf169',
                        'fa-yahoo' => '&#xf19e',
                        'fa-yelp' => '&#xf1e9',
                        'fa-youtube' => '&#xf167',
                        'fa-youtube-play' => '&#xf16a',
                        'fa-youtube-square' => '&#xf166',
                    );
                    ?>
                    <select style="font-family: 'FontAwesome', Arial" id="edit-menu-item-icon-<?php echo esc_attr($item_id); ?>"
                            class="widefat edit-menu-item-icon" name="menu-item-icon[<?php echo esc_attr($item_id); ?>]"
                            value="true" <?php echo($item->mega_menu == "true" ? "checked" : "") ?>>
                        <?php
                        foreach ($icon as $key => $value) {

                            echo '<option value="' . $key . '" ' . ($key == $item->icon ? "selected" : "") . '>' . $value . '</option>';
                        }
                        ?>
                    </select>
                </label>
            </p>
            <p class="mega-menu-bg description description-thin">
                <label for="edit-menu-item-background-<?php echo esc_attr($item_id); ?>">
                    <?php esc_html_e('Mega menu background', 'themo'); ?><br/>
                    <input type="text" id="edit-menu-item-background-<?php echo esc_attr($item_id); ?>"
                           class="widefat edit-menu-item-background"
                           name="menu-item-background[<?php echo esc_attr($item_id); ?>]"
                           value="<?php echo esc_attr($item->background); ?>"/>
                </label>
            </p>
            

            <div class="clear">
                <p class="tag-text description description-thin">
                    <label for="edit-menu-item-tag-text-<?php echo esc_attr($item_id); ?>">
                        <?php esc_html_e('Tag text', 'themo'); ?><br/>
                        <input type="text" id="edit-menu-item-tag-text-<?php echo esc_attr($item_id); ?>"
                               class="widefat edit-menu-item-tag-text"
                               name="menu-item-tag-text[<?php echo esc_attr($item_id); ?>]"
                               value="<?php echo esc_attr($item->tag_text); ?>"/>
                    </label>
                </p>
                <p class="tag-bg description description-thin">
                    <label for="edit-menu-item-tag-background-<?php echo esc_attr($item_id); ?>">
                        <?php esc_html_e('Tag background color', 'themo'); ?><br/>
                        <input type="text" id="edit-menu-item-tag-background-<?php echo esc_attr($item_id); ?>"
                               class="widefat edit-menu-item-tag-background"
                               name="menu-item-tag-background[<?php echo esc_attr($item_id); ?>]"
                               value="<?php echo esc_attr($item->tag_background); ?>"/>
                    </label>
                </p>
            </div>
            
            <?php
            /*
             * end added field
             */
            ?>
            <div class="menu-item-actions description-wide submitbox">
                <?php if ('custom' != $item->type && $original_title !== false) : ?>
                    <p class="link-to-original">
                        <?php printf(esc_html__('Original: %s', 'themo'), '<a href="' . esc_attr($item->url) . '">' . esc_html($original_title) . '</a>'); ?>
                    </p>
                <?php endif; ?>
                <a class="item-delete submitdelete deletion" id="delete-<?php echo esc_attr($item_id); ?>" href="<?php
                echo wp_nonce_url(
                    add_query_arg(
                        array(
                            'action' => 'delete-menu-item',
                            'menu-item' => $item_id,
                ), remove_query_arg($removed_args, esc_url(admin_url('nav-menus.php')))
                    ), 'delete-menu_item_' . $item_id
                );
                ?>"><?php esc_html_e('Remove', 'themo'); ?></a> <span class="meta-sep"> | </span> <a
                    class="item-cancel submitcancel" id="cancel-<?php echo esc_attr($item_id); ?>"
                     href="<?php echo esc_url(add_query_arg(array('edit-menu-item' => $item_id, 'cancel' => time()), remove_query_arg($removed_args, esc_url(admin_url('nav-menus.php')))));
                    ?>#menu-item-settings-<?php echo esc_attr($item_id); ?>"><?php esc_html_e('Cancel', 'themo'); ?></a>
            </div>

            <input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo esc_attr($item_id); ?>]"
                   value="<?php echo esc_attr($item_id); ?>"/>
            <input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo esc_attr($item_id); ?>]"
                   value="<?php echo esc_attr($item->object_id); ?>"/>
            <input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo esc_attr($item_id); ?>]"
                   value="<?php echo esc_attr($item->object); ?>"/>
            <input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo esc_attr($item_id); ?>]"
                   value="<?php echo esc_attr($item->menu_item_parent); ?>"/>
            <input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo esc_attr($item_id); ?>]"
                   value="<?php echo esc_attr($item->menu_order); ?>"/>
            <input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo esc_attr($item_id); ?>]"
                   value="<?php echo esc_attr($item->type); ?>"/>
        </div><!-- .menu-item-settings-->
        <ul class="menu-item-transport"></ul>
        <?php
        $output .= ob_get_clean();
    }

}
    