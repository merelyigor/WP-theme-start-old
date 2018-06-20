<?php

/**
 * Изминения логотипа при регистрации или входе в админ-панель wordpress
 * ---------------------------------------------------------------------------------------------------------------------
 */
function my_custom_css_login_registrations(){
    echo '
   <style type="text/css">
   ТУТ НУЖНО ПИСАТЬ css КОД - данный код будет применяться к странице авторицзации и входа
    #login h1 a { background: url('. get_bloginfo('template_directory') .'/images/logo.jpg) no-repeat 0 0 !important; } 
    </style>';
}
add_action('login_head', 'my_custom_css_login_registrations');


/**
 * Изминения логотипа в админке wordpress
 * ---------------------------------------------------------------------------------------------------------------------
 */
function my_custom_admin_panel_css() {
    echo '
    <style type="text/css">
    ТУТ НУЖНО ПИСАТЬ css КОД - данный код будет применяться к страницам админки
        #header-logo { background:url('.get_bloginfo('template_directory').'/images/favicon.png) no-repeat 0 0 !important; }
    </style>';
}
add_action('admin_head', 'my_custom_admin_panel_css');



/* Ставим ссылку с логотипа на сайт, а не на wordpress.org */
add_filter( 'login_headerurl', create_function('', 'return get_home_url();') );

/* убираем title в логотипе "сайт работает на wordpress" */
add_filter( 'login_headertitle', create_function('', 'return false;') );