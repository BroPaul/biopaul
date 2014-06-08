<link rel="stylesheet" href="<?php echo get_template_directory_uri()?>/includes/radio/style.css">
<div id="bgmPlayer">
	<div class="cover"></div>
	<div id="playerWrapper" class="fold">
		<div id="player">
			<div class="ctrl">
				<div class="tag">
					<strong>歌曲</strong>
					<span class="artist">歌手</span>
					<span class="album">专辑</span>
				</div>
				<div class="control">
					<div class="left">
						<div class="rewind icon"></div>
						<div class="playback icon playing"></div>
						<div class="fastforward icon"></div>
					</div>
					<div class="volume right">
						<div class="mute icon left"></div>
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
		<div id="foldBtn" title="单击展开"><i></i></div>
	</div>
</div>
<script src="http://libs.baidu.com/jqueryui/1.8.24/jquery-ui.min.js "></script>
<script src="<?php echo $bgm ?>"></script>
<script src="<?php echo get_template_directory_uri()?>/includes/radio/script.js"></script>
<div id="bg1"></div>
<div id="bg2"></div>