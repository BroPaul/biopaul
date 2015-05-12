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
		if (!preg_match('/Mobile/', $_SERVER['HTTP_USER_AGENT']) && ot_get_option('bgm')) {
			$bgm=ot_get_option('bgm');
			include 'includes/radio/index.php';
		}
?>
<a id="gotop" href="javascript:;">▲</a>
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