<?php
/**
 * Register menu + remove container + remove classes and menu item id
 * ---------------------------------------------------------------------------------------------------------------------
 */


add_action('after_setup_theme', function () {
    register_nav_menus(array(
        'top' => 'top menu location',
        'bottom' => 'bottom menu location'
    ));
});

add_filter('wp_nav_menu_args', function ($args = '') {
    $args['container'] = false; //remove the container
    return $args;
});


// remove classes and menu item id

add_filter('nav_menu_css_class', function ($classes) {
    $classes = '';
    return $classes;
}, 10, 2); // remove the menu item classes


/**
 * to display the top menu, insert --- <?php wp_nav_menu('menu_class=bmenu&theme_location=top'); ?>
 * to display the bottom menu, paste --- <?php wp_nav_menu('menu_class=bmenu&theme_location=bottom'); ?>
 * parsing - menu_class = class is written for ul menu list wrapper
 * parsing - theme_location = written menu identifier specified during registration menu ('top'    => 'Верхнее меню', ) top - this is an identifier
 * ---------------------------------------------------------------------------------------------------------------------
 */


