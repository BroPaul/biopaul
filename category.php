<?php get_header(); ?>
        <div id="content" class="content">
            <div class="innerContainer">
                <div class="main full-width">
                	<div class="pagetitle"><h4>分类目录 ' <strong><?php echo single_cat_title();?></strong> ' 中的文章<br>Posts under category ' <strong><?php echo single_cat_title();?></strong> ' </h4></div>
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
                            <?php
								if (has_post_format('image')) {
									if(has_post_thumbnail()) {
										echo '<div class="postMedia postImage">';
										echo '<a href="'.get_permalink().'">';
										the_post_thumbnail('biopaul-post-thumbnail', array('class' => 'scale-with-grid', 'alt' => '', 'title' => ''));
										echo '</a>';
										echo '</div>';
									}
								}
								// else if (has_post_format('video')) {
								// 	echo '<div class="postMedia postVideo">';
								// 	$custom = get_post_custom(get_the_ID());
								// 	$post_video_id = $custom["post_video_id"][0];
								// 	$post_video_type = $custom["post_video_type"][0];
								// 	echo do_shortcode('[video id="'.$post_video_id.'" type="'.$post_video_type.'"]');
								// 	echo '</div>';
								// }
								the_content('继续阅读');
							?>
                        </section>
                    </article>
                    <?php
						}
					?>
                    <?php bropaul_pagination(); ?>
                </div>
            </div><!-- /innerContainer -->
        </div><!-- /content -->
<?php get_footer(); ?>