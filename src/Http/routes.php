<?php
 

//Route::group(['prefix' => 'admin', 'middleware' => 'Woldy\Cms\Http\Middleware\Admin'], function() {
//
 



Route::get('/font/{font}','Woldy\ResController@font');
Route::get('/fonts/{font}','Woldy\ResController@font');
Route::get('/res', 'Woldy\ResController@res');


Route::group(['prefix' => 'index'], function() {
	Route::get('/', function(){
		return Redirect::to('index/index');
	});
	Route::controller('/index', 'Portal\IndexController');
});



Route::group(['prefix' => 'admin','middleware' => 'auth.admin'], function() {
	Route::get('/', function(){
		return Redirect::to('admin/index');
	});
	Route::controller('/index', 'Admin\IndexController');
	Route::controller('/menu', 'Admin\MenuController');
	
	Route::get('/model/edit/{table}', 'Admin\ModelController@edit');
	Route::controller('/model', 'Admin\ModelController');
	Route::controller('/mitem', 'Admin\mItemController');
	Route::controller('/category', 'Admin\CategoryController');
});


Route::group(['prefix' => 'auth'], function() {
	Route::get('/', function(){
		return Redirect::to('user/login');
	});
	Route::controller('/admin', 'Auth\AdminController');
	Route::controller('/user', 'Auth\UserController');
});


