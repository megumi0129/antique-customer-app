<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PhotoController;
use Illuminate\Support\Facades\Storage;

Route::post('/photos', [PhotoController::class, 'store']);
Route::get('/photos', [PhotoController::class, 'index']);

Route::post('/visit-image-upload', function (Request $request) {
    $paths = [];
    foreach (['image1', 'image2', 'image3'] as $key) {
        if ($request->hasFile($key)) {
            $paths[$key] = $request->file($key)->store('visit-images', 'public');
        }
    }
    return response()->json(['paths' => $paths]);
});