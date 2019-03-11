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

Route::get('/','UserController@index');
Route::post('store_user','UserController@storeUser');
Route::post('check_user','UserController@checkUser');
Route::get('main_page','UserController@mainPage');
Route::get('logout','UserController@logOut');
Route::post('save_brand','InventoryController@saveBrand');
Route::get('manage_brand','InventoryController@manageBrand');
Route::post('save_category','InventoryController@saveCategory');
Route::get('manage_category','InventoryController@manageCategory');
Route::post('save_product','InventoryController@saveProduct');
Route::get('manage_product','InventoryController@manageProduct');
Route::get('get_order','InventoryController@getOrder');
