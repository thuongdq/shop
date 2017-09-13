<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Category;
use function GuzzleHttp\Psr7\parse_request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends BackendController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['categories'] = make_categories(Category::all());
        return view('backend.categories.index', $data);
    }

    public function create(){
        $data['categories'] = Category::where([
            ['parent','=', 0],
            ['id','<>', 1],
        ])->get();
        return view('backend.categories.create', $data);
    }

    public function create_item(){
        $data['categories'] = Category::where([
            ['parent','=', 0],
            ['id','<>', 1],
        ])->get();
        return view('backend.categories.create', $data);
    }

    public function store(Request $request){
        $valid = Validator::make($request->all(), [
            'name' => 'required|unique:tdq68_categories,name',
            'parent' => 'required'
        ], [
            'name.required' => 'Vui lòng nhập Tên chuyên mục',
            'name.unique' => 'Chuyên mục đã trùng, Vui lòng chọn tên khác',
            'parent.required' => 'Vui lòng nhập Parent ID',
            'parent.exists' => 'Parent ID không hợp lệ'
        ]);
        $valid->sometimes('parent', 'exists:tdq68_categories,id', function($input){
            return $input->parent !== '0';
        });
        if($valid->fails()){
            return redirect()->back()->withErrors($valid)->withInput();
        }else{
            $order = 1;
            if($request->input('order')){
                $order = $request->input('order');
            }
            $category = Category::create([
                'name' => $request->input('name'),
                'slug' => str_slug($request->input('name')),
                'parent' => $request->input('parent'),
                'order' => $order
            ]);
            return redirect()->route('admin.category.index')->with('message', 'Thêm chuyên mục '.$category->name.' thành công');
        }
        return 'Store'.$request->input('text');
    }

    public function show($id){
        $data['category'] = Category::find($id);
        if($data['category'] !== null){
            return view('backend.categories.show', $data);
        }
        return redirect()->route('admin.category.index')->with('error', 'Không tìm thấy chuyên mục với id:'.$id);
    }

    public function show_item($root, $id){
        $data['root_category'] = Category::find($root);
        $data['category'] = Category::find($id);
        $data['root'] = $root;
        if($data['category'] !== null){
            return view('backend.categories.show-item', $data);
        }
        return redirect()->route('admin.category.index')->with('error', 'Không tìm thấy chuyên mục với id:'.$id);
    }

    public function update_item(Request $request, $root, $id){

        $data['root_category'] = Category::find($root);
        $data['category'] = Category::find($id);
        $data['root'] = $root;
//        if($data['category'] !== null){
//            return view('backend.categories.show-content-item', $data);
//        }
        $valid = Validator::make($request->all(), [
            'name' => 'required|unique:tdq68_categories,name,'.$id,
            'slug' => 'required|unique:tdq68_categories,slug,'.$id,
            'parent' => 'required'
        ], [
            'name.required' => 'Vui lòng nhập Tên chuyên mục',
            'name.unique' => 'Chuyên mục đã trùng, Vui lòng chọn tên khác',
            'parent.required' => 'Vui lòng nhập Parent ID',
            'parent.exists' => 'Parent ID không hợp lệ'
        ]);
        $valid->sometimes('parent', 'exists:tdq68_categories,id', function($input){
            return $input->parent !== '0';
        });

//        dd($valid);
        if($valid->fails()){
            return view('backend.categories.show-item', $data)->withErrors($valid);
//            return redirect()->back()->withErrors($valid)->withInput();
        }else{

            $category = Category::find($id);
            if($category !== null) {
//                dd($request->all());
//                dd($request->input('name'));
                $category->name = $request->input('name');
                $category->parent = $request->input('parent');
                $category->order = $request->input('order');
                $category->save();
                $data['report'] = "Cập nhật danh mục <b>$category->name</b> thành công";
//                dd($category);
                return view('backend.categories.show-item', $data)->withErrors($valid);
            }
            dd($category);
            return 'fail';
        }
        return 'fail';
//        return redirect()->route('admin.category.index')->with('error', 'Không tìm thấy chuyên mục với id:'.$id);
    }


    public function update(Request $request, $id){
//        dd($request->all());
//        dd(123123);
        $valid = Validator::make($request->all(), [
            'name' => 'required|unique:tdq68_categories,name,'.$id,
            'parent' => 'required'
        ], [
            'name.required' => 'Vui lòng nhập Tên chuyên mục',
            'name.unique' => 'Chuyên mục đã trùng, Vui lòng chọn tên khác',
            'parent.required' => 'Vui lòng nhập Parent ID',
            'parent.exists' => 'Parent ID không hợp lệ'
        ]);
        $valid->sometimes('parent', 'exists:tdq68_categories,id', function($input){
            return $input->parent !== '0';
        });

        if($valid->fails()){
            return redirect()->back()->withErrors($valid)->withInput();
        }else{
            $category = Category::find($id);
            if($category !== null) {
                if ($request->input('order')) {
                    $order = $request->input('order');
                }
                $category->name = $request->input('name');
                $category->parent = $request->input('parent');
                $category->order = $order;
                $category->save();
                return redirect()->route('admin.category.index')->with('message', 'Cập nhật chuyên mục ' . $category->name . ' thành công');
            }
        }
        return redirect()->route('admin.category.index')->with('error', 'Không tìm thấy chuyên mục với id:'.$id);
    }

    public function delete($id){
        $category = Category::find($id);
        if($category !== null){
            $category->delete();
            return redirect()->route('admin.category.index')->with('message', 'Xoá chuyên mục '.$category->name.' thành công');
        }
        return redirect()->route('admin.category.index')->with('error', 'Không tìm thấy chuyên mục với id:'.$id);
    }
}
