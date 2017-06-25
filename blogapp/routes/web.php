<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//page controller
Route::get('about','PagesController@getAbout')->name('about');
Route::get('/','PagesController@getIndex')->name('home');
Route::get('home', 'HomeController@index');
Route::post('contact','PagesController@postContact')->name('contact');
Route::get('contact','PagesController@getContact')->name('get.contact');
//posts
Route::resource('posts','PostController');

//Blog controller
Route::get('blog', ['uses' => 'BlogController@getIndex', 'as' => 'blog.index']);
Route::get('blog/{slug}','BlogController@getSingle')->name('blog.single')->where('slug','[\w\d\_\-]+');
Route::get('blog/{id}/{about}','BlogController@getQuery')->name('blog.query')->where('id','[0-9]+')->where('about','[A-Za-z]+');

Route::get('blog/prefetch/search','BlogController@prefetchResults')->name('blog.prefetchResults');
Route::get('blog/search/show','BlogController@searchResults')->name('blog.searchResults');

//Tag controller
Route::resource('tags','TagController',['except'=>['create']]);


//category controller
Route::resource('categories','CategoryController',['except'=>['create']]);

//Login controller
Auth::routes();

//profile controller
Route::resource('profile','ProfileController',['except'=>['create','destroy','index']]);

//change password
Route::get('changepassword','ChangePassword@showChangePassword')->name('changepass');
Route::post('changepassword/{username}','ChangePassword@reset');
