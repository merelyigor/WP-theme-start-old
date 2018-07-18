<?php
/**
 * функции которые относятся к выводу постов на главной и странице рубрик
 * ---------------------------------------------------------------------------------------------------------------------
 */

/************** ------- Исключить страницы из WordPress Search ------- **************/
if (!is_admin()) {
	function wpb_search_filter($query)
	{
		if ($query->is_search) {
			$query->set('post_type', 'post'); //тип поста который исключается из поиска
		}
		return $query;
	}

	add_filter('pre_get_posts', 'wpb_search_filter');
}

/************** ------- Чистим от br (удаляем тег </br>) ------- **************/
//remove_filter('the_content', 'wpautop');// для контента
//remove_filter( 'the_excerpt', 'wpautop' );// для анонсов
//remove_filter( 'comment_text', 'wpautop' );// для комментарий


/************** ------- Вывод превью текста поста - его размеры - текст поста на главной ------- **************/
function new_excerpt_length($length)
{
	return 25; // количество слов для вывода в превью
}

/************** ------- Изминения миниатюры для превью поста на главной ------- **************/
if (function_exists('add_theme_support')) {
	add_theme_support('post-thumbnails');
	set_post_thumbnail_size(540, 9999); // размер миниатюры поста по умолчанию
}

/************** ------- Вывод трех точек после превью текста поста на главной ------- **************/
add_filter('excerpt_length', 'new_excerpt_length');
add_filter('excerpt_more', function ($more) {
	return '...'; // поле где пишутся точки или то что нужно после текста превью поста на главной
});


/************** ------- Уберает поле сайт из формы комментариев ------- **************/
function remove_comment_fields($fields)
{
	unset($fields['url']);
	return $fields;
}

add_filter('comment_form_default_fields', 'remove_comment_fields');