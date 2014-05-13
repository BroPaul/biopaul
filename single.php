<?php get_header(); ?>

        <div id="content" class="content">
            <div class="innerContainer">
            	<?php
					$original_wp_query = $wp_query;
					if (function_exists('ot_get_option')) {
						$blog_page = ot_get_option('blog_page');
						if ($blog_page != '') {
							$wp_query = new WP_Query('page_id='.$blog_page);
							while ($wp_query->have_posts()) {
								$wp_query->the_post();
							}
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
						$wp_query = $original_wp_query;
						while(have_posts()) {
							the_post();
					?>
                    <article>
                        <header><h1><?php the_title(); ?></h1></header>
                        <section class="meta">由 <?php the_author(); ?> 发表于 <?php echo get_the_time('Y年n月j日', get_the_ID()); ?>, <a href="#<?php _e('comments', 'biopaul'); ?>"><?php comments_number(__('暂无评论', 'biopaul'), __('1 条评论', 'biopaul'), __('% 条评论', 'biopaul')); ?></a></section>
                        <section class="entry">
                            <?php
								if (has_post_format('image')) {
									if(has_post_thumbnail()) {
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
							?>
                            <?php
								the_content();
							?>
                    	</section>
                    </article>
                    <!-- <div id="如需使用百度推荐，请去掉本行注释，并修改id值" style="padding-bottom: 30px"></div> -->
                    <?php
						}
					?>
                    <?php comments_template('', true); ?>
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