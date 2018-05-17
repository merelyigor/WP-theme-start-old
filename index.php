<?php
/**
 * The front page template file
 * ---------------------------------------------------------------------------------------------------------------------
 **/
get_header(); ?>


<?php while (have_posts()) : the_post(); ?>
	<section class="section-article">
		<div class="container">
			<h2 class="title"><?php the_title(); //Title post main page ?></h2>
			<div class="content-main-page">
				<?php the_content(); //Content post main page ?>
			</div>
		</div>
	</section>
	<?php
endwhile;
?>

<?php
get_footer();
