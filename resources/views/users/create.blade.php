@extends('layouts.app')

@section('css')
    <style>
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
@endsection

@section('content')
    <div id="main">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="float-sm-left">
                    <h2>Tambah Pengguna</h2>
                </div>
                <div class="float-sm-right">
                    <a class="btn btn-primary" href="{{ url()->previous() }}"> Back</a>
                </div>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif


        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Nama:</strong>
                        <input type="text" name="name" class="form-control" placeholder="Nama"
                            value="{{ old('name') }}">
                        {{-- {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!} --}}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Emel:</strong>
                        <input type="email" name="email" class="form-control" placeholder="Emel"
                            value="{{ old('email') }}">

                        {{-- {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!} --}}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>No telefon:</strong>
                        <input type="number" name="phone_no" class="form-control" placeholder="Nombor telefon"
                            value="{{ old('phone_no') }}">

                        {{-- {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!} --}}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Kata laluan:</strong>
                        <div class="input-group" id="show_hide_password">
                            <input type="password" name="password" class="form-control" placeholder="Kata laluan"
                                value="{{ old('password') }}">
                            <div class="input-group-addon">
                                <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Sahkan kata laluan:</strong>
                        <div class="input-group" id="show_hide_confirmpassword">
                            <input type="password" name="confirm-password" class="form-control"
                                placeholder="Taip semula kata laluan">
                            <div class="input-group-addon">
                                <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                @hasanyrole('Super Admin|Admin|Staf|Owner')
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Tarikh mula @hasanyrole('Super Admin|Admin|Staf') aktif @endhasanyrole @hasanyrole('Owner') aktif
                            @endhasanyrole:</strong>

                        <input type="text" placeholder="Pilih tarikh" name="date_subscribe"
                            class="form-control datepicker px-3" value="{{ old('date_subscribe') }}">


                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Tempoh @hasanyrole('Super Admin|Admin|Staf') aktif @endhasanyrole @hasanyrole('Owner') aktif
                            @endhasanyrole (bulan):</strong>
                        <input type="number" name="period_before_end_subscribe" class="form-control"
                            placeholder="Bilangan bulan" value="{{ old('period_before_end_subscribe') }}">

                        {{-- {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!} --}}
                    </div>
                </div>
                @endrole
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Peranan:</strong>

                        <select name="roles[]" class="form-control">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        {{-- {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!} --}}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>


    @endsection

    @section('js')
        <script>
            $('.datepicker').datepicker({
                clearBtn: true,
                format: "dd/mm/yyyy"
            });

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

            $("#show_hide_confirmpassword a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_confirmpassword input').attr("type") == "text") {
                    $('#show_hide_confirmpassword input').attr('type', 'password');
                    $('#show_hide_confirmpassword i').addClass("fa-eye-slash");
                    $('#show_hide_confirmpassword i').removeClass("fa-eye");
                } else if ($('#show_hide_confirmpassword input').attr("type") == "password") {
                    $('#show_hide_confirmpassword input').attr('type', 'text');
                    $('#show_hide_confirmpassword i').removeClass("fa-eye-slash");
                    $('#show_hide_confirmpassword i').addClass("fa-eye");
                }
            });
        </script>

    @endsection
