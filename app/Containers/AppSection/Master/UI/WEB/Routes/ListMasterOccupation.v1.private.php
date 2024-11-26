<?php

use App\Containers\AppSection\Master\Models\MasterDistricts;
use App\Containers\AppSection\Master\Models\MasterOccupations;
use App\Containers\AppSection\Master\Models\MasterRegencies;
use App\Containers\AppSection\Master\Models\MasterVillages;
use App\Containers\AppSection\Master\UI\WEB\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('master/regencies/{id}', function($id){
    $regencies = MasterRegencies::whereProvinceId($id)->get();
    return response()->json($regencies);
})->middleware(['auth:web']);

Route::get('master/districts/{id}', function($id){
    $regencies = MasterDistricts::whereRegencyId($id)->get();
    return response()->json($regencies);
})->middleware(['auth:web']);

Route::get('master/villages/{id}', function($id){
    $regencies = MasterVillages::whereDistrictId($id)->get();
    return response()->json($regencies);
})->middleware(['auth:web']);