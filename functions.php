<?php

/**
 * Theme features
 * ---------------------------------------------------------------------------------------------------------------------
 */

## main function
include_once 'inc/main-function/theme-support.php';
include_once 'inc/main-function/style-theme.php';
include_once 'inc/main-function/nav-menu.php';
include_once 'inc/main-function/body-class.php';

## AJAX function
include_once 'inc/ajax-function/ajax-form-message.php';
include_once 'inc/ajax-function/ajax-post-create.php';
include_once 'inc/ajax-function/validator.php';

## plugin function
include_once 'inc/plugin-function/acf-settings.php';
include_once 'inc/plugin-function/contact-form-7.php';
include_once 'inc/plugin-function/wpml-plugin-custom.php';

## taxonomy function
include_once 'inc/taxonomy-function/taxonomy-custom-field.php';
include_once 'inc/taxonomy-function/taxonomy-radio-button.php';

## custom wp function
include_once 'inc/custom-wp-function/custom-post-type.php';
include_once 'inc/custom-wp-function/custom-menu-filter.php';
include_once 'inc/custom-wp-function/custom-paginations.php';
include_once 'inc/custom-wp-function/custom-breadcrumb.php';
include_once 'inc/custom-wp-function/custom-short-cod.php';
include_once 'inc/custom-wp-function/custom-search-results.php';
include_once 'inc/custom-wp-function/custom-registration-form-TO-DOO.php';

## other function
include_once 'inc/other-function/wp-admin-ccs.php';
include_once 'inc/other-function/avatar-wp-admin.php';
include_once 'inc/other-function/get-comments-TO-DOO.php';
include_once 'inc/other-function/json-decoder.php';
include_once 'inc/other-function/password-post.php';
include_once 'inc/other-function/post-hide.php';
include_once 'inc/other-function/sidebar-widget.php';
include_once 'inc/other-function/wp-json-embed-fix-off.php';

## always included
include_once 'inc/always-included/сyrillic-translit.php';
include_once 'inc/always-included/normal-date.php';
include_once 'inc/always-included/translate-google.php';

## admin panel
inc/admin-panel/menu-option-sidebar.php

/**
 * File extension function
 * ---------------------------------------------------------------------------------------------------------------------
 */

## new var_dump function
function dd($var_dump, $die = false)
{
    echo '<pre style="color: #850085">';
    var_dump($var_dump);
    echo '</pre>';
    if ($die) {
        wp_die();
    }
}

## File Download Restriction - Set Size
add_filter('upload_size_limit', 'PBP_increase_upload');
function PBP_increase_upload($bytes)
{
    return 90048576; // 1 megabyte
}


/**
 * function adds <a rel="nofollow" attribute to display links by standard gallery from shortcod
 * [gallery size="medium" ids="2368,2370,2371"]
 * ---------------------------------------------------------------------------------------------------------------------
 */
add_filter('wp_get_attachment_link', function ($markup, $id, $size, $permalink, $icon, $text) {
    $content = preg_replace("/<a/", "<a rel=\"nofollow\"", $markup, 1);
    return $content;
}, 10, 6);
