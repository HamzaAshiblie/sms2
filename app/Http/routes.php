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
    return view('auth.login');
})->name('home');

Route::auth();

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
Route::post('/purchaseProduct',[
    'uses' => 'ProductController@purchaseProduct',
    'as' => 'purchaseProduct'
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
Route::get('/product/{cat_id}','ProductController@getProductByCat');
Route::get('/productUpdate/{product_id}/{operation}','ProductController@getProductUpdateByOperation')->name('operation');
Route::get('/productUpdate/{product_id}','ProductController@getProductUpdate');

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

Route::post('removeOrderItem', [
    'uses' => 'OrderController@removeOrderItem',
    'as' => 'removeItem',
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
Route::get('/removeOrderItem/{order_id}',[
    'uses' => 'OrderController@getOrderItem',
    'as' => 'removeOrderItem',
    'middleware' => 'auth'
]);
Route::get('/printOrder/{order_id}','OrderController@printOrder');
Route::get('/printSales/','ReportController@printSales')->name('print.sales');
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
Route::post('/fetchCategory', [
    'uses'  => 'CategoryController@fetchCategory',
    'as' => 'fetchCategory'
]);
/////////////////////////////////////////CALENDER///////////////////////////////////////////////////
Route::get('events', 'EventController@index');
/////////////////////////////////////////REPORTS///////////////////////////////////////////////////
Route::get('/reportSales',[
    'uses'=>'ReportController@getReportSales',
    'as' => 'reportSales'
]);
Route::post('/postReportSales',[
    'uses'=>'ReportController@postReportSales',
    'as' => 'postReportSales'
]);
Route::get('/reportPurchases',[
    'uses'=>'ReportController@getReportPurchases',
    'as' => 'reportPurchases'
]);
Route::get('/reportInvoices',[
    'uses'=>'ReportController@getReportInvoices',
    'as' => 'reportInvoices'
]);
Route::get('/postReportInvoice',[
    'uses'=>'ReportController@postReportInvoice',
    'as' => 'postReportInvoice'
]);
Route::get('/reportRemoved',[
    'uses'=>'ReportController@getReportRemoved',
    'as' => 'reportRemoved'
]);
Route::get('/reportVats',[
    'uses'=>'ReportController@getReportVats',
    'as' => 'reportVats'
]);

Route::get('/reportBetween',[
    'uses'=>'ReportController@getReportBetweenDate',
    'as' => 'report.betweenDate'
]);

Route::get('/reportProductBetween',[
    'uses'=>'ReportController@getReportPurchasesBetweenDate',
    'as' => 'report.betweenProductDate'
]);

Route::get('/reportVatBetween',[
    'uses'=>'ReportController@getReportVatBetweenDate',
    'as' => 'report.betweenVatDate'
]);

Route::get('/reportLimited',[
    'uses'=>'ReportController@getReportLimited',
    'as' => 'report.limited'
]);



Route::get('/home', 'HomeController@index');
Route::get('/admin', 'AdminController@index')->name('admin.dashboard');
Route::get('/admin/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('/admin/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
