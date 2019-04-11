<?php

/**
 * Overwriting URLs on single posts page.
 * @param string $pre_slug http://www.domain.com/$pre_slug/post-slug
 * @param string $post_type type of post which will have url added
 * use rewrite_rule_pre_url('news', 'post'); http://www.domain.com/news/post-slug-post-type-post
 * only works for uncategorized posts
 */
function rewrite_rule_pre_url($pre_slug = 'pre-slug', $post_type = 'post')
{
    add_action('init', function () use ($pre_slug) {
        add_rewrite_rule("^$pre_slug/([^/]+)/?", 'index.php?name=$matches[1]', 'top');
    });

    add_action('template_redirect', function () use ($pre_slug, $post_type) {
        if (is_main_query() && is_single() && (empty(get_post_type()) || (get_post_type() === $post_type))) {
            if (strpos(trim(add_query_arg(array()), '/'), $pre_slug) !== 0) {
                global $post;
                $url = str_replace($post->post_name, "$pre_slug/" . $post->post_name, get_permalink($post));
                wp_safe_redirect($url, 301);
                exit();
            }
        }
    });

    add_filter('the_permalink', function ($link) use ($pre_slug, $post_type) {
        global $post;
        if ($post->post_type === $post_type) {
            $link = str_replace($post->post_name, "$pre_slug/" . $post->post_name, get_permalink($post));
        }
        return $link;
    });
}
