<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UsersController;

Route::get('users', UsersController::class)->name('users.index');
