<?php

use App\Http\Controllers\MissLogController;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\IntelController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AIController;

Route::redirect('/', '/login');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

// Operation Rpute
Route::get('/operations', [OperationController::class, 'index'])
    ->name('operations.index');

Route::get('/operations/create', [OperationController::class, 'create'])
    ->name('operations.create');

Route::post('/operations', [OperationController::class, 'store'])
    ->name('operations.store');

Route::get('operations/{operation}/edit', [OperationController::class, 'edit'])
    ->name('operations.edit');

Route::put('operations/{operation}', [OperationController::class, 'update'])
    ->name('operations.update');

Route::delete('/operations/{operation}', [OperationController::class, 'destroy'])
    ->name('operations.destroy');

// Mission Route
Route::get('/missions', [MissionController::class, 'index'])
    ->name('missions.index');

Route::get('/missions/create', [MissionController::class,'create'])
    ->name('missions.create');

Route::post('/missions', [MissionController::class, 'store'])
    ->name('missions.store');

Route::get('/missions/{mission}/edit', [MissionController::class, 'edit'])
    ->name('missions.edit');

Route::put('/missions/{mission}', [MissionController::class, 'update'])
    ->name('missions.update');

Route::delete('/missions/{mission}', [MissionController::class, 'destroy'])
    ->name('missions.destroy');

//Misslog
Route::get('/misslogs', [MissLogController::class, 'index'])
    ->name('misslogs.index');

Route::get('/misslogs/create', [MissLogController::class, 'create'])
    ->name('misslogs.create');

Route::post('/misslogs', [MissLogController::class, 'store'])
    ->name('misslogs.store');

Route::get('/misslogs/{missLog}/edit', [MissLogController::class, 'edit'])
    ->name('misslogs.edit');

Route::put('/misslogs/{missLog}', [MissLogController::class, 'update'])
    ->name('misslogs.update');

Route::delete('/misslogs/{missLog}', [MissLogController::class, 'destroy'])
    ->name('misslogs.destroy');

//INTELS
Route::get('/intels', [IntelController::class, 'index'])
    ->name('intels.index');

Route::get('/intels/create', [IntelController::class, 'create'])
    ->name('intels.create');

Route::post('/intels', [IntelController::class, 'store'])
    ->name('intels.store');

Route::get('/intels/{intel}/edit', [IntelController::class, 'edit'])
    ->name('intels.edit');

Route::put('/intels/{intel}', [IntelController::class, 'update'])
    ->name('intels.update');

Route::delete('/intels/{intel}', [IntelController::class, 'destroy'])
    ->name('intels.destroy');

//AI
Route::get('/ai', [AIController::class, 'index'])
    ->name('ai.index');

Route::post('/ai', [AIController::class, 'ask'])
    ->name('ai.ask');

});

require __DIR__.'/auth.php';
