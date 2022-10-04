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
    Route::match(['post','get'],'/hisense/payment/reconcile', [GcbController::class, 'deposit'])->middleware('auth:sanctum');
    Route::post('/hisense/payment/login', [GcbController::class, 'login']);
    });


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
