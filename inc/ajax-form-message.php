<?php
/**
 * Sending AJAX data from the data submission form
 * ---------------------------------------------------------------------------------------------------------------------
 */

// rename and replace all lines with my_form_name_action and delete this comment
add_action('wp_ajax_my_form_name_action', 'my_form_name_action_callback');
add_action('wp_ajax_nopriv_my_form_name_action', 'my_form_name_action_callback');
function my_form_name_action_callback()
{

    if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        wp_die('This is not an ajax request!');
    }

    $field = $_POST['fields'];

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

    $send_success = wp_mail($email, 'Тема сообщения', $message);

    if (!$send_success) {
        wp_send_json_error("WP_mail not send $response ==> ", $response, "WP_mail not send $send_success ==> ", $send_success);
    }

    wp_send_json_success($response);
    wp_die();
}
