<?php

use App\Http\Controllers\Admin\loginController;
use App\Http\Controllers\Admin\logoutController;
use App\Http\Controllers\mainController;
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



Route::get('/admin/login', [loginController::class, 'index'])->name('login');
Route::post('/admin/login/store', [loginController::class, 'store'])->name('loginPost');


Route::prefix('admin')->group(function () {
    Route::get('/', [mainController::class, 'index'])->name('admin');
    Route::get('/logout', [logoutController::class, 'logout'])->name('logout');
});
