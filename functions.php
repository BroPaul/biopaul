<?php
	require_once(TEMPLATEPATH.'/option-tree/ot-loader.php');
	require_once(TEMPLATEPATH.'/includes/theme-options.php');
	require_once(TEMPLATEPATH.'/includes/widgets.php');
	require_once(TEMPLATEPATH.'/includes/shortcodes.php');
	require_once(TEMPLATEPATH.'/includes/tinymce/tinymce.php');
	add_filter('ot_theme_mode', '__return_true');
	add_filter('ot_show_pages', '__return_false');
 
	// 注册导航菜单
	function register_biopaul_menus() {
		register_nav_menus(
			array(
				'biopaul-main-menu' => '整站左侧导航'
			)
		);
	}
	add_action( 'init', 'register_biopaul_menus' );
	
	
	// 注册侧边栏
	register_sidebar(array(
		'name' => '首页侧边栏',
		'id'   => 'profile-sidebar',
		'description'   => '后台添加小工具后，该侧边栏将出现在首页右侧',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6 class="widget-title">',
		'after_title'   => '</h6>'
	));
	
	register_sidebar(array(
		'name' => '博客侧边栏',
		'id'   => 'blog-sidebar',
		'description'   => '后台添加小工具后，该侧边栏将出现在博客页面右侧',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6 class="widget-title">',
		'after_title'   => '</h6>'
	));
	
	// 主题设置
	function biopaul_theme_setup() {
		add_theme_support('post-thumbnails', array('biopaul_work'));
		add_image_size('biopaul-work-thumbnail', 210, 160, true);
		add_image_size('biopaul-work-thumbnail-small', 50, 50, true);
		
		// 默认缩略图大小
		// set_post_thumbnail_size(480, 80, true);
		
		// 启用文章格式（文档：http://codex.wordpress.org/Post_Formats）支持
		add_theme_support('post-formats', array('image', 'video','link'));
	}
	add_action('after_setup_theme', 'biopaul_theme_setup');
	
	function biopaul_wp_scripts() {
		wp_enqueue_style('style', get_template_directory_uri().'/style.css');
		wp_enqueue_style('prettyPhoto', get_template_directory_uri().'/images/pp/ppstyle.css');
		wp_enqueue_script('jquery');
		wp_enqueue_script('biopaulfunctions', get_template_directory_uri().'/biopaul.js');

		//只在single页面加载评论JS（已经包含在includes/smiley.php中，减少请求数）
		// if ( is_singular() && comments_open() && get_option('thread_comments') ) {
		// 	wp_enqueue_script( 'comment-reply' );
		}
	add_action('wp_enqueue_scripts', 'biopaul_wp_scripts');
	
 
	// 注册body类名
	add_filter('body_class','body_class_handler');
	function body_class_handler($classes) {
		if (is_front_page() ) {
			$blacklist = array('blog');
			$classes = array_diff($classes, $blacklist);
			$classes[] = 'profile';
		}
		
		if ((is_category() || is_single() || is_archive()) && get_post_type() == 'post') {
			$classes[] = 'blog';
		}
		
		if (get_post_type() == 'biopaul_work') {
			$classes[] = 'portfolio';
		}
		
		return $classes;
	}
	
	// 处理短代码
	function parse_shortcode_content( $content ) {
		$content = trim( do_shortcode( shortcode_unautop( $content ) ) );
		 // 去除首尾空格 
		if ( substr( $content, 0, 4 ) == '' ) {
			$content = substr( $content, 4 );
		}
		if ( substr( $content, -3, 3 ) == '' ) {
			$content = substr( $content, 0, -3 );
		}
		 // 去除空换行 
		$content = str_replace( array( '<p></p>' ), '', $content );
		$content = str_replace( array( '<p>  </p>' ), '', $content );
		return $content;
	}
	
	//处理完短代码再调用wpautop
	remove_filter('the_content', 'wpautop');
	add_filter('the_content', 'wpautop' , 99);
	add_filter('the_content', 'shortcode_unautop',100);
 
	// 注册自定义文章类型——Work（作品）
	function register_biopaul_works_post_type() {
		$labels = array(
			'name' => '作品',
			'singular_name' => '作品',
			'add_new' => '添加',
			'add_new_item' => '添加作品',
			'edit_item' => '编辑作品',
			'new_item' => '新作品',
			'view_item' => '查看作品',
			'search_items' => '搜索作品',
			'not_found' =>  '未找到作品',
			'not_found_in_trash' => '回收站中未找到作品'
		);
		$args = array(
			'labels' => $labels,
			'public' => true,
			'hierarchical' => false,
			'capability_type' => 'post',
			'menu_position' => 5,
			'has_archive' => 'true',
			'rewrite' => array('slug' => 'works'),
			'supports' => array('title', 'editor', 'comments', 'thumbnail', 'post-formats', 'excerpt', 'custom-fields'),
		);
		register_post_type('biopaul_work', $args);
	}
	add_action('init', 'register_biopaul_works_post_type', 1);
	
	// 注册自定义文章分类——Skills（作品分类）
	function create_work_taxonomies() {
		$labels = array(
			'name' => '作品分类',
			'singular_name' => '作品分类',
			'search_items' => '搜索分类',
			'all_items' => '全部分类',
			'parent_item' => '分类父级',
			'parent_item_colon' => '分类父级：',
			'edit_item' => '编辑分类',
			'update_item' => '更新父级',
			'add_new_item' => '新增分类',
			'new_item_name' => '分类名称',
		);
		
		register_taxonomy(
			'skills',
			array('biopaul_work'),
			array(
				'hierarchical' => true,
				'rewrite' => array(
					'slug' => 'skill',
					'hierarchical' => true
				),
				'labels' => $labels
			)
		);
	}
	add_action('init', 'create_work_taxonomies', 2);
 
	// 作品Meta信息
	add_action("add_meta_boxes", "add_work_meta_box");
	add_action('save_post', 'update_work_meta_box');
	
	function add_work_meta_box(){
		add_meta_box("work_meta_box_details", '高级选项', "work_meta_box_options", "biopaul_work", "normal", "low");
	}
	
	function work_meta_box_options() {
		global $post;
		$custom = get_post_custom($post->ID);
		$work_video_url = $custom["work_video_url"][0];
		$work_link_url = $custom["work_link_url"][0];
		$work_external_url = $custom["work_external_url"][0];
?>
		<div id="work-options">
			<p>
				<label for="work_video_url">视频作品网址（Portfolio页面单击作品封面自动播放视频，支持Youtube，优酷，土豆，新浪，56和HTML5视频链接）：</label>
				<input name="work_video_url" id="work_video_url" value="<?php echo $work_video_url?>" style="width:98%;"/>
			</p>
			<p>
				<label for="work_link_url">外部链接网址（单击作品封面打开）：</label>
				<input name="work_link_url" id="work_link_url" value="<?php echo $work_link_url?>" style="width:98%;"/>
			</p>
			<p>
				<label for="work_external_url">外部链接网址（单击作品标题打开）：</label>
				<input name="work_external_url" id="work_external_url" value="<?php echo $work_external_url?>" style="width:98%;"/>
			</p>
		</div>
<?php
	}
	function update_work_meta_box() {
		global $post;
		if ($post) {
			update_post_meta($post->ID, "work_video_url", $_POST["work_video_url"]);
			update_post_meta($post->ID, "work_external_url", $_POST["work_external_url"]);
			update_post_meta($post->ID, "work_link_url", $_POST["work_link_url"]);
		}
	}
 
	// 自定义Gravatar
	function biopaul_gravatar($avatar_defaults) {
		$biopaul_avatar = get_bloginfo('template_directory').'/images/gravatar.png';
		$avatar_defaults[$biopaul_avatar] = '自定义(请用你的图片覆盖 biopaul/images/gravatar.png)';
		return $avatar_defaults;
	}
	add_filter('avatar_defaults', 'biopaul_gravatar');
	
	// 评论列表
	function biopaul_comment($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
	<div class="commentBody" id="comment-<?php comment_ID(); ?>">
		<div class="commentDetails">
			<section class="commentMeta">
				<div class="commentMetaTop clearfix">
					<?php
						echo get_avatar($comment, $size='40');
					?>
					<span class="name"><?php echo get_comment_author_link(); ?></span><br>
					<span class="date"><?php printf(__('%1$s', 'biopaul'), get_comment_date()); ?><?php edit_comment_link('(编辑)',' ','') ?></span>
				</div>
				<?php
					if ($comment->comment_approved == '0') {
				?>
				<p class="alert-box warning">博主批准前不会显示您的评论，请耐心等待</p>
				<?php
					}
				?>
				<section class="commentContent">
				<?php comment_text(); ?>
				</section>
				<div class="reply">
					<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
				</div>
			</section>
		</div>
	</div>
<?php
	}
