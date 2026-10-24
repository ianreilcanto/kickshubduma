<?php

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SiteController::class, 'home'])->name('home');
Route::get('/about', [SiteController::class, 'about'])->name('about');
Route::get('/products', [SiteController::class, 'products'])->name('products');
Route::get('/athletes', [SiteController::class, 'athletes'])->name('athletes');
