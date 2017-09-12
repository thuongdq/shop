<?php

namespace App\Http\Controllers\Frontend;

use App\Category;
use App\Comment;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class FrontendController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $_data;
    public function __construct()
    {
//        View::share('categories', make_categories(Category::all()));
        $this->_data['categories'] = make_categories(Category::all());
//        $list_parent_arr = [];
//        $list_parent_obj = \App\Category::where([
//            ['id', '<>', 1],
//            ['id', '<>', 2],
//            ['parent', '=', 0]
//        ])->get();
//        foreach ($list_parent_obj as $parent){
//            $list_parent_arr[] = $parent->id;
//            $child = \App\Category::where('parent',$parent->id)->get();
//            foreach ($child as $child_parent){
//                $has_child = \App\Category::where('parent',$child_parent->id)->get()->toArray();
//                if(!empty($has_child)){
//                    $list_parent_arr[] = $child_parent->id;
//                }
//            }
//        }
//        dd($list_parent_arr);
    }
    //    public $list_parent = [];
    //    public function getCategory(){
    //        $category = rand(3, 80);
    //        if(in_array($category, $this->list_parent)){
    //            return $this->getCategory();
    //        }else{
    //            return $category;
    //        }
    //    }
}