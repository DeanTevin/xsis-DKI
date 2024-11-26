<?php

use App\Containers\AppSection\Master\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::patch('masters/{id}', [Controller::class, 'update'])
    ->middleware(['auth:web']);

