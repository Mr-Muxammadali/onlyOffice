<?php

use App\Http\Controllers\Http\Controllers\View\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/',[UserController::class,'index']);
Route::get('/profile/{id}',[UserController::class,'profile'])->name('profile');
Route::post('/transfer',[UserController::class,'transfer'])->name('transfer');
Route::get('/pagination-from-db',[UserController::class,'paginationFromDb']);
Route::get('/pagination-from-cache',[UserController::class,'paginationFromCache']);

Route::get('/users-from-db', [UserController::class, 'getUsersFromDB']);
Route::get('/users-from-cache', [UserController::class, 'getUsersFromCache']);
