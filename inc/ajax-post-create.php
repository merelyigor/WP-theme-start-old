<?php
/**
 * Создание поста AJAX из формы отправки данных
 * ---------------------------------------------------------------------------------------------------------------------
 */


add_action('wp_ajax_post_add', 'post_add_callback');
add_action('wp_ajax_nopriv_post_add', 'post_add_callback');

function post_add_callback()
{
    global $user_ID;

    if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        wp_die('Это не ajax запрос!');
    }


    $name = $_POST['name'];
    $mail = $_POST['mail'];
    $textarea = $_POST['textarea'];
    $email = get_field('mail_to', 190); // 'name@mail.ru'
    $response = [];

    $fields = array( //validation fields
        'required' => array(
            'mail' => $mail,
        )
    );


    $response['errors'] = Validator::validate_fields($fields);

    if (count($response['errors'])) {
        wp_send_json_error($response);
        return;
    }

    $message = "Имя: $name\n" . "Email: $mail\n" . "Сообщение: $textarea\n";


    $post_id = wp_insert_post(wp_slash(array( //If the post is successfully created, it gets $post_id.
        'post_title' => 'Новый отзыв от ' . $name,
        'post_status' => 'pending', //https://misha.blog/wordpress/post-statuses.html
        'post_content' => '', //text cotent to this post
        'post_date' => date('Y-m-d H:i:s'),
        'post_type' => 'review-post-type', //here use your message type || enter the default "post"
        'post_author' => $user_ID,
        'ping_status' => get_option('default_ping_status'),
        'post_parent' => 0,
        'menu_order' => 0,
        'to_ping' => '',
        'pinged' => '',
        'post_password' => '',
        'post_excerpt' => '', // excerpt text
        'post_category' => array(0)
    )));

    $review_custom_fields = array( // this fields for update or create custom fields ACF - key is a selector
        'name' => $name,
        'email' => $mail,
        'text' => $textarea,
    );

    foreach ($review_custom_fields as $selector => $value) { //update or create custom fields ACF - key is a selector
        update_field($selector, $value, $post_id); // Need $post_id to update its custom fields of the currently created post
    }


    $send_success = wp_mail($email, 'На вашем сайте "site name" был оставлен отзыв', $message);

    if (!$send_success) {
        wp_send_json_error("WP_mail not send");
    }

    wp_send_json_success($response);

    die();
}
