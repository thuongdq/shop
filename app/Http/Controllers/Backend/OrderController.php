<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;

class OrderController extends BackendController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->_data['orders'] = Order::orderBy('id', 'desc')->paginate(20);
        return view('backend.orders.index', $this->_data);
    }

    public function show($id){
        $this->_data['order'] = Order::find($id);
        if($this->_data['order'] !== null){
            return view('backend.orders.show', $this->_data);
        }
        return redirect()->route('admin.order.index')->with('error', 'Không tìm thấy đơn hàng với id:'.$id);
    }

    public function delete($id){
        $order = Order::find($id);
        if($order !== null){
            $order->delete();
            return redirect()->route('admin.order.index')->with('message', 'Xoá đơn hàng '.$order->name.' thành công');
        }
        return redirect()->route('admin.order.index')->with('error', 'Không tìm thấy đơn hàng với id:'.$id);
    }

}
