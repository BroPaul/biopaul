<?php get_header(); ?>
<div class="innerContainer">
	<div class="center">
		<h1><strong>Error 404</strong></h1>
		<h4>您要访问的页面已失踪，他们心爱的孩子也不见踪影</h4>
		<p>您可以在此搜索，或者<a href="<?php echo home_url()?>">回首页</a>，谢谢</p>
		<?php get_search_form() ?>
	</div>
	<div class="hidden" id="js_404">
		<script type="text/javascript" src="http://www.qq.com/404/search_children.js?edition=small" charset="utf-8"></script>
		<style>.mod_lost_child_little{margin: 0 auto}#shareContent,.mod_lost_child_little .hd{display: none}</style>
	</div>
</div>
<?php get_footer(); ?>