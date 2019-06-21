<?php


Auth::routes();

Route::get('/', 'HomeController@index')->middleware('auth');

Route::get('/home', 'HomeController@index')->name('home.index');

Route::get('/pedido', 'CartController@index')->name('cart.index');

Route::post('/pedido/{product}', 'CartController@store')->name('cart.store');

Route::delete('/pedido/{product}', 'CartController@destroy')->name('cart.destroy');

Route::get('/home/{product}', 'HomeController@show')->name('home.show');
