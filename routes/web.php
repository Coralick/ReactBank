<?php

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
Route::get('/', function(){return view('enter');})->name('users.index');
Route::post('/input', [UserController::class, 'checkUser'])->name('input.check');

Route::get('/regist', function(){return view('regist');})->name('regist.index');
Route::post('/regist', [UserController::class, 'registUser'])->name('regist.check');

Route::get('/main/{id}', [UserController::class, 'showMain'])->name('mainList.show');

Route::get('/test', [UserController::class, 'test']);