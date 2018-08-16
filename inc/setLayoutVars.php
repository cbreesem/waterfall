<?php
$template = get_option('wf_layout_type');
$template_type = str_replace('_', '-', $template);
$forse_fixed_height = $template == "page_masonry_condensed_fixed_height" || get_option('wf_use_fixed_height_index_posts') == true ? true : false;
$layout_mode = $template == "page_masonry_condensed_fixed_height" || get_option('wf_use_fixed_height_index_posts') == true ? 'fitRows' : 'masonry';
$template_part = $template == "page_masonry" ? 'content' : 'v3-content';

if(in_array($template, array('page_masonry_simple_facebook', 'page_masonry_simple'))){
    $layout_type = 'v3-simple';
    $isotope_class = 'v3 isotope-simple';
    $forse_hide_element_read_more = true;
    $forse_hide_element_date = true;
}elseif(in_array($template, array('page_masonry', 'page_masonry_simple'))){
    $layout_type = 'v1';
    $isotope_class = 'v1';
}else{
    $layout_type = 'v3';
    $isotope_class = 'v3 isotope-condensed';
}
if($template == 'page_masonry_condensed_with_author'){
    $show_author_face = true;
    $isotope_class.= ' isotope-with-author';
}else{
    $show_author_face = false;
}