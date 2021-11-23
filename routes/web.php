<?php

use App\Http\Controllers\FundsController;
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

require __DIR__.'/auth.php';
