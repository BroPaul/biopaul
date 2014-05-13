<?php
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) {
		die('非请勿入，谢谢合作o(∩_∩)o');
	}
	if ( post_password_required() ) {
?>
		<p class="nocomments">请输入密码查看</p>
<?php
		return;
	}
?>
<!-- Comments -->
<article>
	<div id="comments" class="comments">
		<div class="comments-b">
		<?php if ( have_comments() ) { ?>

			<h2 class="comments-title">
				<?php comments_number('沙发还在，快评论吧', '沙发没了，下次加油吧', '已有%条评论'); ?>
			</h2>

			<ol class="comment-list">
				<?php wp_list_comments('type=comment&avatar_size=40&callback=biopaul_comment'); ?>
			</ol>
		<?php } // end if ?>

		<?php if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) { ?>
			<p class="no-comments">
				<?php _e( '博主狠心地关闭了评论', 'required' ); ?>
			</p>
		<?php 
			} 
		 ?>
		</div>
		<div id="comments-nav">
			<?php paginate_comments_links('prev_text=上一页&next_text=下一页');?>
		</div>
		<div id="respond">
	    	<br>
	        <h5><img class="gravatar" src="http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&s=40"><?php comment_form_title('忍不住就吐个槽吧', '有话对 %s 说？可以啊，不过注意场合哦~'); ?><small class="cancelCommentReply"><?php cancel_comment_reply_link('（算了，放过Ta）'); ?></small></h5>
	        <?php
				if (get_option('comment_registration') && !is_user_logged_in()) {
			?>
	        <p><?php printf('请先 %1$s登录%2$s ，然后评论', '<a href="'.site_url().'/wp-login.php?redirect_to='.urlencode(get_permalink()).'">', '</a>') ?></p>
	        <?php
				}else {
			?>
	        <form id="commentform" action="<?php echo site_url(); ?>/wp-comments-post.php" method="post">
	        	<?php
	            	if (is_user_logged_in()) {
				?>
				<div class="info-col">
	            	<p><?php printf('您将以 %1$s 的身份评论 %2$s（换个帐号）%3$s', '<a href="'.site_url().'/wp-admin/profile.php">'.$user_identity.'</a>', '<a href="'.(function_exists('wp_logout_url') ? wp_logout_url(get_permalink()) : site_url().'/wp-login.php?action=logout').'">', '</a>') ?></p>
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
	                	<textarea placeholder="君子动口也动手，留下脚印你再走"  name="comment" id="comment" value=""></textarea>
	                </div>
	                <br class="clear">
	                <div class="btn-col">
	                	<input type="submit" name="comment-btn" id="comment-btn" value="写好了" class="button" />
	                	<span class="embedSmiley"><a href="javascript:smiley();"><img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/14/tza_thumb.gif" alt="表情" title="表情"></a></span>
	                </div>
	                <?php require_once(TEMPLATEPATH.'/includes/smiley.php'); ?>
	                <?php comment_id_fields(); ?>
	            <?php do_action('comment_form', $post->ID); ?>
	        </form>
	        <?php
				}
			?>
	    </div>
	</div>
</article>