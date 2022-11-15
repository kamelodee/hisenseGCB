<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AtendanceController;
use App\Http\Controllers\SmsApiController;
use App\Http\Controllers\ApiEndController;
use app\Services\Odoo\ShowRoom;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\GcbController;


Route::middleware(['whitelist'])->group(function () {
    Route::match(['post','get'],'/payment/reconcile', [GcbController::class, 'deposit'])->middleware('auth:sanctum');
    Route::post('/payment/login', [GcbController::class, 'login']);

    Route::match(['post','get'],'ecobank/payment/reconcile', [GcbController::class, 'ecobankdeposit'])->middleware('auth:sanctum');
    Route::post('/hisense/payment/login', [GcbController::class, 'login']);
    
    });


    Route::match(['post','get'],'test/payment/reconcile', [GcbController::class, 'testdeposit'])->middleware('auth:sanctum');
    Route::post('/test/payment/login', [GcbController::class, 'testlogin']);

    Route::match(['post','get'],'/test/ecobank/payment/reconcile', [GcbController::class, 'ecobankdeposit'])->middleware('auth:sanctum');
    Route::post('/hisense/payment/login', [GcbController::class, 'login']);
    
   


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
