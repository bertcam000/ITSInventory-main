<?php

use App\Models\PcAssignment;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PcAssignmentController;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

    // 
Route::view('/form', 'form');
Route::view('/test', 'test');
Route::view('/scancode', 'scan');
// Route::view('/inventory', 'inventory.index');
Route::post('/submit', [QrCodeController::class, 'generate']);
Route::post('/scan', [QrCodeController::class, 'scan']);
Route::get('/show-qr', [QrCodeController::class, 'show']);

Route::get('/qrcode', function () {
    return view('qrcode');
    })->name('qrcode');
    
Route::get('/inventory', [AssetController::class, 'index']);

Route::get('/assigned-pc', [PcAssignmentController::class, 'index']);

Route::get('/department', [DepartmentController::class, 'index']);

// Route::view('/item-list', 'item-list');

// Route::post('/create', [ItemCreationController::class, 'create']);

require __DIR__.'/auth.php';
