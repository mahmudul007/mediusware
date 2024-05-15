<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::get('/', function () {
    return view('frontend.index');
})->name('index');

Auth::routes();
Route::get('/create/user', function () {
    return view('frontend.user.create');
})->name('create.user');
Route::get('/create/withdraw', function () {
    return view('frontend.witdraw.create');
})->name('withdraw.create');
Route::get('/deposite/money',[TransactionController::class, 'create'])->name('create.deposite');
Route::post('/request/deposite/money',[TransactionController::class, 'store'])->name('req.deposite');
Route::get('/all/transactions',[TransactionController::class, 'alltransactions'])->name('all.transaction');
Route::post('/request/withdrawal/money',[TransactionController::class, 'withdrawal'] )->name('withdraw');
Route::get('/show/withdrawal/money',[TransactionController::class, 'showWithdrawals'] )->name('showWithdrawals');


Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

Route::post('/store/user',[UserController::class, 'create'])->name('store.user');
    Route::post('/transaction/{transactionId}/status',[TransactionController::class, 'updateStatus'] )->name('updateTransactionStatus');
    Route::get('/all/viewAllPendingTransaction',[TransactionController::class, 'viewAllPendingTransaction'])->name('all.viewAllPendingTransaction');

// Route::group(['middleware' => 'admin'], function () {

    
// });
