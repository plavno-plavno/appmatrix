<?php get_header(); ?>
<?php the_post(); ?>

<div id="content" class="it-blog">
    <?php if (!ideothemo_is_boxed_version() && (ideothemo_is_sidebar_enabled() || !has_shortcode(get_the_content(), 'vc_row'))): ?>
    <div class="container">
    <?php endif; ?>
       <div class="row">
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
        </div>

    <?php if (!ideothemo_is_boxed_version() && (ideothemo_is_sidebar_enabled() || !has_shortcode(get_the_content(), 'vc_row'))): ?>
    </div>
    <?php endif; ?>

</div>

<?php get_footer(); ?>
