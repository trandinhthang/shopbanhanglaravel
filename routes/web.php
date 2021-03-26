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
//frontend
Route::get('/', [HomeController::class, 'index']);

Route::get('/trang-chu','App\Http\Controllers\HomeController@index');

//backend
Route::get('/admin','App\Http\Controllers\AdminController@index');

Route::get('/dashboard','App\Http\Controllers\AdminController@show_dashboard');

Route::get('/logout','App\Http\Controllers\AdminController@logout');

Route::post('/admin-dashboard','App\Http\Controllers\AdminController@dashboard');

//Category product
Route::get('/add-category-product','App\Http\Controllers\CategoryProductController@add_category_product');

Route::get('/all-category-product','App\Http\Controllers\CategoryProductController@all_category_product');

Route::post('/save-category-product','App\Http\Controllers\CategoryProductController@save_category_product');