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
Route::get('/', 'PagesController@index')->name('index');
Route::get('laravel', function () {
    return view('welcome');
});
Route::post('addMessage', 'PagesController@addMessage')->name('addMessage');
Route::post('getMessages', 'PagesController@getMessages')->name('getMessages');
Route::post('deleteMessage', 'PagesController@deleteMessage')->name('deleteMessage');
Route::post('setStaus', 'PagesController@setStaus')->name('setStaus');
Route::get('oneMessage', 'PagesController@oneMessage');
Route::post('editMessage', 'PagesController@editMessage')->name('editMessage');
Route::get('test', 'PagesController@test')->name('test');
Route::get('clear', function(){
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
	Artisan::call('route:clear');
    return "Кэш очищен.";
});
Route::group(['prefix'=>'admin', 'namespace'=>"Admin",  'middleware'=>["auth"]], function() {
    Route::get('/', 'AdminController@dashboard')->name('admin.index');
});


Auth::routes();

Route::get('home', 'HomeController@index')->name('home');
