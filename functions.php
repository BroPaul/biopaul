<?php
//本文件不要轻易替换
//上传前修改94-100，347-357行，邮件、禁用自动草稿可能不需要
	require_once(TEMPLATEPATH.'/includes/widgets.php');
	require_once(TEMPLATEPATH.'/includes/shortcodes.php');
	require_once(TEMPLATEPATH.'/includes/tinymce/tinymce.php');
?>
<?php
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
		'description'   => '后台添加小工具后，该侧边栏将出现在首页',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6 class="widget-title">',
		'after_title'   => '</h6>'
	));
	
	register_sidebar(array(
		'name' => '博客侧边栏',
		'id'   => 'blog-sidebar',
		'description'   => '后台添加小工具后，该侧边栏将出现在博客页面',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6 class="widget-title">',
		'after_title'   => '</h6>'
	));
	
	// 主题设置
	function biopaul_theme_setup() {
		add_theme_support('post-thumbnails', array('post', 'page', 'biopaul_work'));
		add_image_size('biopaul-work-thumbnail', 210, 160, true);
		add_image_size('biopaul-work-thumbnail-small', 50, 50, true);
		add_image_size('biopaul-post-thumbnail', 480, 80, true);
		add_image_size('biopaul-post-thumbnail-fw', 690, 115, true);
		
		// 默认缩略图大小
		set_post_thumbnail_size(480, 80, true);
		
		// 启用文章格式（文档：http://codex.wordpress.org/Post_Formats）支持
		add_theme_support('post-formats', array('image', 'video','link'));
	}
	add_action('after_setup_theme', 'biopaul_theme_setup');
	
	function biopaul_wp_scripts() {
		wp_enqueue_style('style', get_template_directory_uri().'/style.css');
		// wp_enqueue_style('prettyPhoto', 'http://dn-f.qbox.me/prettyPhoto/style.css');
		// 上传之前改回这个
		wp_enqueue_style('prettyPhoto', '/lib/ppstyle.css');
		wp_enqueue_script('jquery');
		// wp_enqueue_script('biopaulfunctions', 'http://bcs.duapp.com/myfile/js/biopic.js?v20140204');
		// 上传之前改回这个
		wp_enqueue_script('biopaulfunctions', get_template_directory_uri().'/biopaul.js');

		//只在single页面加载评论JS（已经包含在biopaul.js中，减少请求数）
		// if ( is_singular() && comments_open() && get_option('thread_comments') ) {
		// 	wp_enqueue_script( 'comment-reply' );
		}
	add_action('wp_enqueue_scripts', 'biopaul_wp_scripts');
	
?>
<?php
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
	
	
	function parse_shortcode_content( $content ) {
		$content = trim( do_shortcode( shortcode_unautop( $content ) ) );
		/* 去除空格 */
		if ( substr( $content, 0, 4 ) == '' ) {
			$content = substr( $content, 4 );
		}
		if ( substr( $content, -3, 3 ) == '' ) {
			$content = substr( $content, 0, -3 );
		}
		/* 去除换行 */
		$content = str_replace( array( '<p></p>' ), '', $content );
		$content = str_replace( array( '<p>  </p>' ), '', $content );
		return $content;
	}
	
	//处理完短代码再调用wpautop
	remove_filter('the_content', 'wpautop');
	add_filter('the_content', 'wpautop' , 99);
	add_filter('the_content', 'shortcode_unautop',100);
?>
<?php
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
	
	// 注册作品分类——Skills
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
?>
<?php
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
                <label for="work_video_url">点击作品图播放视频（填写视频播放页网址即可）：</label>
                <input name="work_video_url" id="work_video_url" value="<?php echo $work_video_url?>" style="width:98%;"/>
			</p>
			<p>
                <label for="work_link_url">点击作品图链接到其他网址：</label>
                <input name="work_link_url" id="work_link_url" value="<?php echo $work_link_url?>" style="width:98%;"/>
			</p>
            <p>
                <label for="work_external_url">点击作品名链接到其他网址：</label>
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
?>

