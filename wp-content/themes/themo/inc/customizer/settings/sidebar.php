<?php
$settings[] = array(
                'id' => 'sidebar',
                'title' => esc_html__('SIDEBAR', 'themo'),
                'sections' => array(
                    array(
                        'id' => 'sidebar_settings',
                        'title' => esc_html__('SETTINGS', 'themo'),
                        'controls' => array(
                            array(
                                'id' => 'ideo_theme_options[sidebar][sidebar_settings][sidebar_global]',
                                'type' => 'select',
                                'label' => esc_html__('GLOBAL SIDEBAR', 'themo'),
                                'default' => ideothemo_get_themo_default_value('sidebar.sidebar_settings.sidebar_global'),
                                'choices' => array(
                                    'none' => 'No sidebar',
                                    'left_sidebar' => 'Left sidebar',
                                    'right_sidebar' => 'Right sidebar',
                                ),
                                'description' => __('Choose between Left or Right sidebar position or choose No sidebar if you do not want to display sidebar on your site.', 'themo'),
                                'transport' => 'refresh',
                            ),
                            array(
                                'id' => 'ideo_theme_options[sidebar][sidebar_settings][sidebar_choose]',
                                'type' => 'select',
                                'label' => esc_html__('CHOOSE SIDEBAR', 'themo'),
                                'default' => ideothemo_get_themo_default_value('sidebar.sidebar_settings.sidebar_choose'),
                                'choices' => ideothemo_get_sidebars(),
                                'description' => __('Choose from dropdown one of sidebars you have created in WordPress widgets panel.', 'themo'),
                                'transport' => 'refresh',
                            ),
                            array(
                                'id' => 'ideo_theme_options[sidebar][sidebar_settings][sidebar_skin]',
                                'type' => 'select',
                                'label' => esc_html__('SIDEBAR SKIN', 'themo'),
                                'default' => ideothemo_get_themo_default_value('sidebar.sidebar_settings.sidebar_skin'),
                                'choices' => array(
                                    '' => 'Default',
                                    'light' => 'Light',
                                    'dark' => 'Dark',
                                ),
                                'description' => __('Choose between Light and Dark Sidebar skin or choose Default to use Customizer setting. Light skin means light content (fonts) and Dark skin means dark content (fonts).', 'themo'),
                                'transport' => 'postMessage',
                            ),
                        ),
                    ),
                    array(
                        'id' => 'sidebar_coloring',
                        'title' => esc_html__('COLORING', 'themo'),
                        'controls' => array(
                            array(
                                'id' => 'separator_sidebar_light',
                                'type' => 'separator',
                                'label' => esc_html__('LIGHT SKIN', 'themo'),
                                'default' => '',
                                'description' => '',
                                'transport' => 'refresh',
                            ),
                            array(
                                'id' => 'ideo_theme_options[sidebar][sidebar_coloring][sidebar_light_accent_color]',
                                'type' => 'alphacolor',
                                'label' => esc_html__('ACCENT COLOR', 'themo'),
                                'default' => ideothemo_get_themo_default_value('sidebar.sidebar_coloring.sidebar_light_accent_color'),
                                'description' => '',
                                'transport' => 'postMessage',
                            ),
                            array(
                                'id' => 'ideo_theme_options[sidebar][sidebar_coloring][sidebar_light_titles_color]',
                                'type' => 'alphacolor',
                                'label' => esc_html__('TITLES COLOR', 'themo'),
                                'default' => ideothemo_get_themo_default_value('sidebar.sidebar_coloring.sidebar_light_titles_color'),
                                'description' => '',
                                'transport' => 'postMessage',
                            ),
                            array(
                                'id' => 'ideo_theme_options[sidebar][sidebar_coloring][sidebar_light_text_color]',
                                'type' => 'alphacolor',
                                'label' => esc_html__('TEXT COLOR', 'themo'),
                                'default' => ideothemo_get_themo_default_value('sidebar.sidebar_coloring.sidebar_light_text_color'),
                                'description' => '',
                                'transport' => 'postMessage',
                            ),
                            array(
                                'id' => 'separator_sidebar_dark',
                                'type' => 'separator',
                                'label' => esc_html__('DARK SKIN', 'themo'),
                                'default' => '',
                                'description' => '',
                                'transport' => 'refresh',
                            ),
                            array(
                                'id' => 'ideo_theme_options[sidebar][sidebar_coloring][sidebar_dark_accent_color]',
                                'type' => 'alphacolor',
                                'label' => esc_html__('ACCENT COLOR', 'themo'),
                                'default' => ideothemo_get_themo_default_value('sidebar.sidebar_coloring.sidebar_dark_accent_color'),
                                'description' => '',
                                'transport' => 'postMessage',
                            ),
                            array(
                                'id' => 'ideo_theme_options[sidebar][sidebar_coloring][sidebar_dark_titles_color]',
                                'type' => 'alphacolor',
                                'label' => esc_html__('TITLES COLOR', 'themo'),
                                'default' => ideothemo_get_themo_default_value('sidebar.sidebar_coloring.sidebar_dark_titles_color'),
                                'description' => '',
                                'transport' => 'postMessage',
                            ),
                            array(
                                'id' => 'ideo_theme_options[sidebar][sidebar_coloring][sidebar_dark_text_color]',
                                'type' => 'alphacolor',
                                'label' => esc_html__('TEXT COLOR', 'themo'),
                                'default' => ideothemo_get_themo_default_value('sidebar.sidebar_coloring.sidebar_dark_text_color'),
                                'description' => '',
                                'transport' => 'postMessage',
                            ),
                        ),
                    ),
                    array(
                        'id' => 'sidebar_widgets_title_font',
                        'title' => esc_html__('WIDGETS TITLE FONT', 'themo'),
                        'controls' => array(
                            array(
                                'id' => 'ideo_theme_options[sidebar][sidebar_widgets_title_font][sidebar_title_font_size]',
                                'type' => 'text',
                                'label' => esc_html__('FONT SIZE (px)', 'themo'),
                                'default' => ideothemo_get_themo_default_value('sidebar.sidebar_widgets_title_font.sidebar_title_font_size'),
                                'description' => '',
                                'transport' => 'postMessage',
                            ),
                            array(
                                'id' => 'ideo_theme_options[sidebar][sidebar_widgets_title_font][sidebar_title_line_height]',
                                'type' => 'text',
                                'label' => esc_html__('LINE HEIGHT', 'themo'),
                                'default' => ideothemo_get_themo_default_value('sidebar.sidebar_widgets_title_font.sidebar_title_line_height'),
                                'description' => '',
                                'transport' => 'postMessage',
                            ),
                            array(
                                'id' => 'ideo_theme_options[sidebar][sidebar_widgets_title_font][sidebar_title_font_family]',
                                'type' => 'select-fonts',
                                'label' => esc_html__('FONT FAMILY', 'themo'),
                                'default' => ideothemo_get_themo_default_value('sidebar.sidebar_widgets_title_font.sidebar_title_font_family'),
                                'description' => '',
                                'transport' => 'postMessage',
                            ),
                            array(
                                'id' => 'ideo_theme_options[sidebar][sidebar_widgets_title_font][sidebar_title_font_weight]',
                                'type' => 'select-fonts-weight',
                                'label' => esc_html__('FONT WEIGHT', 'themo'),
                                'default' => ideothemo_get_themo_default_value('sidebar.sidebar_widgets_title_font.sidebar_title_font_weight'),
                                'depends' => 'ideo_theme_options[sidebar][sidebar_widgets_title_font][sidebar_title_font_family]',
                                'description' => '',
                                'transport' => 'postMessage',
                            ),
                            array(
                                'id' => 'ideo_theme_options[sidebar][sidebar_widgets_title_font][sidebar_title_letter_spacing]',
                                'type' => 'text',
                                'label' => esc_html__('LETTER SPACING', 'themo'),
                                'default' => ideothemo_get_themo_default_value('sidebar.sidebar_widgets_title_font.sidebar_title_letter_spacing'),
                                'description' => '',
                                'transport' => 'postMessage',
                            ),
                        ),
                    ),
                ),
            );