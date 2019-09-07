<?php

## new var_dump function
function dd($var_dump, $die = false)
{
    echo '<style>
pre {
    color: #850085
}
pre::selection {
    color: #ff0; /* Цвет текста */
    background: #000; /* Цвет фона */
}
  </style>';
    echo '<pre>';
    var_dump($var_dump);
    echo '</pre>';
    if ($die) {
        wp_die();
    }
}


## go to custom admin panel link
function admin_url_custom($mysecretkey = 'superadmin')
{
    if (isset($_GET['admin'])) {
        $seckey = $_GET['admin'];
        setcookie("secretkey", $_GET['admin']);
    } else if (isset($_COOKIE['secretkey'])) {
        $seckey = $_COOKIE['secretkey'];
    } else {
        $seckey = '';
    }
    if ($seckey != $mysecretkey) {
        header("HTTP/1.0 404 Not Found");
        exit;
    }
}

## get valid current page link
function current_url()
{
    $url      = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $validURL = str_replace("&", "&amp", $url);
    return  $validURL;
}

/**
 * Cuts a string to a certain number of characters without breaking words.
 * Supports multibyte encodings.
 * @param string $str String
 * @param int $length length, how many characters to trim
 * @param string $postfix postfix that is added to the string
 * @param string $encoding default encoding 'UTF-8'
 * @return string cropped string
 */
function mbCutString($str, $length, $postfix='...', $encoding='UTF-8')
{
    if (mb_strlen($str, $encoding) <= $length) {
        return $str;
    }

    $tmp = mb_substr($str, 0, $length, $encoding);
    return mb_substr($tmp, 0, mb_strripos($tmp, ' ', 0, $encoding), $encoding) . $postfix;
}

/**
 * Overwriting URLs on single posts page.
 * @param string $pre_slug http://www.domain.com/$pre_slug/post-slug
 * @param string $post_type type of post which will have url added
 * use rewrite_rule_pre_url('news', 'post'); http://www.domain.com/news/post-slug-post-type-post
 * for custom posts use register_post_type('custom-post', 'rewrite' => array('slug' => '/slug'));
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

/**
 * function adds <a rel="nofollow" attribute to display links by standard gallery from shortcod
 * [gallery size="medium" ids="2368,2370,2371"]
 * ---------------------------------------------------------------------------------------------------------------------
 */
add_filter('wp_get_attachment_link', function ($markup, $id, $size, $permalink, $icon, $text) {
    $content = preg_replace("/<a/", "<a rel=\"nofollow\"", $markup, 1);
    return $content;
}, 10, 6);

## File Download Restriction - Set Size
add_filter('upload_size_limit', 'PBP_increase_upload');
function PBP_increase_upload($bytes)
{
    return 90048576; // 1 megabyte
}
