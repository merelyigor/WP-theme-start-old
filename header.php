<?php
/**
 * The template for displaying the header
 */

?><!DOCTYPE html>
<html <?php echo ICL_LANGUAGE_CODE ?> class="no-js">
<head>
    <title><?php bloginfo('name'); ?> |
        <?php is_home() ? bloginfo('description') : wp_title(''); ?>
    </title>
    <title><?php
        if(get_the_ID()!==2786 && $post_type !== 'news') {

            echo wp_get_document_title();
        }
        elseif (get_the_ID() ==2786){
            echo 'Фотогалерея частной школы Гелиос (Мытищи, Королев): отчеты о наших событиях';
        }elseif ($post_type == 'news'){
            echo 'Новости школы:'.get_post(get_the_ID())->post_title.'– НЧОУ Гелиос | Мытищи, Королев';
        }; ?>
    </title>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php wp_head(); ?>

    <?php
    $content_desk = get_post(get_the_ID())->post_content;
    $deskrip = substr(htmlspecialchars( $content_desk), 0, 200);
    if(get_the_ID() == 2786) {

        echo '<meta name = "description" content = "Заходите в нашу виртуальную фотогалерею! ">';

    }elseif ($post_type == 'news'){
        echo '<meta name = "description" content = "'.$deskrip.'">';
    };?>
</head>

<body <?= body_class (); ?>>

<header class="header">
    <div class="container">

        <a class="logo" <?php
        if (is_front_page()){
            echo 'style="cursor: default"';
        }else{
            echo 'href="/"';
        }
        ?>>
            <svg>
                <use xlink:href="<?php echo get_template_directory_uri()?>/img/sprite-inline.svg#logo"></use>
            </svg>
        </a>
        <ul class="main-menu">
            <?php wp_nav_menu( array ( 'theme_location'  => 'selector', 'menu_class' => '.class' ) );?>
        </ul>
    </div>
</header>

<?php get_template_part( 'inc/nav-single' ); ?>