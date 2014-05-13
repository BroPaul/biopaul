<?php
	/* === Flickr 小工具 === */
	class biopaul_Flickr_Gallery_Widget extends WP_Widget {
		
		function biopaul_Flickr_Gallery_Widget() {
			$widget_ops = array(
				'classname' => 'flickr-gallery-widget',
				'description' => __('Shows flickr photo stream for a given stream id in widgetized area', 'biopaul')
			);
			
			$control_ops = array(
				'id_base' => 'biopaul-flickr-gallery'
			);
			
			$this->WP_Widget('biopaul-flickr-gallery', __('biopaul Flickr Photo Stream', 'biopaul'), $widget_ops, $control_ops);
		}
		
		function form($instance) {
			$defaults = array('title' => __('Flickr Gallery', 'biopaul'), 'flickrid' => '', 'streamtype' => 'user', 'displaytype' => 'latest', 'numthumbs' => '9', 'linktext' => __('view flickr gallery', 'biopaul'));
			$instance = wp_parse_args( (array) $instance, $defaults );
?>
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'biopaul'); ?></label>
                <input name="<?php echo $this->get_field_name('title') ?>" id="<?php echo $this->get_field_id('title') ?> " value="<?php echo $instance['title'] ?>" class="widefat">
            </p>
            
            <p>
                <label for="<?php echo $this->get_field_id('flickrid'); ?>"><?php _e('Flickr ID:', 'biopaul'); ?></label>
                <input name="<?php echo $this->get_field_name('flickrid') ?>" id="<?php echo $this->get_field_id('flickrid') ?> " value="<?php echo $instance['flickrid'] ?>" class="widefat">
            </p>
            
            <p>
            	<label for="<?php echo $this->get_field_id('streamtype'); ?>"><?php _e('Stream Type (user or group):', 'biopaul'); ?></label>
                <select id="<?php echo $this->get_field_id('streamtype'); ?>" name="<?php echo $this->get_field_name('streamtype'); ?>" class="widefat">
                    <option <?php if ( 'user' == $instance['streamtype'] ) echo 'selected="selected"'; ?>>user</option>
                    <option <?php if ( 'group' == $instance['streamtype'] ) echo 'selected="selected"'; ?>>group</option>
                </select>
            </p>
            
            <p>
            	<label for="<?php echo $this->get_field_id('displaytype'); ?>"><?php _e('Display Type (latest or random):', 'biopaul'); ?></label>
                <select id="<?php echo $this->get_field_id('displaytype'); ?>" name="<?php echo $this->get_field_name('displaytype'); ?>" class="widefat">
                    <option <?php if ( 'latest' == $instance['displaytype'] ) echo 'selected="selected"'; ?>>latest</option>
                    <option <?php if ( 'random' == $instance['displaytype'] ) echo 'selected="selected"'; ?>>random</option>
                </select>
            </p>
            
            <p>
                <label for="<?php echo $this->get_field_id('numthumbs'); ?>"><?php _e('Number of Thumbs to Show:', 'biopaul'); ?></label>
                <input name="<?php echo $this->get_field_name('numthumbs') ?>" id="<?php echo $this->get_field_id('numthumbs') ?> " value="<?php echo $instance['numthumbs'] ?>" class="widefat">
            </p>
            
            <p>
                <label for="<?php echo $this->get_field_id('linktext'); ?>"><?php _e('Link Text e.g. view flickr gallery:', 'biopaul'); ?></label>
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
					$out .= '<div><a class="more-link2" href="http://flickr.com/photos/'.$flickrid.'">'.$linktext.'</a></div>';
				}
				
				//echo $script;
				echo $before_widget;
				echo $before_title.$title.$after_title;
				echo $out;
				echo $after_widget;
			}
			else {
				_e('First specify the flickr id in the widget settings.', 'biopaul');	
			}
		}
    
	}
	
	function register_biopaul_flickr_gallery_widget() {
		register_widget('biopaul_Flickr_Gallery_Widget');
	}
	add_action('widgets_init', 'register_biopaul_flickr_gallery_widget');
?>
<?php
	/* === Recent Work 小工具 === */
	class biopaul_Recent_Work_Widget extends WP_Widget {
	
		function biopaul_Recent_Work_Widget() {
			$widget_ops = array(
				'classname' => 'recent-work-widget',
				'description' => __('Shows most recent work', 'biopaul')
			);
			
			$control_ops = array(
				'id_base' => 'biopaul-recent-work'
			);
			
			$this->WP_Widget('biopaul-recent-work', __('biopaul Recent Work', 'biopaul'), $widget_ops, $control_ops);
		}
		
		function form($instance) {
			$defaults = array('numberitems' => '6');
			$instance = wp_parse_args( (array) $instance, $defaults );
?>
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'biopaul'); ?></label>
                <input name="<?php echo $this->get_field_name('title') ?>" id="<?php echo $this->get_field_id('title') ?> " value="<?php echo $instance['title'] ?>" class="widefat">
            </p>
            
            <p>
                <label for="<?php echo $this->get_field_id('pageid'); ?>"><?php _e('Portfolio Page:', 'biopaul'); ?></label>
                <?php wp_dropdown_pages('name='.$this->get_field_name('pageid').'&selected='.$instance['pageid']); ?>
            </p>
            
            <p>
                <label for="<?php echo $this->get_field_id('numberposts'); ?>"><?php _e('Number of Projects:', 'biopaul'); ?></label>
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
				$out .= '<div class="post-thumb"><a href="'.$full_size_image[0].'" rel="prettyPhoto[biopaul_recent_work_gal]">'.get_the_post_thumbnail($post->ID, 'biopaul-work-thumbnail-small').'</a></div>';
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