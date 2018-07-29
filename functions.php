<?php

/**
 * Функции темы
 * ---------------------------------------------------------------------------------------------------------------------
 */

/************** ------- Файлы js для подключения к теме ------- **************/
// include_once 'inc/my-js/ajax-form-action.js'; // Данный js нужно подключить к теме - отвечает за передачу данных из форм отправки данных
/************** ------- Подключение файлов function ------- **************/
include_once 'inc/acf-advanced-custom-fields.php'; // Настройки к плагину ACF кастомные поля
include_once 'inc/add-theme-support.php'; // Глобальные настройки темы и регистрация настроек
include_once 'inc/ajax-form-message.php'; // Отправка данных AJAX из формы отправки данных
include_once 'inc/avatar-wp-admin.php'; // Функция добавления своего аватара в админку для дефолтного отображения
include_once 'inc/body-class.php'; // Присвоение кастомных класов для тега <body>
include_once 'inc/breadcrumb.php'; // Хлебные крошки
include_once 'inc/contact-form-7.php'; // Надстройки для плагина CF7
include_once 'inc/custom_post_type.php'; // Кастомные посты
include_once 'inc/get-comments.php'; // Получение коментариев
include_once 'inc/get-post-settings.php'; // функции которые относятся к выводу постов на главной и странице рубрик
include_once 'inc/json-parser-array.php'; // Работа с JSON масивами данных для вывода в верстку
include_once 'inc/nav-register-menu.php'; // Регистрация меню + убираем контейнер + убираю классы и id элементов меню
include_once 'inc/paginations-custom.php'; // Кастомная пагинация
include_once 'inc/password-post.php'; // Запароленные записи
include_once 'inc/post-hide.php'; // Скрытие постов учасников от других учасников которые не являются их авторами
include_once 'inc/rus-translit.php'; // Перевод урлов в транслит с русс названий
include_once 'inc/search-results-exclude.php'; // Поиск - исключение страниц и настройка
include_once 'inc/sidebar-wiget.php'; // Сайт бар темы - для виджетов
include_once 'inc/style-theme.php'; // Подключение стилей
include_once 'inc/validator.php'; // Валидатор для проверки форм на email, phone, file --- использует отправку AJAX форм
include_once 'inc/wp-admin-ccs.php'; // Добавление собственных стилей css для стр. регистрации, входа или админ панели
include_once 'inc/wp-navigations-inc.php'; // Настройка пагинации 1 2 3 4 ...
include_once 'inc/wp_json-oembed-fix_off.php'; // фикс wp_json и oembed из индексации - выключение REST API
include_once 'inc/wpml-plugin-custm.php'; // WPML настройки кнопок переключения языков






/**
 * Дополнение файла function
 * ---------------------------------------------------------------------------------------------------------------------
 */


## Фильтр элементо втаксономии для метабокса таксономий в админке.
## Позволяет удобно фильтровать (искать) элементы таксономии по назанию, когда их очень много
add_action( 'admin_print_scripts', 'my_admin_term_filter', 99 );
function my_admin_term_filter() {
    $screen = get_current_screen();

    if( 'post' !== $screen->base ) return; // только для страницы редактирвоания любой записи
    ?>
    <script>
        jQuery(document).ready(function($){
            var $categoryDivs = $('.categorydiv');

            $categoryDivs.prepend('<input type="search" class="fc-search-field" placeholder="фильтр..." style="width:100%" />');

            $categoryDivs.on('keyup search', '.fc-search-field', function (event) {

                var searchTerm = event.target.value,
                    $listItems = $(this).parent().find('.categorychecklist li');

                if( $.trim(searchTerm) ){
                    $listItems.hide().filter(function () {
                        return $(this).text().toLowerCase().indexOf(searchTerm.toLowerCase()) !== -1;
                    }).show();
                }
                else {
                    $listItems.show();
                }
            });
        });
    </script>
    <?php
}


/**
 * функция подключение (стили / скрипты) на все страницы
 * ---------------------------------------------------------------------------------------------------------------------
 */

function theme_name()
{

    wp_enqueue_style('style.css', get_template_directory_uri() . '/style.css', array(), time());

    wp_enqueue_style('main.css', get_template_directory_uri() . '/theme-name/main.css', array(), time());

    wp_enqueue_style('url-style.css', '//site.com/styles-folder/style.css');

    wp_enqueue_script('header.js', get_template_directory_uri() . '/js/header.js', array(), time());

    wp_enqueue_script('footer.js', get_template_directory_uri() . '/js/footer.js', array(), time(), true);

    wp_enqueue_script('url-head.js', '//site.com/js-folder/head.js', array(), time());

    wp_enqueue_script('url-footer.js', '//site.com/styles-folder/footer.js', array(), time(), true);

//    wp_enqueue_script('admin-ajax.php', get_site_url() . '/wp-admin/admin-ajax.php', array(), time(), true);

}
add_action('wp_enqueue_scripts', 'theme_name');



/************** ------- Ограничение на загрузку файлов - установка размера ------- **************/
add_filter('upload_size_limit', 'PBP_increase_upload');
function PBP_increase_upload($bytes)
{
    return 90048576; // 1 megabyte
}






