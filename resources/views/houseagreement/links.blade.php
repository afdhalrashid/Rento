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
        <header class="mb-2">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>



        <div class="page-heading mb-1">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">


                        <h3><i class="far fa-newspaper"></i>&nbsp;Pengurusan Link Borang Perjanjian Online</h3>
                        <p class="text-subtitle text-muted">Senarai link borang online dan urusan kemaskini</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('houseagreement.show', $houseid) }}">Perjanjian Sewa
                                        Rumah</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Link Borang Online</li>
                            </ol>
                        </nav>
                    </div>

                </div>
            </div>
        </div>

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

        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <p>{{ $message }}</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="row pb-3">
            @role('Owner')
            <div class="col-lg-4 order-md-2">
                <button type="button" class="btn btn-sm btn-burs-y" data-toggle="modal" data-target="#tambahlink">
                    Tambah Link</button>
            </div>
            @endrole
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Senarai Link</h4>
                    </div>
                    <div class="card-body">
                        <table id="list_links_table" class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Pautan</th>
                                    <th scope="col">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($agreement_links as $item)
                                    <tr>
                                        <td class="">{{ ++$i }}</td>
                                        <td class="">{{ $item->links }} </td>
                                        <td><a class="btn-sm btn-info mr-2" data-toggle="tooltip"
                                            data-placement="top" title="Buka"
                                                href="{{ $item->links }}"
                                                target="_blank"><i class="fas fa-external-link-alt"></i></a>

                                                                                                                                                                            <button title="
                                            Hapus" type=" button" class="btn btn-danger btn-sm"
                                            onclick="loadDeleteModal('{{ $item->id }}','{{ $item->links }}')">
                                            <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>



        @role ('Owner')
        <form action="{{ route('houseagreementlinks.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <input type="hidden" name="house_id" value="{{ $houseid }}">
            <div class="modal" tabindex="-1" role="dialog" id="tambahlink">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">

                            <h5 class="modal-title">
                                <p class="">Tambah link baru</p>
                            </h5>
                            <div class="
                                    row mt-4 ml-2" style="position: fixed;">
                                    <small>(* Maklumat wajib diisi)</small>

                        </div>


                    </div>
                    <div class="modal-body">
                        <div class="container">

                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12 px-0">
                                    <div class="form-group">
                                        <label for="helpInputTop">URL (*) </label>
                                        <small class="text-muted"><i>wwww.form_online.com</i></small>
                                        <input type="text" class="form-control shadow-sm alphaonly" maxlength="100"
                                            id="url_name" name="url_name" value="{{ old('url_name') }}">
                                    </div>
                                </div>

                            </div>





                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
    </div>
    </form>

    <!-- Modal -->
    <div class="modal fade" id="modal_delete_link" data-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true" style="z-index: 1060">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Adakah anda pasti ingin hapus maklumat ini?
                    </h5>

                </div>
                <div class="modal-body">
                    <div id="maklumat_link"></div>
                </div>
                <div class="modal-footer">
                    <div class="msg"
                        style="position:absolute;float: left;left:0.6rem;color:rgba(4, 124, 40, 0.9)">
                    </div>
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
    {{-- End --}}

    @endrole




    </div>

@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $('#list_links_table').DataTable({
            "order": [
                [3, "desc"]
            ],
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




        function loadDeleteModal(link_id, url) { //not complete yet
            $('#modal_delete_link .modal-title').text('Anda pasti untuk hapus link berikut: ');
            $('#modal_delete_link .modal-body #maklumat_link').html(
                '<p>URL: ' + url + '</p>'
            );
            $('#modal_delete_link #modal-confirm_delete').attr('onclick', 'confirmDelete(' + link_id + ')');
            $('#modal_delete_link').modal('show');
        }

        function confirmDelete(link_id) {
            console.log(link_id);
            $('#modal_delete_link .msg').text('');
            $('#modal_delete_link .msg').hide();

            // return;
            $.ajax({
                url: '/houseagreementlinks/' + link_id,
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    '_method': 'delete',
                },
                success: function(data) {
                    console.log(data);
                    $('#modal_delete_link .msg').text(data.success);

                    $("#modal_delete_link .msg").slideDown(300).delay(300).fadeOut(300, 'swing',
                        closeModal);


                },
                error: function(error) {
                    // Error logic goes here..!
                }
            });
        }

        function closeModal() {
            $('#modal_delete_link').delay(300).modal('hide');
            location.reload();
        }

        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();

            $("#tambahlink input[type=radio]").on("change", function() {
                if (this.checked) {
                    if (this.value == 'option1') {
                        $('#new_bank_name').removeAttr("disabled");
                        $('#list_bank').prop('disabled', 'true');
                    }
                    if (this.value == 'option2') {
                        $('#new_bank_name').prop('disabled', 'true');
                        $('#list_bank').removeAttr("disabled");
                    }
                }
            });


        });
    </script>
@endsection
