<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class BackendController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $_data;
    public function __construct()
    {
        $this->middleware('auth');
//        View::share('categories_all', make_categories(Category::all()));

//        $this->_data['root_categories'] = Category::where('parent', 0)->where('id', '<>', 1)->get();
        $this->_data['categories_all'] = make_categories(Category::all());
    }


}
