<?php
namespace App\ThuongDQ;

class ToolFactory{
    public function getThumbnail($fileName, $suffix = ''){
        if($fileName){
            return preg_replace("/(.*)\.(.*)/i", "$1{$suffix}.$2", $fileName);
        }
        return '';
    }

    public function mediaGetImageSrc($fileName, $suffix){
        $default = 'frontend/default/assets/images/blank.gif';
        $folder = "/uploads";
        $src = '';
        if( strpos( $fileName, 'http://' ) !== false ) {
            $src = $fileName;
        }else if(!empty($fileName) && file_exists(public_path($thumbnail = $this->getThumbnail("$folder/$fileName",$suffix)))){
            $src = asset($thumbnail);
        }else if(!empty($fileName) && file_exists(public_path($original = $this->getThumbnail("$folder/$fileName",'')))){
            $src = $original;
        }else{
            $src = asset($default);
        }
        return $src;
    }

    public function mediaImageView( $fileName,$suffix,$post_title = "", $post_content ="", $class ="img-responsive", $attribute = "", $lazyload = false){
        $default = 'frontend/default/assets/images/blank.gif';
        $image_src = $this->mediaGetImageSrc($fileName, $suffix);
        if($lazyload){
            return '<img src="'.asset($default).'" data-echo="'.$image_src.'" class="'.$class.'" '.$attribute.' alt="'.$post_title.'"/>';
        }else{
            return '<img src="'.$image_src.'" class="'.$class.'" '.$attribute.' alt="'.$post_title.'">';
        }
    }

    public function getCurrency($number, $region, $symbol, $isPrefix){
        $currency = $number;
        switch ($region){
            case 'vn':
                $currency =  number_format($number, 0, ',', '.');
                break;
            case 'en':
                $currency =  number_format($number, 0, '.', ',');
                break;
            default:
                $currency =  number_format($number, 0, ',', '.');
                break;
        }
        if($isPrefix){
            $currency = $symbol . $currency;
        }else{
            $currency = $currency . $symbol;
        }
        return $currency;
    }

    public function makeCategories($categories, $not_cate){
        $newArr = [];
        if (count($categories) > 0){
            foreach ($categories as $category){
                if($category->id != $not_cate){
                    $newArr[$category->parent][] = $category;
                }
            }
        }
        return $newArr;
    }

    //<div class="dd" id="nestable_list_id">
    public function viewNestable($root,$current, $list, $result = ''){
        $result .= '<ol class="dd-list">';
        foreach ($list[$current] as $key=>$item){
            if($root == 2){
                $count = $item->news()->count();
            }else{
                $count = $item->products()->count();
            }
            $result .=  '<li class="dd-item" data-id="'.$item->id.'">';
            $result .=  '<div class="dd-handle"> 
                            '.$item->name.'
                        </div>
                        <div class="group-action">
                            <a class="btn btn-circle btn-icon-only btn-default btn-action btn grey-cascade" href="#">
                                '.$count.'
                            </a>
                            <a class="btn btn-circle btn-icon-only btn-default btn-action ajax-create" data-url="'.route('admin.category.show-item', ['root' => $root, 'id' => $item->id] ).'" data-toggle="modal">
                                <i class="icon-cloud-upload"></i>
                            </a>
                            <a class="btn btn-circle btn-icon-only btn-default btn-action ajax-update" data-url="/backend/demo/ui_extended_modals_ajax_sample.html" data-toggle="modal">
                                <i class="icon-wrench"></i>
                            </a>
                            <a class="btn btn-circle btn-icon-only btn-default btn-action" href="'.route('admin.category.delete', ['id'=>$item->id]).'"
                            onclick="event.preventDefault(); window.confirm(\'Bạn đã chắc chắn muốn xoá danh mục '.$item->name.' chưa ?\') ? document.getElementById(\'category-delete-'. $item->id.'\').submit() : 0;"
                            >
                                <i class="icon-trash"></i>
                            </a>
                            <form action="'.route('admin.category.delete', ['id' => $item->id]).'"
                                  method="post"
                                  id="category-delete-'.$item->id.'">
                                '.csrf_field().method_field('delete').'
                            </form>
                        </div>';
            if(isset($list[$item->id])){
                $result = $this->viewNestable($root, $item->id, $list, $result);
            }
            $result .= '</li>';
        }
        $result .= '</ol>';
        return $result;
    }
    //</div>


    public function viewSelectList($selected, $parent, $list, $result, $prefix){
        foreach ($list[$parent->id] as $key => $item){
            if($selected == $item->id){
                $select = 'selected';
            }else{
                $select = '';
            }
            $result .= '<option value="'.$item->id.'" '.$select.'>'.$prefix.$item->name.'</option>';
            if(isset($list[$item->id])){
                $result = $this->viewSelectList($selected, $item, $list, $result, $prefix.$prefix.$prefix);
            }
        }
        return $result;
    }

    /*
    $selected - ID of element selected
    $parent - Data of Parent
    $list - List Data of element - array with key is parent id
    */
    public function getDataJstree($selected, $parent, $list, $result){
        if(empty($result)){
            if($selected == $parent->id){
                $select = true;
                $disabled = true;
            }else{
                $select = false;
                $disabled = false;
            }
            $result[] = [
                'id' => $parent->id,
                'parent' => '#',
                'text' => $parent->name,
                'state' => [
                    'opened'    => true ,
                    'disabled'  => $disabled ,
                    'selected'  => $select
                ]
            ];
        }
        foreach ($list[$parent->id] as $key => $item){
            if($selected == $item->id){
                $select = true;
                $disabled = true;
                $opened = true;
            }else{
                $select = false;
                $disabled = false;
                $opened = false;
            }

            if(isset($list[$item->id])){
                $type = 'default';
            }else{
                $type = 'file';
            }

            $result[] = [
                'id' => $item->id,
                'parent' => $item->parent,
                'text' => $item->name,
                'type' => $type,
                'state' => [
                    'opened'    => $opened ,
                    'disabled'  => $disabled ,
                    'selected'  => $select
                ]
            ];

            if(isset($list[$item->id])){
                $result = $this->getDataJstree($selected, $item, $list, $result);
            }
        }
        return $result;
    }
}

