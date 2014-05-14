﻿(function($){
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
		$('.playback').addClass('active');
		$('.fa-play').removeClass('fa-play').addClass('fa-pause');
		timeout = setInterval(updateProgress, 500);
		isPlaying = true;
	}

	var pause = function(){
		audio.pause();
		$('.playback').removeClass('active');
		$('.fa-pause').removeClass('fa-pause').addClass('fa-play');
		clearInterval(updateProgress);
		isPlaying = false;
	}

	// 进度条
	var setProgress = function(value){
		var currentSec = parseInt(value%60) < 10 ? '0' + parseInt(value%60) : parseInt(value%60),
			ratio = value / audio.duration * 100;

		$('.timer').html(parseInt(value/60)+':'+currentSec);
		$('.progress .pace').css('width', ratio + '%');
		$('.progress .slider a').css('left', ratio + '%');
	}

	var updateProgress = function(){
		setProgress(audio.currentTime);
	}

	$('.progress .slider').slider({step: 0.1, slide: function(event, ui){
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
		$('.volume .pace').css('width', value * 100 + '%');
		$('.volume .slider a').css('left', value * 100 + '%');
	}

	var volume = localStorage.volume || 0.5;
	$('.volume .slider').slider({max: 1, min: 0, step: 0.01, value: volume, slide: function(event, ui){
		setVolume(ui.value);
		$(this).addClass('enable');
		$('.mute').removeClass('enable');
	}, stop: function(){
		$(this).removeClass('enable');
	}}).children('.pace').css('width', volume * 100 + '%');

	$('.mute').click(function(){
		if ($(this).hasClass('enable')){
			setVolume($(this).data('volume'));
			$(this).removeClass('enable');
			$('.fa-volume-off').removeClass('fa-volume-off').addClass('fa-volume-up');
		} else {
			$(this).data('volume', audio.volume).addClass('enable');
			$('.fa-volume-up').removeClass('fa-volume-up').addClass('fa-volume-off');
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
		$('.progress .loaded').css('width', (100 / (this.duration || 1) * endVal) +'%');
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
				if ($('#bg1').hasClass('on')) {
					$('#bg2').css('background-image', 'url('+item.bgimg+')').animate({ opacity: 1 }, { duration: 1000 }).addClass('on');
					$('#bg1').animate({ opacity: 0 }, { duration: 2000 }).removeClass('on');
				}else{
					$('#bg1').css('background-image', 'url('+item.bgimg+')').animate({ opacity: 1 }, { duration: 1000 }).addClass('on');
					$('#bg2').animate({ opacity: 0 }, { duration: 2000 }).removeClass('on');
				};
			  });
		}else{
			$('#bg1,#bg2').animate({ opacity: 0 }, { duration: 1500 }).removeClass('on');
		};
		$('.cover').html('<img src="'+item.cover+'" alt="'+item.album+'">');
		$('.tag').html('<strong>'+item.title+'</strong><span class="artist">'+item.artist+'</span><span class="album">'+item.album+'</span>');
		audio = newaudio[0];
		audio.volume = $('.mute').hasClass('enable') ? 0 : volume;
		audio.addEventListener('progress', beforeLoad, false);
		audio.addEventListener('durationchange', beforeLoad, false);
		audio.addEventListener('canplay', afterLoad, false);
		audio.addEventListener('ended', ended, false);
	}

	loadMusic(currentTrack);
	$('.playback').on('click', function(){
		if ($(this).hasClass('active')){
			pause();
		} else {
			play();
		}
	});
	$('.rewind').on('click', function(){
		if (shuffle === 'true'){
			shufflePlay();
		} else {
			switchTrack(--currentTrack);
		}
	});
	$('.fastforward').on('click', function(){
		if (shuffle === 'true'){
			shufflePlay();
		} else {
			switchTrack(++currentTrack);
		}
	});

	if (shuffle === 'true') $('.shuffle').addClass('enable');
	if (repeat == 1){
		$('.repeat').addClass('once');
	} else if (repeat == 2){
		$('.repeat').addClass('all');
	}

	$('.repeat').on('click', function(){
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

	$('.shuffle').on('click', function(){
		if ($(this).hasClass('enable')){
			shuffle = localStorage.shuffle = 'false';
			$(this).removeClass('enable');
		} else {
			shuffle = localStorage.shuffle = 'true';
			$(this).addClass('enable');
		}
	});

	$("#foldBtn").on('click',function(){
		if ($("#bgmPlayer").hasClass('fold')){
			$("#bgmPlayer").animate({left:'0'}).removeClass('fold')
		} else {
			$("#bgmPlayer").animate({left:'-520px'}).addClass('fold')
		}
	})
})(jQuery);