<?php
	// 自定义Gravatar
	function biopaul_gravatar($avatar_defaults) {
		$biopaul_avatar = get_template_directory_uri().'/images/gravatar.png';
		$avatar_defaults[$biopaul_avatar] = '自定义(请用你的图片覆盖 主题文件夹/images/gravatar.png)';
		return $avatar_defaults;
	}
	add_filter('avatar_defaults', 'biopaul_gravatar');
	
	// 评论表单
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
				<p><em>博主批准前不会显示您的评论，请耐心等待</em></p>
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
        // wp_register_script('jquery',("http://libs.baidu.com/jquery/1.8.2/jquery.min.js"), false, "1.8.2", false);
        wp_register_script('jquery',("/lib/jquery-1.8.2.min.js"), false, "1.8.2", false);

        wp_deregister_script('backbone');
        // wp_register_script('backbone',("http://libs.baidu.com/backbone/0.9.2/backbone-min.js"), false, "0.9.2", false);
        wp_register_script('backbone',("lib/backbone-0.9.2.min.js"), false, "0.9.2", false);
    }
}
add_action('init', 'cdn_js');

//禁用自动保存草稿
function disableAutoSave(){
    wp_deregister_script('autosave');
}
add_action( 'wp_print_scripts', 'disableAutoSave' );

//评论回复邮件通知（所有回复都邮件通知）
function comment_mail_notify($comment_id) {
$comment = get_comment($comment_id);
$parent_id = $comment->comment_parent ? $comment->comment_parent : '';
$spam_confirmed = $comment->comment_approved;
if (($parent_id != '') && ($spam_confirmed != 'spam')) {
$to = trim(get_comment($parent_id)->comment_author_email);
$subject='亲，您在 ['.get_option("blogname").'] 的留言有新回复了~';
$message='
<div style="background-color:#fff; border:1px solid #666666; color:#111;-moz-border-radius:8px; -webkit-border-radius:8px; -khtml-border-radius:8px;border-radius:8px; font-size:12px; width:702px; margin:0 auto; margin-top:10px;font-family:微软雅黑, Arial;">
	<div style="background:#666666; width:100%; height:60px; color:white;-moz-border-radius:6px 6px 0 0; -webkit-border-radius:6px 6px 0 0;-khtml-border-radius:6px 6px 0 0; border-radius:6px 6px 0 0; ">
		<span style="height:60px; line-height:60px; margin-left:30px; font-size:12px;">您在 <a style="text-decoration:none; color:#09f;font-weight:600;" href="'.get_option("home").'">'.get_option("blogname") .'</a> 上的留言有新回复啦！
		</span>
	</div>
	<div style="width:90%; margin:0 auto">
		<p>'.trim(get_comment($parent_id)->comment_author).'，您好！</p>
		<p>您曾在 ['.get_option("blogname").'] 的文章《'.get_the_title($comment->comment_post_ID).'》上发表如下评论：</p>
		<p style="background-color: #EEE;border: 1px solid #DDD;padding: 10px;margin: 15px 0;">'.nl2br(get_comment($parent_id)->comment_content).'</p>
		<p>'.trim($comment->comment_author).' 给您的回复如下：</p>
		<p style="background-color: #EEE;border: 1px solid #DDD;padding: 10px;margin: 15px 0;">'.nl2br($comment->comment_content).'</p>
		<p>您可以 <a style="text-decoration:none; color:#09f" href="'.htmlspecialchars(get_comment_link($parent_id)).'">点击这里</a> 查看完整的回复內容，欢迎再次光临 <a style="text-decoration:none; color:#09f" href="'.get_option("home").'">'.get_option("blogname").'</a> </p>
		<p>（ 本邮件由博主友情发送，直接回复邮件只能勾搭到博主，不能回复到和您对话的小伙伴哦 >.< ）</p>
	</div>
</div>
';
$message = convert_smilies($message);
$headers[] = "Content-Type: text/html;charset=".get_option('blog_charset');
$headers[] = "From: 豆杀包(Paul Allen) <contact@bropaul.com>";
wp_mail( $to, $subject, $message, $headers );
}
}
add_action('comment_post', 'comment_mail_notify');

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

function ddw_wpspn_single_prev_next_links() {
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
add_action( 'wp_footer', 'ddw_wpspn_single_prev_next_links', 100);

//评论表情
function bropaul_smilies_src ($img_src, $img){
    return get_bloginfo('template_directory').'/images/smilies/'.$img;
}
add_filter('smilies_src','bropaul_smilies_src',1,10);

?>