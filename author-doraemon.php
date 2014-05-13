<?php 
include 'radio/index.htm';
 ?>
<nav>
    <ul>
    	<li class="profile"><a title="主页 | Home" href="/"><span></span></a></li>
    	<li class="resume"><a title="简历 | Resume" href="/resume/"><span></a></li>
    	<li class="portfolio"><a title="作品集 | Portfolio" href="/portfolio/"><span></span></a></li>
    	<li class="blog"><a title="博客 | Blog" href="/blog/"><span></span></a></li>
    	<li class="contact"><a title="联系我 | Contact" href="/contact/"><span></span></a></li>
	</ul>
</nav>
<style>
a {-webkit-transition: all 0.15s ease-out;-moz-transition: all 0.15s ease-out;transition: all 0.15s ease-out;}
nav {position: absolute;left: 50%;top: 180px;margin-left: -500px;}
nav a {text-decoration: none;background-color: #09F;width: 35px;height: 35px;display: inline-block;}
nav a:hover {background-color: #00D6FF; }
nav li a span {width: 100%;height: 100%;display: inline-block;}
nav li a > span{background: url('<?php echo get_template_directory_uri(); ?>/images/icons.png') no-repeat transparent;}
nav li.profile a > span {background-position:0 0}
nav li.resume a > span {background-position:-35px 0;}
nav li.portfolio a > span {background-position:-70px 0;}
nav li.blog a > span {background-position:-105px 0;}
nav li.contact a > span {background-position:-140px 0;}
#nothis{display: none}
</style>
<script>
var message="用音乐述说故事          "
i="0"
var temptitle=""
var speed="250"
function titler(){
if (!document.all&&!document.getElementById)
return
document.title= temptitle+message.charAt(i)+" | 关于我 - About Me"
temptitle=temptitle+message.charAt(i)
i++
if(i==message.length)
{
i="0"
temptitle=""
}
setTimeout("titler()",speed)
}
window.onload=titler
</script>