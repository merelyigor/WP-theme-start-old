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
include_once 'inc/custom-post-type.php'; // Кастомные посты
include_once 'inc/get-comments.php'; // Получение коментариев
include_once 'inc/get-post-settings.php'; // функции которые относятся к выводу постов на главной и странице рубрик
include_once 'inc/json-parser-array.php'; // Работа с JSON масивами данных для вывода в верстку
include_once 'inc/register-nav-menu.php'; // Регистрация меню + убираем контейнер + убираю классы и id элементов меню
include_once 'inc/custom-paginations.php'; // Кастомная пагинация
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
include_once 'inc/custom-registration-form.php'; // Кастомная форма регистрации
include_once 'inc/taxonomy_custom_field.php'; // Кастомная форма регистрации таксономий






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


## Фильтр активных классов для меню.
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

function special_nav_class ($classes, $item) {
    if (in_array('current-menu-item', $classes) ){
        $classes[] = 'custom-active-class-to-menu-item '; //активный класс
    }
    return $classes;
}

## Чтобы также выделить элемент меню, когда активна одна из дочерних страниц, также проверьте другой класс ( current-page-ancestor), как показано ниже:
add_filter('nav_menu_css_class' , 'special_nav_class_page' , 10 , 2);

function special_nav_class_page ($classes, $item) { //так же для текущих стр. и дочерних стр.
    if (in_array('current-page-ancestor', $classes) || in_array('current-menu-item', $classes)){
        $classes[] = 'custom-active-class-to-menu-item-page '; //активный класс
    }
    return $classes;
}

## В дополнение к предыдущим ответам, если ваши пункты меню являются категориями и вы хотите выделить их при навигации по сообщениям, проверьте также current-post-ancestor:
add_filter('nav_menu_css_class' , 'special_nav_class_category' , 10 , 2);

function special_nav_class_category ($classes, $item) {
    if (in_array('current-post-ancestor', $classes) || in_array('current-page-ancestor', $classes) || in_array('current-menu-item', $classes) ){
        $classes[] = 'custom-active-class-to-menu-category-item ';
    }
    return $classes;
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


/**
 * функция регистрации и вывода shortcod шордкодов в админке - для использования  [custom]
 * ---------------------------------------------------------------------------------------------------------------------
 * для использования [custom-shortcod] что бы передать значение для переменной $var нужно указать [custom-shortcod var=some_string] $var будет присвоено some_string
 */
function custom_shortcode( $atts ){


    $var = ''; //инициализация переменной $var для использования в shortcod
    extract( shortcode_atts( array( // достаю из shortcod значение для переменной $var
        'var' => '' // присвоение переменной some_string из коментария выше
    ), $atts ) );
    $var; // будет иметь some_string в этом месте для дальнейшего вызова и передачи

    $html = '';
    while ( have_rows('docs') ) { the_row(); // можно вывести кастомное поле которое добавляется к странице ACFом для вывода повторителя с файлом и тд.
        $html .= '<a href="'.get_sub_field( "file" ).'">';
        $html .= '<img src="'.get_bloginfo( "template_url" ).'/img/sprite-inline"></img>';
        $html .= '<p>'. get_sub_field( "text" ).'</p>';
    }
    return $html; // вернуть html на страницу вместо указанного shortcod
}

add_shortcode( 'custom-shortcod', 'custom_shortcode' );



/**
 * функция Добавляет <a rel="nofollow" атрибут к выводу ссылок стандартной галереей из шордкодов [gallery size="medium" ids="2368,2370,2371"]
 * ---------------------------------------------------------------------------------------------------------------------
 */
function filter_function_name_replase_media_link( $markup, $id, $size, $permalink, $icon, $text ){
    $content = preg_replace("/<a/","<a rel=\"nofollow\"", $markup, 1);
    return $content;
}
add_filter( 'wp_get_attachment_link', 'filter_function_name_3152', 10, 6 );




/**
 * функция Правельно склоняет месяца в выводе даты WP через the_time();
 * ---------------------------------------------------------------------------------------------------------------------
 */
function correct_date($cordate = ''){
if ( substr_count($cordate , '---') > 0 ){return str_replace('---', '', $cordate);}
$new_d = array(
'Январь' => 'Января',
'Февраль' => 'Февраля',
'Март' => 'Марта',
'Апрель' => 'Апреля',
'Май' => 'Мая',
'Июнь' => 'Июня',
'Июль' => 'Июля',
'Август' => 'Августа',
'Сентябрь' => 'Сентября',
'Октябрь' => 'Октября',
'Ноябрь' => 'Ноября',
'Декабрь' => 'Декабря'
);
return strtr($cordate, $new_d);
}
add_filter('the_date', 'correct_date');
add_filter('get_the_date', 'correct_date');
add_filter('the_time', 'correct_date');
add_filter('get_the_time', 'correct_date');
add_filter('get_post_time', 'correct_date');
add_filter('get_comment_date', 'correct_date');
add_filter('the_modified_time', 'correct_date');
add_filter('get_the_modified_date', 'correct_date');
