<?php

function search_results_exclude($query) {
    if ($query->is_search) {
        $query->set('post_type', 'post'); // исключить все страницы (не посты)
//        $query->set('cat','4298,1015'); // исключить рубрики по ID
//        $query->set('post__not_in', array( 350, 13, 218 )); // исключить посты или страницы по ID
    }
    return $query;
}
add_filter('pre_get_posts','search_results_exclude');


/************** ------- включает кастомные посты в результаты поиска ------- **************/
function search_add($query) {
    if ($query->is_search) {
        $query->set('post_type', array('post', 'type_post') ); // в поиске можно искать стандартным постам 'post' и так же постам с типом 'movie'
    }
    return $query;
}
add_filter('pre_get_posts','search_add');


/************** ------- выводить в поиске только посты принадлежащие к данным рубрикам или категориям ------- **************/
//function searchcategory($query) {
//    if ($query->is_search) {
//        $query->set(category__in, array(1,84)); // несколько разделять запятыми
//        $query->set(category__in, 84);// одна рубрика
//    }
//    return $query;
//}
//add_filter('pre_get_posts','searchcategory');



/************** ------- Изменение количества выводимых постов на странице результата поиска ------- **************/
//add_action('pre_get_posts', 'hwl_home_pagesize', 1 );
//function hwl_home_pagesize( $query ) {
//    // Выходим, если это админ-панель или не основной запрос.
//    if( is_admin() || ! $query->is_main_query() )
//        return;
//
//    if( is_home() ){
//        // Выводим только 1 пост на главной странице
//        $query->set( 'posts_per_page', 1 );
//    }
//
//    if( $query->is_post_type_archive('type_post') ){
//        // Выводим 50 записей если это архив кастомного типа записи 'type_post'
//        $query->set( 'posts_per_page', 50 );
//    }
//}




/************** ------- настройка вывода количевства найденых постов --- вывод <?= search_results_title(); ?> ------- **************/
function search_results_title() {
    if( is_search() ) {

        if( is_search() ) {

            global $wp_query;

            if( $wp_query->post_count == 1 ) {
                $result_title .= 'найдено всего 1 результат';
            } else {
                $result_title .= $wp_query->found_posts . ' | найденых результатов';
            }

            $result_title .= " по запросу «" . wp_specialchars($wp_query->query_vars['s'], 1) . "»";

            echo $result_title;
            wp_reset_postdata();

        }

    }
}


/**  -------------------- Весь список свойств которые можно использовать вместо условного тега
$query->is_404
$query->is_admin
$query->is_archive
$query->is_attachment
$query->is_author
$query->is_category
$query->is_comments_popup
$query->is_comment_feed
$query->is_date
$query->is_day
$query->is_feed
$query->is_home
$query->is_month
$query->is_page
$query->is_paged
$query->is_posts_page
$query->is_post_type_archive
$query->is_preview
$query->is_robots
$query->is_search
$query->is_single
$query->is_singular
$query->is_tag
$query->is_tax
$query->is_time
$query->is_trackback
$query->is_year

// функции
$query->is_front_page()
$query->is_main_query()
 **/