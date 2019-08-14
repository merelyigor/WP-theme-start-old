<?php
/**
 * Assigning custom classes for the body tag
 * ---------------------------------------------------------------------------------------------------------------------
 */

add_filter('body_class', function ($wp_classes) {
    if (is_front_page()) {
        $wp_classes[] = 'is-front-page';
    }

    if (is_page(10)) {
        $wp_classes[] = 'is-page-id-10';
    }

    if (is_single()) {
        $wp_classes[] = 'page-single';
    }

    $assoc = [
        'page-template-name' => 'prints class by pattern name in class',
    ];

    array_walk($wp_classes, function ($item) use ($assoc, &$wp_classes) {
        if (array_key_exists($item, $assoc))
            $wp_classes[] = $assoc[$item];
    });

    return $wp_classes;
});


/**
 * For output, specify in the tag body <?= body_class (); ?>
 * ---------------------------------------------------------------------------------------------------------------------
 */


