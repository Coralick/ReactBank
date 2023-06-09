<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\UserController;
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


// authorithation
Route::get('/', function(){return view('enter');})->name('users.index');
Route::post('/input', [UserController::class, 'checkUser'])->name('input.check');

// regitration
Route::get('/regist', function(){return view('regist');})->name('regist.index');
Route::post('/regist', [UserController::class, 'registUser'])->name('regist.check');

// main page
Route::get('/main', [UserController::class, 'showMain'])->name('mainList.show');

// transfer money
Route::get('/transfer', function(){return view('transfer-money');})->name('transfer.index');
Route::post('/transfer', [AccountController::class, 'transferMoney'])->name('transfer.check');


// get loan
Route::get('/add-loan', function(){return view('add-loan');})->name('add-loan.index');
Route::post('/add-loan', [LoanController::class, 'createLoan'])->name('add-loan.check');
// close loan

Route::get('/close-loan/{id}', function(){ return view('close-loan');})->name('close-loan.index');
Route::post('/close-loan', [LoanController::class, 'closeLoan'])->name('close-loan.check');


// page for testing
Route::get('/test', [UserController::class, 'test']);




// Route::get('/add-account', function(){return view('add-account');})->name('add-account.index');
// Route::post('/add-account', [AccountController::class, 'add-account'])->name('add-account.check');