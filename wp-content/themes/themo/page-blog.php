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
        <div class="load-more">
            <button id="load-more">Show more ↓</button>
        </div>
    </div>
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

    .post-item a {
        display: flex;
        height: 100%;
        flex-direction: column;
    }

    .post-content h3 {
        margin: 0;
        color: var(--text-header);
        position: relative;
        padding-right: 40px;
        width: 100%;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .post-item .post-content {
        flex-grow: 1;
    }

    .post-content h3::after {
        right: 7px;
    }


    .post-content{
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        gap: 12px;
        padding: 20px  18px;
    }

    .post-thumbnail img {
        width: 100%;
        height: auto;
    }

    .post-content h3 + p {
        font-size: 16px;
        color: var(--secondDarkColor);
    }

    .load-more {
        text-align: center;
        margin-top: 40px;
    }

    .load-more button {
        padding: 0;
        background-color: transparent;
        border: none;
        cursor: pointer;
        font-size: 16px;
        font-weight: 500;
        color: var(--primary-btn);
        position: relative;
    }

    .load-more button::after {
        content: "";
        display: block;
        background-image: url("data:image/svg+xml;charset=UTF-8,%3Csvg width=%2224%22 height=%2224%22 viewBox=%220 0 24 24%22 fill=%22none%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cpath d=%22M12 5V19%22 stroke=%22%EAC571%22 stroke-width=%222%22 stroke-linecap=%22round%22 stroke-linejoin=%22round%22/%3E%3Cpath d=%22M19 12L12 19L5 12%22 stroke=%22%EAC571%22 stroke-width=%222%22 stroke-linecap=%22round%22 stroke-linejoin=%22round%22/%3E%3C/svg%3E");
        width: 24px;
        height: 24px;
        background-position: center;
        background-size: contain;
        background-repeat: no-repeat;
        flex-shrink: 0;
        position: absolute;
        right: 25px;
        top: 50%;
        transform: translateY(-50%);
    }

    .load-more button:hover {
        color: var(--primary);
    }

    @media (min-width: 1440px) {
        .post-content{
            gap: 16px;
        }
    }
    @media (min-width: 192px) {
        .post-content h3 + p {
            font-size: 18px;
        }
    }

</style>

<?php get_footer(); ?>
