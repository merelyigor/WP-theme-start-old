<?php
/**
 * Register your own custom post types
 * ---------------------------------------------------------------------------------------------------------------------
 */

// Renaming Records label and related links / tips:
add_action('admin_menu', function () {
    global $menu, $submenu;
    $menu[5][0] = static_text('Новости', 'russian', 'ukr');
    $submenu['edit.php'][5][0] = static_text('Новости', 'russian', 'ukr');
    $submenu['edit.php'][10][0] = static_text('Добавить Новость', 'russian', 'ukr');
    $submenu['edit.php'][16][0] = static_text('Метки Новости', 'russian', 'ukr');
    echo '';
});
add_action('init', function () {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = static_text('Новости', 'russian', 'ukr');
    $labels->singular_name = static_text('Новости', 'russian', 'ukr');
    $labels->add_new = static_text('Добавить новость', 'russian', 'ukr');
    $labels->add_new_item = static_text('Добавить новость', 'russian', 'ukr');
    $labels->edit_item = static_text('Редактировать новость', 'russian', 'ukr');
    $labels->new_item = static_text('Добавить новость', 'russian', 'ukr');
    $labels->view_item = static_text('Посмотреть новость', 'russian', 'ukr');
    $labels->search_items = static_text('Найти новость', 'russian', 'ukr');
    $labels->not_found = static_text('Новостей не найдено', 'russian', 'ukr');
    $labels->not_found_in_trash = static_text('В корзине нет новостей', 'russian', 'ukr');
});


