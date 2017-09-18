<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Request;
if($lang = Request::input('lang')){
    App::setLocale($lang);
}
//die(__('auth.welcome', ['name'=>'ThuongDQ', 'place'=>'Hanoi']));
//die(trans_choice('auth.orange', 55, ['counter' => 55 ]));

Route::get('login/facebook', 'LoginController@redirectToProvider')->name('loginFacebook');
Route::get('login/facebook/callback', 'LoginController@handleProviderCallback');

Route::group(['as' => 'admin.', 'prefix'=>'admin', 'namespace' => 'Backend'], function(){
    Auth::routes();
});
Route::group(['as' => 'admin.', 'prefix'=>'admin', 'namespace' => 'Backend', 'middleware' => ['checkRoles:admin,writer,seller']], function(){

//    Route::get('/', 'ProductController@index')->name('index');
    //    Dashboard
    Route::get('/', 'DashboardController@index')->name('dashboard.index');

    //  User
    Route::get('/users', 'UserController@index')->name('user.index');
    Route::get('/users/profile', 'UserController@profile')->name('user.profile');
    Route::get('/users/create', 'UserController@create')->name('user.create');
    Route::post('/users', 'UserController@store')->name('user.store');
    Route::get('/users/{id}', 'UserController@show')->where('id','[0-9]+')->name('user.show');
    Route::put('/users/{id}', 'UserController@update')->name('user.update');
    Route::delete('/users/{id}', 'UserController@delete')->name('user.delete');

    //  Category
    Route::get('/categories', 'CategoryController@index')->name('category.index');
    Route::get('/categories/create', 'CategoryController@create')->name('category.create');
    Route::post('/categories', 'CategoryController@store')->name('category.store');
    Route::get('/categories/{id}', 'CategoryController@show')->where('id','[0-9]+')->name('category.show');
    Route::put('/categories/{id}', 'CategoryController@update')->name('category.update');
    Route::delete('/categories/{id}', 'CategoryController@delete')->name('category.delete');

    Route::get('/categories/create/{root}/{parent}', 'CategoryController@create_item')->where(['root' => '[0-9]+' ,'parent'=>'[0-9]+'])->name('category.create-item');
    Route::post('/categories/create/{root}/{parent}', 'CategoryController@store_item')->where(['root' => '[0-9]+' ,'parent'=>'[0-9]+'])->name('category.store-item');;
    Route::get('/categories/{root}/{id}', 'CategoryController@show_item')->where(['root' => '[0-9]+' ,'id'=>'[0-9]+'])->name('category.show-item');
    Route::put('/categories/{root}/{id}', 'CategoryController@update_item')->where(['root' => '[0-9]+' ,'id'=>'[0-9]+'])->name('category.update-item');

    //  Product
    Route::get('/products', 'ProductController@index')->name('product.index');
    Route::get('/products/create', 'ProductController@create')->name('product.create');
    Route::post('/products', 'ProductController@store')->name('product.store');
    Route::get('/products/{id}', 'ProductController@show')->where('id','[0-9]+')->name('product.show');
    Route::put('/products/{id}', 'ProductController@update')->name('product.update');
    Route::delete('/products/{id}', 'ProductController@delete')->name('product.delete');
    Route::patch('/products/{id}', 'ProductController@setFeaturedProduct')->name('product.setFeaturedProduct');

    //    Order
    Route::get('/orders', 'OrderController@index')->name('order.index');
    Route::get('/orders/{id}', 'OrderController@show')->where('id','[0-9]+')->name('order.show');
    Route::delete('/orders/{id}', 'OrderController@delete')->name('order.delete');

    Route::get('/design/listcategory', 'DesignController@listCategory')->name('design.listCategory');
    Route::get('/design/listtags', 'DesignController@listTags')->name('design.listTags');
    Route::post('/design/listproduct', 'DesignController@listProduct')->name('design.listProduct');
    Route::post('/design/getslug', 'DesignController@getSlug')->name('design.getSlug');
});

Route::group(['as' => 'api.', 'prefix' => 'api', 'namespace' => 'Backend'], function(){
    Route::post('/products', 'ProductController@datatableListProduct')->name('product.datatableListProduct');
});

Route::group(['as' => 'frontend.', 'namespace' => 'Frontend'], function(){
    Auth::routes();

    //    Products
    Route::get('/', 'HomeController@index')->name('home.index');
    Route::get('/products', 'HomeController@productIndex')->name('home.productIndex');
    Route::get('/products/{slug}.html', 'HomeController@show')->name('home.show');
    Route::post('/products/{slug}.html', 'HomeController@comment')->name('home.comment');

    //    Cart
    Route::get('/cart', 'CartController@index')->name('cart.index');
    Route::post('/cart', 'CartController@updateCart')->name('cart.updateCart');
    Route::get('/cart/{id}/delete', 'CartController@delete')->name('cart.delete');
    Route::get('/cart/deleteAll', 'CartController@deleteAll')->name('cart.deleteAll');

    //    Checkout
    Route::get('/checkout', 'CheckoutController@index')->name('checkout.index');
    Route::post('/checkout', 'CheckoutController@placeOrder')->name('checkout.placeOrder');
    Route::get('/thankyou', 'CheckoutController@thankyou')->name('checkout.thankyou');
});

Route::group(['as' => 'api.', 'prefix' => 'api', 'namespace' => 'Frontend'], function(){
    //    Cart
    Route::get('/cart', 'CartController@getCart')->name('cart.getCart');
    Route::post('/cart', 'CartController@addToCart')->name('cart.addToCart');
    Route::put('/delete', 'CartController@deleteCart')->name('cart.deleteCart');
});


Route::get('/test', function(){
//    $owner = new \App\Role();
//    $owner->name         = 'owner';
//    $owner->display_name = 'Project Owner'; // optional
//    $owner->description  = 'User is the owner of a given project'; // optional
//    $owner->save();
//    \App\Role::create([
//        'name' => 'admin112',
//        'display_name' => 'Project Owner',
//        'description' => 'User is the owner of a given project'
//    ]);
//    $user  = \App\User::find(1);
//    $user->attachRole(\App\Role::find(3));
//    $user->detachRole(\App\Role::where('name', 'admin')->first());


//    \App\Permission::create([
//        'name' => 'upload',
//        'display_name' => 'Upload Files Or Photos',
//        'description' => 'Allow member upload'
//    ]);
//    $role = \App\Role::find(1);
//    $role->perms()->attach(\App\Permission::find(1));
    return view('test');
});


/*Route::get('/users/{id}/abc/{name}', 'UserController@show')->where([
    'id' => '[0-9]+',
    'name' => '[a-zA-Z]+'
]);*/