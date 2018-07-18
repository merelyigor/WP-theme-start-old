<?php
/**
 * Запароленные записи
 * ---------------------------------------------------------------------------------------------------------------------
 */

/************** ------- Колличество дней на запоминание пароля на защищенные посты и страницы ------- **************/
function true_change_pass_exp($exp)
{
    return time() + 1 * DAY_IN_SECONDS; // 5 дней к примеру
}

add_filter('post_password_expires', 'true_change_pass_exp', 10, 1);


/************** ------- Изменение формы ввода пароля на страницах сайта ------- **************/
function true_new_post_pass_form()
{
    /*
     * в принципе тут нужно обратить внимание на три вещи:
     * 1) куда ссылается форма, а также method=post
     * 2) значение атрибута name поля для ввода - post_password
     * 3) атрибуты size и maxlength поля для ввода должны быть меньше или равны 20 (про длину пароля я писал выше)
     * Во всём остальном у вас полная свобода действий!
     */
    return '<form action="' . esc_url(site_url('wp-login.php?action=postpass', 'login_post')) . '" method="post">
    <p>Данная запись защищена и предназначена для определенного пользователя - если содержимое записи предназначено для просмотра вами вы должны разпологать
     паролем от записи данным вам от администратора, если у вас нет пароля обратитесь к администратору.</p>
    <p>
	<label for="pwbox-374">
	<input class="input_password_post" name="post_password" type="password" size="20" placeholder="Пароль к записи" maxlength="20" />
	</label>
	<input class="button_password_post" type="submit" name="Submit" value="Разблокировать" />
	</p>
	</form>';
}
add_filter('the_password_form', 'true_new_post_pass_form'); // вешаем функцию на фильтр the_password_form


/************** ------- Цытата запароленной записи - вывод ------- **************/
function true_protected_excerpt_text( $excerpt ) {
    if ( post_password_required() )
        $excerpt = '<em>[Запись заблокирована. Перейдите к прочтению записи для ввода пароля или обратитесь к администратору.]</em>';
    return $excerpt; // если запись не защищена, будет выводиться стандартная цитата
}
add_filter( 'the_excerpt', 'true_protected_excerpt_text' );


/************** ------- Небольшая модификация для SQL запроса, получающего посты что бы работало скрытие постов описаное ниже ------- **************/
function true_exclude_pass_posts($where) {
    global $wpdb;
    return $where .= " AND {$wpdb->posts}.post_password = '' ";
}


/************** ------- При помощи этого фильтра определим, на каких именно страницах будет скрывать защищенные посты ------- **************/
function true_where_to_exclude($query) {
    if( is_front_page() ) { // например на главной странице
        add_filter( 'posts_where', 'true_exclude_pass_posts' );
    }
}

add_action('pre_get_posts', 'true_where_to_exclude');
