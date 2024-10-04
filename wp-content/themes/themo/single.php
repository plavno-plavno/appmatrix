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

    <style>
        .post-header {
            background-color: var(--mainLightbg);
        }

        .post-header h1 {
            font-size: 32px;
            margin: 0 0 24px 0;
            color: var(--text-header);
        }

        .post-meta {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .logo-author {
            width: 80px;
            height: 80px;
        }

        .author {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .info-author .author-name {
            font-weight: 500;
            font-size: 16px;
            line-height: 1.4;
            color: var(--text-header);
            margin-bottom: 4px;
        }

        .author-position {
            font-size: 16px;
            line-height: 1.4;
            color: var(--secondDarkColor);
            margin-bottom: 4px;
        }

        .post-content-article p {
            font-size: 16px;
            line-height: 1.4;
            color: var(--secondDarkColor);
            margin-bottom: 8px;
        }

        .post-content-article a {
            display: inline !important;
            width: max-content;
            background: linear-gradient(to right, transparent, transparent), linear-gradient(to right, var(--brand---primary), var(--brand---primary), var(--brand---primary));
            background-size: 100% 1px, 0 1px;
            background-position: 100% 100%, 0 100%;
            background-repeat: no-repeat;
            transition: background-size 400ms;
        }

        .post-content-article a:hover {
            transition: all .3s ease-out;
            background-size: 0 1px, 100% 1px;
        }

        .post-content-article h2 {
            color: var(--text-header);
            margin: 24px 0;
        }

        .post-content-article img {
            display: inline-block;
            margin: 32px 0;
        }

        .post-content-article blockquote{
            margin: 16px 0;
            border: none;
            background-color: var(--mainLightbg);
            border-radius: 8px;
            padding: 18px;
        }

        .post-content-article blockquote::before{
            content: '';
            background-image: url("data:image/svg+xml,%3Csvg width='72' height='73' viewBox='0 0 72 73' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Crect y='0.154297' width='72' height='72' rx='12' fill='%23D2AB51'/%3E%3Cpath d='M24.6691 28.5563C22.096 31.349 22.3551 34.9354 22.3632 34.9763L22.3632 45.8854C22.3632 46.247 22.5069 46.5939 22.7626 46.8496C23.0184 47.1054 23.3652 47.249 23.7269 47.249L31.9087 47.249C33.4128 47.249 34.636 46.0258 34.636 44.5217L34.636 34.9763C34.636 34.6146 34.4923 34.2678 34.2366 34.0121C33.9808 33.7563 33.634 33.6127 33.2723 33.6127L29.0751 33.6127C29.1039 32.9385 29.3053 32.283 29.6601 31.709C30.3528 30.6168 31.6578 29.8708 33.541 29.4945L34.636 29.2763L34.636 25.4308L33.2723 25.4308C29.4773 25.4308 26.5823 26.4822 24.6691 28.5563ZM39.6787 28.5563C37.1041 31.349 37.3646 34.9354 37.3728 34.9763L37.3728 45.8854C37.3728 46.247 37.5164 46.5939 37.7722 46.8496C38.0279 47.1054 38.3748 47.249 38.7364 47.249L46.9182 47.249C48.4223 47.249 49.6455 46.0258 49.6455 44.5218L49.6455 34.9763C49.6455 34.6146 49.5018 34.2678 49.2461 34.0121C48.9904 33.7563 48.6435 33.6127 48.2819 33.6127L44.0846 33.6127C44.1134 32.9385 44.3148 32.283 44.6696 31.709C45.3623 30.6168 46.6673 29.8708 48.5505 29.4945L49.6455 29.2763L49.6455 25.4308L48.2819 25.4308C44.4869 25.4308 41.5919 26.4822 39.6787 28.5563Z' fill='white'/%3E%3C/svg%3E%0A");
            display: block;
            width: 72px;
            height: 72px;
            background-position: center;
            background-size: contain;
            background-repeat: no-repeat;
            flex-shrink: 0;
        }

        .post-content-article blockquote h3{
            color: var(--text-header);
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

        .blog-grid-article {
            display: grid;
            gap: 48px;
        }

        .post-content-wrapper {
            margin-bottom: 30px;
        }

        .post-content-menu {
            position: relative;
            order: 0;
        }

        @media (min-width: 768px) {
            .post-header h1 {
                margin-bottom: 40px;
            }

            .post-meta {
                flex-direction: row;
            }

            .post-content-wrapper {
                border: 1px solid var(--border);
                border-radius: 4px;
                padding: 24px;
            }

            .post-content-article blockquote{
                display: flex;
                align-items: center;
                gap: 20px;
            }
            .post-content-article blockquote::before{
                width: 96px;
                height: 96px;
            }
        }

        @media (min-width: 991px) {
            .blog-grid-article {
                grid-template-columns: auto 249px;
            }

            .post-content-article p {
                margin-bottom: 12px;
            }

            .post-content-menu {
                order: 1;
            }

            .post-content-menu .dynamic-menu {
                position: sticky;
                top: 120px
            }
        }

        @media (min-width: 1280px) {
            .author {
                gap: 16px;
            }

            .info-author .author-name, .author-position {
                margin-bottom: 8px;
            }


        }

        @media (min-width: 1440px) {
            .post-header h1 {
                margin-bottom: 48px;
            }

            .post-meta {
                gap: 24px;
            }

            .logo-author {
                width: 88px;
                height: 88px;
            }

            .blog-grid-article {
                grid-template-columns: auto 282px;
            }

            .post-content-article blockquote::before{
                width: 104px;
                height: 104px;
            }
        }

        @media (min-width: 1920px) {
            .post-header h1 {
                margin-bottom: 56px;
            }

            .post-meta {
                gap: 32px;
            }

            .logo-author {
                width: 96px;
                height: 96px;
            }

            .info-author .author-name, .author-position {
                font-size: 18px;
            }

            .blog-grid-article {
                grid-template-columns: auto 392px;
            }

            .post-content-wrapper {
                padding: 32px;
            }

            .post-content-article h2 {
                margin: 32px 0;
            }

            .post-content-article p {
                font-size: 18px;
            }

            .post-content-article blockquote::before{
                width: 112px;
                height: 112px;
            }

            .post-content-article blockquote{
                gap: 24px;
            }
        }

    </style>
<?php
get_footer();
