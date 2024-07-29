<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/products', [ProductController::class, 'index']);
Route::put('/products/move-up/{id}', [ProductController::class, 'moveUp']);
Route::put('/products/move-down/{id}', [ProductController::class, 'moveDown']);
Route::delete('/products/{id}', [ProductController::class, 'remove']);
