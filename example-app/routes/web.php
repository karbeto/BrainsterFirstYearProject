<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;



Route::get('/', [EventController::class, "index"])->name('view-events');
Route::get('/create-event', [EventController::class, "create"])->name('create.event');
Route::post('/store-event', [EventController::class, 'store'])->name('store.event');

Route::middleware('auth')->group(function () {
    Route::get('/create-event', [UserController::class, 'createEvent'])->name('createEvent');
});

Route::get('/login', [AuthController::class, 'indexLogin'])->name("auth.indexLogin");
Route::get('/register', [AuthController::class, 'indexRegister'])->name("auth.indexRegister");
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

Route::get('/login', [UserController::class, "login"])->name('login');
Route::get('/signup', [UserController::class, "register"])->name('register');

Route::get('/events', [EventController::class, 'all'])->name('events.all');