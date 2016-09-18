<?php

Route::group(['middleware' => ['web']], function () {
    Route::get('/sample-products', '\AndreyAsh\SampleProducts\SampleProductsController@index');
Route::get('/sample-product/{productId?}', '\AndreyAsh\SampleProducts\SampleProductsController@getForm');
Route::post('/sample-product', '\AndreyAsh\SampleProducts\SampleProductsController@create');
Route::post('/sample-product/{productId}', '\AndreyAsh\SampleProducts\SampleProductsController@save');
Route::delete('/sample-product/{productId}', '\AndreyAsh\SampleProducts\SampleProductsController@destroy');
});

