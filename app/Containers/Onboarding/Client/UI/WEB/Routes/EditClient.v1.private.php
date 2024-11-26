<?php

use App\Containers\Onboarding\Client\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('onboarding/nasabah/{id}/edit', [Controller::class, 'edit'])
    ->middleware(['auth:web']);

