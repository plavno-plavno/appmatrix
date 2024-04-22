<div class="socials"<?php ideothemo_customize_attrs(false, ideothemo_blog_social_enabled('', false)); ?>>
    <div class="symbol"><i class="fa fa-share-alt"></i></div>
    <ul>
        <?php

        foreach (get_list_enabled_social_media() AS $social) : ?>

            <li<?php ideothemo_customize_attrs(false, ideothemo_get_enabled_social_media($social, false, false)); ?>>
                <?php
                echo ideothemo_get_social_share(array($social), get_permalink(), get_the_title(), get_the_excerpt(), '', false, 'blog');
                ?>
            </li>

        <?php endforeach; ?>
        <?php  //ADD SOCIAL MANUAL  ?>
        <!-- <li><a class="js--social-share" target="_blank" data-toggle="tooltip" href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Flocalhost%2Fthemo%2Fblog%2F2017%2F06%2F21%2Fwitaj-swiecie%2F&amp;t=Witaj,%20świecie!"><i class="fa fa-facebook"></i></a></li> -->
        <?php  //ADD SOCIAL MANUAL ?>
    </ul>
</div>