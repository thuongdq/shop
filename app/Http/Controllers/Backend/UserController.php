<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends BackendController
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
        $data['title'] = __('backend/users/index.title');
        $data['users'] = User::all();
        return view('backend.users.index', $data);
    }

    public function profile(){
        return view('backend.users.profile');
    }

    public function create(){
        return view('backend.users.create');
    }

    public function store(Request $request){
        $valid = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:tdq68_users,email',
            'password' => 'required|confirmed'
        ], [
            'name.required' => 'Vui lòng nhập Họ Tên',
            'email.required' => 'Vui lòng nhập Email',
            'email.email' => 'Không đúng địng dạng Email',
            'email.unique' => 'Email này đã được sử dụng. Vùi lòng chọn email khác',
            'password.required' => 'Vui lòng nhập Mật khẩu',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp'
        ]);
        if($valid->fails()){
            return redirect()->back()->withErrors($valid)->withInput();
        }else{
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
            ]);
            return redirect()->route('admin.user.index')->with('message', 'Thêm người dùng '.$user->name.' thành công');
        }
        return 'Store'.$request->input('text');
    }

    public function show($id){
        $data['user'] = User::find($id);
        if($data['user'] !== null){
            return view('backend.users.show', $data);
        }
        return redirect()->route('admin.user.index')->with('error', 'Không tìm thấy người dùng với id:'.$id);
    }

    public function update(Request $request, $id){
        dd($request->all());
        $valid = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:tdq68_users,email,'.$id,
            'password' => 'confirmed'
        ], [
            'name.required' => 'Vui lòng nhập Họ Tên',
            'email.required' => 'Vui lòng nhập Email',
            'email.email' => 'Không đúng địng dạng Email',
            'email.unique' => 'Email này đã được sử dụng. Vùi lòng chọn email khác',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp'
        ]);

        if($valid->fails()){
            return redirect()->back()->withErrors($valid)->withInput();
        }else{
            $user = User::find($id);
            if($user !== null) {
                $user->name = $request->input('name');
                $user->email = $request->input('email');
                if ($request->input('password')) {
                    $user->password = $request->input('password');
                }
                $user->save();
                return redirect()->route('admin.user.index')->with('message', 'Cập nhật người dùng ' . $user->name . ' thành công');
            }
        }
        return redirect()->route('admin.user.index')->with('error', 'Không tìm thấy người dùng với id:'.$id);
    }

    public function delete($id){
        $user = User::find($id);
        if($user !== null){
            $user->delete();
            return redirect()->route('admin.user.index')->with('message', 'Xoá người dùng '.$user->name.' thành công');
        }
        return redirect()->route('admin.user.index')->with('error', 'Không tìm thấy người dùng với id:'.$id);
    }
}
