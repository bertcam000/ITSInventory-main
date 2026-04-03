<?php

use App\Models\Campus;
use App\Models\PcAssignment;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\CampusController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PcAssignmentController;

Route::view('/', 'home.home');
Route::view('/about', 'home.about');
Route::view('/team', 'home.team');

Route::view('/login', 'home.login')->name('login');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

    // 
Route::view('/scancode', 'scan');

Route::middleware('auth')->group(function() {
    // Inventory
    Route::get('/inventory', [AssetController::class, 'index']);
    Route::get('/inventory/result/{asset}', [AssetController::class, 'show']);
    Route::delete('/asset/delete/{asset}', [AssetController::class, 'destroy']);
    Route::get('/asset/update/{asset}', [AssetController::class, 'edit']);
    Route::patch('/asset/update/{asset}', [AssetController::class, 'update']);

    // Assigned PC
    Route::get('/assigned-pc', [PcAssignmentController::class, 'index']);
    Route::get('/assigned-pc/{pcAssignment}', [PcAssignmentController::class, 'show']);
    Route::delete('/assigned-pc/{pcAssignment}', [PcAssignmentController::class, 'destroy'])->name('assigned-pc.destroy');
    Route::get('/assigned-pc/{pcAssignment}/edit', [PcAssignmentController::class, 'edit'])->name('pc-assignment.edit');
    Route::put('/assigned-pc/{pcAssignment}', [PcAssignmentController::class, 'update'])->name('pc-assignment.update');

    Route::get('/department', [DepartmentController::class, 'index']);
    Route::get('/department/result/{department}', [DepartmentController::class, 'show']);
    Route::get('/campus', [CampusController::class, 'index']);

    // AP ASSIGNMENT
    Route::get('/assigned-ap', [APController::class, 'index']);
    Route::put('/assigned-ap/{pcAssignment}', [APController::class, 'update'])->name('access-point-assignments.destroy');

    // Account
    // Route::view('/accounts', 'pages.account.index')->can('view-page');
    Route::get('/accounts', [AccountController::class, 'index'])->can('view-page');
    Route::delete('/user/delete/{user}', [AccountController::class, 'destroy'])->can('view-page');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Stocks
    Route::get('/stocks', [StockController::class, 'index'])->name('stocks.index');
    Route::post('/stocks', [StockController::class, 'store'])->name('stocks.store');
    Route::post('/stocks/{stock}/stock-in', [StockController::class, 'stockIn'])->name('stocks.stock-in');
    Route::post('/stocks/{stock}/stock-out', [StockController::class, 'stockOut'])->name('stocks.stock-out');
    Route::post('/stocks/{stock}/adjust', [StockController::class, 'adjustStock'])->name('stocks.adjust');
    Route::get('/stocks/{stock}/history', [StockController::class, 'history'])->name('stocks.history');
    Route::get('/stocks/{stock}/edit', [StockController::class, 'edit'])->name('stocks.edit');
    Route::put('/stocks/{stock}', [StockController::class, 'update'])->name('stocks.update');
    Route::get('/stocks/reports/inventory', [StockController::class, 'inventoryReport'])->name('stocks.reports.inventory');
    Route::get('/stocks/reports/low-stock', [StockController::class, 'lowStockReport'])->name('stocks.reports.low-stock');
    Route::get('/stocks/reports/movement', [StockController::class, 'movementReport'])->name('stocks.reports.movement');

});

require __DIR__.'/auth.php';
