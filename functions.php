<?php

/**
 * Функции темы
 * ---------------------------------------------------------------------------------------------------------------------
 */

/************** ------- Файлы js для подключения к теме ------- **************/
// include_once 'inc/my-js/ajax-form-action.js'; // Данный js нужно подключить к теме - отвечает за передачу данных из форм отправки данных
/************** ------- Подключение файлов function ------- **************/
include_once 'inc/add-theme-support.php'; // Глобальные настройки темы и регистрация настроек
include_once 'inc/style-theme.php'; // Подключение стилей
include_once 'inc/post-hide.php'; // Скрытие постов учасников от других учасников которые не являются их авторами
include_once 'inc/nav-register-menu.php'; // Регистрация меню + убираем контейнер + убираю классы и id элементов меню
include_once 'inc/new-gravatar.php'; // Функция добавления своего аватара в админку для дефолтного отображения
include_once 'inc/language-translit.php'; // Перевод урлов в транслит с русс названий
include_once 'inc/contact-form-7.php'; // Надстройки для плагина CF7
include_once 'inc/post-settings.php'; // функции которые относятся к выводу постов на главной и странице рубрик
include_once 'inc/acf-settings.php'; // Настройки к плагину ACF кастомные поля
include_once 'inc/breadcrumb-include.php'; // Хлебные крошки
include_once 'inc/sidebar-theme.php'; // Сайт бар темы для виджетов
include_once 'inc/custom_post_type.php'; // Кастомные посты
include_once 'inc/custom-body-class.php'; // Присвоение кастомных класов для тега <body>
include_once 'inc/hide-post-password.php'; // Запароленные записи
include_once 'inc/wpml-plugin-custm.php'; // WPML настройки
include_once 'inc/json-parser-array.php'; // Работа с JSON масивами данных для вывода в верстку
include_once 'inc/ajax-form-method.php'; // Отправка данных AJAX из формы отправки данных
include_once 'inc/validator.php'; // Валидатор для проверки форм на email, phone, file --- использует отправку AJAX форм
include_once 'inc/wp-navigations-inc.php'; // Настройка пагинации 1 2 3 4 ...
include_once 'inc/wp-admin-ccs.php'; // Добавление собственных стилей css для стр. регистрации, входа или админ панели
include_once 'inc/search-results-exclude.php'; // Поиск - исключение страниц и настройка
include_once 'inc/ajax.php'; // Поиск - исключение страниц и настройка






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






