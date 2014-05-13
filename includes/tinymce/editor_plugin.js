(function() {
	tinymce.create('tinymce.plugins.biopaulPanel', {
		init : function(ed, url) {
			ed.addCommand('mcebiopaulPanel', function() {
				ed.windowManager.open({
					url : url + '/dialog.php',
					width : 400 ,
					height : 160
				}, {
					plugin_url : url,
				});
			});

			ed.addButton('biopaulPanel', {
				title : '短代码',
				cmd : 'mcebiopaulPanel',
				image : url + '/shortcode.png',
				stateSelector: 'img',
			});
		}
	});

	tinymce.PluginManager.add('biopaulPanel', tinymce.plugins.biopaulPanel);
})();