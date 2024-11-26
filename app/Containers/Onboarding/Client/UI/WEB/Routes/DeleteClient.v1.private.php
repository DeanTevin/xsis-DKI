<?php

use App\Containers\Onboarding\Client\UI\WEB\Controllers\ClientPageController;
use App\Containers\Onboarding\Client\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('onboarding/nasabah/delete/{id}', [ClientPageController::class, 'destroy'])
    ->middleware(['auth:web']);

