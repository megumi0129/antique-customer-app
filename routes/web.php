<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerVisitInfController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StaffController;
use App\Http\Middleware\IsOwner;

Route::get('/', function () {
    abort(403, 'Forbidden. Not a valid entry point.');
});

// ログイン画面表示
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// ログイン処理
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// ログアウト
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
// 顧客情報管理
Route::get('/reg-9a7b21a4customer-view', [CustomerController::class, 'index'])->name('customers.search');
Route::get('/reg-9a7b21a4', [CustomerController::class, 'create'])->name('customers.create');
Route::post('/reg-9a7b21a4', [CustomerController::class, 'store'])->name('customers.store');
Route::get('/sreg-9a7b21a4/edit/{id}', [CustomerController::class, 'edit'])->name('customers.edit');
Route::put('/reg-9a7b21a4/update/{id}', [CustomerController::class, 'update'])->name('customers.update');

// 来店履歴
Route::get('/reg-9a7b21a4/visit/history/{customer}', [CustomerVisitInfController::class, 'index'])->name('visit.history');
Route::get('/reg-9a7b21a4/visit-history/{customer}/create', [CustomerVisitInfController::class, 'create'])->name('visitInfs.create');
Route::post('/reg-9a7b21a4/visit-history', [CustomerVisitInfController::class, 'store'])->name('visitInfs.store');

Route::get('/reg-9a7b21a4/visit-history/{visitInf}', [CustomerVisitInfController::class, 'show'])->name('visitInfs.show');
Route::get('/reg-9a7b21a4/visit-history/{id}/edit', [CustomerVisitInfController::class, 'edit'])->name('visitInfs.edit');
Route::put('/reg-9a7b21a4/visit-history/{id}', [CustomerVisitInfController::class, 'update'])->name('visitInfs.update');
Route::delete('/reg-9a7b21a4/visit-history/{id}', [CustomerVisitInfController::class, 'destroy'])
    ->name('visitInfs.destroy');
});

/**
 * オーナー用ページ
 */
Route::middleware(['auth', IsOwner::class])->group(function () {
// スタッフ管理
    Route::get('/staffs', [StaffController::class, 'index'])->name('staffs.index');
    Route::get('/staffs/create', [StaffController::class, 'create'])->name('staffs.create');
    Route::post('/staffs', [StaffController::class, 'store'])->name('staffs.store');
    Route::patch('/staffs/{id}/toggle', [StaffController::class, 'toggle'])->name('staffs.toggle');
    Route::post('/staffs/{id}/reset-password', [StaffController::class, 'resetPassword'])->name('staffs.resetPassword');
    Route::delete('/staffs/{id}', [StaffController::class, 'destroy'])->name('staffs.destroy');
});