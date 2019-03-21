<?php


// Add a menu option to the WordPress Admin sidebar for loading email database CSV FILE CREATED

add_action('admin_menu', function () {
    add_menu_page('Експорт файлу CSV з базою емейлів', 'Експорт емейлів', 'manage_options', 'csv-file-export', 'csvFile', '', 4);
});

function csvFile()
{
    $path = wp_upload_dir();   // or where ever you want the file to go
    $csv_file = fopen($path['path'] . "/mail-export.csv", "w");  // the file name you choose


    $header_colon[] = 'Name';
    $header_colon[] = 'Email';
    fputcsv($csv_file, $header_colon);


    /***********------ get mail list -------**************/
    $my_query = new WP_Query(array(
        'post_type' => 'send-post',
        'posts_per_page' => 999999999999999999,
        'order' => 'DESC',
        'publish' => true,
    ));

    while ($my_query->have_posts()) {
        $my_query->the_post();
        $arr[] = get_field('name');
        $arr[] = get_field('email');
    };
    wp_reset_query();


    foreach ($arr as $key => $item) {

        if ($key % 2 === 0) {
            $val_arr['item1'] = $item;
        }
        if ($key % 2 !== 0) {
            $val_arr['item2'] = $item;
        }

        if ($key % 2 !== 0) {
            fputcsv($csv_file, $val_arr);
        }

    }


    fclose($csv_file);
    $classes = 'class="button button-primary customize load-customize hide-if-no-customize" style="margin-top: 35px;margin-left: 35px"';
    echo '<br><a '. $classes .' href="'. $path['url'] .'/mail-export.csv">'. static_text('Загрузить базу') .'</a>';
}
