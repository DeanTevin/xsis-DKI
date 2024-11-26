<?php

use App\Containers\Onboarding\Client\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::post('onboarding/nasabah/store', [Controller::class, 'store'])
    ->middleware(['auth:web']);

