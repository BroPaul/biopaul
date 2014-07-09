<?php
	// 多说最近访客
	if (!class_exists('Duoshuo_Widget_Recent_Visitors')){
		class Duoshuo_Widget_Recent_Visitors_clone extends WP_Widget {
			function __construct() {
				$widget_ops = array('classname' => 'ds-widget-recent-visitors', 'description' => '最近访客(从多说扒来的)。启用后请到 外观——Theme Options——高级设置 中填写您的多说域名' );
				parent::__construct('ds-recent-visitors', '最近访客(bioPaul)', $widget_ops);
				
				$this->alt_option_name = 'duoshuo_widget_recent_visitors';
			}
			function widget( $args, $instance ) {
				if ( ! isset( $args['widget_id'] ) )
					$args['widget_id'] = $this->id;
		 		extract($args, EXTR_SKIP);
		 		$output = '';
		 		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '最近访客' : $instance['title'], $instance, $this->id_base );
				if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
		 			$number = 12;
				$output .= $before_widget;
				if ( $title )
					$output .= $before_title . $title . $after_title;
				$data = array(
					'num_items'	=>	$number,
					'show_time'=>	isset($instance['show_time']) ? $instance['show_time'] : 1,
					'avatar_size'=>	isset($instance['avatar_size']) ? $instance['avatar_size'] : 50,
				);
				$attribs = '';
				foreach ($data as $key => $value)
					$attribs .= ' data-' . str_replace('_','-',$key) . '="' . esc_attr($value) . '"';
				$output .= '<ul class="ds-recent-visitors"' . $attribs . '></ul>'
						. $after_widget;
				echo $output;
			}
			function update( $new_instance, $old_instance ) {
				$instance = $old_instance;
				$instance['title'] = strip_tags($new_instance['title']);
				$instance['number'] = absint( $new_instance['number'] );
				$instance['show_time'] =  absint( $new_instance['show_time'] );
				$instance['avatar_size'] =  absint( $new_instance['avatar_size'] );
				$alloptions = wp_cache_get( 'alloptions', 'options' );
				if ( isset($alloptions['duoshuo_widget_recent_visitors']) )
					delete_option('duoshuo_widget_recent_visitors');
				return $instance;
			}
			function form( $instance ) {
				$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
				$number = isset($instance['number']) ? absint($instance['number']) : 15;
				$show_time = isset($instance['show_time']) ? absint($instance['show_time']) : 1;
				$avatar_size = isset($instance['avatar_size']) ? absint($instance['avatar_size']) : 50;
		?>
				<p><label for="<?php echo $this->get_field_id('title'); ?>">标题：</label>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
				<p><label for="<?php echo $this->get_field_id('number'); ?>">显示访客的数量：</label>
				<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
				<p><label for="<?php echo $this->get_field_id('avatar_size'); ?>">头像尺寸：</label>
				<input id="<?php echo $this->get_field_id('avatar_size'); ?>" name="<?php echo $this->get_field_name('avatar_size'); ?>" type="text" value="<?php echo $avatar_size; ?>" size="3" />px</p>
		<?php
			}
		}
		register_widget('Duoshuo_Widget_Recent_Visitors_clone');
	}

	// Flickr相册，暂不启用
	class biopaul_Flickr_Gallery_Widget extends WP_Widget {
		function biopaul_Flickr_Gallery_Widget() {
			$widget_ops = array(
				'classname' => 'flickr-gallery-widget',
				'description' => '显示指定用户的Flickr图片流'
			);
			$control_ops = array(
				'id_base' => 'biopaul-flickr-gallery'
			);
			$this->WP_Widget('biopaul-flickr-gallery','Flickr图片流(bioPaul)', $widget_ops, $control_ops);
		}
		function form($instance) {
			$defaults = array('title' => 'Flickr相册', 'flickrid' => '', 'streamtype' => 'user', 'displaytype' => 'latest', 'numthumbs' => '9', 'linktext' => '到Flickr查看');
			$instance = wp_parse_args( (array) $instance, $defaults );
?>
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>">标题：</label>
                <input name="<?php echo $this->get_field_name('title') ?>" id="<?php echo $this->get_field_id('title') ?> " value="<?php echo $instance['title'] ?>" class="widefat">
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('flickrid'); ?>">Flickr ID：</label>
                <input name="<?php echo $this->get_field_name('flickrid') ?>" id="<?php echo $this->get_field_id('flickrid') ?> " value="<?php echo $instance['flickrid'] ?>" class="widefat">
            </p>
            <p>
            	<label for="<?php echo $this->get_field_id('streamtype'); ?>">类型：</label>
                <select id="<?php echo $this->get_field_id('streamtype'); ?>" name="<?php echo $this->get_field_name('streamtype'); ?>" class="widefat">
                    <option value="user" <?php if ( 'user' == $instance['streamtype'] ) echo 'selected="selected"'; ?>>user</option>
                    <option value="group" <?php if ( 'group' == $instance['streamtype'] ) echo 'selected="selected"'; ?>>group</option>
                </select>
            </p>
            <p>
            	<label for="<?php echo $this->get_field_id('displaytype'); ?>">显示内容：</label>
                <select id="<?php echo $this->get_field_id('displaytype'); ?>" name="<?php echo $this->get_field_name('displaytype'); ?>" class="widefat">
                    <option value="latest" <?php if ( 'latest' == $instance['displaytype'] ) echo 'selected="selected"'; ?>>最新图片</option>
                    <option value="random" <?php if ( 'random' == $instance['displaytype'] ) echo 'selected="selected"'; ?>>随机图片</option>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('numthumbs'); ?>">显示图片的数量：</label>
                <input name="<?php echo $this->get_field_name('numthumbs') ?>" id="<?php echo $this->get_field_id('numthumbs') ?> " value="<?php echo $instance['numthumbs'] ?>" class="widefat">
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('linktext'); ?>">链接文字：</label>
                <input name="<?php echo $this->get_field_name('linktext') ?>" id="<?php echo $this->get_field_id('linktext') ?> " value="<?php echo $instance['linktext'] ?>" class="widefat">
            </p>
<?php
		}
		
		function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			$instance['flickrid'] = $new_instance['flickrid'];
			$instance['streamtype'] = $new_instance['streamtype'];
			$instance['displaytype'] = $new_instance['displaytype'];
			$instance['numthumbs'] = $new_instance['numthumbs'];
			$instance['linktext'] = $new_instance['linktext'];
			return $instance;
		}
		
		function widget($args, $instance) {
			extract($args);
			$title = $instance['title'];
			$flickrid = $instance['flickrid'];
			$streamtype = $instance['streamtype'];
			$displaytype = $instance['displaytype'];
			$numthumbs = $instance['numthumbs'];
			$linktext = $instance['linktext'];
			
			if ($flickrid != '') {
				$script = '<script>
					function loadFlickrStream() {
						jQuery(document).ready(function($) {
							if($(".flickr-gallery-widget").length != 0) {
								$.ajaxSetup({cache: true});
								$.getJSON("http://api.flickr.com/services/feeds/photos_public.gne?id='.$flickrid.'&lang=en-us&format=json&jsoncallback=?", function(data) {
									$(".flickr-gallery-widget").append("<ul></ul>");
									
									$counter = 0;
									$.each(data.items, function(index, item) {
										if (++$counter > '.$numthumbs.') {
											return false;
										}
										$(".flickr-gallery-widget > ul").append(\'<li><div class="flickr-thumb"><a href="\' + item.link + \'"><img src="\' + item.media.m + \'" width="50" height="50" alt=""/></a></div></li>\');
									});';
									if ($linktext) {
										$script .= '$(".flickr-gallery-widget").append(\'<div><a class="more-link2" href="http://flickr.com/photos/'.$flickrid.'">'.$linktext.'</a></div>\');';
									}
								$script .= '});
							}
						});
					}
					
					addLoadEvent(loadFlickrStream);
				</script>';
				
				$out = '<div id="flickr-badges-wrapper" class="clearfix"><script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count='.$numthumbs.'&display='.$displaytype.'&size=s&layout=x&source='.$streamtype.'&'.$streamtype.'='.$flickrid.'"></script></div>';
				
				if ($linktext) {
					$out .= '<div><a class="more-link2" target="_blank" href="http://flickr.com/photos/'.$flickrid.'">'.$linktext.'</a></div>';
				}
				
				//echo $script;
				echo $before_widget;
				echo $before_title.$title.$after_title;
				echo $out;
				echo $after_widget;
			}
			else {
				echo "亲，忘了填Flickr ID吧？";	
			}
		}
    
	}
	
	function register_biopaul_flickr_gallery_widget() {
		register_widget('biopaul_Flickr_Gallery_Widget');
	}
	// add_action('widgets_init', 'register_biopaul_flickr_gallery_widget');
?>
<?php
	// 最新作品小工具
	class biopaul_Recent_Work_Widget extends WP_Widget {
		function biopaul_Recent_Work_Widget() {
			$widget_ops = array(
				'classname' => 'recent-work-widget',
				'description' => '显示最近发布的作品'
			);
			$control_ops = array(
				'id_base' => 'biopaul-recent-work'
			);
			
			$this->WP_Widget('biopaul-recent-work','最新作品(bioPaul)', $widget_ops, $control_ops);
		}
		function form($instance) {
			$defaults = array('title' => '最新作品','numberitems' => '6');
			$instance = wp_parse_args( (array) $instance, $defaults );
?>
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>">标题：</label>
                <input name="<?php echo $this->get_field_name('title') ?>" id="<?php echo $this->get_field_id('title') ?> " value="<?php echo $instance['title'] ?>" class="widefat">
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('pageid'); ?>">作品页面：</label>
                <?php wp_dropdown_pages('name='.$this->get_field_name('pageid').'&selected='.$instance['pageid']); ?>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('numberposts'); ?>">显示作品的数量</label>
                <select id="<?php echo $this->get_field_id('numberposts'); ?>" name="<?php echo $this->get_field_name('numberposts'); ?>" class="widefat">
                    <?php
                        for ($i=1; $i <= 20; $i++) {
                            echo '<option value="'.$i.'"';
                            if ($i == $instance['numberposts']) {
                                echo ' selected="selected"';
                            }
                            echo '>'.$i.'</option>';
                        }
                    ?>
                </select>
            </p>
<?php
		}
		function update($new_instance, $old_instance) {
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			$instance['pageid'] = $new_instance['pageid'];
			$instance['numberposts'] = $new_instance['numberposts'];
			//$instance['linktext'] = $new_instance['linktext'];
			return $instance;
		}
		
		function widget($args, $instance) {
			extract($args);
			$title = $instance['title'];
			$pageid = $instance['pageid'];
			$numberposts = $instance['numberposts'];
			global $wpdb;
			$posts = get_posts('post_type=biopaul_work&numberposts='.$numberposts);
			$out = '<ul class="clearfix">';
			foreach($posts as $post) {
				$out .= '<li>';
				$full_size_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large');
				$out .= '<div class="post-thumb"><a href="'.$full_size_image[0].'" rel="prettyPhoto[biopaul_recent_work]">'.get_the_post_thumbnail($post->ID, 'biopaul-work-thumbnail-small').'</a></div>';
				$out .= '</li>';
			}
			$out .= '</ul>';
			echo $before_widget;
			echo $before_title.$title.$after_title;
			echo $out;
			echo $after_widget;
		}
    	
	}
	
	function register_biopaul_recent_work_widget() {
		register_widget('biopaul_Recent_Work_Widget');
	}
	add_action('widgets_init', 'register_biopaul_recent_work_widget');
?>