<?php

use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\Task\TaskController;
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

    // Task group route
    Route::group(['prefix' => 'task'], function () use ($router) {
        $router->post('store', [TaskController::class, 'newTask'])->name('task.store');
        $router->get('all', [TaskController::class, 'allTasks'])->name('task.all');
        $router->get('/{id}', [TaskController::class, 'getTask'])->name('task.get');
        $router->put('/{id}', [TaskController::class, 'updateTask'])->name('task.update');
        $router->delete('/{id}', [TaskController::class, 'deleteTask'])->name('task.delete');
    });
});