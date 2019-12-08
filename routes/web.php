<?php

// Comercio

// registro
Auth::routes();

Route::get('/register-supplier', 'Auth\RegisterSupplierController@showSupplierRegistrationForm')->name('register.supplier');

Route::post('/register-supplier', 'Auth\RegisterSupplierController@register');

// home

Route::get('/', 'HomeController@index')->middleware('auth', 'pending', 'checkRoleMerchant');

Route::get('/home', 'HomeController@index')->name('home.index')->middleware('auth', 'pending', 'checkRoleMerchant');

Route::get('/home/{product}', 'HomeController@show')->name('home.show')->middleware('auth', 'pending', 'checkRoleMerchant');


// mi cuenta - merchant

    // resumen

Route::get('/summary', 'SummaryController@index')->name('summary.index')->middleware('auth', 'pending', 'checkRoleMerchant');

Route::delete('/summary/{user}', 'UsersController@destroy')->name('user.destroy')->middleware('auth', 'pending', 'checkRoleMerchant');

Route::patch('/summary/{user}', 'UsersController@autorize')->name('user.autorize')->middleware('auth', 'pending', 'checkRoleMerchant');
    

    // mis pedidos

Route::get('/orders', 'orderController@indexMerchant')->name('order.indexM')->middleware('auth', 'pending', 'checkRoleMerchant');

Route::get('/orders/{order}', 'orderController@orderDetails')->name('order.details')->middleware('auth', 'pending', 'checkRoleMerchant');


    //tracking

Route::get('/tracking-details/{order}', 'orderController@trackingDetails')->name('order.trackingDetails')->middleware('auth', 'pending', 'checkRoleMerchant');
    
    // preferencias

Route::get('/personal-info', 'UsersController@edit')->name('user.edit')->middleware('auth', 'pending', 'checkRoleMerchant');

Route::patch('/personal-info', 'UsersController@update')->name('user.update')->middleware('auth', 'pending', 'checkRoleMerchant');


// pedidos

Route::get('/pedido', 'CartController@index')->name('cart.index')->middleware('auth' , 'pending', 'checkRoleMerchant');

Route::post('/pedido/{product}', 'CartController@store')->name('cart.store')->middleware('auth', 'pending', 'checkRoleMerchant');

Route::delete('/pedido/{product}', 'CartController@destroy')->name('cart.destroy')->middleware('auth', 'pending', 'checkRoleMerchant');

Route::patch('/pedido/{product}', 'CartController@update')->name('cart.update')->middleware('auth', 'pending', 'checkRoleMerchant');

Route::post('/procesar-pago', 'CartController@procesar')->middleware('auth', 'pending', 'checkRoleMerchant');

Route::get('/order-confirmation', 'CartController@orderConfirm')->name('cart.orderConfirm')->middleware('auth', 'pending', 'checkRoleMerchant');

// buscador

Route::get('/search', 'HomeController@search')->name('search')->middleware('auth', 'pending', 'checkRoleMerchant');

//crear establecimiento

Route::get('/establishment-info', 'EstablishmentController@create')->name('establishment.create')->middleware('auth');

Route::post('/establishment-info', 'EstablishmentController@store')->name('establishment.store')->middleware('auth');

Route::get('/activation-pending', 'EstablishmentController@pending')->name('establishment.pending')->middleware('auth');


// admin panel

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});




// Proveedor

// gestionar pedidos


Route::get('/gestionar-pedidos', 'orderController@index')->name('order.index')->middleware('auth', 'pending', 'checkRoleEmployee');

Route::get('/gestionar-pedidos/{order}', 'orderController@show')->name('order.show')->middleware('auth', 'pending', 'checkRoleEmployee');

Route::patch('/gestionar-pedidos/{order}', 'orderController@readyToShip')->name('order.changeStateReadyToShip')->middleware('auth', 'pending', 'checkRoleEmployee');

// dashboard

Route::get('/dashboard', 'dashboardController@index')->name('dashboard.index')->middleware('auth', 'pending', 'checkRoleEmployee');
