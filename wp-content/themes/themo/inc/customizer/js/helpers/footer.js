(function($){
    var namespace = $.fn.ideo;

    if(typeof window.parent.wp.customize.get()['data_refresh'] === 'undefined') return;

    namespace.setFooterBackground = function(settings) {
        var bgSettings = {};
        bgSettings.overlay = {};
        
        bgSettings.type = settings['ideo_theme_options[footer][standard_footer_background][footer_background_type]'];
        
        
        if ('color' === bgSettings.type) {
            bgSettings.overlay.type = settings['ideo_theme_options[footer][standard_footer_background][footer_background_color_overlay]'];
            bgSettings.color = settings['ideo_theme_options[footer][standard_footer_background][footer_background_color]'];
            bgSettings.overlay.color = settings['ideo_theme_options[footer][standard_footer_background][footer_background_color_overlay_color]'];
            bgSettings.overlay.patternColor = settings['ideo_theme_options[footer][standard_footer_background][footer_background_color_pattern_color]'];
            bgSettings.overlay.pattern = settings['ideo_theme_options[footer][standard_footer_background][footer_background_color_pattern]'];
        }
        
        if ('image' === bgSettings.type) {
            bgSettings.image = settings['ideo_theme_options[footer][standard_footer_background][footer_background_upload_image]'];
            bgSettings.size = settings['ideo_theme_options[footer][standard_footer_background][footer_background_cover]'];
            bgSettings.position = settings['ideo_theme_options[footer][standard_footer_background][footer_background_image_position]'];
            bgSettings.repeat = settings['ideo_theme_options[footer][standard_footer_background][footer_background_image_repeat]'];
            bgSettings.overlay.type = settings['ideo_theme_options[footer][standard_footer_background][footer_background_image_overlay]'];
            bgSettings.overlay.color = settings['ideo_theme_options[footer][standard_footer_background][footer_background_image_overlay_color]'];
            bgSettings.overlay.patternColor = namespace.getCustomizerSetting('ideo_theme_options[footer][standard_footer_background][footer_background_image_overlay_pattern_color]');
            bgSettings.overlay.pattern = namespace.getCustomizerSetting('ideo_theme_options[footer][standard_footer_background][footer_background_image_overlay_pattern]');
        }
        
        namespace.setBackgroundByType('body.skin-light #footer-container.type-standard', bgSettings);
        namespace.setBackgroundByType('body.skin-dark #footer-container.type-standard', bgSettings);
    };
    
    namespace.setFooterLightAccentColor = function(color, className) {
        var base = '#footer-content.' + className;
        namespace.setWidgetAccentColor(color, base);
    };

    namespace.setFooterTitleColor = function(color, className) {
        var base = '#footer-content.' + className;
        namespace.setWidgetTitleColor(color, base);
    };

    namespace.setFooterTextColor = function(color, className) {
        var base = '#footer-content.' + className;
        namespace.setWidgetTextColor(color, base);
    };
    
    namespace.setFooterBackgroundColor = function(color, extraSelector) {
        namespace.setBackgroundColor( '#footer-container.type-standard.background-type-color' + extraSelector, color );
    };
})(jQuery);

