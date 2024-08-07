<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\AuthController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Middleware\AuthenticateMiddleware;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\backend\UserCatalogueController;
use App\Http\Controllers\Ajax\LocationController;
use App\Http\Controllers\Ajax\DashboardController as AjaxDashboardController;



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
    //get
    Route::get('index', [UserController::class , 'index'])->name('user.index')->middleware('dashboard');

    //create(láy được form tạo và submit form)
    Route::get('create', [UserController::class , 'create'])->name('user.create')->middleware('dashboard');
    Route::post('store', [UserController::class , 'store'])->name('user.store')->middleware('dashboard');

    //edit(put/patch)
    Route::get('{id}/edit', [UserController::class , 'edit'])->name('user.edit')->where('id', '[0-9]+')->middleware('dashboard');
    Route::post('{id}/update', [UserController::class , 'update'])->name('user.update')->where('id', '[0-9]+')->middleware('dashboard');

    Route::get('{id}/delete', [UserController::class , 'delete'])->name('user.delete')->where('id', '[0-9]+')->middleware('dashboard');
    Route::post('{id}/destroy', [UserController::class , 'destroy'])->name('user.destroy')->where('id', '[0-9]+')->middleware('dashboard');

});



// user/catalogue/idex
Route::prefix('user/catalogue')->group(function () {
    //get
    Route::get('index', [UserCatalogueController::class , 'index'])->name('user.catalogue.index')->middleware('dashboard');

    //create(láy được form tạo và submit form)
    Route::get('create', [UserCatalogueController::class , 'create'])->name('user.catalogue.create')->middleware('dashboard');
    Route::post('store', [UserCatalogueController::class , 'store'])->name('user.catalogue.store')->middleware('dashboard');

    //edit(put/patch)
    Route::get('{id}/edit', [UserCatalogueController::class , 'edit'])->name('user.catalogue.edit')->where('id', '[0-9]+')->middleware('dashboard');
    Route::post('{id}/update', [UserCatalogueController::class , 'update'])->name('user.catalogue.update')->where('id', '[0-9]+')->middleware('dashboard');

    Route::get('{id}/delete', [UserCatalogueController::class , 'delete'])->name('user.catalogue.delete')->where('id', '[0-9]+')->middleware('dashboard');
    Route::post('{id}/destroy', [UserCatalogueController::class , 'destroy'])->name('user.catalogue.destroy')->where('id', '[0-9]+')->middleware('dashboard');

});


// ajax
Route::get('ajax/location/getLocation', [LocationController::class , 'getLocation'])->name('ajax.location.index')->middleware('dashboard');
Route::post('ajax/dashboard/changeStatus', [AjaxDashboardController::class , 'changeStatus'])->name('ajax.dashboard.changeStatus')->middleware('dashboard');
Route::post('ajax/dashboard/changeStatusAll', [AjaxDashboardController::class , 'changeStatusAll'])->name('ajax.dashboard.changeStatusAll')->middleware('dashboard');



Route::get('admin', [AuthController::class , 'index'])->name('auth.admin')->middleware('login');
Route::post('login', [AuthController::class , 'login'])->name('auth.login');
Route::get('logout', [AuthController::class , 'logout'])->name('auth.logout');



