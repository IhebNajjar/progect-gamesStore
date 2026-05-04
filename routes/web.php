<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Game Catalog
Route::get('/catalog', [GameController::class, 'index'])->name('games.index');
Route::get('/games/{game}', [GameController::class, 'show'])->name('games.show');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Wallet
    Route::get('/wallet', [WalletController::class, 'index'])->name('wallet.index');
    Route::post('/wallet/deposit', [WalletController::class, 'deposit'])->name('wallet.deposit');

    // Buying & Borrowing
    Route::post('/games/{game}/buy', [PurchaseController::class, 'store'])->name('games.buy');
    Route::post('/games/{game}/borrow', [BorrowingController::class, 'store'])->name('games.borrow');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'statistics'])->name('admin.dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/games', [AdminController::class, 'games'])->name('admin.games');
    
    Route::post('/games', [GameController::class, 'store'])->name('admin.games.store');
    Route::put('/games/{game}', [GameController::class, 'update'])->name('admin.games.update');
    Route::delete('/games/{game}', [GameController::class, 'destroy'])->name('admin.games.destroy');
    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.users.destroy');
    Route::post('/borrowings/{borrowing}/return', [BorrowingController::class, 'returnGame'])->name('admin.borrowings.return');
    Route::post('/borrowings/manual', [BorrowingController::class, 'manualStore'])->name('borrowings.manual_store');
});

Route::get('/test-mail', function () {
    Illuminate\Support\Facades\Mail::raw('Test email from AntiGravity', function ($message) {
        $message->to('admin@example.com')->subject('AntiGravity Test');
    });
    return 'Test email sent!';
});

require __DIR__.'/auth.php';
