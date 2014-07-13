(function($){
	var repeat = localStorage.repeat || 0,
		shuffle = localStorage.shuffle || 'false',
		continous = true,
		autoplay = true;

	var mlist=playlist.sort(function() {return 0.5-Math.random()}),
		time = new Date(),
		currentTrack = shuffle === 'true' ? time.getTime() % mlist.length : 0,
		trigger = false,
		audio, timeout, isPlaying, playCounts;

	var play = function(){
		audio.play();
		$('#radio4wp .playback').addClass('active');
		timeout = setInterval(updateProgress, 500);
		isPlaying = true;
	}

	var pause = function(){
		audio.pause();
		$('#radio4wp .playback').removeClass('active');
		clearInterval(updateProgress);
		isPlaying = false;
	}

	// 进度条
	var setProgress = function(value){
		var currentSec = parseInt(value%60) < 10 ? '0' + parseInt(value%60) : parseInt(value%60),
			ratio = value / audio.duration * 100;

		$('#radio4wp .timer').html(parseInt(value/60)+':'+currentSec);
		$('#radio4wp .progress .pace').css('width', ratio + '%');
		$('#radio4wp .progress .slider a').css('left', ratio + '%');
	}

	var updateProgress = function(){
		setProgress(audio.currentTime);
	}

	$('#radio4wp .progress .slider').slider({step: 0.1, slide: function(event, ui){
		$(this).addClass('enable');
		setProgress(audio.duration * ui.value / 100);
		clearInterval(timeout);
	}, stop: function(event, ui){
		audio.currentTime = audio.duration * ui.value / 100;
		$(this).removeClass('enable');
		timeout = setInterval(updateProgress, 500);
	}});

	// 音量
	var setVolume = function(value){
		audio.volume = localStorage.volume = value;
		$('#radio4wp .volume .pace').css('width', value * 100 + '%');
		$('#radio4wp .volume .slider a').css('left', value * 100 + '%');
	}

	var volume = localStorage.volume || 0.5;
	$('#radio4wp .volume .slider').slider({max: 1, min: 0, step: 0.01, value: volume, slide: function(event, ui){
		setVolume(ui.value);
		$(this).addClass('enable');
		$('#radio4wp .mute').removeClass('enable');
	}, stop: function(){
		$(this).removeClass('enable');
	}}).children('#radio4wp .pace').css('width', volume * 100 + '%');

	$('#radio4wp .mute').click(function(){
		if ($(this).hasClass('enable')){
			setVolume($(this).data('volume'));
			$(this).removeClass('enable');
		} else {
			$(this).data('volume', audio.volume).addClass('enable');
			setVolume(0);
		}
	});

	// 切歌
	var switchTrack = function(i){
		if (i < 0){
			track = currentTrack = mlist.length - 1;
		} else if (i >= mlist.length){
			track = currentTrack = 0;
		} else {
			track = i;
		}

		$('audio').remove();
		loadMusic(track);
		if (isPlaying == true) play();
	}

	// 随机播放
	var shufflePlay = function(){
		var time = new Date(),
			lastTrack = currentTrack;
		currentTrack = time.getTime() % 10;
		if (lastTrack == currentTrack) ++currentTrack;
		switchTrack(currentTrack);
	}

	// 播放结束后
	var ended = function(){
		pause();
		audio.currentTime = 0;
		playCounts++;
		if (continous == true) isPlaying = true;
		// repeat： 1 单曲循环，2 列表循环，3 列表播放
		if (repeat == 1){
			play();
		} else {
			if (shuffle === 'true'){
				shufflePlay();
			} else {
				if (repeat == 2){
					switchTrack(++currentTrack);
				} else {
					if (currentTrack < mlist.length) switchTrack(++currentTrack);
				}
			}
		}
	}

	var beforeLoad = function(){
		var endVal = this.seekable && this.seekable.length ? this.seekable.end(0) : 0;
		$('#radio4wp .progress .loaded').css('width', (100 / (this.duration || 1) * endVal) +'%');
	}

	// 音乐加载完毕
	var afterLoad = function(){
		if (autoplay == true) play();
	}

	// 播放音乐
	var loadMusic = function(i){
		var item = mlist[i],
			newaudio = $('<audio>').html('<source src="'+item.mp3+'" type="audio/mpeg"><source src="'+item.ogg+'" type="audio/ogg">').appendTo('#player');
		if (item.bgimg) {
			var _image = new Image();
			_image.src= item.bgimg;
			$(_image).load(function () {
				if ($('#r4wpbg1').hasClass('on')) {
					$('#r4wpbg2').css('background-image', 'url('+item.bgimg+')').animate({ opacity: 1 }, { duration: 1000 }).addClass('on');
					$('#r4wpbg1').animate({ opacity: 0 }, { duration: 2000 }).removeClass('on');
				}else{
					$('#r4wpbg1').css('background-image', 'url('+item.bgimg+')').animate({ opacity: 1 }, { duration: 1000 }).addClass('on');
					$('#r4wpbg2').animate({ opacity: 0 }, { duration: 2000 }).removeClass('on');
				};
			  });
		}else{
			$('#r4wpbg1,#r4wpbg2').animate({ opacity: 0 }, { duration: 1500 }).removeClass('on');
		};
		$('#radio4wp .cover').html('<img src="'+item.cover+'" alt="'+item.album+'"><i class="light"></i>');
		$('#radio4wp .tag').html('<strong>'+item.title+'</strong><span class="artist">'+item.artist+'</span><span class="album">'+item.album+'</span>');
		audio = newaudio[0];
		audio.volume = $('#radio4wp .mute').hasClass('enable') ? 0 : volume;
		audio.addEventListener('progress', beforeLoad, false);
		audio.addEventListener('durationchange', beforeLoad, false);
		audio.addEventListener('canplay', afterLoad, false);
		audio.addEventListener('ended', ended, false);
	}

	loadMusic(currentTrack);
	$('#radio4wp .playback').on('click', function(){
		if ($(this).hasClass('active')){
			pause();
		} else {
			play();
		}
	});
	$('#radio4wp .rewind').on('click', function(){
		if (shuffle === 'true'){
			shufflePlay();
		} else {
			switchTrack(--currentTrack);
		}
	});
	$('#radio4wp .fastforward').on('click', function(){
		if (shuffle === 'true'){
			shufflePlay();
		} else {
			switchTrack(++currentTrack);
		}
	});

	if (shuffle === 'true') $('#radio4wp .shuffle').addClass('enable');
	if (repeat == 1){
		$('#radio4wp .repeat').addClass('once');
	} else if (repeat == 2){
		$('#radio4wp .repeat').addClass('all');
	}

	$('#radio4wp .repeat').on('click', function(){
		if ($(this).hasClass('once')){
			repeat = localStorage.repeat = 2;
			$(this).removeClass('once').addClass('all');
		} else if ($(this).hasClass('all')){
			repeat = localStorage.repeat = 0;
			$(this).removeClass('all');
		} else {
			repeat = localStorage.repeat = 1;
			$(this).addClass('once');
		}
	});

	$('#radio4wp .shuffle').on('click', function(){
		if ($(this).hasClass('enable')){
			shuffle = localStorage.shuffle = 'false';
			$(this).removeClass('enable');
		} else {
			shuffle = localStorage.shuffle = 'true';
			$(this).addClass('enable');
		}
	});
	// 单击右侧按钮展开/隐藏
	$("#foldBtn").on('click',function(){
		if ($("#playerWrapper").hasClass('fold')){
			$("#playerWrapper").animate({left:'0'}).removeClass('fold');
			$(this).attr("title","单击收起");
		} else {
			$("#playerWrapper").animate({left:'-330px'}).addClass('fold');
			$(this).attr("title","单击展开");
		}
	})
})(jQuery);