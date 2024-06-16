<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->middleware('api')->controller(AuthController::class)->group(
    function () {
        // авторизация
        Route::post('login', 'login')->name('login');
    }
);

Route::prefix('user')->middleware('api')->controller(UserController::class)->group(
    function () {
        // приглашение пользователя
        Route::post('invite', 'invite');
        // активация пользователя
        Route::post('activate', 'activate');
    }
);
Route::prefix('company')->middleware('api')->controller(CompanyController::class)->group(
    function () {
        // приглашение компании
        Route::post('invite', 'invite');
    }
);
