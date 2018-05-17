<?php
/**
 * Регистрация собственных кастомных типов постов
 * на данном примере это будут посты (обьявления)
 * ---------------------------------------------------------------------------------------------------------------------
 */
add_action( 'init', 'true_register_post_type_init' ); // Использовать функцию только внутри хука init

function true_register_post_type_init() {
	$labels = array(
		'name' => 'Обьявления',
		'singular_name' => 'Обьявление', // админ панель Добавить->Обьявление
		'add_new' => 'Добавить Обьявление',
		'add_new_item' => 'Добавить новое Обьявление', // заголовок тега <title>
		'edit_item' => 'Редактировать Обьявление',
		'new_item' => 'Новае Обьявление',
		'all_items' => 'Все Обьявления',
		'view_item' => 'Просмотреть Обьявлений на сайте',
		'search_items' => 'Искать Обьявление',
		'not_found' =>  'Обьявлений не найдено.',
		'not_found_in_trash' => 'В корзине нет Обьявлений.',
		'menu_name' => 'Merely_igor' // ссылка в меню в админке
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'show_ui' => true, // показывать интерфейс в админке
		'has_archive' => true,
		'menu_icon' => get_stylesheet_directory_uri() .'/img/custom_post_icon.png', // путь к иконке для админки
		'menu_position' => 20, // порядок в меню админки
		'supports' => array( 'title', 'editor', 'comments', 'author', 'thumbnail')
	);
	register_post_type('the_name_post_type', $args); //регистрация названия типа постов
}



/************** ------- Тексты уведомлений в админке для кастомного типа постов ------- **************/
add_filter( 'post_updated_messages', 'true_post_type_messages' );

function true_post_type_messages( $messages ) {
	global $post, $post_ID;

	$messages['the_name_post_type'] = array( // the_name_post_type - название созданного нами типа записей
		0 => '', // Данный индекс не используется.
		1 => sprintf( 'Обьявление обновлено. <a href="%s">Просмотреть</a>', esc_url( get_permalink($post_ID) ) ),
		2 => 'Параметр обновлён.',
		3 => 'Параметр удалён.',
		4 => 'Обьявление обновлено',
		5 => isset($_GET['revision']) ? sprintf( 'Обьявление восстановлено из редакции: %s', wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( 'Обьявление опубликовано на сайте. <a href="%s">Просмотреть</a>', esc_url( get_permalink($post_ID) ) ),
		7 => 'Обьявление сохранено.',
		8 => sprintf( 'Отправлено на проверку. <a target="_blank" href="%s">Просмотреть</a>', esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( 'Запланировано на публикацию: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Просмотреть</a>', date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( 'Черновик обновлён. <a target="_blank" href="%s">Просмотреть</a>', esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	);

	return $messages;
}

/************** ------- Вкладка «Помощь» ------- **************/

function true_post_type_help_tab() {

	$screen = get_current_screen();

	// Прекращаем выполнение функции, если находимся на страницах других типов постов
	if ( 'the_name_post_type' != $screen->post_type ) //нужно указать название кастомного типа постов
		return;

	// Массив параметров для первой вкладки
	$args = array(
		'id'      => 'tab_1',
		'title'   => 'Обзор',
		'content' => '<h3>Обзор</h3><p>Содержимое первой вкладки.</p>'
	);

	// Добавляем вкладку
	$screen->add_help_tab( $args );

	// Массив параметров для второй вкладки
	$args = array(
		'id'      => 'tab_2',
		'title'   => 'Доступные действия',
		'content' => '<h3>Доступные действия с типом постов &laquo;' . $screen->post_type . '&raquo;</h3><p>Содержимое второй вкладки</p>'
	);

	// Добавляем вторую вкладку
	$screen->add_help_tab( $args );

}

add_action('admin_head', 'true_post_type_help_tab');



/************** ------- ДЛЯ ВЫВОДА ПОСТОВ В ЛЮБОМ ШАБЛОНЕ ИСПОЛЬЗОВАТЬ ПРИМЕР ЦЫКЛА ПРЕДСТАВЛЕНОГО НИЖЕ
---------начало цыкла
			<?php
			$args = array(
			'post_type' => 'advert',
			'publish' => true,
			'paged' => get_query_var('paged'),
			);
			query_posts($args);
			// if ( have_posts() ) : the_post();
			while ( have_posts()) : the_post();
			?>
 * -------- <?php the_permalink(); ?> // вывод ссылки на пост
 * -------- <?php the_post_thumbnail_url("medium"); ?> // вывод ссылки изображения на пост
 * -------- <? the_title();?> // вывод заголовка поста
 * -------- <?php the_time(' d/m/Y'); ?> // вывод даты поста
 * -------- <?php the_excerpt(); ?> // вывод превью текста поста
 * -------- <?php the_content() ?> // вывод всего контента поста

----------- тут выводится превью поста или кастомные поля
---------- для вывода кастомных полей в цыкле превью постов используй пример ниже
            <?= the_field('name_field'); ?>

			<?php endwhile; // else: ?>
			<?php// _e('Sorry, no posts matched your criteria.'); ?>
			<?php// endif; ?>




 * ------- **************/


