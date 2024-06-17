<?php
function custom_menu_template($theme_location) {
    if (($theme_location) && ($locations = get_nav_menu_locations()) && isset($locations[$theme_location])) {
        $menu = wp_get_nav_menu_object($locations[$theme_location]);
        $menu_items = wp_get_nav_menu_items($menu->term_id);

        $menu_list = '<nav><ul>';
        $submenu = false;
        $submenu_col = false;
        $parent_id = 0;
        $sub_parent_id = 0;

        foreach ($menu_items as $item) {
            $link = $item->url;
            $title = $item->title;
            $classes = implode(' ', $item->classes);

            // Добавляем класс текущей страницы, если это текущая страница
            if (in_array('current-menu-item', $item->classes)) {
                $classes .= ' disabled';
            }

            // Первый уровень меню
            if (!$item->menu_item_parent) {
                if ($submenu) {
                    if ($submenu_col) {
                        $menu_list .= '</div>'; // Закрываем предыдущую подколонку второго уровня
                    }
                    $menu_list .= '</div></li>'; // Закрываем предыдущий родительский элемент первого уровня
                    $submenu = false;
                    $submenu_col = false;
                }
                $parent_id = $item->ID;
                $has_children = false;

                // Проверяем, есть ли у текущего элемента дети
                foreach ($menu_items as $submenu_item) {
                    if ($submenu_item->menu_item_parent == $parent_id) {
                        $has_children = true;
                        break;
                    }
                }

                if ($has_children) {
                    $menu_list .= '<li class="dropdown-li">';
                    $menu_list .= '<div class="menu-link"><span>' . $title . '</span>';
                    $menu_list .= '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6 9L12 15L18 9" stroke="#9296A4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></div>';
                } else {
                    $menu_list .= '<li>';
                    $menu_list .= '<a class="menu-link ' . $classes . '" href="' . $link . '">' . $title . '</a>';
                }
            }

            // Второй уровень меню
            if ($parent_id == $item->menu_item_parent) {
                if (!$submenu) {
                    $menu_list .= '<div class="sub-menu container-block">';
                    $submenu = true;
                }
                if ($submenu_col) {
                    $menu_list .= '</div>'; // Закрываем предыдущую подколонку второго уровня
                }
                $menu_list .= '<div class="sub-column">';
                $submenu_col = true;
                $sub_parent_id = $item->ID;

                $has_sub_children = false;
                foreach ($menu_items as $sub_submenu_item) {
                    if ($sub_submenu_item->menu_item_parent == $sub_parent_id) {
                        $has_sub_children = true;
                        break;
                    }
                }

                if ($has_sub_children) {
                    if ($item->link) {
                        $menu_list .= '<p class="sub-title">' . $title . '</p>';
                        $menu_list .= '<ul>';
                    } else {
                        $menu_list .= '<ul>';
                        $menu_list .= '<li><a href="' . $link . '" class="link-menu">' . $title . '</a></li>';
                    }


                    foreach ($menu_items as $sub_submenu_item) {
                        if ($sub_submenu_item->menu_item_parent == $sub_parent_id) {
                            $sub_link = $sub_submenu_item->url;
                            $sub_title = $sub_submenu_item->title;
                            $sub_classes = implode(' ', $sub_submenu_item->classes);

                            // Добавляем класс текущей страницы, если это текущая страница
                            if (in_array('current-menu-item', $sub_submenu_item->classes)) {
                                $sub_classes .= ' disabled';
                            }

                            $menu_list .= '<li><a href="' . $sub_link . '" class="link-menu ' . $sub_classes . '">' . $sub_title . '</a></li>';
                        }
                    }
                    $menu_list .= '</ul>';
                } else {
                    $menu_list .= '<ul>';
                    $menu_list .= '<li><a href="' . $link . '" class="link-menu ' . $classes . '">' . $title . '</a></li>';
                    $menu_list .= '</ul>';
                }
            }
        }

        if ($submenu) {
            if ($submenu_col) {
                $menu_list .= '</div>'; // Закрываем последнюю подколонку второго уровня
            }
            $menu_list .= '</div></li>'; // Закрываем последний родительский элемент первого уровня
        }

        $menu_list .= '</ul></nav>';
    } else {
        // Если меню не найдено
        $menu_list = '<nav><ul><li>No menu items found.</li></ul></nav>';
    }

    echo $menu_list;
}

