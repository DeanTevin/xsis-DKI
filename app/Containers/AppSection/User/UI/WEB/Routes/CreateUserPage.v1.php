<?php

use App\Containers\AppSection\User\UI\WEB\Controllers\CreateUserController;
use App\Containers\AppSection\User\UI\WEB\Controllers\CreateUserPageController;
use Illuminate\Support\Facades\Route;

Route::get('create-user', CreateUserPageController::class)
    ->name('create-user-page')
    ->middleware(['auth:web','role:admin']);

Route::post('create-user-control', CreateUserController::class)
    ->name('create-user-control')
    ->middleware(['auth:web','role:admin']);