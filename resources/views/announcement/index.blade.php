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
                    <div class="col-lg-5 col-md-5 order-md-5 order-last">

                        <h3><i class="fa fa-bullhorn" aria-hidden="true"></i>&nbsp;Senarai Hebahan</h3>
                        <p class="text-subtitle text-muted">Senarai hebahan untuk makluman penyewa</p>
                    </div>
                    {{-- <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Senarai Aduan</li>
                            </ol>
                        </nav>
                    </div> --}}

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
                <button type="button" class="btn btn-sm btn-burs-y" data-toggle="modal" data-target="#tambahhebahan">
                    Tambah Hebahan</button>
            </div>
            @endrole
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Senarai Hebahan</h4>
                    </div>
                    <div class="card-body" style="overflow-x: auto;">
                        <table id="list_announcement_table" class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tajuk</th>
                                    <th scope="col">Jenis</th>
                                    <th scope="col">Oleh</th>
                                    @hasanyrole('Owner')
                                    <th scope="col">Tarikh dimasukkan</th>
                                    @endhasanyrole
                                    <th scope="col">Tarikh dihebahkan</th>
                                    <th scope="col">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($announcements as $item)
                                    <tr>
                                        <td class="">{{ ++$i }}</td>
                                        <td class="">{{ $item->title }}</td>
                                            <td class="
                                            ">{{ $item->announcement_type }}</td>
                                        <td class="">
                                            {{ $item->name }}</td>
                                        @hasanyrole('Owner')
                                        <td class="">{{ $item->created_at }}</td>
                                        @endhasanyrole
                                        <td class="">{{ $item->announcement_date }}</td>
                                            <td>
                                                @hasanyrole('Owner')
                                                <button type=" button" class="btn btn-secondary btn-sm"
                                            onclick="loadEditModal('{{ $item->id }}')"><i class="fa fa-pencil"
                                                aria-hidden="true"></i>
                                            </button>
                                            @endhasanyrole
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="tooltip"
                                                data-placement="top" title="Lihat hebahan"
                                                onclick="loadViewModal('{{ $item->id }}')"><i
                                                    class="fas fa-eye"></i>
                                            </button>
                                            @hasanyrole('Owner')
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip"
                                                data-placement="top" title="Hapus hebahan"
                                                onclick="loadDeleteModal('{{ $item->id }}','{{ $item->title }}')"><i
                                                    class="fas fa-trash-alt"></i>
                                            </button>
                                            <button type="button" class="btn btn-light-success btn-sm" data-toggle="tooltip"
                                                data-placement="top" title="Pilih rumah untuk hebahan"
                                                onclick="loadChooseHouseModal('{{ $item->id }}','{{ $item->title }}')"><i
                                                    class="fas fa-list"></i>
                                            </button>
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

        {{-- <div class="row">
            <div id="accordion" class="col-sm-4 col-md-4 col-lg-4">
                <div class="card">
                    <div class="card-header" style="background-color: rgb(253, 210, 117);">
                        <h4 class="card-title">Isu Semasa</h4>
                    </div>
                    <div class="card-body" style="background-color: rgba(255, 194, 62, 0.1);padding:0px;">
                        @php $i = 1; @endphp
                        @foreach ($announcements_isu as $item)
                            <div class="px-3 py-2">
                                <span class="mx-3" style="font-weight: bold; font-size:16px"> {{ $item->title }}</span>
                                <button class="btn btn-link" data-toggle="collapse"
                                    data-target="#collapse{{ $i }}" aria-expanded="true"
                                    aria-controls="collapseOne">
                                    <i class="far fa-caret-square-down"></i>
                                </button>
                                @hasanyrole('Owner') <button type="button" class="btn btn-danger btn-sm"
                                    onclick="loadDeleteModal('{{ $item->id }}','{{ $item->title }}')"><i
                                        class="fas fa-trash-alt"></i>
                                </button>@endhasanyrole

                                <div id="collapse{{ $i }}" class="collapse px-2 py-2"
                                    aria-labelledby="headingOne" data-parent="#accordion">

                                    {{ $item->message }}
                                </div>
                            </div>
                            @php $i++; @endphp
                        @endforeach

                    </div>
                </div>
            </div>
            <div id="accordion" class="col-sm-4 col-md-4 col-lg-4">
                <div class="card">
                    <div class="card-header" style="background-color: rgb(253, 210, 117);">
                        <h4 class="card-title">Peraturan Sewaan</h4>
                    </div>
                    <div class="card-body" style="background-color: rgba(255, 194, 62, 0.1);padding:0px;">
                        @php $i = 1; @endphp
                        @foreach ($announcements_rule as $item)
                            <div class="px-3 py-2">
                                <button class="btn btn-link" data-toggle="collapse"
                                    data-target="#collapserule{{ $i }}" aria-expanded="true"
                                    aria-controls="collapseOne">{{ $item->title }}</button>
                                @hasanyrole('Owner') <button type="button" class="btn btn-danger btn-sm"
                                    onclick="loadDeleteModal('{{ $item->id }}','{{ $item->title }}')"><i
                                        class="fas fa-trash-alt"></i>
                                </button>@endhasanyrole

                                <div id="collapserule{{ $i }}" class="collapse px-2 py-2"
                                    aria-labelledby="headingOne" data-parent="#accordion">{{ $item->message }}</div>
                            </div>
                            @php $i++; @endphp
                        @endforeach

                    </div>
                </div>
            </div>

            <div class="col-sm-4 col-md-4 col-lg-4">
                <div class="card">
                    <div class="card-header" style="background-color: rgb(253, 210, 117);">
                        <h4 class="card-title">Lain-lain Hebahan</h4>
                    </div>
                    <div class="card-body" style="background-color: rgba(255, 194, 62, 0.1);padding:0px;">
                        @php $i = 1; @endphp
                        @foreach ($announcements_other as $item)
                            <div class="px-3 py-2">
                                <button class="btn btn-link" data-toggle="collapse"
                                    data-target="#collapseother{{ $i }}" aria-expanded="true"
                                    aria-controls="collapseOne">
                                    {{ $item->title }}
                                </button>
                                @hasanyrole('Owner') <button type="button" class="btn btn-danger btn-sm"
                                    onclick="loadDeleteModal('{{ $item->id }}','{{ $item->title }}')"><i
                                        class="fas fa-trash-alt"></i>
                                </button>@endhasanyrole

                                <div id="collapseother{{ $i }}" class="collapse px-2 py-2"
                                    aria-labelledby="headingOne" data-parent="#accordion">

                                    {{ $item->message }}
                                </div>
                            </div>
                            @php $i++; @endphp
                        @endforeach

                    </div>
                </div>
            </div>


        </div> --}}
        <!-- Modal -->
        <div class="modal fade" id="modal_view_announcement" data-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="z-index: 1060">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Maklumat Hebahan </h5>
                    </div>
                    <div class="modal-body">
                        <div id="maklumat_view_announcement"></div>
                    </div>
                    <div class="modal-footer">
                        <div class="msg"
                            style="position:absolute;float: left;left:0.6rem;color:rgba(4, 124, 40, 0.9)">
                        </div>
                        <div class="float-right">
                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Tutup</button>

                        </div>

                    </div>
                    <div class="modal-message" style="display: none;">

                    </div>
                </div>
            </div>
        </div>
        {{-- End --}}

        @role ('Owner')
        {{-- Add Hebahan --}}
        <form action="{{ route('announcement.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="modal" tabindex="-1" role="dialog" id="tambahhebahan">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">

                            <h5 class="modal-title">
                                <p class="">Tambah hebahan</p>
                                <div class=" row ml-2"
                                    style="position: relative;">
                                    <small>(* Maklumat wajib diisi)</small>

                        </div>
                        </h5>



                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12 px-0">
                                    <div class="form-group">
                                        <label for="helpInputTop">Tajuk hebahan (*) </label>
                                        <small class="text-muted"><i>Cth: Pengurangan sewaan untuk bulan Mei
                                                2021</i></small>
                                        <input type="text" class="form-control shadow-sm alphaonly" maxlength="100"
                                            id="title" name="title" value="{{ old('title') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 col-md-4 col-lg-4 px-0">
                                    <div class="form-group">
                                        <label for="helpInputTop">Jenis Hebahan</label>
                                        <small class="text-muted">cth.<i> Sewa</i></small>
                                        {{ old('announcement_type') }}
                                        <select class="form-control form-select-sm shadow-sm"
                                            aria-label="Default select example" name="announcement_type">
                                            <option value="" selected>- Sila Pilih -</option>
                                            @foreach ($global_announcement_type as $utility_type)
                                                @if (Request::old('announcement_type') == $utility_type->type_id)
                                                    <option value="{{ $utility_type->type_id }}" selected>
                                                        {{ $utility_type->type_name }}</option>
                                                @else
                                                    <option value="{{ $utility_type->type_id }}">
                                                        {{ $utility_type->type_name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-5 col-md-5 col-lg-5 px-2">
                                    <div class="form-group">
                                        <label for="helpInputTop">Tarikh dihebahkan</label>
                                        <small class="text-muted">cth.<i> 20/04/2021</i></small>
                                        {{ old('list_doc_type') }}
                                        <div class="datepicker date input-group p-0 shadow-sm">
                                            <input name="announcement_date" type="text" placeholder="Pilih tarikh"
                                                class="form-control py-1 px-3" id="announcement_date">
                                            <div class="input-group-append"><span class="input-group-text px-4"><i
                                                        class="fa fa-clock-o"></i></span></div>
                                        </div>
                                    </div>
                                </div>



                            </div>

                            <div class="row custom-file" style="height: auto;">
                                <textarea rows="10" id="message" class="form-control"
                                    name="message">{{ old('message') }}</textarea>
                            </div>


                            <div class="row">
                                <div class="col-sm-5 col-md-5 col-lg-5">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input chooseFile" id="img1" name="files[]"
                                            value="{{ old('files.0') }}" multiple="">
                                        <label class="custom-file-label" for="chooseFile">Choose file</label>
                                    </div>
                                    <div class="row">
                                        <img src="#" width="300px" height="250px" style="display: none;padding:1rem;" />
                                        <!--for preview purpose -->
                                    </div>
                                </div>
                                <div class="col-sm-5 col-md-5 col-lg-5">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input chooseFile" id="img2" name="files[]"
                                            value="{{ old('files.1') }}" multiple="">
                                        <label class="custom-file-label" for="chooseFile">Choose file</label>
                                    </div>
                                    <div class="row">
                                        <img src="#" width="300px" height="250px" style="display: none;padding:1rem;" />
                                        <!--for preview purpose -->
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

    <form id="editform" action="{{ route('announcement.update', 'x') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal" tabindex="-1" role="dialog" id="edithebahan">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <h5 class="modal-title">
                            <p class="">Kemaskini hebahan</p>
                                <div class=" row ml-2"
                                style="position: relative;">
                                <small>(* Maklumat wajib diisi)</small>

                    </div>
                    </h5>

                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12 px-0">
                                <div class="form-group">
                                    <label for="helpInputTop">Tajuk hebahan (*) </label>
                                    <small class="text-muted"><i>Cth: Pengurangan sewaan untuk bulan Mei
                                            2021</i></small>
                                    <input type="text" class="form-control shadow-sm alphaonly" maxlength="100"
                                        id="edit_title" name="edit_title" value="{{ old('edit_title') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-md-4 col-lg-4 px-0">
                                <div class="form-group">
                                    <label for="helpInputTop">Jenis Hebahan</label>
                                    <small class="text-muted">cth.<i> Sewa</i></small>

                                    <select id="edit_announcement_type" class="form-control form-select-sm shadow-sm"
                                        aria-label="Default select example" name="edit_announcement_type">
                                        <option value="" selected>- Sila Pilih -</option>
                                        @foreach ($global_announcement_type as $utility_type)
                                            @if (Request::old('edit_announcement_type') == $utility_type->type_id)
                                                <option value="{{ $utility_type->type_id }}" selected>
                                                    {{ $utility_type->type_name }}</option>
                                            @else
                                                <option value="{{ $utility_type->type_id }}">
                                                    {{ $utility_type->type_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-5 col-md-5 col-lg-5 px-2">
                                <div class="form-group">
                                    <label for="helpInputTop">Tarikh dihebahkan</label>
                                    <small class="text-muted">cth.<i> 20/04/2021</i></small>
                                    {{ old('list_doc_type') }}
                                    <div class="datepicker date input-group p-0 shadow-sm">
                                        <input name="edit_announcement_date" type="text" placeholder="Pilih tarikh"
                                            class="form-control py-1 px-3" id="edit_announcement_date">
                                        <div class="input-group-append"><span class="input-group-text px-4"><i
                                                    class="fa fa-clock-o"></i></span></div>
                                    </div>
                                </div>
                            </div>



                        </div>

                        <div class="row custom-file" style="height: auto;">
                            <textarea rows="10" id="edit_message" class="form-control"
                                name="edit_message">{{ old('edit_message') }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <p>Fail 1: <a id="firstlink" name="firstlink" href="#">No file</a><button type="button" class="btn btn-danger btn-sm mx-3" data-toggle="tooltip"
                                    data-placement="top" title="Hapus lampiran 1"
                                    onclick="toggleDelete(this)"><i
                                        class="fas fa-trash-alt"></i>
                                </button></p>
                            </div>
                            <input type="hidden" id="firstlink_delete" name="firstlink_delete" value="no">
                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <p>Fail 2: <a id="secondlink" name="secondlink" href="#">No file</a><button type="button" class="btn btn-danger btn-sm mx-3" data-toggle="tooltip"
                                    data-placement="top" title="Hapus lampiran 2"
                                    onclick="toggleDelete2(this)"><i
                                        class="fas fa-trash-alt"></i>
                                </button></p>
                            </div>
                            <input type="hidden" id="secondlink_delete" name="secondlink_delete" value="no">
                        </div>

                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input chooseFile" id="img1" name="edit_files[]"
                                        value="{{ old('edit_files.0') }}" multiple="">
                                    <label class="custom-file-label" for="chooseFile">Choose file</label>
                                </div>
                                <div class="row">
                                    <img src="#" width="300px" height="250px" style="display: none;padding:1rem;" />
                                    <!--for preview purpose -->
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input chooseFile" id="img2" name="edit_files[]"
                                        value="{{ old('edit_files.1') }}" multiple="">
                                    <label class="custom-file-label" for="chooseFile">Choose file</label>
                                </div>
                                <div class="row">
                                    <img src="#" width="300px" height="250px" style="display: none;padding:1rem;" />
                                    <!--for preview purpose -->
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

    <!-- Modal delete-->
    <div class="modal fade" id="modal_delete_announcement" data-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="z-index: 1060">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Adakah anda pasti ingin hapus maklumat ini?
                    </h5>

                </div>
                <div class="modal-body">
                    <div id="maklumat_announcement"></div>
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

    <!-- Modal choose house-->
    <div class="modal fade" id="modal_choose_house_announcement" data-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="z-index: 1060">
        <div class="modal-dialog modal-xl">
            <form id="form_listhouse">
                @csrf
                @method('POST')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Sila pilih rumah untuk dihebahkan hebahan
                            berikut:
                        </h5>

                    </div>
                    <div class="modal-body">
                        <div id="maklumat_announcement"></div>
                        <input type="hidden" id="listhouse_announcement_id" value=""
                            name="listhouse_announcement_id"></input>
                        <br />
                        <div class="row">
                            <h4 class="mx-4">Senarai Rumah</h4>
                            <div id="listhouse" class="col-md-12"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="msg"
                            style="position:absolute;float: left;left:0.6rem;color:rgba(4, 124, 40, 0.9)">
                        </div>
                        <div class="float-right">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>


                            <button type="button" id="modal-confirm_listhouse"
                                class="btn btn-success btn-sm">Simpan</button>
                        </div>

                    </div>
                    <div class="modal-message" style="display: none;">

                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- End --}}

    @endrole

    {{-- Modal image --}}
    <div id="modal_image" class="modal" tabindex="-1" role="dialog">
        <span id="btn_close2" class="close">&times;</span>
        <img class="modal-content" id="img01">
        <div id="caption"></div>
    </div>
    {{-- End --}}


    </div>

@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
    <script src="//cdn.datatables.net/plug-ins/1.10.25/sorting/datetime-moment.js"></script>
    <script>
        $.fn.dataTable.moment('HH:mm MMM D, YY');
        $.fn.dataTable.moment('dddd, MMMM Do, YYYY');

        $('#list_announcement_table').DataTable({
            "order": [
                [4, "desc"]
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
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);

            var img2 = $(this).parent().parent().find("img");
            var img = $('#category-img-tag');
            console.log(img2);
            console.log(img);
            console.log(this);

            readURL2(this);

        });

        function loadEditModal(ann_id) {
            url = $('#editform').attr('action');
            new_url = url.replace('x', ann_id);
            $('#editform').attr('action', new_url);

            var image1 = document.querySelector(
                "#edithebahan > div > div > div.modal-body > div > div:nth-child(5) > div:nth-child(1) > div.row > img"
            );
            var image2 = document.querySelector(
                "#edithebahan > div > div > div.modal-body > div > div:nth-child(5) > div:nth-child(2) > div.row > img"
            );

            image1.src = "";
            image1.style.display = "none";

            image2.src = "";
            image2.style.display = "none";

            var firstlink = $('#firstlink');
            var secondlink = $('#secondlink');

            firstlink.html("No file");
            firstlink.attr("href", "#");
            secondlink.html("No file");
            secondlink.attr("href", "#");

            $.ajax({
                type: "GET",
                url: '/announcement/info/' + ann_id,
                data: {}
            }).done(function(data) {
                console.log(data);

                $('#edit_title').val(data['title']);
                $('#edit_message').val(data['message']);
                $('#edit_announcement_date').val(data['announcement_date']);
                $('#edit_announcement_date').datepicker({
                    format: 'dd/mm/yyyy',
                    autoclose: true
                }).datepicker('update');
                // $('#edit_announcement_type option[value="' + data['announcement_type'] + '"]').attr('selected',
                //     'selected');

                $('#edit_announcement_type option[value="' + data['announcement_type'] + '"]').attr('selected',
                    'true');

                // $('#edit_announcement_type option').each(function() {
                //     if ($(this).val() == data['announcement_type']) {
                //         console.log($(this));
                //         $(this).prop("selected", true);
                //     }
                // });


                // image1.src = data['images'][0]['image_path'];
                // image1.style.display = "block";

                // image2.src = data['images'][1]['image_path'];
                // image2.style.display = "block";

                console.log(data['images'][0]['image_index']);

                if( data['images'][0] === undefined ) {
                    firstlink.html("No file");
                    firstlink.attr("href", "#");
                }else{
                    if(data['images'][0]['image_index'] == 0){
                        firstlink.html(data['images'][0]['image_name']);
                        firstlink.attr("href", data['images'][0]['image_path']);
                    }
                    if(data['images'][0]['image_index'] == 1){
                        console.log("here");
                        secondlink.html(data['images'][0]['image_name']);
                        secondlink.attr("href", data['images'][0]['image_path']);
                    }
                }

                if( data['images'][1] === undefined ) {
                    // secondlink.html("No file");
                    // secondlink.attr("href", "#");
                }else{
                    if(data['images'][1]['image_index'] == 1){
                        secondlink.html(data['images'][1]['image_name']);
                        secondlink.attr("href", data['images'][1]['image_path']);
                    }
                }




            });



            $('#edithebahan').modal('show');
        }

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

        function loadDeleteModal(announcement_id, announcement_title) { //not complete yet
            $('#modal_delete_announcement .modal-title').text('Anda pasti untuk hapus hebahan berikut: ');
            $('#modal_delete_announcement .modal-body #maklumat_announcement').html('<p>Tajuk hebahan: ' +
                announcement_title + '</p>');
            $('#modal_delete_announcement #modal-confirm_delete').attr('onclick', 'confirmDelete(' + announcement_id + ')');
            $('#modal_delete_announcement').modal('show');
        }

        function confirmDelete(announcement_id) {
            console.log(announcement_id);
            $('#modal_delete_announcement .msg').text('');
            $('#modal_delete_announcement .msg').hide();

            // return;
            $.ajax({
                url: '/announcement/' + announcement_id,
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    '_method': 'delete',
                },
                success: function(data) {
                    console.log(data);
                    $('#modal_delete_announcement .msg').text(data.success);

                    $("#modal_delete_announcement .msg").slideDown(300).delay(300).fadeOut(300, 'swing',
                        closeModal);


                },
                error: function(error) {
                    // Error logic goes here..!
                }
            });
        }

        function closeModal() {
            $('#modal_delete_announcement').delay(300).modal('hide');
            location.reload();
        }

        function loadChooseHouseModal(announcement_id, announcement_title) {
            $('#listhouse').empty();
            $('#listhouse_announcement_id').val(announcement_id);

            $.ajax({
                type: "get",
                url: "/announcement/listhouse",
                data: {
                    announcement_id: announcement_id
                },
                success: function(response) {
                    console.log(response);

                    $('#listhouse').append(response);
                }
            });

            $('#modal_choose_house_announcement .modal-title').text('Sila pilih rumah untuk dihebahkan hebahan berikut:');
            $('#modal_choose_house_announcement .modal-body #maklumat_announcement').html('<p>Tajuk hebahan: ' +
                announcement_title + '</p>');
            $('#modal_choose_house_announcement #modal-confirm_listhouse').attr('onclick', 'confirmChooseHouse(' +
                announcement_id +
                ')');
            $('#modal_choose_house_announcement').modal('show');
        }

        function confirmChooseHouse(announcement_id) {
            console.log(announcement_id);
            $('#modal_choose_house_announcement .msg').text('');
            $('#modal_choose_house_announcement .msg').hide();

            count = 0;

            $("input[name='check_house[]']").each(function(index, obj) {
                console.log($(this).val());
                if (this.checked) {
                    count++;
                }
            });

            console.log(count);
            if (count < 1) {
                alert("Sila pilih sekurang-kurangnya satu hebahan.");
                return;
            }


            values = $('#form_listhouse').serialize()

            // values = values.concat(
            //     jQuery('#form_listhouse input[type=checkbox]:not(:checked)').map(
            //         function() {
            //             return {
            //                 "name": this.name,
            //                 "value": 'off'
            //             }
            //         }).get()
            // );

            console.log(values);

            $.ajax({
                url: '/announcement/savehousetoannouce/' + announcement_id,
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: values,
                success: function(data) {
                    console.log(data);
                    $('#modal_choose_house_announcement .msg').text(data.success);

                    $("#modal_choose_house_announcement .msg").slideDown(300).delay(300).fadeOut(300, 'swing',
                        closeModal2);


                },
                error: function(error) {
                    // Error logic goes here..!
                }
            });
        }

        function closeModal2() {
            $('#modal_choose_house_announcement').delay(300).modal('hide');
            // location.reload();
        }

        function toggleDelete(lampiran) {
            console.log(lampiran);

            var firstlink = $('#firstlink');

            var firstlink_delete = $('#firstlink_delete');

            if(firstlink_delete.val() == 'no'){
                firstlink_delete.val('yes');
                firstlink.css({ 'color': 'red', 'font-size': '120%', 'text-decoration': 'line-through' });
                lampiran.title = "Kekal lampiran 1";
            }else{
                firstlink_delete.val('no');
                firstlink.css({ 'color': '#b18908', 'font-size': '100%',
                'text-decoration': 'none'  });
                lampiran.title = "Hapus lampiran 1";
            }
          }

          function toggleDelete2(lampiran) {
            console.log(lampiran);

            var secondlink = $('#secondlink');

            var secondlink_delete = $('#secondlink_delete');

            if(secondlink_delete.val() == 'no'){
                secondlink_delete.val('yes');
                secondlink.css({ 'color': 'red', 'font-size': '120%', 'text-decoration': 'line-through' });
                lampiran.title = "Kekal lampiran 1";
            }else{
                secondlink_delete.val('no');
                secondlink.css({ 'color': '#b18908', 'font-size': '100%',
                'text-decoration': 'none'  });
                lampiran.title = "Hapus lampiran 1";
            }
          }
    </script>
@endsection
