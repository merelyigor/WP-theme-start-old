<?php
/**
 * File menu function
 * ---------------------------------------------------------------------------------------------------------------------
 */

## Filter active classes for the menu.
add_filter('nav_menu_css_class', function ($classes, $item) {
    if (in_array('current-menu-item', $classes)) {
        $classes[] = 'custom-active-class-to-menu-item '; //active class
    }
    return $classes;
}, 10, 2);


## To also highlight a menu item when one of the child pages is active, also check another class ( current-page-ancestor), as shown below:
add_filter('nav_menu_css_class', function ($classes, $item) { //also for current pages and child pages.
    if (in_array('current-page-ancestor', $classes) || in_array('current-menu-item', $classes)) {
        $classes[] = 'custom-active-class-to-menu-item-page '; //active class
    }
    return $classes;
}, 10, 2);

## In addition to the previous answers, if your menu items are categories
# and you want to highlight them when navigating through messages, check also 'current-post-ancestor':
add_filter('nav_menu_css_class', function ($classes, $item) {
    if (in_array('current-post-ancestor', $classes)
        || in_array('current-page-ancestor', $classes)
        || in_array('current-menu-item', $classes)) {
        $classes[] = 'custom-active-class-to-menu-category-item ';
    }
    return $classes;
}, 10, 2);