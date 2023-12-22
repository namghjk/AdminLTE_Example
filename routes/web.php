<?php

use App\Http\Controllers\Admin\Auth\loginController;
use App\Http\Controllers\Admin\Auth\logoutController;
use App\Http\Controllers\Admin\Auth\registerController;
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

Route::get('/admin/register', [registerController::class, 'index'])->name('register');
Route::post('admin/register/store', [registerController::class, 'store'])->name('registerPost');




Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [mainController::class, 'index'])->name('admin');
        Route::get('/logout', [logoutController::class, 'logout'])->name('logout');
    });
});
