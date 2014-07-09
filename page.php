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
</div>
<?php get_footer(); ?>