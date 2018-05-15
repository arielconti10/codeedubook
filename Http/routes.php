<?php

Route::get('/teste', 'CodeEduBookController@index');


Route::group(['middleware' => 'auth'], function(){
    Route::resource('categories', 'CategoriesController', ['except' => 'show']);
    Route::resource('books', 'BooksController', ['except' => 'show']);

    Route::group(['prefix' => 'thrashed', 'as' => 'thrashed.'], function(){

        Route::resource('books', 'BooksThrashedController', [
            'except' => ['create', 'store', 'edit', 'destroy']
        ]);

        Route::resource('categories', 'CategoriesThrashedController', [
            'except' => ['create', 'store', 'edit', 'destroy']
        ]);

    });
});