<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CountRangeController;
use App\Http\Controllers\Api\IndexOfStringController;
use App\Http\Controllers\Api\CountMinOperations;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\UserController;


Route::get('/count/{start_number}/{end_number}', [CountRangeController::class, 'count']);
Route::get('/stringIndex/{input_string}', [IndexOfStringController::class, 'indexOfString']);
Route::get('/count-min-operations', [CountMinOperations::class, 'printCount']);

Route::prefix('auth')->group(function () {
    Route::post('register', [RegisterController::class, 'register']);
    Route::post('login', [loginController::class, 'login']);
});

Route::resource('users', UserController::class);