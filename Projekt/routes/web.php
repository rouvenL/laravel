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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/register', ['as' => 'register', 'uses'=> 'CompanyController@index']);

Route::middleware('is_admin')->group(function(){
    if(request()->has('delete'))
    {
        Route::put('/admin/company/{id}', ['as' => 'admin.company.delete', 'uses' => 'CompanyController@destroy']);
        Route::put('/admin/{id}', ['as' => 'admin.delete', 'uses' => 'UserController@destroy']);
        Route::get('/admin', ['as' => 'admin', 'uses' => 'UserController@index']);
    }
    else
    {
        Route::get('/admin', 'UserController@index')->name('admin'); //Route for /admin
        Route::get('/admin/{id}', ['as' => 'admin.update', 'uses' => 'UserController@index']);
        Route::put('/admin/{id}', ['as' => 'admin.update', 'uses' =>'UserController@update']);
        Route::get('/admin/company/{id}', ['as' => 'admin.company.update', 'uses' => 'UserController@index']);
        Route::put('/admin/company/{id}', ['as' => 'admin.company.update', 'uses' => 'CompanyController@update']);
        Route::post('/admin/newcompany', ['as' => 'addcompany', 'uses' => 'CompanyController@store']);
        Route::post('/admin/newuser', ['as' => 'adduser', 'uses' => 'UserController@create']);
    }
});

Route::middleware('is_guest')->group(function(){
    Route::get('/user/edit/', ['as' => 'edituser', 'uses' =>'UserController@index']);
    Route::put('/user/edit/{id}', ['as' => 'edituser.update', 'uses' => 'UserController@update']);
});
