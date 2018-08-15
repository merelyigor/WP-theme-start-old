<?php
/**
 * Регистрация меню + убираем контейнер + убираю классы и id элементов меню
 * в данном примере регистрирует три меню - Главное меню - Верхнее меню - Нижнее меню
 * ---------------------------------------------------------------------------------------------------------------------
 */


register_nav_menus(array(
    'top'    => 'Верхнее меню',    //Название месторасположения меню в шаблоне - theme_location
    'bottom' => 'Нижнее меню'      //Название другого месторасположения меню в шаблоне - theme_location
));

add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args');
function my_wp_nav_menu_args($args = '')
{
	$args['container'] = false; //убираем контейнер
	return $args;
}

// убираю классы и id элементов меню
function my_remove_all_class_item($classes) {
	$classes = '';
	return $classes;
}
add_filter('nav_menu_css_class', 'my_remove_all_class_item', 10, 2 ); // убираем классы элементов меню
add_filter('nav_menu_item_id', '__return_false'); // убираем id элементов меню



/**
 * для вывода верхнего меню вставте --- <?php wp_nav_menu('menu_class=bmenu&theme_location=top'); ?>
 * для вывода нижнего меню вставте --- <?php wp_nav_menu('menu_class=bmenu&theme_location=bottom'); ?>
 * разбор - menu_class = пишется класс для ul обертки списка меню
 * разбор - theme_location = пишется идентификатор меню заданный при регистрации меню ('top'    => 'Верхнее меню', ) top - это идентификатор
 * ---------------------------------------------------------------------------------------------------------------------
 */?>

<?php
// main navigation menu
$args = array(
    'theme_location'    => 'top', //локация меню зарегистрированная прежде
    'container_id'      => 'container_id',
    'conatiner_class'   => 'conatiner_class',
    'menu_class'        => 'menu_class',
    'echo'          => true,
    'items_wrap'        => '<ul id="%1$s" class="%2$s">%3$s</ul>',
    'depth'         => 2,
    'walker'        => new My_Walker_Nav_Menu()
);

// print menu
wp_nav_menu( $args );
?>


<?php
// свой класс построения html меню:
class My_Walker_Nav_Menu extends Walker_Nav_Menu {


    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

        // создаем HTML код элемента меню
        $output .= $indent . '<li' . $id . $class_names .'>';

        $atts = array();
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
        $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
        $atts['href']   = ! empty( $item->url )        ? $item->url        : '';

        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $title = apply_filters( 'the_title', $item->title, $item->ID );
        $title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . $title . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

}

