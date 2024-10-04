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
                <span class="title"><?php echo esc_html($author['name']); ?></span>
                <span class="add-title"><?php echo esc_html($author['position_at_work']); ?></span>
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

    <div class="single-post-wrapper">

        <div class="padding-block">
            <div class="common-page-width">
                <div class="container">
                    <div class="post-header">
                        <h1><?php the_title(); ?></h1>
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

        <div class="post-featured-image">
            <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('large'); ?>
            <?php endif; ?>
        </div>


        <div class="post-content-block">
            <div class="post-content-menu">
                <?php echo dynamic_content_menu(); ?>
            </div>
            <div class="post-content">
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

        <div class="latest-posts-carousel swiper-container">
            <h3>Our latest insights</h3>
            <div class="swiper-wrapper">
                <?php
                $recent_args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 6
                );
                $recent_posts = new WP_Query($recent_args);

                if ($recent_posts->have_posts()) :
                    while ($recent_posts->have_posts()) : $recent_posts->the_post(); ?>
                        <div class="swiper-slide">
                            <a href="<?php the_permalink(); ?>">
                                <div class="carousel-thumbnail">
                                    <?php if (has_post_thumbnail()) {
                                        the_post_thumbnail('medium');
                                    } else { ?>
                                        <img src="<?php echo get_template_directory_uri(); ?>/images/placeholder.png"
                                             alt="Placeholder">
                                    <?php } ?>
                                </div>
                                <div class="carousel-content">
                                    <h3><?php the_title(); ?></h3>
                                    <p><?php the_time('d.m.Y'); ?></p>
                                </div>
                            </a>
                        </div>
                    <?php endwhile;
                endif;

                wp_reset_postdata();
                ?>
            </div>


            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>

    </div>

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

    <style>

        .single-post-wrapper {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .post-header h1 {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .post-meta {
            color: #777;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .post-featured-image {
            margin-bottom: 20px;
        }

        .post-content-block {
            line-height: 1.8;
            font-size: 18px;
            color: #333;
        }

        .post-social-share span {
            font-weight: bold;
            margin-right: 10px;
        }

        .post-social-share a {
            margin-right: 15px;
            color: #0073aa;
        }

        .post-social-share a:hover {
            text-decoration: underline;
        }


        .latest-posts-carousel h3 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .related-post-item img {
            width: 100%;
            height: auto;
            margin-bottom: 10px;
        }

        .related-post-item h4 {
            font-size: 16px;
            color: #333;
        }

        .latest-posts-carousel {
            margin: 40px 0;
            position: relative;
            width: 100%;
        }

        .swiper-wrapper {
            display: flex;
        }

        .swiper-slide {
            width: 250px;
            background-color: #f5f5f5;
            margin-right: 20px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .carousel-thumbnail img {
            width: 100%;
            height: auto;
        }

        .carousel-content {
            padding: 15px;
        }

        .carousel-content h3 {
            font-size: 16px;
            margin: 0 0 10px;
        }

        .carousel-content p {
            font-size: 12px;
            color: #777;
        }


        .swiper-button-next, .swiper-button-prev {
            color: #333;
            width: 44px;
            height: 44px;
        }


    </style>
<?php
get_footer();
