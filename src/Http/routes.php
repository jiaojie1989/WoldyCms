<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    //return view('welcome');
    //echo 'x';
});




//Route::group(['prefix' => 'admin', 'middleware' => 'Woldy\Cms\Http\Middleware\Admin'], function() {
Route::group(['prefix' => 'admin'], function() {
	Route::get('/', function(){
		return Redirect::to('admin/index');
	});
	Route::controller('/index', 'Admin\IndexController');
});