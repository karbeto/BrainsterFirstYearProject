<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [EventController::class, "index"])->name('view-events');
Route::get('/create-event', [EventController::class, "create"])->name('create.event');
Route::post('/store-event', [EventController::class, 'store'])->name('store.event');


Route::get('/login', [UserController::class, "login"])->name('login');
Route::get('/signup', [UserController::class, "register"])->name('register');
