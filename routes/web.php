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

Route::get('/create/article', 'ArticleController@create')->name('article.create');

Route::post('/create/article','ArticleController@store')->name('article.store');

Route::get('/articles', 'ArticleController@index')->name('articles');

Route::get('/edit/article/{id}','ArticleController@edit')->name('article.edit');

Route::patch('/edit/article/{id}','ArticleController@update')->name('article.update');

Route::delete('/delete/article/{id}','ArticleController@destroy')->name('article.destroy');
