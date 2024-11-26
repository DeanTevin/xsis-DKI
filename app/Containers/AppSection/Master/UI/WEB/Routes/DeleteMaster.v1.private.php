<?php

use App\Containers\AppSection\Master\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::delete('masters/{id}', [Controller::class, 'destroy'])
    ->middleware(['auth:web']);

