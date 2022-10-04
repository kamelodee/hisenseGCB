<?php

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\UserController;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/admin', [UserController::class, 'loginForm'])->name('admin.loginform');
Route::get('/unauthorise', [UserController::class, 'unauthorise'])->name('unauthorise');
Route::post('/admin/login', [UserController::class, 'login'])->name('admin.login');








Route::group(['middleware' => ['auth']], function () {
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
});



Route::group(['middleware' => ['auth:admin']], function () {








    Route::get('/admin/logout', [UserController::class, 'logout'])->name('admin.logout');
});




//  composer require php-smpp/php-smpp
// php artisan config:cache
require __DIR__ . '/auth.php';
