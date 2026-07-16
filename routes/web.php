<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\RegionalOrganizationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{news:slug}', [NewsController::class, 'show'])->name('news.show');

Route::get('/regions', [RegionalOrganizationController::class, 'index'])->name('regions.index');
Route::get('/regions/{organization:slug}', [RegionalOrganizationController::class, 'show'])->name('regions.show');
