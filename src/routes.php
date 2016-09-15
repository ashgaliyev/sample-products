<?php

Route::get('/sample-products', 'AndreyAsh\SampleProducts\SampleProductsController@index');
Route::get('/sample-product/{productId?}', 'AndreyAsh\SampleProducts\SampleProductsController@getProduct');
Route::post('/sample-product', 'AndreyAsh\SampleProducts\SampleProductsController@store');
Route::delete('/sample-product/{productId}', 'AndreyAsh\SampleProducts\SampleProductsController@destroy');