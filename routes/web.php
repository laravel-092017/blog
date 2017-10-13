<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

//Route::view('/', 'welcome');

/*Route::get('/404', function () {
    return view('404');
});*/

Route::get('/', 'MainController@mainPage')
    ->name('mainPage');

Route::get('/about', 'MainController@aboutPage')
    ->name('aboutPage');

Route::get('/404', 'MainController@notFoundPage')
    ->name('notFoundPage');

Route::get('/test', 'TestController@testGetMethod');
Route::post('/test', 'TestController@testPostMethod');

Route::match(['get', 'post'], '/testGetPost', 'TestController@testPostGetMethod');

Route::any('/testGetPost', 'TestController@testPostGetMethod');

Route::redirect('/here', '/404', 302);

Route::get('/main/user/{id?}', 'MainController@user')
    ->where('id', '[0-9]+');

Route::get('/user/{id}/{name}', function ($id, $name) {
    return $id . ' - ' . $name;
})->where(['id' => '[0-9]+', 'name' => '[a-z]+']);

Route::get('/test/redirect', 'TestController@redirectPage');
Route::any('/test/', 'TestController@testPostGetMethod');

Route::group(['prefix' => 'test'], function () {
    Route::get('response1', 'MainController@response1');
    Route::get('response2', 'MainController@response2');
    Route::get('response3', 'MainController@response3');
    Route::get('response4', 'MainController@response4');
    Route::get('response5', 'MainController@response5');
    Route::get('response6', 'MainController@response6');
    Route::get('response7', 'MainController@response7');
    Route::get('response8', 'MainController@response8');

    Route::get('some', 'TestController@some');
});

