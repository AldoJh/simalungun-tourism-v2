<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\CollectionController;
use App\Http\Controllers\Api\EventController;

Route::get('/kecamatan', [CollectionController::class, 'kecamatan'])->name('kecamatan');
Route::get('/kecamatan/{id}', [CollectionController::class, 'kelurahan'])->name('kelurahan');

Route::prefix('/v1')->group(function () {

  Route::prefix('/auth')->group(function () {
      Route::post('/register', [AuthController::class, 'register']);
      Route::post('/login', [AuthController::class, 'login']);
      Route::post('/forget', [AuthController::class, 'forget']);
      Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
  });  

  Route::prefix('/news')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [NewsController::class, 'index']);
    Route::get('/{id}', [NewsController::class, 'show']);
    Route::post('/{id}/comment', [NewsController::class, 'comment']);
  });  

  Route::prefix('/festival')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [EventController::class, 'index']);
    Route::get('/{id}', [EventController::class, 'show']);
  });  

  Route::prefix('/account')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [AccountController::class, 'me']);
    Route::post('/', [AccountController::class, 'update']);
    Route::put('/password', [AccountController::class, 'password_change']);
  });  
});