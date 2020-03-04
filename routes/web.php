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

// Route::get('/', 'ListController@show');

Route::get('/', function () {
    return view('welcome');
})->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/createpost', [
  'uses' => 'PostController@postCreatePost', // controller@method
  'as' => 'post.create' // method
]);

Route::get('/delete-post/{post_id}', [
  'uses' => 'PostController@getDeletePost',
  'as' => 'delete.post'
]);

Route::get('/home', [
  'uses' => 'PostController@getHome',
  'as' => 'home'
]);

Route::get('/logout', [
  'uses' => 'UserController@getLogout',
  'as' => 'logout'
]);

// Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/account', [
  'uses' => 'UserController@getAccount',
  'as' => 'account'
]);

Route::post('/updateaccount', [
  'uses' => 'UserController@postSaveAccount',
  'as' => 'account.save'
]);

Route::get('/userimage/{filename}', [
  'uses' => 'UserController@getUserImage',
  'as' => 'account.image'
]);

Route::post('/signin', [
    'uses' => 'UserController@postSignIn',
    'as' => 'signin'
]);

Route::post('/signup', [
    'uses' => 'UserController@postSignUp',
    'as' => 'signup'
]);

Route::post('/edit', [
  'uses' => 'PostController@postEditPost',
  'as' => 'edit'
]);
