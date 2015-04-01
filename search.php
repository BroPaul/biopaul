<?php get_header(); ?>
<div class="innerContainer">
<?php if (have_posts()) : ?>
	<div class="main">
		<div class="pagetitle"><h1><?php printf( '搜索结果：%s', '\'<strong> '.get_search_query().' </strong>\''); ?></h1></div>
	<?php while (have_posts()) : the_post(); ?>
		<article>
			<header><h1><a href="<?php echo get_permalink(); ?>" target="_self"><?php the_title(); ?></a></h1></header>
			<section class="entry">
				<?php the_content('继续阅读');?>
			</section>
		</article>
	<?php endwhile; ?>
		<div class="clear"></div>
		<?php bropaul_pagination(); ?>
	</div>
	<?php
		if ($blog_sidebar_status) {
			get_sidebar('blog');
		}
	?>
<?php else : ?>
	<div class="center">
		<h1><strong>Error 404</strong></h1>
		<h4>我们找不到 "<?php echo get_search_query() ?>"<span class="hidden">，，他们找不到孩子</span></h4>
		<p>您可以更换关键词重新搜索，或者<a href="<?php echo home_url()?>">回首页</a>，谢谢</p>
		<?php get_search_form() ?>
	</div>
	<div class="hidden">
		<iframe scrolling='no' frameborder='0' src='http://yibo.iyiyun.com/Home/Distribute/ad404/key/18181' width='720' height='470' style='display:block;'></iframe>
	</div>
<?php endif; ?>
</div>
<?php get_footer(); ?>