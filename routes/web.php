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


Auth::routes();

   Route::group(['middleware' => 'auth'], function (){

   Route::get('/', 'UserController@index')->name('users.index');

   Route::resource('users', 'UserController');

   Route::resource('roles', 'RoleController');

   Route::resource('permissions', 'PermissionController');

   Route::resource('transactions', 'TransactionController');



   
     Route::get('transactions', 'TransactionController@index')->name('transactions.index')
                                                         ->middleware('permission:transactions.index');

     Route::post('transactions/store', 'TransactionController@store')->name('transactions.store')
                                                         ->middleware('permission:transactions.create');

     Route::get('transactions/create', 'TransactionController@create')->name('transactions.create')
                                                         ->middleware('permission:transactions.create');
    
     Route::put('transactions/{role}', 'TransactionController@update')->name('transactions.update')
                                                        ->middleware('permission:transactions.edit');
                                                                           // ->middleware('role:Admin');

     Route::get('transactions/{role}', 'TransactionController@show')->name('transactions.show')
                                                         ->middleware('permission:transactions.show');
     Route::delete('transactions/{role}', 'TransactionController@destroy')->name('transactions.destroy')
                                                         ->middleware('permission:transactions.destroy');
     Route::get('transactions/{role}/edit', 'TransactionController@edit')->name('transactions.edit')
                                                         ->middleware('permission:transactions.edit');

});