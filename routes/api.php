<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/input', function (Request $request) {
    return response()->json(['message' => 'Token is valid']);
});

// Route::middleware('auth:sanctum')->post('/sign-up', [UserController::class, 'registUser'])->name('regist.check');
Route::get('/login', [Controller::class, 'showPage']);
