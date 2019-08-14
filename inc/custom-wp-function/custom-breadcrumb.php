<?php
/**
 * Bread crumbs
 * ---------------------------------------------------------------------------------------------------------------------
 */
function get_the_breadcrumb(
    $name_template = '$name_template not given',
    $breadcrumbs_title = 'breadcrumb $breadcrumbs_title not given',
    $before_uri = '$before_uri not given',
    $before_title = '$before_title not given'
)
{

    if (!is_home()) {

        if ($name_template == 'name_template') {

            $html = '<li><a href="/">Главная</a></li>
                     <li><a style="cursor: default;pointer-events: none">' . $breadcrumbs_title . '</a></li>';

            return $html;

        } elseif ($name_template == 'name_template') {

            $html = '<li><a href="/">Главная</a></li>
                     <li><a href="' . $before_uri . '/">' . $before_title . '</a></li>
                     <li><a style="cursor: default;pointer-events: none">' . $breadcrumbs_title . '</a></li>';

            return $html;

        }

    }

}