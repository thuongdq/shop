<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class CartController extends FrontendController
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
        $cart = is_array($cart = json_decode($request->cookie('cart'), true)) ? $cart : [];
        if(count($cart) > 0){
            $sumPrice = 0;
            foreach ($cart as $value){
                $sumPrice += $value['quantity'] * $value['price'];
            }
            $this->_data = [
                'total' => count($cart),
                'sumPrice' => get_currency($sumPrice, 'vn', 'Đ', false),
                'cart' => $cart
            ];
            return view('frontend.default.cart', $this->_data);
        }
        return redirect()->route('frontend.home.index');
    }

    public function updateCart(Request $request){
        $cart = is_array($cart = json_decode($request->cookie('cart'), true)) ? $cart : [];
        foreach ($request->input('cart') as $key => $quantity) {
            if (isset($cart[$key]) && $quantity > 0) {
                $cart[$key]['quantity'] = $quantity;
            } elseif (isset($cart[$key])) {
                unset($cart[$key]);
            }
        }

        $cookie = cookie('cart', json_encode($cart), 720);
        return redirect()->route('frontend.cart.index')->withCookie($cookie);
    }

    public function delete(Request $request, $id)
    {
        $cart = is_array($cart = json_decode($request->cookie('cart'), true)) ? $cart : [];
        if (isset($cart[$id])) {
            unset($cart[$id]);
        }
        $cookie = cookie('cart', json_encode($cart), 720);
        return redirect()->route('frontend.cart.index')->withCookie($cookie);
    }

    public function deleteAll(Request $request)
    {
        $cookie = cookie('cart', '', 720);
        return redirect()->route('frontend.cart.index')->withCookie($cookie);
    }

//    AJAX
    public function addToCart(Request $request){
        $id = $request->input('id');
        if(is_numeric($id)){
            $product = Product::find($id);
            if($product !== null){
                $cart = is_array($cart = json_decode($request->cookie('cart'), true)) ? $cart : [];
                if(!array_key_exists($id, $cart)){
                    $cart[$id] = [
                            'name' => $product->name,
                            'code' => $product->code,
                            'slug' => $product->slug,
                            'price' => $product->sale_price,
                            'image' => media_get_image_src($product->image, '_thumb'),
                            'quantity' => is_numeric($request->input('quantity')) && $request->input('quantity') > 0 ? $request->input('quantity') : 1
                    ];
                }else{
                    $cart[$id]['quantity'] += is_numeric($request->input('quantity')) && $request->input('quantity') > 0 ? $request->input('quantity') : 1;
                }
    //            Tính tổng số tiền
                $sumPrice = 0;
                $cartTemp = $cart;
                foreach ($cart as $key => $value){
                    $sumPrice += $value['quantity'] * $value['price'];
                    $cart[$key]['price'] = get_currency($value['price'], 'vn', 'Đ', false);
                }

                $cookie = cookie('cart', json_encode($cartTemp), 720);
                return response()->json([
                    'message' => 'Đã thêm vào giỏ hàng thành công',
                    'total' => count($cart),
                    'sumPrice' => get_currency($sumPrice, 'vn', 'Đ', false),
                    'cart' => $cart
                ])->withCookie($cookie);
            }
        }
    }

    public function deleteCart(Request $request)
    {
        $id = $request->input('id');
        $cart = is_array($cart = json_decode($request->cookie('cart'), true)) ? $cart : [];
        if (isset($cart[$id])) {
            unset($cart[$id]);
        }
        $cookie = cookie('cart', json_encode($cart), 720);
        $sumPrice = 0;
        foreach ($cart as $key => $value){
            $sumPrice += $value['quantity'] * $value['price'];
            $cart[$key]['price'] = get_currency($value['price'], 'vn', 'Đ', false);
        }
        return response()->json([
            'total' => count($cart),
            'sumPrice' => get_currency($sumPrice, 'vn', 'Đ', false),
            'cart' => $cart
        ])->withCookie($cookie);
    }

    public function getCart(Request $request){
        $cart = is_array($cart = json_decode($request->cookie('cart'), true)) ? $cart : [];
        $sumPrice = 0;
        foreach ($cart as $key => $value){
            $sumPrice += $value['quantity'] * $value['price'];
            $cart[$key]['price'] = get_currency($value['price'], 'vn', 'Đ', false);
        }
        return response()->json([
            'total' => count($cart),
            'sumPrice' => get_currency($sumPrice, 'vn', 'Đ', false),
            'cart' => $cart
        ]);
    }

}
