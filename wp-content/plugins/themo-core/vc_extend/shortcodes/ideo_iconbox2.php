<?php

vc_map(array(
    'name' => __('Icon Box 2', 'ideo-themo'),
    'base' => 'ideo_iconbox2',
    'icon' => 'icon-icon-box-2',
    'category' => __('Content', 'ideo-themo'),
    'description' => __('Content block with icon.', 'ideo-themo'),
    'weight' => 80,
    'params' => array(

        array(
            'type' => 'ideo_buttons',
            'heading' => __('ICON TYPE', 'ideo-themo'),
            'param_name' => 'el_icon_type',
            'value' => array('Font icon' => 'font', 'Custom icon' => 'custom'),
            'dependencies' => array(
                'font' => array('el_icon_font'),
                'custom' => array('el_icon_custom'),
            ),
            'std' => 'font',
            'description' => __('Choose Font icon to display standard icon or choose Custom icon to upload your own icon/image. Depending on which option you choose appropriate option will be available below.', 'ideo-themo')
        ),
        array(
            'type' => 'attach_image',
            'heading' => __('UPLOAD IMAGE', 'ideo-themo'),
            'param_name' => 'el_icon_custom',
            'value' => array()
        ),
        array(
            'type' => 'ideo_choose_icon',
            'class' => '',
            'heading' => __('CHOOSE ICON', 'ideo-themo'),
            'param_name' => 'el_icon_font',
            'value' => '',
            'std' => 'fa fa-star-o',
        ),
        array(
            'type' => 'ideo_buttons',
            'heading' => __('ICON POSITION', 'ideo-themo'),
            'param_name' => 'el_icon_align',
            'value' => array('Left' => 'left', 'Top' => 'center', 'Right' => 'right'),
            'std' => 'center',
            'description' => __('Decide on which side of the element the icon will be displayed.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('ICON SIZE', 'ideo-themo'),
            'param_name' => 'el_icon_font_size',
            'value' => '40',
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('ICON BACKGROUND (for colored styles) (px)', 'ideo-themo'),
            'param_name' => 'el_icon_circle_size',
            'min' => '0',
            'max' => '45',
            'value' => '40',
            'description' => __('Define a diameter of the icon background.</br>Notice, that this option affects also the distance between the icon background and the content background.', 'ideo-themo')

        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('ICON BORDER (for Transparent styles) (px)', 'ideo-themo'),
            'param_name' => 'el_icon_circle_border_size',
            'min' => '0',
            'max' => '45',
            'value' => '1',
            'description' => __('Define the thickness of icon circled border. This option works only for Transparent styles.', 'ideo-themo')

        ),
        array(
            'type' => 'textfield',
            'heading' => __('TITLE', 'ideo-themo'),
            'param_name' => 'el_title',
            'admin_label' => true,
            'value' => __('Place title here', 'ideo-themo'),
            'description' => __('Enter iconbox title or leave empty field to remove title area from the element.', 'ideo-themo'),
        ),
        array(
            'type' => 'textfield',
            'heading' => __('TITLE FONT SIZE', 'ideo-themo'),
            'param_name' => 'el_title_size',
            'value' => '18',
        ),

        array(
            'type' => 'textarea',
            'admin_label' => true,
            'heading' => __('DESCRIPTION', 'ideo-themo'),
            'param_name' => 'content',
            'value' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'ideo-themo'),
            'description' => __('Enter description or leave empty field to remove description area from the element.', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('DESCRIPTION FONT SIZE', 'ideo-themo'),
            'param_name' => 'el_text_size',
            'value' => '',
        ),
        array(
            'type' => 'ideo_buttons',
            'heading' => __('TITLE & DESCRIPTION ALIGNMENT', 'ideo-themo'),
            'param_name' => 'el_text_align',
            'value' => array('Left' => 'left', 'Center' => 'center', 'Right' => 'right', 'Justify' => 'justify'),
            'std' => 'center',
        ),

        array(
            'type' => 'ideo_switcher',
            'heading' => __('BUTTON DISPLAY', 'ideo-themo'),
            'param_name' => 'el_button_display',
            'on' => 'true',
            'off' => 'false',
            'value' => 'true',
            'description' => __('Enable or disable button displaying.', 'ideo-themo'),
            'group' => __('BUTTON', 'ideo-themo')

        ),
        array(
            'type' => 'ideo_buttons',
            'heading' => __('BUTTON ALIGNMENT', 'ideo-themo'),
            'param_name' => 'el_button_align',
            'value' => array('Left' => 'left', 'Center' => 'center', 'Right' => 'right'),
            'std' => 'center',
            'group' => __('BUTTON', 'ideo-themo')
        ),
        array(
            'type' => 'textfield',
            'heading' => __('BUTTON LABEL', 'ideo-themo'),
            'param_name' => 'el_button_label',
            'value' => __('Read more', 'ideo-themo'),
            'description' => __('Enter text which will be displayed on the button.', 'ideo-themo'),
            'group' => __('BUTTON', 'ideo-themo')
        ),
        array(
            'type' => 'vc_link',
            'heading' => __('BUTTON URL (LINK)', 'ideo-themo'),
            'param_name' => 'el_button_link',
            'value' => '',
            'description' => __('Enter button URL.', 'ideo-themo'),
            'group' => __('BUTTON', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_buttons',
            'heading' => __('BUTTON TYPE', 'ideo-themo'),
            'param_name' => 'el_button_type',
            'value' => array('Flat' => 'flat', '3D' => 'button3d'),
            'std' => 'flat',
            'description' => __('Choose Flat or 3D button type.', 'ideo-themo'),
            'group' => __('BUTTON', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_buttons',
            'heading' => __('BUTTON RADIUS', 'ideo-themo'),
            'param_name' => 'el_button_radius',
            'value' => array(
                __('Default', 'ideo-themo') => '',
                __('None', 'ideo-themo') => 'none',
                __('Small', 'ideo-themo') => 'small',
                __('Big', 'ideo-themo') => 'big'
            ),
            'std' => '',
            'description' => __('Choose None, Small or Big radius type or choose Default to use default setting from Customizer. Notice that in Customizer you can define precise value for Small and Big types.', 'ideo-themo'),
            'group' => __('BUTTON', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('BORDER THICKNESS (px)', 'ideo-themo'),
            'param_name' => 'el_button_border_thickness',
            'min' => '0',
            'max' => '10',
            'value' => '1',
            'description' => __('Define button border thickness.', 'ideo-themo'),
            'group' => __('BUTTON', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_buttons',
            'heading' => __('BUTTON SIZE', 'ideo-themo'),
            'param_name' => 'el_button_size',
            'value' => array(
                __('X-Small', 'ideo-themo') => 'xsmall', 
                __('Small', 'ideo-themo') => 'small', 
                __('Medium', 'ideo-themo') => 'medium', 
                __('Large', 'ideo-themo') => 'large',
                __('X-Large', 'ideo-themo') => 'xlarge'
            ),
            'std' => 'small',
            'description' => __('Choose Small, Medium or Large button size. Button size option refers to button height and button label font size.', 'ideo-themo'),
            'group' => __('BUTTON', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_buttons',
            'heading' => __('BUTTON ICON', 'ideo-themo'),
            'param_name' => 'el_button_icon_type',
            'value' => array('No icon' => '', 'Reveal icon' => 'reveal', 'Standard icon' => 'standard'),
            'dependencies' => array(
                'reveal' => array('el_button_icon', 'el_button_icon_position'),
                'standard' => array('el_button_icon', 'el_button_icon_position'),
            ),
            'std' => 'reveal',
            'description' => __('Decide if/how the icon will be displayed on the button.</br><b>Standard</b> - the icon is displayed on the button continuously.</br><b>Reveal</b> - the icon slides in on hover.', 'ideo-themo'),
            'group' => __('BUTTON', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_choose_icon',
            'class' => '',
            'heading' => __('CHOOSE BUTTON ICON', 'ideo-themo'),
            'param_name' => 'el_button_icon',
            'value' => 'fa fa-angle-right',
            'group' => __('BUTTON', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_buttons',
            'heading' => __('ICON POSITION', 'ideo-themo'),
            'param_name' => 'el_button_icon_position',
            'value' => array('Left' => 'left-icon', 'Right' => 'right-icon'),
            'std' => 'right-icon',
            'description' => __('Decide on which side of the button the icon will be displayed.', 'ideo-themo'),
            'group' => __('BUTTON', 'ideo-themo')
        ),


        array(
            'type' => 'ideo_slider',
            'heading' => __('MARGIN TOP (px)', 'ideo-themo'),
            'param_name' => 'el_margin_top',
            'min' => '0',
            'max' => '200',
            'value' => '20',
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('MARGIN BOTTOM (px)', 'ideo-themo'),
            'param_name' => 'el_margin_bottom',
            'min' => '0',
            'max' => '200',
            'value' => '20',
        ),

        array(
            'type' => 'textfield',
            'heading' => __('EXTRA CLASS NAME', 'ideo-themo'),
            'param_name' => 'el_extra_class',
            'value' => '',
            'description' => __('Type in an extra class name for this particular element, so you can refer to that class in custom css.', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_dropdown',
            'heading' => __('ELEMENT STYLE', 'ideo-themo'),
            'admin_label' => true,
            'param_name' => 'el_elemnt_style',
            'value' => array(
                'colored dark' => 'colored-dark',
                'colored light' => 'colored-light',
                'transparent dark' => 'transparent-dark',
                'transparent light' => 'transparent-light',

            ),
            'colors' => ideothemo_get_colors(),
            'std' => ideothemo_get_shortcodes_default_style('ideo_iconbox2'),
            'description' => __('Choose style for the element. Depending on which option you choose appropriate colorpickers will be available below. You can freely customize colors for chosen style but you can also leave empty colorpickers to use colors which are set for that style in Customizer.', 'ideo-themo'),
            'group' => __('STYLING', 'ideo-themo')
        ),


        /* =================================== */
        array(
            'type' => 'ideo_custom_colors',
            'heading' => __('COLORS', 'ideo-themo'),
            'param_name' => 'el_elemnt_style_colors',
            'colors' => ideothemo_get_colors(),
            'el_colors' => array(
                'colored' => array(
                    'background_color' => __('BACKGROUND COLOR', 'ideo-themo'),
                    'title_color' => __('TITLE COLOR', 'ideo-themo'),
                    'separator_color' => __('TITLE DIVIDER COLOR', 'ideo-themo'),
                    'text_color' => __('TEXT COLOR', 'ideo-themo'),
                    'icon_background_color' => __('ICON BACKGROUND COLOR', 'ideo-themo'),
                    'icon_color' => __('ICON COLOR', 'ideo-themo'),
                    'border_color' => __('BORDER BOTTOM COLOR', 'ideo-themo'),

                ),
                'transparent' => array(
                    'title_color' => __('TITLE COLOR', 'ideo-themo'),
                    'separator_color' => __('TITLE DIVIDER COLOR', 'ideo-themo'),
                    'text_color' => __('TEXT COLOR', 'ideo-themo'),
                    'icon_background_color' => __('ICON BACKGROUND COLOR', 'ideo-themo'),
                    'icon_color' => __('ICON COLOR', 'ideo-themo'),
                    'icon_border_color' => __('ICON BORDER COLOR', 'ideo-themo'),
                )
            ),
            'std' => '',
            'group' => __('STYLING', 'ideo-themo')
        ),


        array(
            'type' => 'ideo_dropdown',
            'heading' => __('BUTTON STYLE', 'ideo-themo'),
            'param_name' => 'el_button_elemnt_style',
            'value' => array(
                'default' => 'default',
                'colored light' => 'colored-light',
                'colored dark' => 'colored-dark',
                'colored light to transparent' => 'colored-light-to-transparent',
                'colored dark to transparent' => 'colored-dark-to-transparent',
                'transparent to colored light' => 'colored-light-to-transparent-invert',
                'transparent to colored dark' => 'colored-dark-to-transparent-invert',
                'transparent light' => 'transparent-light',
                'transparent dark' => 'transparent-dark',
            ),
            'colors' => ideothemo_get_colors(),
            'std' => 'default',
            'description' => __('Choose button style. Depending on which option you choose appropriate colorpickers will be available below. You can freely customize colors for chosen style but you can also leave empty colorpickers to use colors which are set for that style in Customizer.</br>Notice that Transparent to colored and Colored to transparent styles take colors from Colored palettes from Customizer.', 'ideo-themo'),
            'group' => __('STYLING', 'ideo-themo')
        ),


        array(
            'type' => 'ideo_custom_colors',
            'heading' => __('BUTTON COLORS', 'ideo-themo'),
            'param_name' => 'el_button_elemnt_style_colors',
            'colors' => ideothemo_get_colors(),
            'el_colors' => array(
                'colored' => array(
                    'background_color' => __('BACKGROUND COLOR', 'ideo-themo'),
                    'font_color' => __('LABEL COLOR', 'ideo-themo'),
                    'icon_color' => __('ICON COLOR', 'ideo-themo'),
                    'borders_color' => __('BORDERS COLOR', 'ideo-themo'),
                    'background_hover_color' => __('BACKGROUND HOVER COLOR', 'ideo-themo'),
                    'font_hover_color' => __('LABEL HOVER COLOR', 'ideo-themo'),
                    'icon_hover_color' => __('ICON HOVER COLOR', 'ideo-themo'),
                    'borders_hover_color' => __('BORDERS HOVER COLOR', 'ideo-themo'),

                ),
                'transparent' => array(
                    'font_color' => __('LABEL COLOR', 'ideo-themo'),
                    'icon_color' => __('ICON COLOR', 'ideo-themo'),
                    'borders_color' => __('BORDERS COLOR', 'ideo-themo'),
                    'font_hover_color' => __('LABEL HOVER COLOR', 'ideo-themo'),
                    'icon_hover_color' => __('ICON HOVER COLOR', 'ideo-themo'),
                    'borders_hover_color' => __('BORDER HOVER COLOR', 'ideo-themo'),
                )
            ),
            'std' => '',
            'group' => __('STYLING', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_buttons',
            'heading' => __('ANIMATION', 'ideo-themo'),
            'param_name' => 'el_animation',
            'value' => array(
                __('none', 'ideo-themo') => '',
                __('Viewport', 'ideo-themo') => 'viewport',
            ),
            'dependencies' => array(
                'viewport' => array('el_animation_type', 'el_animation_delay', 'el_animation_duration', 'el_animation_offset')
            ),
            'std' => '',
            'description' => __('Using this option you can enable viewport animation for the element. If you choose Viewport two additional options will be available below.', 'ideo-themo'),
            'group' => __('ANIMATION', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_animation_type',
            'heading' => __('ANIMATION TYPE', 'ideo-themo'),
            'param_name' => 'el_animation_type',
            'group' => __('ANIMATION', 'ideo-themo'),
            'value' => ideothemo_get_animate_viewport(),
            'description' => __('Choose one of predefined animations.', 'ideo-themo'),
            'group' => __('ANIMATION', 'ideo-themo')
        ),

        array(
            'type' => 'ideo_slider',
            'heading' => __('ANIMATION DELAY', 'ideo-themo'),
            'param_name' => 'el_animation_delay',
            'min' => '0',
            'max' => '5000',
            'value' => '500',
            'description' => __('Define animation delay in ms.', 'ideo-themo'),
            'group' => __('ANIMATION', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('ANIMATION DURATION', 'ideo-themo'),
            'param_name' => 'el_animation_duration',
            'min' => '0',
            'max' => '5000',
            'value' => '500',
            'description' => __('Define animation duration in ms.', 'ideo-themo'),
            'group' => __('ANIMATION', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_slider',
            'heading' => __('ANIMATION OFFSET', 'ideo-themo'),
            'param_name' => 'el_animation_offset',
            'min' => '0',
            'max' => '100',
            'value' => '95',
            'description' => __('Define animation offset in %. Offset is ', 'ideo-themo'),
            'group' => __('ANIMATION', 'ideo-themo')
        ),
        array(
            'type' => 'ideo_id',
            'heading' => __('UniqID', 'ideo-themo'),
            'param_name' => 'el_uid',
            'value' => 0,
            'group' => __('ANIMATION', 'ideo-themo')
        )

    ),
    'js_view' => 'VcIconBoxView'
));

$el_type = $el_icon_align = $el_icon_circle_size = $el_icon_circle_border_size = $el_title = $el_title_size = $el_text_size = $el_text_align = $el_icon_type = $el_icon_font = $el_icon_font_size = $el_icon_custom = $el_button_display = $el_button_label = $el_button_link = $el_button_type = $el_button_radius = $el_button_border_thickness = $el_button_size = $el_button_align = $el_button_icon_type = $el_button_icon = $el_button_icon_position = $el_margin_top = $el_margin_bottom = $el_extra_class = $el_custom_css = $el_elemnt_style = $el_elemnt_style_overwrite = $el_elemnt_style_colors = $el_button_elemnt_style = $el_button_elemnt_style_overwrite = $el_button_elemnt_style_colors = $el_animation = $el_animation_type = $el_animation_delay = $el_animation_duration = $el_animation_offset = $el_uid = $content = '';

function ideothemo_iconbox2_func($atts, $content = "")
{
    extract(shortcode_atts(array(
        'el_type' => 'big-icon',
        'el_icon_align' => 'center',
        'el_icon_circle_size' => '40',
        'el_icon_circle_border_size' => '1',
        'el_title' => __('Place title here', 'ideo-themo'),
        'el_title_size' => '18',
        'el_text_size' => '',
        'el_text_align' => 'center',
        'el_icon_type' => 'font',
        'el_icon_font' => 'fa fa-star-o',
        'el_icon_font_size' => '40',
        'el_icon_custom' => '',
        'el_button_label' => __('Read more', 'ideo-themo'),
        'el_button_link' => '',
        'el_button_type' => 'flat',
        'el_button_radius' => '',
        'el_button_border_thickness' => '1',
        'el_button_size' => 'small',
        'el_button_align' => 'center',
        'el_button_display' => 'true',
        'el_button_icon_type' => 'reveal',
        'el_button_icon' => 'fa fa-angle-right',
        'el_button_icon_position' => 'right-icon',
        'el_margin_top' => '20',
        'el_margin_bottom' => '20',
        'el_extra_class' => '',
        'el_custom_css' => '',
        'el_elemnt_style' => ideothemo_get_shortcodes_default_style('ideo_iconbox2'),
        'el_elemnt_style_overwrite' => '',
        'el_elemnt_style_colors' => '',
        'el_button_elemnt_style' => 'default',
        'el_button_elemnt_style_overwrite' => '',
        'el_button_elemnt_style_colors' => '',
        'el_animation' => '',
        'el_animation_type' => 'fadeIn',
        'el_animation_delay' => '500',
        'el_animation_duration' => '1000',
        'el_animation_offset' => '95',
        'el_uid' => ideothemo_shortcode_uid()
    ), $atts));
    
    if($el_uid == '') $el_uid = ideothemo_shortcode_uid();

    $html = '';
    $data = '';
    $svg = '';
    $colors_array = array();


    if ($el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-type="' . esc_attr($el_animation_type) . '"';
    if ($el_animation_delay && $el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-delay="' . esc_attr($el_animation_delay) . '"';
    if ($el_animation_duration && $el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-duration="' . esc_attr($el_animation_duration) . '"';
    if ($el_animation_offset && $el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-offset="' . esc_attr($el_animation_offset) . '"';


    $less = '#iconbox_' . $el_uid . '{';

    if ($el_margin_top != '') {
        if ($el_icon_align == 'center' && $el_type == 'big-icon') {
            $less .= 'margin-top:' . (int)($el_margin_top + 90) . 'px;';
        } else {
            $less .= 'margin-top:' . (int)$el_margin_top . 'px;';
        }
    }
    if ($el_margin_bottom != '') {
        $less .= 'margin-bottom:' . (int)$el_margin_bottom . 'px;';
    }
    if ($el_title_size) {
        $less .= 'h4{font-size:' . ideothemo_get_size($el_title_size) . ';}';
    }
    if ($el_text_size) {
        $less .= 'p{font-size:' . ideothemo_get_size($el_text_size) . ';}';
    }
    if ($el_icon_font_size) {
        $less .= '.icon i{font-size:' . ideothemo_get_size($el_icon_font_size) . ';}';
    }


    $colors = ideothemo_get_colors_by_style($el_elemnt_style);

    $default_vars = array(
        'big-icon' => array(
            'colored' => array(
                'title_color' => 'undefined',
                'text_color' => 'undefined',
                'background_color' => 'undefined',
                'border_color' => 'undefined',
                'icon_color' => 'undefined',
                'icon_background_color' => 'undefined',
                'separator_color' => 'undefined',
                'icon_border_color' => 'undefined',

            ),
            'transparent' => array(
                'title_color' => 'undefined',
                'text_color' => 'undefined',
                'icon_color' => 'undefined',
                'icon_background_color' => 'undefined',
                'icon_border_color' => 'undefined',
                'separator_color' => 'undefined',
                'icon_border_color' => 'undefined',
            )
        ),
        'small-icon' => array(
            'colored' => array(
                'title_color' => 'undefined',
                'text_color' => 'undefined',
                'background_color' => 'undefined',
                'border_color' => 'undefined',
                'icon_color' => 'undefined',
                'icon_background_color' => 'undefined',
                'icon_border_color' => 'undefined',
                'separator_color' => 'undefined',

            ),
            'transparent' => array(
                'title_color' => 'undefined',
                'text_color' => 'undefined',
                'icon_color' => 'undefined',
                'icon_background_color' => 'undefined',
                'icon_border_color' => 'undefined',
                'separator_color' => 'undefined',
            )
        )
    );

    $colors_array = array();
    if ($el_elemnt_style_colors) {
        $colors_array = (array)json_decode(str_replace("'", '"', $el_elemnt_style_colors));
    }

    $custom_background_color = !empty($colors_array['background_color']);
    $custom_icon_background_color = !empty($colors_array['icon_background_color']);
    $custom_icon_border_color = !empty($colors_array['icon_border_color']);

    $colors_array = array_replace_recursive(ideothemo_get_colors_by_style($el_elemnt_style), array_filter($colors_array));

    if (is_array($colors_array) && $el_type == 'big-icon') {

        $background_color = '';
        if (isset($colors_array['background_color'])) {
            $background_color = $colors_array['background_color'];
        }

        $icon_background_color = '';
        if (isset($colors_array['icon_background_color'])) {
            $icon_background_color = $colors_array['icon_background_color'];
        } else {
            $icon_background_color = ideothemo_hex2rgba($colors_array['accent_color'], ($el_elemnt_style == 'transparent-dark' || $el_elemnt_style == 'transparent-light') ? 0 : false);
        }


        $icon_border_color = $colors_array['accent_color'];
        if (isset($colors_array['icon_border_color'])) {
            $icon_border_color = $colors_array['icon_border_color'];
        }


        if ($el_elemnt_style == 'colored-dark' || $el_elemnt_style == 'colored-light') {
            $icon_svg_type = 'iconbox-' . $el_icon_align . '-colored.svg';
            $svg = ideothemo_get_assets_svg_data('svg/' . $icon_svg_type, $background_color, $icon_background_color, $el_icon_circle_size, $el_icon_circle_border_size);

            if (!$custom_background_color || !$custom_icon_background_color) {
                $icon_svg_params = sprintf('%s/%s/%s/%s',
                    $custom_background_color ? $colors_array['background_color'] : '',
                    $custom_icon_background_color ? $colors_array['icon_background_color'] : '',
                    $el_icon_circle_size,
                    $el_icon_circle_border_size
                );
            } else
                $icon_svg_type = false;

        } else if ($el_elemnt_style == 'transparent-dark' || $el_elemnt_style == 'transparent-light') {
            if ($icon_background_color == '') {
                $icon_background_color = 'none';
            }
            $icon_svg_type = 'iconbox-' . $el_icon_align . '-transparent.svg';
            $svg = ideothemo_get_assets_svg_data('svg/' . $icon_svg_type, $icon_border_color, $icon_background_color, $el_icon_circle_size, $el_icon_circle_border_size);

            if (!$custom_icon_border_color || !$custom_icon_background_color) {
                $icon_svg_params = sprintf('%s/%s/%s/%s',
                    $custom_icon_border_color ? $colors_array['icon_border_color'] : '',
                    $custom_icon_background_color ? $colors_array['icon_background_color'] : '',
                    $el_icon_circle_size,
                    $el_icon_circle_border_size
                );
            } else
                $icon_svg_type = false;
        }
        $less .= '.icon{';
        $less .= 'background-image:url(' . $svg . ');';
        $less .= ' i { background: none; }';
        $less .= '}';

        if (!empty($icon_svg_type) && ideothemo_is_customize_preview()) {
            $data .= ' data-icon-svg-type="' . $icon_svg_type . '" ';
            $data .= ' data-icon-svg-params="' . $icon_svg_params . '" ';
        }
    }


    if ($el_icon_type == 'custom' && $el_icon_custom) {

        $background_image = wp_get_attachment_image_src($el_icon_custom, 'full');

        $less .= '.icon i{';
        $less .= 'background-image:url(' . $background_image[0] . ');';
        $less .= 'background-size:100%;';
        $less .= '}';
    }
    $less .= '}';

    $html .= ideothemo_custom_style('iconbox', $el_uid, $default_vars[$el_type], $el_elemnt_style, $el_elemnt_style_colors, $less);

    $html .= '<div class="ideo-iconbox type-' . esc_attr($el_type) . ' align-icon-' . esc_attr($el_icon_align) . ' align-text-' . esc_attr($el_text_align) . ' ' . ($el_button_display == 'false' ? 'btn-off' : '') . ' ' . esc_attr($el_elemnt_style) . ' ' . esc_attr($el_extra_class) . ' vc-layer" id="iconbox_' . esc_attr($el_uid) . '" data-id="iconbox_' . esc_attr($el_uid) . '" ' . $data . '>';


    $html .= '<span class="icon"><i class="' . (isset($el_icon_font) && $el_icon_type == 'font' ? $el_icon_font : '') . '"></i></span>';


    if ($el_title) $html .= '<h4>' . ideo_esc($el_title) . '</h4>';
    if ($content) $html .= '<p>' . wpb_js_remove_wpautop($content) . '</p>';
    if ($el_button_display == 'true') {
        $html .= '<div class="button-wrap align-' . esc_attr($el_button_align) . '">' . do_shortcode('[vc_button 
        el_label="' . $el_button_label . '" 
        el_type="' . $el_button_type . '" 
        el_size="' . $el_button_size . '" 
        el_align="' . $el_button_align . '"     
        el_icon_position="' . $el_button_icon_position . '" 
        el_border_thickness="' . $el_button_border_thickness . '"  
        el_element_style="' . ($el_button_elemnt_style == 'default' ? ideothemo_get_shortcodes_button_default_style($el_elemnt_style) : $el_button_elemnt_style ) . '"
        el_uid="' . $el_uid . '" 
        el_link="' . $el_button_link . '" 
        el_radius="' . $el_button_radius . '" 
        el_icon_type="' . $el_button_icon_type . '" 
        el_icon="' . $el_button_icon . '" 
        el_element_style_overwrite="' . $el_button_elemnt_style_overwrite . '"    
        el_element_style_colors="' . $el_button_elemnt_style_colors . '"
        el_margin_right="0"
        el_margin_left="0"
        ]') . '</div>';
    }
    $html .= '</div>';

    

    return $html;
}

add_shortcode('ideo_iconbox2', 'ideothemo_iconbox2_func');









