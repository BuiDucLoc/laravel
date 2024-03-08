<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\AuthController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Middleware\AuthenticateMiddleware;
use App\Http\Controllers\backend\UserController;




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
Route::get('user', [UserController::class , 'index'])->name('user.index')->middleware('dashboard');;


Route::get('admin', [AuthController::class , 'index'])->name('auth.admin')->middleware('login');
Route::post('login', [AuthController::class , 'login'])->name('auth.login');
Route::get('logout', [AuthController::class , 'logout'])->name('auth.logout');



