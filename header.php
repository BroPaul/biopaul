<?php 
	if(!$_POST["ajax"]){
?>
<!DOCTYPE html>
<html>
<head>
<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=0.9, maximum-scale=1">
<?php
	if ($site_d = ot_get_option('site_description')) {
		echo "<meta name='description' content='".$site_d."'>";
	}
	if ($site_k = ot_get_option('site_keywords')) {
		echo "<meta name='keywords' content='".$site_k."'>";
	}
	if ($site_a = ot_get_option('site_author')) {
		echo "<meta name='author' content='".$site_a."'>";
	}
?>
<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<?php
	if ($fav = ot_get_option('fav_icon')) {
?>
<link rel="shortcut icon" href="<?php echo $fav; ?>">
<?php
	}
	if ($fav_57 = ot_get_option('apple_touch_icon')) {
?>
<link rel="apple-touch-icon" href="<?php echo $fav_57; ?>">
<?php
	}
	if ($fav_72 = ot_get_option('apple_touch_icon_72')) {
?>
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo $fav_72; ?>">
<?php
	}
	if ($fav_114 = ot_get_option('apple_touch_icon_114')) {
?>
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo $fav_114; ?>">
<?php
	}
	wp_head();
?>
<style type="text/css">
<?php
	if ($background_pattern = ot_get_option('background_pattern')){
		echo 'body{background:url('.$background_pattern.') center center;background-size: cover;}';
	}
	if ($custom_css = ot_get_option('custom_css')){
		echo $custom_css;
	}
?>
</style>
<script>
<?php
	if (ot_get_option('if_ajaxify') !== "off"){
?>
//重新加载js
function reloadJs(){
	$("#email").focus(function(){$("img.gravatar").removeClass("glow")}).blur(function(){$("img.gravatar").attr("src","http://www.gravatar.com/avatar.php?gravatar_id="+hex_md5($("#email").val())+"&size=40&r=G&d=mm").addClass("glow")});txt1='<div id="loading">正在提交, 请稍候...</div>',txt2='<div id="error"></div>';$('#comment').after(txt1+txt2);$('#loading,#error').hide();$("a[rel^='prettyPhoto'],a[href$='.jpg'],a[href$='.gif'],a[href$='.png']").prettyPhoto();var $container=$("#portfolio-list");$container.isotope({filter:"*",layoutMode:"masonry",animationOptions:{duration:750,easing:"linear"}});$("body").on("click","#portfolio-filter a",function(e){e.preventDefault();$(".active").removeClass("active");$(this).parent().addClass("active");var selector=$(this).attr("data-filter");$container.isotope({filter:selector,animationOptions:{duration:750,easing:"linear",queue:false,}})});if(typeof mejs!=="undefined"){$("#content video,#content audio").mediaelementplayer()}if(typeof DUOSHUO!=="undefined"){DUOSHUO.RecentComments&&DUOSHUO.RecentComments(".ds-recent-comments");DUOSHUO.RecentVisitors(".ds-recent-visitors");DUOSHUO.EmbedThread(".ds-thread")}if(typeof _hmt!="undefined"){pageURL=window.location.pathname;_hmt.push(["_trackPageview",pageURL])}; 
<?php
		if ($custom_reloadjs = ot_get_option('custom_reloadjs')){
			echo $custom_reloadjs;
		}
?>
}//reloadJs ends
function loadContent(url){
	$.ajax({type:"POST",url:url,data:"ajax=true",timeout:5000,error:function(){alert("加载失败 请自行刷新一下页面 >.<")},beforeSend:function(){$("#loader").show();$("object,embed").hide()},success:function(result){new_title=(/<title>(.+)<\/title>/).exec(result)[1];$(document).attr("title",new_title);bodyclass=(/<body class=\"(.+)\">/).exec(result)[1];$("body").attr("class",bodyclass);new_mobnav=(/id=\"mobnav\">([\s\S]*)<\/mobnav>/).exec(result)[1];$("#mobnav").html(new_mobnav);$("#pcnav").html($(result).find("#pcnav").html());$("#content").html($(result).find("#content").html());new_wpfooter=(/id=\"wpfooter\">([\s\S]*)<\/wpfooter>/).exec(result)[1];$("#wpfooter").html(new_wpfooter);$("#loader").hide();reloadJs();if(target=location.hash){target=target.substr(target.indexOf("#")+1);$("body").animate({scrollTop:$("a[name='"+target+"'],#"+target+"").offset().top})}else{$("body").animate({scrollTop:0})}initialUrl="http://"+location.host+location.pathname;window.onpopstate=function(){var newUrl="http://"+location.host+location.pathname;if(initialUrl==newUrl){return}loadContent(location.href)}}});
}
$(document).ready(function(){
	$("body").on("click","a",function(e){var link_uri=$(this).attr("href"),link_url=this.href;if(link_url==window.location){return false}else if(link_url.indexOf("<?php echo $_SERVER['SERVER_NAME'] ?>")>=0&&link_url.indexOf("/wp-")<0&&link_uri.indexOf("#respond")<0&&link_uri.charAt(0)!="#"){e.preventDefault();window.history.pushState(null,null,link_url);loadContent(link_url)}});
});
<?php 
    }
    if ( ot_get_option('blog_sidebar')!== "off" && ot_get_option('duoshuo_domain') && !preg_match('/Mobile/', $_SERVER['HTTP_USER_AGENT'])) {
?>
var duoshuoQuery = {short_name:"<?php echo ot_get_option('duoshuo_domain')?>"};
(function() {
	var ds = document.createElement('script');
	ds.type = 'text/javascript';ds.async = true;
	ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.js';
	ds.charset = 'UTF-8';
	(document.getElementsByTagName('head')[0] 
	 || document.getElementsByTagName('body')[0]).appendChild(ds);
})();
<?php
    };
?>
</script>
<!-- Header Analytics -->
<?php 
	if ($header_analytics_code = ot_get_option('header_analytics_code')) {
		echo $header_analytics_code;
	}
?>
</head>
<?php
	$body_class = '';
	$pages = array();
	$pages['profile'] = ot_get_option('profile_page');
	$pages['resume'] = ot_get_option('resume_page');
	$pages['portfolio'] = ot_get_option('portfolio_page');
	$pages['blog'] = ot_get_option('blog_page');
	$pages['contact'] = ot_get_option('contact_page');
	foreach ($pages as $key=>$page) { 
		if ($post->ID == $page) {
			$body_class = $key;
			break;
		}
	}
?>
<body <?php body_class($body_class); ?>>
	<mobnav id="mobnav">
<?php
		wp_nav_menu(array('theme_location' => 'biopaul-main-menu', 'container' => 'false', 'menu_class' => 'menu'));
?>
	</mobnav>
	<div class="wrapper">
		<nav id="pcnav">
<?php
			wp_nav_menu(array('theme_location' => 'biopaul-main-menu', 'container' => 'false', 'menu_class' => 'menu', 'link_before' => '<span><span>', 'link_after' => '</span></span>'));
?>
		</nav>
		<div id="content" class="content">
<?php
	}else{
	$body_class = '';
	$pages = array();
	$pages['profile'] = ot_get_option('profile_page');
	$pages['resume'] = ot_get_option('resume_page');
	$pages['portfolio'] = ot_get_option('portfolio_page');
	$pages['blog'] = ot_get_option('blog_page');
	$pages['contact'] = ot_get_option('contact_page');
	foreach ($pages as $key=>$page) { 
		if ($post->ID == $page) {
			$body_class = $key;
			break;
		}
	}
?>
<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
<body <?php body_class($body_class); ?>>
	<mobnav id="mobnav">
<?php
		wp_nav_menu(array('theme_location' => 'biopaul-main-menu', 'container' => 'false', 'menu_class' => 'menu'));
?>
	</mobnav>
	<div class="wrapper">
		<nav id="pcnav">
<?php
			wp_nav_menu(array('theme_location' => 'biopaul-main-menu', 'container' => 'false', 'menu_class' => 'menu', 'link_before' => '<span><span>', 'link_after' => '</span></span>'));
?>
		</nav>
		<div id="content" class="content">
<?php
	}
?>