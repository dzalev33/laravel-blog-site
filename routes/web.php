<?php

//index
Route::get('/', 'PostsController@index');

//create
Route::get('/posts/create', 'PostsController@create');

//post
Route::post('/posts', 'PostsController@store');