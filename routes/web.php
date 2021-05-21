<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
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
})->name('index');

Auth::routes();

Route::get('/transactions', 'TransactionController@index')->name('transactions');
Route::post('/transactions/create', 'TransactionController@create')->name('transactions.create');
Route::patch('/transactions/edit/{id}', 'TransactionController@edit')->name('transactions.edit');
Route::delete('/transactions/delete/{id}', 'TransactionController@destroy')->name('transactions.delete');
Route::get('/transactions/export', 'TransactionController@exportData')->name('transactions.export');

Route::get('/categories', 'CategoryController@index')->name('categories');
Route::post('/categories/create', 'CategoryController@create')->name('categories.create');
Route::patch('/categories/edit/{id}', 'CategoryController@edit')->name('categories.edit');
Route::get('/categories/{id}', 'CategoryController@showRelatedTransactions')->name('categories.transactions');
Route::delete('/categories/delete/{id}', 'CategoryController@destroy')->name('categories.delete');

Route::get('/statistics', 'StatisticsController@index')->name('statistics');

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
});
