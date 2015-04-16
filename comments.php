<?php
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) {
		die('黑客大大，求放过 >.<');
	}
	if ( post_password_required() ) {
?>
		<div class="alert-box error">评论也被密码保护了 >.<</div>
<?php
		return;
	}
?>
<article>
	<div id="comments" class="comments">
		<div id="respond">
			<br>
			<h5>
<?php
	if (!comments_open()){
		echo "博主已关闭评论</h5>";
	}
	elseif(get_option('comment_registration') && !is_user_logged_in()) {
		printf('%1$s登录%2$s 后才能评论', '<a href="'.site_url().'/wp-login.php?redirect_to='.urlencode(get_permalink()).'">', '</a>');
		echo "</h5>";
	}else {
?>
				<img class="gravatar" src="//cn.gravatar.com/avatar/00000000000000000000000000000000?d=mm&s=40"><span class="hidden">忍不住就</span>吐个槽吧<small class="cancelCommentReply"><?php cancel_comment_reply_link('（取消）'); ?></small>
			</h5>
			<form id="commentform" action="<?php echo site_url(); ?>/wp-comments-post.php" method="post">
<?php
		if (is_user_logged_in()) {
?>
				<div class="info-col">
					<p><?php printf('将以 %1$s 的身份评论 %2$s <br>[换个马甲] %3$s', '<a href="'.site_url().'/wp-admin/profile.php">'.$user_identity.'</a>', '<a href="'.(function_exists('wp_logout_url') ? wp_logout_url(get_permalink()) : site_url().'/wp-login.php?action=logout').'">', '</a>') ?></p>
				</div>
<?php
		}else{
?>
				<div class="info-col">
					<input placeholder="称呼（必填）" type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" />
					<input placeholder="邮箱（必填）" type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" />
					<input placeholder="网址" type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" />
				</div>
<?php
		}
?>
				<div class="comment-col">
					<textarea placeholder="输入评论我就会消失，不信就试试"  name="comment" id="comment" value=""></textarea>
				</div>
				<br class="clear">
				<div class="btn-col">
					<input type="submit" name="comment-btn" id="comment-btn" value="写好了" class="button" />
					<span class="embedSmiley"><a href="javascript:smiley();"><img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/14/tza_thumb.gif" alt="表情" title="表情"></a></span>
				</div>
<?php 
	/*$a = array( 'mrgreen','razz','sad','smile','oops','grin','eek','???','cool','lol','mad','twisted','roll','wink','idea','arrow','neutral','cry','?','evil','shock','!' );//wp默认文字，不能修改
	$b = array( '15/j_thumb','19/heia_thumb','0c/sw_thumb','14/tza_thumb','73/wq_thumb','0b/tootha_thumb','f4/cj_thumb','d9/dizzya_thumb','40/cool_thumb','6a/laugh','7c/angrya_thumb','24/sweata_thumb','e9/sk_thumb','c3/zy_thumb','70/88_thumb','70/vw_thumb','a0/kbsa_thumb','9d/sada_thumb','5c/yw_thumb','6d/yx_thumb','af/cry','c7/no_thumb' );//对应于新浪微博的表情
	$c = array('囧','偷笑','难过','微笑','委屈','露齿笑','吃惊','晕','酷','仰天大笑','怒','汗','思考','眨眼','再见','威武','淡定','流泪','疑惑','邪恶','雷翻了','No');//title */
?>

				<div id="wp-smiley-wrapper">
<?php
	/*for( $i=0;$i<22;$i++ ){
		echo '<a title="'.$c[$i].'" href="javascript:grin('."':".$a[$i].":'".')"><img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/'.$b[$i].'.gif" /></a>';
	}*/
?>
				</div>
				<br class="clear">
<?php comment_id_fields(); ?>
<?php do_action('comment_form', $post->ID); ?>
			</form>
<?php
	}
?>
		</div>
		<div class="comments-b">
			<h2 class="comments-title">
				<?php comments_number('暂无评论', '已有1条评论', '已有%条评论'); ?>
			</h2><hr />
			<ol class="comment-list">
<?php 
	if ( have_comments() ) {
		wp_list_comments('type=comment&avatar_size=40&callback=biopaul_comment');
	}
?>		
			</ol>
		</div>
		<div id="comments-nav">
			<?php paginate_comments_links('prev_text=上一页&next_text=下一页');?>
		</div>
	</div>
</article>