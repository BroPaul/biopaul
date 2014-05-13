<?php
class add_biopaulshortcode_button {
	var $pluginname = 'biopaulPanel';
	var $path = '';
	var $internalVersion = 103;
	
	function add_biopaulshortcode_button() {
		$this->path = get_template_directory_uri() . '/includes/tinymce/';	
		add_filter('tiny_mce_version', array (&$this, 'change_tinymce_version') );
		add_action('init', array(&$this, 'addbuttons'));
	}
	
	function addbuttons() {
		global $page_handle;
		if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') ) 
			return;
			if (get_user_option('rich_editing') == 'true') {
				add_filter("mce_external_plugins", array (&$this, 'add_tinymce_plugin' ), 5);
				add_filter('mce_buttons', array (&$this, 'register_button' ), 5);
			}
		}

	
	function register_button($buttons) {
		array_push($buttons, 'separator', $this->pluginname );
		return $buttons;
	}
	
	function add_tinymce_plugin($plugin_array) {
		global $page_handle;
		$post_id = $_GET['post'];
		$post = get_post($post_id);
		$post_type = $post->post_type;
		$plugin_array[$this->pluginname] =  $this->path . 'editor_plugin.js';
		return $plugin_array;
	}
	
	/**
	 * add_nextgen_button::change_tinymce_version()
	 * A different version will rebuild the cache
	 * 
	 * @return $version
	 */
	function change_tinymce_version($version) 
	{
		$version = $version + $this->internalVersion;
		return $version;
	}
	
}

// Call it now
$tinymce_button = new add_biopaulshortcode_button();
?>