function custom_mobile_menu_template($theme_location) {
    if (($theme_location) && ($locations = get_nav_menu_locations()) && isset($locations[$theme_location])) {
        $menu = wp_get_nav_menu_object($locations[$theme_location]);
        $menu_items = wp_get_nav_menu_items($menu->term_id);

        $menu_list = '<ul class="menu-list">';
        $submenu = false;
        $submenu_col = false;
        $parent_id = 0;
        $sub_parent_id = 0;

        foreach ($menu_items as $item) {
            $link = $item->url;
            $title = $item->title;
            $classes = implode(' ', $item->classes);

            // Добавляем класс текущей страницы, если это текущая страница
            if (in_array('current-menu-item', $item->classes)) {
                $classes .= ' disabled';
            }

            // Первый уровень меню
            if (!$item->menu_item_parent) {
                if ($submenu) {
                    if ($submenu_col) {
                        $menu_list .= '</div>'; // Закрываем предыдущую подколонку второго уровня
                    }
                    $menu_list .= '</div></li>'; // Закрываем предыдущий родительский элемент первого уровня
                    $submenu = false;
                    $submenu_col = false;
                }
                $parent_id = $item->ID;
                $has_children = false;

                // Проверяем, есть ли у текущего элемента дети
                foreach ($menu_items as $submenu_item) {
                    if ($submenu_item->menu_item_parent == $parent_id) {
                        $has_children = true;
                        break;
                    }
                }

                if ($has_children) {
                    $menu_list .= '<li>';
                    $menu_list .= '<div class="acc-services"><div>' . $title . '</div>';
                    $menu_list .= '<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6 9L12 15L18 9" stroke="#9296A4" stroke-width="2" stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                </svg>
                                </div>';
                } else {
                    $menu_list .= '<li>';
                    $menu_list .= '<a href="' . $link . '">' . $title . '</a>';
                }
            }

            // Второй уровень меню
            if ($parent_id == $item->menu_item_parent) {
                if (!$submenu) {
                    $menu_list .= '<div class="panel-mobile">';
                    $submenu = true;
                }
                if ($submenu_col) {
                    $menu_list .= '</div>'; // Закрываем предыдущую подколонку второго уровня
                }
                $menu_list .= '<div class="sub-menu-list__mob">';
                $submenu_col = true;
                $sub_parent_id = $item->ID;

                $has_sub_children = false;
                foreach ($menu_items as $sub_submenu_item) {
                    if ($sub_submenu_item->menu_item_parent == $sub_parent_id) {
                        $has_sub_children = true;
                        break;
                    }
                }

                if ($has_sub_children) {
                    if ($item->link) {
                        $menu_list .= '<p class="mob-menu-title">' . $title . '</p>';
                        $menu_list .= '<ul>';
                    } else {
                        $menu_list .= '<ul>';
                        $menu_list .= '<li><a href="' . $link . '" class="link-menu">' . $title . '</a></li>';
                    }


                    foreach ($menu_items as $sub_submenu_item) {
                        if ($sub_submenu_item->menu_item_parent == $sub_parent_id) {
                            $sub_link = $sub_submenu_item->url;
                            $sub_title = $sub_submenu_item->title;
                            $sub_classes = implode(' ', $sub_submenu_item->classes);

                            // Добавляем класс текущей страницы, если это текущая страница
                            if (in_array('current-menu-item', $sub_submenu_item->classes)) {
                                $sub_classes .= ' disabled';
                            }

                            $menu_list .= '<li><a href="' . $sub_link . '" class="' . $sub_classes . '">' . $sub_title . '</a></li>';
                        }
                    }
                    $menu_list .= '</ul>';
                } else {
                    $menu_list .= '<ul>';
                    $menu_list .= '<li><a href="' . $link . '" class=" ' . $classes . '">' . $title . '</a></li>';
                    $menu_list .= '</ul>';
                }
            }
        }

        if ($submenu) {
            if ($submenu_col) {
                $menu_list .= '</div>'; // Закрываем последнюю подколонку второго уровня
            }
            $menu_list .= '</div></li>'; // Закрываем последний родительский элемент первого уровня
        }

        $menu_list .= '</ul>';
    } else {
        // Если меню не найдено
        $menu_list = '<ul><li>No menu items found.</li></ul>';
    }

    echo $menu_list;
}

?>

<header id="header-navbar" class="header padding-block">
    <div class="container-block">
        <a href="/" class="header-logo">
            <picture>
                <img loading="lazy" src="/wp-content/uploads/2024/06/Qatsol-mobile.svg" alt="AI Chat">
            </picture>
        </a>
        <div class="nav-cta-block">


            <?php custom_menu_template(ideothemo_get_header_setting('menu_location') ?: 'main-menu'); ?>
            <div class="call-to-action-link">
                <a href="/contact/" class="ca-btn-header">
                    <span>Contact us</span>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 12H19" stroke="#1D1E22" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round"/>
                        <path d="M12 5L19 12L12 19" stroke="#1D1E22" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>
        </div>
        <button class="navigation-hamburger" id="openMenu">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <div class="menu-burger" id="burgerMenu">
            <div class="menu-info__wrapper">
                <nav class="menu-nav">
                    <?php custom_mobile_menu_template(ideothemo_get_header_setting('menu_location') ?: 'main-menu'); ?>
                    <div class="mobile-menu-bottom">
                        <a  href="/contact/"
                            class="button flat radius-small size-medium align-center  block colored-light primary-main-btn "
                            data-id="button-662a83cebac1a"><span>Contact us</span></a>
                    </div>
                </nav>
            </div>
        </div>
    </div>

</header>