//调用CDN的js库
function cdn_js() {
	if (!is_admin()) {
		wp_deregister_script('jquery');
		wp_register_script('jquery',("http://apps.bdimg.com/libs/jquery/1.8.2/jquery.min.js"), false, "1.8.2", false);
		wp_deregister_script('backbone');
		wp_register_script('backbone',("http://apps.bdimg.com/libs/backbone.js/1.1.2/backbone-min.js"), false, "1.1.2", false);
	}
}
add_action('init', 'cdn_js');


//添加页面导航
function bropaul_pagination( $p = 2 ) {
	if ( is_singular() ) return;   
	global $wp_query, $paged;   
	$max_page = $wp_query->max_num_pages;   
	if ( $max_page == 1 ) return;   
	if ( empty( $paged ) ) $paged = 1;   
	echo '<div class="pagination"><span class="page-numbers page-count">'.$paged.' / '.$max_page.' </span> ';   
	if ( $paged > $p + 1 ) p_link( 1, '最前页', '&laquo;' );   
	if ( $paged > 1 ) p_link( $paged - 1, '上一页', '&lsaquo;' );   
	if ( $paged > $p + 2 ) echo '<a>...</a>';   
	for( $i = $paged - $p; $i <= $paged + $p; $i++ ) {   
	if ( $i > 0 && $i <= $max_page ) $i == $paged ? print "<span class='page-numbers current'>{$i}</span> " : p_link( $i );   
	}   
	if ( $paged < $max_page - $p - 1 ) echo '<span class="page-numbers">...</span>';   
	if ( $paged < $max_page ) p_link( $paged + 1,'下一页', '&rsaquo;' );   
	if ( $paged < $max_page - $p ) p_link( $max_page, '最末页', '&raquo;' );   
	// echo '<span>共['.$max_page.']页</span>';   
	echo '</div>';
}   

