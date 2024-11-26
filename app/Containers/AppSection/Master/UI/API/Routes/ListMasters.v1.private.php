<?php

/**
 * @apiGroup           Master
 * @apiName            ListMasters
 *
 * @api                {GET} /v1/masters List Masters
 * @apiDescription     Endpoint description here...
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated ['permissions' => '', 'roles' => '']
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiParam           {String} parameters here...
 *
 * @apiSuccessExample  {json} Success-Response:
 * HTTP/1.1 200 OK
 * {
 *     // Insert the response of the request here...
 * }
 */

use App\Containers\AppSection\Master\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('masters/list/province', [Controller::class, 'listProvince'])
    ->middleware(['auth:api']);

Route::get('masters/list/district', [Controller::class, 'listDistrict'])
    ->middleware(['auth:api']);

Route::get('masters/list/regency', [Controller::class, 'listRegency'])
    ->middleware(['auth:api']);

Route::get('masters/list/village', [Controller::class, 'listVillage'])
    ->middleware(['auth:api']);
