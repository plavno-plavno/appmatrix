<?php if (ideothemo_is_topbar_enabled()) : ?>
<?php
    $top_width = ideothemo_get_header_setting('top.width');

    ob_start();
    if ($top_width === 'custom') {
        ideothemo_setting_class('top.custom_width', 'custom'); // Вывод через echo
        $top_width_class = ob_get_clean(); // Захватываем вывод в переменную
    } elseif ($top_width === 'container' && !ideothemo_is_boxed_version()) {
        $top_width_class = 'container';
    } else {
        $top_width_class = '';
    }

    $topbar_mobile_hidden = !ideothemo_get_header_true('top.topbar_mobile') ? ' hidden-xs hidden-sm' : '';

?>

    <div id="topbar"
         class="<?php echo $top_width_class . $topbar_mobile_hidden;  ?>">
        <div class="row">
            <div id="topbar-content">
                <div class="col-sm-6 col-left"><?php if (is_active_sidebar('header-topbar-left')) {
                        dynamic_sidebar('header-topbar-left');
                    } ?></div>
                <div class="col-sm-6 col-right"><?php if (is_active_sidebar('header-topbar-right')) {
                        dynamic_sidebar('header-topbar-right');
                    } ?></div>
            </div>
        </div>
    </div>
<?php endif; ?>
