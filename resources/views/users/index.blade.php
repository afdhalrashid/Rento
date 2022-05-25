@extends('layouts.app')

@section('css')
    <link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        .dataTables_filter {
            float: right !important;
        }

        .dataTables_paginate {
            float: right !important;
        }

    </style>
@endsection

@section('content')
    <div id="main">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="float-sm-left">
                    @if (strpos(Request::url(), '/users/staf') !== false)
                        <h2>Pengurusan Admin/Staf</h2>
                    @elseif (strpos(Request::url(), '/users/owner') !== false)
                        <h2>Pengurusan Pemilik Rumah</h2>
                    @elseif (strpos(Request::url(), '/user/tenant') !== false)
                        <h2>Pengurusan Penyewa</h2>
                    @endif
                </div>
                <div class="float-sm-right">
                    <a class="btn btn-success btn-sm" href="{{ route('users.create') }}">@hasanyrole('Owner') Tambah Penyewa @else Tambah Pengguna @endhasanyrole</a>
                </div>
            </div>
        </div>


        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <section class="section mt-2">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"></h4>
                        </div>
                        <div class="card-body" style="overflow-x: auto;">
                            <table id="table_list_user" class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Emel</th>
                                        <th>No Telefon</th>
                                        @if (!Request::is('users/staf'))
                                            <th>Mula @hasanyrole('Admin|Staf')  @endhasanyrole
                                                @hasanyrole('Owner') Sewa
                                                @endhasanyrole
                                            </th>

                                            <th>Tamat @hasanyrole('Admin|Staf')  @endhasanyrole
                                                @hasanyrole('Owner') Sewa
                                                @endhasanyrole</th>
                                        @endif
                                        <th>Peranan</th>
                                        <th width="280px">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 0; @endphp
                                    @foreach ($data as $key => $user)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>
                                                @if (count($user->houses) > 0)
                                                    <a href="/house/user/{{ $user->id }}">{{ $user->name }}</a>

                                                @else
                                                    {{ $user->name }}
                                                @endif
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone_no }}</td>
                                            @if (!Request::is('users/staf'))
                                                <td>{{ $user->date_subscribe }}</td>
                                                <td>{{ $user->date_expired }}</td>
                                            @endif
                                            <td>
                                                @if (!empty($user->getRoleNames()))
                                                    @foreach ($user->getRoleNames() as $v)
                                                        <label class="badge badge-success">{{ $v }}</label>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>
                                                {{-- <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a> --}}
                                                <a class="btn btn-primary btn-sm"
                                                    href="{{ route('users.edit', $user->id) }}" title="Kemaskini"><i
                                                        class="fa fa-pencil" aria-hidden="true"></i></a>
                                                <a class="btn btn-danger btn-sm" title="Hapus"
                                                    onclick="loadDeleteModal('{{ $user->id }}','{{ $user->name }}','{{ $user->email }}')"><i
                                                        class="fas fa-trash-alt"></i></a>
                                                {{-- @if (!empty($user->getRoleNames()))
                                                    @foreach ($user->getRoleNames() as $v)
                                                        @if ($v == 'Owner')
                                                            @if ($user->status == 1)
                                                                <a class="btn btn-warning btn-sm"
                                                                    onclick="loadBlockModal('{{ $user->id }}','{{ $user->name }}','{{ $user->email }}')"
                                                                    style="color: black">Nyahaktif</a>
                                                            @else
                                                                <a class="btn btn-warning btn-sm"
                                                                    onclick="loadBlockModal('{{ $user->id }}','{{ $user->name }}','{{ $user->email }}')"
                                                                    style="color: black">Aktifkan</a>
                                                            @endif
                                                        @endif
                                                        @hasanyrole('Super Admin| Admin|Owner')
                                                        <a class="btn btn-warning btn-sm"
                                                            onclick="loadBlockModal('{{ $user->id }}','{{ $user->name }}','{{ $user->email }}')"
                                                            style="color: black">Sekat</a>
                                                        <a class="btn btn-secondary btn-sm mt-1"
                                                            onclick="loadResendEmailModal('{{ $user->id }}','{{ $user->name }}','{{ $user->email }}')"
                                                            style="color: black">Hantar semula emel pengesahan</a>
                                                        @endhasanyrole
                                                    @endforeach
                                                @endif --}}
                                                @hasanyrole('Super Admin|Admin|Owner')
                                                @if ($user->status == 1)
                                                    <a class="btn btn-warning btn-sm" title="Klik untuk sekat"
                                                        onclick="loadBlockModal('{{ $user->id }}','{{ $user->name }}','{{ $user->email }}')"
                                                        style="color: black; font-weight: bold">Aktif</a>
                                                @else
                                                    <a class="btn btn-warning btn-sm" title="Klik untuk aktif semula"
                                                        onclick="loadActiveModal('{{ $user->id }}','{{ $user->name }}','{{ $user->email }}')"
                                                        style="color: rgb(94, 94, 94)">Tidak Aktif</a>
                                                @endif
                                                <a class="btn btn-light btn-sm mt-1" title="Hantar semula emel pengesahan"
                                                    onclick="loadResendEmailModal('{{ $user->id }}','{{ $user->name }}','{{ $user->email }}')"
                                                    style="color: black"><i class="far fa-paper-plane"></i></a>
                                                @endhasanyrole

                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php /* <div class="row" style="overflow-x: auto;">
                                                                                                                                                                                                                                                            <table id="table_list_user" class="table">
                                                                                                                                                                                                                                                                <thead>
                                                                                                                                                                                                                                                                    <tr>
                                                                                                                                                                                                                                                                        <th>No</th>
                                                                                                                                                                                                                                                                        <th>Nama Pengguna</th>
                                                                                                                                                                                                                                                                        <th>Email</th>
                                                                                                                                                                                                                                                                        <th>No telefon</th>
                                                                                                                                                                                                                                                                        @if (!Request::is('users/staf'))
                                                                                                                                                                                                                                                                            <th>Tarikh mula @hasanyrole('Admin|Staf') langganan @endhasanyrole @hasanyrole('Owner') sewa
                                                                                                                                                                                                                                                                                @endhasanyrole
                                                                                                                                                                                                                                                                            </th>

                                                                                                                                                                                                                                                                            <th>Tarikh tamat @hasanyrole('Admin|Staf') langganan @endhasanyrole @hasanyrole('Owner') sewa
                                                                                                                                                                                                                                                                                @endhasanyrole</th>
                                                                                                                                                                                                                                                                        @endif
                                                                                                                                                                                                                                                                        <th>Roles</th>
                                                                                                                                                                                                                                                                        <th width="280px">Action</th>
                                                                                                                                                                                                                                                                    </tr>
                                                                                                                                                                                                                                                                </thead>
                                                                                                                                                                                                                                                                @php $i = 0; @endphp
                                                                                                                                                                                                                                                                @foreach ($data as $key => $user)
                                                                                                                                                                                                                                                                    <tr>
                                                                                                                                                                                                                                                                        <td>{{ ++$i }}</td>
                                                                                                                                                                                                                                                                        <td>
                                                                                                                                                                                                                                                                            @if (count($user->houses) > 0)
                                                                                                                                                                                                                                                                                <a href="/house/user/{{ $user->id }}">{{ $user->name }}</a>

                                                                                                                                                                                                                                                                            @else
                                                                                                                                                                                                                                                                                {{ $user->name }}
                                                                                                                                                                                                                                                                            @endif
                                                                                                                                                                                                                                                                        </td>
                                                                                                                                                                                                                                                                        <td>{{ $user->email }}</td>
                                                                                                                                                                                                                                                                        <td>{{ $user->phone_no }}</td>
                                                                                                                                                                                                                                                                        @if (!Request::is('users/staf'))
                                                                                                                                                                                                                                                                            <td>{{ $user->date_subscribe }}</td>
                                                                                                                                                                                                                                                                            <td>{{ $user->date_expired }}</td>
                                                                                                                                                                                                                                                                        @endif
                                                                                                                                                                                                                                                                        <td>
                                                                                                                                                                                                                                                                            @if (!empty($user->getRoleNames()))
                                                                                                                                                                                                                                                                                @foreach ($user->getRoleNames() as $v)
                                                                                                                                                                                                                                                                                    <label class="badge badge-success">{{ $v }}</label>
                                                                                                                                                                                                                                                                                @endforeach
                                                                                                                                                                                                                                                                            @endif
                                                                                                                                                                                                                                                                        </td>
                                                                                                                                                                                                                                                                        <td>
                                                                                                                                                                                                                                                                            {{-- <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a> --}}
                                                                                                                                                                                                                                                                            <a class="btn btn-primary btn-sm" href="{{ route('users.edit', $user->id) }}"
                                                                                                                                                                                                                                                                                title="Kemaskini"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                                                                                                                                                                                                                                            <a class="btn btn-danger btn-sm" title="Hapus"
                                                                                                                                                                                                                                                                                onclick="loadDeleteModal('{{ $user->id }}','{{ $user->name }}','{{ $user->email }}')"><i
                                                                                                                                                                                                                                                                                    class="fas fa-trash-alt"></i></a>
                                                                                                                                                                                                                                                                            {{-- @if (!empty($user->getRoleNames()))
                                                                                                                                                                                                                                                                                @foreach ($user->getRoleNames() as $v)
                                                                                                                                                                                                                                                                                    @if ($v == 'Owner')
                                                                                                                                                                                                                                                                                        @if ($user->status == 1)
                                                                                                                                                                                                                                                                                            <a class="btn btn-warning btn-sm"
                                                                                                                                                                                                                                                                                                onclick="loadBlockModal('{{ $user->id }}','{{ $user->name }}','{{ $user->email }}')"
                                                                                                                                                                                                                                                                                                style="color: black">Nyahaktif</a>
                                                                                                                                                                                                                                                                                        @else
                                                                                                                                                                                                                                                                                            <a class="btn btn-warning btn-sm"
                                                                                                                                                                                                                                                                                                onclick="loadBlockModal('{{ $user->id }}','{{ $user->name }}','{{ $user->email }}')"
                                                                                                                                                                                                                                                                                                style="color: black">Aktifkan</a>
                                                                                                                                                                                                                                                                                        @endif
                                                                                                                                                                                                                                                                                    @endif
                                                                                                                                                                                                                                                                                    @hasanyrole('Super Admin| Admin|Owner')
                                                                                                                                                                                                                                                                                    <a class="btn btn-warning btn-sm"
                                                                                                                                                                                                                                                                                        onclick="loadBlockModal('{{ $user->id }}','{{ $user->name }}','{{ $user->email }}')"
                                                                                                                                                                                                                                                                                        style="color: black">Sekat</a>
                                                                                                                                                                                                                                                                                    <a class="btn btn-secondary btn-sm mt-1"
                                                                                                                                                                                                                                                                                        onclick="loadResendEmailModal('{{ $user->id }}','{{ $user->name }}','{{ $user->email }}')"
                                                                                                                                                                                                                                                                                        style="color: black">Hantar semula emel pengesahan</a>
                                                                                                                                                                                                                                                                                    @endhasanyrole
                                                                                                                                                                                                                                                                                @endforeach
                                                                                                                                                                                                                                                                            @endif --}}
                                                                                                                                                                                                                                                                            @hasanyrole('Super Admin| Admin|Owner')
                                                                                                                                                                                                                                                                            @if ($user->status == 1)
                                                                                                                                                                                                                                                                                <a class="btn btn-warning btn-sm"
                                                                                                                                                                                                                                                                                    onclick="loadBlockModal('{{ $user->id }}','{{ $user->name }}','{{ $user->email }}')"
                                                                                                                                                                                                                                                                                    style="color: black">Aktif</a>
                                                                                                                                                                                                                                                                            @else
                                                                                                                                                                                                                                                                                <a class="btn btn-warning btn-sm"
                                                                                                                                                                                                                                                                                    onclick="loadBlockModal('{{ $user->id }}','{{ $user->name }}','{{ $user->email }}')"
                                                                                                                                                                                                                                                                                    style="color: black">Tidak Aktif</a>
                                                                                                                                                                                                                                                                            @endif
                                                                                                                                                                                                                                                                            <a class="btn btn-light btn-sm mt-1" title="Hantar semula emel pengesahan"
                                                                                                                                                                                                                                                                                onclick="loadResendEmailModal('{{ $user->id }}','{{ $user->name }}','{{ $user->email }}')"
                                                                                                                                                                                                                                                                                style="color: black"><i class="far fa-paper-plane"></i></a>
                                                                                                                                                                                                                                                                            @endhasanyrole

                                                                                                                                                                                                                                                                        </td>
                                                                                                                                                                                                                                                                    </tr>
                                                                                                                                                                                                                                                                @endforeach
                                                                                                                                                                                                                                                            </table>
                                                                                                                                                                                                                                                        </div> */
        ?>


        {{-- {!! $data->render() !!} --}}


        <!-- Modal -->
        <div class="modal fade" id="modal_delete_house2" data-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true" style="z-index: 1060">
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
                        <div class="msg"
                            style="position:absolute;float: left;left:0.6rem;color:rgba(4, 124, 40, 0.9)">
                        </div>
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

        <!-- Modal -->
        <div class="modal fade" id="modal_block_user" data-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true" style="z-index: 1060">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Adakah anda pasti ingin sekat pengguna ini?</h5>

                    </div>
                    <div class="modal-body">
                        <div id="maklumat_owner"></div>
                    </div>
                    <div class="modal-footer">
                        <div class="msg"
                            style="position:absolute;float: left;left:0.6rem;color:rgba(4, 124, 40, 0.9)">
                        </div>
                        <div class="float-right">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>


                            <button type="submit" id="modal-confirm_block" class="btn btn-danger btn-sm">SEKAT</button>
                        </div>

                    </div>
                    <div class="modal-message" style="display: none;">

                    </div>
                </div>
            </div>
        </div>
        {{-- End --}}

        <!-- Modal -->
        <div class="modal fade" id="modal_active_user" data-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true" style="z-index: 1060">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Adakah anda pasti ingin aktifkan pengguna ini?
                        </h5>

                    </div>
                    <div class="modal-body">
                        <div id="maklumat_owner"></div>
                    </div>
                    <div class="modal-footer">
                        <div class="msg"
                            style="position:absolute;float: left;left:0.6rem;color:rgba(4, 124, 40, 0.9)">
                        </div>
                        <div class="float-right">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>


                            <button type="submit" id="modal-confirm_block" class="btn btn-success btn-sm">AKTIFKAN</button>
                        </div>

                    </div>
                    <div class="modal-message" style="display: none;">

                    </div>
                </div>
            </div>
        </div>
        {{-- End --}}

        <!-- Modal -->
        <div class="modal fade" id="modal_resendemail_user" data-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="z-index: 1060">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Adakah anda pasti ingin hantar semula emel
                            pengesahan kepada pengguna ini?</h5>

                    </div>
                    <div class="modal-body">
                        <div id="maklumat_owner"></div>
                    </div>
                    <div class="modal-footer">
                        <div class="msg"
                            style="position:absolute;float: left;left:0.6rem;color:rgba(4, 124, 40, 0.9)">
                        </div>
                        <div class="float-right">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>


                            <button type="button" id="modal-confirm_resend" class="btn btn-success btn-sm">Hantar</button>
                        </div>

                    </div>
                    <div class="modal-message" style="display: none;">

                    </div>
                </div>
            </div>
        </div>
        {{-- End --}}

    </div>



