<?php

//Comercio

Auth::routes();

Route::get('/register-supplier', 'Auth\RegisterSupplierController@showSupplierRegistrationForm')->name('register.supplier');

Route::post('/register-supplier', 'Auth\RegisterSupplierController@register');



Route::get('/', 'HomeController@index')->middleware('auth', 'pending', 'checkRoleMerchant');

Route::get('/home', 'HomeController@index')->name('home.index')->middleware('auth', 'pending', 'checkRoleMerchant');

Route::get('/home/{product}', 'HomeController@show')->name('home.show')->middleware('auth', 'pending', 'checkRoleMerchant');



Route::get('/pedido', 'CartController@index')->name('cart.index')->middleware('auth' , 'pending', 'checkRoleMerchant');

Route::post('/pedido/{product}', 'CartController@store')->name('cart.store')->middleware('auth', 'pending', 'checkRoleMerchant');

Route::delete('/pedido/{product}', 'CartController@destroy')->name('cart.destroy')->middleware('auth', 'pending', 'checkRoleMerchant');

Route::patch('/pedido/{product}', 'CartController@update')->name('cart.update')->middleware('auth', 'pending', 'checkRoleMerchant');

Route::post('/procesar-pago', 'CartController@procesar')->middleware('auth', 'pending', 'checkRoleMerchant');

Route::get('/order-confirmation', 'CartController@orderConfirm')->name('cart.orderConfirm')->middleware('auth', 'pending', 'checkRoleMerchant');



Route::get('/search', 'HomeController@search')->name('search')->middleware('auth', 'pending', 'checkRoleMerchant');



Route::get('/establishment-info', 'EstablishmentController@create')->name('establishment.create')->middleware('auth');

Route::post('/establishment-info', 'EstablishmentController@store')->name('establishment.store')->middleware('auth');

Route::get('/activation-pending', 'EstablishmentController@pending')->name('establishment.pending')->middleware('auth');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});




//Proveedor


Route::get('/gestionar-pedidos', 'orderController@index')->name('order.index')->middleware('auth', 'pending', 'checkRoleEmployee');

Route::get('/gestionar-pedidos/{order}', 'orderController@show')->name('order.show')->middleware('auth', 'pending', 'checkRoleEmployee');

Route::patch('/gestionar-pedidos/{order}', 'orderController@readyToShip')->name('order.changeStateReadyToShip')->middleware('auth', 'pending', 'checkRoleEmployee');


Route::get('/dashboard', 'dashboardController@index')->name('dashboard.index')->middleware('auth', 'pending', 'checkRoleEmployee');

