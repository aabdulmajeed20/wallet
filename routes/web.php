<?php

use App\Notifications\InvoicePaid;
use App\User;
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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/','HomeController@index');
// Route::get('add', 'WalletController@add');
Auth::routes();

// Route::get('/test', function ()
// {
//     $user = User::first()->notify(new InvoicePaid);
//     return view('welcome');
// });

Route::get('/test','WalletController@notify');

Route::get('/home', 'WalletController@index')->name('home');
Route::resource('ewallet', 'EWallet');

/// for creating transaction
Route::get('add','TransactionController@create');
Route::post('add','TransactionController@store');
Route::get('transaction','TransactionController@index');
Route::get('invoice','TransactionController@invoice');

/*
Route::get('edit/{id}','TransactionController@edit');
Route::post('edit/{id}','TransactionController@update');
Route::delete('{id}','TransactionController@destroy');
/*/