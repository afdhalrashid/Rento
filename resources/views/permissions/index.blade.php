
@extends('layouts.app')


@section('content')
<div id="main">
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-sm-left">
            <h2>Permission Management</h2>
        </div>
        <div class="float-sm-right">
            <a class="btn btn-success btn-sm" href="{{ route('permissions.create') }}"> Create New Permission</a>
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
    @foreach ($permissions as $key => $permission)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $permission->name }}</td>
        <td>
            <a class="btn btn-info btn-sm" href="{{ route('permissions.show',$permission->id) }}">Show</a>
            {{-- @can('permission-edit') --}}
                <a class="btn btn-primary btn-sm" href="{{ route('permissions.edit',$permission->id) }}">Edit</a>
            {{-- @endcan --}}
            {{-- @can('permission-delete') --}}
            <button type="button" class="btn btn-danger btn-sm"
                onclick="loadDeleteModal('{{ $permission->id }}','{{$permission->name}}')">Hapus
            </button>
            {{-- @endcan --}}
        </td>
    </tr>
    @endforeach
</table>


{{-- {!! $permissions->render() !!} --}}
 {!! $permissions->links("pagination::bootstrap-4") !!}

</div>
<!-- Modal -->
<div class="modal fade" id="modal_delete_house2" data-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Adakah anda pasti ingin hapus maklumat ini?</h5>

        </div>
        <div class="modal-body">
          <div id="maklumat_owner"></div>
          <input type="hidden" name="house_id" id="house_id">
        </div>
        <div class="modal-footer">
              <div class="msg" style="position:absolute;float: left;left:0.6rem;color:rgba(4, 124, 40, 0.9)"></div>
              <div class="float-right">
                  <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>


                  <button type="submit" id="modal-confirm_delete" class="btn btn-danger btn-sm">HAPUS</button>
              </div>

        </div>
        <div class="modal-message" style="display: none;">

        </div>
      </div>
    </div>
  </div>
  {{-- End --}}
@endsection

@section('js')
    <script>
        $('#modal_delete_house2').on('show.bs.modal', function (event) {
            $('#modal_delete_house2 .msg').text('');
            $('#modal_delete_house2 .msg').hide();
        });
        function loadDeleteModal(id, name) {
        $('#modal_delete_house2 .modal-title').text('Anda pasti untuk hapus pemilik rumah di bawah: ');
        $('#modal_delete_house2 .modal-body #maklumat_owner').html('<p>Nama Permission: '+ name +'</p>');
        $('#modal_delete_house2 #modal-confirm_delete').attr('onclick', 'confirmDelete('+id+')');
        $('#modal_delete_house2').modal('show');
    }

    function confirmDelete(id) {
        console.log(id);
        $('#modal_delete_house2 .msg').text('');
        $('#modal_delete_house2 .msg').hide();

        // return;
        $.ajax({
            url: '{{ url('permissions') }}/' + id,
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                '_method': 'delete',
            },
            success: function (data) {
                console.log(data);
                $('#modal_delete_house2 .msg').text(data.success);
                // $('#modal_delete_house2 .modal-message').append($('<div>', {
                //     text: data.success
                // }));
                // $('#modal_delete_house2').show();
                // $('#modal_delete_house2 .msg').slideDown("slow");
                // $('#modal_delete_house2 .msg').fadeOut(1500);

                $( "#modal_delete_house2 .msg" ).slideDown( 300 ).delay( 300 ).fadeOut( 400,'swing',closeModal);


            },
            error: function (error) {
                // Error logic goes here..!
            }
        });
    }

    function closeModal(){
        $('#modal_delete_house2').delay( 100 ).modal('hide');
        location.reload();
    }

    </script>
@endsection