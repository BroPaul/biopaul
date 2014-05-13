<?php get_header(); ?>
        <div id="content" class="content">
            <div class="innerContainer">
                <?php
					if (have_posts()) {
						while (have_posts()) {
							the_post();
				?>
                <div class="desc">
                	<h4><?php the_title(); ?></h4>
                    <?php the_content(); ?>
                </div>
                <?php
						}
					}
				?>
            </div><!-- /innerContainer -->
        </div><!-- /content -->
<?php get_footer(); ?>