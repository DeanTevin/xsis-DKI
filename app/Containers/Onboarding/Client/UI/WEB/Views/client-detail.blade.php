<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Boiler</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 18px;
            top: 18px;
        }

        .content {
            text-align: center;
            width: 100%;
        }

        .title {
            font-size: 150px;
            color: #00bdf4;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .button {
            border: 1px solid #00bdf4;
            width: 60px;
            height: 30px;
            border-radius: 5px;
            color: #00bdf4;
            background-color: white;
            line-height: 30px;
            font-size: 14px;
            text-decoration: none;
            font-weight: bold;
        }

        .button:hover {
            color: white;
            background-color: #00bdf4;
            cursor: pointer;
        }

        hr.rounded {
            border-top: 1px solid #00bdf4;
            border-radius: 50px;
        }

        .text-green {
            color: green;
            margin-bottom: 10px;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.2/css/dataTables.dataTables.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.2/js/dataTables.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="flex-center position-ref full-height">
        <div class="content" style="width:80%;">
            @guest
            <a href="{{ route('login-page') }}" class="top-right button">Login</a>
            @endguest

            @auth('web')
            <form id="form" action="{{ route('logout') }}" method="POST">@csrf</form>
            <a class="top-right button" href="javascript:void(0)" onclick="document.getElementById('form').submit()">Logout</a>
            @endauth

            <div class="title m-b-md">ONBOARDING</div>

            <div class="bd-example m-0 border-0">
                <span>This is private repo Boilerplate by Tevin.</span>
            </div>

            <hr class="rounded m-b-md">
            <span class="text-green">{{ session('success') }}</span>


            <div class="card border-primary mb-3">
                <div class="card-header border-primary text-bg-primary">
                    <h4 class="card-title">Client ID: {{$client->uuid}}</h5>
                </div>
                <div class="card-body" style="text-align: justify;">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="card-title text-decoration-underline text-primary-emphasis">Background Information</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Name: {{$client->name}}</li>
                                <li class="list-group-item">Birth Place: {{$client->birthPlace}}</li>
                                <li class="list-group-item">Birth Date: {{$client->birthDate}}</li>
                                <li class="list-group-item">Gender: {{$client->gender}}</li>
                                <li class="list-group-item">Occupation: {{$client->occupation->occupation}}</li>
                                <li class="list-group-item">Annual Deposit: {{$client->annualDeposit}}</li>
                                <li class="list-group-item">Created At: {{$client->created_at}}</li>
                            </ul>
                        </div>
                        <div class="col-sm-6">
                            <ul class="list-group list-group-flush">
                                <h5 class="card-title text-decoration-underline text-primary-emphasis">Domicile Information</h5>
                                <li class="list-group-item">Province: {{$client->clientAddress->village->district->regency->province->province}}</li>
                                <li class="list-group-item">Regency: {{$client->clientAddress->village->district->regency->regency}}</li>
                                <li class="list-group-item">District: {{$client->clientAddress->village->district->district}}</li>
                                <li class="list-group-item">Village: {{$client->clientAddress->village->village}}</li>
                                <li class="list-group-item"> Address:
                                    <p class="text-secondary-emphasis bg-dark">
                                        {{$client->clientAddress->address}}
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-primary">
                        <div class="row">
                            <div class="col-sm-6" style="text-align: left;">
                                <div class="py-3 fw-bold h5" style="color: var(--bs-warning-text-emphasis);">
                                    Status: Pending
                                </div>
                            </div>
                            <div class="col-sm-6 py-3" style="text-align: right;">
                                <button class="btn btn-success" onclick='handleApprove("{{$client->uuid}}")'>Approve</button>
                                <button class="btn btn-warning" onclick='handleReject("{{$client->uuid}}")'>Reject</button>
                                <button class="btn btn-danger" onclick='handleDelete("{{$client->uuid}}")'>Delete</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
</body>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            paging: false
        });
    });

    function handleDelete(uuid) {
        window.location = "/onboarding/nasabah/delete/" + uuid
    }

    function handleApprove(uuid) {
        window.location = "/onboarding/status-approval/nasabah/" +uuid+ "/Approved" 
    }

    function handleReject(uuid) {
        window.location = "/onboarding/status-approval/nasabah/" +uuid+ "/Rejected"
    }
</script>

</html>