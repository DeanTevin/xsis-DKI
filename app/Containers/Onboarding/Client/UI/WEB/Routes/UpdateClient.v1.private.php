<?php

use App\Containers\Onboarding\Client\UI\WEB\Controllers\ClientPageController;
use Illuminate\Support\Facades\Route;

Route::get('onboarding/status-approval/nasabah/{id}/{status}', [ClientPageController::class, 'update'])
    ->middleware(['auth:web']);

