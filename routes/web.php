<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\Backend\PagesController as BackendPagesController;




Route::group(['prefix' => 'admin'], function () {
Route::get('/', [BackendPagesController::class, 'index'])->name('admin.index');


Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/login/submit', [AdminLoginController::class, 'login'])->name('admin.login.submit');
Route::post('/logout/submit', [AdminLoginController::class, 'logout'])->name('admin.logout');

});




Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');



