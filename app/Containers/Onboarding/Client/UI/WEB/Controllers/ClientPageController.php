<?php

namespace App\Containers\Onboarding\Client\UI\WEB\Controllers;

use App\Containers\AppSection\Master\Data\Repositories\MasterOccupationsRepository;
use App\Containers\AppSection\Master\Models\MasterProvinces;
use App\Containers\AppSection\Master\Models\MasterRegencies;
use App\Containers\AppSection\User\Data\Repositories\UserRepository;
use App\Containers\Onboarding\Client\Actions\CreateClientAction;
use App\Containers\Onboarding\Client\Actions\DeleteClientAction;
use App\Containers\Onboarding\Client\Actions\FindClientByIdAction;
use App\Containers\Onboarding\Client\Actions\UpdateClientAction;
use App\Containers\Onboarding\Client\Data\Repositories\ClientRepository;
use App\Containers\Onboarding\Client\Notifications\StatusApprovalNotification;
use App\Containers\Onboarding\Client\Tasks\UpdateClientTask;
use App\Containers\Onboarding\Client\UI\WEB\Requests\ClientApprovalRequest;
use App\Containers\Onboarding\Client\UI\WEB\Requests\CreateClientPageRequest;
use App\Containers\Onboarding\Client\UI\WEB\Requests\DeleteClientRequest;
use App\Containers\Onboarding\Client\UI\WEB\Requests\EditClientRequest;
use App\Containers\Onboarding\Client\UI\WEB\Requests\FindClientByIdRequest;
use App\Containers\Onboarding\Client\UI\WEB\Requests\ListClientsRequest;
use App\Containers\Onboarding\Client\UI\WEB\Requests\StoreClientRequest;
use App\Containers\Onboarding\Client\UI\WEB\Requests\UpdateClientRequest;
use App\Ship\Parents\Controllers\WebController;

class ClientPageController extends WebController
{
    public function index(ClientRepository $repository)
    {
        $data = $repository->with('occupation')->paginate(2);
        return view('onboarding@client::client',['data'=>$data]);
    }

    public function show(ClientRepository $repository, $id)
    {
        $data = $repository->where('uuid',$id)->with([
            'occupation',
            'clientAddress',
            'clientAddress.village',
            'clientAddress.village.district',
            'clientAddress.village.district.regency',
            'clientAddress.village.district.regency.province',
        ])->first();
        return view('onboarding@client::client-detail',['client'=>$data]);
    }

    public function create(CreateClientPageRequest $request,MasterOccupationsRepository $repository)
    {
        $occupations = $repository->all();
        $provinces = MasterProvinces::all();
        $regencies = MasterRegencies::all();

        return view('onboarding@client::create', ['data'=>[
            'occupations' => $occupations,
            'provinces' => $provinces,
            'regencies' => $regencies
            ]
        ]);
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

    public function update(ClientApprovalRequest $request, UserRepository $userRepository, $id,$status)
    {
        $data = ['status'=>$status];
        $client = app(UpdateClientTask::class)->run($data,$id);
        $users = $userRepository->whereHas('roles', function ($query) {
            $query->where('name', 'customer-service')->where('guard_name', 'web');
        })->get();
        foreach ($users as $user){
            $user->notify(new StatusApprovalNotification($client));
        }
        return redirect(route('client-page'));
        // ...
    }

    public function destroy(DeleteClientRequest $request, $id)
    {
        $result = app(DeleteClientAction::class)->run($id);
        return redirect(route('client-page'));
        // ...
    }
}
