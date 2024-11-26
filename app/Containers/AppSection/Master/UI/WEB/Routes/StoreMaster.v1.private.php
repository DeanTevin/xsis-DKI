<?php

use App\Containers\AppSection\Master\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::post('masters/store', [Controller::class, 'store'])
    ->middleware(['auth:web']);

