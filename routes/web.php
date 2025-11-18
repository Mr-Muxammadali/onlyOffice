<?php

use App\Http\Controllers\Http\Controllers\View\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/users-from-db', [UserController::class, 'getUsersFromDB']);
Route::get('/users-from-cache', [UserController::class, 'getUsersFromCache']);