function p_link( $i, $title = '', $linktype = '' ) {  
   if ( $title == '' ) $title = "第 {$i} 页";  
   if ( $linktype == '' ) { $linktext = $i; } else { $linktext = $linktype; }  
   echo "<a class='page-numbers' href='", esc_html( get_pagenum_link( $i ) ), "' title='{$title}'>{$linktext}</a> ";  
}

// 添加文章内导航
// 设置右边导航
function wpspn_previous_post_link() {
	$args = array (
		'format'       		=> '%link',     // Link format (default: %link)
		'link'                	=> '&raquo;',   // Link string (default: &raquo;)
		'in_same_cat'        	=> FALSE,       // Apply only to same category (default: FALSE)
		'excluded_categories' 	=> ''           // Exclude categories (default: empty)
	);
	$args = apply_filters( 'wpspn_previous_link_args', $args );
	previous_post_link( $args['format'], $args['link'], $args['in_same_cat'], $args['excluded_categories'] );
} 
// 设置左边导航
function wpspn_next_post_link() {
	$args = array (
		'format'       		=> '%link',     
		'link'                	=> '&laquo;', 
		'in_same_cat'        	=> FALSE, 
		'excluded_categories' 	=> ''
	);
	$args = apply_filters( 'wpspn_next_link_args', $args );
	next_post_link( $args['format'], $args['link'], $args['in_same_cat'], $args['excluded_categories'] );
} 

function wpspn_single_prev_next_links() {
	$wpspn_previous_post_title_data = get_adjacent_post( false, '', true );
	$wpspn_previous_default_output = esc_attr( get_the_title( $wpspn_previous_post_title_data ) );
	$wpspn_previous_post_tooltip = apply_filters( 'wpspn_filter_previous_post_tooltip', $wpspn_previous_default_output );

	$wpspn_next_post_title_data = get_adjacent_post( false, '', false );
	$wpspn_next_default_output = esc_attr( get_the_title( $wpspn_next_post_title_data ) );
	$wpspn_next_post_tooltip = apply_filters( 'wpspn_filter_next_post_tooltip', $wpspn_next_default_output );

	if ( is_single() ) {
		?>
		<div class="wpspn-area">
			<div id="wpspn-prevpost" title="<?php echo esc_attr__( $wpspn_previous_post_tooltip ); ?>">
				<?php wpspn_previous_post_link();?>
			</div>
			<div id="wpspn-nextpost" title="<?php echo esc_attr__( $wpspn_next_post_tooltip ); ?>">
				<?php wpspn_next_post_link(); ?>
			</div>
		</div>
		<?php
	} 
} 
add_action( 'wp_footer', 'wpspn_single_prev_next_links', 100);

