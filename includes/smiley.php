<script type="text/javascript" language="javascript">
/* <![CDATA[ */
    function grin(tag) {
    	var myField;
    	tag = ' ' + tag + ' ';
        if (document.getElementById('comment') && document.getElementById('comment').type == 'textarea') {
    		myField = document.getElementById('comment');
    	} else {
    		return false;
    	}
    	if (document.selection) {
    		myField.focus();
    		sel = document.selection.createRange();
    		sel.text = tag;
    		myField.focus();
    	}
    	else if (myField.selectionStart || myField.selectionStart == '0') {
    		var startPos = myField.selectionStart;
    		var endPos = myField.selectionEnd;
    		var cursorPos = endPos;
    		myField.value = myField.value.substring(0, startPos)
    					  + tag
    					  + myField.value.substring(endPos, myField.value.length);
    		cursorPos += tag.length;
    		myField.focus();
    		myField.selectionStart = cursorPos;
    		myField.selectionEnd = cursorPos;
    	}
    	else {
    		myField.value += tag;
    		myField.focus();
    	}
    }
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
/* ]]> */
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