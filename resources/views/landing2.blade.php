<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            background: #222D32;
            font-family: 'Roboto', sans-serif;
        }

        body,
        html {
            height: 100%;
            margin: 0;
        }

        .bg {
            /* The image used */
            background-image: url('{{ asset('img/Log In bc2.jpg') }}');

            /* Full height */
            height: 100%;

            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

    </style>

</head>

<body>
    <div class="bg">
        <div class="container mt-5 text-center">
            <div class="jumbotron bg-light">
                <img src="{{ asset('img/0904 - LP png (18).png') }}" alt="" style="width:70%; height: 230px;">
            </div>
            <h1>My First Bootstrap Page</h1>
            <p>This is some text.</p>
            <div class="row">
                <div class="col-md-8 mx-auto text-center">
                    <h3>Me Too!</h3>
                </div>
            </div>
            <div class="row">
                <div class="w-50 mx-auto">
                    <h3>Me Three!</h3>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
