<?php

class WPBakeryShortCode_Team_Box_Caption extends WPBakeryShortCode
{
}

vc_map(array(
        'name' => __('Team member advanced', 'ideo-themo'),
        'base' => 'ideo_team_box_caption',
        'icon' => 'icon-team-box-adv',
        'category' => __('Content', 'ideo-themo'),
        'description' => __('Member box with image, name, position, social icons and description.', 'ideo-themo'),
        'weight' => 71,
        'params' => array(


            array(
                'type' => 'ideo_team_list',
                'heading' => __('MEMBER', 'ideo-themo'),
                'admin_label' => true,
                'param_name' => 'el_member',
                'value' => '',
                'description' => __('Choose one of member cards (member custom posts) which you have created.', 'ideo-themo'),
            ),
            array(
                'type' => 'textarea_html',
                'heading' => __('MEMBER DESCRIPTION', 'ideo-themo'),
                'param_name' => 'content',
                'value' => __('I am caption. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'ideo-themo')
            ),
            array(
                'type' => 'ideo_buttons',
                'heading' => __('HOVER COLOR EFFECT', 'ideo-themo'),
                'param_name' => 'el_hover_color_effect',
                'value' => array(
                    __('None', 'ideo-themo') => 'none',
                    __('Grey to color', 'ideo-themo') => 'g2c',
                    __('Color to grey', 'ideo-themo') => 'c2g'
                ),
                'std' => 'c2g',
                'description' => __('Using this option you can enable an additional hover effect which generates image transition: Color to grey or Grey to color.', 'ideo-themo')
            ),
            array(
                'type' => 'ideo_buttons',
                'heading' => __('IMAGE LINKING METHOD', 'ideo-themo'),
                'param_name' => 'el_image_linking_method',
                'value' => array(
                    __('Don’t link', 'ideo-themo') => '',
                    __('Lightbox', 'ideo-themo') => 'lightbox',
                    __('Standard card', 'ideo-themo') => 'standard',
                    __('Ajax card', 'ideo-themo') => 'modern',
                ),
                'dependencies' => array(
                    'modern' => array('el_rel', 'el_easing_in_animation', 'el_easing_in_time', 'el_easing_out_animation', 'el_easing_out_time'),
                    'lightbox' => array('el_rel'),
                ),
                'std' => '',
                'description' => __('Decide if/how the image will be linked. Depending on which option you choose appropriate options will be available below.', 'ideo-themo')
            ),

            array(
                'type' => 'dropdown',
                'heading' => __('EASING-IN ANIMATION', 'ideo-themo'),
                'param_name' => 'el_easing_in_animation',
                'value' => array(
                    'linear',
                    'swing',
                    'easeInQuad',
                    'easeOutQuad',
                    'easeInOutQuad',
                    'easeInCubic',
                    'easeOutCubic',
                    'easeInOutCubic',
                    'easeInQuart',
                    'easeOutQuart',
                    'easeInOutQuart',
                    'easeInQuint',
                    'easeOutQuint',
                    'easeInOutQuint',
                    'easeInSine',
                    'easeOutSine',
                    'easeInOutSine',
                    'easeInExpo',
                    'easeOutExpo',
                    'easeInOutExpo',
                    'easeInCirc',
                    'easeOutCirc',
                    'easeInOutCirc',
                    'easeInElastic',
                    'easeOutElastic',
                    'easeInOutElastic',
                    'easeInBack',
                    'easeOutBack',
                    'easeInOutBack',
                    'easeInBounce',
                    'easeOutBounce',
                    'easeInOutBounce',
                ),
                'std' => 'easeOutQuad',
                'description' => __('Choose one of predefined easing effects for entry animation.', 'ideo-themo')
            ),

            array(
                'type' => 'ideo_slider',
                'heading' => __('EASING-IN DURATION', 'ideo-themo'),
                'param_name' => 'el_easing_in_time',
                'min' => '0',
                'max' => '10.1',
                'step' => '0.1',
                'value' => '1.5',
                'description' => __('Define entry animation duration.', 'ideo-themo'),
            ),

            array(
                'type' => 'dropdown',
                'heading' => __('EASING-OUT ANIMATION', 'ideo-themo'),
                'param_name' => 'el_easing_out_animation',
                'value' => array(
                    'linear',
                    'swing',
                    'easeInQuad',
                    'easeOutQuad',
                    'easeInOutQuad',
                    'easeInCubic',
                    'easeOutCubic',
                    'easeInOutCubic',
                    'easeInQuart',
                    'easeOutQuart',
                    'easeInOutQuart',
                    'easeInQuint',
                    'easeOutQuint',
                    'easeInOutQuint',
                    'easeInSine',
                    'easeOutSine',
                    'easeInOutSine',
                    'easeInExpo',
                    'easeOutExpo',
                    'easeInOutExpo',
                    'easeInCirc',
                    'easeOutCirc',
                    'easeInOutCirc',
                    'easeInElastic',
                    'easeOutElastic',
                    'easeInOutElastic',
                    'easeInBack',
                    'easeOutBack',
                    'easeInOutBack',
                    'easeInBounce',
                    'easeOutBounce',
                    'easeInOutBounce',
                ),
                'std' => 'easeOutQuad',
                'description' => __('Choose one of predefined easing effects for exit animation.', 'ideo-themo')
            ),

            array(
                'type' => 'ideo_slider',
                'heading' => __('EASING-OUT DURATION', 'ideo-themo'),
                'param_name' => 'el_easing_out_time',
                'min' => '0',
                'max' => '10.1',
                'step' => '0.1',
                'value' => '1.5',
                'description' => __('Define exit animation duration.', 'ideo-themo'),
            ),


            array(
                'type' => 'textfield',
                'heading' => __('ATTRIBUTE REL', 'ideo-themo'),
                'param_name' => 'el_rel',
                'value' => '',
                'description' => __('Type in atribute rel text if you want to use this card as a part of a showcase (lightbox gallery or ajax cards showcase). Atribute rel is an additional feature which allows you to organize single member cards into showcases.  When you assign the same Atribute rel to several member cards and these cards become parts of the same showcase, you will be able to navigate between these cards in lightbox gallery and in ajax cards presentation.', 'ideo-themo')
            ),
            array(
                'type' => 'ideo_buttons',
                'heading' => __('CONTENT ALIGNMENT', 'ideo-themo'),
                'param_name' => 'el_box_align',
                'value' => array('Left' => 'left', 'Center' => 'center', 'Right' => 'right'),
                'std' => 'center',
                'description' => __('Using this option you can align the content (name, position and description) to the Left, Center or Right side.', 'ideo-themo')
            ),
            array(
                'type' => 'textfield',
                'heading' => __('NAME FONT SIZE', 'ideo-themo'),
                'param_name' => 'el_name_fotn_size',
                'value' => '',
            ),

            array(
                'type' => 'textfield',
                'heading' => __('POSITION FONT SIZE', 'ideo-themo'),
                'param_name' => 'el_position_font_size',
                'value' => '',
            ),
            array(
                'type' => 'textfield',
                'heading' => __('DESCRIPTION FONT SIZE', 'ideo-themo'),
                'param_name' => 'el_desc_font_size',
                'value' => '',
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
                'param_name' => 'el_elemnt_style',
                'value' => array(
                    'colored dark' => 'colored-dark',
                    'colored light' => 'colored-light',
                    'transparent dark' => 'transparent-dark',
                    'transparent light' => 'transparent-light',

                ),
                'colors' => ideothemo_get_colors(),
                'std' => ideothemo_get_shortcodes_default_style('ideo_team_box_caption'),
                'admin_label' => true,
                'description' => __('Choose style for the element. Depending on which option you choose appropriate colorpickers will be available below. You can freely customize colors for chosen style but you can also leave empty colorpickers to use colors which are set for that style in Customizer.', 'ideo-themo'),
                'group' => __('STYLING', 'ideo-themo')
            ),
            array(
                'type' => 'ideo_custom_colors',
                'heading' => __('COLORS', 'ideo-themo'),
                'param_name' => 'el_elemnt_style_colors',
                'colors' => ideothemo_get_colors(),
                'el_colors' => array(
                    'colored' => array(
                        'background_color' => __('BACKGROUND COLOR', 'ideo-themo'),
                        'name_color' => __('MEMBER NAME COLOR', 'ideo-themo'),
                        'position_color' => __('MEMBER POSITION COLOR', 'ideo-themo'),
                        'description_color' => __('MEMBER DESCRIPTION COLOR', 'ideo-themo'),
                        'hover_icon_color' => __('HOVER ICON COLOR', 'ideo-themo'),
                        'social_bar_color' => __('SOCIAL MEDIA BAR BACKGROUND COLOR', 'ideo-themo'),
                        'social_icon_color' => __('SOCIAL MEDIA ICONS COLOR', 'ideo-themo'),
                    ),
                    'transparent' => array(
                        'name_color' => __('MEMBER NAME COLOR', 'ideo-themo'),
                        'position_color' => __('MEMBER POSITION COLOR', 'ideo-themo'),
                        'description_color' => __('MEMBER DESCRIPTION COLOR', 'ideo-themo'),
                        'hover_icon_color' => __('HOVER ICON COLOR', 'ideo-themo'),
                        'border_color' => __('SOCIAL MEDIA BAR BORDER COLOR', 'ideo-themo'),
                        'social_icon_color' => __('SOCIAL MEDIA ICONS COLOR', 'ideo-themo'),
                    )
                ),
                'value' => '',
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
                'max' => '2000',
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
        'js_view' => 'VcTeamBoxView'
    )
);

$el_member = $el_hover_color_effect = $el_image_linking_method = $el_easing_in_animation = $el_easing_in_time = $el_easing_out_animation = $el_easing_out_time = $el_rel = $el_box_align = $el_name_fotn_size = $el_position_font_size = $el_desc_font_size = $el_margin_top = $el_margin_bottom = $el_extra_class = $el_elemnt_style = $el_elemnt_style_colors = $el_animation = $el_animation_type = $el_animation_delay = $el_animation_duration = $el_animation_offset = $el_uid = '';

function ideothemo_team_box_caption_func($atts, $content = "")
{
    
    extract(shortcode_atts(array(
        'el_member' => '',
        'el_hover_color_effect' => 'c2g',
        'el_image_linking_method' => '',
        'el_easing_in_animation' => 'easeOutQuad',
        'el_easing_in_time' => '1.5',
        'el_easing_out_animation' => 'easeOutQuad',
        'el_easing_out_time' => '1.5',
        'el_rel' => '',
        'el_box_align' => 'center',
        'el_name_fotn_size' => '',
        'el_position_font_size' => '',
        'el_desc_font_size' => '',
        'el_margin_top' => '20',
        'el_margin_bottom' => '20',
        'el_extra_class' => '',
        'el_elemnt_style' => ideothemo_get_shortcodes_default_style('ideo_team_box_caption'),
        'el_elemnt_style_colors' => '',
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

    if ($el_member == '') return __('Team member advanced', 'ideo-themo') . ': ' . __('Member not selected.', 'ideo-themo');

    if ($el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-type="' . esc_attr($el_animation_type) . '"';
    if ($el_animation_delay && $el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-delay="' . esc_attr($el_animation_delay) . '"';
    if ($el_animation_duration && $el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-duration="' . esc_attr($el_animation_duration) . '"';
    if ($el_animation_offset && $el_animation_type && $el_animation == 'viewport') $data .= ' data-animation-offset="' . esc_attr($el_animation_offset) . '"';


    $less = '#team_box_caption_' . $el_uid . '{';

    $less .= '.caption{text-align:' . $el_box_align . ';}';

    if ($el_margin_top != '') {
        $less .= 'margin-top:' . (int)$el_margin_top . 'px;';
    }
    if ($el_margin_bottom != '') {
        $less .= 'margin-bottom:' . (int)$el_margin_bottom . 'px;';
    }
    if ($el_name_fotn_size) {
        $less .= '.name{font-size:' . ideothemo_get_size($el_name_fotn_size) . ';}';
    }
    if ($el_position_font_size) {
        $less .= '.position{font-size:' . ideothemo_get_size($el_position_font_size) . ';}';
    }
    if ($el_desc_font_size) {
        $less .= '.caption>p{font-size:' . ideothemo_get_size($el_desc_font_size) . ';}';
    }
    $less .= '}';

    /* ===   custom style   ==== */
    $colors = ideothemo_get_colors_by_style($el_elemnt_style);
    $default_vars = array(
        'colored' => array(
            'hover_icon_color' => 'undefined',
            'social_bar_color' => 'undefined',
            'social_icon_color' => 'undefined',
            'background_color' => 'undefined',
            'name_color' => 'undefined',
            'position_color' => 'undefined',
            'description_color' => 'undefined',
        ),
        'transparent' => array(
            'hover_icon_color' => 'undefined',
            'border_color' => 'undefined',
            'social_icon_color' => 'undefined',
            'name_color' => 'undefined',
            'position_color' => 'undefined',
            'description_color' => 'undefined',
        )
    );

    $html .= ideothemo_custom_style('team_box_caption', $el_uid, $default_vars, $el_elemnt_style, $el_elemnt_style_colors, $less);
    /* ===   end custom style   ==== */


    $html .= '<div class="ideo-team-box-caption' . esc_attr($el_image_linking_method ? ' link-' . $el_image_linking_method : '') . ' effect-' . esc_attr($el_hover_color_effect) . ' ' . esc_attr($el_elemnt_style) . ' ' . esc_attr($el_extra_class) . ' vc-layer" id="team_box_caption_' . esc_attr($el_uid) . '" data-id="team_box_caption_' . esc_attr($el_uid) . '" ' . $data . '>';

    $post_thumbnail_id = get_post_thumbnail_id($el_member);
    $thumb = wp_get_attachment_image_src($post_thumbnail_id, 'ideothemo-team-box-sc');
    $member_cf = get_post_meta($el_member, '_ideo_team', true);

    $link = 'javascript:void(0);" style="cursor:default;';
    if ($el_image_linking_method) {
        $link = get_permalink($el_member);
    }
    $image = array();
    if ($el_image_linking_method == 'lightbox') {
        $image = wp_get_attachment_image_src($post_thumbnail_id, 'full');
        $link = esc_url($image[0]);
    }

    if ($el_image_linking_method == 'modern') {
        $image = wp_get_attachment_image_src($post_thumbnail_id, 'ideothemo-team-box-sc-window-modal');
        $link = $image[0];
    }
    $data_link = '';
    if ($el_image_linking_method == 'modern') {
        $data_link = ' data-easing-in-animation="' . $el_easing_in_animation . '"';
        $data_link .= ' data-easing-in-time="' . $el_easing_in_time . '"';
        $data_link .= ' data-easing-out-animation="' . $el_easing_out_animation . '"';
        $data_link .= ' data-easing-out-time="' . $el_easing_out_time . '"';
    }

    if (!isset($member_cf['member_name']) || $member_cf['member_name'] == '') {
        $member_cf['member_name'] = get_the_title($el_member);
    }
    if (!isset($member_cf['member_position'])) {
        $member_cf['member_position'] = '';
    }
    if (!isset($member_cf['member_social'])) {
        $member_cf['member_social'] = array();
    }

    extract(shortcode_atts(array(
        'member_name' => '',
        'member_position' => '',
        'member_social' => '',
        'team_modern_pt_background_color' => '',
        'team_modern_pt_area_content_align' => '',
        'team_modern_title_font_size' => '',
        'team_modern_title_font_color' => '',
        'team_modern_subtitle_font_size' => '',
        'team_modern_subtitle_font_color' => '',
        'team_modern_member_image_border_color' => '',
        'team_modern_social_icons_color' => '',
        'team_modern_nav_arrows_color' => '',
        'team_modern_nav_border_color' => ''
    ), $member_cf));

    $data_json = json_encode(
        array(
            'post_id' => (int)$el_member,
            'member_image' => $link,
            'member_name' => $member_name,
            'member_position' => $member_position,
            'member_social' => $member_social,
            'background_color' => $team_modern_pt_background_color,
            'content_align' => $team_modern_pt_area_content_align,
            'title_font_size' => $team_modern_title_font_size,
            'title_font_color' => $team_modern_title_font_color,
            'subtitle_font_size' => $team_modern_subtitle_font_size,
            'subtitlefont_color' => $team_modern_subtitle_font_color,
            'image_border_color' => $team_modern_member_image_border_color,
            'social_icons_color' => $team_modern_social_icons_color,
            'arrows_color' => $team_modern_nav_arrows_color,
            'border_color' => $team_modern_nav_border_color
        )
    );


    $html .= '<div class="image">';
    if ($el_image_linking_method != '') {
        //$link esc secure line 447
        $html .= '<a href="' . $link . '" rel="' . esc_attr($el_rel) . '" class="overlay" ' . $data_link . ' title="' . esc_attr($member_cf['member_name']) . '" data-desc="' . esc_attr($member_cf['member_position']) . '" data-json="' . esc_html($data_json) . '"></a>';
        $html .= '<a href="' . $link . '">';
    }
    if ($el_hover_color_effect != 'none') {
        $html .= '<img src="' . esc_url($thumb[0]) . '" class="img-responsive grayscale grayscale-fade" alt="' . esc_attr($member_cf['member_name']) . '">';

    } else {
        $html .= '<img src="' . esc_url($thumb[0]) . '" class="img-responsive" alt="' . esc_attr($member_cf['member_name']) . '">';
    }

    if ($el_image_linking_method != '') {
        $html .= '</a>';
    }
    $html .= '</div>';

    $html .= '  <div class="social">';
    if (is_array($member_cf['member_social'])) {
        foreach (array_filter($member_cf['member_social']) as $key => $social) {
            $html .= '<a href="' . esc_url($social) . '" target="_blank"><i class="icon ' . esc_html($key) . '"></i></a>';
        }
    }
    $html .= '  </div>';
    $html .= '  <div class="caption">';
    $html .= '  <div class="name-position">';
    $html .= '      <h4 class="name">' . ideo_esc($member_cf['member_name']) . '</h4>';
    $html .= '      <p class="position">' . ideo_esc($member_cf['member_position']) . '</p>';
    $html .= '  </div>';
    $html .= wpb_js_remove_wpautop($content, true);
    $html .= '</div>';
    $html .= '</div>';

    

    return $html;
}

add_shortcode('ideo_team_box_caption', 'ideothemo_team_box_caption_func');
    
    
    
