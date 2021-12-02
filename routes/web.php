<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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

//protected $namespace = 'App\Http\Controllers\HomeController';

//Frontend
Route::get('/','App\Http\Controllers\HomeController@index');
Route::get('/trang-chu', 'App\Http\Controllers\HomeController@index');


//Backend_Admin
Route::get('/admin', 'App\Http\Controllers\AdminController@index');
Route::get('/dashboard', 'App\Http\Controllers\AdminController@dash');

// đăng nhập - Admin
Route::post('/admin-dashboard', 'App\Http\Controllers\AdminController@login');
Route::get('/log-out', 'App\Http\Controllers\AdminController@log_out');


//Đăng ký
Route::get('/admin-register', 'App\Http\Controllers\AdminController@register');

//Category-product
Route::get('/add-category', 'App\Http\Controllers\CategoryProductController@add_category_product');
Route::get('/list-category', 'App\Http\Controllers\CategoryProductController@list_category_product');

Route::post('/save-category-product', 'App\Http\Controllers\CategoryProductController@save_category_product');

Route::get('/edit-category-product/{category_id}', 'App\Http\Controllers\CategoryProductController@edit_category_product');
Route::get('/delete-category-product/{category_id}', 'App\Http\Controllers\CategoryProductController@delete_category_product');
Route::post('/update-category-product/{category_id}', 'App\Http\Controllers\CategoryProductController@update_category_product');

Route::get('/active-category-product/{category_id}', 'App\Http\Controllers\CategoryProductController@active_category_product');
Route::get('/unactive-category-product/{category_id}', 'App\Http\Controllers\CategoryProductController@unactive_category_product');
//Danh mục sản phẩm trong trang chủ
Route::get('/danh-muc-san-pham/{category_id}', 'App\Http\Controllers\CategoryProductController@show_category_home');



//Brand-product
Route::get('/add-brand', 'App\Http\Controllers\BrandProductController@add_brand_product');
Route::get('/list-brand', 'App\Http\Controllers\BrandProductController@list_brand_product');

Route::get('/edit-brand-product/{brand_id}', 'App\Http\Controllers\BrandProductController@edit_brand_product');
Route::get('/delete-brand-product/{brand_id}', 'App\Http\Controllers\BrandProductController@delete_brand_product');

Route::get('/active-brand-product/{brand_id}', 'App\Http\Controllers\BrandProductController@active_brand_product');
Route::get('/unactive-brand-product/{brand_id}', 'App\Http\Controllers\BrandProductController@unactive_brand_product');

Route::post('/update-brand-product/{brand_id}', 'App\Http\Controllers\BrandProductController@update_brand_product');
Route::post('/save-brand-product', 'App\Http\Controllers\BrandProductController@save_brand_product');


//Product
Route::get('/add-product', 'App\Http\Controllers\ProductController@add_product');
Route::get('/list-product', 'App\Http\Controllers\ProductController@list_product');

Route::get('/edit-product/{product_id}', 'App\Http\Controllers\ProductController@edit_product');
Route::get('/delete-product/{product_id}', 'App\Http\Controllers\ProductController@delete_product');

Route::get('/active-product/{product_id}', 'App\Http\Controllers\ProductController@active_product');
Route::get('/unactive-product/{product_id}', 'App\Http\Controllers\ProductController@unactive_product');

Route::post('/update-product/{product_id}', 'App\Http\Controllers\ProductController@update_product');
Route::post('/save-product', 'App\Http\Controllers\ProductController@save_product');

//Chi tiết sản phẩm
Route::get('/chi-tiet-san-pham/{product_id}', 'App\Http\Controllers\ProductController@detail');


//Attribute
Route::get('/add-attribute', 'App\Http\Controllers\AttributeController@add_attribute');
Route::get('/list-attribute', 'App\Http\Controllers\AttributeController@list_attribute');
Route::post('/save-attribute', 'App\Http\Controllers\AttributeController@save_attribute');
// Route::get('/edit-product/{product_id}', 'App\Http\Controllers\ProductController@edit_product');
// Route::get('/delete-product/{product_id}', 'App\Http\Controllers\ProductController@delete_product');

// Route::get('/active-product/{product_id}', 'App\Http\Controllers\ProductController@active_product');
// Route::get('/unactive-product/{product_id}', 'App\Http\Controllers\ProductController@unactive_product');

Route::post('/update-attribute/{attribute_id}', 'App\Http\Controllers\AttributeController@update_attribute');

//Cart
Route::post('/save-cart', 'App\Http\Controllers\CartController@save_cart');
Route::post('/update-to-cart', 'App\Http\Controllers\CartController@update_to_cart');

Route::get('/show-cart', 'App\Http\Controllers\CartController@show_cart');
Route::get('/delete-to-cart/{rowId}','App\Http\Controllers\CartController@delete_to_cart');


//Checkout
Route::get('/login-checkout', 'App\Http\Controllers\CheckoutController@login_checkout');
Route::post('/add-customer', 'App\Http\Controllers\CheckoutController@add_customter');
Route::get('/checkout', 'App\Http\Controllers\CheckoutController@checkout');





