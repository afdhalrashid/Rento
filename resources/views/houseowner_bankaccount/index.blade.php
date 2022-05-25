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


                        <h3><i class="fas fa-money-check-alt"></i>&nbsp;Pengurusan Akaun Bank</h3>
                        <p class="text-subtitle text-muted">Senarai akaun bank pemilik/pengurus rumah dan urusan
                            kemaskini</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('house.edit', $house->id) }}">Maklumat
                                        Rumah</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Senarai Akaun Bank Pemilik Rumah</li>
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
                <button type="button" class="btn btn-sm btn-burs-y" data-toggle="modal" data-target="#tambahakaun">
                    Tambah Akaun Bank</button>
            </div>
            @endrole
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Senarai Akaun</h4>
                    </div>
                    <div class="card-body">
                        <table id="list_bankaccount_table" class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Bank</th>
                                    <th scope="col">No Akaun</th>
                                    <th scope="col">Penama</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($house->bank_accounts as $item)
                                    <tr>
                                        <td class="">{{ ++$i }}</td>
                                        <td class="">{{ $item->bank_name }}</td>
                                                                                                                            <td class="















                                            ">
                                            {{ $item->account_no }}</td>
                                        <td class="">
                                            {{ $item->account_name }}</td>
                                        <td>
                                            <button type="
                                            button" class="btn btn-danger btn-sm"
                                            onclick="loadDeleteModal('{{ $item->id }}','{{ $item->bank_name }}','{{ $item->account_no }}','{{ $item->account_name }}')">
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
        <form action="{{ route('houseowner_bankaccount.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <input type="hidden" name="house_id" value="{{ $house->id }}">
            <div class="modal" tabindex="-1" role="dialog" id="tambahakaun">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">

                            <h5 class="modal-title">
                                <p class="">Tambah akaun</p>
                            </h5>
                            <div class="
                                    row mt-4 ml-2" style="position: fixed;">
                                    <small>(* Maklumat wajib diisi)</small>

                        </div>


                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="radio_choose_doctype" id="exampleRadios1"
                                    value="option1">
                                <label class="form-check-label" for="exampleRadios1">
                                    Baru
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="radio_choose_doctype" id="exampleRadios2"
                                    value="option2" checked>
                                <label class="form-check-label" for="exampleRadios2">
                                    Pilih dari senarai
                                </label>
                            </div>

                            <div class="row">
                                <div class="col-sm-4 col-md-4 col-lg-4 px-0">
                                    <div class="form-group">
                                        <label for="helpInputTop">Nama bank (*) </label>
                                        <small class="text-muted"><i>Bank Western Union</i></small>
                                        <input disabled type="text" class="form-control shadow-sm alphaonly" maxlength="100"
                                            id="new_bank_name" name="new_bank_name" value="{{ old('new_bank_name') }}">
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4 col-lg-4 px-2">
                                    <div class="form-group">
                                        <label for="helpInputTop">Pilih bank</label>
                                        <small class="text-muted">cth.<i> Bank Islam</i></small>
                                        {{ old('bank_name') }}
                                        <select id="list_bank" class="form-control form-select-sm shadow-sm"
                                            aria-label="Default select example" name="bank_name">
                                            <option value="" selected>- Sila Pilih -</option>
                                            @foreach ($global_bankname as $name)
                                                @if (Request::old('bank_name') == $name->type_id)
                                                    <option value="{{ $name->type_id }}" selected>
                                                        {{ $name->type_name }}</option>
                                                @else
                                                    <option value="{{ $name->type_id }}">
                                                        {{ $name->type_name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3 col-md-3 col-lg-3 px-2">
                                    <div class="form-group">
                                        <label for="helpInputTop">No akaun</label>
                                        <small class="text-muted">cth.<i> 243277745</i></small>
                                        {{ old('account_no') }}
                                        <div class="input-group p-0 shadow-sm">
                                            <input name="account_no" type="number" class="form-control py-1 px-3"
                                                id="account_no">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-5 col-md-5 col-lg-5 px-2">
                                    <div class="form-group">
                                        <label for="helpInputTop">Penama akaun</label>
                                        <small class="text-muted">cth.<i> Muhammad Khairi</i></small>
                                        {{ old('account_name') }}
                                        <div class="input-group p-0 shadow-sm">
                                            <input name="account_name" type="text" class="form-control py-1 px-3"
                                                id="account_name">

                                        </div>
                                    </div>
                                </div>



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

    <!-- Modal -->
    <div class="modal fade" id="modal_delete_bankaccount" data-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true" style="z-index: 1060">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Adakah anda pasti ingin hapus maklumat ini?
                    </h5>

                </div>
                <div class="modal-body">
                    <div id="maklumat_account"></div>
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
        $('#list_bankaccount_table').DataTable({
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

        $('.datepicker').datepicker({
            clearBtn: true,
            format: "dd/mm/yyyy"
        });

        function readURL2(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                var image = $(input).parent().parent().find("img");

                reader.onload = function(e) {
                    image.attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
                image.show();
            }
        }

        $(".chooseFile").change(function() {
            var img2 = $(this).parent().parent().find("img");
            var img = $('#category-img-tag');
            console.log(img2);
            console.log(img);
            console.log(this);

            readURL2(this);

        });

        function loadViewModal(announcement_id) {
            $.ajax({
                type: "get",
                url: "/announcement/" + announcement_id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log(response);
                    $('#modal_view_announcement .modal-body #maklumat_view_announcement').html(response);
                    $('#modal_view_announcement').modal('show');
                }
            });
        }

        function loadDeleteModal(account_id, bank_name, account_no, name) { //not complete yet
            $('#modal_delete_bankaccount .modal-title').text('Anda pasti untuk hapus kos berikut: ');
            $('#modal_delete_bankaccount .modal-body #maklumat_account').html(
                '<p>Nama bank: ' + bank_name + '</p>' +
                '<p>No akaun: ' + account_no + '</p>' +
                '<p>Penama akaun: ' + name + '</p>'
            );
            $('#modal_delete_bankaccount #modal-confirm_delete').attr('onclick', 'confirmDelete(' + account_id + ')');
            $('#modal_delete_bankaccount').modal('show');
        }

        function confirmDelete(account_id) {
            console.log(account_id);
            $('#modal_delete_bankaccount .msg').text('');
            $('#modal_delete_bankaccount .msg').hide();

            // return;
            $.ajax({
                url: '/houseowner_bankaccount/' + account_id,
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    '_method': 'delete',
                },
                success: function(data) {
                    console.log(data);
                    $('#modal_delete_bankaccount .msg').text(data.success);

                    $("#modal_delete_bankaccount .msg").slideDown(300).delay(300).fadeOut(300, 'swing',
                        closeModal);


                },
                error: function(error) {
                    // Error logic goes here..!
                }
            });
        }

        function closeModal() {
            $('#modal_delete_bankaccount').delay(300).modal('hide');
            location.reload();
        }

        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();

            $("#tambahakaun input[type=radio]").on("change", function() {
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
