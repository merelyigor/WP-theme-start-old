<?php
/**
 * Примеры кода для wp
 * ---------------------------------------------------------------------------------------------------------------------
 */?>



<?php  /************** ------- выведет первую букву строки в переменной ------- **************/?>
<?php mb_substr($value, 0, 1) ?>
<?php  /************** ------- обрезка текста php ------- **************/?>


<?php  /************** ------- Статический текст ------- **************/?>
<?php _e('текст', 'static_strings') ?>
<?php  /************** ------- Статический текст ------- **************/?>


<?php  /************** ------- Указание название шаблона стр ------- **************/?>
<?php/*
Template Name: page_template blog-page
*/?>
<?php  /************** ------- Указание название шаблона стр ------- **************/?>


<?php  /************** ------- вывод шорткода из php ------- **************/?>
<?php echo do_shortcode('[shortcode]');?>
<?php  /************** ------- шорткод в php ------- **************/?>



<?php  /************** ------- Запись и присвоение переменной из глобального масива wp - в виде ключа и значения в масиве глобальная переменная ------- **************/
$GLOBALS['name'] = $name;
$name = $GLOBALS['name']
 /************** ------- Запись и присвоение переменной из глобального масива wp - в виде ключа и значения в масиве глобальная переменная ------- **************/?>


<?php  /************** ------- перебор строки из символов от 0 до 200 символов с обрезкой лишнего и запись всего в результат ------- **************/
$result = mb_strcut(strip_tags( $content_string), 0, 200);
 /************** ------- перебор строки из символов от 0 до 200 символов с обрезкой лишнего и запись всего в результат ------- **************/?>


<?php  /************** ------- условие на вывод номера страницы начиная со второй страницы ------- **************/
$page_txt = ' - cтраница ';

if (get_query_var('cpage') != 0){                   // если текущая страница не ровна 0 странице в пагинации
    echo $page_txt; echo get_query_var('cpage');   // вывод текущего номера страницы в любое место страницы с пагинацией
}
 /************** ------- условие на вывод номера страницы начиная со второй страницы ------- **************/?>




<?php  /************** ------- получает урл до дериктории темы ------- **************/?>
<?= get_template_directory_uri(); ?>
<?php  /************** ------- получает урл до дериктории темы ------- **************/?>


<?php  /************** ------- проверка на каком языке находимся ------- **************/?>
<?=  get_locale(); ?>
// получим 'ru_RU', если сайт на русском
<?php  /************** ------- проверка на каком языке находимся ------- **************/?>



<?php  /************** ------- получение обьекта кастомной таксономии (кастомная таксономия)  ------- **************/?>
<?php $terms = wp_get_post_terms( $post_id, $taxonomy, $args ); ?>
<?php get_category_link( wp_get_post_terms(get_the_ID(), ['taxonomy'=>'card_category'])[0]->term_id ); // пример получения ссылки кастомной таксономии через wp_get_post_terms ?>

// получим 'ru_RU', если сайт на русском
<?php  /************** ------- получение обьекта кастомной таксономии (кастомная таксономия) ------- **************/?>





<?php
/**
 * подключает отдельный файл php к данному месту - писать имя файла без .php
 * ---------------------------------------------------------------------------------------------------------------------
 */?>
<?php  /************** ------- comment ------- **************/
    get_template_part('template/file-name'); ?>
<?php include (TEMPLATEPATH . '/part/file-name.php'); ?>




<?php echo get_home_url(); ?>
<?php  /************** ------- получает урл на root сайта ------- **************/?>


<?php /************** ------- вывод popup form  ------- **************/
get_template_part('template/form-popup'); ?>




<?php  /************** ------- Выводит меню в шаблоне ------- **************/?>
<?php
wp_nav_menu( array(
    'theme_location'  => '', //Идентификатор расположение меню в шаблоне. Идентификатор, указывается при регистрации меню функцией register_nav_menu().
    'menu'            => '', //Меню которое нужно вывести. Соответствие: id, слаг или название меню.
    'container'       => 'div', //Чем оборачивать ul тег. Допустимо: div или nav. - Если не нужно оборачивать ничем, то пишем false: container => false.
    'container_class' => '', //Значение атрибута class у контейнера меню.
    'container_id'    => '', //Значение атрибута id у контейнера меню.
    'menu_class'      => 'menu', //Значение атрибута class у тега ul.
    'menu_id'         => '', //Значение атрибута id у тега ul.
    'echo'            => true, //Выводить на экран (true) или возвратить для обработки (false).
    'fallback_cb'     => 'wp_page_menu', //Функция для обработки вывода, если никакое меню не найдено. Передает все аргументы $args указанной тут функции. Установите
    // пустую строку '' или '__return_empty_string', чтобы ничего не выводилось, если меню нет.
    'before'          => '', //Текст перед тегом <a> в меню.
    'after'           => '', //Текст после каждого тега </a> в меню.
    'link_before'     => '', //Текст перед анкором каждой ссылки в меню.
    'link_after'      => '', //Текст после анкора каждой ссылки в меню.
    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>', //Нужно ли оборачивать элементы в тег ul. Если нужно, указывается шаблон обертки. -
    // По умолчанию: '<ul id="%1$s" class="%2$s">%3$s</ul>'
    'depth'           => 0, //Сколько уровень вложенных друг в друга ссылок показывать. 0 - все уровни.
) );?>
<?php  /************** ------- Выводит меню в шаблоне ------- **************/?>


