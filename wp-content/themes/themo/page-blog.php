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

<div class="post-grid" id="post-grid">
    <?php
    $posts_per_page = 9;
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => $posts_per_page,
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
<?php
    if ($blog_posts->found_posts > $posts_per_page) :
?>
    <div class="load-more">
        <button id="load-more">Show more ↓</button>
    </div>

<?php endif; ?>

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


    .post-content {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        gap: 12px;
        padding: 20px 18px;
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
        margin-top: 40px;
        display: flex;
        justify-content: center;
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
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .load-more button::after {
        content: "";
        display: block;
        background-image: url("data:image/svg+xml,%3Csvg width='24' height='24' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M12 5V19' stroke='%23EAC571' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/%3E%3Cpath d='M19 12L12 19L5 12' stroke='%23EAC571' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E%0A");
        width: 24px;
        height: 24px;
        background-position: center;
        background-size: contain;
        background-repeat: no-repeat;
        flex-shrink: 0;

    }

    .load-more button:hover {
        color: var(--primary);
    }

    @media (min-width: 1440px) {
        .post-content {
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
