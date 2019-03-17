<?php
/**
 * Register menu + remove container + remove classes and menu item id
 * ---------------------------------------------------------------------------------------------------------------------
 */


add_action('after_setup_theme', function () {
    register_nav_menus(array(
        'top' => 'top menu location',
        'bottom' => 'bottom menu location'
    ));
});

add_filter('wp_nav_menu_args', function ($args = '') {
    $args['container'] = false; //remove the container
    return $args;
});


// remove classes and menu item id

add_filter('nav_menu_css_class', function ($classes) {
    $classes = '';
    return $classes;
}, 10, 2); // remove the menu item classes


/**
 * to display the top menu, insert --- <?php wp_nav_menu('menu_class=bmenu&theme_location=top'); ?>
 * to display the bottom menu, paste --- <?php wp_nav_menu('menu_class=bmenu&theme_location=bottom'); ?>
 * parsing - menu_class = class is written for ul menu list wrapper
 * parsing - theme_location = written menu identifier specified during registration menu ('top'    => 'Верхнее меню', ) top - this is an identifier
 * ---------------------------------------------------------------------------------------------------------------------
 */
// Your html menu building class:
class My_Walker_Nav_Menu extends Walker_Nav_Menu
{


    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = ($depth) ? str_repeat($t, $depth) : '';

        $classes = empty($item->classes) ? array() : (array)$item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $args = apply_filters('nav_menu_item_args', $args, $item, $depth);

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        // создаем HTML код элемента меню
        $output .= $indent . '<li' . $id . $class_names . '>';

        $atts = array();
        $atts['title'] = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel'] = !empty($item->xfn) ? $item->xfn : '';
        $atts['href'] = !empty($item->url) ? $item->url : '';

        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $title = apply_filters('the_title', $item->title, $item->ID);
        $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . $title . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

}

