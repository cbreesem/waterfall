<?php

// 自定义排序
function orderCustom( $query ) {
    if ((is_home() || is_archive()) && $query->is_main_query()) {
      $query->set( 'meta_key', $_GET['order']);
      $query->set( 'orderby', array('meta_value_num' => 'DESC', 'date' => 'DESC'));
      $query->set( 'order', 'DESC' );
    }
    return $query;
}
add_action('pre_get_posts', 'orderCustom');

// 自定义扩展标签
add_action('init','createLanguage');
add_action('init','createDistrict');
add_action('init','createYear');
add_action('init','createLabel');
add_action('init','createDirectors');
add_action('init','createScriptwriters');
add_action('init','createActors');
function createLanguage(){
    $labels = array(
        'name' => _x( '影片语言筛选', '影片语言' ),
        'singular_name' => _x( 'language', '语言名称' ),
        'search_items' =>  __( '语言搜索' ),
        'all_items' => __( '所有语言' ),
        // 'parent_item' => __( 'Parent color' ),
        // 'parent_item_colon' => __( 'Parent color:' ),
        'edit_item' => __( '修改标签' ),
        'update_item' => __( '更新标签' ),
        'add_new_item' => __( '增加新的语言' ),
        'new_item_name' => __( '新的语言名称' ),
      );
    register_taxonomy('language','post',array(
        'hierarchical' => false,
        'labels' => $labels
    ));
}
function createDistrict(){
    $labels = array(
        'name' => _x( '影片地区筛选', '影片地区' ),
        'singular_name' => _x( 'district', '地区名称' ),
        'search_items' =>  __( '地区搜索' ),
        'all_items' => __( '所有地区' ),
        'edit_item' => __( '修改标签' ),
        'update_item' => __( '更新标签' ),
        'add_new_item' => __( '增加新的地区' ),
        'new_item_name' => __( '新的地区名称' ),
      );
    register_taxonomy('district','post',array(
        'hierarchical' => false,
        'labels' => $labels
    ));
}
function createYear(){
    $labels = array(
        'name' => _x( '影片年代筛选', '影片年代' ),
        'singular_name' => _x( 'year', '年代名称' ),
        'search_items' =>  __( '年代搜索' ),
        'all_items' => __( '所有年代' ),
        'edit_item' => __( '修改标签' ),
        'update_item' => __( '更新标签' ),
        'add_new_item' => __( '增加新的年代' ),
        'new_item_name' => __( '新的年代名称' ),
      );
    register_taxonomy('year','post',array(
        'hierarchical' => false,
        'labels' => $labels
    ));
}
function createLabel(){
    $labels = array(
        'name' => _x( '影片标签筛选', '影片标签' ),
        'singular_name' => _x( 'label', '标签名称' ),
        'search_items' =>  __( '年代搜索' ),
        'all_items' => __( '所有年代' ),
        'edit_item' => __( '修改标签' ),
        'update_item' => __( '更新标签' ),
        'add_new_item' => __( '增加新的年代' ),
        'new_item_name' => __( '新的年代名称' ),
      );
    register_taxonomy('label','post',array(
        'hierarchical' => false,
        'labels' => $labels
    ));
}
function createDirectors(){
    $labels = array(
        'name' => _x( '影片导演筛选', '导演标签' ),
        'singular_name' => _x( 'directors', '导演名称' ),
        'search_items' =>  __( '导演搜索' ),
        'all_items' => __( '所有导演' ),
        'edit_item' => __( '修改标签' ),
        'update_item' => __( '更新标签' ),
        'add_new_item' => __( '增加新的导演' ),
        'new_item_name' => __( '新的导演名称' ),
      );
    register_taxonomy('directors','post',array(
        'hierarchical' => false,
        'labels' => $labels
    ));
}
function createScriptwriters(){
    $labels = array(
        'name' => _x( '影片编剧筛选', '编剧标签' ),
        'singular_name' => _x( 'scriptwriters', '编剧名称' ),
        'search_items' =>  __( '编剧搜索' ),
        'all_items' => __( '所有编剧' ),
        'edit_item' => __( '修改标签' ),
        'update_item' => __( '更新标签' ),
        'add_new_item' => __( '增加新的编剧' ),
        'new_item_name' => __( '新的编剧名称' ),
      );
    register_taxonomy('scriptwriters','post',array(
        'hierarchical' => false,
        'labels' => $labels
    ));
}
function createActors(){
    $labels = array(
        'name' => _x( '影片演员筛选', '演员标签' ),
        'singular_name' => _x( 'actors', '演员名称' ),
        'search_items' =>  __( '演员搜索' ),
        'all_items' => __( '所有演员' ),
        'edit_item' => __( '修改标签' ),
        'update_item' => __( '更新标签' ),
        'add_new_item' => __( '增加新的演员' ),
        'new_item_name' => __( '新的编剧演员' ),
      );
    register_taxonomy('actors','post',array(
        'hierarchical' => false,
        'labels' => $labels
    ));
}

