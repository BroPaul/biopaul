<?php
require_once('biopaul_config.php');
if (!current_user_can('edit_pages') && !current_user_can('edit_posts'))
	wp_die("权限不够");
    global $wpdb;
?>
<html>
<head>
<title>使用短代码</title>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo  get_template_directory_uri() ?>/includes/tinymce/tinymce.js"></script>
	<base target="_self" />
<style type="text/css">
<!-- 
select#biopaulshortcode_tag {font:12px Times New Roman, Microsoft Yahei;width: 200px}
select#biopaulshortcode_tag option { font:normal 12px/18px Times New Roman, Microsoft Yahei; padding:1px 0;}
#link .panel_wrapper, #link div.current {height: 66px;}
-->
</style>
</head>
<body id="link" onLoad="tinyMCEPopup.executeOnLoad('init();');document.body.style.display='';
document.getElementById('biopaulshortcode_tag').focus();" style="display: none">
	<form name="biopaul_tabs" action="#">
	<div class="tabs">
		<ul><li id="biopaul_tab" class="current"><span><a href="javascript:mcTabs.displayTab('biopaul_tab','biopaulshortcode_panel');" onMouseDown="return false;">短代码</a></span></li></ul>
	</div>
	
	<div class="panel_wrapper">
		<div id="biopaulshortcode_panel" class="panel current">
		<br />
		<table border="0" cellpadding="4" cellspacing="0" style="margin: 0 auto">
         <tr>
            <td><select id="biopaulshortcode_tag" name="biopaulshortcode_tag">
                <option value="0">请选择要使用的短代码</option>
				<?php
					if(is_array($shortcode_tags)) {
						$i=1;
						echo( $shortcode_tags );

						foreach ($shortcode_tags as $biopaul_shortcodekey => $short_code_value) {
							var_dump($short_code_value);
							if(stristr($short_code_value, 'biopaul_')) {
								$biopaul_shortcode_name = str_replace('biopaul_', '' ,$short_code_value);
								$biopaul_shortcode_names = str_replace('_', ' ' ,$biopaul_shortcode_name);
								$biopaul_shortcodenames = ucwords($biopaul_shortcode_names);
							
								echo '<option value="' . $biopaul_shortcodekey . '" >' . $biopaul_shortcodenames.'</option>' . "\n";
								// echo '</optgroup>';

								$i++;
							}
						}
					}
			?>
            </select></td>
          </tr>
         
        </table>
		</div>
		
	</div>
		
	
	</div>

	<div class="mceActionPanel">
		<div style="float: left">
			<input type="button" id="cancel" name="cancel" value="取消" onClick="tinyMCEPopup.close();" />
		</div>

		<div style="float: right">
			<input type="submit" id="insert" name="insert" value="确定" onClick="biopaulshortcodesubmit();" />
		</div>
	</div>
</form>
</body>
</html>
