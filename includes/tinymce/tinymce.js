function init() {
	tinyMCEPopup.resizeToInnerSize();
}

function getCheckedValue(radioObj) {
	if(!radioObj) {
		return "";
	}
	var radioLength = radioObj.length;
	if (radioLength == undefined) {
		if (radioObj.checked) {
			return radioObj.value;
		}
		else {
			return "";
		}
	}
	for(var i = 0; i < radioLength; i++) {
		if(radioObj[i].checked) {
			return radioObj[i].value;
		}
	}
	return "";
}

function biopaulshortcodesubmit() {
	var tagtext;
	var biopaul_shortcode = document.getElementById('biopaulshortcode_panel');
	if (biopaul_shortcode.className.indexOf('current') != -1) {
		var biopaul_shortcodeid = document.getElementById('biopaulshortcode_tag').value;
		switch(biopaul_shortcodeid) {
			case 0:
				tinyMCEPopup.close();
			  break;
			
			case "textblock":
				tagtext = "["+ biopaul_shortcodeid + " title=\"Title goes here\"] Description goes here [/" + biopaul_shortcodeid + "]";
				break;
				
			case "tabs":
				tagtext = "["+ biopaul_shortcodeid + " tabs=\"Tab1,Tab2,Tab3\"]";
				break;
				
			case "tabscontent":
				tagtext = "["+ biopaul_shortcodeid + "] Add individual tabs content here [/" + biopaul_shortcodeid + "]";
				break;
				
			case "tabcontent":
				tagtext = "["+ biopaul_shortcodeid + " id=\"Title Should match the corresponding tab title e.g. Tab1\"] Tab content goes here [/" + biopaul_shortcodeid + "]";
				break;
				
			case "tabsexample":
				tagtext = "[tabs tabs=\"Tab1,Tab2,Tab3\"][tabscontent][tabcontent id=\"tab1\" class=\"active\"]Tab1 content goes here[/tabcontent][tabcontent id=\"tab2\"]Tab2 content goes here[/tabcontent][tabcontent id=\"tab3\"]Tab3 content goes here[/tabcontent][/tabscontent]";
				break;
				
			case "toggle":
				tagtext = "["+ biopaul_shortcodeid + " title=\"Title goes here\"] Content goes here [/" + biopaul_shortcodeid + "]";
				break;
				
			case "accordiontabsexample":
				tagtext = "[accordion id=\"选填\"]\n[accordiontab title=\"标签1标题\" active=\"true\"]标签1内容[/accordiontab]\n[accordiontab title=\"标签2标题\"]标签2内容[/accordiontab]\n[accordiontab title=\"标签3标题\"]标签3内容[/accordiontab]\n[accordiontab title=\"标签4标题\"]标签4内容[/accordiontab]\n[/accordion]";
				break;
			
			case "blockquote":
				tagtext = "["+ biopaul_shortcodeid + " author=\"作者（可选）\"] 引用的内容 [/" + biopaul_shortcodeid + "]";
				break;
				
			case "list":
				tagtext = "["+ biopaul_shortcodeid + "  type=\"Specify one of the possible values here (see documentation for details\"] <ul><li>List Item 1</li><li>List Item 2</li></ul> [/" + biopaul_shortcodeid + "]";
				break;
				
			case "alert":
				tagtext = "["+biopaul_shortcodeid + " type=\"Choose from standard, warning, notice, success, error or info\"] Alert content goes here [/" + biopaul_shortcodeid + "]";
				break;
				
			case "button":
				tagtext = "["+biopaul_shortcodeid + " label=\"Insert button label here\" link=\"Insert link here\" shape=\"Choose either default or round\"]";
				break;
				
			default:
				tagtext = "["+biopaul_shortcodeid + "] Insert you content here [/" + biopaul_shortcodeid + "]";
		}
	}
	
	if(window.tinyMCE) {
		window.tinyMCE.execCommand('content', 'mceInsertContent', false, tagtext);
		tinyMCEPopup.editor.execCommand('mceRepaint');
		tinyMCEPopup.close();
	}
	return;
}