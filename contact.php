<?php
	/*
		Template Name: Contact 模板
	*/
?>
<?php get_header(); ?>
<div class="innerContainer">
<?php
	if (have_posts()) {
		while (have_posts()) {
			the_post();
?>
	<div class="desc">
			<?php the_content(); ?>
	</div>
<?php
		}
	}
?>
<?php comments_template('', true); ?>
</div>
<?php get_footer(); ?>