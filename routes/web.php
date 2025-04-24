<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerVisitInfController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    abort(403, 'Forbidden. Not a valid entry point.');
});

Route::get('/reg-9a7b21a4customer-view', [CustomerController::class, 'index'])->name('customers.search');
Route::get('/reg-9a7b21a4', [CustomerController::class, 'create'])->name('customers.create');
Route::post('/reg-9a7b21a4', [CustomerController::class, 'store'])->name('customers.store');

Route::get('/sreg-9a7b21a4/edit/{id}', [CustomerController::class, 'edit'])->name('customers.edit');
Route::put('/reg-9a7b21a4/update/{id}', [CustomerController::class, 'update'])->name('customers.update');

Route::get('/reg-9a7b21a4/visit/history/{id}', [CustomerVisitInfController::class, 'index'])
     ->name('visit.history');
Route::get('/reg-9a7b21a4/visit-history/{customer}/create', [CustomerVisitInfController::class, 'create'])->name('visitInfs.create');
Route::post('/reg-9a7b21a4/visit-history', [CustomerVisitInfController::class, 'store'])->name('visitInfs.store');

Route::get('/reg-9a7b21a4/{visitInf}', [CustomerVisitInfController::class, 'show'])->name('visitInfs.show');

Route::get('/reg-9a7b21a4/{id}/edit', [CustomerVisitInfController::class, 'edit'])->name('visitInfs.edit');
Route::put('/reg-9a7b21a4/{id}', [CustomerVisitInfController::class, 'update'])->name('visitInfs.update');
Route::resource('visitInfs', CustomerVisitInfController::class);