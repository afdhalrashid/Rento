@extends('layouts.app')


@section('content')
    <div id="main">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Edit New User</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ url()->previous() }}"> Back</a>
                </div>
            </div>
        </div>


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

        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @method('PUT')
            @csrf
            {{-- {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!} --}}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $user->name }}">
                        {{-- {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!} --}}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Email:</strong>
                        <input type="email" name="email" class="form-control" placeholder="Email"
                            value="{{ $user->email }}">

                        {{-- {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!} --}}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>No telefon:</strong>
                        <input type="number" name="phone_no" class="form-control" placeholder="Nombor telefon"
                            value="{{ $user->phone_no }}">
                    </div>
                </div>
                {{-- <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Password:</strong>
            <input type="password" name="password" class="form-control" placeholder="Password" >

        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Confirm Password:</strong>
            <input type="password" name="confirm-password" class="form-control" placeholder="Name" >

        </div>
    </div> --}}
                @role('Staf|Owner')
                <div class="col-xs-5 col-sm-5 col-md-5">
                    <div class="form-group">
                        <strong>Tarikh mula @hasanyrole('Admin|Staf') langganan @endhasanyrole @hasanyrole('Owner') sewa
                            @endhasanyrole:</strong>

                        <input type="text" placeholder="Pilih tarikh" name="date_subscribe"
                            class="form-control datepicker px-3" value="{{ $user->date_subscribe }}">


                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <div class="form-group">
                        <strong>Tempoh @hasanyrole('Admin|Staf') langganan @endhasanyrole @hasanyrole('Owner') sewa
                            @endhasanyrole (bulan):</strong>
                        <input type="number" name="period_before_end_subscribe" class="form-control"
                            placeholder="Bilangan bulan" value="{{ $user->period_before_end_subscribe }}">

                        {{-- {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!} --}}
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <div class="form-group">
                        <strong>Tarikh tamat @hasanyrole('Admin|Staf') langganan @endhasanyrole @hasanyrole('Owner') sewa
                            @endhasanyrole:</strong>

                        <input disabled type="text" placeholder="Pilih tarikh" name="date_expired"
                            class="form-control datepicker px-3" value="{{ $user->date_expired }}">


                    </div>
                </div>
                @endrole
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Role:</strong>

                        <select name="roles[]" class="form-control">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" @if ($userRole == $role->id) selected @endif>{{ $role->name }}</option>
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
        {{-- {!! Form::close() !!} --}}

    </div>


@endsection

@section('js')
    <script>
        $('.datepicker').datepicker({
            clearBtn: true,
            format: "dd/mm/yyyy"
        });
    </script>

@endsection
