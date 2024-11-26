<?php

use App\Containers\AppSection\User\UI\WEB\Controllers\UpdateUserPageController;
use App\Containers\AppSection\User\UI\WEB\Controllers\UpdateUserController;
use Illuminate\Support\Facades\Route;

Route::get('update-user/{id}', UpdateUserPageController::class)
    ->name('update-user-page')
    ->middleware(['auth:web','role:admin']);

Route::post('update-user-control/{id}', UpdateUserController::class)
    ->name('update-user-control')
    ->middleware(['auth:web','role:admin']);