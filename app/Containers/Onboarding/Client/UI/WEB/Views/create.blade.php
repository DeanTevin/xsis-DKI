<!DOCTYPE html>
<html lang="en">

<head>
    <title>Boiler</title>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto:300);

        .login-page {
            width: 360px;
            padding: 8% 0 0;
            margin: auto;
        }

        .form {
            position: relative;
            z-index: 1;
            background: #FFFFFF;
            max-width: 360px;
            margin: 0 auto 100px;
            padding: 45px;
            text-align: center;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
        }

        .form input {
            font-family: "Roboto", sans-serif;
            outline: 0;
            background: #f2f2f2;
            width: 100%;
            border: 0;
            margin: 0 0 15px;
            padding: 15px;
            box-sizing: border-box;
            font-size: 14px;
        }

        .form select {
            font-family: "Roboto", sans-serif;
            outline: 0;
            background: #f2f2f2;
            width: 100%;
            border: 0;
            margin: 0 0 15px;
            padding: 15px;
            box-sizing: border-box;
            font-size: 14px;
        }

        .form button {
            font-family: "Roboto", sans-serif;
            text-transform: uppercase;
            outline: 0;
            background: #4CAF50;
            width: 100%;
            border: 0;
            padding: 15px;
            color: #FFFFFF;
            font-size: 14px;
            -webkit-transition: all 0.3s ease;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .form button:hover,
        .form button:active,
        .form button:focus {
            background: #43A047;
        }

        .form .message {
            margin: 15px 0 0;
            color: #b3b3b3;
            font-size: 12px;
        }

        .form .message a {
            color: #4CAF50;
            text-decoration: none;
        }

        .form .register-form {
            display: none;
        }

        h1 {
            margin: 0 0 15px;
            padding: 0;
            font-size: 36px;
            font-weight: 300;
            color: #1a1a1a;
        }

        .center {
            text-align: center;
        }

        body {
            background: #ffffff;
            font-family: "Roboto", sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .text-red {
            color: red;
            margin-bottom: 10px;
        }

        .text-green {
            color: green;
            margin-bottom: 10px;
        }

        .hide {
            display: none;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>

<body>

    <div class="create-user-page">
        <h1 class="center">Register New Client</h1>
        <form class="form" action="{{ route('create-nasabah-submit') }}" method="post">
            @csrf
            <label class="hide" for="name">Name</label>
            <input type="text" placeholder="Name" id="name" name="name" />
            <span class="text-red">{{ $errors->first('name') }}</span>
            </br>
            <label class="hide" for="annualDeposit">Annual Deposit</label>
            <input type="number" placeholder="Annual Deposit" id="annualDeposit" name="annualDeposit" />
            <span class="text-red">{{ $errors->first('annualDeposit') }}</span>
            </br>
            <label class="hide" for="birthPlace">Birthplace</label>
            <input type="text" placeholder="Birthplace" id="birthPlace" name="birthPlace" />
            <span class="text-red">{{ $errors->first('birthPlace') }}</span>
            </br>
            <label for="birthDate">Birthdate</label>
            <input type="date" placeholder="Birthdate" id="birthDate" name="birthDate" />
            <span class="text-red">{{ $errors->first('birthDate') }}</span>
            </br>
            <label class="hide" for="gender">Gender</label>
            <select class="js-example-basic-single" placeholder="gender" id="gender" name="gender">
                <option value="M">Male</option>
                <option value="F">Female</option>
            </select>
            </br>
            <span class="text-red">{{ $errors->first('gender') }}</span>
            </br>
            <label class="hide" for="occupation_id">Occupation</label>
            <select class="js-example-basic-single" placeholder="occupation" id="occupation_id" name="occupation_id">
                @foreach ($data['occupations'] as $occupation)
                <option value="{{$occupation->id}}">{{$occupation->occupation}}</option>
                @endforeach
            </select>
            </br>
            <span class="text-red">{{ $errors->first('occupation_id') }}</span>
            </br>
            <label class="hide" for="province">province</label>
            <select class="js-example-basic-single" placeholder="Select a province" id="province" name="province">
                <option value="" disabled selected>Select Province</option>
                @foreach ($data['provinces'] as $province)
                <option value="{{$province->id}}">{{$province->province}}</option>
                @endforeach
            </select>
            </br>
            <span class="text-red">{{ $errors->first('province') }}</span>
            </br>
            <label class="hide" for="regencies">regencies</label>
            <select class="js-example-basic-single" placeholder="Select a regency" disabled id="regency" name="regency">
                <option value="" disabled selected>Select Regency</option>
            </select>
            </br>
            <span class="text-red">{{ $errors->first('regency') }}</span>
            </br>
            <label class="hide" for="district">districts</label>
            <select class="js-example-basic-single" placeholder="Select a district" disabled id="district" name="district">
                <option value="" disabled selected>Select Districts</option>
            </select>
            </br>
            <span class="text-red">{{ $errors->first('district') }}</span>
            </br>
            <label class="hide" for="village">villages</label>
            <select class="js-example-basic-single" placeholder="Select a village" disabled id="village" name="village">
                <option value="" disabled selected>Select Villages</option>
            </select>
            </br>
            <span class="text-red">{{ $errors->first('village') }}</span>
            </br>
            <label class="hide" for="address">Address</label>
            <textarea placeholder="address" id="address" name="address" rows="4" cols="50" style="resize:vertical;" disabled></textarea>
            <span class="text-red">{{ $errors->first('address') }}</span>
            </br>
            <span class="text-green">{{ session('success') }}</span>
            </br>
            <button>create</button>
        </form>
    </div>
</body>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });

    // Province dropdown change
    $('#province').on('change', function() {
        const provinceId = $(this).val();
        const $regency = $('#regency');

        if (!provinceId) {
            $regency.prop('disabled', true).html('<option value="" disabled selected>Select Regency</option>');
            return;
        }

        // Fetch regencies dynamically
        $.ajax({
            url: `/master/regencies/${provinceId}`, // Adjust to your route
            type: 'GET',
            success: function(data) {
                $regency.prop('disabled', false).html('<option value="" disabled selected>Select Regency</option>');
                $.each(data, function(key, regency) {
                    $regency.append(`<option value="${regency.id}">${regency.regency}</option>`);
                });
            },
            error: function() {
                alert('Unable to fetch regencies. Please try again later.');
            }
        });
    });

    // Regency dropdown change
    $('#regency').on('change', function () {
        const regencyId = $(this).val();
        const $district = $('#district');

        if (!regencyId) {
            $district.prop('disabled', true).html('<option value="" disabled selected>Select District</option>');
            return;
        }

        // Fetch districts dynamically
        $.ajax({
            url: `/master/districts/${regencyId}`, // Adjust to your route
            type: 'GET',
            success: function (data) {
                $district.prop('disabled', false).html('<option value="" disabled selected>Select District</option>');
                $.each(data, function (key, district) {
                    $district.append(`<option value="${district.id}">${district.district}</option>`);
                });
            },
            error: function () {
                alert('Unable to fetch districts. Please try again later.');
            }
        });
    });

    // District dropdown change
    $('#district').on('change', function () {
        const districtId = $(this).val();
        const $village = $('#village');

        if (!districtId) {
            $village.prop('disabled', true).html('<option value="" disabled selected>Select Village</option>');
            return;
        }

        // Fetch village dynamically
        $.ajax({
            url: `/master/villages/${districtId}`, // Adjust to your route
            type: 'GET',
            success: function (data) {
                $village.prop('disabled', false).html('<option value="" disabled selected>Select Village</option>');
                $.each(data, function (key, village) {
                    $village.append(`<option value="${village.id}">${village.village}</option>`);
                });
            },
            error: function () {
                alert('Unable to fetch districts. Please try again later.');
            }
        });
    });

    // District dropdown change
    $('#village').on('change', function () {
        const villageId = $(this).val();
        const $address = $('#address');

        if (!villageId) {
            $address.prop('disabled', true);
            return;
        }else{
            $address.prop('disabled', false)
        }
    });


</script>

</html>