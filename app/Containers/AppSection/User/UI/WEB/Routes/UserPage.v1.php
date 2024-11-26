<?php

use App\Containers\AppSection\User\UI\WEB\Controllers\BlockedUserPageController;
use App\Containers\AppSection\User\UI\WEB\Controllers\UserPageController;
use Illuminate\Support\Facades\Route;

Route::get('user-page', UserPageController::class)
    ->name('user-page')
    ->middleware(['auth:web','role:admin']);

Route::get('blocked-user-page', BlockedUserPageController::class)
    ->name('blocked-user-page')
    ->middleware(['auth:web','role:admin']);