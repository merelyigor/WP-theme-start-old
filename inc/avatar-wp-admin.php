<?php
/**
 * функция добавления своего аватара в админку для дефолтного отображения
 * ---------------------------------------------------------------------------------------------------------------------
 */
add_filter('avatar_defaults', 'newgravatar');

function newgravatar($avatar_defaults)
{
	$myavatar = get_template_directory_uri() . '/avatar-user-img/ava.png'; //путь к аватарке от темы - продублировать данную строку для добавления доп аватарок
	$avatar_defaults[$myavatar] = "Название данной аватарки в админке при выборе аватарки";
	return $avatar_defaults;
}