<?php
/**
 * Регистрация меню + убираем контейнер + убираю классы и id элементов меню
 * в данном примере регистрирует три меню - Главное меню - Верхнее меню - Нижнее меню
 * ---------------------------------------------------------------------------------------------------------------------
 */


register_nav_menus(array(
    'top'    => 'Верхнее меню',    //Название месторасположения меню в шаблоне - theme_location
    'bottom' => 'Нижнее меню'      //Название другого месторасположения меню в шаблоне - theme_location
));

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



/**
 * для вывода верхнего меню вставте --- <?php wp_nav_menu('menu_class=bmenu&theme_location=top'); ?>
 * для вывода нижнего меню вставте --- <?php wp_nav_menu('menu_class=bmenu&theme_location=bottom'); ?>
 * разбор - menu_class = пишется класс для ul обертки списка меню
 * разбор - theme_location = пишется идентификатор меню заданный при регистрации меню ('top'    => 'Верхнее меню', ) top - это идентификатор
 * ---------------------------------------------------------------------------------------------------------------------
 */

