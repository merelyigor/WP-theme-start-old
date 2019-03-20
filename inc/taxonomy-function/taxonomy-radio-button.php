<?php
/**
 * radio buttons in the rubric selection block
 * ---------------------------------------------------------------------------------------------------------------------
 */
add_action('admin_menu', function () {

    // list taxonomies comma separated - now only category
    $choosed_taxonomies = array('category');

    if (empty($choosed_taxonomies))
        return;

    foreach ($choosed_taxonomies as $tax_name) {
        $taxonomy = get_taxonomy($tax_name);

        // metaboxes will be added only for taxonomies with hierarchy
        if (!$taxonomy->hierarchical || !$taxonomy->show_ui || empty($taxonomy->object_type))
            continue;

        foreach ($taxonomy->object_type as $post_type) {

            // remove standard metabox
            remove_meta_box("{$tax_name}div", $post_type, 'side');

            // add your own
            add_meta_box("unique-{$tax_name}-div", $taxonomy->labels->singular_name, 'tr_tax_metabox', $post_type, 'side', 'high', array('taxonomy' => $tax_name));
        }
    }
});

/*
 * function to display the list of taxonomy elements directly
 */
function tr_print_radiolist($post_id, $taxonomy)
{
    $terms = get_terms($taxonomy, array('hide_empty' => false, 'parent' => 0));
    if (empty($terms))
        return;

    // the value of the name attribute for all radio-buttons
    $name = ($taxonomy == 'category') ? 'post_category' : "tax_input[{$taxonomy}]";

    // determine which rubrics the current post belongs to
    $current_post_terms = get_the_terms($post_id, $taxonomy);
    $current = array();
    if (!empty($current_post_terms)) {
        foreach ($current_post_terms as $current_post_term)
            $current[] = $current_post_term->term_id;
    }

    // list output
    $list = '';
    foreach ($terms as $term) {
        $list .= "<li id='{$taxonomy}-{$term->term_id}'>";
        $list .= "<label class='selectit'>";
        $list .= "<input type='radio' name='{$name}[]' value='{$term->term_id}' " . checked(in_array($term->term_id, $current), true, false) . " id='in-{$taxonomy}-{$term->term_id}' />";
        $list .= " {$term->name}</label>";
        $list .= "</li>\n";

        // если вам наплевать на вложенные рубрики, то цикл foreach можно закончить прямо здесь
        $childs = get_terms($taxonomy, array('hide_empty' => false, 'parent' => $term->term_id));
        if (count($childs) > 0) {
            $list .= "<ul class='children'>";
            foreach ($childs as $child) {
                $list .= "<li id='{$taxonomy}-{$child->term_id}'>";
                $list .= "<label class='selectit'>";
                $list .= "<input type='radio' name='{$name}[]' value='{$child->term_id}' " . checked(in_array($child->term_id, $current), true, false) . " id='in-{$taxonomy}-{$child->term_id}' />";
                $list .= " {$child->name}</label>";
                $list .= "</li>\n";
            }
            $list .= "</ul>";
        }
    }
    return $list;
}

/*
 * содержимое метабокса
 */
function tr_tax_metabox($post, $box)
{
    if (!isset($box['args']) || !is_array($box['args']))
        $args = array();
    else
        $args = $box['args'];

    $defaults = array('taxonomy' => 'category');
    extract(wp_parse_args($args, $defaults), EXTR_SKIP);
    $tax = get_taxonomy($taxonomy);

    $name = ($taxonomy == 'category') ? 'post_category' : 'tax_input[' . $taxonomy . ']';

    $metabox = "<div id='taxonomy-{$taxonomy}' class='categorydiv'>";
    $metabox .= "<input type='hidden' name='{$name}' value='0' />";
    $metabox .= "<ul id='{$taxonomy}-tabs' class='category-tabs'>";
    $metabox .= "<li class='tabs'><a href='#{$taxonomy}-all' tabindex='3'>{$tax->labels->all_items}</a></li>";
    $metabox .= "</ul>";
    $metabox .= "<div id='{$name}-all' class='tabs-panel'>";
    $metabox .= "<ul id='{$taxonomy}checklist' class='list:{$taxonomy} categorychecklist form-no-clear'>";
    echo $metabox;

    echo tr_print_radiolist($post->ID, $taxonomy);

    echo "</ul></div></div>";
}
