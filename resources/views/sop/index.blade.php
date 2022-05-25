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
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Oops!</strong> Sila masukkan maklumat berikut: <br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- @if ($success->any())
            <div class="alert alert-success">
                <strong>Yess!</strong> Maklumat rumah berjaya dimasukkan.<br><br>
                <ul>
                    @foreach ($success->all() as $success)
                        <li>{{ $success }}</li>
        @endforeach
        </ul>
    </div>
    @endif --}}

        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif



        <div class="page-heading my-1">
            <div class="page-title">
                <div class="row">
                    <div class="col-lg-5 col-md-5 order-md-1 order-last">
                        <h4>SOP</h4>
                        <p class="text-subtitle text-muted">Senarai SOP Dan Format Untuk Rujukan Pemilik / Pengurus Rumah
                        </p>
                    </div>
                </div>
            </div>
            @hasanyrole('Admin|Staf')
            <div class="section mb-2">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahsop">
                    Tambah SOP</button>
            </div>
            @endhasanyrole
            <section class="section">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Senarai SOP dan format</h4>
                            </div>
                            <div class="card-body" style="overflow-x: auto;">
                                <table id="list_sop_table" class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Perkara</th>
                                            <th scope="col">Jenis</th>
                                            <th scope="col" style="width: 25%">Lampiran</th>
                                            <th scope="col">Oleh</th>
                                            <th scope="col">Tarikh dimasukkan</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach ($sops as $sop)
                                            <tr>
                                                <td class="">{{ ++$i }}</td>
                                                <td class="">{{ $sop->sop_name }}</td>
                                                                        <td class="




                                                    ">

                                                    <label
                                                        class="badge
                                                    @if ($sop->file_for == 'Sebelum Penyewa Masuk') badge-danger @endif @if ($sop->file_for == 'Semasa Proses Menyewa')
                                                    badge-warning
                                        @endif
                                        @if ($sop->file_for == 'Selepas Penyewa Keluar')
                                            badge-success
                                        @endif
                                        ">{{ $sop->file_for }}
                                                    </label>

                                                </td>
                                                <td class="">
                                                    @if ($sop->file_path != '')
                                                        {{-- {{ $cost->image_name }} --}}
                                                        <a class="
                                                    btn-sm btn-success" href="{{ route('downloadsop', $sop->id) }}"><i
                                                        class="far fa-arrow-alt-circle-down"></i></a>
                                                    <a class="btn-sm btn-info" href="{{ route('viewsop', $sop->id) }}"
                                                        target="_blank"><i class="fas fa-external-link-alt"></i></a>
                                        @endif
                                        </td>

                                        <td class="">{{ $sop->created_by }}</td>
                                                <td class="">{{ $sop->created_at }}</td>
                                                                        <td>@hasanyrole('Admin|Staf') <button type="
                                            button" class="btn btn-danger btn-sm"
                                            onclick="loadDeleteModal('{{ $sop->id }}','{{ $sop->sop_name }}','{{ $sop->file_for }}')">
                                            <i class="far fa-trash-alt"></i>
                                            </button>@endhasanyrole
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
        </div>
    </div>


    @hasanyrole('Admin|Staf')
    <form action="{{ route('sop.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="modal" tabindex="-1" role="dialog" id="tambahsop">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <h5 class="modal-title">
                            <p class="">Tambah SOP</p>
                        </h5>
                        <div class="
                                row mt-4 ml-2" style="position: fixed;">
                                <small>(* Maklumat wajib diisi)</small>

                    </div>


                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-6 px-0">
                                <div class="form-group">
                                    <label for="helpInputTop">Label SOP (*) </label>
                                    <small class="text-muted"><i>SOP PKP</i></small>
                                    <input type="text" class="form-control shadow-sm alphaonly" maxlength="100"
                                        id="sop_name" name="sop_name" value="{{ old('sop_name') }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="radio_choose_soptype" id="exampleRadios1"
                                value="option1" checked>
                            <label class="form-check-label" for="exampleRadios1">
                                Baru
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="radio_choose_soptype" id="exampleRadios2"
                                value="option2">
                            <label class="form-check-label" for="exampleRadios2">
                                Pilih dari senarai
                            </label>
                        </div>



                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-6 px-0">
                                <div class="form-group">
                                    <label for="helpInputTop">Namakan jenis SOP baru (*) </label>
                                    <small class="text-muted"><i>SOP PKP</i></small>
                                    <input type="text" class="form-control shadow-sm alphaonly" maxlength="100"
                                        id="new_sop_type" name="new_sop_type" value="{{ old('new_sop_type') }}">
                                </div>
                            </div>
                            <div class="col-sm-5 col-md-5 col-lg-5 px-2">
                                <div class="form-group">
                                    <label for="helpInputTop">Senarai jenis SOP</label>
                                    <small class="text-muted">cth.<i> SPA</i></small>
                                    {{ old('list_sop_type') }}
                                    <select id="list_sop_type" class="form-control form-select-sm shadow-sm"
                                        aria-label="Default select example" name="list_sop_type" disabled>
                                        <option value="" selected>- Sila Pilih -</option>
                                        @foreach ($global_sop_type as $sop_type)
                                            @if (Request::old('list_sop_type') == $sop_type->type_id)
                                                <option value="{{ $sop_type->type_id }}" selected>
                                                    {{ $sop_type->type_name }}</option>
                                            @else
                                                <option value="{{ $sop_type->type_id }}">
                                                    {{ $sop_type->type_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                    {{-- <input type="text" class="form-control" id="helpInputTop" name="negeri" value="{{ old('negeri') }}"> --}}
                                </div>
                            </div>



                        </div>

                        <div class="row custom-file">
                            <input type="file" class="custom-file-input" id="sop_attachment" name="sop_attachment"
                                value="{{ old('sop_attachment') }}" multiple="">
                            <label class="custom-file-label" for="sop_attachment">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
        </div>
    </form>

    <div class="modal fade" id="modal_delete_sop" data-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                        style="position:absolute;float: left;left:0.6rem;color:rgba(4, 124, 40, 0.9)"></div>
                    <div class="float-right">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>


                        <button type="submit" id="modal-confirm_delete" class="btn btn-danger btn-sm">Ya</button>
                    </div>

                </div>
                <div class="modal-message" style="display: none;">

                </div>
            </div>
        </div>
    </div>
    @endhasanyrole

@endsection

@section('js')

    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $('#list_sop_table').DataTable({
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

        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

        function loadDeleteModal(sop_id, sop_name, file_for) { //not complete yet
            $('#modal_delete_sop .modal-title').text('Anda pasti untuk hapus kos berikut: ');
            $('#modal_delete_sop .modal-body #maklumat_owner').html('<p>Nama SOP: ' + sop_name +
                '</p><p>Jenis SOP: ' +
                file_for + '</p>');
            $('#modal_delete_sop #modal-confirm_delete').attr('onclick', 'confirmDelete(' + sop_id + ')');
            $('#modal_delete_sop').modal('show');
        }

        function confirmDelete(sop_id) {
            console.log(sop_id);
            $('#modal_delete_sop .msg').text('');
            $('#modal_delete_sop .msg').hide();

            // return;
            $.ajax({
                url: '/sop/' + sop_id,
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    '_method': 'delete',
                },
                success: function(data) {
                    console.log(data);
                    $('#modal_delete_sop .msg').text(data.success);

                    $("#modal_delete_sop .msg").slideDown(300).delay(300).fadeOut(300, 'swing',
                        closeModal);


                },
                error: function(error) {
                    // Error logic goes here..!
                }
            });
        }

        function closeModal() {
            $('#modal_delete_sop').delay(300).modal('hide');
            location.reload();
        }

        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();

            $("#tambahsop input[type=radio]").on("change", function() {
                if (this.checked) {
                    if (this.value == 'option1') {
                        $('#new_sop_type').removeAttr("disabled");
                        $('#list_sop_type').prop('disabled', 'true');
                    }
                    if (this.value == 'option2') {
                        $('#new_sop_type').prop('disabled', 'true');
                        $('#list_sop_type').removeAttr("disabled");
                    }
                }
            });


        });
    </script>
@endsection
