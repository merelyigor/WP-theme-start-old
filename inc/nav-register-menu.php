<?php
/**
 * Регистрация меню + убираем контейнер + убираю классы и id элементов меню
 * в данном примере регистрирует три меню - Главное меню - Верхнее меню - Нижнее меню
 * для вывода меню по названию вставте --- <?php wp_nav_menu( array('main-menu' => 'Главное меню' )); ?> --- выведет меню с названием Главное меню
 * для вывода верхнего меню вставте --- <?php wp_nav_menu('menu_class=bmenu&theme_location=top'); ?>
 * для вывода нижнего меню вставте --- <?php wp_nav_menu('menu_class=bmenu&theme_location=bottom'); ?>
 * ---------------------------------------------------------------------------------------------------------------------
 */


register_nav_menus( array(
    'primary' => __( 'Primary Menu', 'theme-name' ), //Название идентификатора меню в шаблоне
    'top-bar' => __( 'Top Bar Menu', 'theme-name' )  //Название идентификатора меню в шаблоне
) );

add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args');
function my_wp_nav_menu_args($args = '')
{
	$args['container'] = false; //убираем контейнер
	return $args;
}

// убираю классы и id элементов меню
function my_remove_all_class_item($classes) {
	$classes = '';
	return $classes;
}
add_filter('nav_menu_css_class', 'my_remove_all_class_item', 10, 2 ); // убираем классы элементов меню
add_filter('nav_menu_item_id', '__return_false'); // убираем id элементов меню
