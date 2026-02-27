<?php

use App\Models\PcAssignment;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PcAssignmentController;
use App\Http\Controllers\CampusController;
use App\Http\Controllers\DashboardController;
use App\Models\Campus;

Route::view('/', 'home.home');

Route::view('/login', 'home.login')->name('login');;

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

    // 
Route::view('/scancode', 'scan');
Route::post('/submit', [QrCodeController::class, 'generate']);
Route::post('/scan', [QrCodeController::class, 'scan']);
Route::get('/show-qr', [QrCodeController::class, 'show']);

Route::get('/qrcode', function () {
    return view('qrcode');
    })->name('qrcode');

Route::middleware('auth')->group(function() {
    // Inventory
    Route::get('/inventory', [AssetController::class, 'index']);
    Route::get('/inventory/result/{asset}', [AssetController::class, 'show']);
    Route::delete('/asset/delete/{asset}', [AssetController::class, 'destroy']);

    // Assigned PC
    Route::get('/assigned-pc', [PcAssignmentController::class, 'index']);
    Route::get('/assigned-pc/{department}', [PcAssignmentController::class, 'show']);

    Route::get('/department', [DepartmentController::class, 'index']);
    Route::get('/department/result/{department}', [DepartmentController::class, 'show']);
    Route::get('/campus', [CampusController::class, 'index']);

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::view('/testing', 'test.test');

    // Route::view('/item-list', 'item-list');

    // Route::post('/create', [ItemCreationController::class, 'create']);
});

require __DIR__.'/auth.php';
