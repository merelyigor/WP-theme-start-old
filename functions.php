<?php

/**
 * Функции темы
 * ---------------------------------------------------------------------------------------------------------------------
 */

/************** ------- Файлы js для подключения к теме ------- **************/
// include_once 'dist/my-js/ajax-form-action.js'; // Данный js нужно подключить к теме - отвечает за передачу данных из форм отправки данных
/************** ------- Подключение файлов function ------- **************/
include_once 'dist/add-theme-support.php'; // Глобальные настройки темы и регистрация настроек
include_once 'dist/style-theme.php'; // Подключение стилей
include_once 'dist/post-hide.php'; // Скрытие постов учасников от других учасников которые не являются их авторами
include_once 'dist/nav-register-menu.php'; // Регистрация меню + убираем контейнер + убираю классы и id элементов меню
include_once 'dist/new-gravatar.php'; // Функция добавления своего аватара в админку для дефолтного отображения
include_once 'dist/language-translit.php'; // Перевод урлов в транслит с русс названий
include_once 'dist/contact-form-7.php'; // Надстройки для плагина CF7
include_once 'dist/post-settings.php'; // функции которые относятся к выводу постов на главной и странице рубрик
include_once 'dist/acf-settings.php'; // Настройки к плагину ACF кастомные поля
include_once 'dist/breadcrumb-include.php'; // Хлебные крошки
include_once 'dist/sidebar-theme.php'; // Сайт бар темы для виджетов
include_once 'dist/custom_post_type.php'; // Кастомные посты
include_once 'dist/custom-body-class.php'; // Присвоение кастомных класов для тега <body>
include_once 'dist/hide-post-password.php'; // Запароленные записи
include_once 'dist/wpml-plugin-custm.php'; // WPML настройки
include_once 'dist/json-parser-array.php'; // Работа с JSON масивами данных для вывода в верстку
include_once 'dist/ajax-form-method.php'; // Отправка данных AJAX из формы отправки данных
include_once 'dist/validator.php'; // Валидатор для проверки форм на email, phone, file --- использует отправку AJAX форм
include_once 'dist/wp-navigations-inc.php'; // Настройка пагинации 1 2 3 4 ...
include_once 'dist/wp-admin-ccs.php'; // Добавление собственных стилей css для стр. регистрации, входа или админ панели






/**
 * Дополнение файла function
 * ---------------------------------------------------------------------------------------------------------------------
 */


/************** ------- Ограничение на загрузку файлов - установка размера ------- **************/
add_filter('upload_size_limit', 'PBP_increase_upload');
function PBP_increase_upload($bytes)
{
    return 90048576; // 1 megabyte
}






