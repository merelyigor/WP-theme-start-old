<?php
/**
 * Global Theme Functions
 * ---------------------------------------------------------------------------------------------------------------------
 */


add_action('after_setup_theme', function () {
    /************** ------- title tag in the header ------- **************/
    add_theme_support('title-tag');

    /************** for output in the header connect so
     * <title><?php bloginfo('name'); ?> | <?php is_home() ? bloginfo('description') : wp_title(''); ?></title>
     * ------- *************
     */


    /************** ------- logo and size indication ------- **************/
    add_theme_support('custom-logo', array(
        'height' => 270,
        'width' => 270,
        'flex-height' => true
    ));


    /************** ------- media (pictures) in posts and their size is already in post-settings.php inc ------- **************/
    add_theme_support('post-thumbnails');
    if (function_exists('add_theme_support')) {
        add_theme_support('post-thumbnails');
        add_image_size( 'news-thumbnail-size', 360, 245, true );
    }


    /************** ------- html5 form support ------- **************/
    add_theme_support('html5', array(
        'search_form',
        'comment_form',
        'comment-list',
        'gallery',
        'caption'
    ));

});








