<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::middleware('auth')->group(function(){

Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
Route::post('/items', [ItemController::class, 'store'])->name('items.store');
Route::get('/items/{item}/check', [ItemController::class, 'check'])->name('items.check');
Route::delete('/items/{item}', [ItemController::class, 'destroy'])->name('items.destroy');

Route::middleware('role:todolist_manager')->group(function(){
    Route::get('/manager', [DashboardController::class, 'manager'])->name('dashboard.manager');
});
});