//评论回复邮件通知（所有回复都邮件通知）
function comment_mail_notify($comment_id) {
	$comment = get_comment($comment_id);
	$parent_id = $comment->comment_parent ? $comment->comment_parent : '';
	$spam_confirmed = $comment->comment_approved;
	if (($parent_id != '') && ($spam_confirmed != 'spam')) {
		$to = trim(get_comment($parent_id)->comment_author_email);
		$subject='您在 ['.get_option("blogname").'] 的留言有了新回复';
		$message='
		<div style="background-color:#fff;border:1px solid #666;color:#111;-moz-border-radius:8px;-webkit-border-radius:8px;border-radius:8px;font-size:12px;width:702px;margin:0 auto;margin-top:10px;font-family:微软雅黑, Times New Roman;">
			<div style="background:#666;width:100%;height:60px;color:white;-moz-border-radius:6px 6px 0 0;-webkit-border-radius:6px 6px 0 0;border-radius:6px 6px 0 0;">
				<span style="height:60px;line-height:60px;margin-left:30px;font-size:12px;">您在 <a style="text-decoration:none;color:#0df;font-size:14px" target="_blank" href="'.get_option("home").'">'.get_option("blogname") .'</a> 上的留言有新回复啦！
				</span>
			</div>
			<div style="width:90%;margin:0 auto">
				<p>'.trim(get_comment($parent_id)->comment_author).'，您好！</p>
				<p>您曾在 ['.get_option("blogname").'] 的文章《'.get_the_title($comment->comment_post_ID).'》上发表如下评论：</p>
				<p style="background-color:#EEE;border:1px solid #DDD;padding:10px;margin:15px 0;">'.nl2br(get_comment($parent_id)->comment_content).'</p>
				<p>'.trim($comment->comment_author).' 给您的回复如下：</p>
				<p style="background-color:#EEE;border:1px solid #DDD;padding:10px;margin:15px 0;">'.nl2br($comment->comment_content).'</p>
				<p>您可以 <a style="text-decoration:none;color:#09f" href="'.htmlspecialchars(get_comment_link($parent_id)).'" target="_blank">点击这里</a> 查看完整的回复內容，欢迎再次光临 <a style="text-decoration:none; color:#09f" href="'.get_option("home").'">'.get_option("blogname").'</a></p>
				<p>（本邮件由博主友情发送，直接回复邮件只能勾搭到博主，不能回复到和您对话的小伙伴哦 >.< ）</p>
			</div>
		</div>
		';
		$message = convert_smilies($message);
		$headers[] = "Content-Type: text/html;charset=utf-8";
		$headers[] = "From:".get_option('blogname')." <".get_option('admin_email').">";
		wp_mail( $to, $subject, $message, $headers );
	}
}
add_action('comment_post', 'comment_mail_notify');

//评论表情
function bropaul_smilies_src ($img_src, $img){
	return get_bloginfo('template_directory').'/images/smilies/'.$img;
}
add_filter('smilies_src','bropaul_smilies_src',1,10);

