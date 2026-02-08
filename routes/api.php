<?php

use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\Logout;
use App\Http\Controllers\Auth\Register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::apiResource('posts', PostController::class);

Route::post("/register", Register::class);
Route::post("/login", Login::class);
Route::post("/logout", Logout::class)
->middleware("auth:sanctum");
