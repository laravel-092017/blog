<?php
/*
/user/
/user/add
/user/delete/
*/

Route::group(['prefix' => '/user'], function() {
    Route::get('/', 'UserController@index')
        ->name('admin.user.index');

    Route::post('/add', 'UserController@add')
        ->name('admin.user.add');

    Route::post('/edit/{id}', 'UserController@edit')
        ->where('id', '[0-9]+')
        ->name('admin.user.edit');

    Route::get('/delete/{id}', 'UserController@delete')
        ->where('id', '[0-9]+')
        ->name('admin.user.delete');
});