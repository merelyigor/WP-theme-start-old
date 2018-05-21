<?php
/**
 * The front page template file
 * ---------------------------------------------------------------------------------------------------------------------
 **/
get_header(); ?>


<?php
/**
 * Вывод постов на главной - простой цкл - вернет посты с типом post - работает только для вывода на главной стр
 * ---------------------------------------------------------------------------------------------------------------------
 **/
while (have_posts()) : the_post(); ?>
	<section class="section-article">
		<div class="container">
			<h2 class="title"><?php the_title(); //Title post main page ?></h2>
			<div class="content-main-page">
				<?php the_content(); //Content post main page ?>
			</div>
		</div>
	</section>
<?php endwhile; ?>


<?php
/**
 * Вывод постов на любой странице с шаблоном  - вернет посты с указанным типом post_type
 * ---------------------------------------------------------------------------------------------------------------------
 **/
$args = array(
    'post_type'         => 'post', // Тип поста
    'publish'           => true, // Только опубликованные
    'posts_per_page'    => 7, // Количевство постов на странице
    'paged'             => get_query_var('paged'), // Пагинация через $wp_query
);

query_posts($args);

    while ( have_posts()) : the_post();

          //подключаем шаблон с контентом и тд поста
            get_template_part('template/post');

    endwhile;
the_posts_pagination( array(
    'mid_size' => 2, //страниц до ...
    'end_size' => 2, // страниц после ...
    'show_all' => 2, // показать все
) ); // Вывод пагинации - https://wp-kama.ru/function/the_posts_pagination ?>  <?php
/**
 * Вывод постов на любой странице с шаблоном  - вернет посты с указанным типом post_type
 * ---------------------------------------------------------------------------------------------------------------------
 **/?>

<?php
get_footer();
