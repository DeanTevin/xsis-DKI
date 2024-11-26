<?php

use App\Containers\AppSection\Master\UI\API\Controllers\Controller as ControllersController;
use App\Containers\Onboarding\Client\UI\WEB\Controllers\ClientPageController;
use App\Containers\Onboarding\Client\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('onboarding/nasabah/create', [ClientPageController::class, 'create'])
    ->name('create-nasabah')
    ->middleware(['auth:web']);

Route::post('onboarding/nasabah/create-form-submit', [Controller::class, 'create'])
    ->name('create-nasabah-submit')
    ->middleware(['auth:web']);

