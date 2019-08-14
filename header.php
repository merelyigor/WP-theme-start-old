<?php
/**
 * The header for our theme
 */



?>

<!doctype html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
    <title><?php bloginfo('name'); ?> |
        <?php is_home() ? bloginfo('description') : wp_title(''); ?>
    </title>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
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
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php
if (is_front_page()){
    echo 'style="cursor: default"';
}else{
    echo 'href="/"';
}
?>