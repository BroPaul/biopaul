<?php get_header(); ?>
<div class="innerContainer">
	<div class="main full-width">
		<div class="pagetitle"><h4>分类目录：<strong><?php echo single_cat_title();?></strong></h4></div>
<?php
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	$current_cat_id = get_query_var('cat');
	
	$args = array(
		'cat' => $current_cat_id,
		'posts_per_page' => get_option('posts_per_page'),
		'paged' => $paged
	);
	
	$wp_query = new WP_Query($args);
	while($wp_query->have_posts()) {
		$wp_query->the_post();
		global $more;
		$more = 0;
?>
		<article>
			<header><h1><a href="<?php echo get_permalink(); ?>" target="_self"><?php the_title(); ?></a></h1></header>
			<section class="meta">由 <?php the_author(); ?> 发表于 <?php echo get_the_time('Y年n月j日', get_the_ID()); ?>, <a href="<?php echo get_permalink(); ?>#comments"><?php comments_number('暂无评论','1 条评论','% 条评论'); ?></a></section>
			<section class="entry">
				<?php the_content('继续阅读'); ?>
			</section>
		</article>
<?php
	}
?>
<?php bropaul_pagination(); ?>
	</div>
</div>
<?php get_footer(); ?>