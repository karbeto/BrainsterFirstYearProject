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
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

// Middleware-protected routes
Route::middleware(AuthMiddleware::class)->group(function () {
    Route::get('/dashboard', [EventController::class, 'dashboard'])->name('dashboard');
    Route::get('/create-event', [EventController::class, 'create'])->name('create.event');
    Route::post('/store-event', [EventController::class, 'store'])->name('store.event');
    Route::get('/edit-event/{id}', [EventController::class, 'edit'])->name('edit.event');
    Route::post('/update-event/{id}', [EventController::class, 'update'])->name('update.event');
    Route::delete('/delete-event/{id}', [EventController::class, 'destroy'])->name('delete.event');
});
