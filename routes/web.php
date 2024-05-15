<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\FormFieldController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\UrlShortnerController;
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
Route::get('/create/withdra', function () {
    return view('frontend.witdraw.create');
})->name('withdraw.create');
Route::post('/store/user',[UserController::class, 'create'])->name('store.user');
Route::get('/deposite/money',[TransactionController::class, 'create'])->name('create.deposite');
Route::post('/request/deposite/money',[TransactionController::class, 'store'])->name('req.deposite');
Route::get('/all/transactions',[TransactionController::class, 'alltransactions'])->name('all.transaction');
Route::get('/all/viewAllPendingTransaction',[TransactionController::class, 'viewAllPendingTransaction'])->name('all.viewAllPendingTransaction');
Route::post('/transaction/{transactionId}/status',[TransactionController::class, 'updateStatus'] )->name('updateTransactionStatus');
Route::post('/request/withdrawal/money',[TransactionController::class, 'withdrawal'] )->name('withdraw');
Route::get('/show/withdrawal/money',[TransactionController::class, 'showWithdrawals'] )->name('showWithdrawals');


Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
Route::resource('/categories', CategoryController::class);
Route::resource('/forms', FormController::class);

Route::resource('/formfields', FormFieldController::class);
Route::resource('/submissions', SubmissionController::class);
Route::resource('/submissions', SubmissionController::class);
Route::group(['middleware' => 'admin'], function () {

    Route::get('/form/{id}', [FormFieldController::class, 'destroy'])->name('formfield.destroy');
});
