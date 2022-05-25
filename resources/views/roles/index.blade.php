
@extends('layouts.app')


@section('content')
<div id="main">
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-sm-left">
            <h2>Role Management</h2>
        </div>
        <div class="float-sm-right">
        @can('role-create')
            <a class="btn btn-success" href="{{ route('roles.create') }}"> Create New Role</a>
            @endcan
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif


<table class="table table-bordered">
  <tr>
     <th width="10%">No</th>
     <th>Name</th>
     <th width="280px">Action</th>
  </tr>
    @foreach ($roles as $role)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $role->name }}</td>
        <td>
            <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Show</a>
            @can('role-edit')
                <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>
            @endcan
            @can('role-delete')
                Delete
            @endcan
        </td>
    </tr>
    @endforeach
</table>


{!! $roles->render() !!}

</div>
@endsection