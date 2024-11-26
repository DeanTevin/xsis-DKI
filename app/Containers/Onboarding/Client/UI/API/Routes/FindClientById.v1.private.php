<?php

/**
 * @apiGroup           Client
 * @apiName            FindClientById
 *
 * @api                {GET} /v1/onboarding/nasabah/:id Find Client By Id
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

use App\Containers\Onboarding\Client\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('onboarding/nasabah/{id}', [Controller::class, 'findClientById'])
    ->middleware(['auth:api']);

