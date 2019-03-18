<?php

/**
 * Adding custom css to the login and authorization pages or admin panel
 * ---------------------------------------------------------------------------------------------------------------------
 */

/************** ------- login and authorization pages css ------- **************/
add_action('login_head', function () {
    ob_start();
    ?>
    <style type="text/css">
        .example {
            color: #856644;
        }
    </style>
    <script>
        console.log('head custom script wp_admin_css function <?= 'login_head' ?>');
    </script>
    <?php
    echo ob_get_clean();
});


/************** ------- /wp-admin/ admin panel css ------- **************/


add_action('admin_head', function () {
    ob_start();
    ?>
    <style type="text/css">
        .example {
            color: #856644;
        }
    </style>
    <script>
        console.log('head custom script wp_admin_css function <?= 'admin_head' ?>');
    </script>
    <?php
    echo ob_get_clean();
});