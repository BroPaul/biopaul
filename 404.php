<?php get_header(); ?>
<div class="innerContainer">
	<div class="center">
		<h1><strong>Error 404</strong></h1>
		<h4>您要访问的页面已失踪<span class="hidden">，他们心爱的孩子也不见踪影</span></h4>
		<p>您可以在此搜索，或者<a href="<?php echo home_url()?>">回首页</a>，谢谢</p>
		<?php get_search_form() ?>
	</div>
	<div class="hidden">
		<iframe scrolling='no' frameborder='0' src='http://yibo.iyiyun.com/Home/Distribute/ad404/key/18181' width='720' height='470' style='display:block;'></iframe>
	</div>
</div>
<?php get_footer(); ?>