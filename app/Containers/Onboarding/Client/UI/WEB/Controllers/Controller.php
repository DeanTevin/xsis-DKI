<?php

namespace App\Containers\Onboarding\Client\UI\WEB\Controllers;

use App\Containers\Onboarding\Client\Actions\CreateClientAction;
use App\Containers\Onboarding\Client\Actions\DeleteClientAction;
use App\Containers\Onboarding\Client\Actions\FindClientByIdAction;
use App\Containers\Onboarding\Client\Actions\ListClientsAction;
use App\Containers\Onboarding\Client\Actions\UpdateClientAction;
use App\Containers\Onboarding\Client\UI\WEB\Requests\CreateClientRequest;
use App\Containers\Onboarding\Client\UI\WEB\Requests\DeleteClientRequest;
use App\Containers\Onboarding\Client\UI\WEB\Requests\EditClientRequest;
use App\Containers\Onboarding\Client\UI\WEB\Requests\FindClientByIdRequest;
use App\Containers\Onboarding\Client\UI\WEB\Requests\ListClientsRequest;
use App\Containers\Onboarding\Client\UI\WEB\Requests\StoreClientRequest;
use App\Containers\Onboarding\Client\UI\WEB\Requests\UpdateClientRequest;
use App\Ship\Parents\Controllers\WebController;

class Controller extends WebController
{
    public function index(ListClientsRequest $request)
    {
        $clients = app(ListClientsAction::class)->run($request);
        // ...
    }

    public function show(FindClientByIdRequest $request)
    {
        $client = app(FindClientByIdAction::class)->run($request);
        // ...
    }

    public function create(CreateClientRequest $request)
    {
        $array = $request->sanitizeInput([
            'name',
            'gender',
            'birthPlace',
            'birthDate',
            'occupation_id',
            'annualDeposit',
            'village',
            'address',
        ]);   

        $client = app(CreateClientAction::class)->run($array); 
        if(!empty($client)){
            $response = "BERHASIL Menambah Data Nasabah!";
        }
        
        return back()->withSuccess($response,200);
    }

    public function store(StoreClientRequest $request)
    {
        $client = app(CreateClientAction::class)->run($request);
        // ...
    }

    public function edit(EditClientRequest $request)
    {
        $client = app(FindClientByIdAction::class)->run($request);
        // ...
    }

    public function update(UpdateClientRequest $request)
    {
        $client = app(UpdateClientAction::class)->run($request);
        // ...
    }

    public function destroy(DeleteClientRequest $request)
    {
        $result = app(DeleteClientAction::class)->run($request);
        // ...
    }
}
