<?php
//нужно подключить к function темы include_once

class Validator
{
    //Default name fields
    private static $email = 'mail';
    private static $phone = 'tel';
    private static $file = 'file';

    public static function lang()
    {
//    global $sitepress;
//    $lang = $sitepress->get_current_language();

        $error_text = array();

        $error_text['required'] = 'Поле обязательно';
        $error_text['mail'] = 'Введите валидную почту';
        $error_text['phone'] = 'Формат телефона не верен';

        return $error_text;
    }

    public static function validate_fields($fields, $errors = array())
    {

        if ($fields['required']) {
            foreach ($fields['required'] as $key => $value) {
                if (isset($value)) {
                    $errors = self::validate_require($key, $value, $errors);
                }
            }
        }
        if ($fields['optional']) {
            foreach ($fields['optional'] as $key => $value) {
                if (isset($value)) {
                    $errors = self::validate_optional($key, $value, $errors);
                }
            }

        }

        return $errors;

    }

    private static function validate_require($key, $value, $errors)
    {
        if (!is_array($value)) {
            $val = $value;
        } else {
            $val = $value['name'];
        }
        if (!isset($val) || strlen(trim($val)) === 0) {
            if (!$errors[$key]) {
                $errors[$key] = array();
            }
            $errors[$key] = self::lang()['required'];
        } else {
            $errors = self::validate_optional($key, $value, $errors);
        }


        return $errors;
    }

    private static function validate_optional($key, $value, $errors)
    {
        if (!is_array($value)) {
            $val = $value;
        } else {
            $val = $value['name'];
        }
        if (isset($val) && strlen(trim($val)) != 0) {
            if ($key == self::$email) {
                $errors = self::validate_email($key, $value, $errors);
            }
            if ($key == self::$phone) {
                $errors = self::validate_phone($key, $value, $errors);
            }
            if ($key == self::$file) {
                $errors = self::validate_file($key, $value, $errors);
//        wp_die($errors);
            }
        }

        return $errors;
    }

    //DEFAULT FIELDS

    private static function validate_email($key, $value, $errors)
    {

        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {

            if (!$errors[$key]) {
                $errors[$key] = array();
            }
            $errors[$key] = self::lang()['mail'];
        }

        return $errors;
    }

    private static function validate_phone($key, $value, $errors)
    {

        if (!self::validatePhoneNumber($value)) {

            if (!$errors[$key]) {
                $errors[$key] = array();
            }
            $errors[$key] = self::lang()['phone'];
        }

        return $errors;
    }

    private static function validate_file($key, $value, $errors)
    {

        $allowed_mime_types = array(
            'image/png',
            'image/jpeg',
            'image/jpeg',
            'image/jpeg',
            'image/gif',
            'image/bmp',
            'application/pdf',
            'application/zip',
            'application/gzip',
            'application/x-zip-compressed',
            'application/x-rar-compressed'
        );

        //var_dump($value['type']);

        unset($errors[$key]);


        if (!in_array($value['type'], $allowed_mime_types)) {
            $errors[$key] = 'Только формат изображения';
        }
        if (filesize($value['tmp_name']) > 2097152) {
            $errors[$key] = 'Не более 2МБ';
        }

        // Check to see if any PHP files are trying to be uploaded
        $content = file_get_contents($value['tmp_name']);

        if (preg_match('/\<\?php/i', $content)) {
            $errors[$key] = 'Ошибка';
        }

        // Return any upload error
        if ($value['error'] != UPLOAD_ERR_OK) {
            $errors[$key] = 'Ошибка';
        }

        return $errors;
    }

    //HELP
    private static function validatePhoneNumber($number)
    {
        $formats = array(
            '(###)###-##-##',
            '(###)###-####',
            '+#(###)###-####',
            '+###########',
            '+############',
            '#-###-###-####',
            '(#####)##-###',
            '#-###-###-####',
            '###########',

            '+### ### #####',
            '(###)###-#####',
            '(###)###-#####',
            '+###########',
            '###-###-#####',
            '###########'
        );

        in_array(
            trim(preg_replace('/[0-9-+()]/', '#', $number)),
            $formats
        );

        return preg_match('/^[0-9-+()]+$/', $number);
    }

}
