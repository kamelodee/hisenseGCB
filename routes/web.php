<?php

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ShowroomController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\GcbController;
use App\Http\Controllers\CalbankController;
use App\Http\Controllers\UBAController;


Route::get('/', function () {
    $domain = parse_url(request()->root())['host'];

    if($domain =='api.hisense.com.gh'){
        return route('unauthorise');
    }
    return view('welcome');
});


Route::get('/transaction', [PaymentController::class, 'transaction'])->name('transaction');
Route::get('/admin', [UserController::class, 'loginForm'])->name('admin.loginform');
Route::get('/unauthorise', [UserController::class, 'unauthorise'])->name('unauthorise');
Route::post('/admin/login', [UserController::class, 'login'])->name('admin.login');
Route::get('/apidocs', [GcbController::class, 'apidoc'])->name('api');


Route::group(['middleware' => ['auth']], function () {
Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
Route::prefix('showrooms')->group(function () {
    Route::get('/', [ShowroomController::class, 'index'])->name('showrooms');
    Route::get('/gettable', [ShowroomController::class, 'gettable'])->name('showrooms.gettable');
    Route::get('/list', [ShowroomController::class, 'list'])->name('showrooms.list');
    Route::post('/store', [ShowroomController::class, 'store'])->name('showrooms.store');
    
    Route::get('/create', [ShowroomController::class, 'create'])->name('showrooms.create');
    Route::post('/update/{id}', [ShowroomController::class, 'update'])->name('showrooms.update');
    Route::get('/edit/{id}', [ShowroomController::class, 'edit'])->name('showrooms.edit');
    Route::post('/remove/{id}', [ShowroomController::class, 'remove'])->name('showrooms.remove');
});

Route::prefix('payments')->group(function () {
    Route::get('/', [PaymentController::class, 'index'])->name('payments');
    Route::get('/gettable', [PaymentController::class, 'gettable'])->name('payments.gettable');
    Route::get('/calbank', [PaymentController::class, 'index'])->name('payments.calbank');
    Route::get('/uba', [PaymentController::class, 'uba'])->name('payments.uba');
    Route::get('/store', [PaymentController::class, 'store'])->name('payments.store');
    Route::post('/pay', [PaymentController::class, 'calpay'])->name('payments.pay');
    Route::get('/processing', [PaymentController::class, 'processing'])->name('payments.processing');
    Route::post('/update/{id}', [PaymentController::class, 'update'])->name('payments.update');
    Route::get('/edit/{id}', [PaymentController::class, 'edit'])->name('payments.edit');
    Route::post('/remove/{id}', [PaymentController::class, 'remove'])->name('payments.remove');
});

Route::prefix('transactions')->group(function () {
    Route::get('/', [TransactionController::class, 'index'])->name('transactions');
    Route::get('/load', [TransactionController::class, 'load'])->name('transactions.load');
    Route::get('/gettable', [TransactionController::class, 'gettable'])->name('transactions.gettable');
   
    Route::get('/gcb', [TransactionController::class, 'gcb'])->name('transactions.gcb');
    Route::get('/uba', [TransactionController::class, 'uba'])->name('transactions.uba');
    Route::post('/uba/pay', [UBAController::class, 'pay'])->name('transactions.uba.pay');
    Route::get('/uba/returnoute', [UBAController::class, 'returnoute'])->name('transactions.uba.returnoute');
    Route::get('/zenith', [TransactionController::class, 'zenith'])->name('transactions.zenith');
    Route::get('/ubalist', [TransactionController::class, 'ubalist'])->name('transactions.ubalist');
    Route::get('/zenithlist', [TransactionController::class, 'zenithlist'])->name('transactions.zenithlist');
    Route::get('/gcblist', [TransactionController::class, 'gcblist'])->name('transactions.gcblist');
    Route::get('/list', [TransactionController::class, 'callist'])->name('transactions.list');
    Route::post('/store', [TransactionController::class, 'store'])->name('transactions.store');
    Route::post('/update/{id}', [TransactionController::class, 'update'])->name('transactions.update');
    Route::get('/details/{id}', [TransactionController::class, 'show'])->name('transactions.details');
    Route::post('/edit/{id}', [TransactionController::class, 'edit'])->name('transactions.edit');
    Route::post('/remove/{id}', [TransactionController::class, 'remove'])->name('transactions.remove');

  
        Route::get('/calbank', [TransactionController::class, 'index'])->name('transactions.calbank');
        Route::get('/daily', [CalbankController::class, 'indexdaily'])->name('indexdaily');
        Route::get('/weekly', [CalbankController::class, 'indexweekly'])->name('indexweekly');
        Route::get('/monthly', [CalbankController::class, 'indexmonthly'])->name('indexmonthly');
        Route::get('/yearly', [CalbankController::class, 'indexyearly'])->name('indexyearly');
       
       
        Route::get('/dailylist', [CalbankController::class, 'daily'])->name('daily');
        Route::get('/weeklylist', [CalbankController::class, 'weekly'])->name('weekly');
        Route::get('/monthlylist', [CalbankController::class, 'monthly'])->name('monthly');
        Route::get('/yearlylist', [CalbankController::class, 'yearly'])->name('yearly');

 
});





    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users');
        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/store', [UserController::class, 'store'])->name('users.store');
        Route::post('/update/{id}', [UserController::class, 'update'])->name('users.update');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
        Route::get('/gettable', [UserController::class, 'gettable'])->name('users.gettable');
        Route::get('/userlist', [UserController::class, 'userlist'])->name('users.list');
        Route::get('/destroy', [UserController::class, 'destroy'])->name('users.destroy');
        Route::prefix('roles')->group(function () {
            Route::get('/', [RoleController::class, 'index'])->name('roles');
            Route::get('/create', [RoleController::class, 'create'])->name('roles.create');
            Route::get('/list', [RoleController::class, 'list'])->name('roles.list');
            Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
            Route::post('/update/{id}', [RoleController::class, 'update'])->name('roles.updates');
            Route::get('/destroy/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');
          
        });
    });

    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
});



Route::group(['middleware' => ['auth:admin']], function () {








    Route::get('/admin/logout', [UserController::class, 'logout'])->name('admin.logout');
});




//  composer require php-smpp/php-smpp
// php artisan config:cache
require __DIR__ . '/auth.php';
