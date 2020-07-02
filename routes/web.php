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

Route::prefix('admin')->group(function () {

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
    | Shopping Priority Routes
    |--------------------------------------------------------------------------
    |
    |
    */

    Route::get('/preferences/shopping_priorities/', 'Admin\ShoppingPriorityController@index')->name('preferences.shopping_priorities.index');
    Route::get('/preferences/shopping_priorities/new', 'Admin\ShoppingPriorityController@create')->name('preferences.shopping_priorities.create');
    Route::post('/preferences/shopping_priorities/', 'Admin\ShoppingPriorityController@store')->name('preferences.shopping_priorities.store');
    Route::get('/preferences/shopping_priorities/:id', 'Admin\ShoppingPriorityController@edit')->name('preferences.shopping_priorities.edit');
    Route::post('/preferences/shopping_priorities/:id', 'Admin\ShoppingPriorityController@update')->name('preferences.shopping_priorities.update');

    /*
    |--------------------------------------------------------------------------
    | Stores Routes
    |--------------------------------------------------------------------------
    |
    |
    */

    Route::get('/preferences/stores/', 'Admin\StoreController@index')->name('preferences.stores.index');
    Route::get('/preferences/stores/new', 'Admin\StoreController@create')->name('preferences.stores.create');
    Route::post('/preferences/stores/', 'Admin\StoreController@store')->name('preferences.stores.store');
    Route::get('/preferences/stores/:id', 'Admin\StoreController@edit')->name('preferences.stores.edit');
    Route::post('/preferences/stores/:id', 'Admin\StoreController@update')->name('preferences.stores.update');


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
    Route::get('/preferences/:id', 'Admin\PreferencesController@edit')->name('preferences.edit');
    Route::post('/preferences/:id', 'Admin\PreferencesController@update')->name('preferences.update');


    /*
    |--------------------------------------------------------------------------
    | Preference Types Routes
    |--------------------------------------------------------------------------
    |
    |
    */

    Route::get('/preferences/types/', 'Admin\PreferenceTypesController@index')->name('preferences.types.index');
    Route::get('/preferences/types/new', 'Admin\PreferenceTypesController@create')->name('preferences.types.create');
    Route::post('/preferences/types/', 'Admin\PreferenceTypesController@store')->name('preferences.types.store');
    Route::get('/preferences/types/:id', 'Admin\PreferenceTypesController@edit')->name('preferences.types.edit');
    Route::post('/preferences/types/:id', 'Admin\PreferenceTypesController@update')->name('preferences.types.update');

});

