<?php

declare(strict_types=1);

use App\Http\Controllers\Api\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('users', UsersController::class)->name('users.index');
