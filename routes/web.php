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

Route::get('/','CrmController@index')->name('crm.index');

//Login
Route::get('/login','UserController@loginView');
Route::post('/login','UserController@login')->name('login');
Route::get('/logout','UserController@logout')->name('logout');

Route::get('/lostPassword','UserController@lostPassword')->name('lostPassword');
Route::post('/sendOtp','UserController@sendOtp')->name('sendOtp');
Route::get('/confirmOtp','UserController@otpView')->name('otpView');
Route::post('/confirmOtp','UserController@confirmOtp')->name('confirmOtp');
Route::get('/changePassword','UserController@changePasswordView')->name('changePasswordView');
Route::post('/changePassword','UserController@changePassword')->name('changePassword');


//Product
Route::get('/listProduct/{category_id}/page/{page?}','CrmController@listProduct')->name('product.category');
Route::get('/product/detail/{product_id}','CrmController@detailProduct')->name('product.detail');

//News
Route::get('/news/{category_id}/page/{page?}','CrmController@listNews')->name('news.category');
Route::get('/news/detail/{post_id}','CrmController@newsDetail')->name('news.detail');

//Cart, Order
Route::get('/cart','CrmController@cart')->name('cart');


Route::group(['middleware'=>['web','login']],function(){
    //Checkout
    Route::get('/checkout','CrmController@checkout')->name('checkout');
    Route::post('/order','CrmController@order')->name('order');

    //Customer/Promoter detail information
    Route::get('/member/profile','ProfileController@profile')->name('profile');
    Route::get('/member/listStaff/','ProfileController@listStaff')->name('listStaff');
    Route::get('/member/listOrder/','ProfileController@listOrder')->name('listOrder');

    Route::get('/member/order/detail/{order_id}','ProfileController@detailOrder')->name('detailOrder');
    Route::get('/member/staff/detail/{staff_id}','ProfileController@detailStaff')->name('detailStaff');


    //Profile
    Route::get('/member/staff/profile','ProfileController@staffProfile')->name('staffOrder');
    Route::post('/member/changePassword','ProfileController@changePassword')->name('changePassWithoutOtp');

    //Notification
    Route::get('/member/notification','ProfileController@notification')->name('notification');
    Route::get('/notification/read','ProfileController@readNotification')->name('readNotification');


    //Create new customer
    Route::post('/createCustomer','CrmController@createCustomer')->name('createCustomer');

});
