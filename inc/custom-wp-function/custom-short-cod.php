<?php
/**
 * registration and output function shortcod, shortcodes in the admin - for use  [custom]
 * ---------------------------------------------------------------------------------------------------------------------
 * for use ==> [custom-shortcod] to pass a value to a variable $var need to specify [custom-shortcod var=some_string]
 * $var will be assigned some_string
 */
add_shortcode('custom-shortcod', function ($atts) {

    $var = ''; //initializing the $ var variable for use in shortcod
    extract(shortcode_atts(array( // I get from shortcod value for a variable $ var
        'var' => '' // Assigning the variable some_string from the comment above
    ), $atts));
    $var; // will have some_string in this place for further call and transfer

    $html = '';
    while (have_rows('docs')) {
        the_row(); // You can display a custom field that is added to the ACF page to display a repeater with a file, etc.
        $html .= '<a href="' . get_sub_field("file") . '">';
        $html .= '<img src="' . get_bloginfo("template_url") . '/img/sprite-inline"></img>';
        $html .= '<p>' . get_sub_field("text") . '</p>';
    }
    return $html; // return html to the page instead of the specified shortcod
});
