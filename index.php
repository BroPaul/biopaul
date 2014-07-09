<?php get_header(); ?>
<div class="ownerInfo">
	<div class="head">
		<p>
<?php
	if ($owner_first_name = ot_get_option('owner_first_name')) {
?>
			<span class="first"><?php echo $owner_first_name; ?></span>
<?php
	}
	if ($owner_photo = ot_get_option('owner_photo')) {
?>
			<img class="avatar" src="<?php echo $owner_photo; ?>" alt="Avatar">
<?php
	}
	if ($owner_last_name = ot_get_option('owner_last_name')) {
?>
			<span class="last"><?php echo $owner_last_name; ?></span>
<?php 
	}
?>
		</p>
	</div>
	<div class="desc">
<?php
	$profile_page = ot_get_option('profile_page');
	$query = new WP_Query('page_id='.$profile_page);
	while ($query->have_posts()) {
		$query->the_post();
		the_content();
	}
?>
	</div>
	<div class="subnavContainer">
		<div class="subnavLeft">
<?php
	if ($resume_page = ot_get_option('resume_page')) {
?>
			<div class="subnavResume">
				<a href="<?php echo get_permalink($resume_page); ?>" class="invert coloricon" title="Resume"></a><br />
				<a href="<?php echo get_permalink($resume_page); ?>" title="Resume">简历</a>
			</div>
<?php
	}
	if ($portfolio_page = ot_get_option('portfolio_page')) {
?>
			<div class="subnavPortfolio">
				<a href="<?php echo get_permalink($portfolio_page); ?>" class="invert coloricon" title="Portfolio"></a><br />
				<a href="<?php echo get_permalink($portfolio_page); ?>" title="Portfolio" >作品</a>
			</div>
<?php
	}
?>
		</div>
		<div class="subnavRight">
<?php
	if ($blog_page = ot_get_option('blog_page')) {
?>
			<div class="subnavBlog">
				<a href="<?php echo get_permalink($blog_page); ?>" class="invert coloricon" title="Blog"></a><br />
				<a href="<?php echo get_permalink($blog_page); ?>" title="Blog">博客</a>
			</div>
<?php
	}
	if ($contact_page = ot_get_option('contact_page')) {
?>
			<div class="subnavContact">
				<a href="<?php echo get_permalink($contact_page); ?>" class="invert coloricon" title="Contact"></a><br />
				<a href="<?php echo get_permalink($contact_page); ?>" title="Contact">留言</a>
			</div>
<?php
	}
?>
		</div>
	</div><!-- /subnavContainer -->
</div>
<div class="sidebar hidden">
<?php
	include_once('social.php');
	get_sidebar();
?>
</div>
<?php get_footer(); ?>