<?php
use App\ThuongDQ\Facades\Tool;
if(!function_exists('get_thumbnail')){
    function get_thumbnail($filename, $suffix = '_thumb'){
        return Tool::getThumbnail($filename, $suffix);
    }

    function media_get_image_src($filename, $suffix = '_thumb'){
        return Tool::mediaGetImageSrc($filename, $suffix);
    }

    function media_image_view($filename, $suffix,$post_title='', $post_content='', $class='img-responsive', $attribute='', $lazyload=false){
        return Tool::mediaImageView($filename, $suffix,$post_title, $post_content,$class, $attribute, $lazyload);
    }

    function get_currency($number, $region = 'en', $symbol='$', $isPrefix = true){
        return Tool::getCurrency($number, $region, $symbol, $isPrefix);
    }

    function make_categories($categories, $not_cate  = 1){
        return Tool::makeCategories($categories, $not_cate );
    }

    function view_select_list($selected, $parent, $list, $result="", $prefix="&nbsp;&nbsp;"){
        return Tool::viewSelectList($selected, $parent, $list, $result, $prefix);
    }

    function view_nestable($root, $current, $list, $result = ''){
        return Tool::viewNestable($root, $current, $list);
    }

    function get_data_jstree($selected, $root, $list, $result = []){
        return Tool::getDataJstree($selected, $root, $list, $result);
    }
}