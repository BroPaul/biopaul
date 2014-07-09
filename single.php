<?php get_header(); ?>
<div class="innerContainer">
<?php
	$original_wp_query = $wp_query;
	$blog_page = ot_get_option('blog_page');
	if ($blog_page != '') {
		$wp_query = new WP_Query('page_id='.$blog_page);
		while ($wp_query->have_posts()) {
			$wp_query->the_post();
		}
	}

	$blog_sidebar_status = true;
	$main_classes = '';
	if (ot_get_option('blog_sidebar') == 'off') {
		$blog_sidebar_status = false;
		$main_classes = ' full-width';
	}
?>
	<div class="main<?php echo $main_classes; ?>">
<?php
	$wp_query = $original_wp_query;
	while(have_posts()) {
		the_post();
?>
		<article>
			<header><h1><?php the_title(); ?></h1></header>
			<section class="meta">由 <?php the_author(); ?> 发表于 <?php echo get_the_time('Y年n月j日', get_the_ID()); ?>, <a href="#comments"><?php comments_number('暂无评论','1 条评论','% 条评论'); ?></a></section>
			<section class="entry">
				<?php the_content();?>
			</section>
		</article>
<?php
		if (ot_get_option('baidu_tuijian') !== '') {
			$tuijian_id = ot_get_option('baidu_tuijian');
			echo "<div id='".$tuijian_id."' style='padding-bottom: 30px'></div>";
		}
	}
?>
<?php comments_template('', true); ?>
	</div>
<?php
	if ($blog_sidebar_status) {
		get_sidebar('blog');
	}
?>
</div>
<?php get_footer(); ?>