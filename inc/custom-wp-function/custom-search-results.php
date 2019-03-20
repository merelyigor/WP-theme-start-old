<?php

/************** ------- Excludes from search by post type and other parameters transmitted in WP_Query{$query}. ------- **************/
add_filter('pre_get_posts', function ($query) {
    if ($query->is_search) {
        $query->set('post_type', 'post-type'); //post type that is excluded from the search
//        $query->set('cat','4298,1015'); // exclude rubrics by ID
//        $query->set('post__not_in', array( 350, 13, 218 )); //exclude posts or pages by id
    }
    return $query;
});


/************** ------- includes custom posts in search results ------- **************/
add_filter('pre_get_posts', function ($query) {
    if ($query->is_search) {
        $query->set('post_type', array('post', 'type_post'));
    }
    return $query;
});


/************** ------- display in the search only posts belonging to these categories or categories ------- **************/
add_filter('pre_get_posts', function ($query) {
    if ($query->is_search) {
        $query->set('category__in', array(1, 84)); // несколько разделять запятыми
        $query->set('category__in', 84);// одна рубрика
    }
    return $query;
});


/************** ------- Chan ge the number of posts displayed on the search result page ------- **************/
add_action('pre_get_posts', function ($query) {
    if (is_admin() || !$query->is_main_query())
        return; // We leave, if this is the admin panel or not the main request.

    if (is_home()) {
        // Display only 1 post on the main page
        $query->set('posts_per_page', 1);
    }

    if ($query->is_post_type_archive('type_post')) {
        // We display 50 records if it is an archive of a custom record type. 'type_post'
        $query->set('posts_per_page', 50);
    }
}, 1);


/**
 * Modify the search query with posts_where ACF filds
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_where
 */

add_filter('posts_where', function ($where) {
    global $pagenow, $wpdb;

    if (is_search()) {
        $where = preg_replace(
            "/\(\s*" . $wpdb->posts . ".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
            "(" . $wpdb->posts . ".post_title LIKE $1) OR (" . $wpdb->postmeta . ".meta_value LIKE $1)", $where);
    }

    return $where;
});

/**
 * Prevent duplicates
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_distinct
 */
add_filter('posts_distinct', function ($where) {
    global $wpdb;

    if (is_search()) {
        return "DISTINCT";
    }

    return $where;
});





/**************  ------- Весь список свойств которые можно использовать вместо условного тега ------- **************
 * $query->is_404
 * $query->is_admin
 * $query->is_archive
 * $query->is_attachment
 * $query->is_author
 * $query->is_category
 * $query->is_comments_popup
 * $query->is_comment_feed
 * $query->is_date
 * $query->is_day
 * $query->is_feed
 * $query->is_home
 * $query->is_month
 * $query->is_page
 * $query->is_paged
 * $query->is_posts_page
 * $query->is_post_type_archive
 * $query->is_preview
 * $query->is_robots
 * $query->is_search
 * $query->is_single
 * $query->is_singular
 * $query->is_tag
 * $query->is_tax
 * $query->is_time
 * $query->is_trackback
 * $query->is_year
 *
 * // функции
 * $query->is_front_page()
 * $query->is_main_query()
 **/
