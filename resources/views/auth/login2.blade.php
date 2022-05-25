<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('img/logo tab browser.ico') }}">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
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

        .layer {
            background-color: rgba(2, 2, 2, 0.118);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .login-box {
            margin-top: 135px;
            height: auto;
            background: #ffffff;
            text-align: center;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
            border-radius: 15px;
        }

        .login-key {
            height: 100px;
            font-size: 80px;
            line-height: 100px;
            background: -webkit-linear-gradient(#27EF9F, #0DB8DE);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .login-title {
            margin-top: 15px;
            text-align: center;
            font-size: 30px;
            letter-spacing: 2px;
            margin-top: 15px;
            font-weight: bold;
            color: #ECF0F5;
        }

        .login-form {
            margin-top: 25px;
            text-align: left;
        }

        input[type=email] {
            background-color: #f1f1f1 !important;
            border: none;
            /* border-bottom: 2px solid #695600; */
            border-top: 0px;
            border-radius: 5px;
            /* font-weight: bold; */
            outline: 0;
            margin-bottom: 20px;
            padding-left: 0.75rem;
            color: #070707;
            letter-spacing: 1px;
            font-size: 16px;

            box-shadow: inset 3px 3px #b9b9b9;
            -moz-box-shadow: inset 3px 3px #b9b9b9;
            -webkit-box-shadow: inset 3px 3px #b9b9b9;
        }

        input[type=password] {
            background-color: #f1f1f1 !important;
            border: none;
            /* border-bottom: 2px solid #deb80d; */
            border-top: 0px;
            /* border-radius: 0px; */
            /* font-weight: bold; */
            outline: 0;
            /* padding-left: 0px; */
            margin-bottom: 20px;
            color: #020202;
            font-size: 16px;
            letter-spacing: 3px;

            box-shadow: inset 3px 3px #b9b9b9;
            -moz-box-shadow: inset 3px 3px #b9b9b9;
            -webkit-box-shadow: inset 3px 3px #b9b9b9;
        }

        .form-group {
            margin-bottom: 40px;
            outline: 0px;
        }

        .form-control:focus {
            border-color: inherit;
            -webkit-box-shadow: none;
            box-shadow: none;
            border-bottom: 2px solid #0DB8DE;
            outline: 0;
            background-color: #f1f1f1;
            color: #142335;
        }

        input:focus {
            outline: none;
            box-shadow: 0 0 0;
        }

        label {
            margin-bottom: 0px;
        }

        .form-control-label {
            font-size: 14px;
            color: #6C6C6C;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .btn-outline-primary {
            border-color: #0DB8DE;
            color: #0DB8DE;
            border-radius: 0px;
            font-weight: bold;
            letter-spacing: 1px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
        }

        .btn-outline-primary:hover {
            background-color: #0DB8DE;
            right: 0px;
        }

        .login-btm {
            float: left;
            width: 70%;
            /* background-color: #ffce49; */
            color: #051b25;
        }

        .login-button {
            padding-right: 0px;
            text-align: right;
            margin-bottom: 15px;
        }

        .login-text {
            text-align: left;
            padding-left: 0px;
            color: #A2A4A4;
        }

        .loginbttm {
            padding: 0px;
        }

        .btn-large {
            padding: 0.3rem 1rem;
            font-size: 2.125rem;
            line-height: 1.5;
            border-radius: 0.7rem;
            letter-spacing: 5px;
            width: 100%;
            font-weight: bold;
            border-bottom: 2px solid #a16e10;
        }

        .input-group-addon {
            padding: .5rem .75rem;
            margin-bottom: 0;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.2;
            color: #495057;
            text-align: center;
            background-color: #e9ecef;
            border: 1px solid rgba(0, 0, 0, .15);
            border-radius: .25rem;
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
            border-left: 0;
        }

    </style>
</head>

<body>
    <div class="bg">
        <div class="layer">

            <div class="container">
                <div class="row mx-2">
                    <div class="col-lg-3 col-md-2"></div>
                    <div class="col-lg-6 col-md-8 login-box">
                        <div class="col-lg-12 login-key">
                            <div class="d-flex justify-content-center">
                                <div class="" style=" position:absolute; top: -85px; ">
                                    <img src=" {{ asset('img/logo_login.png') }}" alt="" width="170" height="170">

                                </div>
                                <div
                                    style="position:absolute; top: -85px; width: 170px; height: 170px;box-shadow: 20px 20px 30px -6px rgba(0,0,0,0.36); border-radius:50%; ">
                                </div>
                            </div>
                            <i class="fas fas-key" aria-hidden="true"></i>
                        </div>
                        <div class="col-lg-12 login-title">
                            <img src="{{ asset('img/0904 - LP png (18).png') }}" width="250" height="90">
                            <div class="row">
                                <div class="col-md-12 mx-auto text-center mb-3">
                                    <h2 style="padding-bottom: 0; margin-bottm: 0; color: #e0b12d; font-size: 2.5rem;">
                                        Sistem
                                        pengurusan</h2>
                                    <h3 style="margin-top: -15px; padding-top:0; color: #cfaa44;font-size: 2.0rem;">
                                        rumah sewa
                                        digital</h3>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 login-form">
                            <div class="col-lg-12 login-form">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label class="form-control-label">EMEL</label>
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">KATA LALUAN</label>
                                        <div class="input-group" id="show_hide_password">
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="current-password">
                                            <div class="input-group-addon">
                                                <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                            </div>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    @if ($message = Session::get('message'))
                                        <div class="alert alert-danger alert-block">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @endif

                                    <div class="col-lg-12 loginbttm">
                                        <div class="col-lg-12 login-btm login-text">
                                            <!-- Error Message -->
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-lg-12 login-btm login-button">
                                                <button type="submit" class="btn btn-burs-y btn-large">
                                                    {{ __('LOG MASUK') }}
                                                </button>
                                            </div>
                                        </div>
                                        @if (Route::has('password.request'))
                                            <div class="d-flex justify-content-center" style="margin-bottom: 1.5rem;">
                                                <a class="btn btn-link" href="{{ route('password.request') }}"
                                                    style="color: #684402b5; font-size: 0.99rem; text-decoration: underline;">
                                                    {{ __('Terlupa Kata Laluan?') }}
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12" style="padding: 0 0;">
                            <div style="height:30px; border-top: 2px solid #58585849; "></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


</body>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/master.js') }}"></script>
<script src="https://kit.fontawesome.com/533ac5f84b.js" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {


        $("#show_hide_password a").on('click', function(event) {
            event.preventDefault();
            if ($('#show_hide_password input').attr("type") == "text") {
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass("fa-eye-slash");
                $('#show_hide_password i').removeClass("fa-eye");
            } else if ($('#show_hide_password input').attr("type") == "password") {
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass("fa-eye-slash");
                $('#show_hide_password i').addClass("fa-eye");
            }
        });
    });
</script>

</html>
