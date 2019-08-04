<?php


Auth::routes();

Route::get('/', 'HomeController@index')->middleware('auth');

Route::get('/home', 'HomeController@index')->name('home.index')->middleware('auth');

Route::get('/pedido', 'CartController@index')->name('cart.index')->middleware('auth');

Route::post('/pedido/{product}', 'CartController@store')->name('cart.store')->middleware('auth');

Route::delete('/pedido/{product}', 'CartController@destroy')->name('cart.destroy')->middleware('auth');

Route::patch('/pedido/{product}', 'CartController@update')->name('cart.update')->middleware('auth');

Route::get('/home/{product}', 'HomeController@show')->name('home.show')->middleware('auth');

Route::get('/search', 'HomeController@search')->name('search')->middleware('auth');
