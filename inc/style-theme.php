<?php

/**
 * функция подключение (стили / скрипты) везде кроме страници с id13
 * ---------------------------------------------------------------------------------------------------------------------
 */
function the_theme_name_style_is_page_not_id13()
{
	if (!is_page(13)) { //условие - подключить везде если только это не страница с id-13
		//подключаем внутренний стиль темы
		wp_enqueue_style('название стиля', get_template_directory_uri() . '/style.css', array(), '1.0');//тут подключен шлавный стиль темы
		//подключаем внешние стили из интернета без https://
		wp_enqueue_style('название стилей', '//site.com/styles/built.css');
		//подключаем скрипты в footer
		wp_enqueue_script('название скрипта.js', get_template_directory_uri() . '/js/main.js', array(), '1.0', true);
		//подключаем скрипты в head
		wp_enqueue_script('название скрипта.js', get_template_directory_uri() . '/js/main.head.js', array(), '1.0');
		//подключаем внешние скрипты из интернета в head без https://
		wp_enqueue_script('название скрипта.js', '//site.com/styles/built.css', array(), '1.0');
		//подключаем внешние скрипты из интернета в footer без https://
		wp_enqueue_script('название скрипта.js', '//site.com/styles/built.css', array(), '1.0', true);
	}
}
add_action('wp_enqueue_scripts', 'the_theme_name_style_is_page_not_id13');



/**
 * функция подключение (стили / скрипты) к определенной странице с шаблоном в данном случае id13
 * ---------------------------------------------------------------------------------------------------------------------
 */
function the_theme_name_style_is_page_id13()
{
	if (is_page(13)) { //условие - подключить только если это страница с id-13
		//подключаем внутренний стиль темы
		wp_enqueue_style('название стиля', get_template_directory_uri() . '/style.css', array(), '1.0');//тут подключен шлавный стиль темы
		//подключаем внешние стили из интернета без https://
		wp_enqueue_style('название стилей', '//site.com/styles/built.css');
		//подключаем скрипты в footer
		wp_enqueue_script('название скрипта.js', get_template_directory_uri() . '/js/main.js', array(), '1.0', true);
		//подключаем скрипты в head
		wp_enqueue_script('название скрипта.js', get_template_directory_uri() . '/js/main.head.js', array(), '1.0');
		//подключаем внешние скрипты из интернета в head без https://
		wp_enqueue_script('название скрипта.js', '//site.com/styles/built.css', array(), '1.0');
		//подключаем внешние скрипты из интернета в footer без https://
		wp_enqueue_script('название скрипта.js', '//site.com/styles/built.css', array(), '1.0', true);
	}
}
add_action('wp_enqueue_scripts', 'the_theme_name_style_is_page_id13');



/**
 * функция подключение (стили / скрипты) на все страницы
 * ---------------------------------------------------------------------------------------------------------------------
 */
function the_theme_name_style_default()
{
	//подключаем внутренний стиль темы
	wp_enqueue_style('название стиля', get_template_directory_uri() . '/style.css', array(), '1.0');//тут подключен шлавный стиль темы
	//подключаем внешние стили из интернета без https://
	wp_enqueue_style('название стилей', '//site.com/styles/built.css');
	//подключаем скрипты в footer
	wp_enqueue_script('название скрипта.js', get_template_directory_uri() . '/js/main.js', array(), '1.0', true);
	//подключаем скрипты в head
	wp_enqueue_script('название скрипта.js', get_template_directory_uri() . '/js/main.head.js', array(), '1.0');
	//подключаем внешние скрипты из интернета в head без https://
	wp_enqueue_script('название скрипта.js', '//site.com/styles/built.css', array(), '1.0');
	//подключаем внешние скрипты из интернета в footer без https://
	wp_enqueue_script('название скрипта.js', '//site.com/styles/built.css', array(), '1.0', true);
    //подключаем AJAX скрипта от wp
    wp_enqueue_script('main', get_site_url() . '/wp-admin/admin-ajax.php', array(),time(),true);
}
add_action('wp_print_styles', 'the_theme_name_style_default');
