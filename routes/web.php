<?php

use App\Http\Controllers\FundsController;
use App\Http\Controllers\StocksController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/funds/deposit', [FundsController::class, 'depositFundsView'])->name('funds.deposit');
Route::patch('/funds/deposit/amount', [FundsController::class, 'depositAmount'])->name('funds.depositAmount');

Route::get('/search', [StocksController::class, 'searchView'])->name('stocks.search');
Route::put('/search/purchase', [StocksController::class, 'purchase'])->name('stocks.purchase');

require __DIR__.'/auth.php';
