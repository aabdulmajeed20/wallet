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
Auth::routes();



Route::get('/home', 'WalletController@index')->name('home');

/// for creating transaction
Route::get('createTransfer', [
    'uses' => 'TransactionController@create',
    'as' => 'createTransfer'
]);

Route::post('makeTransfer', [
    'uses' => 'TransactionController@store',
    'as' => 'makeTransfer',
]);
Route::get('transaction', [
    'uses' => 'TransactionController@index',
    'as' => 'transactions'
]);
Route::get('/details/{transaction_id}', [
    'uses' => 'TransactionController@details',
    'as' => 'details'
]);
