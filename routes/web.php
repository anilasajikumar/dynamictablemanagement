<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\DynamicTableController;

Route::prefix('admin')->group(function () {
    Route::get('/tables', [DynamicTableController::class, 'index'])->name('index'); // List all tables
    Route::get('/tables/create', [DynamicTableController::class,'create'])->name('tables.create'); // Show create form
    Route::post('/tables', [DynamicTableController::class, 'store'])->name('tables.store'); // Store new table
    Route::get('/tables/{id}', [DynamicTableController::class, 'show'])->name('tables.show'); // Show table details
    Route::get('/tables/{id}/edit', [DynamicTableController::class, 'edit'])->name('tables.edit'); // Show edit form
    Route::put('/tables/{id}', [DynamicTableController::class, 'update'])->name('tables.update'); // Update table
    Route::delete('/tables/{id}', [DynamicTableController::class, 'destroy'])->name('tables.destroy'); // Delete table
});

Route::get('/tables', [DynamicTableController::class, 'listTables'])->name('frontend.tables.index');
Route::get('/tables/{id}', [DynamicTableController::class, 'viewTable'])->name('frontend.tables.view');
