<?php
/**
 * Creating an AJAX post from the submit form
 * ---------------------------------------------------------------------------------------------------------------------
 */

// rename and replace all lines with post_add_name and delete this comment
add_action('wp_ajax_post_add_name', 'post_add_name_callback');
add_action('wp_ajax_nopriv_post_add_name', 'post_add_name_callback');

function post_add_name_callback()
{
    global $user_ID;

    if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        wp_die('This is not an ajax request!');
    }


    $field = $_POST['fields'];

    /************** ------- START --- as for sending a letter --- START ------- **************/
    $email = get_option('admin_email'); //get_field(''); 'example@mail.ru';
    $response = [];

    $fields = array( //загоняю значения $name и $tel в $fields
        'required' => array(
            'name' => $field, // required field
            'mail' => $field,
            'tel' => $field,
        )
    );

    $response['errors'] = Validator::validate_fields($fields); //I run $fields through validator

    if (count($response['errors'])) {
        wp_send_json_error($response);
        return;
    }

    $message =
        "Имя: $field\n" .
        "Следущее поле: $field\n";




    $post_id = wp_insert_post(wp_slash(array( //If the post is successfully created, it gets $post_id.
        'post_title' => 'Новый отзыв от ' . $field,
        'post_status' => 'pending', //https://misha.blog/wordpress/post-statuses.html
        'post_content' => '', //text cotent to this post
        'post_date' => date('Y-m-d H:i:s'),
        'post_type' => 'custom-post-type', //here use your post type || Or enter the default "post"
        'post_author' => $user_ID,
        'ping_status' => get_option('default_ping_status'),
        'post_parent' => 0,
        'menu_order' => 0,
        'to_ping' => '',
        'pinged' => '',
        'post_password' => '', // if the post type is password-protected
        'post_excerpt' => '', // excerpt text
        'post_category' => array(0)
    )));
    wp_send_json_success('wp_insert_post => ', $post_id );

    $custom_fields = array( // this fields for update or create custom fields ACF - key is a selector
        'name-selector' => $field,
    );

    foreach ($custom_fields as $selector => $value) { //update or create custom fields ACF - key is a selector
        update_field($selector, $value, $post_id); // Need $post_id to update its custom fields of the currently created post
    }

    $send_success = wp_mail($email, 'Тема сообщения (на вашем сайте только что создали пост)', $message);

    if (!$send_success) {
        wp_send_json_error("WP_mail not send $response ==> ", $response, "WP_mail not send $send_success ==> ", $send_success);
    }

    wp_send_json_success($response);
    wp_die();
}
