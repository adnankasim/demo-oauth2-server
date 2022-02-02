<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;

Route::group([
    'prefix' => 'auth',
    'middleware' => 'cors',
], function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('register', [AuthController::class, 'register']);

        Route::group([
            'middleware' => 'auth:api'
        ], function() {
            Route::get('logout', [AuthController::class, 'logout']);
            Route::get('user', [AuthController::class, 'user']);
    });
});

Route::group(['middleware' => 'client'], function(){
    Route::get('users', [HomeController::class, 'index']);
});
