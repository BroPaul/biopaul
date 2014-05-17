<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta charset="utf-8">
<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
<?php
  $site_description = '';
  $site_keywords = '';
  $site_author = '';
  if (function_exists('ot_get_option')) {
    $site_description = ot_get_option('site_description');
    $site_keywords = ot_get_option('site_keywords');
    $site_author = ot_get_option('site_author');
  }
?>
<meta name="description" content="<?php echo $site_description; ?>">
<meta name="keywords" content="<?php echo $site_keywords; ?>">
<meta name="author" content="<?php echo $site_author; ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!--[if lt IE 9]>
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<?php
  if (function_exists('ot_get_option')) {
    if ($biopaul_fav_icon = ot_get_option('fav_icon')) {
?>
<link rel="shortcut icon" href="<?php echo $biopaul_fav_icon; ?>">
<?php
    }
    if ($biopaul_apple_touch_icon = ot_get_option('apple_touch_icon')) {
?>
<link rel="apple-touch-icon" href="<?php echo $biopaul_apple_touch_icon; ?>">
<?php
    }
    if ($biopaul_apple_touch_icon_72 = ot_get_option('apple_touch_icon_72')) {
?>
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo $biopaul_apple_touch_icon_72; ?>">
<?php
    }
    if ($biopaul_apple_touch_icon_114 = ot_get_option('apple_touch_icon_114')) {
?>
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo $biopaul_apple_touch_icon_114; ?>">
<?php
    }
  }
  wp_head();

  if (!preg_match('/Mobile/', $_SERVER['HTTP_USER_AGENT'])) {
    echo '<link rel="stylesheet" type="text/css" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">';
  }
?>
<style type="text/css">
@media screen and (max-width: 640px) {
  body{background:#EBEBEB}
}
<?php
  if (function_exists('ot_get_option')) {
    if ($background_pattern = ot_get_option('background_pattern')){
      echo 'body{background:url('.$background_pattern.') center center;background-size: cover;}';
    }
    if ($custom_css = ot_get_option('custom_css')){
      echo $custom_css;
    }
  }
?>
</style>
<script>
<?php
  if (function_exists('ot_get_option')) {
    if (ot_get_option('if_ajaxify') == "on"){
?>
// Ajax功能
function loadContent(url){$.ajax({type:"POST",url:url,timeout:5000,error:function(){alert("累了，加载不动了... 请手动刷新页面")},beforeSend:function(){$("#loader").show();$("object,embed").hide()},success:function(result){bodyclass=(/<body class=\"(.+)\">/g).exec(result)[1];$("body").attr("class",bodyclass);data=result.split("<title>")[1];newtitle=data.split("<\/title>")[0];jQuery(document).attr("title",newtitle);data=result.split("<wp_footer>")[2];new_wp_footer=data.split("</wp_footer>")[0];$("wp_footer").html(new_wp_footer);$("#content").html($(result).find("#content").html());$("nav").html($(result).find("nav").html());$("#loader").hide();if(target=location.hash){$("body").animate({scrollTop:$(target).offset().top})}else{$("body").animate({scrollTop:0})}reloadJs();initialUrl="http://"+location.host+location.pathname;window.onpopstate=function(){var newUrl="http://"+location.host+location.pathname;if(initialUrl==newUrl){return}loadContent(location.href)}}})};function ajaxify(){$("nav,#content").on("click","a",function(e){var link_uri=$(this).attr("href"),link_url=this.href;if(link_url.indexOf("<?php echo $_SERVER['SERVER_NAME'] ?>")>=0&&link_url.indexOf("/wp-")<0&&link_uri.indexOf("#respond")<0&&link_uri.charAt(0)!="#"){e.preventDefault();window.history.pushState(null,null,link_url);loadContent(link_url)}})};$(document).ready(function(){if(!/Mobile/.test(navigator.userAgent)){ajaxify();}})

//重新加载js
function reloadJs(){
 $("#email").blur(function(){$("img.gravatar").attr("src","http://www.gravatar.com/avatar.php?gravatar_id="+hex_md5($("#email").val())+"&size=40&r=G&d=mm").addClass("glow")});$("a[rel^='prettyPhoto'],a[href$='.jpg'],a[href$='.gif'],a[href$='.png']").prettyPhoto();var $container=$("#portfolio-list");$container.isotope({filter:"*",layoutMode:"masonry",animationOptions:{duration:750,easing:"linear"}});$("body").on("click","#portfolio-filter a",function(e){e.preventDefault();$(".active").removeClass("active");$(this).parent().addClass("active");var selector=$(this).attr("data-filter");$container.isotope({filter:selector,animationOptions:{duration:750,easing:"linear",queue:false,}})});if(typeof mejs!=="undefined"){$("#content video,#content audio").mediaelementplayer()}if(typeof DUOSHUO!=="undefined"){DUOSHUO.RecentComments&&DUOSHUO.RecentComments(".ds-recent-comments");DUOSHUO.RecentVisitors(".ds-recent-visitors");DUOSHUO.EmbedThread(".ds-thread")}if(typeof _hmt!="undefined"){pageURL=window.location.pathname;_hmt.push(["_trackPageview",pageURL])};
    
    // 其他自定义
<?php 
      if ($custom_reloadjs = ot_get_option('custom_reloadjs')){
        echo $custom_reloadjs;
      }
?>
}//reloadJs ends
<?php 
    }
  }
?>
</script>
<!-- Header Analytics -->
<?php 
  if (function_exists('ot_get_option')) {
    if ($google_analytics_code = ot_get_option('google_analytics_code')) {
      echo $google_analytics_code;
    }
  }
 ?>
</head>
<?php
  $body_class = '';
  $pages = array();
  if (function_exists('ot_get_option')) {
    $pages['profile'] = ot_get_option('profile_page');
    $pages['resume'] = ot_get_option('resume_page');
    $pages['portfolio'] = ot_get_option('portfolio_page');
    $pages['blog'] = ot_get_option('blog_page');
    $pages['contact'] = ot_get_option('contact_page');
  }
  foreach ($pages as $key=>$page) { 
    if ($post->ID == $page) {
      $body_class = $key;
      break;
    }
  }
?>
<body <?php body_class($body_class); ?>>
  <div class="wrapper">
        <nav>
          <?php
        wp_nav_menu(array('theme_location' => 'biopaul-main-menu', 'container' => 'false', 'menu_class' => 'menu', 'link_before' => '<span><span>', 'link_after' => '</span></span>'));
      ?>
        </nav>