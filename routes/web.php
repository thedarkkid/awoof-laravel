<?php

use Illuminate\Support\Facades\Route;

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


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
|
*/

Route::prefix('admin/')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Auth Routes
    |--------------------------------------------------------------------------
    |
    |
    */
    Route::get('/', 'Admin\AdminController@index')->name('admin.home');
    Route::get('/login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Admin\Auth\LoginController@login')->name('admin.login');
    Route::post('/logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');


    /*
    |--------------------------------------------------------------------------
    | Preference Types Routes
    |--------------------------------------------------------------------------
    |
    |
    */
    Route::get('/preferences/types', 'Admin\PreferenceTypesController@index')->name('preferences.types.index');
    Route::post('/preferences/types', 'Admin\PreferenceTypesController@store')->name('preferences.types.store');
    Route::post('/preferences/types/{id}', 'Admin\PreferenceTypesController@update')->name('preferences.types.update');
    Route::delete('/preferences/types/{id}', 'Admin\PreferenceTypesController@destroy')->name('preferences.types.destroy');


    /*
    |--------------------------------------------------------------------------
    | Shopping Priority Routes
    |--------------------------------------------------------------------------
    |
    |
    */

    Route::get('/preferences/shopping_priorities/', 'Admin\ShoppingPriorityController@index')->name('preferences.shopping_priorities.index');
    Route::post('/preferences/shopping_priorities/', 'Admin\ShoppingPriorityController@store')->name('preferences.shopping_priorities.store');
    Route::post('/preferences/shopping_priorities/{id}', 'Admin\ShoppingPriorityController@update')->name('preferences.shopping_priorities.update');
    Route::delete('/preferences/shopping_priorities/{id}', 'Admin\ShoppingPriorityController@destroy')->name('preferences.shopping_priorities.destroy');


    /*
    |--------------------------------------------------------------------------
    | Stores Routes
    |--------------------------------------------------------------------------
    |
    |
    */
    Route::get('/preferences/stores/', 'Admin\StoreController@index')->name('preferences.stores.index');
    Route::post('/preferences/stores/', 'Admin\StoreController@store')->name('preferences.stores.store');
    Route::post('/preferences/stores/{id}', 'Admin\StoreController@update')->name('preferences.stores.update');
    Route::delete('/preferences/stores/{id}', 'Admin\StoreController@destroy')->name('preferences.stores.destroy');


    /*
    |--------------------------------------------------------------------------
    | Preference Routes
    |--------------------------------------------------------------------------
    |
    |
    */

    Route::get('/preferences/', 'Admin\PreferencesController@index')->name('preferences.index');
    Route::get('/preferences/new', 'Admin\PreferencesController@create')->name('preferences.create');
    Route::post('/preferences/', 'Admin\PreferencesController@store')->name('preferences.store');
    Route::get('/preferences/{id}', 'Admin\PreferencesController@edit')->name('preferences.edit');
    Route::post('/preferences/{id}', 'Admin\PreferencesController@update')->name('preferences.update');


});

