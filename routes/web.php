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
Route::get('/t',function (){return session('web_session');});
Route::get('/f',function (){session()->flush();});
/*
|--------------------------------------------------------------------------
| Admin Auth Routes
|---------------------------------------------------------------------
*/
Route::get('/admin/reset','Admin\AuthController@reset');



//admin auth
Route::get('/admin/login', function () {return view('admin.login');})->name('admin_login');
Route::post('/admin/login','Admin\AuthController@login');
//web auth
Route::get('/login', function () {return view('login');})->name('login');
Route::post('/login','AuthController@login');
Route::post('/register','AuthController@register');

Route::get('/logout',function (){
    Auth::logout();
});

/*
|--------------------------------------------------------------------------
| Web Routes
|---------------------------------------------------------------------
*/
Route::group(['middleware' => 'web_session'], function () {
    Route::get('/', 'WebController@index')->name('front');
});

Route::get('/t',function (){return session('web_session');});
Route::group(['middleware' => 'auth:admin', 'prefix' => 'admin'], function () {

    Route::get('/dashboard', 'Admin\AdminController@index')->name('admin_dashboard');

    Route::resource('/category', 'Admin\CategoryController');
    Route::resource('/variation', 'Admin\VariationController');
    Route::resource('/product', 'Admin\ProductController');
    Route::resource('/homeSlider', 'Admin\HomeSliderController');


    Route::get('/variation_by_category', 'Admin\VariationController@variationByCategory')->name('variation_by_category');
    Route::get('/value_by_variation', 'Admin\VariationController@valueByVariation')->name('value_by_variation');

});