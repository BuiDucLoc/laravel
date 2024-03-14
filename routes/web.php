<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\AuthController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Middleware\AuthenticateMiddleware;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\Ajax\LocationController;





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
//admin
Route::get('/', function () {return view('welcome');});
Route::get('dashboard/index', [DashboardController::class , 'index'])->name('dashboard.index')->middleware('dashboard');

// user/admin


Route::prefix('user')->group(function () {
    Route::get('index', [UserController::class , 'index'])->name('user.index')->middleware('dashboard');
    Route::get('create', [UserController::class , 'create'])->name('user.create')->middleware('dashboard');
});

// ajjax
Route::get('ajax/location/getLocation', [LocationController::class , 'getLocation'])->name('ajax.location.index')->middleware('dashboard');


Route::get('admin', [AuthController::class , 'index'])->name('auth.admin')->middleware('login');
Route::post('login', [AuthController::class , 'login'])->name('auth.login');
Route::get('logout', [AuthController::class , 'logout'])->name('auth.logout');