<?php  /************** ------- убираем контейнер меню ------- **************/?>
<?php
    function my_wp_nav_menu_args($args = '') //убираем контейнер меню - можно указать в самом выводе в шаблоне или при регистрации в functions
        {
            $args['container'] = false;
            return $args;
        }?>
<?php  /************** ------- убираем контейнер меню ------- **************/?>




<?php  /************** ------- проверка на роль юзера - залогиненного ------- **************/?>
<?php


if( current_user_can('subscriber') ) // если юзер подпищик - пример с else

    echo 'данный пользователь подписчик';
else
    echo 'данный пользователь подписчик';



if( current_user_can('subscriber') ) { // если юзер подпищик - пример с одним выводом echo

    echo 'данный пользователь подписчик';

}





//          current_user_can('administrator')      // true вывидит если юзер залогинен и является Админом - false если не залогинен или не является Админом
//          current_user_can('editor')            // true вывидит если юзер залогинен и является Автором - false если не залогинен или не является Автором
//          current_user_can('contributor')      // true вывидит если юзер залогинен и является Учасником - false если не залогинен или не является Учасником
//          current_user_can('subscriber')      // true вывидит если юзер залогинен и является Подписчиком - false если не залогинен или не является Подписчиком
?>
<?php  /************** ------- проверка на роль юзера - залогиненного ------- **************/?>





<?php
/**
 * ACF выводы полей в группах и тд
 * ---------------------------------------------------------------------------------------------------------------------
 */?>


<?php  /************** ------- вывод в цикле повторителя в повторителе ------- **************/?>
<?php if( have_rows('repeater_1') ): // проверяем что в repeater_1 есть елементы для вывода?>
    <?php while( have_rows('repeater_1') ): the_row(); // выводим в цикле первый повторитель с его саб полями?>

        <?php the_sub_field('sub_field_1'); // саб поле первого репитера?>


            <?php if( have_rows('repeater_2') ): // проверяем что в repeater_2 есть елементы для вывода?>
                <?php while( have_rows('repeater_2') ): the_row(); // выводим в цикле второй повторитель с его саб полями?>

                    <?php the_sub_field('sub_field_1'); // саб поле второго репитера?>

                <?php endwhile;
            endif;?>


    <?php endwhile;
endif;?>


<?php  /************** ------- вывод в цикле повторителя в повторителе из массива - не acf ------- **************/?>
<?php foreach( CFS()->get('block_5_loop') as $slide): ; // выводим в цикле первый повторитель с его саб полями?>
    <div class="swiper-slide">
        <?php foreach($slide['txtarea_item_loop'] as $service): ?>
            <div class="thumb-service">
                <i class="ic-ser-arrow">
                    <svg>
                        <use xlink:href="<?= get_template_directory_uri() ?>/img/sprite-inline.svg#ic-service-arrow"></use>
                    </svg>
                </i>
                <h3><?= $service['_item_services'] ?></h3>
                <p><?= $service['_txtarea_item_services'] ?></p>
            </div>
        <?php endforeach; ?>
    </div>
<?php endforeach; ?>


<?php  /************** ------- вывод в цикле повторителя с (группы) ------- **************/?>
<?php foreach (get_field('group')['txt_block_left'] as $key => $value): ?>
    <?= $value['txt'] ?>
<?php endforeach ?>

<?php  /************** ------- вывод в цикле повторителя с (простого поля повторителя) ------- **************/?>
<?php foreach (get_field('sub_title') as $key => $value): ?>
    <?= $value['txt'] ?>
<?php endforeach ?>

<?php  /**  Вывод кастомного поля в группе - нужно создать поле тип (группа) и в нем создавать поля с разными значениями  **/?>
<?= get_field('группа')['значение_поля_в_группе'];  ?>

<?php  /************** ------- простой вывод поля ------- **************/?>
<?= get_field('имя_поля'); ?>

<?= the_field('имя_поля'); ?>




<?php  /**  Вывод email из кастомных полей - перебор имейлов для отправки emailacf  **/?>
<?php
if(count($response['errors'])) {
wp_send_json_error($response);
} else {
$emails_array = get_field('emails_order', 'option');

function emails_array_to_string($emails_array){
$emails_list='';

end($emails_array); // перемещаем указатель в конец массива
$last = key($emails_array); // получаем последний ключ

foreach ($emails_array as $k => $v){
$emails_list .= $v['email'];//

if ($k !== $last) {
$emails_list .=  ', ';
} // если текущий ключ не последний, выводим запятую
}

return $emails_list;
}}

$emails = emails_array_to_string($emails_array);


    $headers = "MIME-Version: 1.0\r\n"."Content-type: text/plain; charset=utf-8\r\n"."Заявка на обратный звонок на $site_name \r\n";

    $sendSuccess = wp_mail(
        $emails,
        $subject,
        $message,
        $headers
    );


    if(!$sendSuccess){
        wp_send_json_error("WP_mail  not send");
    }

    wp_send_json_success('<b>Gracias!</b><br>Su mensage a sido enviado!');

}
?>



