add_action('admin_menu', 'registerCustomMenu');
function registerCustomMenu() {
    add_menu_page('WaterFall主题设置', '主题设置', 'administrator', 'waterfall', 'waterfall','',100);
    // seo设置、备案号设置
    add_submenu_page('waterfall', '基础设置', '基础设置', 'administrator','sysSetup', 'sysSetup');
    //菜单方向：左、上、右  上--菜单风格：一行、两行
    // 导航、页脚设置、导航设置、
    add_submenu_page('waterfall', '页面设置', '页面设置', 'administrator','pageSetup', 'pageSetup');
}
function waterfall(){
    echo '<div class="wrap">
        <h1>主题设置</h1>
        <div id="message" class="updated"><p>本主题是一个基于瀑布流的自适应的主题，可应用于各种形式的网站，并且对搜索引擎友好。</p></div>

        <h2 class="title">SEO设置</h2>
        <p>设置网站关键字及备注有利于搜索引擎的收录</p>
        <form method="post" action="options.php">
            <table class="form-table">
                <tbody>
                    <tr>
                        <th scope="row"><label for="default_category">关键字</label></th>
                        <td><input type="text" name="wf_keyworld" class="regular-text code"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="default_post_format">网站备注</label></th>
                        <td><input type="text" name="wf_description" class="regular-text code"></td></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="default_post_format">工信部备案号</label></th>
                        <td><input type="text" name="wf_beian" class="regular-text code"></td></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="default_post_format">公安部备案号</label></th>
                        <td><input type="text" name="wf_beian" class="regular-text code"></td></td>
                    </tr>
                </tbody>
            </table>
        <h2 class="title">设置统计代码</h2>
        <p>把统计网站的代码贴在下输入框，可记录网站访问记录</p>
        <textarea name="wf_statistics" id="ping_sites" class="large-text code" rows="3"></textarea>

        <h2 class="title">百度自动推送</h2>
        <p>把百度自动推送的代码贴在下输入框，在游客访问时可自动将页面递交给百度收录</p>
        <textarea name="wf_statistics" id="ping_sites" class="large-text code" rows="3"></textarea>
        <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="保存更改"></p>
        </form>
    </div>';
}
function sysSetup(){
    echo '<div class="wrap">
        <h1>基础设置</h1>
        <h2 class="title">导航设置</h2>
        <p>菜单位置及侧栏位置开关</p>
        <form method="post" action="options.php">
            <table class="form-table">
                <tbody>
                    <tr>
                        <th scope="row"><label for="default_category">菜单位置</label></th>
                        <td><select id="acf-field-sidebar_position" class="select" name="wf_menu_position">
                            <option value="left">左</option>
                            <option value="right" selected="selected">右</option>
                            <option value="top">上</option>
                        </select></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="default_post_format">侧栏位置</label></th>
                        <td><select id="acf-field-sidebar_position" class="select" name="wf_sidebar_position">
                            <option value="left">左</option>
                            <option value="right" selected="selected">右</option>
                            <option value="none">不显示</option>
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="default_post_format">在首页是否显示侧栏</label></th>
                        <td><input type="text" name="wf_beian" class="regular-text code"></td></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="default_post_format">小页面是否显示侧栏</label></th>
                        <td><input type="text" name="wf_beian" class="regular-text code"></td></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="default_post_format">是否显示精选内容</label></th>
                        <td><input type="text" name="wf_description" class="regular-text code"></td></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="default_post_format">精选内容风格形式</label></th>
                        <td><input type="text" name="wf_beian" class="regular-text code"></td></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="default_post_format">分页形式</label></th>
                        <td>无限滚动、无限滚动与按钮、分页链接、默认链接<input type="text" name="wf_beian" class="regular-text code"></td></td>
                    </tr>
                </tbody>
            </table>
        
        <h2 class="title">页脚说明</h2>
        <textarea name="wf_footer" id="ping_sites" class="large-text code" rows="3"></textarea>
        <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="保存更改"></p>
        </form>
    </div>';
}
function pageSetup(){
    echo '<div class="wrap">
        <h1>页面设置</h1>
        <h2 class="title">首页设置</h2>
        <form method="post" action="options.php">
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
        <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="保存更改"></p>
        </form>
    </div>';
}
?>