//Ajax评论
add_action('wp_ajax_nopriv_ajax_comment', 'ajax_comment');
add_action('wp_ajax_ajax_comment', 'ajax_comment');
function ajax_comment(){
	global $wpdb;
	$comment_post_ID = isset($_POST['comment_post_ID']) ? (int) $_POST['comment_post_ID'] : 0;
	$post = get_post($comment_post_ID);
	if ( empty($post->comment_status) ) {
		do_action('comment_id_not_found', $comment_post_ID);
		ajax_comment_err('回复出错，请刷新后重试');
	}
	$status = get_post_status($post);
	$status_obj = get_post_status_object($status);
	if ( !comments_open($comment_post_ID) ) {
		do_action('comment_closed', $comment_post_ID);
		ajax_comment_err('评论已关闭');
	} elseif ( 'trash' == $status ) {
		do_action('comment_on_trash', $comment_post_ID);
		ajax_comment_err('回复出错，请刷新后重试');
	} elseif ( !$status_obj->public && !$status_obj->private ) {
		do_action('comment_on_draft', $comment_post_ID);
		ajax_comment_err('回复出错，请刷新后重试');
	} elseif ( post_password_required($comment_post_ID) ) {
		do_action('comment_on_password_protected', $comment_post_ID);
		ajax_comment_err('请输入密码后评论');
	} else {
		do_action('pre_comment_on_post', $comment_post_ID);
	}
	$comment_author       = ( isset($_POST['author']) )  ? trim(strip_tags($_POST['author'])) : null;
	$comment_author_email = ( isset($_POST['email']) )   ? trim($_POST['email']) : null;
	$comment_author_url   = ( isset($_POST['url']) )     ? trim($_POST['url']) : null;
	$comment_content      = ( isset($_POST['comment']) ) ? trim($_POST['comment']) : null;
	$user = wp_get_current_user();
	if ( $user->exists() ) {
		if ( empty( $user->display_name ) )
			$user->display_name=$user->user_login;
		$comment_author       = $wpdb->escape($user->display_name);
		$comment_author_email = $wpdb->escape($user->user_email);
		$comment_author_url   = $wpdb->escape($user->user_url);
		$user_ID			  = $wpdb->escape($user->ID);
		if ( current_user_can('unfiltered_html') ) {
			if ( wp_create_nonce('unfiltered-html-comment_' . $comment_post_ID) != $_POST['_wp_unfiltered_html_comment'] ) {
				kses_remove_filters();
				kses_init_filters();
			}
		}
	} else {
		if ( get_option('comment_registration') || 'private' == $status )
			ajax_comment_err('请登录后评论');
	}
	$comment_type = '';
	if ( get_option('require_name_email') && !$user->exists() ) {
		if ( 6 > strlen($comment_author_email) || '' == $comment_author )
			ajax_comment_err('请填写昵称和邮箱，亲');
		elseif ( !is_email($comment_author_email))
			ajax_comment_err('邮箱格式不对，请检查');
	}
	if ( '' == $comment_content )
		ajax_comment_err('别闹，评论内容还没填呢');

	$dupe = "SELECT comment_ID FROM $wpdb->comments WHERE comment_post_ID = '$comment_post_ID' AND ( comment_author = '$comment_author' ";
	if ( $comment_author_email ) $dupe .= "OR comment_author_email = '$comment_author_email' ";
	$dupe .= ") AND comment_content = '$comment_content' LIMIT 1";
	if ( $wpdb->get_var($dupe) ) {
		ajax_comment_err('刷新看看，你要发表的评论是不是已经出现了？');
	}
	if ( $lasttime = $wpdb->get_var( $wpdb->prepare("SELECT comment_date_gmt FROM $wpdb->comments WHERE comment_author = %s ORDER BY comment_date DESC LIMIT 1", $comment_author) ) ) {
		$time_lastcomment = mysql2date('U', $lasttime, false);
		$time_newcomment  = mysql2date('U', current_time('mysql', 1), false);
		$flood_die = apply_filters('comment_flood_filter', false, $time_lastcomment, $time_newcomment);
		if ( $flood_die ) {
			ajax_comment_err('评论太快了，喝杯茶再来试试吧');
		}
	}
	$comment_parent = isset($_POST['comment_parent']) ? absint($_POST['comment_parent']) : 0;
	$commentdata = compact('comment_post_ID', 'comment_author', 'comment_author_email', 'comment_author_url', 'comment_content', 'comment_type', 'comment_parent', 'user_ID');

	$comment_id = wp_new_comment( $commentdata );

	$comment = get_comment($comment_id);
	do_action('set_comment_cookies', $comment, $user);
	$comment_depth = 1;
	$tmp_c = $comment;
	while($tmp_c->comment_parent != 0){
		$comment_depth++;
		$tmp_c = get_comment($tmp_c->comment_parent);
	}
	$GLOBALS['comment'] = $comment;
?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
	<div class="commentBody" id="comment-<?php comment_ID(); ?>">
		<div class="commentDetails">
			<section class="commentMeta">
				<div class="commentMetaTop clearfix">
					<?php
						echo get_avatar($comment, $size='40');
					?>
					<span class="name"><?php echo get_comment_author_link(); ?></span><br>
					<span class="date">刚刚</span>
				</div>
				<?php
					if ($comment->comment_approved == '0') {
				?>
				<p class="alert-box warning">博主批准前不会显示您的评论，请耐心等待</p>
				<?php
					}
				?>
				<section class="commentContent">
				<?php comment_text(); ?>
				</section>
			</section>
		</div>
	</div>
<?php die();
}
function ajax_comment_err($msg) {
	header('Allow: POST');
	header('HTTP/1.1 886 出错了');
	header('Content-Type: text/plain');
	echo $msg;
	exit;
}

