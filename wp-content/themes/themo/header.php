<?php ideothemo_set_ID();
$id = get_the_ID();

if ($id != 1129) {
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <?php
        if (is_single()) {
            if (has_excerpt()) {
                $meta_description = get_the_excerpt();
            } else {
                $meta_description = wp_trim_words(get_the_content(), 20);
            }
            ?>
            <meta name="description" content="<?php echo esc_attr($meta_description); ?>">
        <?php } ?>

        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?> <?php do_action('ideothemo_body_tag');?> data-id="<?php echo get_the_ID(); ?>" <?php
        ideothemo_local_modifications(
            array(
                'fonts.font_coloring.body_text_skin',
                'generals.layout.boxed_version',
                'generals.background.boxed_background_type',
                'generals.background.content_background_type'
            ))?>>

    <?php do_action('ideothemo_body_entry_before');?>


    <?php get_template_part('parts/transition/header'); ?>

    <?php if (ideothemo_is_advanced_sticky_loading()): ?><div id="ideo-transition-page-container"><?php endif; ?>

        <a id="top"></a>
        <div id="page-container">

            <?php if ( ideothemo_is_boxed_version() ) : ?>
            <div class="container">
            <?php endif; ?>

            <?php get_template_part('parts/header/header'); ?>
            <?php get_template_part('parts/slider/slider'); ?>

            <?php if( !is_page() ): ?>
                <div id="ideo-page" class="<?php echo ideothemo_get_layout_type_class(); ?>">
            <?php endif; ?>
<?php
} else {
?>
    <!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php
	/**
	 * foton_mikado_action_header_meta hook
	 *
	 * @see foton_mikado_header_meta() - hooked with 10
	 * @see foton_mikado_user_scalable_meta - hooked with 10
	 * @see foton_core_set_open_graph_meta - hooked with 10
	 */
	do_action( 'foton_mikado_action_header_meta' );

	wp_head(); ?>
</head>
<body <?php body_class(); ?> data-id="<?php echo get_the_ID(); ?>" itemscope itemtype="http://schema.org/WebPage">
	<?php
	/**
	 * foton_mikado_action_after_body_tag hook
	 *
	 * @see foton_mikado_get_side_area() - hooked with 10
	 * @see foton_mikado_smooth_page_transitions() - hooked with 10
	 */
	do_action( 'foton_mikado_action_after_body_tag' ); ?>

    <div class="mkdf-wrapper">
        <div class="mkdf-wrapper-inner">
            <?php
            /**
             * foton_mikado_action_after_wrapper_inner hook
             *
             * @see foton_mikado_get_header() - hooked with 10
             * @see foton_mikado_get_mobile_header() - hooked with 20
             * @see foton_mikado_back_to_top_button() - hooked with 30
             * @see foton_mikado_get_header_minimal_full_screen_menu() - hooked with 40
             * @see foton_mikado_get_header_bottom_navigation() - hooked with 40
             */
            do_action( 'foton_mikado_action_after_wrapper_inner' ); ?>

            <div class="mkdf-content" <?php foton_mikado_content_elem_style_attr(); ?>>
                <div class="mkdf-content-inner">
				<?php get_template_part('parts/header/header'); ?>
            <?php get_template_part('parts/slider/slider'); ?>

<?php
}
?>
