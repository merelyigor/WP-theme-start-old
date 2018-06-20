<?php
/**
 * удаляет H2 из шаблона пагинации
 * ---------------------------------------------------------------------------------------------------------------------
 */


add_filter('navigation_markup_template', 'my_navigation_template', 10, 2 );
function my_navigation_template( $template, $class ){
    /*
    Вид базового шаблона:
    <nav class="navigation %1$s" role="navigation">
        <h2 class="screen-reader-text">%2$s</h2>
        <div class="nav-links">%3$s</div>
    </nav>
    */

    return '
    <nav class="navigation %1$s" role="navigation">
        <div class="nav-links">%3$s</div>
    </nav>    
    ';
}

/********

    выводим пагинацию

<?php the_posts_pagination( array(
'mid_size' => 2, //страниц до ...
'end_size' => 2, // страниц после ...
'show_all' => 2, // показать все
) ); // Вывод пагинации - https://wp-kama.ru/function/the_posts_pagination ?>

    ******/