@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $('#table_list_user').DataTable({
            "oLanguage": {
                "sLengthMenu": "Keluarkan  _MENU_  rekod",
                "oPaginate": {
                    "sFirst": "Halaman pertama", // This is the link to the first page
                    "sPrevious": "Halaman sebelum", // This is the link to the previous page
                    "sNext": "Halaman seterusnya", // This is the link to the next page
                    "sLast": "Halaman terakhir" // This is the link to the last page
                }
            }
        });

        function loadDeleteModal(id, name, email) {
            $('#modal_delete_house2 .modal-title').text('Anda pasti untuk hapus pemilik rumah di bawah: ');
            $('#modal_delete_house2 .modal-body #maklumat_owner').html('<p>Nama Pengguna: ' + name + '</p>' +
                '<p>Emel Pengguna: ' + email + '</p>');
            $('#modal_delete_house2 #modal-confirm_delete').attr('onclick', 'confirmDelete(' + id + ')');
            $('#modal_delete_house2').modal('show');
        }

        function confirmDelete(id) {
            console.log(id);
            $('#modal_delete_house2 .msg').text('');
            $('#modal_delete_house2 .msg').hide();

            // return;
            $.ajax({
                url: '{{ url('users') }}/' + id,
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    '_method': 'delete',
                },
                success: function(data) {
                    console.log(data);
                    $('#modal_delete_house2 .msg').text("Wow");
                    // $('#modal_delete_house2 .modal-message').append($('<div>', {
                    //     text: data.success
                    // }));
                    // $('#modal_delete_house2').show();
                    // $('#modal_delete_house2 .msg').slideDown("slow");
                    // $('#modal_delete_house2 .msg').fadeOut(1500);

                    $("#modal_delete_house2 .msg").slideDown(300).delay(300).fadeOut(200, 'swing', closeModal);


                },
                error: function(error) {
                    // Error logic goes here..!
                }
            });
        }

        function closeModal() {
            $('#modal_delete_house2').delay(200).modal('hide');
            location.reload();
        }

        function loadBlockModal(id, name, email) {
            $('#modal_block_user .modal-title').text('Anda pasti untuk sekat pengguna di bawah: ');
            $('#modal_block_user .modal-body #maklumat_owner').html('<p>Nama Pengguna: ' + name + '</p>' +
                '<p>Emel Pengguna: ' + email + '</p>');
            $('#modal_block_user #modal-confirm_block').attr('onclick', 'confirmBlock(' + id + ')');
            $('#modal_block_user').modal('show');
        }

        function confirmBlock(id) {
            console.log(id);
            $('#modal_block_user .msg').text('');
            $('#modal_block_user .msg').hide();

            // return;
            $.ajax({
                url: '{{ url('users') }}/block/' + id,
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    console.log(data);
                    $('#modal_block_user .msg').text(data);
                    // $('#modal_block_user .modal-message').append($('<div>', {
                    //     text: data.success
                    // }));
                    // $('#modal_block_user').show();
                    // $('#modal_block_user .msg').slideDown("slow");
                    // $('#modal_block_user .msg').fadeOut(1500);

                    $("#modal_block_user .msg").slideDown(300).delay(1000).fadeOut(500, 'swing', closeModal2);


                },
                error: function(error) {
                    // Error logic goes here..!
                }
            });
        }

        function closeModal2() {
            $('#modal_block_user').delay(1000).modal('hide');
            location.reload();
        }

        function loadActiveModal(id, name, email) {
            $('#modal_active_user .modal-title').text('Anda pasti untuk aktifkan pengguna di bawah: ');
            $('#modal_active_user .modal-body #maklumat_owner').html('<p>Nama Pengguna: ' + name + '</p>' +
                '<p>Emel Pengguna: ' + email + '</p>');
            $('#modal_active_user #modal-confirm_block').attr('onclick', 'confirmActive(' + id + ')');
            $('#modal_active_user').modal('show');
        }

        function confirmActive(id) {
            console.log(id);
            $('#modal_active_user .msg').text('');
            $('#modal_active_user .msg').hide();

            // return;
            $.ajax({
                url: '{{ url('users') }}/active/' + id,
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    console.log(data);
                    $('#modal_active_user .msg').text(data);
                    // $('#modal_block_user .modal-message').append($('<div>', {
                    //     text: data.success
                    // }));
                    // $('#modal_block_user').show();
                    // $('#modal_block_user .msg').slideDown("slow");
                    // $('#modal_block_user .msg').fadeOut(1500);

                    $("#modal_active_user .msg").slideDown(300).delay(1000).fadeOut(500, 'swing', closeModal3);


                },
                error: function(error) {
                    // Error logic goes here..!
                }
            });
        }

        function closeModal3() {
            $('#modal_active_user').delay(1000).modal('hide');
            location.reload();
        }

        function loadResendEmailModal(id, name, email) {
            $('#modal_resendemail_user .modal-title').text(
                'Anda pasti untuk hantar emel pengesahan kepada pengguna di bawah: ');
            $('#modal_resendemail_user .modal-body #maklumat_owner').html('<p>Nama Pengguna: ' + name + '</p>' +
                '<p>Emel Pengguna: ' + email + '</p>');
            $('#modal_resendemail_user #modal-confirm_resend').attr('onclick', 'confirmResend(' + id + ')');
            $('#modal_resendemail_user').modal('show');
        }

        function confirmResend(id) {
            console.log(id);
            $('#modal_resendemail_user .msg').text('');
            $('#modal_resendemail_user .msg').hide();

            // return;
            $.ajax({
                url: '{{ url('user') }}/resend/' + id,
                type: 'get',
                // data: {
                //     'id': id
                // },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    console.log(data);
                    $('#modal_resendemail_user .msg').text(data);


                    $("#modal_resendemail_user .msg").slideDown(300).delay(1000).fadeOut(500, 'swing',
                        closeModal3);


                },
                error: function(error) {
                    // Error logic goes here..!
                }
            });
        }

        function closeModal3() {
            $('#modal_resendemail_user').delay(1000).modal('hide');
            location.reload();
        }
    </script>
@endsection
