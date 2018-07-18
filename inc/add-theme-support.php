<?php
/**
 * Глобальные Функции темы
 * ---------------------------------------------------------------------------------------------------------------------
 */
function the_theme_name()
	//Позволяет темам или плагинам регистрировать поддержку новых возможностей в WordPress
	// (поддержка миниатюр, форматов записей и т.д.).
{
	/************** ------- тег title в шапке ------- **************/
	add_theme_support('title-tag');
	//Если активировать эту опцию для темы,
	// то в теме не нужно устанавливать метатег <title><?php wp_title() ?/><!--</title>
	// - он будет подключен автоматически через хук wp_head.-->
	/************** для вывода в шапке подключать так ------- <title><?php bloginfo('name'); ?> |
    <?php is_home() ? bloginfo('description') : wp_title(''); ?></title> ------- **************/




	/************** ------- логотип и указание размера ------- **************/
	add_theme_support('custom-logo', array(
		'height' => 270,
		'width' => 270,
		'flex-height' => true
	));



	/************** ------- медиа (картинки) в постах и их размер - уже есть в post-settings.php inc ------- **************/
//	add_theme_support('post-thumbnails');
//	set_post_thumbnail_size(450, 450);
//    add_image_size( 'name-theme', 450, 450, true );
	//Позволяет устанавливать миниатюру посту
	// Вы можете передать второй аргумент функции в виде массива, в котором указать для каких типов постов разрешить миниатюры:
	//	Чтобы вывести миниатюру в файле темы (index.php или single.php и т.д.) используем функцию the_post_thumbnail():



	/************** ------- поддержка html5 форм ------- **************/
	add_theme_support('html5', array(
		'search_form',
		'comment_form',
		'comment-list',
		'gallery',
		'caption'
	));//Включает поддержку html5 разметки для списка комментариев,
	// формы комментариев, формы поиска, галереи и т.д. Где нужно включить разметку указывается во втором параметре



	/************** ------- поддержка html5 форм ------- **************/
	add_theme_support('post-formats', array(
		'aside',
		'image',
		'video',
		'gallery'
	));// Позволяет добавлять разные типы для создаваемых постов, типы выбираются при публикации поста во вкладке (формат) внутри поста
	// так же по умолчанию есть тип (стандартный - post) для проверки на условие формата поста использовать данное условие
	//	if ( has_post_format( 'quote' ) ) {
	//		echo 'Это quote.';
	//	}



//    уже есть в nav-register-menu.php inc

//    register_nav_menus( array(
//        'primary' => __( 'Primary Menu', 'topshop' ),
//        'top-bar' => __( 'Top Bar Menu', 'topshop' )
//    ) );

}

add_action('after_setup_theme', 'the_theme_name');








/************** ------- Делаем редирект 301 с высокого регистра на нижний - с http://semple-site.ru/POSTUPLENIE в http://semple-site.rupostuplenie ------- **************/

if ( $_SERVER['REQUEST_URI'] != strtolower( $_SERVER['REQUEST_URI']) ) {
    header('Location: http://'.$_SERVER['HTTP_HOST'] .
        strtolower($_SERVER['REQUEST_URI']), true, 301);
    exit();
}

