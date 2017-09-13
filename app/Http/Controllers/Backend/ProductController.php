<?php

namespace App\Http\Controllers\Backend;

use App\Attachment;
use App\Http\Controllers\Controller;
use App\Category;
use App\Product;
use App\Tag;
use App\ThuongDQ\Facades\Tool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class ProductController extends BackendController
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
//        $this->_data['categories'] = Category::all();
        $this->_data['status'] = [
            1 => "Hiển thị",
            2 => "Chờ duyệt",
            0 => "Đã xoá"
        ];

        return view('backend.products.index', $this->_data);
    }

    public function create()
    {
        $this->_data['categories'] = make_categories(Category::orderBy('name', 'asc')->get());
        return view('backend.products.create', $this->_data);
    }

    public function store(Request $request)
    {
//        dd($request->all());
        $valid = Validator::make($request->all(), [
            'name' => 'required',
            'code' => 'required|unique:tdq68_products,code',
            'slug' => 'unique:tdq68_products,slug',
            'content' => 'required',
            'regular_price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
            'original_price' => 'required|numeric|min:0',
            'quantity' => 'required|numeric|min:0',
            'image' => 'image|max:2048',
            'images.*' => 'image|max:2048',
            'category_id' => 'required|exists:tdq68_categories,id'
        ], [
            'name.required' => 'Vui lòng nhập Tên sản phẩm',
            'code.required' => 'Vui lòng nhập Mã sản phẩm',
            'code.unique' => 'Mã sản phẩm đã trùng, Vui lòng chọn Tên khác',
            'slug.unique' => 'Slug sản phẩm đã tồn tại, Vui lòng chọn Tên khác',
            'content.required' => 'Vui lòng nhập Nội dung',
            'regular_price.required' => 'Vui lòng nhập Giá thị trường',
            'regular_price.numeric' => 'Vui lòng nhập Số',
            'regular_price.min' => 'Vui lòng nhập số nhỏ nhất cho phép là :min',
            'sale_price.required' => 'Vui lòng nhập Giá bán',
            'sale_price.numeric' => 'Vui lòng nhập Số',
            'sale_price.min' => 'Vui lòng nhập số nhỏ nhất cho phép là :min',
            'original_price.required' => 'Vui lòng nhập Giá gốc',
            'original_price.numeric' => 'Vui lòng nhập Số',
            'original_price.min' => 'Vui lòng nhập số nhỏ nhất cho phép là :min',
            'quantity.required' => 'Vui lòng nhập Số lượng',
            'quantity.numeric' => 'Vui lòng nhập Số',
            'quantity.min' => 'Vui lòng nhập số nhỏ nhất cho phép là :min',
            'category_id.required' => 'Vui lòng nhập Category ID',
            'category_id.exists' => 'Vui lòng nhập đúng Category',
            'image.image' => 'Không đúng chuẩn hình ảnh cho phép',
            'image.max' => 'Dung lượng vượt quá giới hạn cho phép là :max kilobytes',
            'images.*.image' => 'Không đúng chuẩn hình ảnh cho phép',
            'images.*.max' => 'Dung lượng vượt quá giới hạn cho phép là :max kilobytes'
        ]);

        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        } else {
            $imageName = '';
            // Thêm ảnh đại diện
            if ($request->hasFile('image')) {
                $imageName = $this->saveImage($request->file('image'));
            }

            //Thêm Attributes
            $attributes = '';
            if ($request->has('attributes') && is_array($request->input('attributes')) && count($request->input('attributes'))) {
                $attributes = $request->input('attributes');
                foreach ($attributes as $key => $attribute) {
                    if (!isset($attribute['name'])) {
                        unset($attributes[$key]);
                        continue;
                    }

                    if (!isset($attribute['value'])) {
                        unset($attributes[$key]);
                        continue;
                    }
                }
                $attributes = json_encode($attributes);
            }

//            dd($attributes);
            $code = mb_strtoupper($request->input('code'), 'UTF-8');
            $slug = $request->input('slug');
            if($slug == ""){
                $slug = str_slug($request->input('name')).'-'.$code;
            }
            $product = Product::create([
                'name' => $request->input('name'),
                'code' => $code,
                'slug' => $slug,
                'content' => $request->input('content'),
                'regular_price' => $request->input('regular_price'),
                'sale_price' => $request->input('sale_price'),
                'original_price' => $request->input('original_price'),
                'quantity' => $request->input('quantity'),
                'image' => $imageName,
                'attributes' => $attributes,
                'user_id' => auth()->id(),
                'category_id' => $request->input('category_id')
            ]);

            // Thêm vào thư viện hình ảnh.
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    Attachment::create([
                        'type' => 'image',
                        'mime' => $file->getMimeType(),
                        'path' => $this->saveImage($file),
                        'product_id' => $product->id
                    ]);
                }
            }

            //Thêm Tag
            if ($request->has('tags') && $request->input('tags')) {
                $tags = explode(",", $request->input('tags'));
                $tagID = [];
                foreach ($tags as $tag) {
                    $tag = Tag::firstOrCreate([
                        'slug' => str_slug($tag)
                    ], [
                        'name' => $tag,
                        'slug' => str_slug($tag),
                    ]);
                    $tagID[] = $tag->id;
                }
                $product->tags()->sync($tagID);
            }

            return redirect()->route('admin.product.index')->with('message', 'Thêm sản phẩm ' . $product->name . ' thành công');
        }
        return 'Store' . $request->input('text');
    }


    public function show($id)
    {
        $this->_data['categories'] = make_categories(Category::orderBy('name', 'asc')->get());
        $this->_data['product'] = Product::find($id);
        if ($this->_data['product'] !== null) {
            return view('backend.products.show', $this->_data);
        }
        return redirect()->route('admin.product.index')->with('error', 'Không tìm thấy sản phẩm với id:' . $id);
    }

    public function update(Request $request, $id)
    {
        $valid = Validator::make($request->all(), [
            'name' => 'required',
            'code' => 'required|unique:tdq68_products,code,' . $id,
            'slug' => 'required|unique:tdq68_products,slug,' . $id,
            'content' => 'required',
            'regular_price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
            'original_price' => 'required|numeric|min:0',
            'quantity' => 'required|numeric|min:0',
            'image' => 'image|max:2048',
            'images.*' => 'image|max:2048',
            'category_id' => 'required|exists:tdq68_categories,id'
        ], [
            'name.required' => 'Vui lòng nhập Tên sản phẩm',
            'code.required' => 'Vui lòng nhập Mã sản phẩm',
            'code.unique' => 'Mã sản phẩm đã trùng, Vui lòng chọn Tên khác',
            'slug.required' => 'Vui lòng nhập Slug sản phẩm',
            'slug.unique' => 'Slug sản phẩm đã trùng, Vui lòng chọn Tên khác',
            'content.required' => 'Vui lòng nhập Nội dung',
            'regular_price.required' => 'Vui lòng nhập Giá thị trường',
            'regular_price.numeric' => 'Vui lòng nhập Số',
            'regular_price.min' => 'Vui lòng nhập số nhỏ nhất cho phép là :min',
            'sale_price.required' => 'Vui lòng nhập Giá bán',
            'sale_price.numeric' => 'Vui lòng nhập Số',
            'sale_price.min' => 'Vui lòng nhập số nhỏ nhất cho phép là :min',
            'original_price.required' => 'Vui lòng nhập Giá gốc',
            'original_price.numeric' => 'Vui lòng nhập Số',
            'original_price.min' => 'Vui lòng nhập số nhỏ nhất cho phép là :min',
            'quantity.required' => 'Vui lòng nhập Số lượng',
            'quantity.numeric' => 'Vui lòng nhập Số',
            'quantity.min' => 'Vui lòng nhập số nhỏ nhất cho phép là :min',
            'category_id.required' => 'Vui lòng nhập Category ID',
            'category_id.exists' => 'Vui lòng nhập đúng Category',
            'image.image' => 'Không đúng chuẩn hình ảnh cho phép',
            'image.max' => 'Dung lượng vượt quá giới hạn cho phép là :max kilobytes',
            'images.*.image' => 'Không đúng chuẩn hình ảnh cho phép',
            'images.*.max' => 'Dung lượng vượt quá giới hạn cho phép là :max kilobytes'
        ]);


        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        } else {
            $product = Product::find($id);
            if ($product !== null) {
                $imageName = $product->image;
                if ($request->hasFile('image')) {
                    $this->deleteImage($product->image);
                    $imageName = $this->saveImage($request->file('image'));
                }
                // Cập nhật vào thư viện hình ảnh.
                if ($request->hasFile('images')) {
                    foreach ($product->attachments as $file){
                        $this->deleteImage($file->path);
                        $file->delete();
                    }
                    foreach ($request->file('images') as $file) {
                        Attachment::create([
                            'type' => 'image',
                            'mime' => $file->getMimeType(),
                            'path' => $this->saveImage($file),
                            'product_id' => $product->id
                        ]);
                    }
                }

                //Thêm Attributes
                $attributes = '';
                if ($request->has('attributes') && is_array($request->input('attributes')) && count($request->input('attributes'))) {
                    $attributes = $request->input('attributes');
                    foreach ($attributes as $key => $attribute) {
                        if (!isset($attribute['name'])) {
                            unset($attributes[$key]);
                            continue;
                        }

                        if (!isset($attribute['value'])) {
                            unset($attributes[$key]);
                            continue;
                        }
                    }
                    $attributes = json_encode($attributes);
                }

                $product->name = $request->input('name');
                $product->code = mb_strtoupper($request->input('code'), 'UTF-8');
                $product->slug = $request->input('slug');
                $product->content = $request->input('content');
                $product->regular_price = $request->input('regular_price');
                $product->sale_price = $request->input('sale_price');
                $product->original_price = $request->input('original_price');
                $product->quantity = $request->input('quantity');
                $product->image = $imageName;
                $product->attributes = $attributes;
                $product->user_id = auth()->id();
                $product->category_id = $request->input('category_id');

                $product->save();

                //Thêm Tag
                if ($request->has('tags') && $request->input('tags')) {
                    $tags = explode(",", $request->input('tags'));
                    $tagID = [];

                    foreach ($tags as $tag) {
                        $tag = Tag::firstOrCreate([
                            'slug' => str_slug($tag)
                        ], [
                            'name' => $tag,
                            'slug' => str_slug($tag),
                        ]);
                        $tagID[] = $tag->id;

                    }
                    $product->tags()->sync($tagID);
                }

                return redirect()->route('admin.product.index')->with('message', 'Cập nhật sản phẩm <strong><a href="'.route('admin.product.show', ['id'=>$product->id]).'">' . $product->name . '</a></strong> thành công');
            }
        }
        return redirect()->route('admin.product.index')->with('error', 'Không tìm thấy sản phẩm với id:' . $id);
    }

    public function delete($id)
    {
        $product = Product::find($id);
        if ($product !== null) {
            $product->status = 0;
            $product->save();
//            $product->delete();
            return redirect()->route('admin.product.index')->with('message', 'Xoá sản phẩm ' . $product->name . ' thành công');
        }
        return redirect()->route('admin.product.index')->with('error', 'Không tìm thấy sản phẩm với id:' . $id);
    }

    public function setFeaturedProduct($id){
        $product = Product::find($id);
        if ($product !== null) {
            $product->featured = !$product->featured;
            $product->save();
            return redirect()->route('admin.product.index')->with('message', 'Đặt sản phẩm ' . $product->name . ' thành công');
        }
        return redirect()->route('admin.product.index')->with('error', 'Không tìm thấy sản phẩm với id:' . $id);
    }

    public function datatableListProduct(Request $request){
        if($custom_action_type = $request->input('customActionType')){
            $id = $request->input('id');
            $status = $request->input('customActionName');
            Product::whereIn('id', $id)->update(['status' => $status]);
        }

        $order_by = 'id';
        if($order = $request->input('order')){
            switch ($order[0]['column']){
                case "1":
                    $order_by = 'code';
                    break;
                case "2":
                    $order_by = 'name';
                    break;
                case "3":
    //                $order_by = 'category';
                    $order_by = 'name';
                    break;
                case "4":
                    $order_by = 'sale_price';
                    break;
                case "5":
                    $order_by = 'quantity';
                    break;
                case "6":
                    $order_by = 'created_at';
                    break;
                case "7":
                    $order_by = 'status';
                    break;
                case "8":
                    $order_by = 'views';
                    break;
                default:
                    $order_by = 'id';
                    break;
            }
        }

        $search = array();
        if($request->input('action') != null){
            if($request->input('product_id') != ''){
                $search[] = ['code', 'like', "%".$request->input('product_id')."%"];
            }

            if($request->input('product_name') != ''){
                $search[] = ['name', 'like', "%".$request->input('product_name')."%"];
            }

            if($request->input('product_price_from') != ''){
                $search[] = ['sale_price', '>', $request->input('product_price_from')];
            }

            if($request->input('product_price_to') != ''){
                $search[] = ['sale_price', '<', $request->input('product_price_to')];
            }

            if($request->input('product_quantity_from') != ''){
                $search[] = ['quantity', '>', $request->input('product_quantity_from')];
            }

            if($request->input('product_quantity_to') != ''){
                $search[] = ['quantity', '<', $request->input('product_quantity_to')];
            }

            if($request->input('product_created_from') != ''){
                $start = date("Y-m-d",strtotime(str_replace('/', '-', $request->input('product_created_from'))));
                $search[] = ['created_at', '>', $start];
            }

            if($request->input('product_created_to') != ''){
                $end = date("Y-m-d",strtotime(str_replace('/', '-', $request->input('product_created_to'))));
                $search[] = ['created_at', '<', $end];
            }

            if($request->input('product_status') != ''){
                $search[] = ['status', '=', $request->input('product_status')];
            }
        }

//        dd($search);




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
        $list_product = Product::orderBy('featured', 'desc')->orderBy($order_by, $order[0]['dir']);
        if(!empty($search)){
            $seachProduct = $list_product->where($search);
            $iTotalRecords = $seachProduct->count();
        }
        $list_product = $list_product->offset($iDisplayStart)->limit($iDisplayLength)->get();
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
                '<a href="'.route('admin.product.setFeaturedProduct', ['id'=>$product->id]).'" class="btn btn-circle btn-icon-only btn-'.$publish_class.'  "
                   onclick="event.preventDefault();
                           document.getElementById(\'product-feature-'.$product->id.'\').submit();">
                    <i class="icon-pin"></i>
                 </a>
                 '.$product->views.' views
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

    public function saveImage($image)
    {
        if (!empty($image) && file_exists(public_path('uploads'))) {
            $forderName = date('Y-m');
            $path = public_path("uploads/$forderName");
//            $fileNameWithTimestamp = str_slug(str_replace(".".$image->getClientOriginalExtension(), '', $image->getClientOriginalName()).'_'. time());
//            $fileName = $fileNameWithTimestamp . '.' . $image->getClientOriginalExtension();


            $extension = '.'.$image->getClientOriginalExtension();
            $originalName = str_replace($extension, '', $image->getClientOriginalName());
            if(file_exists($path . "/".str_slug($originalName).$extension)){
                $originalName .= ' '. time();
            }
//            dd(str_slug($originalName).$extension);
            $fileNameWithTimestamp = str_slug($originalName);
            $fileName = str_slug($originalName).$extension;

            if (!file_exists($path)) {
                mkdir($path, 0755);
                mkdir($path, 0755);
            }
            //Di chuyển file vào thư mục upload
            $imageName = "$forderName/$fileName";
            $image->move($path, $fileName);
            //Tạo các hình ảnh theo tỉ lệ giao diện
            $createImage = function($suffix = '_thumb', $width = 246, $height = 184) use($fileName, $fileNameWithTimestamp, $image, $path) {
                $thumbaiFileName = $fileNameWithTimestamp . $suffix . '.' . $image->getClientOriginalExtension();
                Image::make($path . "/$fileName")
                    ->resize($width, $height)
                    ->save($path . "/$thumbaiFileName")
                    ->destroy();
            };
            $createImage();
            $createImage('_420x325', 420, 325);
            $createImage('_73x73', 73, 73);
            return $imageName;
        }
    }

    public function deleteImage($path){
        if (!is_dir(public_path('uploads/' . $path)) && file_exists(public_path('uploads/' . $path))) {
            unlink(public_path('uploads/' . $path));
            $deleteAllImage = function($sizeArr) use($path){
                foreach ($sizeArr as $size){
                    if (!is_dir(public_path('uploads/' . get_thumbnail($path, $size))) && file_exists(public_path('uploads/' . get_thumbnail($path,$size)))) {
                        unlink(public_path('uploads/' . get_thumbnail($path,$size)));
                    }
                }
            };
            $deleteAllImage(['_thumb', '_450x337','_80x80']);
        }
    }


}