//让WordPress支持用户名或邮箱登录
function dr_email_login_authenticate( $user, $username, $password ) {
	if ( is_a( $user, 'WP_User' ) )
		return $user;
 
	if ( !empty( $username ) ) {
		$username = str_replace( '&', '&', stripslashes( $username ) );
		$user = get_user_by( 'email', $username );
		if ( isset( $user, $user->user_login, $user->user_status ) && 0 == (int) $user->user_status )
			$username = $user->user_login;
	}
 
	return wp_authenticate_username_password( null, $username, $password );
}
remove_filter( 'authenticate', 'wp_authenticate_username_password', 20, 3 );
add_filter( 'authenticate', 'dr_email_login_authenticate', 20, 3 );
//替换“用户名”为“用户名 / 邮箱”
function username_or_email_login() {
	if ( 'wp-login.php' != basename( $_SERVER['SCRIPT_NAME'] ) )
		return;
?>
<script type="text/javascript">
if (document.getElementById('loginform') )
	document.getElementById('loginform').childNodes[1].childNodes[1].childNodes[0].nodeValue = '用户名 / 邮箱';
if (document.getElementById('login_error') )
	document.getElementById('login_error').innerHTML = document.getElementById('login_error').innerHTML.replace('用户名', '用户名 / 邮箱');
</script>
<?php
}
add_action( 'login_form', 'username_or_email_login' );

//自定义后台登录界面
function custom_headertitle () {
	return get_bloginfo('name');
}
add_filter('login_headertitle','custom_headertitle');
function custom_loginlogo_url() {
	return home_url();
}
add_filter( 'login_headerurl', 'custom_loginlogo_url' );
	// 手机用户不加载背景图
