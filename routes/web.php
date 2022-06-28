<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;


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

Auth::routes();

/* WEBSITE PAGES */
Route::get('/lang/{locale}', function ($locale) {
    if (! in_array($locale, ['en', 'es', 'fa'])) {
        abort(404);
    }

    App::setLocale($locale);
    Session::put('local',$locale);

    return redirect()->back();
})->name('lang');
Route::get('/','WebsiteController@index')->name('index');
Route::get('/about','WebsiteController@about')->name('about');
Route::get('/post/{slug}','WebsiteController@post')->name('post');
Route::get('/page/{slug}','WebsiteController@page')->name('page');
Route::get('/contact','WebsiteController@showContactForm')->name('contact.show');
Route::post('/contact','WebsiteController@submitContactForm')->name('contact.submit');
Route::get('/category/{slug}','WebsiteController@category')->name('category');
Route::get('/categories','WebsiteController@categories')->name('category.index');
Route::resource('users','Admin\UsersController',['except' => ['show','store','create']])->middleware(['auth','verified','local']);
Route::get('/password/change','Admin\UsersController@getPassword')->name('user.getPassword')->middleware(['auth','verified','local']);
Route::post('/password/change','Admin\UsersController@postPassword')->name('user.postPassword')->middleware(['auth','verified','local']);


Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::group(['prefix' => 'admin','middleware' => ['auth','verified','local']],function (){
    Route::resource('categories','CategoryController');
    Route::resource('posts','PostController');
    Route::resource('pages','PageController');
    Route::resource('galleries','GalleryController');
    Route::get('index','Admin\AdminController@index')->name('admin.index');

    // Roles
    Route::get('roles','Admin\AdminController@roleIndex')->name('role.index');
    Route::get('role/create','Admin\AdminController@roleCreate')->name('role.create');
    Route::post('role/create','Admin\AdminController@roleStore')->name('role.store');
    Route::get('role/edit/{id}','Admin\AdminController@roleEdit')->name('role.edit');
    Route::put('role/edit/{id}','Admin\AdminController@roleUpdate')->name('role.update');
    Route::delete('role/delete/{id}','Admin\AdminController@roleDestroy')->name('role.destroy');

    // Permission
    Route::get('permissions','Admin\AdminController@permissionIndex')->name('permission.index');
    Route::get('permission/create','Admin\AdminController@permissionCreate')->name('permission.create');
    Route::post('permission/create','Admin\AdminController@permissionStore')->name('permission.store');
    Route::get('permission/edit/{id}','Admin\AdminController@permissionEdit')->name('permission.edit');
    Route::put('permission/edit/{id}','Admin\AdminController@permissionUpdate')->name('permission.update');
    Route::delete('permission/delete/{id}','Admin\AdminController@permissionDestroy')->name('permission.destroy');

    // Users
    Route::resource('users','Admin\UsersController',['except' => ['show','store','create']]);
    Route::get('/dashboard','Admin\UsersController@dashboard')->name('user.dashboard');
    Route::post('add_skill','Admin\UsersController@storeSkill')->name('skill.add');
    Route::post('cities','Admin\UsersController@getCities')->name('get.cities');

    // ADMIN
    Route::get('details','Admin\AdminController@details')->name('details.edit');
    Route::put('details/edit','Admin\AdminController@detailsUpdate')->name('details.update');

});
