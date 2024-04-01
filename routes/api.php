<?php

use App\Http\Controllers\API\Auth\AuthController;
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

Route::group(['middleware' => 'api'], function ($router) {
    // Auth group route
    Route::group(['prefix' => 'auth'], function () use ($router) {
        $router->post('register', [AuthController::class, 'register'])->name('auth.register');
        $router->post('login', [AuthController::class, 'login'])->name('auth.login');
        $router->post('logout', [AuthController::class, 'logout'])->name('auth.logout');
    });
});