<?php
/**
 * функция добавления своего аватара в админку для дефолтного отображения
 * ---------------------------------------------------------------------------------------------------------------------
 */
add_filter('avatar_defaults', 'newgravatar');

function newgravatar($avatar_defaults)
{
	$myavatar = get_bloginfo('template_directory') . '/img/ava.png'; //путь к аватарке от темы
	$avatar_defaults[$myavatar] = "Название данной аватарки в админке при выборе аватарки";
	return $avatar_defaults;
}