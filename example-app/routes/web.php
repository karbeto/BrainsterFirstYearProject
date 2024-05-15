<?php

use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

Route::get('/', [EventController::class, "index"])->name('view-events');
Route::get('/create-event', [EventController::class, "create"])->name('create.event');
Route::post('/store-event', [EventController::class, 'store'])->name('store.event');


