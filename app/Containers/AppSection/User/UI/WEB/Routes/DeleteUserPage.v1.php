<?php

use App\Containers\AppSection\User\Models\User;
use App\Containers\AppSection\User\UI\WEB\Controllers\DeleteUserController;
use Illuminate\Support\Facades\Route;

Route::get('delete-user/{id}', DeleteUserController::class)
    ->name('delete-page')
    ->middleware(['auth:web','role:admin']);

Route::get('restore-user/{id}', function($id){
    User::withTrashed()->find($id)->restore();
    return redirect(route('user-page'));
})->name('restore-page')

->middleware(['auth:web','role:admin']);