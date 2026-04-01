<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/peta', [PageController::class, 'peta'])->name('map');

Route::get('/tabel', [PageController::class, 'tabel'])->name('tabel');

//points
Route::post('/points', [App\Http\Controllers\PointsController::class, 'store'])->name('points.store');
//polylines
Route::post('/polyline', [App\Http\Controllers\PolylinesController::class, 'store'])->name('polyline.store');
//polygons
Route::post('/polygon', [App\Http\Controllers\PolygonsController::class, 'store'])->name('polygon.store');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

require __DIR__.'/settings.php';
