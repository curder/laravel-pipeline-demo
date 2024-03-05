<?php

use App\Http\Controllers\Api\UsersController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get("users", [UsersController::class, 'index'])->name('users.index');
