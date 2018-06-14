<?php

/*
*  后台管理菜单及页面函数
*/  
add_action('admin_menu', 'registerCustomMenu');
function registerCustomMenu() {
    add_menu_page('WaterFall主题设置', '主题设置', 'administrator', 'waterfall', 'waterfall','',100);
    // seo设置、备案号设置
    add_submenu_page('waterfall', '基础设置', '基础设置', 'administrator','sysSetup', 'sysSetup');
    //菜单方向：左、上、右  上--菜单风格：一行、两行 导航、页脚设置、导航设置、
    add_submenu_page('waterfall', '页面设置', '页面设置', 'administrator','pageSetup', 'pageSetup');
}
function waterfall(){
    if(!empty($_POST)){
        foreach ($_POST as $key => $value) {
            if($key != 'submit') update_option( $key, $value );
        }
        $update = '<div id="message" class="updated"><p>修改保存成功</p></div>';
    }else{
        $update = '<div id="message" class="updated"><p>本主题是一个基于瀑布流的自适应的主题，可应用于各种形式的网站，并且对搜索引擎友好。</p></div>';
    }
    //加载upload.js文件   
    wp_enqueue_script('waterfall', get_bloginfo( 'stylesheet_directory' ) . '/js/uppic.js');   
    //加载上传图片的js(wp自带)   
    wp_enqueue_script('thickbox');   
    //加载css(wp自带)   
    wp_enqueue_style('thickbox');  
    echo '<div class="wrap">
        <h1>主题设置</h1>
        '.$update.'
        <h2 class="title">SEO设置</h2>
        <p>设置网站关键字及备注有利于搜索引擎的收录</p>
        <form method="post" action="">
            <table class="form-table">
                <tbody>
                    <tr>
                        <th><label for="default_category">網站圖標</label></th>
                        <td><input type="text" name="wf_logo_image" id="wf_logo_image"  class="regular-text code" value="'.get_option('wf_logo_image').'"/>   
                        <input type="button" value="上传" class="ashu_bottom"/></td>
                    </tr>
                    <tr>
                        <th><label for="default_category">網站名稱</label></th>
                        <td><input type="text" name="wf_logo_text" class="regular-text code" value="'.get_option('wf_logo_text').'"/>   
                    </tr>
                    <tr>
                        <th scope="row"><label for="default_category">关键字</label></th>
                        <td><input type="text" name="wf_keywords" class="regular-text code" value="'.get_option('wf_keywords').'"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="default_post_format">网站备注</label></th>
                        <td><input type="text" name="wf_description" class="regular-text code" value="'.get_option('wf_description').'"></td></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="default_post_format">工信部备案号</label></th>
                        <td><input type="text" name="wf_beian" class="regular-text code" value="'.get_option('wf_beian').'"></td></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="default_post_format">公安部备案号</label></th>
                        <td><input type="text" name="wf_gonganbeian" class="regular-text code" value="'.get_option('wf_gonganbeian').'"></td></td>
                    </tr>
                </tbody>
            </table>
        <h2 class="title">设置统计代码</h2>
        <p>把统计网站的代码贴在下输入框，可记录网站访问记录</p>
        <textarea name="wf_statistics" id="ping_sites" class="large-text code" rows="3">'.get_option('wf_statistics').'</textarea>

        <h2 class="title">百度自动推送</h2>
        <p>把百度自动推送的代码贴在下输入框，在游客访问时可自动将页面递交给百度收录</p>
        <textarea name="wf_baidu_push" id="ping_sites" class="large-text code" rows="3">'.get_option('wf_baidu_push').'</textarea>
        <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="保存更改"></p>
        </form>
    </div>';
    
}
function sysSetup(){
    if(!empty($_POST)){
        foreach ($_POST as $key => $value) {
            if($key != 'submit') update_option($key, $value);
        }
        $update = '<div id="message" class="updated"><p>修改保存成功</p></div>';
    }
    $wf_menu_position = get_option('wf_menu_position');
    switch ($wf_menu_position) {
        case 'left':
            $wf_menu_position = '<option value="left" selected="selected">左</option><option value="right">右</option><option value="top">上</option>';
            break;
        case 'right':
            $wf_menu_position = '<option value="left">左</option><option value="right" selected="selected">右</option><option value="top">上</option>';
            break;
        case 'top':
            $wf_menu_position = '<option value="left">左</option><option value="right">右</option><option value="top" selected="selected">上</option>';
            break;
        default:
            $wf_menu_position = '<option value="left" selected="selected">左</option><option value="right">右</option><option value="top">上</option>';
            break;
    }
    $wf_search_position = get_option('wf_search_position');
    switch ($wf_search_position) {
        case 'above_menu':
            $wf_search_position = '<option value="above_menu" selected="selected">菜單上面</option>
            <option value="under_menu">菜單下面</option>
            <option value="above_social">社會圖標上面</option>
            <option value="under_social">社會圖標下面</option>
            <option value="no_show">不顯示搜索框</option>';
            break;
        case 'under_menu':
            $wf_search_position = '<option value="above_menu">菜單上面</option>
            <option value="under_menu" selected="selected">菜單下面</option>
            <option value="above_social">社會圖標上面</option>
            <option value="under_social">社會圖標下面</option>
            <option value="no_show">不顯示搜索框</option>';
            break;
        case 'above_social':
            $wf_search_position = '<option value="above_menu">菜單上面</option>
            <option value="under_menu">菜單下面</option>
            <option value="above_social" selected="selected">社會圖標上面</option>
            <option value="under_social">社會圖標下面</option>
            <option value="no_show">不顯示搜索框</option>';
            break;
        case 'under_social':
            $wf_search_position = '<option value="above_menu">菜單上面</option>
            <option value="under_menu">菜單下面</option>
            <option value="above_social">社會圖標上面</option>
            <option value="under_social" selected="selected">社會圖標下面</option>
            <option value="no_show">不顯示搜索框</option>';
            break;
        case 'no_show':
            $wf_search_position = '<option value="above_menu">菜單上面</option>
            <option value="under_menu">菜單下面</option>
            <option value="above_social">社會圖標上面</option>
            <option value="under_social">社會圖標下面</option>
            <option value="no_show" selected="selected">不顯示搜索框</option>';
            break;
        default:
            $wf_search_position = '<option value="above_menu" selected="selected">菜單上面</option>
            <option value="under_menu">菜單下面</option>
            <option value="above_social">社會圖標上面</option>
            <option value="under_social">社會圖標下面</option>
            <option value="no_show">不顯示搜索框</option>';
            break;
    }
    $wf_sidebar_position = get_option('wf_sidebar_position');
    switch ($wf_sidebar_position) {
        case 'left':
            $wf_sidebar_position = '<option value="left" selected="selected">左</option>
            <option value="right">右</option>
            <option value="none">不显示</option>';
            break;
        case 'right':
            $wf_sidebar_position = '<option value="left">左</option>
            <option value="right" selected="selected">右</option>
            <option value="none">不显示</option>';
            break;
        case 'none':
            $wf_sidebar_position = '<option value="left">左</option>
            <option value="right">右</option>
            <option value="none" selected="selected">不显示</option>';
            break;
        default:
            $wf_sidebar_position = '<option value="left">左</option>
            <option value="right" selected="selected">右</option>
            <option value="none">不显示</option>';
            break;
    }
    $wf_show_sidebar_on_mobile = get_option('wf_show_sidebar_on_mobile');
    switch ($wf_show_sidebar_on_mobile) {
        case '1':
            $wf_show_sidebar_on_mobile = '<option value="1" selected="selected">顯示</option>
            <option value="0">不显示</option>';
            break;
        case '0':
            $wf_show_sidebar_on_mobile = '<option value="1">顯示</option>
            <option value="0" selected="selected">不显示</option>';
            break;
        default:
            $wf_show_sidebar_on_mobile = '<option value="1" selected="selected">顯示</option>
            <option value="0">不显示</option>';
            break;
    }
    $wf_navigation_type = get_option('wf_navigation_type');
    switch ($wf_navigation_type) {
        case 'infinite':
            $wf_navigation_type = '<option value="infinite" selected="selected">无限滚动</option>
            <option value="infinite_button">无限滚动与按钮</option>
            <option value="classic">分页链接</option>
            <option value="default">默认链接</option>';
            break;
        case 'infinite_button':
            $wf_navigation_type = '<option value="infinite">无限滚动</option>
            <option value="infinite_button" selected="selected">无限滚动与按钮</option>
            <option value="classic">分页链接</option>
            <option value="default">默认链接</option>';
            break;
        case 'classic':
            $wf_navigation_type = '<option value="infinite">无限滚动</option>
            <option value="infinite_button">无限滚动与按钮</option>
            <option value="classic" selected="selected">分页链接</option>
            <option value="default">默认链接</option>';
            break;
        case 'default':
            $wf_navigation_type = '<option value="infinite">无限滚动</option>
            <option value="infinite_button">无限滚动与按钮</option>
            <option value="classic">分页链接</option>
            <option value="default" selected="selected">默认链接</option>';
            break;
        default:
            $wf_navigation_type = '<option value="infinite" selected="selected">无限滚动</option>
            <option value="infinite_button">无限滚动与按钮</option>
            <option value="classic">分页链接</option>
            <option value="default">默认链接</option>';
            break;
    }
    $wf_show_sidebar_on_index = get_option('wf_show_sidebar_on_index');
    switch ($wf_show_sidebar_on_index) {
        case '1':
            $wf_show_sidebar_on_index = '<option value="1" selected="selected">顯示</option>
            <option value="0">不显示</option>';
            break;
        case '0':
            $wf_show_sidebar_on_index = '<option value="1">顯示</option>
            <option value="0" selected="selected">不显示</option>';
            break;
        default:
            $wf_show_sidebar_on_index = '<option value="1">顯示</option>
            <option value="0" selected="selected">不显示</option>';
            break;
    }
    echo '<div class="wrap">
        <h1>基础设置</h1>
        '.$update.'
        <h2 class="title">导航设置</h2>
        <p>菜单位置及侧栏位置开关</p>
        <form method="post" action="">
            <table class="form-table">
                <tbody>
                    <tr>
                        <th scope="row"><label for="default_category">菜单位置</label></th>
                        <td><select class="select" name="wf_menu_position">
                            '.$wf_menu_position.'
                        </select></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="default_category">搜索框位置</label></th>
                        <td><select class="select" name="wf_search_position">
                            '.$wf_search_position.'
                        </select></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="default_post_format">侧栏位置</label></th>
                        <td><select class="select" name="wf_sidebar_position">
                            '.$wf_sidebar_position.'
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="default_post_format">移動設備是否顯示側欄</label></th>
                        <td><select class="select" name="wf_show_sidebar_on_mobile">
                            '.$wf_show_sidebar_on_mobile.'
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="default_post_format">在首页是否显示侧栏</label></th>
                        <td><select class="select" name="wf_show_sidebar_on_index">
                            '.$wf_show_sidebar_on_index.'
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="default_post_format">分页形式</label></th>
                        <td><select id="acf-field-sidebar_position" class="select" name="wf_navigation_type">
                            '.$wf_navigation_type.'
                        </select></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="default_post_format">菜單打開方式</label></th>
                        <td><select id="acf-field-sidebar_position" class="select" name="wf_menu_open_style">
                            <option value="click">點擊</option>
                            <option value="hover" selected="selected">滑過</option>
                        </select></td>
                    </tr>
                </tbody>
            </table>
        <h2 class="title">页脚说明</h2>
        <textarea name="wf_footer" id="ping_sites" class="large-text code" rows="3">'.get_option('wf_footer').'</textarea>
        <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="保存更改"></p>
        </form>
    </div>';
}
function pageSetup(){
    if(!empty($_POST)){
        foreach ($_POST as $key => $value) {
            if($key == 'submit') continue;
            $value = is_array($value) ? serialize($value) : $value;
            update_option($key, $value);
        }
        if(!in_array('wf_show_element',array_keys($_POST))) update_option('wf_show_element', '');
        $update = '<div id="message" class="updated"><p>修改保存成功</p></div>';
    }
    $wf_show_element = unserialize(get_option('wf_show_element'));
    $is_select = in_array('share',$wf_show_element) ? 'checked="checked"' : '';
    $select = '<input type="checkbox" name="wf_show_element[]" value="share" '.$is_select.'>分享 ';
    $is_select = in_array('category',$wf_show_element) ? 'checked="checked"' : '';
    $select .= '<input type="checkbox" name="wf_show_element[]" value="category" '.$is_select.'>分类 ';
    $is_select = in_array('title',$wf_show_element) ? 'checked="checked"' : '';
    $select .= '<input type="checkbox" name="wf_show_element[]" value="title" '.$is_select.'>标题 ';
    $is_select = in_array('excerpt',$wf_show_element) ? 'checked="checked"' : '';
    $select .= '<input type="checkbox" name="wf_show_element[]" value="excerpt" '.$is_select.'>摘录 ';
    $is_select = in_array('datetime',$wf_show_element) ? 'checked="checked"' : '';
    $select .= '<input type="checkbox" name="wf_show_element[]" value="datetime" '.$is_select.'>发布日期 ';
    $is_select = in_array('count',$wf_show_element) ? 'checked="checked"' : '';
    $select .= '<input type="checkbox" name="wf_show_element[]" value="count" '.$is_select.'>计数器 ';
    $is_select = in_array('author',$wf_show_element) ? 'checked="checked"' : '';
    $select .= '<input type="checkbox" name="wf_show_element[]" value="author" '.$is_select.'>作者 ';
    
    echo '<div class="wrap">
        <h1>页面设置</h1>
        '.$update.'
        <form method="post" action="">
        <h2 class="title">首页设置</h2>
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row"><label for="default_category">页面显示元素</label></th>
                    <td>
                        '.$select.'
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="default_post_format">帖子摘录的长度</label></th>
                    <td><input type="text" name="wf_beian"></td></td>
                </tr>
                <tr>
                    <th scope="row"><label for="default_post_format">是否显示顶部栏目</label></th>
                    <td><input type="radio" name="wf_show_topbar" value="1" checked="checked"/>顯示
                    <input type="radio" name="wf_show_topbar" value="0" checked="0" />不顯示</td>
                </tr>
                <tr>
                    <th scope="row"><label for="default_post_format">是否显示精选内容</label></th>
                    <td><input type="radio" name="wf_show_featured" value="1" />顯示
                    <input type="radio" name="wf_show_featured" value="0" />不顯示</td>
                </tr>
                <tr>
                    <th scope="row"><label for="default_post_format">显示精选方式</label></th>
                    <td><select class="select" name="wf_featured_type">
                        <option value="compact">紧凑的</option>
                        <option value="full" selected="selected">全尺寸</option>
                    </select></td>
                </tr>
            </tbody>
        </table>
        <h2 class="title">列表頁设置</h2>
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row"><label for="default_category">页面显示元素</label></th>
                    <td>分享、分类、标题、摘录、发布日期、计数器、作者<input type="text" name="wf_keyworld" class="regular-text code"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="default_post_format">帖子摘录的长度</label></th>
                    <td><input type="text" name="wf_beian" class="regular-text code"></td></td>
                </tr>
            </tbody>
        </table>
        <h2 class="title">內容頁设置</h2>
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row"><label for="default_category">文章展示寬度</label></th>
                    <td>分享、分类、标题、摘录、发布日期、计数器、作者<input type="text" name="wf_keyworld" class="regular-text code"></td>
                </tr>
                <tr>
                    <th scope="row"><label for="default_post_format">帖子摘录的长度</label></th>
                    <td><input type="text" name="wf_beian" class="regular-text code"></td></td>
                </tr>
            </tbody>
        </table>
        <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="保存更改"></p>
        </form>
    </div>';
}