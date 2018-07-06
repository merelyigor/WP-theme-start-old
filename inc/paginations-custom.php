<?php
/**
 * кастомная пагинация
 * ---------------------------------------------------------------------------------------------------------------------
 */


function custom_comment_pagination($range = 2){
    global $wp_rewrite;

    $current_page = get_query_var('cpage');
    $total_pages = get_comment_pages_count();
    $showitems = ($range * 2) + 1;
    $template = '';
    $url_base = user_trailingslashit(trailingslashit(get_permalink()) . $wp_rewrite->comments_pagination_base . '-', 'commentpaged');


    $template .= '<div class="pagination">';

    if($current_page > 1 && $total_pages > $showitems){
        $prev_link = "<a class='pagination__arrow l-left' href='".$url_base . ($current_page - 1) ."'><svg><use xlink:href='#arrow-left'></use></svg></a>";
        $template .= $prev_link;
    }

    if($current_page > $range + 1 && $total_pages > $showitems){
        $template .= "<a class='pagination__item' href='".$url_base . "1'>1</a>";
    }

    if($current_page > $range + 2 && $total_pages > $showitems ){
        $template .= "<span class='pagination__item l-dots'>...</span>";
    }

    for( $key = 1; $key <= $total_pages; $key++){

        if (1 != $total_pages && ( !($key >= $current_page + ($range + 1) || $key <= $current_page - ($range + 1) ) || $total_pages <= $showitems )) {

            if($current_page == $key){
                $template .= "<span class='pagination__item active'>". $key ."</span>";
            }else{
                $template .= "<a class='pagination__item' href='".$url_base . $key ."'>". $key ."</a>";
            }
        }
    }

    if($current_page < $total_pages - ($range + 1)  && $total_pages > $showitems ){
        $template .= "<span class='pagination__item l-dots'>...</span>";
    }

    if($current_page <= $total_pages - ($range + 1 ) && $total_pages > $showitems){
        $template .= "<a class='pagination__item' href='".$url_base . $total_pages . "'>". $total_pages ."</a>";
    }


    if($current_page < $total_pages && $total_pages > $showitems){
        $next_link = "<a class='pagination__arrow l-right' href='".$url_base . ($current_page + 1) ."'><svg><use xlink:href='#arrow-right'></use></svg></a>";
        $template .= $next_link;
    }

    $template .= '</div>';


    echo ($total_pages > 1) ? $template : '';
}

/********

    выводим пагинацию

<?php custom_comment_pagination(1); ?>

    ******/

