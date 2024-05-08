<?php

use App\Http\Controllers\Api\CollectionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/kecamatan', [CollectionController::class, 'kecamatan'])->name('kecamatan');
Route::get('/kecamatan/{id}', [CollectionController::class, 'kelurahan'])->name('kelurahan');

