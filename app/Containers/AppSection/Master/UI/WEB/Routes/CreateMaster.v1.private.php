<?php

use App\Containers\AppSection\Master\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('masters/create', [Controller::class, 'create'])
    ->middleware(['auth:web']);

