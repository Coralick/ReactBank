<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Controller;
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

// register
Route::get('/sign-up', [Controller::class, 'showPage']);
Route::post('/sign-up', [UserController::class, 'registUser'])->name('regist.check');


// authorithation
Route::get('/', [Controller::class, 'showPage'])->name('login.index');
Route::post('/login', [UserController::class, 'checkUser'])->name('login.check');


// main page
Route::get('/main', [Controller::class, 'showPage']);
Route::post('/getUserInfo', [UserController::class, 'showUserInfo']);


// transfer money
Route::get('/transfer-money', [Controller::class, 'showPage']);
Route::put('/transfer-money', [AccountController::class, 'transferMoney'])->name('transfer.check');

// cretae loan
Route::get('/add-loan', [Controller::class, 'showPage']);
Route::post('/add-loan', [LoanController::class, 'createLoan'])->name('add-loan.check');

// close loan
Route::get('/close-loan', [Controller::class, 'showPage']);
Route::put('/close-loan', [LoanController::class, 'closeLoan'])->name('close-loan.check');


// logout
Route::post('/log-out', [Controller::class, 'logOut']);


// page for testing
Route::get('/test', [UserController::class, 'test']);
Route::get('/tes', function(Request $request){

    if(isset($request)){
        return response()->json(['session' => $request]);
    }
    return response()->json('Тут нихуя нет ');
});



