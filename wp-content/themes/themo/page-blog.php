<?php
/*
 * Template Name: Blog Page with Grid and AJAX Load
 */

get_header(); ?>

<div class="blog-header">
    <div class="padding-block banner-about dark-block">
        <div class="common-page-width">
            <div class="container">
                <div class="banner-grid-container">
                    <div class="hero-content vc_col-sm-8 hero-common-left">
                        <div class="h1-title hero-title">
                            <h1 class="title">
                                <span><?php the_title(); ?></span>
                            </h1>
                        </div>
                        <div class="hero-common-text hero-sub-text column-text">
                            <p><?php the_content(); ?></p>
                        </div>
                    </div>
                    <div class="vc_col-sm-4 hero-common-right"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="padding-block padding-block-y process-section" id="post-grid">
    <div class="container">
        <div class="post-grid">
        <?php
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 9,
            'paged' => 1
        );
        $blog_posts = new WP_Query($args);

        if ($blog_posts->have_posts()) :
            while ($blog_posts->have_posts()) : $blog_posts->the_post(); ?>
                <div class="post-item">
                    <a href="<?php the_permalink(); ?>">
                        <div class="post-thumbnail">
                            <?php if (has_post_thumbnail()) {
                                the_post_thumbnail('medium');
                            } else { ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/images/placeholder.png"
                                     alt="Placeholder">
                            <?php } ?>
                        </div>
                        <div class="post-content">
                            <h2><?php the_title(); ?></h2>
                            <p><?php the_time('d.m.Y'); ?></p>
                        </div>
                    </a>
                </div>
            <?php endwhile;
        endif;

        wp_reset_postdata();
        ?>
        </div>
    </div>
</div>

<div class="load-more">
    <button id="load-more">Show more ↓</button>
</div>

<script type="text/javascript">
    var ajaxUrl = "<?php echo admin_url('admin-ajax.php'); ?>";
    var page = 2;

    document.getElementById('load-more').addEventListener('click', function () {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', ajaxUrl, true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');

        xhr.onload = function () {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    document.getElementById('post-grid').insertAdjacentHTML('beforeend', response.data);
                    page++;
                } else {
                    document.getElementById('load-more').style.display = 'none';
                }
            }
        };

        xhr.send('action=load_more_posts&page=' + page);
    });
</script>

<style>

    .post-thumbnail img {
        width: 100%;
        height: auto;
    }

    .post-content {
        padding: 15px;
    }

    .post-content h2 {
        font-size: 18px;
        margin: 0 0 10px;
    }

    .post-content p {
        font-size: 14px;
        color: #777;
    }

    .load-more {
        text-align: center;
        margin-top: 30px;
    }

    #load-more {
        padding: 10px 20px;
        background-color: #333;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    #load-more:hover {
        background-color: #555;
    }

</style>

<?php get_footer(); ?>
