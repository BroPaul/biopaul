<?php
	/*
		Template Name: Search Page
	*/
?>
<?php get_header(); ?>
<div id="content" class="content">
	<div class="innerContainer">
	<?php if (have_posts()) : ?>
		<div class="main">
			<div class="pagetitle"><h4><?php printf( '搜索结果：%s<br>Search Results for %s', '\'<strong> '.get_search_query().' </strong>\'','\' <strong>'.get_search_query().'</strong> \''); ?></h4></div>
			<?php while (have_posts()) : the_post(); ?>
			<article>
                <header><h1><a href="<?php echo get_permalink(); ?>" target="_self"><?php the_title(); ?></a></h1></header>
                <section class="entry">
                    <?php
						if (has_post_format('image')) {
							if(has_post_thumbnail()) {
								echo '<div class="postMedia postImage">';
								echo '<a href="'.get_permalink().'">';
								
								$post_thumbnail_size = 'biopaul-post-thumbnail';
								if (!$blog_sidebar_status) {
									$post_thumbnail_size = 'biopaul-post-thumbnail-fw';
								}
								the_post_thumbnail($post_thumbnail_size, array('class' => 'scale-with-grid', 'alt' => '', 'title' => ''));
								echo '</a>';
								echo '</div>';
							}
						}
						the_content('继续阅读');
					?>
                </section>
            </article>
			<?php endwhile; ?>
			<div class="clear"></div>
			<?php bropaul_pagination(); ?>
		</div>
	        <?php
				if (!$blog_sidebar_status) {
					get_sidebar('blog');
				}
			?>
	<?php else : ?>
		<div class="center">
			<h2><strong>Error 404</strong></h2>
			<h4>抱歉，翻箱倒柜找不到 "<?php echo get_search_query() ?>"</h4>
			<p>您可以更换关键词重新搜索，或者<a href="<?php echo home_url()?>">回首页</a>，谢谢</p>
			<?php get_search_form() ?>
		</div>
		<div class="hidden" id="js_404">
			<script type="text/javascript" src="http://www.qq.com/404/search_children.js?edition=small" charset="utf-8"></script>
			<style>#shareContent{display: none;}.mod_lost_child_little{margin: 0 auto}.mod_lost_child_little .info{margin-top: 0}.info p{margin-bottom:0}</style>
		</div>
	<?php endif; ?>
	</div><!-- Inner Ends -->
</div><!-- Content Ends -->

<?php get_footer(); ?>