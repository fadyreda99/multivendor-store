<?php

use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::resource('categories', CategoriesController::class)->middleware('auth');
