<?php
/**
 * Отправка данных AJAX из формы отправки данных
 * ---------------------------------------------------------------------------------------------------------------------
 */

/************** ------- Подключаю myajax от wordpress к скриптам темы -- должно вывести в скриптах скрипт myajax ------- **************/
add_action( 'wp_enqueue_scripts', 'myajax_data', 99 ); //подключаю скрипты myajax к теме через свои скрипты - скрипты подключать только через  wp_enqueue_scripts
function myajax_data(){


    wp_localize_script( 'main', 'myajax',
        array(
            'url' => admin_url('admin-ajax.php') //забираю данные js которые в js файле передаются в wp
        )
    );

}

//              возвращает такой скрипт в футер
//              <script type="text/javascript">
//                  /* <![CDATA[ */
//                  var myajax = {"url":"http:\/\/ivs.polyarix.com\/wp-admin\/admin-ajax.php"};
//                  /* ]]> */
//              </script>


add_action('wp_ajax_my_form_name_action', 'my_form_name_action_callback'); //регистрирую свой экшн на отправку данных с формы на адресс - название my_form_name_action
add_action('wp_ajax_nopriv_my_form_name_action', 'my_form_name_action_callback');
function my_form_name_action_callback() { //регистрирую функцию my_form_name_action_callback
    $name = $_POST['name']; //дальше забираю данные из JS которые тянуться по классу или id из верстки --- пример js отдельным файлом /dist/my-js/ajax-form-action.js тег input[name="name"]
    $org = $_POST['org']; // забираю тег input[name="organization"]
    $region = $_POST['region']; // забираю тег input[name="region"]
    $tel = $_POST['tel']; // забираю тег input[name="tel"]
    $radio = $_POST['radio']; // забираю тег input[name="radio"]:checked --- в данном случае берется радио кнопка которая в состоянии checked - тоесть активна по умолчанию или нет
    $email = get_option('admin_email'); // тут в данном случае отправка проводится на адресс администратора wp - так же можно вписать свой в формате get_option('name@mail.ru')
    $response = [];

    $fields = array( //загоняю значения $name и $tel в $fields
        'required' => array(
            'name' => $name,
            'tel' => $tel,
        )
    );

    $response['errors'] = Validator::validate_fields($fields); //прогоняю $fields значения $name и $tel через валидатор

    if (count($response['errors'])) {
        wp_send_json_error($response);
        return;
    }

    $message = "Имя: $name\n" . "Организация: $org\n" . "Регион: $region\n" . "Телефон: $tel\n" . "Схема: $radio"; // строю сообщение для отправки на почту - можно строить из html тегов
    //подключая через точку переменные из php без использования (\n) - перенос строки - html нужно использовать валидный для mail

    $send_success = wp_mail($email, 'Тема сообщения --- отображается в теме сообщения на почте', $message);

    if (!$send_success) {
        wp_send_json_error("WP_mail not send"); // в случае ошибки не отправлять письмо
    }

    wp_send_json_success($response);
    die(); // убиваю функцию для работы следующей функции - дальше можно добавлять еще подобные функции с другими action названиями (my_form_name_action)
}
