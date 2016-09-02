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


//Route::group(['middleware' => ['web']],function (){
    //Authentication Routes
    Route::get('auth/login', ['uses' => 'Auth\AuthController@getLogin','as' => 'login']);
    Route::post('auth/login', 'Auth\AuthController@postLogin');
    Route::get('auth/logout', ['uses' => 'Auth\AuthController@getLogout', 'as' => 'logout']);

    //Registration Routes
    Route::get('auth/register','Auth\AuthController@getRegister');
    Route::post('auth/register','Auth\AuthController@postRegister');

    //Password Reset Routes
    Route::get('password/reset/{token?}','Auth\PasswordController@showResetForm');
    Route::post('password/email','Auth\PasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\PasswordController@reset');


    Route::get('blog/{slug}', ['as' => 'blog.single','uses'=> 'BlogController@getSingle'])
            ->where('slug', '[\w\d\-\_]+');
    Route::get('blog', ['as' => 'blog.index','uses'=> 'BlogController@getIndex']);
    Route::get('/', 'pagesController@getIndex');
    Route::get('/about','pagesController@getAbout');
    Route::get('/contact','pagesController@getContact');

    Route::resource('posts','PostController');

    Route::resource('categories','CategoryController',['except' => ['create']]);
    Route::resource('tags','TagController',['except' => ['create']]);
//});