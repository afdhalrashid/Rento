@extends('layouts.app')

@section('content')
    @if ($disable == 'false')
        <form action="{{ route('houseagreement.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
    @endif
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

        @foreach ($house['agreements'] as $doc)
            @if ($doc->file_for == 'agreement stamping')
                @php
                    $agreementDoc = $doc;
                @endphp
            @endif
        @endforeach

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
                        <h4>Perjanjian Sewa</h4>
                        <p class="text-subtitle text-muted">Senarai Perjanjian Sewa Rumah</p>
                    </div>
                    @if ($disable == 'false')
                        <div class="col-lg-2 col-md-2 order-md-2 order-first">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#tambahagreement">
                                Tambah Dokumen Perjanjian Sewa</button>
                        </div>

                        <div class="col-lg-2 col-md-2 order-md-2">
                            <a href="/houseagreementlinks/{{ $house->id }}" type="button" class="btn btn-secondary">
                                Pautan Perjanjian Sewa</a>
                        </div>
                    @endif
                    {{-- <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('house.index')}}">Senarai Rumah</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Dokumen</li>
                            </ol>
                        </nav>
                    </div> --}}
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
                    <div class="col-sm-9 col-md-9 col-lg-9">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Perjanjian Rumah</h4>
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
                                        @foreach ($house->agreements as $agreement)
                                            <tr>
                                                <td class="">{{ ++$i }}</td>
                                                <td class="">{{ $agreement->file_for }}</td>
                                                                                                                <td class="














                                                    ">
                                                    @if ($agreement->file_path != '')
                                                        {{-- {{ $cost->image_name }} --}}
                                                        <a class="btn-sm
                                                    btn-success" data-toggle="tooltip"
                                                    data-placement="top" title="Muat turun"
                                                            href="{{ route('downloadagreement', $agreement->id) }}">
                                                            <i
                                                            class="far fa-arrow-alt-circle-down"></i></a>
                                                        <a class="btn-sm btn-info" data-toggle="tooltip"
                                                        data-placement="top" title="Buka"
                                                            href="{{ route('viewagreement', $agreement->id) }}"
                                                            target="_blank"><i class="fas fa-external-link-alt"></i></a>
                                                    @endif
                                                </td>
                                                @if ($disable == 'false')
                                                    <td> <button type="button" data-toggle="tooltip"
                                                        data-placement="top" title="Hapus" class="btn btn-danger btn-sm"
                                                            onclick="loadDeleteModal('{{ $house->id }}','{{ $agreement->id }}','{{ $agreement->file_for }}')"><i
                                                            class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        @if ($disable == 'false')
                            <div class="row offset-md-5 offset-lg-5">
                                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                            </div>
                        @endif
                    </div>
                </div>
            </section>



        </div>
    </div>
    @if ($disable == 'false')
        </form>
    @endif

    @if ($disable == 'false')
        <form action="{{ route('houseagreement.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="modal" tabindex="-1" role="dialog" id="tambahagreement">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">

                            <h5 class="modal-title">
                                <p class="">Tambah dokumen perjanjian</p>
                            </h5>
                            <div class="
                                    row mt-4 ml-2" style="position: fixed;">
                                    <small>(* Maklumat wajib diisi)</small>

                        </div>


                    </div>
                    <div class="modal-body">
                        <div class="container">

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="radio_choose_agreementtype"
                                    id="exampleRadios1" value="option1" checked>
                                <label class="form-check-label" for="exampleRadios1">
                                    Baru
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="radio_choose_agreementtype"
                                    id="exampleRadios2" value="option2">
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
                                            id="new_agreement_type" name="new_agreement_type"
                                            value="{{ old('new_agreement_type') }}">
                                    </div>
                                </div>
                                <div class="col-sm-3 col-md-3 col-lg-3 px-2">
                                    <div class="form-group">
                                        <label for="helpInputTop">Jenis dokumen</label>
                                        <small class="text-muted">cth.<i> SPA</i></small>
                                        {{ old('list_doc_type') }}
                                        <select id="list_agreement_type" class="form-control form-select-sm shadow-sm"
                                            aria-label="Default select example" name="list_agreement_type" disabled>
                                            <option value="" selected>- Sila Pilih -</option>
                                            @foreach ($global_agg_types as $agg_types)
                                                @if (Request::old('agg_types') == $agg_types->type_id)
                                                    <option value="{{ $agg_types->type_id }}" selected>
                                                        {{ $agg_types->type_name }}</option>
                                                @else
                                                    <option value="{{ $agg_types->type_id }}">
                                                        {{ $agg_types->type_name }}</option>
                                                @endif
                                            @endforeach
                                        </select>

                                        {{-- <input type="text" class="form-control" id="helpInputTop" name="negeri" value="{{ old('negeri') }}"> --}}
                                    </div>
                                </div>
                                <input name="house_id" type="hidden" value="{{ $house->id }}">


                            </div>

                            <div class="row custom-file">
                                <input type="file" class="custom-file-input" id="agreement_attachment"
                                    name="agreement_attachment" value="{{ old('agreement_attachment') }}" multiple="">
                                <label class="custom-file-label" for="agreement_attachment">Choose file</label>
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

        <div class="modal fade" id="modal_delete_agreement" data-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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


                            <button type="submit" id="modal-confirm_delete" class="btn btn-danger btn-sm">Ya</button>
                        </div>

                    </div>
                    <div class="modal-message" style="display: none;">

                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection

@section('js')
    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

        function loadDeleteModal(house_id, agreement_id, file_for) { //not complete yet
            $('#modal_delete_agreement .modal-title').text('Anda pasti untuk hapus maklumat berikut: ');
            $('#modal_delete_agreement .modal-body #maklumat_owner').html('<p>Jenis Dokumen: ' + file_for);
            $('#modal_delete_agreement #modal-confirm_delete').attr('onclick', 'confirmDelete(' + house_id + ',' +
                agreement_id + ')');
            $('#modal_delete_agreement').modal('show');
        }

        function confirmDelete(houseid, agreement_id) {
            console.log(agreement_id);
            $('#modal_delete_agreement .msg').text('');
            $('#modal_delete_agreement .msg').hide();

            // return;
            $.ajax({
                url: '/houseagreement/' + agreement_id,
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
                    $('#modal_delete_agreement .msg').text(data.success);

                    $("#modal_delete_agreement .msg").slideDown(300).delay(300).fadeOut(300, 'swing',
                        closeModal);


                },
                error: function(error) {
                    // Error logic goes here..!
                }
            });
        }

        function closeModal() {
            $('#modal_delete_agreement').delay(300).modal('hide');
            location.reload();
        }

        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();

            $("#tambahagreement input[type=radio]").on("change", function() {
                if (this.checked) {
                    if (this.value == 'option1') {
                        $('#new_agreement_type').removeAttr("disabled");
                        $('#list_agreement_type').prop('disabled', 'true');
                    }
                    if (this.value == 'option2') {
                        $('#new_agreement_type').prop('disabled', 'true');
                        $('#list_agreement_type').removeAttr("disabled");
                    }
                }
            });


        });
    </script>
@endsection