/************** ------- The texts of notifications in the admin for custom post type ------- **************/
add_filter('post_updated_messages', function ($messages) {
    global $post, $post_ID;

    $post_type_name = 'custom-post-type';
    $messages[$post_type_name] = array(
        0 => '', // This index is not used.
        1 => sprintf(static_text('Обновлено.', 'russian', 'ukr') .
            ' <a href="%s">' . static_text('Посмотреть', 'russian', 'ukr') . '</a>'
            , esc_url(get_permalink($post_ID))),
        2 => static_text('Параметр обновлен.', 'russian', 'ukr'),
        3 => static_text('Параметр удалён.', 'russian', 'ukr'),
        4 => static_text('Параметр обновлён.', 'russian', 'ukr'),
        5 => isset($_GET['revision']) ? sprintf(static_text('Запись восстановлена из редакции', 'russian', 'ukr') . ': %s',
            wp_post_revision_title((int)$_GET['revision'], false)) : false,
        6 => sprintf(static_text('Запись опубликована на сайте.', 'russian', 'ukr') .
            ' <a href="%s">' . static_text('Посмотреть', 'russian', 'ukr') . '</a>',
            esc_url(get_permalink($post_ID))),
        7 => static_text('Запись сохранена.', 'russian', 'ukr'),
        8 => sprintf(static_text('Отправлено на проверку.', 'russian', 'ukr') .
            ' <a target="_blank" href="%s">' . static_text('Посмотреть', 'russian', 'ukr') . '</a>',
            esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
        9 => sprintf(static_text('Запланировано на публикацию', 'russian', 'ukr') .
            ': <strong>%1$s</strong>. <a target="_blank" href="%2$s">' .
            static_text('Посмотреть', 'russian', 'ukr') . '</a>',
            date_i18n(__('M j, Y @ G:i'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
        10 => sprintf(static_text('Черновик оновлен.', 'russian', 'ukr') .
            ' <a target="_blank" href="%s">' . static_text('Посмотреть', 'russian', 'ukr') . '</a>',
            esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
    );

    return $messages;
});


/************** ------- Tab «help» ------- **************/
add_action('admin_head', function () {

    $post_type_name = 'custom-post-type'; //you must specify the name of the custom type of posts
    $screen = get_current_screen();

    // Stop the function if you are on the pages of other types of posts
    if ($post_type_name != $screen->post_type)
        return;

    // Array of parameters for the first tab
    $args = array(
        'id' => 'tab_1',
        'title' => static_text('Обзор', 'russian', 'ukr'),
        'content' => '<h3>' . static_text('Обзор', 'russian', 'ukr') .
            '</h3><p>' . static_text('Содержание первой вкладки.', 'russian', 'ukr') . '</p>'
    );

    // Add a tab
    $screen->add_help_tab($args);

    // Array of parameters for the second tab
    $args = array(
        'id' => 'tab_2',
        'title' => static_text('Доступные действия', 'russian', 'ukr'),
        'content' => '<h3>' . static_text('Доступные действия с типом постов', 'russian', 'ukr') .
            ' &laquo;' . $screen->post_type . '&raquo;</h3><p>' . static_text('Содержание второй вкладки.', 'russian', 'ukr') . '</p>'
    );

    // Add the second tab
    $screen->add_help_tab($args);

});


add_action('init', function () {
    /************** ------- Registration Documents ------- **************/

    $post_type_name = 'custom-post-type';
    $labels = array(
        'name' => static_text('Кастом-зписи', 'russian', 'ukr'),
        'singular_name' => static_text('Кастом-зпись', 'russian', 'ukr'),
        'add_new' => static_text('Добавить кастом-зпись', 'russian', 'ukr'),
        'add_new_item' => static_text('Добавить новую кастом-зпись', 'russian', 'ukr'),
        'edit_item' => static_text('Редактировать кастом-зпись', 'russian', 'ukr'),
        'new_item' => static_text('Навая кастом-зпись', 'russian', 'ukr'),
        'all_items' => static_text('Все кастом-записи', 'russian', 'ukr'),
        'view_item' => static_text('Посмотреть кастом-запись на сайте', 'russian', 'ukr'),
        'search_items' => static_text('Искать кастом-запись', 'russian', 'ukr'),
        'not_found' => static_text('Кастом-записей не найдено', 'russian', 'ukr'),
        'not_found_in_trash' => static_text('В корзине нет кастом-записей', 'russian', 'ukr'),
        'menu_name' => static_text('Кастом-записи', 'russian', 'ukr'),
        'insert_into_item' => static_text('Вставить в запись', 'russian', 'ukr'),
        'uploaded_to_this_item' => static_text('Загружено для этой записи', 'russian', 'ukr'),
        'featured_image' => static_text('Миниатюра записи', 'russian', 'ukr'),
        'set_featured_image' => static_text('Вставить миниатюру в запись', 'russian', 'ukr'),
        'remove_featured_image' => static_text('Удалить миниатюру записи', 'russian', 'ukr'),
        'use_featured_image' => static_text('Использовать как миниатюру записи', 'russian', 'ukr'),
        'filter_items_list' => static_text('Фильтровать список записей', 'russian', 'ukr'),
        'items_list_navigation' => static_text('Навигация по записям', 'russian', 'ukr'),
        'items_list' => static_text('Список записей', 'russian', 'ukr'),
        'attributes' => static_text('Название для метабокса атрибутов записи', 'russian', 'ukr'),
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true, // show interface in admin panel
        'has_archive' => true,
        'menu_icon' => 'dashicons-menu', // https://developer.wordpress.org/resource/dashicons/
        'menu_position' => 4, // order in the admin menu
        'supports' => array('title', 'editor', 'author', 'revisions'),
//        'taxonomies' => array('category'), // indicates that this type of post will have rubrics
        'show_in_admin_bar' => true, //Make this type available from the admin bar.
        'show_in_nav_menus' => true, //Enable the ability to select this type of entry in the navigation menu.
        'exclude_from_search' => false //Whether to exclude this type of records from site search. 1 (true) - yes, 0 (false) - no.
    );
    register_post_type($post_type_name, $args); //регистрация названия типа постов для кастомного поста
    flush_rewrite_rules(); // перезагрузка урлов для правильного построения ЧПУ wp после регистрации типа поста

    $taxonomy_type_name = 'custom-taxonomy-type';
    $taxonomy_type_name_uri = 'custom-taxonomy-url';
    /************** ------- Taxonomy registration for custom post ------- **************/
    $labels = array(
        'name' => _x(static_text('Категории кастом-записей', 'russian', 'ukr'),
            static_text('Главное название тасономии', 'russian', 'ukr')),
        'singular_name' => _x(static_text('Категория кастом-записи', 'russian', 'ukr'),
            static_text('Название одной таксономии', 'russian', 'ukr')),
        'search_items' => __(static_text('Поиск по категориям кастом-записей', 'russian', 'ukr')),
        'all_items' => __(static_text('Все категории кастом-записей', 'russian', 'ukr')),
        'parent_item' => __(static_text('Родительские категории кастом-записей', 'russian', 'ukr')),
        'parent_item_colon' => __(static_text('Родительская категория кастом-записи:', 'russian', 'ukr')),
        'edit_item' => __(static_text('Редактировать категорию кастом-записи', 'russian', 'ukr')),
        'update_item' => __(static_text('Обновить категорию кастом-записи', 'russian', 'ukr')),
        'add_new_item' => __(static_text('Добавить категорию кастом-записи', 'russian', 'ukr')),
        'view_item' => __(static_text('Посмотреть категорию кастом-записи', 'russian', 'ukr')),
        'new_item_name' => __(static_text('Создать новую категорию кастом-записи', 'russian', 'ukr')),
        'menu_name' => __(static_text('категории кастом-записей', 'russian', 'ukr')),
    );
    register_taxonomy($taxonomy_type_name, array($post_type_name), array( // register taxonomy $taxonomy_type_name for custom post $post_type_name
        'hierarchical' => true, // tree attachment - if you remove it, it will be displayed not by headings but by tags
        'labels' => $labels, // taken with name
        'show_ui' => true, // show in admin
        'query_var' => true, // parameter connection - rewrite
        'rewrite' => array('slug' => $taxonomy_type_name_uri),
    ));


});
