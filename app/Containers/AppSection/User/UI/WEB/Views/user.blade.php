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
        html, body {
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
        }

        .title {
            font-size: 150px;
            color: #00bdf4;
        }

        .links > a {
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

            <div class="title m-b-md">USERS</div>

            <div class="bd-example m-0 border-0">
                <span>This is private repo Boilerplate by Tevin.
                    <a class="btn btn-success" style="margin-left: 1%;" href="{{route('create-user-page')}}">Create User</a> 
                    <a class="btn btn-secondary" style="margin-left: 1%;" href="{{route('blocked-user-page')}}">Blocked User</a> 
                </span>
            </div>

            <hr class="rounded m-b-md">
            <span class="text-green">{{ session('success') }}</span>
            <table id="myTable" class="display">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Ctime</th>
                        <th>Fungsi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($data as $user)
                    <tr>
                        <td>{{$user->username}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->password}}</td>
                        <td>{{$user->created_at}}</td>
                        <td><button onclick="handleEdit({{$user->id}})">edit</button>
                        @if($user->id != auth()->user()->id)
                        <button onclick="handleDelete({{$user->id}})">delete</button></td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$data->links()}}
        </div>
    </div>
</body>
<script>
    $(document).ready( function () {
    $('#myTable').DataTable(
        {paging: false}
    );
} );

function handleDelete(id){
    window.location = "delete-user/"+id
}

function handleEdit(id){
    window.location = "update-user/"+id
}
</script>
</html>
