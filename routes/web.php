<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\PointsController;
use App\Http\Controllers\PolylinesController;
use App\Http\Controllers\PolygonsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/peta', [PageController::class, 'peta'])->name('map');

Route::get('/tabel', [PageController::class, 'tabel'])->name('tabel');

//points
Route::post('/points', [App\Http\Controllers\PointsController::class, 'store'])->name('points.store');
Route::delete('/delete-points/{id}', [PointsController::class, 'destroy'])->name('points.delete');
//polylines
Route::post('/polyline', [App\Http\Controllers\PolylinesController::class, 'store'])->name('polyline.store');
Route::delete('/delete-polyline/{id}', [PolylineController::class, 'destroy'])->name('polyline.delete');
//polygons
Route::post('/polygon', [App\Http\Controllers\PolygonsController::class, 'store'])->name('polygon.store');
Route::delete('/delete-polygon/{id}', [PolygonController::class, 'destroy'])->name('polygon.delete');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

require __DIR__.'/settings.php';
