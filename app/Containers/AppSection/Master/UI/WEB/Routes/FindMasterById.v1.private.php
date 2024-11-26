<?php

use App\Containers\AppSection\Master\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('masters/{id}', [Controller::class, 'show'])
    ->middleware(['auth:web']);

