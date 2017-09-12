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

class HomeController extends FrontendController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $this->_data['products'] = Product::orderBy('id', 'desc')->limit(8)->get();
        $this->_data['featureds'] = Product::where('featured', 1)->orderBy('id', 'desc')->limit(12)->get();
        $this->_data['recent_products'] = [];
        if (is_array($recent_products = json_decode($request->cookie('recent_products'), true))) {
            $this->_data['recent_products'] = Product::whereIn('id', $recent_products)->limit(10)->get();
        }
        $time = time();
        $last7days = date('Y-m-d',time() - 86400*7);
        $now = date('Y-m-d');
        $this->_data['best_sellers'] = Cache::remember('best_sellers', 720, function () use ($last7days, $now){
            return Product::
            select('id', 'code', 'name', 'slug','sale_price', 'image')
                ->join(DB::raw('
                (SELECT product_id, SUM(quantity) sum_quantity FROM tdq68_product_order 
                WHERE  DATE(updated_at) BETWEEN ? AND ? 
                GROUP BY product_id 
                ORDER BY sum_quantity DESC
                LIMIT 0, 7) best_sellers
            '), function($join){
                    $join->on('tdq68_products.id', '=', 'best_sellers.product_id');
                })
                ->addBinding([$last7days, $now])
                ->get();
        });
        return view('frontend.default.index', $this->_data);
    }

    public function show(Request $request, $slug)
    {
//        $this->_data['product'] = Product::find($id);
        $this->_data['product'] = Product::where('slug', $slug)->first();
        $recent_products = is_array($recent_products = json_decode($request->cookie('recent_products'), true)) ? $recent_products : [];
        if (!in_array($this->_data['product']->id, $recent_products)) {
            array_unshift($recent_products, $this->_data['product']->id);
            if (count($recent_products) > 10) {
                $recent_products = array_slice($recent_products, 0, 10);
            }
        }
        $cookie = cookie('recent_products', json_encode($recent_products), 1440);

        $this->_data['recent_products'] = Product::whereIn('id', $recent_products)->where('id', '<>', $this->_data['product']->id)->limit(10)->get();
        return response()->view('frontend.default.single-product', $this->_data)->cookie($cookie);
//        return view('frontend.default.single-product', $this->_data);
    }

    public function comment(Request $request, $slug){
        $product = Product::where('slug', $slug)->first();
        $valid = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'content' => 'required',
            'score' => 'required|between:1,5'
        ],[
//          Required
            'name.required' => "Yêu cầu nhập tên",
            'email.required' => "Yêu cầu nhập email",
            'content.required' => "Yêu cầu nhập nội ",
            'score.required' => "Yêu cầu bình chọn",
//          Email
            'email.email' => 'Không đúng định dạng ',
//          Between
            'score.between' => 'Vui lòng chỉ nhập từ :min tới :max'
        ]);

        if($valid->fails()){
            return redirect()->back()->withErrors($valid)->withInput();
        }else{
            Comment::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'content' => $request->input('content'),
                'rating' => $request->input('score'),
                'product_id' => $product->id
            ]);

            return redirect()->back()->with('message', 'Bạn đã đánh giá thành công!');
        }
    }

    public function productIndex(Request $request){
        $products = Product::orderBy('id', 'asc');
        if($orderBy = $request->input('orderBy')){
            switch ($orderBy){
                case 'lastest':
                    $products = Product::orderBy('id', 'desc');
                    break;
                case 'oldest':
                    $products = Product::orderBy('id', 'asc');
                    break;
                case 'hightest':
                    $products = Product::orderBy('sale_price', 'desc');
                    break;
                case 'lowest':
                    $products = Product::orderBy('sale_price', 'asc');
                    break;
            }
        }

//        Tìm kiếm sản phẩm
        if($search = $request->input('search')){
            $products->where(function($query) use ($search) {
                $query->where('name','like', "%$search%")
                    ->orWhere('code', 'like', "%$search%");
            });
        }
//        Tìm kiếm theo chuyên mục
        if($category = $request->input('category')){
            $products->where('category_id', $category);
//            dd($products->toSql());
        }

        $this->_data['products'] = $products->paginate(20);
        return view('frontend.default.products', $this->_data);
    }
}
