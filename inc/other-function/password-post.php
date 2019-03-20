<?php
/**
 * Password protected
 * ---------------------------------------------------------------------------------------------------------------------
 */

/************** ------- Number of days to remember the password for protected posts and pages ------- **************/
add_filter('post_password_expires', function ($exp) {
    return time() + 1 * DAY_IN_SECONDS; // 5 days for example
}, 10, 1);


/************** ------- Change password entry form on site pages ------- **************/
add_filter('the_password_form', function () {
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
});


/************** ------- Password protected recording - output ------- **************/
add_filter('the_excerpt', function ($excerpt) {
    if (post_password_required())
        $excerpt = '<em>[Запись заблокирована. Перейдите к прочтению записи для ввода пароля или обратитесь к администратору.]</em>';
    return $excerpt;
});

