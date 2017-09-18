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

    function get_all_child($current, $list, $result = []){
        return Tool::getAllChild($current, $list, $result);
    }


    function view_select_list($current, $parent, $disabled = [], $list, $prefix="", $order='asc', $result=""){
        return Tool::viewSelectList($current, $parent, $disabled, $list, $prefix, $order, $result);
    }

    function get_data_nestable($root, $current, $list, $order = 'asc', $result = []){
        return json_encode(Tool::getDataNestable($root, $current, $list, $order, $result));
    }

    function view_nestable($root, $current, $list, $result = ''){
        return Tool::viewNestable($root, $current, $list, $order = 'asc');
    }

    function get_data_jstree($selected, $root, $list, $result = []){
        return Tool::getDataJstree($selected, $root, $list, $result);
    }
}