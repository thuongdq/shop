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
//        dd(json_decode('[{"name":"Sự kiện23333","id":3},{"name":"Xã hội 44444","id":4,"children":[{"name":"Chính trị","id":5},{"name":"Phóng sự-Ký sựrrrr","id":6},{"name":"Giao thông 2222","id":7},{"name":"Môi trường","id":8},{"name":"Hồ sơ","id":9}]},{"name":"Thế giới eerrrr","id":10,"children":[{"name":"Châu Á222444","id":11},{"name":"EU & Nga","id":12},{"name":"Châu Mỹ","id":13},{"name":"Điểm nóng","id":14},{"name":"Kiều bào","id":15},{"name":"Tư liệu","id":16}]},{"name":"Sức mạng số","id":17,"children":[{"name":"Máy tính - Mạng","id":18},{"name":"Di động - Viễn thông 77","id":19},{"name":"Điện tử tiêu dùng","id":20},{"name":"Nghe nhìn","id":21},{"name":"Phần mềm - Bảo mật","id":22},{"name":"Thủ thuật - Mẹo vặt","id":23},{"name":"Thị trường công nghệ","id":24}]},{"name":"Sức khoẻ","id":25,"children":[{"name":"Kiến thức giới tính","id":26},{"name":"Tư vấn","id":27},{"name":"Làm đẹp","id":28}]},{"name":"Thể thao","id":29,"children":[{"name":"Thể thao trong nước","id":30},{"name":"Thể thao quốc tế","id":31},{"name":"Bóng đá trong nước","id":32},{"name":"Châu Âu","id":33},{"name":"Bóng đá Anh","id":34},{"name":"Bóng đá TBN","id":35},{"name":"Tennis","id":36},{"name":"Cờ vua","id":37}]},{"name":"Giáo dục","id":38,"children":[{"name":"Tin tuyển sinh","id":39},{"name":"Khuyến học","id":40},{"name":"Gương sáng","id":41},{"name":"IELTS cùng Scots","id":42},{"name":"Du học www","id":43}]},{"name":"Kinh doanh","id":44,"children":[{"name":"Tài chính - Đầu tư","id":45},{"name":"Thị trường","id":46},{"name":"Doanh nghiệp","id":47},{"name":"Khởi nghiệp","id":48},{"name":"Bảo vệ NTD","id":49},{"name":"Quốc tế","id":50},{"name":"Nhà đất","id":51}]},{"name":"Văn hoá","id":52,"children":[{"name":"Đời sống văn hóa","id":53},{"name":"Sân khấu - Dân gian","id":54},{"name":"Du lịch - Khám phá","id":55},{"name":"Văn học","id":56},{"name":"Điện ảnh","id":57},{"name":"Âm nhạc 1231","id":58}]},{"name":"Nhịp sống trẻ","id":59,"children":[{"name":"Người Việt trẻ","id":60},{"name":"Phóng sự trẻ","id":61}]},{"name":"Xe++","id":62,"children":[{"name":"Thị trường xe","id":63},{"name":"Văn hoá xe","id":64},{"name":"Tư vấn xe","id":65},{"name":"Đua xe","id":66},{"name":"Giá xe","id":67}]},{"name":"Tình yêu","id":68,"children":[{"name":"Gia đình","id":69},{"name":"Góc tâm hồn","id":70},{"name":"Tình yêu","id":71}]},{"name":"Du lịch","id":72},{"name":"Pháp luật","id":73},{"name":"Chuyện lạ","id":74},{"name":"Giải trí","id":75,"children":[{"name":"Sao Việt","id":76},{"name":"Hollywood","id":77},{"name":"Châu Á","id":78},{"name":"Thời trang","id":79},{"name":"Xem - Ăn - Chơi","id":80}]}]'));

//        $data['categories'] = make_categories(Category::all());
//        $data_nestabe = $this->get_demo(2, $data['categories'], $result = []);
//        dd(json_encode($data_nestabe));
//        $category = Category::find(2);
//        $disable = get_all_child($category, make_categories(Category::all()));
//        dd($disable);
        parent::__construct();
    }



    function get_demo($root, $data, $result = []){
        foreach ($data[$root] as $key=>$value){
            $new = [];
            $new['id'] = $value['id'];
            $new['name'] = $value['name'];

            if(isset($data[$value['id']])){
                $new['children'] = $this->get_demo($value->id, $data);
            }
            $result[] = $new;
        }
        return $result;
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
        
        $data['data'] = [];
        $data['data']['id'] = $id;
        $data['data']['parent'] =  $data['category']->parent;
        $data['data']['name'] =  $data['category']->name;
        $data['data']['description'] =  $data['category']->description;
        $data['data']['order'] =  $data['category']->order;
        $data['data']['seo_title'] =  $data['category']->seo_title;
        $data['data']['slug'] =  $data['category']->slug;
        $data['data']['meta_description'] =  $data['category']->meta_description;
        $data['data']['keyword'] =  $data['category']->keyword;
        
        if($data['category'] !== null){
            return view('backend.categories.show-item', $data);
        }
        return redirect()->route('admin.category.index')->with('error', 'Không tìm thấy chuyên mục với id:'.$id);
    }

    public function update_item(Request $request, $root, $id){
//        dd($request->all());
        $data['root_category'] = Category::find($root);
        $data['category'] = Category::find($id);
        $data['root'] = $root;
        
        $data['data'] = [];
        $data['data']['parent'] =  $request->input('parent');
        $data['data']['name'] =  $request->input('name');
        $data['data']['description'] =  $request->input('description');
        $data['data']['order'] =  $request->input('order');
        $data['data']['seo_title'] =  $request->input('seo_title');
        $data['data']['slug'] =  $request->input('slug');
        $data['data']['meta_description'] =  $request->input('meta_description');
        $data['data']['keyword'] =  $request->input('keyword');

        $valid = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:tdq68_categories,slug,'.$id,
            'parent' => 'required'
        ], [
            'name.required' => 'Vui lòng nhập Tên chuyên mục',
            'slug.required' => 'Vui lòng nhập slug chuyên mục',
            'slug.unique' => 'Slug đã trùng, Vui lòng chọn slug khác',
            'parent.required' => 'Vui lòng nhập Parent ID',
            'parent.exists' => 'Parent ID không hợp lệ'
        ]);
        $valid->sometimes('parent', 'exists:tdq68_categories,id', function($input){
            return $input->parent !== '0';
        });
        if($valid->fails()){
            return view('backend.categories.show-item', $data)->withErrors($valid);
//            return redirect()->back()->withErrors($valid)->withInput();
        }else{
            $category = Category::find($id);
            if($category !== null) {
                Category::update_data($category, $data['data']);
                $data['report'] = "Cập nhật danh mục <b>$category->name</b> thành công";
                $data['category'] = $category;
                $data['categories_all'] = make_categories(Category::all());
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
