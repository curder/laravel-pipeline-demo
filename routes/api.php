<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UsersController;

Route::get('users', UsersController::class)->name('users.index');
