<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::get('/account',[
    'uses'=>'UserController@getAccount',
    'as' => 'account'
]);
Route::post('/signup',[
    'uses' => 'UserController@postSignUp',
    'as' => 'signup'
]);
Route::post('/signin',[
    'uses' => 'UserController@postSignIn',
    'as' => 'signin'
]);
Route::get('/logout',[
    'uses'=>'UserController@getLogout',
    'as'=> 'logout',
    'middleware'=> 'auth'
]);
Route::get('/dashboard',[
    'uses' => 'UserController@getDashboard',
    'as' => 'dashboard',
    'middleware'=> 'auth'
]);
Route::get('/client',[
    'uses' => 'ClientController@getClient',
    'as' => 'client',
    'middleware'=> 'auth'
]);
Route::post('/createclient',[
    'uses' => 'ClientController@clientCreateClient',
    'as' => 'client.create'
]);
Route::get('/clientsingle',[
    'uses' => 'ClientController@getClientSingle',
    'as' => 'client.get',
]);
Route::post('/clientsingle/edit',[
    'uses' => 'ClientController@editClientSingle',
    'as' => 'client.edit',
]);
Route::post('/clientsingle/delete',[
    'uses' => 'ClientController@deleteClientSingle',
    'as' => 'client.delete',
]);
Route::get('/client-page/{page_num}',[
    'uses' => 'ClientController@getClientPage',
    'as' => 'client.page',
]);

///////////////////////////////PRODUCT//////////////////////////////////
Route::get('/product',[
    'uses' => 'ProductController@getProduct',
    'as' => 'product',
    'middleware'=> 'auth'
]);
Route::post('/createproduct',[
    'uses' => 'ProductController@productCreateProduct',
    'as' => 'product.create'
]);
Route::get('/producttsingle',[
    'uses' => 'ClientController@getClientSingle',
    'as' => 'product.get',
]);
Route::post('/productsingle/edit',[
    'uses' => 'ProductController@editProductSingle',
    'as' => 'product.edit',
]);
Route::post('/productsingle/delete',[
    'uses' => 'ProductController@deleteProductSingle',
    'as' => 'product.delete',
]);

///////////////////////////////////////////ORDERS/////////////////////////////////////////////
Route::get('/addorder',[
    'uses' => 'OrderController@getAddOrder',
    'as' => 'addOrder',
    'middleware' => 'auth'
]);

Route::post('createOrder', [
   'uses' => 'OrderController@createOrder',
    'as' => 'createOrder',
    'middleware' => 'auth'
]);

Route::post('/fetchProductData', [
   'uses'  => 'OrderController@fetchProductData',
    'as' => 'fetchProductData'
]);
Route::post('/fetchSelectedProduct', [
   'uses' => 'OrderController@fetchSelectedProduct',
    'as' => 'fetchSelectedProduct'
]);
Route::get('/manageOrders',[
    'uses' => 'OrderController@getOrder',
    'as' => 'manageOrders',
    'middleware' => 'auth'
]);
Route::get('/printOrder/{order_id}','OrderController@printOrder');
/////////////////////////////////////////PAYMENTS///////////////////////////////////////////////////
Route::post('/updatePayment', [
    'uses' => 'OrderController@updateOrderPayment',
    'as' => 'updatePayment'
]);
Route::post('/fetchOrderItems', [
    'uses'  => 'OrderController@fetchOrderItems',
    'as' => 'fetchOrderItems'
]);
/////////////////////////////////////////CATEGORY///////////////////////////////////////////////////
Route::get('/category',[
    'uses' => 'CategoryController@getCategory',
    'as' => 'category',
    'middleware'=> 'auth'
]);
Route::post('/createcategory',[
    'uses' => 'CategoryController@createCategory',
    'as' => 'category.create'
]);
Route::post('/category/edit',[
    'uses' => 'CategoryController@editCategory',
    'as' => 'category.edit',
]);
Route::post('/category/delete',[
    'uses' => 'CategoryController@deleteCategory',
    'as' => 'category.delete',
]);
/////////////////////////////////////////CALENDER///////////////////////////////////////////////////
Route::get('events', 'EventController@index');
