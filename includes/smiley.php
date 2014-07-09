<script type="text/javascript">
var addComment={moveForm:function(a,b,c,d){var e,f=this,g=f.I(a),h=f.I(c),i=f.I("cancel-comment-reply-link"),j=f.I("comment_parent"),k=f.I("comment_post_ID");if(g&&h&&i&&j){f.respondId=c,d=d||!1,f.I("wp-temp-form-div")||(e=document.createElement("div"),e.id="wp-temp-form-div",e.style.display="none",h.parentNode.insertBefore(e,h)),g.parentNode.insertBefore(h,g.nextSibling),k&&d&&(k.value=d),j.value=b,i.style.display="",i.onclick=function(){var a=addComment,b=a.I("wp-temp-form-div"),c=a.I(a.respondId);if(b&&c)return a.I("comment_parent").value="0",b.parentNode.insertBefore(c,b),b.parentNode.removeChild(b),this.style.display="none",this.onclick=null,!1};try{f.I("comment").focus()}catch(l){}return!1}},I:function(a){return document.getElementById(a)}};

var $commentform = $('#commentform'),
	txt1 = '<div id="loading">正在提交, 请稍候...</div>',
	txt2 = '<div id="error"></div>',
	num = 0,
	$submit_btn = $('#comment-btn'); $submit_btn.attr('disabled', false),
	$body = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body');
	$('#comment').after( txt1 + txt2 );
	$('#loading,#error').hide();

$('body').on("submit", "#commentform",function() {
	editcode();
	$('#loading').slideDown();
	$submit_btn.attr('disabled', true).fadeTo('slow', 0.5);
	$.ajax( {
		url: "<?php echo admin_url('admin-ajax.php');?>",
		data: $(this).serialize() + "&action=ajax_comment",
		type: $(this).attr('method'),
		error: function(request) {
			$('#loading').slideUp();
			$('#error').slideDown().html(request.responseText);
			setTimeout(function() {$submit_btn.attr('disabled', false).fadeTo('slow', 1); $('#error').slideUp();}, 3000);
		},
		success: function(data) {
			$('#loading').hide();
			$('textarea').each(function() {this.value = ''});
			var t = addComment, cancel = t.I('cancel-comment-reply-link'),temp = t.I('wp-temp-form-div'), respond = t.I(t.respondId), post = t.I('comment_post_ID').value, parent = t.I('comment_parent').value;
			// 更新评论数
			$comm_title = $('h2.comments-title');
			if ($comm_title.length) {
				n = parseInt($comm_title.text().match(/\d+/));
				$comm_title.text($comm_title.text().replace( n, n + 1 ));
			}
			// 插入新评论
			new_htm = ' id="new_comm_' + num + '"></';
			if (parent == '0') {
				new_htm = '\n<div' + new_htm + 'div>';
				$('ol.comment-list').prepend(new_htm);
			}else{
				new_htm = '\n<ul class="children"' + new_htm + 'ul>';
				$('#li-comment-'+parent).append(new_htm);
			}
			$('#new_comm_' + num).fadeOut().append(data);
			$('#new_comm_' + num).fadeIn(3000);
			// 滚动到新评论，重置
			$body.animate({scrollTop: $('#new_comm_' + num).offset().top-50}, 500);
			countdown(); num++ ;
			cancel.style.display = 'none';
			cancel.onclick = null;
			t.I('comment_parent').value = '0';
			if (temp && respond) {
				temp.parentNode.insertBefore(respond, temp);
				temp.parentNode.removeChild(temp)
			}
		}
	}); 
	return false;
});

var wait = 15, submit_val = $submit_btn.val();
function countdown() {
	if ( wait > 0 ) {
		$submit_btn.val(wait); wait--; setTimeout(countdown, 1000);
	} else {
		$submit_btn.val(submit_val).attr('disabled', false).fadeTo('slow', 1);
		wait = 15;
	}
}

function grin(tag){var myField;tag=" "+tag+" ";if(document.getElementById("comment")&&document.getElementById("comment").type=="textarea"){myField=document.getElementById("comment")}else{return false}if(document.selection){myField.focus();sel=document.selection.createRange();sel.text=tag;myField.focus()}else{if(myField.selectionStart||myField.selectionStart=="0"){var startPos=myField.selectionStart;var endPos=myField.selectionEnd;var cursorPos=endPos;myField.value=myField.value.substring(0,startPos)+tag+myField.value.substring(endPos,myField.value.length);cursorPos+=tag.length;myField.focus();myField.selectionStart=cursorPos;myField.selectionEnd=cursorPos}else{myField.value+=tag;myField.focus()}}};

function editcode(){var a="",b=$("#comment").val(),start=b.indexOf("<code>"),end=b.indexOf("</code>");if(start>-1&&end>-1&&start<end){a="";while(end!=-1){a+=b.substring(0,start+6)+b.substring(start+6,end).replace(/<(?=[^>]*?>)/gi,"&lt;").replace(/>/gi,"&gt;");b=b.substring(end+7,b.length);start=b.indexOf("<code>")==-1?-6:b.indexOf("<code>");end=b.indexOf("</code>");if(end==-1){a+="</code>"+b;$("#comment").val(a)}else{if(start==-6){myFielde+="&lt;/code&gt;"}else{a+="</code>"}}}}var b=a?a:$("#comment").val(),a="",start=b.indexOf("<pre>"),end=b.indexOf("</pre>");if(start>-1&&end>-1&&start<end){a=a}else{return}while(end!=-1){a+=b.substring(0,start+5)+b.substring(start+5,end).replace(/<(?=[^>]*?>)/gi,"&lt;").replace(/>/gi,"&gt;");b=b.substring(end+6,b.length);start=b.indexOf("<pre>")==-1?-5:b.indexOf("<pre>");end=b.indexOf("</pre>");if(end==-1){a+="</pre>"+b;$("#comment").val(a)}else{if(start==-5){myFielde+="&lt;/pre&gt;"}else{a+="</pre>"}}}};

function smiley(){
	var a = ['mrgreen','razz','sad','smile','oops','grin','eek','???','cool','lol','mad','twisted','roll','wink','idea','arrow','neutral','cry','?','evil','shock','!'];
	var b = ['15/j_thumb','19/heia_thumb','0c/sw_thumb','14/tza_thumb','73/wq_thumb','0b/tootha_thumb','f4/cj_thumb','d9/dizzya_thumb','40/cool_thumb','6a/laugh','7c/angrya_thumb','24/sweata_thumb','e9/sk_thumb','c3/zy_thumb','70/88_thumb','70/vw_thumb','a0/kbsa_thumb','9d/sada_thumb','5c/yw_thumb','6d/yx_thumb','af/cry','c7/no_thumb'];
	var c = ['囧','偷笑','难过','微笑','委屈','露齿笑','吃惊','晕','酷','仰天大笑','怒','汗','思考','眨眼','再见','威武','淡定','流泪','疑惑','邪恶','雷翻了','No'];
	var smileyhtml='';
	for(i=0;i<22;i++){
		smileyhtml+= '<a title="'+c[i]+'" href="javascript:grin(\':'+a[i]+':\')"><img src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/'+b[i]+'.gif"></a>';
	}
	$('#wp-smiley-wrapper').html(smileyhtml);
	$('#wp-smiley-wrapper').slideToggle(300);
}
</script>
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