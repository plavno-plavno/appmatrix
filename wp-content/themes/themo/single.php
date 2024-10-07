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
                            echo apply_filters('the_content', add_anchors_to_headings(get_the_content()));
                        endwhile;
                        ?>
                    </div>
                    <div class="post-meta authors">
                        <?php
                        display_authors($authors);
                        ?>
                    </div>

                </div>
                <div class="post-content-menu">
                    <?php echo dynamic_content_menu(); ?>
                </div>
            </div>
        </div>
    </div>


<?php echo latest_posts_carousel_shortcode(); ?>

    <div id="contactUsFormBlock" class="vc_page_section vc_page_section_  padding-block padding-block-y skin-dark">
        <div class="container">
            <div class="row">
                <div id="aboutUsContactForm" class="vc_row_inner vc_row">
                    <div class="vc_col-sm-6 vc_column_inner contact-form-col-1">
                        <div class="wpb_wrapper">
                            <div class="form-img-bg">
                                <div class="ideo-single-image">
                                    <img src="https://qatsol.com/wp-content/uploads/2024/06/Group-1.webp"
                                         class="form-img-bg" alt="form">
                                </div>
                            </div>
                            <div class="h2-tag blog-h2-tag">
                                <p>[ contact us ]</p>
                            </div>
                            <div class="h2-title light-text">
                                <h2 class="title transparent-dark ideo-wow-title light-text">
                                    <span>Let’s Talk!</span>
                                </h2></div>

                            <div class="main-text light-text form-info-text" style="font-size: 18px; line-height: 1.4; position: relative; z-index: 2">
                                <p>For sales and general inquiries:</p>
                                <img src="/wp-content/uploads/2024/06/Mail.svg" width="24" height="24" alt="Mail Icon">
                                <a href="mailto:contact@qatsol.com">contact@qatsol.com</a>
                            </div>
                        </div>
                    </div>
                    <div class="vc_column_inner contact-form-col-2" style="width: 50%;">
                        <div class="contact-form">
                            <?php echo do_shortcode('[contact-form-7 id="ec6f1e0" title="Kontaktformular AppMatrix_EN"]'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const menuItems = document.querySelectorAll('.dynamic-menu a');
            const headings = document.querySelectorAll(' h2');

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
