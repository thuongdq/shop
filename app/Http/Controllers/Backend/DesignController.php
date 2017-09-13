<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Category;
use App\Product;
use App\Tag;
use App\ThuongDQ\Facades\Tool;
use Illuminate\Http\Request;

class DesignController extends BackendController
{
    public function listCategory(){
        $categories = Category::all();
        echo '[';
        $i = 0;
        foreach ($categories as $category){
            echo '"'.$category->name.'"';
            $i++;
            if($i != count($categories)){
                echo ',';
            }
        }
        echo ']';
    }

    public function listTags(){
        $tags = Tag::all();
        echo '[';
        $i = 0;
        foreach ($tags as $tag){
            echo '"'.$tag->name.'"';
            $i++;
            if($i != count($tags)){
                echo ',';
            }
        }
        echo ']';
    }

    public function listProduct(Request $request){

        $iTotalRecords = Product::count();
        $iDisplayLength = intval($request->input('length'));
        $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
        $iDisplayStart = intval($request->input('start'));
        $sEcho = intval($request->input('draw'));

        $records = array();
        $records["data"] = array();

        $end = $iDisplayStart + $iDisplayLength;
        $end = $end > $iTotalRecords ? $iTotalRecords : $end;

        $status_list = array(
            0 => array("default" => "Đã xoá"),
            1 => array("success" => "Hiển thị"),
            2 => array("warning" => "Chờ duyệt")
        );
        $order = $request->input('order');
//        $order[0]['dir']
        $sort = 'id';
        switch ($order[0]['column']){
            case "1":
                $sort = 'code';
                break;
            case "2":
                $sort = 'name';
                break;
            case "3":
//                $sort = 'category';
                $sort = 'name';
                break;
            case "4":
                $sort = 'sale_price';
                break;
            case "5":
                $sort = 'quantity';
                break;
            case "6":
                $sort = 'created_at';
                break;
            case "7":
                $sort = 'status';
                break;
            default:
                $sort = 'id';
                break;
        }
//        dd($order);
        $list_product = Product::orderBy('featured', 'desc')->orderBy($sort, $order[0]['dir'])->offset($iDisplayStart)->limit($iDisplayLength)->get();
        foreach ($list_product as $product){
            $status = $status_list[$product->status];
            $publish_class = $product->featured ? 'success' : 'default';
            $records["data"][] = array(
                '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="'.$product->id.'"/><span></span></label>',
                '<a href="'.route('admin.product.show', ['id'=>$product->id]).'"><b>'.$product->code.'</b></a>',
                '<a href="'.route('admin.product.show', ['id'=>$product->id]).'"><b>'.$product->name.'</b></a>',
                '<a href="'.route('admin.category.show', ['id'=>$product->category->id]).'">'.$product->category->name.'</a>',
                get_currency($product->sale_price, 'vn', 'Đ', false),
                $product->quantity,
                $product->created_at->format('d/m/Y'),
                '<span class="label label-sm label-'.(key($status)).'">'.(current($status)).'</span>',
                '
                <a href="'.route('admin.product.setFeaturedProduct', ['id'=>$product->id]).'" class="btn btn-circle btn-icon-only btn-'.$publish_class.'  "
                   onclick="event.preventDefault();
                           document.getElementById(\'product-feature-'.$product->id.'\').submit();">
                    <i class="icon-pin"></i>
                 </a>
                 <a class="btn btn-circle btn-icon-only btn-default" href="'.route('admin.product.show', ['id'=>$product->id]).'">
                    <i class="icon-pencil"></i>
                </a>
                 <a class="btn btn-circle btn-icon-only btn-default" href="'.route('admin.product.delete', ['id'=>$product->id]).'" title="Delete" onclick="event.preventDefault(); window.confirm(\'Bạn đã chắc chắn muốn xoá chưa ?\') ? document.getElementById(\'product-delete-'.$product->id.'\').submit() : 0;">
                    <i class="icon-trash"></i>
                 </a>
                 <form action="'.route('admin.product.delete', ['id' => $product->id]).'" method="post" id="product-delete-'.$product->id.'">
                    '.csrf_field().method_field('delete').'
                 </form>
                 <form action="'.route('admin.product.setFeaturedProduct', ['id' => $product->id]).'" method="post" id="product-feature-'.$product->id.'">
                    '.csrf_field().method_field('patch').'
                 </form>
                ',
            );
        }
        if ($request->input('customActionType') && $request->input('customActionType') == "group_action") {
            $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
            $records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
        }

        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalRecords;

        echo json_encode($records);
    }

    public function getSlug(Request $request){
        echo str_slug($request->input('name').'-'.$request->input('code'));
    }
}
