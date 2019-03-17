<?php

/**
 * connection function (styles / scripts) everywhere except for page with id13
 * ---------------------------------------------------------------------------------------------------------------------
 */
add_action('wp_enqueue_scripts', function () {
    if (!is_page(13)) {
        //----- connect the internal theme style -----
        wp_enqueue_style('style.css', get_template_directory_uri() . '/style.css', array(), time());
        wp_enqueue_style('main.css', get_template_directory_uri() . '/css/main.css', array(), time());

        //----- connect external styles from the internet without https:// -----
//    wp_enqueue_style('built.css', '//site.com/styles/built.css');

        //----- we connect scripts in head -----
//    wp_enqueue_script('main.head.js', get_template_directory_uri() . '/js/main.head.js', array(), time());

        //----- We connect external scripts from the Internet to the head without https:// -----
//    wp_enqueue_script('site.com.css', '//site.com/styles/site.com.css', array(), time());

        //----- Connect external scripts from the Internet to footer without https:// -----
//    wp_enqueue_script('site.com.css', '//site.com/styles/site.com.css', array(), time(), true);

        //----- we connect scripts in footer -----
        wp_enqueue_script('vendor.js', get_template_directory_uri() . '/js/vendor.js', array(), time(), true);
        wp_enqueue_script('my_custom.js', get_template_directory_uri() . '/js/my_custom.js', array(), time(), true);
        wp_enqueue_script('main.js', get_template_directory_uri() . '/js/main.js', array(), time(), true);
    }
});


/**
 * the function of connecting (styles / scripts) to a specific page with a pattern in this case id13
 * ---------------------------------------------------------------------------------------------------------------------
 */
add_action('wp_enqueue_scripts', function () {
    if (is_page(13)) {
        //----- connect the internal theme style -----
        wp_enqueue_style('style.css', get_template_directory_uri() . '/style.css', array(), time());
        wp_enqueue_style('main.css', get_template_directory_uri() . '/css/main.css', array(), time());

        //----- connect external styles from the internet without https:// -----
//    wp_enqueue_style('built.css', '//site.com/styles/built.css');

        //----- we connect scripts in head -----
//    wp_enqueue_script('main.head.js', get_template_directory_uri() . '/js/main.head.js', array(), time());

        //----- We connect external scripts from the Internet to the head without https:// -----
//    wp_enqueue_script('site.com.css', '//site.com/styles/site.com.css', array(), time());

        //----- Connect external scripts from the Internet to footer without https:// -----
//    wp_enqueue_script('site.com.css', '//site.com/styles/site.com.css', array(), time(), true);

        //----- we connect scripts in footer -----
        wp_enqueue_script('vendor.js', get_template_directory_uri() . '/js/vendor.js', array(), time(), true);
        wp_enqueue_script('my_custom.js', get_template_directory_uri() . '/js/my_custom.js', array(), time(), true);
        wp_enqueue_script('main.js', get_template_directory_uri() . '/js/main.js', array(), time(), true);
    }
});


/**
 * connection function (styles / scripts) on all pages
 * ---------------------------------------------------------------------------------------------------------------------
 */


add_action('wp_enqueue_scripts', function () {
    //----- connect the internal theme style -----
    wp_enqueue_style('style.css', get_template_directory_uri() . '/style.css', array(), time());
    wp_enqueue_style('main.css', get_template_directory_uri() . '/css/main.css', array(), time());

    //----- connect external styles from the internet without https:// -----
//    wp_enqueue_style('built.css', '//site.com/styles/built.css');

    //----- we connect scripts in head -----
//    wp_enqueue_script('main.head.js', get_template_directory_uri() . '/js/main.head.js', array(), time());

    //----- We connect external scripts from the Internet to the head without https:// -----
//    wp_enqueue_script('site.com.css', '//site.com/styles/site.com.css', array(), time());

    //----- Connect external scripts from the Internet to footer without https:// -----
//    wp_enqueue_script('site.com.css', '//site.com/styles/site.com.css', array(), time(), true);

    //----- we connect scripts in footer -----
    wp_enqueue_script('vendor.js', get_template_directory_uri() . '/js/vendor.js', array(), time(), true);
    wp_enqueue_script('my_custom.js', get_template_directory_uri() . '/js/my_custom.js', array(), time(), true);
    wp_enqueue_script('main.js', get_template_directory_uri() . '/js/main.js', array(), time(), true);
});

// I connect js variable with URL to admin ajax requestor
add_action('wp_enqueue_scripts', function () {


    wp_localize_script('my_custom.js', 'my_ajax',
        array(
            'url' => admin_url('admin-ajax.php')
        )
    );

}, 99);