if (!preg_match('/Mobile/', $_SERVER['HTTP_USER_AGENT'])) {
	function custom_login() {
?>
<style>html{overflow:hidden}body{background:none !important;overflow:hidden;font:14px/1.4 "Microsoft Yahei"}#login{width:280px}#login h1 a{font-weight:bold;text-indent:0;background:none !important;font-size:36px;width:auto}#login form{padding:10px 0;background:#dde5ed;background:-moz-linear-gradient(top,rgba(221,229,237,1) 0,rgba(242,243,244,1) 100%);background:-webkit-gradient(linear,left top,left bottom,color-stop(0,rgba(221,229,237,1)),color-stop(100%,rgba(242,243,244,1)));background:-webkit-linear-gradient(top,rgba(221,229,237,1) 0,rgba(242,243,244,1) 100%);background:-ms-linear-gradient(top,rgba(221,229,237,1) 0,rgba(242,243,244,1) 100%);border-radius:8px;-webkit-box-shadow:inset 0 1px 3px rgba(0,0,0,0.36),0 1px 0 rgba(255,255,255,0.15);-moz-box-shadow:inset 0 1px 3px rgba(0,0,0,0.36),0 1px 0 rgba(255,255,255,0.15);box-shadow:inset 0 1px 3px rgba(0,0,0,0.36),0 1px 0 rgba(255,255,255,0.15)}#login form p,#login form p.submit{padding:0 15px}#login a{text-shadow:1px 1px 0 #000;color:#FFF !important}#login_error a{color:#000 !important;text-shadow:1px 1px 0 #FFF}#login label{color:#333;text-shadow:1px 1px 2px #FFF}#login form .input{border-radius:4px;padding:5px 10px;font-weight:bold;font-size:14px}#login .form-send .bot{width:100%;border-bottom:1px solid #ccc}#login .submit .button{width:100%;margin:10px auto}#footer{position:absolute;bottom:10px;height:30px;padding:0 20px;color:#FFF;text-shadow:1px 1px 0 #000}#footer a{color:#FFF}#loading{position:absolute;top:0;left:0;width:100%;height:100%;z-index:99;overflow:hidden;background:#000}#loading img{position:absolute;top:50%;left:50%;width:58px;height:10px;margin:-5px 0 0 -29px}#loginbg{position:absolute;top:0;left:0;width:100%;height:100%;z-index:99;overflow:hidden}#loginbg img{opacity:0}#backtoblog{display:none}</style>
<script src="http://apps.bdimg.com/libs/jquery/1.8.2/jquery.min.js"></script>
<?php
	}
	add_action('login_head', 'custom_login');
	function custom_html() {
?>
<div id="footer">
	<p>Inspired by <a href="http://webjyh.com" target="_blank">M.J</a></p>
</div>
<div id="loading">
	<img src="data:image/gif;base64,R0lGODlhOgAKAKIFAERERIWFhWVlZdbW1qampv///wAAAAAAACH/C05FVFNDQVBFMi4wAwEAAAAh+QQFCgAFACwAAAAAOgAKAAADawi6XCUwSheqvY7ozd34YMiMgCOdAnWtGed6YUw2Dxqpq9W6GxyDs4XJBsHlAjsewfcbBBVDojGX5DF/z1JNWjjqCspeoQl8Rm1TFji8HJOd5i2660Wuw1dZnFike6svbmRZZyhpGHdKeSEJACH5BAUKAAUALAAAAAA6AAoAAANrOLpcBTBKJ6q9LujNHflgyIyDI50Ada0Z53phTDYPGqmr1bobHIOzhckGweUEO17A9yMEFUOiMZfkMX/PUk1aOOoKyl6hCXxGbVMWOLwck53mLbrrRa7DV1mcWKR7qy9uZFlnKGkYd0p5IQkAIfkEBQoABQAsAAAAADoACgAAA2tIulw1MEoHqr1O6M1d+GDIjIQjnQN1rRnnemFMNg8aqavVuhscg7OFyQbB5QA7nsD3CwQVQ6Ixl+Qxf89STVo46grKXqEJfEZtUxY4vByTneYtuutFrsNXWZxYpHurL25kWWcoaRh3SnkhCQAh+QQFCgAFACwAAAAAOgAKAAADaxi6XEUwSjeqvQ7ozZ34YMiMgSOdBHWtGed6YUw2Dxqpq9W6GxyDs4XJBsHlBjsewPcTBBVDojGX5DF/z1JNWjjqCspeoQl8Rm1TFji8HJOd5i2660Wuw1dZnFike6svbmRZZyhpGHdKeSEJACH5BAUKAAUALAAAAAA6AAoAAANrKLpcFTBKR6q9bujNHfhgyIyCI50Bda0Z53phTDYPGqmr1bobHIOzhckGweUIO97A9wMEFUOiMZfkMX/PUk1aOOoKyl6hCXxGbVMWOLwck53mLbrrRa7DV1mcWKR7qy9uZFlnKGkYd0p5IQkAOw==">
</div>
<div id="loginbg"><img/></div>
<script>
	function resizeImage(id){$('#'+id).css({'position':'absolute','top':'0px','left':'0px','width':'100%','height':'100%','z-index':-1,'overflow':'hidden'});var w=$(window).width(),h=$(window).height(),o=$('#'+id).children('img'),iW=o.width(),iH=o.height();o.css({'display':'block','opacity':0});if(w>h){if(iW>iH){o.css({'width':w});o.css({'height':Math.round((iH/iW)*w)});var newIh=Math.round((iH/iW)*w);if(newIh<h){o.css({'height':h});o.css({'width':Math.round((iW/iH)*h)})}}else{o.css({'height':h});o.css({'width':Math.round((iW/iH)*h)})}}else{o.css({'height':h});o.css({'width':Math.round((iW/iH)*h)})}var newIW=o.width(),newIH=o.height();if(newIW>w){var l=(newIW-w)/2;o.css('margin-left',-l)}else{o.css('margin-left',0)}if(newIH>h){var t=(newIH-h)/2;o.css('margin-top',-t)}else{o.css('margin-top',0)}o.animate({'opacity':'1'})};$('#loginbg img').attr('src', "<?php bloginfo('template_directory')?>/images/login_bg.jpg").load(function(){resizeImage('loginbg');$(window).bind("resize", function() {resizeImage('loginbg');});});$('#loading').fadeOut();
</script>
<?php
	}
	add_action('login_footer', 'custom_html');

//Gravatar头像被墙
function mytheme_get_avatar($avatar) {
    $avatar = str_replace(array("www.gravatar.com","0.gravatar.com","1.gravatar.com","2.gravatar.com"),"cn.gravatar.com",$avatar);
    return $avatar;
}
add_filter( 'get_avatar', 'mytheme_get_avatar', 10, 3 );

}
?>
<?php 
// 至此本主题function.php结束，如果下方出现多余代码，说明你的WordPress已经被黑
?>