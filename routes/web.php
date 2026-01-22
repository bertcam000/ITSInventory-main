<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\ItemCreationController;

Route::get('/', function () {
    return view('item-list');
});

Route::view('/form', 'form');
Route::view('/test', 'test');

Route::view('/scancode', 'scan');

Route::post('/submit', [QrCodeController::class, 'generate']);
Route::post('/scan', [QrCodeController::class, 'scan']);
Route::get('/show-qr', [QrCodeController::class, 'show']);

// 

// Route::view('/item-list', 'item-list');

Route::post('/create', [ItemCreationController::class, 'create']);
