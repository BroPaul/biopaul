<?php
	/*
		Template Name: Portfolio 模板
	*/
?>
<?php get_header(); ?>
<div class="innerContainer">
<?php
	if (have_posts()) {
		while (have_posts()) {
			the_post();
?>
	<div class="desc hidden">
		<?php the_content(); ?>
	</div>
<?php
		}
	}
?>
	<div class="portfolio-items">
		<ul class="filter clearfix" id="portfolio-filter">
			<li data-text="all" class="active"><a href="#" data-filter="*"><?php _e('全部 | All', 'biopaul'); ?></a></li>
<?php
	$terms = get_terms("skills", 'hide_empty=1');
	foreach ($terms as $term) {
		$name_full=$term->name;
		$name_en=strtolower( preg_replace('/[^a-zA-Z0-9]/','',$name_full));
?>
			<li><a href="#" data-filter=".<?php echo $name_en; ?>" ><?php echo $name_full; ?></a></li>
<?php
	}
?>
		</ul>
		<ul class="items isotope" id="portfolio-list">
<?php
	$counter = 0;
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	
	$args = array(
		'post_type' => 'biopaul_work',
		'orderby' => 'date',
		'order' => 'DESC',
		'status' => 'publish',
		'paged' => $paged,
		// 'posts_per_page' => -1
		'posts_per_page' => 15
	);
	$wp_query = new WP_Query($args);
	while ($wp_query->have_posts()) {
		$wp_query->the_post();
		$terms_list = get_the_terms(get_the_ID(), 'skills');
		if ($terms_list && !is_wp_error($terms_list)) {
			$terms = array();
			foreach ($terms_list as $term_item) {
				$name_full=$term_item->name;
				$name_en= preg_replace('/[^a-zA-Z0-9]/','',$name_full);
				$terms[] = $name_en;
			}
			$terms_str = join(" ",$terms);
		}
		$post_format = get_post_format();
		$custom = get_post_custom(get_the_ID());
		$work_external_url = $custom['work_external_url'][0];
?>
			<li class="work isotope-item <?php echo strtolower($terms_str);?><?php echo ' '.$post_format; ?>">
<?php
		if (has_post_format('video')) {
			if(has_post_thumbnail()) {
				$work_video_url = $custom['work_video_url'][0];
?>
				<a href="<?php echo $work_video_url; ?>" rel="prettyPhoto">
					<div class="image-wrapper"><div class="cover"></div>
<?php
				the_post_thumbnail('biopaul-work-thumbnail', array('title' => '', 'alt' => get_the_title()));
?>
					</div>
				</a>
<?php
			}
		}
		elseif(has_post_format('link')){
			if(has_post_thumbnail()){
				$work_link_url = $custom['work_link_url'][0];
?>
				<a href="<?php echo $work_link_url; ?>" target="_blank">
					<div class="image-wrapper"><div class="cover"></div>
<?php
				the_post_thumbnail('biopaul-work-thumbnail', array('title' => '', 'alt' => get_the_title()));
?>
					</div>
				</a>
<?php
			}
		}
		else {
			if(has_post_thumbnail()) {
				$full_size_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
?>
				<a href="<?php echo $full_size_image[0]; ?>" rel="prettyPhoto">
					<div class="image-wrapper"><div class="cover"></div>
<?php
				the_post_thumbnail('biopaul-work-thumbnail', array('class' => 'scale-with-grid', 'title' => '', 'alt' => get_the_title()));
?>
					</div>
				</a>
<?php
			}
		}
?>
				<span class="title">
<?php
		if (ot_get_option('work_items_link_status') == 'on') {
			$permalink = get_permalink();
			if ($work_external_url) {
				$permalink = $work_external_url;
			}
?>
					<a href="<?php echo $permalink; ?>"><?php the_title(); ?></a>
<?php
		}
		else {
					the_title();
		}
?>
				</span>
				<div class="desc"><?php the_excerpt(); ?></div>
			</li>
<?php
	}
?>
		</ul>
	</div>
	<br class="clear">
<?php bropaul_pagination(); ?>
</div>
<?php get_footer(); ?>