<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Middleware\AuthMiddleware;

// Public routes
Route::get('/', [EventController::class, 'index'])->name('view-events');
Route::get('/events', [EventController::class, 'all'])->name('events.all');
Route::get('/login', [AuthController::class, 'indexLogin'])->name('auth.indexLogin');
Route::get('/register', [AuthController::class, 'indexRegister'])->name('auth.indexRegister');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

// Middleware-protected routes
Route::middleware(AuthMiddleware::class)->group(function () {
    Route::get('/create-event', [EventController::class, 'create'])->name('create.event');
    Route::post('/store-event', [EventController::class, 'store'])->name('store.event');
});
