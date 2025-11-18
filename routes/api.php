<?php

use App\Http\Controllers\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/cunt-users', [UserController::class, 'countUsers']);
Route::get('/users-form-db', [UserController::class, 'getUsersFromDB']);
Route::get('/users-form-cache', [UserController::class, 'getUsersFromCache']);
