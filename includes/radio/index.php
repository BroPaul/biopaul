<link rel="stylesheet" href="<?php echo get_template_directory_uri()?>/includes/radio/lib/style.css">
<!-- <script src="/lib/jquery-1.8.2.min.js"></script> -->
<div id="bgmPlayer" class="fold">
	<div id="player">
		<div class="cover"></div>
		<div class="ctrl">
			<div class="tag">
				<strong>歌曲</strong>
				<span class="artist">歌手</span>
				<span class="album">专辑</span>
			</div>
			<div class="control">
				<div class="left">
					<div class="rewind icon"><i class="fa fa-backward"></i></div>
					<div class="playback icon playing"><i class="fa fa-play"></i></div>
					<div class="fastforward icon"><i class="fa fa-forward"></i></div>
				</div>
				<div class="volume right">
					<div class="mute icon left"><i class="fa fa-volume-up"></i></div>
					<div class="slider left">
						<div class="pace"></div>
					</div>
				</div>
			</div>
			<div class="progress">
				<div class="slider">
					<div class="loaded"></div>
					<div class="pace"></div>
				</div>
				<div class="timer left">0:00</div>
				<div class="right">
					<div class="repeat icon"></div>
					<div class="shuffle icon"></div>
				</div>
			</div>
		</div>
	</div>
	<div id="foldBtn" title="单击展开 | Toggle Player"><i class="fa fa-chevron-right"></i></div>
</div>
<script src="http://libs.baidu.com/jqueryui/1.8.22/jquery-ui.min.js "></script>
<!-- <script src="/lib/jquery-ui-1.8.22.min.js "></script> -->
<script src="<?php echo $bgm ?>"></script>
<script src="<?php echo get_template_directory_uri()?>/includes/radio/lib/script.js"></script> 
<div id="bg1"></div>
<div id="bg2"></div>