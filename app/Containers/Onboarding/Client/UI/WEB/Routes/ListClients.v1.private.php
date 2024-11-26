<?php

use App\Containers\Onboarding\Client\UI\WEB\Controllers\ClientPageController;
use Illuminate\Support\Facades\Route;

Route::get('onboarding/list/nasabah/', [ClientPageController::class, 'index'])
    ->name('client-page')
    ->middleware(['auth:web']);

