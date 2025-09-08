<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\InventoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/inventory/report', [InventoryController::class, 'report']);
Route::post('/stock-movements', [InventoryController::class, 'storeStock'])->middleware(['auth:sanctum']);
Route::post('/move-stock', [InventoryController::class, 'moveStock']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);
