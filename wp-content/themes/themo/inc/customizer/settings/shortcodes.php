<?php
$settings[] = array(
                'id' => 'shortcodes',
                'title' => esc_html__('SHORTCODES', 'themo'),
                'sections' => array(
                    array(
                        'id' => 'shortcodes_coloring',
                        'title' => esc_html__('COLORING', 'themo'),
                        'controls' => array(
                            array(
                                'id' => 'separator_sc_colored_light',
                                'type' => 'separator',
                                'label' => esc_html__('COLORED LIGHT', 'themo'),
                                'default' => '',
                                'description' => '',
                                'transport' => 'refresh',
                            ),
                            array(
                                'id' => 'ideo_theme_options[shortcodes][shortcodes_coloring][sc_colored_light_accent_color]',
                                'type' => 'alphacolor',
                                'label' => esc_html__('ACCENT COLOR', 'themo'),
                                'default' => ideothemo_get_themo_default_value('shortcodes.shortcodes_coloring.sc_colored_light_accent_color'),
                                'description' => __('Accent color affects on those elements in shortcodes which use accent color (depending on shortcode it can be active background, border, icon, text etc.).', 'themo'),
                                'transport' => 'postMessage',
                            ),
                            array(
                                'id' => 'ideo_theme_options[shortcodes][shortcodes_coloring][sc_colored_light_title_color]',
                                'type' => 'alphacolor',
                                'label' => esc_html__('TITLE COLOR', 'themo'),
                                'default' => ideothemo_get_themo_default_value('shortcodes.shortcodes_coloring.sc_colored_light_title_color'),
                                'description' => __('Title color affects on titles font color in shortcodes containing title.', 'themo'),
                                'transport' => 'postMessage',
                            ),
                            array(
                                'id' => 'ideo_theme_options[shortcodes][shortcodes_coloring][sc_colored_light_text_color]',
                                'type' => 'alphacolor',
                                'label' => esc_html__('TEXT COLOR', 'themo'),
                                'default' => ideothemo_get_themo_default_value('shortcodes.shortcodes_coloring.sc_colored_light_text_color'),
                                'description' => __('Text color affects on text font color in shortcodes containing text.', 'themo'),
                                'transport' => 'postMessage',
                            ),
                            array(
                                'id' => 'ideo_theme_options[shortcodes][shortcodes_coloring][sc_colored_light_icon_color]',
                                'type' => 'alphacolor',
                                'label' => esc_html__('ICON COLOR', 'themo'),
                                'default' => ideothemo_get_themo_default_value('shortcodes.shortcodes_coloring.sc_colored_light_icon_color'),
                                'description' => __('Icon color affects on icon font color in shortcodes containing icon. Notice, that in Colored styles some icons are displayed on accent color backgrounds, in that case icons use Alternantive color.', 'themo'),
                                'transport' => 'postMessage',
                            ),
                            array(
                                'id' => 'ideo_theme_options[shortcodes][shortcodes_coloring][sc_colored_light_background_color]',
                                'type' => 'alphacolor',
                                'label' => esc_html__('BACKGROUND COLOR', 'themo'),
                                'default' => ideothemo_get_themo_default_value('shortcodes.shortcodes_coloring.sc_colored_light_background_color'),
                                'description' => __('Background color affects on shortcodes containers backgrounds.', 'themo'),
                                'transport' => 'postMessage',
                            ),
                            array(
                                'id' => 'ideo_theme_options[shortcodes][shortcodes_coloring][sc_colored_light_alternative_title_color]',
                                'type' => 'alphacolor',
                                'label' => esc_html__('ALTERNATIVE TITLE COLOR', 'themo'),
                                'default' => ideothemo_get_themo_default_value('shortcodes.shortcodes_coloring.sc_colored_light_alternative_title_color'),
                                'description' => __('Alternative title color affects the text elements (titles, descriptions, icons)  wherever these elements are displayed on the background in accent color. Make sure, that alternative color you are gonna use will be look legible on picked accent color.', 'themo'),
                                'transport' => 'postMessage',
                            ),
                            array(
                                'id' => 'separator_sc_colored_dark',
                                'type' => 'separator',
                                'label' => esc_html__('COLORED DARK', 'themo'),
                                'default' => '',
                                'description' => '',
                                'transport' => 'refresh',
                            ),
                            array(
                                'id' => 'ideo_theme_options[shortcodes][shortcodes_coloring][sc_colored_dark_accent_color]',
                                'type' => 'alphacolor',
                                'label' => esc_html__('ACCENT COLOR', 'themo'),
                                'default' => ideothemo_get_themo_default_value('shortcodes.shortcodes_coloring.sc_colored_dark_accent_color'),
                                'description' => __('Accent color affects on those elements in shortcodes which use accent color (depending on shortcode it can be active background, border, icon, text etc.).', 'themo'),
                                'transport' => 'postMessage',
                            ),
                            array(
                                'id' => 'ideo_theme_options[shortcodes][shortcodes_coloring][sc_colored_dark_title_color]',
                                'type' => 'alphacolor',
                                'label' => esc_html__('TITLE COLOR', 'themo'),
                                'default' => ideothemo_get_themo_default_value('shortcodes.shortcodes_coloring.sc_colored_dark_title_color'),
                                'description' => __('Title color affects on titles font color in shortcodes containing title.', 'themo'),
                                'transport' => 'postMessage',
                            ),
                            array(
                                'id' => 'ideo_theme_options[shortcodes][shortcodes_coloring][sc_colored_dark_text_color]',
                                'type' => 'alphacolor',
                                'label' => esc_html__('TEXT COLOR', 'themo'),
                                'default' => ideothemo_get_themo_default_value('shortcodes.shortcodes_coloring.sc_colored_dark_text_color'),
                                'description' => __('Text color affects on text font color in shortcodes containing text.', 'themo'),
                                'transport' => 'postMessage',
                            ),
                            array(
                                'id' => 'ideo_theme_options[shortcodes][shortcodes_coloring][sc_colored_dark_icon_color]',
                                'type' => 'alphacolor',
                                'label' => esc_html__('ICON COLOR', 'themo'),
                                'default' => ideothemo_get_themo_default_value('shortcodes.shortcodes_coloring.sc_colored_dark_icon_color'),
                                'description' => __('Icon color affects on icon font color in shortcodes containing icon. Notice, that in Colored styles some icons are displayed on accent color backgrounds, in that case icons use Alternantive color.', 'themo'),
                                'transport' => 'postMessage',
                            ),
                            array(
                                'id' => 'ideo_theme_options[shortcodes][shortcodes_coloring][sc_colored_dark_background_color]',
                                'type' => 'alphacolor',
                                'label' => esc_html__('BACKGROUND COLOR', 'themo'),
                                'default' => ideothemo_get_themo_default_value('shortcodes.shortcodes_coloring.sc_colored_dark_background_color'),
                                'description' => __('Background color affects on shortcodes containers backgrounds.', 'themo'),
                                'transport' => 'postMessage',
                            ),
                            array(
                                'id' => 'ideo_theme_options[shortcodes][shortcodes_coloring][sc_colored_dark_alternative_title_color]',
                                'type' => 'alphacolor',
                                'label' => esc_html__('ALTERNATIVE TITLE COLOR', 'themo'),
                                'default' => ideothemo_get_themo_default_value('shortcodes.shortcodes_coloring.sc_colored_dark_alternative_title_color'),
                                'description' => __('Alternative title color affects the text elements (titles, descriptions, icons)  wherever these elements are displayed on the background in accent color. Make sure, that alternative color you are gonna use will be look legible on picked accent color.', 'themo'),
                                'transport' => 'postMessage',
                            ),
                            array(
                                'id' => 'separator_sc_transparent_light',
                                'type' => 'separator',
                                'label' => esc_html__('TRANSPARENT LIGHT', 'themo'),
                                'default' => '',
                                'description' => '',
                                'transport' => 'refresh',
                            ),
                            array(
                                'id' => 'ideo_theme_options[shortcodes][shortcodes_coloring][sc_transparent_light_accent_color]',
                                'type' => 'alphacolor',
                                'label' => esc_html__('ACCENT COLOR', 'themo'),
                                'default' => ideothemo_get_themo_default_value('shortcodes.shortcodes_coloring.sc_transparent_light_accent_color'),
                                'description' => __('Accent color affects on those elements in shortcodes which use accent color (depending on shortcode it can be border, icon, text etc.).', 'themo'),
                                'transport' => 'postMessage',
                            ),
                            array(
                                'id' => 'ideo_theme_options[shortcodes][shortcodes_coloring][sc_transparent_light_title_color]',
                                'type' => 'alphacolor',
                                'label' => esc_html__('TITLE COLOR', 'themo'),
                                'default' => ideothemo_get_themo_default_value('shortcodes.shortcodes_coloring.sc_transparent_light_title_color'),
                                'description' => __('Title color affects on titles font color in shortcodes containing title.', 'themo'),
                                'transport' => 'postMessage',
                            ),
                            array(
                                'id' => 'ideo_theme_options[shortcodes][shortcodes_coloring][sc_transparent_light_text_color]',
                                'type' => 'alphacolor',
                                'label' => esc_html__('TEXT COLOR', 'themo'),
                                'default' => ideothemo_get_themo_default_value('shortcodes.shortcodes_coloring.sc_transparent_light_text_color'),
                                'description' => __('Text color affects on text font color in shortcodes containing text.', 'themo'),
                                'transport' => 'postMessage',
                            ),
                            array(
                                'id' => 'ideo_theme_options[shortcodes][shortcodes_coloring][sc_transparent_light_icon_color]',
                                'type' => 'alphacolor',
                                'label' => esc_html__('ICON COLOR', 'themo'),
                                'default' => ideothemo_get_themo_default_value('shortcodes.shortcodes_coloring.sc_transparent_light_icon_color'),
                                'description' => __('Icon color affects on icon font color in shortcodes containing icon.', 'themo'),
                                'transport' => 'postMessage',
                            ),
                            array(
                                'id' => 'separator_sc_transparent_dark',
                                'type' => 'separator',
                                'label' => esc_html__('TRANSPARENT DARK', 'themo'),
                                'default' => '',
                                'description' => '',
                                'transport' => 'refresh',
                            ),
                            array(
                                'id' => 'ideo_theme_options[shortcodes][shortcodes_coloring][sc_transparent_dark_accent_color]',
                                'type' => 'alphacolor',
                                'label' => esc_html__('ACCENT COLOR', 'themo'),
                                'default' => ideothemo_get_themo_default_value('shortcodes.shortcodes_coloring.sc_transparent_dark_accent_color'),
                                'description' => __('Accent color affects on those elements in shortcodes which use accent color (depending on shortcode it can be border, icon, text etc.).', 'themo'),
                                'transport' => 'postMessage',
                            ),
                            array(
                                'id' => 'ideo_theme_options[shortcodes][shortcodes_coloring][sc_transparent_dark_title_color]',
                                'type' => 'alphacolor',
                                'label' => esc_html__('TITLE COLOR', 'themo'),
                                'default' => ideothemo_get_themo_default_value('shortcodes.shortcodes_coloring.sc_transparent_dark_title_color'),
                                'description' => __('Title color affects on titles font color in shortcodes containing title.', 'themo'),
                                'transport' => 'postMessage',
                            ),
                            array(
                                'id' => 'ideo_theme_options[shortcodes][shortcodes_coloring][sc_transparent_dark_text_color]',
                                'type' => 'alphacolor',
                                'label' => esc_html__('TEXT COLOR', 'themo'),
                                'default' => ideothemo_get_themo_default_value('shortcodes.shortcodes_coloring.sc_transparent_dark_text_color'),
                                'description' => __('Text color affects on text font color in shortcodes containing text.', 'themo'),
                                'transport' => 'postMessage',
                            ),
                            array(
                                'id' => 'ideo_theme_options[shortcodes][shortcodes_coloring][sc_transparent_dark_icon_color]',
                                'type' => 'alphacolor',
                                'label' => esc_html__('ICON COLOR', 'themo'),
                                'default' => ideothemo_get_themo_default_value('shortcodes.shortcodes_coloring.sc_transparent_dark_icon_color'),
                                'description' => __('Icon color affects on icon font color in shortcodes containing icon.', 'themo'),
                                'transport' => 'postMessage',
                            ),
                        ),
                    ),
                    array(
                        'id' => 'button_radius',
                        'title' => esc_html__('BUTTON', 'themo'),
                        'controls' => array(
                            array(
                                'id' => 'separator_sc_button_radius',
                                'type' => 'separator',
                                'label' => esc_html__('BUTTON RADIUS', 'themo'),
                                'default' => '',
                                'description' => '',
                                'transport' => 'refresh',
                            ),
                            array(
                                'id' => 'ideo_theme_options[shortcodes][button_radius][button_default_radius]',
                                'type' => 'select',
                                'label' => esc_html__('DEFAULT THEME BUTTONS RADIUS', 'themo'),
                                'default' => ideothemo_get_themo_default_value('shortcodes.button_radius.button_default_radius'),
                                'choices' => array(
                                    'none' => 'None',
                                    'small' => 'Small',
                                    'big' => 'Big',
                                ),
                                'description' => __('Choose button radius which will be used as default for all buttons in shortcodes. Use below pixel sliders to customize radius value for Default button radius type but you can also customize second radius type to use it whenever you want.', 'themo'),
                                'transport' => 'refresh',
                            ),
                            array(
                                'id' => 'ideo_theme_options[shortcodes][button_radius][button_radius_small]',
                                'type' => 'slider',
                                'label' => esc_html__('SMALL RADIUS (px)', 'themo'),
                                'default' => ideothemo_get_themo_default_value('shortcodes.button_radius.button_radius_small'),
                                'choices' => array(
                                    'min' => '0',
                                    'max' => '50',
                                    'step' => '1',
                                ),
                                'description' => '',
                                'transport' => 'postMessage',
                            ),
                            array(
                                'id' => 'ideo_theme_options[shortcodes][button_radius][button_radius_big]',
                                'type' => 'slider',
                                'label' => esc_html__('BIG RADIUS (px)', 'themo'),
                                'default' => ideothemo_get_themo_default_value('shortcodes.button_radius.button_radius_big'),
                                'choices' => array(
                                    'min' => '0',
                                    'max' => '50',
                                    'step' => '1',
                                ),
                                'description' => '',
                                'transport' => 'postMessage',
                            ),
                            array(
                                'id' => 'separator_sc_button_font',
                                'type' => 'separator',
                                'label' => esc_html__('BUTTON FONT', 'themo'),
                                'default' => '',
                                'description' => '',
                                'transport' => 'refresh',
                            ),
                            array(
                                'id' => 'ideo_theme_options[shortcodes][button_font][button_font_family]',
                                'type' => 'select-fonts',
                                'label' => esc_html__('FONT FAMILY', 'themo'),
                                'default' => ideothemo_get_themo_default_value('shortcodes.button_font.button_font_family'),
                                'choices' => ideothemo_get_google_fonts_as_options(true),
                                'description' => '',
                                'transport' => 'postMessage',
                            ),
                            array(
                                'id' => 'ideo_theme_options[shortcodes][button_font][button_font_weight]',
                                'type' => 'select-fonts-weight',
                                'label' => esc_html__('FONT WEIGHT', 'themo'),
                                'default' => ideothemo_get_themo_default_value('shortcodes.button_font.button_font_weight'),
                                'depends' => 'ideo_theme_options[shortcodes][button_font][button_font_family]',
                                'description' => '',
                                'transport' => 'postMessage',
                            ),
                            array(
                                'id' => 'ideo_theme_options[shortcodes][button_font][button_letter_spacing]',
                                'type' => 'text',
                                'label' => esc_html__('LETTER SPACING', 'themo'),
                                'default' => ideothemo_get_themo_default_value('shortcodes.button_font.button_letter_spacing'),
                                'description' => '',
                                'transport' => 'postMessage',
                            ),
                            array(
                                'id' => 'ideo_theme_options[shortcodes][button_font][button_text_transform]',
                                'type' => 'select',
                                'label' => esc_html__('TEXT TRANSFORM', 'themo'),
                                'default' => ideothemo_get_themo_default_value('shortcodes.button_font.button_text_transform'),
                                'choices' => array(
                                    'none' => 'None',
                                    'capitalize' => 'Capitalize',
                                    'uppercase' => 'Uppercase',
                                    'lowercase' => 'Lowercase',
                                ),
                                'description' => '',
                                'transport' => 'postMessage',
                            ),
                        ),
                    ),
                ),
            );