<?php
	if ($contact_info = ot_get_option('contact_info')) {
?>
<address><?php echo $contact_info;?></address>
<?php
	}
?>
<div class="social">
<?php
	if ($sina_id = ot_get_option('sina_id')){
?>
	<a target="_blank" rel="nofollow" href="http://weibo.com/<?php echo $sina_id; ?>" title="新浪微博"><i class="weibo"></i></a>
	<!-- 新浪微博 -->

<?php
	}
	if ($tencent_id = ot_get_option('tencent_id')){
?>
	<a target="_blank" rel="nofollow" href="http://t.qq.com/<?php echo $tencent_id; ?>" title="腾讯微博"><i class="tencent"></i></a>
	<!-- 腾讯微博 -->

<?php
	}
	if ($baidu_id = ot_get_option('baidu_id')){
?>
	<a target="_blank" rel="nofollow" href="http://www.baidu.com/p/<?php echo $baidu_id; ?>?from=tieba" title="百度贴吧"><i class="tieba"></i></a>
	<!-- 百度贴吧 -->

<?php
	}
	if ($renren_id = ot_get_option('renren_id')){
?>
	<a target="_blank" rel="nofollow" href="http://www.renren.com/<?php echo $renren_id; ?>" title="人人"><i class="renren"></i></a>
	<!-- 人人 -->

<?php
	}
	if ($kaixin_id = ot_get_option('kaixin_id')){
?>
	<a target="_blank" rel="nofollow" href="http://www.kaixin001.com/home/?uid=<?php echo $kaixin_id; ?>" title="开心网"><i class="kaixin"></i></a>
	<!-- 开心网 -->

<?php
	}
	if ($qq_id = ot_get_option('qq_id')) {
		//数字型
		if (is_numeric($qq_id)) {
			//填写了二维码
			if($qq_qr = ot_get_option('qq_qr')){
?>
	<a target="_blank" rel="nofollow" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $qq_id; ?>&site=qq&menu=yes" title="点击和我聊天或扫描二维码加好友"><img src="http://wpa.qq.com/pa?p=1:<?php echo $qq_id; ?>:52" width="20"/><img class="qrcode" src="<?php echo $qq_qr; ?>" alt="QQ二维码"></a>
<?php
			//未填写二维码
			}else{
?>
	<a target="_blank" rel="nofollow" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $qq_id; ?>&site=qq&menu=yes" title="QQ"><img src="http://wpa.qq.com/pa?p=1:<?php echo $qq_id; ?>:52" width="20"/></a>
<?php
			}
		//网址型	
		}else{
			//填写了二维码
			if($qq_qr = ot_get_option('qq_qr')){
?>
	<a target="_blank" rel="nofollow" href="<?php echo $qq_id; ?>" title="点击和我聊天或扫描二维码加好友"><i class="qq"></i><img class="qrcode" src="<?php echo $qq_qr; ?>" alt="QQ二维码"></a>
<?php
			//未填写二维码
			}else{
?>
	<a target="_blank" rel="nofollow" href="<?php echo $qq_id; ?>" title="QQ"><i class="qq"></i></a>
<?php
			}
		}			
?>	
	<!-- QQ -->
	
<?php
	}
	if ($twitter_id = ot_get_option('twitter_id')) {
?>
	<a target="_blank" rel="nofollow" href="https://twitter.com/<?php echo $twitter_id; ?>" title="Twitter"><i class="twitter"></i></a>
	<!-- Twitter -->	

<?php
	}
	if ($facebook_id = ot_get_option('facebook_id')) {
?>
	<a target="_blank" rel="nofollow" href="https://www.facebook.com/<?php echo $facebook_id; ?>" title="Facebook"><i class="facebook"></i></a>
	<!-- Facebook -->
	
<?php
	}
	if ($gplus_id = ot_get_option('gplus_id')) {
?>
	<a target="_blank" rel="nofollow" href="https://plus.google.com/<?php echo $gplus_id; ?>" title="Google Plus"><i class="gplus"></i></a>
	<!-- Google+ -->
	
<?php
	}
	if ($skype_id = ot_get_option('skype_id')) {
?>
	<a rel="nofollow" href="skype:<?php echo $skype_id; ?>?chat" title="Skype"><img src="http://mystatus.skype.com/mediumicon/<?php echo $skype_id; ?>" width="20" /></a>
	<!-- Skype -->
	
<?php
	}
	if ($youku_id = ot_get_option('youku_id')){
?>
	<a target="_blank" rel="nofollow" href="http://i.youku.com/<?php echo $youku_id; ?>" title="优酷"><i class="youku"></i></a>
	<!-- 优酷 -->
	
<?php
	}
	if ($tudou_id = ot_get_option('tudou_id')){
?>
	<a target="_blank" rel="nofollow" href="http://www.tudou.com/home/<?php echo $tudou_id; ?>" title="土豆"><i class="tudou"></i></a>
	<!-- 土豆 -->
	
<?php
	}
	if ($bilibili_id = ot_get_option('bilibili_id')){
?>
	<a target="_blank" rel="nofollow" href="http://space.bilibili.tv/<?php echo $bilibili_id; ?>" title="哔哩哔哩"><i class="bilibili"></i></a>
	<!-- 哔哩哔哩 -->
	
<?php
	}
	if ($xiami_id = ot_get_option('xiami_id')){
?>
	<a target="_blank" rel="nofollow" href="http://www.xiami.com/u/<?php echo $xiami_id; ?>" title="虾米"><i class="xiami"></i></a>
	<!-- 虾米 -->
	
<?php
	}
	if ($songtaste_id = ot_get_option('songtaste_id')){
?>
	<a target="_blank" rel="nofollow" href="http://www.songtaste.com/user/<?php echo $songtaste_id; ?>" title="SongTaste"><i class="songtaste"></i></a>
	<!-- SongTaste -->
	
<?php
	}
	if ($huaban_id = ot_get_option('huaban_id')){
?>
	<a target="_blank" rel="nofollow" href="http://huaban.com/<?php echo $huaban_id; ?>" title="花瓣"><i class="huaban"></i></a>
	<!-- 花瓣 -->
	
<?php
	}
	if ($youtube_id = ot_get_option('youtube_id')) {
?>
	<a target="_blank" rel="nofollow" href="https://youtube.com/user/<?php echo $youtube_id; ?>" title="Youtube"><i class="youtube"></i></a>
	<!-- Youtube -->
	
<?php
	}
	if ($vimeo_id = ot_get_option('vimeo_id')) {
?>
	<a target="_blank" rel="nofollow" href="http://vimeo.com/<?php echo $vimeo_id; ?>" title="Vimeo"><i class="vimeo"></i></a>
	<!-- Vimeo -->
	
<?php
	}
	if ($soundcloud_id = ot_get_option('soundcloud_id')) {
?>
	<a target="_blank" rel="nofollow" href="https://soundcloud.com/<?php echo $soundcloud_id; ?>" title="SoundCloud"><i class="soundcloud"></i></a>
	<!-- SoundCloud -->
	
<?php
	}
	if ($flickr_id = ot_get_option('flickr_id')){
?>
	<a target="_blank" rel="nofollow" href="https://www.flickr.com/photos/<?php echo $flickr_id; ?>" title="Flickr"><i class="flickr"></i></a>
	<!-- Flickr -->
	
<?php
	}
	if ($instagram_id = ot_get_option('instagram_id')){
?>
	<a target="_blank" rel="nofollow" href="http://instagram.com/<?php echo $instagram_id; ?>" title="Instagram"><i class="instagram"></i></a>
	<!-- Instagram -->
	
<?php
	}
	if ($f500px_id = ot_get_option('f500px_id')){
?>
	<a target="_blank" rel="nofollow" href="http://500px.com/<?php echo $f500px_id; ?>" title="500px"><i class="f500px"></i></a>
	<!-- 500px -->
	
<?php
	}
	if ($pinterest_id = ot_get_option('pinterest_id')) {
?>
	<a target="_blank" rel="nofollow" href="http://www.pinterest.com/<?php echo $pinterest_id; ?>" title="Pinterest"><i class="pinterest"></i></a>
	<!-- Pinterest -->
	
<?php
	}
	if ($zhihu_id = ot_get_option('zhihu_id')){
?>
	<a target="_blank" rel="nofollow" href="http://www.zhihu.com/people/<?php echo $zhihu_id; ?>" title="知乎"><i class="zhihu"></i></a>
	<!-- 知乎 -->
	
<?php
	}
	if ($guokr_id = ot_get_option('guokr_id')){
?>
	<a target="_blank" rel="nofollow" href="http://www.guokr.com/i/<?php echo $guokr_id; ?>" title="果壳"><i class="guokr"></i></a>
	<!-- 果壳 -->
	
<?php
	}
	if ($douban_id = ot_get_option('douban_id')){
?>
	<a target="_blank" rel="nofollow" href="http://www.douban.com/people/<?php echo $douban_id; ?>" title="豆瓣"><i class="douban"></i></a>
	<!-- 豆瓣 -->
	
<?php
	}
	if ($zcool_id = ot_get_option('zcool_id')){
		if (is_numeric($zcool_id)) {
?>
	<a target="_blank" rel="nofollow" href="http://www.zcool.com.cn/u/<?php echo $zcool_id; ?>" title="站酷"><i class="zcool"></i></a>
<?php  
		}else{
?>
	<a target="_blank" rel="nofollow" href="<?php echo $zcool_id; ?>" title="站酷"><i class="zcool"></i></a>
<?php
		}
?>
	<!-- 站酷 -->
	
<?php
	}
	if ($yiyan_id = ot_get_option('yiyan_id')){
?>
	<a target="_blank" rel="nofollow" href="http://user.yeeyan.org/u/<?php echo $yiyan_id; ?>" title="译言"><i class="yiyan"></i></a>
	<!-- 译言 -->
	
<?php
	}
	if ($segmentfault_id = ot_get_option('segmentfault_id')){
?>
	<a target="_blank" rel="nofollow" href="http://segmentfault.com/u/<?php echo $segmentfault_id; ?>" title="SegmentFault"><i class="segmentfault"></i></a>
	<!-- SegmentFault -->
	
<?php
	}
	if ($quora_id = ot_get_option('quora_id')){
?>
	<a target="_blank" rel="nofollow" href="https://www.quora.com/<?php echo $quora_id; ?>" title="Quora"><i class="quora"></i></a>
	<!-- Quora -->
	
<?php
	}
	if ($dropbox_id = ot_get_option('dropbox_id')){
?>
	<a target="_blank" rel="nofollow" href="<?php echo $dropbox_id; ?>" title="Dropbox邀请链接"><i class="dropbox"></i></a>
	<!-- Dropbox -->
	
<?php
	}
	if ($linkedin_id = ot_get_option('linkedin_id')){
?>
	<a target="_blank" rel="nofollow" href="<?php echo $linkedin_id; ?>" title="Linkedin"><i class="linkedin"></i></a>
	<!-- Linkedin -->
	
<?php
	}
	if ($dribbble_id = ot_get_option('dribbble_id')) {
?>
	<a target="_blank" rel="nofollow" href="http://dribbble.com/<?php echo $dribbble_id; ?>" title="Dribbble"><i class="dribbble"></i></a>
	<!-- Dribbble -->
	
<?php
	}
	if ($github_id = ot_get_option('github_id')) {
?>
	<a target="_blank" rel="nofollow" href="https://github.com/<?php echo $github_id; ?>" title="Github"><i class="github"></i></a>
	<!-- Github -->
	
<?php
	}
	if ($stackexchange_id = ot_get_option('stackexchange_id')){
?>
	<a target="_blank" rel="nofollow" href="http://user.yeeyan.org/u/<?php echo $stackexchange_id; ?>" title="StackExchange"><i class="stackexchange"></i></a>
	<!-- StackExchange -->
	
<?php
	}
	if ($wechat_qr = ot_get_option('wechat_qr')) {
?>
	<a href="javascript:;" title="微信扫一扫，马上加好友"><i class="weixin"><img class="qrcode" src="<?php echo $wechat_qr; ?>" alt="微信二维码"></i></a>
	<!-- 微信 -->
	
<?php
	}
	if ($yixin_qr = ot_get_option('yixin_qr')){
?>
	<a href="javascript:;" title="扫码加好友"><i class="yixin"><img class="qrcode" src="<?php echo $yixin_qr; ?>" alt="易信二维码"></i></a>
	<!-- 易信 -->
	
<?php
	}
	if ($line_qr = ot_get_option('line_qr')){
?>
	<a href="javascript:;" title="扫码加好友"><i class="line"><img class="qrcode" src="<?php echo $line_qr; ?>" alt="连我二维码"></i></a>
	<!-- Line -->
	
<?php
	}
	if ($whatsapp_qr = ot_get_option('whatsapp_qr')){
?>
	<a href="javascript:;" title="扫码加好友"><i class="whatsapp"><img class="qrcode" src="<?php echo $whatsapp_qr; ?>" alt="Whatsapp二维码"></i></a>
	<!-- Whatsapp -->
	
<?php
	}
	
	if ($mail_address = ot_get_option('mail_address')) {
		if (!strpos($mail_address, "@")) {
?>
	<a target="_blank" rel="nofollow" href="<?php echo $mail_address; ?>" title="Mail Me"><i class="mail"></i></a>
<?php
		}else{
?>
	<a href="mailto:<?php echo antispambot($mail_address); ?>" title="Mail Me"><i class="mail"></i></a>
<?php
		}
?>
	<!-- 电子邮件 -->
	
<?php
	}
	if ($rss_feed = ot_get_option('rss_feed')) {
?>
	<a target="_blank" rel="nofollow" href="<?php echo $rss_feed; ?>" title="RSS"><i class="rss"></i></a>
	<!-- RSS -->
	
<?php
	}
	if ($hyperlink = ot_get_option('any_url')) {
?>
	<a target="_blank" href="<?php echo $hyperlink; ?>"><i class="hyperlink"></i></a>
	<!-- URL -->
<?php
	}
?>
</div>