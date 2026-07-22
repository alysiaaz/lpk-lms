<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\KursusController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Public API routes (no auth required)
Route::prefix('v1')->group(function () {
    // Kategori endpoints
    Route::get('/kategori', [KursusController::class, 'kategori']);
    
    // Featured/Unggulan endpoints (SPESIFIK - DIDULU)
    Route::get('/kursus/unggulan', [KursusController::class, 'unggulan']);
    
    // Kursus endpoints (UMUM - TERAKHIR)
    Route::get('/kursus', [KursusController::class, 'index']);
    Route::get('/kursus/{slug}', [KursusController::class, 'show']);
});