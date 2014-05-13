<?php
	/*
		Template Name: Blog Page
	*/
?>
<?php get_header(); ?>
        <div id="content" class="content">
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
					$blog_sidebar_status = true;
					$main_classes = '';
					if (function_exists('ot_get_option')) {
						if (ot_get_option('blog_sidebar') == 'off') {
							$blog_sidebar_status = false;
							$main_classes = ' full-width';
						}
					}
				?>
                <div class="main<?php echo $main_classes; ?>">
                	<?php
						$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
						
						$args = array(
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
                        <section class="meta">由 <?php echo the_author_posts_link(); ?> 发表于 <?php echo get_the_time('Y年n月j日', get_the_ID()); ?>, <a href="<?php echo get_permalink(); ?>#comments"><?php comments_number('暂无评论','1 条评论','% 条评论'); ?></a></section>
                        <section class="entry">
							<?php /*?><?php
                                if (has_post_thumbnail()) {
                            ?>
                            <a href="<?php echo get_permalink(); ?>" target="_self"><?php the_post_thumbnail('biopaul-post-thumbnail', array('class' => 'scale-with-grid', 'alt' => '', 'title' => '')); ?></a>
							<?php
								}
							?><?php */?>
                            <?php
								if (has_post_format('image')) {
									/*$post_images = get_children(
										array(
											'post_parent' => get_the_ID(),
											'post_status' => 'inherit',
											'post_type' => 'attachment',
											'post_mime_type' => 'image',
											'order' => 'ASC',
											'orderby' => 'menu_order ID'
										)
									);
									
									if($post_images) {
										$slideshow = '<div class="postNedia postSlideshow">
											<div class="flex-container">
												<div class="flexslider">
													<ul class="slides">';
														foreach($post_images as $att_id => $post_image) {
															$slideshow_image = wp_get_attachment_image($att_id, array(640, 320), false, array('class' => 'scale-with-grid', 'title' => '', 'alt' => ''));
															$slideshow .= '<li>'.$slideshow_image.'</li>';
														}
													$slideshow .= '</ul>
												</div>
											</div>
										</div>';
										echo $slideshow;
									}
									else*/ if(has_post_thumbnail()) {
										echo '<div class="postMedia postImage">';
										echo '<a href="'.get_permalink().'">';
										
										$post_thumbnail_size = 'biopaul-post-thumbnail';
										if ($blog_sidebar_status) {
											$post_thumbnail_size = 'biopaul-post-thumbnail-fw';
										}
										the_post_thumbnail($post_thumbnail_size, array('class' => 'scale-with-grid', 'alt' => '', 'title' => ''));
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
                <?php
					if ($blog_sidebar_status) {
						get_sidebar('blog');
					}
				?>
                <!-- /sidebar -->
            </div><!-- /innerContainer -->

        </div><!-- /content -->

<?php get_footer(); ?>