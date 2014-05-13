<?php get_header(); ?>

<div id="content" class="content">
	<div class="innerContainer center">
		<h2><strong>Error 404</strong></h2>
		<!-- 抱歉，由于在搬家过程中丢失了一些数据，您要查看的页面暂时无法找到。您可以<a href="<?php echo home_url()?>">回首页</a>或者在下方搜索，谢谢<br> -->
		<h4>抱歉，翻箱倒柜找不到您要的页面</h4>
		<p>您可以在此搜索，或者<a href="<?php echo home_url()?>">回首页</a>，谢谢</p>
		<?php get_search_form() ?>
		<div class="hidden" id="js_404">
			<script type="text/javascript" src="http://www.qq.com/404/search_children.js?edition=small" charset="utf-8"></script>
			<style>footer{background: none}#shareContent{display: none;}.mod_lost_child_little{margin: 0 auto}.mod_lost_child_little .info{margin-top: 0}.info p{margin-bottom:0}</style>
		</div>
	</div>
</div> 

<?php get_footer(); ?>