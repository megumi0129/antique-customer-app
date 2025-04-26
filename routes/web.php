<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerVisitInfController;

Route::get('/', function () {
    abort(403, 'Forbidden. Not a valid entry point.');
});

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