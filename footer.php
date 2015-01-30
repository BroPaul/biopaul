<?php 
	if($_POST["ajax"]){
?>		
		</div><!-- /content -->
		<wpfooter id="wpfooter"><?php wp_footer(); ?></wpfooter>
<?php
	}else{
?>
		</div><!-- /content -->
		<wpfooter id="wpfooter"><?php wp_footer(); ?></wpfooter>
		<footer>
			<span>Theme: BioPaul by <a href="http://bropaul.com/" target="_blank">BroPaul</a> adapted from <a href="http://themes.themebakers.com/biopic/" rel="nofollow" target="_blank">Biopic</a> | Powered by <a href="http://cn.wordpress.org/" rel="nofollow" target="_blank">WordPress</a><br>
<?php
		if ($copyright_text = ot_get_option('copyright_text')) {
			echo $copyright_text; 
		}
?>
            </span>
        </footer>
	</div><!-- /wrapper -->
<?php
		if (!preg_match('/Mobile/', $_SERVER['HTTP_USER_AGENT'])) {
			echo '<link rel="stylesheet" type="text/css" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css"><style>#gotop i span{display: none}</style>';
			if (($bgm = ot_get_option('bgm'))) {
				if (preg_match('/\.js/', $bgm) ) {
					include 'includes/radio/index.php'; 
				}else{
?>
<div id="bgm"><audio src="<?php echo $bgm ?>" <?php if (ot_get_option('bgm_loop') !== 'off') echo "loop"?> autoplay></audio></div>
<a title="暂停|播放" id="bgmpause" href="javascript:;"><i class="fa fa-pause"></i></a>
<a title="停止" id="bgmstop" href="javascript:;"><i class="fa fa-stop"></i></a>
<script>var bgm=$("#bgm audio"),pause=$("#bgmpause"),stop=$("#bgmstop"),bgmsrc=bgm.attr("src");stop.click(function(){bgm.attr("src","");pause.html('<i class="fa fa-play"></i>')});pause.click(function(){if(bgm.attr("src").length==0){bgm.attr("src",bgmsrc);$(this).html('<i class="fa fa-pause"></i>')}else{if(bgm[0].paused){bgm[0].play();$(this).html('<i class="fa fa-pause"></i>')}else{bgm[0].pause();$(this).html('<i class="fa fa-play"></i>')}}});</script>
<?php
				}
			}
		}
?>
<a id="gotop" href="javascript:;"><i class="fa fa-arrow-circle-up"><span>▲</span></i></a>
<?php
		if (ot_get_option('if_ajaxify')!=="off"){
			echo '<div id="loader"></div>';
		}
		if ($background_grid = ot_get_option('background_grid')) {
			if ($background_grid == "bright") {
				echo '<div id="bg_grid_gray"></div>';
			}elseif ($background_grid == "dark") {
				echo '<div id="bg_grid"></div>';
			}
		}
		if ($footer_analytics = ot_get_option('footer_analytics')) {
				echo $footer_analytics;
			}
?>
</body>
</html>
<?php
	}
?>