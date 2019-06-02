<?php

/**
 * ACF Options Page
 *
 */

add_action('init', function () {
    if (function_exists('acf_add_options_page')) {
        acf_add_options_page(array(
            'title' => 'Настройки сайта',
            'capability' => 'manage_options',
        ));
    }
});