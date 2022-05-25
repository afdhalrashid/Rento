@extends('layouts.app')

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

        @foreach ($house['media'] as $media)
            @if ($media->file_for == 'gambar sebelum')
                @php
                    $imgbefore = $media;
                @endphp
            @endif
            @if ($media->file_for == 'gambar selepas')
                @php
                    $imgafter = $media;
                @endphp
            @endif
            @if ($media->file_for == 'video sebelum')
                @php
                    $videobefore = $media;
                @endphp
            @endif

            @if ($media->file_for == 'video selepas')
                @php
                    $videoafter = $media;
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
                        <h4>Kos</h4>
                        <p class="text-subtitle text-muted">Senarai Kos</p>
                    </div>
                    <div class="col-lg-4 order-md-2 order-first">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahkos">
                            Tambah Kos</button>
                    </div>

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
                                <h4 class="card-title">Senarai Kos</h4>
                            </div>
                            <div class="card-body">
                                <table id="listhouse_table" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="">No</th>
                                            <th class="">Jenis Kos</th>
                                                            <th class="
                                                ">
                                                Tahun
                                            </th>
                                            <th class="">Bulan
                                            </th>
                                            <th class="">Tarikh Pembayaran</th>
                                                        <th class="
                                                ">
                                                Jumlah
                                                (RM)</th>
                                            <th class=" ">Catatan</th>
                                            <th class="
                                                ">
                                                Lampiran</th>
                                            <th width="340px">
                                                Tindakan</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($house->cost as $cost)

                                        <tr>
                                            <td class="">{{ ++$i }}</td>
                                            <td class="">{{ $cost->cost_type }}</td>
                                                            <td class="
                                                ">
                                                {{ $cost->year }}</td>
                                            <td class="">
                                                {{ $cost->month }}</td>
                                            <td class="">{{ date('d M Y', strtotime($cost->payment_date)) }}</td>
                                                        <td class="
                                                ">
                                                {{ $cost->value }}</td>
                                            <td class=" ">{{ $cost->remark }}</td>
                                            <td class="
                                                ">
                                                @if ($cost->image_path != '')
                                                    {{-- {{ $cost->image_name }} --}}
                                                    {{-- <a class="btn-sm
                                                btn-success"
                                                        href="{{ route('downloadcost', $cost->id) }}">Download</a>
                                                    <a class="btn-sm btn-info" href="{{ route('viewcost', $cost->id) }}"
                                                        target="_blank">Open</a> --}}

                                                        <a class="btn-sm btn-success" data-toggle="tooltip"
                                                        data-placement="top" title="Muat turun"
                                                            href="{{ route('downloadcost', $cost->id) }}"><i
                                                            class="far fa-arrow-alt-circle-down"></i></a>
                                                        <a class="btn-sm btn-info" data-toggle="tooltip"
                                                        data-placement="top" title="Buka" href="{{ route('viewcost', $cost->id) }}"
                                                            target="_blank"><i class="fas fa-external-link-alt"></i></a>
                                                @endif
                                            </td>
                                            <td>


                                                <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="loadDeleteModal('{{ $house->id }}','{{ $cost->id }}','{{ $cost->cost_type }}', '{{ $cost->year }}', '{{ $cost->month }}', '{{ $cost->value }}')"><i class="far fa-trash-alt"></i>
                                                </button>

                                                {{-- <a class="btn btn-danger btn-sm deletehouse" data-toggle="modal" data-userid="{{$house->id}}" data-target="#modal_delete_house">
                                                  Hapus
                                                </a> --}}

                                                {{-- @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button> --}}

                                            </td>
                                        </tr>
                                    @endforeach
                                </table>

                            </div>
                        </div>
                        {{-- <div class="row offset-md-5 offset-lg-5">
                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        </div> --}}
                    </div>
                </div>
            </section>



        </div>
    </div>


    <form action="{{ route('housecost.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="modal" tabindex="-1" role="dialog" id="tambahkos">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <h5 class="modal-title">
                            <p class="">Tambah kos</p>
                        </h5>
                        <div class="
                                row mt-4 ml-2" style="position: fixed;">
                                <small>(* Maklumat wajib diisi)</small>

                    </div>


                </div>
                <div class="modal-body">
                    <div class="container">

                        <div class="row">
                            <div class="col-sm-3 col-md-3 col-lg-3 px-0">
                                <div class="form-group">
                                    <label for="helpInputTop">Jenis Kos</label>
                                    <small class="text-muted">cth.<i> Penyelenggaraan</i></small>
                                    {{ old('cost_type') }}
                                    <select class="form-control form-select-sm shadow-sm"
                                        aria-label="Default select example" name="cost_type">
                                        <option value="" selected>- Sila Pilih -</option>
                                        @foreach ($global_housecost_types as $cost_type)
                                            @if (Request::old('cost_type') == $cost_type->type_id)
                                                <option value="{{ $cost_type->type_id }}" selected>
                                                    {{ $cost_type->type_name }}</option>
                                            @else
                                                <option value="{{ $cost_type->type_id }}">
                                                    {{ $cost_type->type_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                    {{-- <input type="text" class="form-control" id="helpInputTop" name="negeri" value="{{ old('negeri') }}"> --}}
                                </div>
                            </div>
                            <input name="house_id" type="hidden" value="{{ $house->id }}">

                            <div class="col-sm-3 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label for="helpInputTop">Tahun</label>
                                    <small class="text-muted">cth.<i> 2020</i></small>
                                    {{ old('cost_tahun') }}
                                    <select class="form-control form-select-sm shadow-sm"
                                        aria-label="Default select example" name="cost_tahun">
                                        <option value="" selected>- Sila Pilih -</option>
                                        @php
                                            $years = get_list_year();
                                        @endphp
                                        @foreach ($years as $year)
                                            @if (Request::old('cost_tahun') == $year)
                                                <option value="{{ $year }}" selected>{{ $year }}
                                                </option>
                                            @else
                                                <option value="{{ $year }}">{{ $year }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-2 col-md-2 col-lg-2 px-0">
                                <div class="form-group">
                                    <label for="helpInputTop">Bulan</label>
                                    <small class="text-muted">cth.<i> 1</i></small>
                                    {{ old('cost_bulan') }}
                                    <select class="form-control form-select-sm shadow-sm"
                                        aria-label="Default select example" name="cost_bulan">
                                        <option value="" selected>- Sila Pilih -</option>
                                        @php
                                            $months = get_list_month();
                                        @endphp
                                        @foreach ($months as $month)
                                            @if (Request::old('cost_bulan') == $month)
                                                <option value="{{ $month }}" selected>{{ $month }}
                                                </option>
                                            @else
                                                <option value="{{ $month }}">{{ $month }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                            <div class="form-group">
                                <label for="helpInputTop">Tarikh Pembayaran</label>
                                <small class="text-muted">cth.<i> 28/03/2020</i></small>
                                <div class="datepicker date input-group p-0 shadow-sm">
                                    <input type="text" placeholder="Choose a reservation date" class="form-control py-4 px-4" id="reservationDate">
                                    <div class="input-group-append"><span class="input-group-text px-4"><i class="fa fa-clock-o"></i></span></div>
                                </div>
                            </div>
                        </div> --}}

                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label for="helpInputTop">Tarikh Pembayaran</label>
                                    <small class="text-muted">cth.<i> 28/03/2020</i></small>
                                    <div class="datepicker date input-group p-0 shadow-sm">
                                        <input name="tarikh_bayar_cost" type="text" placeholder="Pilih tarikh"
                                            class="form-control py-1 px-3" id="tarikh_bayar_cost">
                                        <div class="input-group-append"><span class="input-group-text px-4"><i
                                                    class="fa fa-clock-o"></i></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-sm-6 col-md-6 col-lg-6 col offset-sm-3 offset-md-3 offset-lg-3 px-0">
                                <div class="form-group">
                                    <label for="helpInputTop">Jumlah kos (RM)</label>
                                    <small class="text-muted">cth.<i> 120</i></small>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text px-8" id="basic-addon1">RM</span>
                                        </div>
                                        <input type="number"  step=".01"  class="form-control shadow-sm py-5 px-5 text-center"
                                            id="cost_jumlah" name="cost_jumlah" value="{{ old('cost_jumlah') }}"
                                            style="font-size: 2rem;">
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-sm-12 col-md-12 col-lg-12 col px-0">
                                <div class="form-group">
                                    <label for="helpInputTop">Nota kaki (info tambahan)</label>
                                    <small class="text-muted">cth.<i> Wife bayarkan</i></small>
                                    <textarea type="text" class="form-control shadow-sm" id="cost_remark" name="cost_remark"
                                        value="{{ old('cost_remark') }}">
                                                                </textarea>
                                </div>
                            </div>
                        </div>


                        <div class="row custom-file">
                            <input type="file" class="custom-file-input" id="cost_attachment" name="cost_attachment"
                                value="{{ old('cost_attachment') }}" multiple="">
                            <label class="custom-file-label" for="cost_attachment">Choose file</label>
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

    <form id="editform" action="/housetenant/x" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal" tabindex="-1" role="dialog" id="modal_editpenyewa">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <h5 class="modal-title">
                            <p class="">Kemaskini penyewa</p>
                        </h5>
                        <div class="
                                row mt-4 ml-2" style="position: fixed;">
                                <small>(* Maklumat wajib diisi)</small>

                    </div>


                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">

                            <div class="form-group">
                                <label for="helpInputTop">Nama penuh penyewa (*) </label>
                                <small class="text-muted"><i>Seperti tertera di dalam kad pengenalan.</i></small>
                                <input type="text" class="form-control shadow-sm alphaonly" maxlength="100"
                                    id="edit_tenant_name" name="edit_tenant_name">
                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label for="helpInputTop">No kad pengenalan (*) </label>
                                <small class="text-muted">cth.<i> 8xxxx1x3xxx</i></small>
                                <input type="text" class="form-control shadow-sm" id="edit_tenant_ic"
                                    name="edit_tenant_ic">
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-sm-5 col-md-5 col-lg-5 px-0">
                                <div class="form-group">
                                    <label for="helpInputTop">No telefon (HP) (*) </label>
                                    <small class="text-muted">cth.<i> 01833900328</i></small>
                                    <input type="text" class="form-control shadow-sm" id="edit_tenant_phone_no"
                                        name="edit_tenant_phone_no">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="helpInputTop">Email (*) </label>
                                    <small class="text-muted">cth.<i> abu@gmail.com</i></small>
                                    <input type="email" class="form-control shadow-sm" id="edit_tenant_email"
                                        name="edit_tenant_email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="font-weight-bold">Alamat Rumah Penyewa</label>
                            <div class="form-group">
                                <label for="helpInputTop">No rumah dan jalan</label>
                                <small class="text-muted">cth.<i> No. 32, Jln Manggis</i></small>
                                <input type="text" class="form-control shadow-sm" id="edit_tenant_as_in_ic_address1"
                                    name="edit_tenant_as_in_ic_address1">
                            </div>

                        </div>
                        <div class="row">

                            <div class="form-group">
                                <label for="helpInputTop">Taman/Kampung/Desa</label>
                                <small class="text-muted">cth.<i> Tmn Permai Indah</i></small>
                                <input type="text" class="form-control shadow-sm" id="edit_tenant_as_in_ic_address2"
                                    name="edit_tenant_as_in_ic_address2">
                            </div>

                        </div>
                        <div class="row">

                            <div class="col-sm-2 col-md-2 col-lg-2 px-0">
                                <div class="form-group">
                                    <label for="helpInputTop">Poskod</label>
                                    <small class="text-muted">cth.<i> 40200</i></small>
                                    <input type="text" class="form-control shadow-sm" id="edit_tenant_as_in_ic_poskod"
                                        name="edit_tenant_as_in_ic_poskod">
                                </div>
                            </div>
                            <div class="col-sm-4 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label for="helpInputTop">Daerah</label>
                                    <small class="text-muted">cth.<i> Gombak</i></small>
                                    <input type="text" class="form-control shadow-sm alphaonly" maxlength="30"
                                        id="edit_tenant_as_in_ic_daerah" name="edit_tenant_as_in_ic_daerah">
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-6 col-lg-6 px-0">
                                <div class="form-group">
                                    <label for="helpInputTop">Negeri</label>
                                    <small class="text-muted">cth.<i> Selangor</i></small>
                                    {{ old('edit_tenant_as_in_ic_negeri') }}
                                    <select class="form-control form-select-sm shadow-sm"
                                        aria-label="Default select example" id="edit_tenant_as_in_ic_negeri"
                                        name="edit_tenant_as_in_ic_negeri">
                                        <option value="" selected>- Sila Pilih -</option>
                                        @foreach ($global_states as $state)
                                            {{-- <option value="{{ $region->type_id }}">{{ $region->type_name }}</option> --}}

                                            @if (Request::old('edit_tenant_as_in_ic_negeri') == $state->type_id)
                                                <option value="{{ $state->type_id }}" selected>
                                                    {{ $state->type_name }}</option>
                                            @else
                                                <option value="{{ $state->type_id }}">{{ $state->type_name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>

                                    {{-- <input type="text" class="form-control" id="helpInputTop" name="negeri" value="{{ old('negeri') }}"> --}}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3 col-md-3 col-lg-3 px-0">
                                <div class="form-group">
                                    <label for="helpInputTop">Bangsa</label>
                                    <small class="text-muted">cth.<i> Melayu</i></small>
                                    {{ old('tenant_race') }}
                                    <select class="form-control form-select-sm shadow-sm"
                                        aria-label="Default select example" id="edit_tenant_race" name="edit_tenant_race">
                                        <option value="" selected>- Sila Pilih -</option>
                                        @foreach ($global_races as $race)
                                            @if (Request::old('race') == $race->type_id)
                                                <option value="{{ $race->type_id }}" selected>
                                                    {{ $race->type_name }}</option>
                                            @else
                                                <option value="{{ $race->type_id }}">{{ $race->type_name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>

                                    {{-- <input type="text" class="form-control" id="helpInputTop" name="negeri" value="{{ old('negeri') }}"> --}}
                                </div>
                            </div>
                            <input name="house_id" type="hidden" value="{{ $house->id }}">

                            <div class="col-sm-3 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label for="helpInputTop">Sudah bekerja</label>
                                    <small class="text-muted">cth.<i> Ya/Tidak</i></small>
                                    {{ old('tenant_is_work') }}
                                    <select class="form-control form-select-sm shadow-sm"
                                        aria-label="Default select example" name="edit_tenant_is_work"
                                        id="edit_tenant_is_work">
                                        <option value="" selected>- Sila Pilih -</option>
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak bekerja</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-3 col-md-3 col-lg-3 px-0">
                                <div class="form-group">
                                    <label for="helpInputTop">Sudah berkeluarga</label>
                                    <small class="text-muted">cth.<i> Ya/Tidak</i></small>
                                    {{ old('tenant_is_married') }}
                                    <select class="form-control form-select-sm shadow-sm"
                                        aria-label="Default select example" id="edit_tenant_is_married"
                                        name="edit_tenant_is_married">
                                        <option value="" selected>- Sila Pilih -</option>
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Bujang</option>
                                    </select>

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

    <div class="modal fade" id="modal_delete_cost" data-backdrop="static" data-bs-keyboard="false" tabindex="-1"
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
@endsection

@section('js')
    <script>
        setInputFilter(document.getElementById("cost_jumlah"), function(value) {
            // return /^\d*$/.test(value);
            return /^\d+(?:\.\d{1,2})?$/.test(value);
        });

        // $('.alphaonly').bind('keyup blur',function(){
        //     var node = $(this);
        //     node.val(node.val().replace(/[^a-zA-Z]/g,'') ); }
        // );

        $(".alphaonly").on("keydown", function(event) {
            // Allow controls such as backspace, tab etc.
            var arr = [8, 9, 16, 17, 20, 32, 35, 36, 37, 38, 39, 40, 45, 46];

            // Allow letters
            for (var i = 65; i <= 90; i++) {
                arr.push(i);
            }

            // Prevent default if not in array
            if (jQuery.inArray(event.which, arr) === -1) {
                event.preventDefault();
            }
        });


        // $("#phone_no" ).change(function () {
        //     var userInput = this.value;
        //     minlength = 5;
        //     maxlength = 5;

        //     if(userInput.length >= minlength && userInput.length <= maxlength)
        //         {
        //             return true;
        //         }
        //     else
        //         {
        //         alert("Please input between " +minlength+ " and " +maxlength+ " characters");
        //             return false;
        //         }
        // });

        // $('#tenant_phone_no').on('keyup', function() {
        //     limitText(this, 10)
        // });

        // $('#tenant_ic').on('keyup', function() {
        //     limitText(this, 12)
        // });

        // $('#tenant_as_in_ic_poskod').on('keyup', function() {
        //     limitText(this, 5)
        // });

        $('[name="cost_jumlah"]').on('keyup', function() {
            limitText(this, 8)
        });



        function limitText(field, maxChar) {
            var ref = $(field),
                val = ref.val();
            if (val.length >= maxChar) {
                ref.val(function() {
                    console.log(val.substr(0, maxChar))
                    return val.substr(0, maxChar);
                });
            }
        }

        function loadEditModal(house_id, tenant_id) {

            url = $('#editform').attr('action');
            new_url = url.replace('x', tenant_id);
            $('#editform').attr('action', new_url);

            $.ajax({
                type: "GET",
                url: '/housetenant/tenant/' + tenant_id, // This is what I have updated
                data: {}
            }).done(function(data) {
                console.log(data['tenant_name']);

                $('#edit_tenant_name').val(data['tenant_name']);
                $('#edit_tenant_ic').val(data['tenant_ic']);
                $('#edit_tenant_phone_no').val(data['tenant_phone_no']);
                $('#edit_tenant_email').val(data['tenant_email']);
                $('#edit_tenant_as_in_ic_address1').val(data['tenant_as_in_ic_address1']);
                $('#edit_tenant_as_in_ic_address2').val(data['tenant_as_in_ic_address2']);
                $('#edit_tenant_as_in_ic_poskod').val(data['tenant_as_in_ic_poskod']);
                $('#edit_tenant_as_in_ic_daerah').val(data['tenant_as_in_ic_daerah']);
                $("#edit_tenant_as_in_ic_negeri").val(data['tenant_as_in_ic_negeri']).change();
                $("#edit_tenant_race").val(data['tenant_race']).change();
                $("#edit_tenant_is_work").val(data['tenant_is_work']).change();
                $("#edit_tenant_is_married").val(data['tenant_is_married']).change();
                // $('#edit_tenant_as_in_ic_negeri option[value=data['tenant_as_in_ic_negeri']]").attr('selected','selected');
            });

            $('#modal_editpenyewa').modal('show');
        }

        function loadDeleteModal(house_id, cost_id, jenis, tahun, bulan, jumlah) { //not complete yet
            $('#modal_delete_cost .modal-title').text('Anda pasti untuk hapus kos berikut: ');
            $('#modal_delete_cost .modal-body #maklumat_owner').html('<p>Jenis Kos: ' + jenis + '</p>' + '<p>Tahun: ' +
                tahun + '</p>' + '<p>Bulan: ' + bulan + '</p>' + '<p>Jumlah : RM' + jumlah + '</p>');
            $('#modal_delete_cost #modal-confirm_delete').attr('onclick', 'confirmDelete(' + house_id + ',' + cost_id +
                ')');
            $('#modal_delete_cost').modal('show');
        }

        function confirmDelete(houseid, cost_id) {
            console.log(cost_id);
            $('#modal_delete_cost .msg').text('');
            $('#modal_delete_cost .msg').hide();

            // return;
            $.ajax({
                url: '/housecost/' + cost_id,
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
                    $('#modal_delete_cost .msg').text(data.success);

                    $("#modal_delete_cost .msg").slideDown(700).delay(3000).fadeOut(900, 'swing', closeModal);


                },
                error: function(error) {
                    // Error logic goes here..!
                }
            });
        }

        function closeModal() {
            $('#modal_delete_cost').delay(1000).modal('hide');
            location.reload();
        }
        $('.datepicker').datepicker({
            clearBtn: true,
            format: "dd/mm/yyyy"
        });

        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
@endsection
