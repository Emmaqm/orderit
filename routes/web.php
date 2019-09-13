<?php


Auth::routes();

Route::get('/register-supplier', 'Auth\RegisterSupplierController@showSupplierRegistrationForm')->name('register.supplier');

Route::post('/register-supplier', 'Auth\RegisterSupplierController@register');



Route::get('/', 'HomeController@index')->middleware('auth', 'pending');

Route::get('/home', 'HomeController@index')->name('home.index')->middleware('auth', 'pending');

Route::get('/pedido', 'CartController@index')->name('cart.index')->middleware('auth' , 'pending');

Route::post('/pedido/{product}', 'CartController@store')->name('cart.store')->middleware('auth', 'pending');

Route::delete('/pedido/{product}', 'CartController@destroy')->name('cart.destroy')->middleware('auth', 'pending');

Route::patch('/pedido/{product}', 'CartController@update')->name('cart.update')->middleware('auth', 'pending');

Route::get('/home/{product}', 'HomeController@show')->name('home.show')->middleware('auth', 'pending');

Route::get('/search', 'HomeController@search')->name('search')->middleware('auth', 'pending');




Route::get('/establishment-info', 'EstablishmentController@create')->name('establishment.create')->middleware('auth');

Route::post('/establishment-info', 'EstablishmentController@store')->name('establishment.store')->middleware('auth');

Route::get('/activation-pending', 'EstablishmentController@pending')->name('establishment.pending')->middleware('auth');



