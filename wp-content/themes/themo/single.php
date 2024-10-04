<?php

get_header();

function display_authors($authors)
{
    foreach ($authors as $author) {
        ?>
        <div class="author">
            <img class="logo-author" src="<?php echo esc_url($author['logo']); ?>"
                 alt="<?php echo esc_attr($author['name']); ?>">
            <div class="info-author">
                <div class="author-name"><?php echo esc_html($author['name']); ?></div>
                <div class="author-position"><?php echo esc_html($author['position_at_work']); ?></div>
                <div class="social">
                    <?php foreach ($author['social'] as $social) { ?>
                        <a href="<?php echo esc_url($social['link']); ?>">
                            <img src="<?php echo esc_url($social['ico']); ?>" alt="">
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php
    }
}

?>


    <div class="post-header">
        <div class="padding-block">
            <div class="common-page-width">
                <div class="container">

                    <h1 class="title"><?php the_title(); ?></h1>
                    <div class="post-meta authors">
                        <?php
                        $authors = get_field('authors', get_the_ID());

                        display_authors($authors);
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--    <div class="post-featured-image">-->
    <!--        --><?php //if (has_post_thumbnail()) : ?>
    <!--            --><?php //the_post_thumbnail('large'); ?>
    <!--        --><?php //endif; ?>
    <!--    </div>-->


    <div class="post-content-block padding-block padding-block-y process-section">
        <div class="container">
            <div class="blog-grid-article">
                <div class="post-content-wrapper">
                    <div class="post-content-article">
                        <?php
                        while (have_posts()) : the_post();
                            echo add_anchors_to_headings(get_the_content());
                        endwhile;
                        ?>
                    </div>
                    <?php
                    display_authors($authors);
                    ?>

                </div>
                <div class="post-content-menu">
                    <?php echo dynamic_content_menu(); ?>
                </div>
            </div>
        </div>
    </div>

    <?php echo latest_posts_carousel_shortcode(); ?>


    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const menuItems = document.querySelectorAll('.dynamic-menu a');
            const headings = document.querySelectorAll('h1, h2, h3, h4, h5, h6');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const id = entry.target.getAttribute('id');
                        document.querySelector('.dynamic-menu a.active')?.classList.remove('active');
                        document.querySelector(`.dynamic-menu a[href="#${id}"]`)?.classList.add('active');
                    }
                });
            }, {
                threshold: 0.5
            });

            headings.forEach(heading => {
                observer.observe(heading);
            });
        });

    </script>
<?php
get_footer();
