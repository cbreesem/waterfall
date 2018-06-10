jQuery(document).ready(function() {   
    //查找class为ashu_bottom的对象   
    jQuery("input.ashu_bottom").click(function() {   
        // 获取它前面的一个兄弟元素   
        targetfield = jQuery(this).prev("input");
         tb_show('', "media-upload.php?type=image&amp;TB_iframe=true");   
         return false;   
    });   
    window.send_to_editor = function(html) {   
         imgurl = jQuery("img",html).attr("src");   
         jQuery(targetfield).val(imgurl);   
         tb_remove();   
    }   
});