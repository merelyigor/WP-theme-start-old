<?php
/**
 * The function rightly declines the month in the date WP через the_time();
 * ---------------------------------------------------------------------------------------------------------------------
 */
function correct_date($cordate = '')
{
    if (substr_count($cordate, '---') > 0) {
        return str_replace('---', '', $cordate);
    }
    $new_d = array(
        'Январь' => 'Января',
        'Февраль' => 'Февраля',
        'Март' => 'Марта',
        'Апрель' => 'Апреля',
        'Май' => 'Мая',
        'Июнь' => 'Июня',
        'Июль' => 'Июля',
        'Август' => 'Августа',
        'Сентябрь' => 'Сентября',
        'Октябрь' => 'Октября',
        'Ноябрь' => 'Ноября',
        'Декабрь' => 'Декабря'
    );
    return strtr($cordate, $new_d);
}

add_filter('the_date', 'correct_date');
add_filter('get_the_date', 'correct_date');
add_filter('the_time', 'correct_date');
add_filter('get_the_time', 'correct_date');
add_filter('get_post_time', 'correct_date');
add_filter('get_comment_date', 'correct_date');
add_filter('the_modified_time', 'correct_date');
add_filter('get_the_modified_date', 'correct_date');