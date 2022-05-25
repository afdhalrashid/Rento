@extends('layouts.app')

@section('css')
    <style>

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
            @include('layouts.nav_house')
            <div class="page-title">
                <div class="row">
                    <div class="col-lg-3 col-md-3 order-md-1 order-last">
                        <h4>Dokumen</h4>
                        <p class="text-subtitle text-muted">Senarai Dokumen Penting Rumah </p>
                    </div>
                    @role('Owner')
                    <div class="col-lg-4 order-md-2 order-first">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahdoc">
                            Tambah Dokumen Rumah</button>
                    </div>@endrole

                </div>
            </div>
            <section class="section">
                <div class="row">
                    <div class="col-sm-3 col-md-3 col-lg-3">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Maklumat Rumah</h4>
                            </div>
                            <div class="card-body">
                                @include('layouts.houseprofile2')
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Dokumen Rumah</h4>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Jenis Dokumen</th>
                                            <th scope="col" style="width: 25%">Fail</th>
                                            <th scope="col" style="width: 25%">Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach ($house->docs as $doc)
                                            <tr>
                                                <td class="">{{ ++$i }}</td>
                                                <td class="">{{ $doc->file_for }}</td>
                                                <td class="">
                                                    @if ($doc->file_path != '')
                                                        {{-- {{ $cost->image_name }} --}}
                                                        <a class="btn-sm btn-success" data-toggle="tooltip"
                                                        data-placement="top" title="Muat turun"
                                                            href="{{ route('downloaddoc', $doc->id) }}"><i
                                                            class="far fa-arrow-alt-circle-down"></i></a>
                                                        <a class="btn-sm btn-info" data-toggle="tooltip"
                                                        data-placement="top" title="Buka" href="{{ route('viewdoc', $doc->id) }}"
                                                            target="_blank"><i class="fas fa-external-link-alt"></i></a>
                                                    @endif
                                                </td>
                                                <td>@role('Owner')
                                                    <a type="button" class="btn btn-danger btn-sm" data-toggle="tooltip"
                                                    data-placement="top" title="Hapus"
                                                        onclick="loadDeleteModal('{{ $house->id }}','{{ $doc->id }}','{{ $doc->file_for }}')"><i
                                                        class="fas fa-trash-alt"></i>
                                                    </a>
                                                    @endrole
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



    <form action="{{ route('housedoc.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="modal" tabindex="-1" role="dialog" id="tambahdoc">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <h5 class="modal-title">
                            <p class="">Tambah dokumen</p>
                        </h5>
                        <div class="row mt-4 ml-2" style="position: fixed;">
                            <small>(* Maklumat wajib diisi)</small>

                        </div>


                    </div>
                    <div class="modal-body">
                        <div class="container">

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="radio_choose_doctype" id="exampleRadios1"
                                    value="option1" checked>
                                <label class="form-check-label" for="exampleRadios1">
                                    Baru
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="radio_choose_doctype" id="exampleRadios2"
                                    value="option2">
                                <label class="form-check-label" for="exampleRadios2">
                                    Pilih dari senarai
                                </label>
                            </div>



                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-6 px-0">
                                    <div class="form-group">
                                        <label for="helpInputTop">Nama jenis dokumen (*) </label>
                                        <small class="text-muted"><i>Seperti tertera di dalam dokumen.</i></small>
                                        <input type="text" class="form-control shadow-sm alphaonly" maxlength="100"
                                            id="new_doc_type" name="new_doc_type" value="{{ old('new_doc_type') }}">
                                    </div>
                                </div>
                                <div class="col-sm-3 col-md-3 col-lg-3 px-2">
                                    <div class="form-group">
                                        <label for="helpInputTop">Jenis dokumen</label>
                                        <small class="text-muted">cth.<i> SPA</i></small>
                                        {{-- {{ old('list_doc_type') }} --}}
                                        <select id="list_doc_type" class="form-control form-select-sm shadow-sm"
                                            aria-label="Default select example" name="list_doc_type" disabled>
                                            <option value="" selected>- Sila Pilih -</option>
                                            @foreach ($global_doc_types as $doc_types)
                                                @if (Request::old('doc_types') == $doc_types->type_id)
                                                    <option value="{{ $doc_types->type_id }}" selected>
                                                        {{ $doc_types->type_name }}</option>
                                                @else
                                                    <option value="{{ $doc_types->type_id }}">
                                                        {{ $doc_types->type_name }}</option>
                                                @endif
                                            @endforeach
                                        </select>

                                        {{-- <input type="text" class="form-control" id="helpInputTop" name="negeri" value="{{ old('negeri') }}"> --}}
                                    </div>
                                </div>
                                <input name="house_id" type="hidden" value="{{ $house->id }}">


                            </div>

                            <div class="row custom-file">
                                <input type="file" class="custom-file-input" id="doc_attachment" name="doc_attachment"
                                    value="{{ old('doc_attachment') }}" multiple="">
                                <label class="custom-file-label" for="doc_attachment">Choose file</label>
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

    <div class="modal fade" id="modal_delete_doc" data-backdrop="static" data-bs-keyboard="false" tabindex="-1"
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
                    <div class="msg" style="position:absolute;float: left;left:0.6rem;color:rgba(4, 124, 40, 0.9)"></div>
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

@endsection

@section('js')
    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

        function loadDeleteModal(house_id, doc_id, file_for) { //not complete yet
            $('#modal_delete_doc .modal-title').text('Anda pasti untuk hapus kos berikut: ');
            $('#modal_delete_doc .modal-body #maklumat_owner').html('<p>Jenis Dokumen: ' + file_for);
            $('#modal_delete_doc #modal-confirm_delete').attr('onclick', 'confirmDelete(' + house_id + ',' + doc_id + ')');
            $('#modal_delete_doc').modal('show');
        }

        function confirmDelete(houseid, doc_id) {
            console.log(doc_id);
            $('#modal_delete_doc .msg').text('');
            $('#modal_delete_doc .msg').hide();

            // return;
            $.ajax({
                url: '/housedoc/' + doc_id,
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    '_method': 'delete',
                    'house_id': houseid,
                },
                success: function(data) {
                    console.log(data);
                    $('#modal_delete_doc .msg').text(data.success);

                    $("#modal_delete_doc .msg").slideDown(300).delay(300).fadeOut(300, 'swing', closeModal);


                },
                error: function(error) {
                    // Error logic goes here..!
                }
            });
        }

        function closeModal() {
            $('#modal_delete_doc').delay(300).modal('hide');
            location.reload();
        }

        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();

            $("#tambahdoc input[type=radio]").on("change", function() {
                if (this.checked) {
                    if (this.value == 'option1') {
                        $('#new_doc_type').removeAttr("disabled");
                        $('#list_doc_type').prop('disabled', 'true');
                    }
                    if (this.value == 'option2') {
                        $('#new_doc_type').prop('disabled', 'true');
                        $('#list_doc_type').removeAttr("disabled");
                    }
                }
            });


        });
    </script>
@endsection
