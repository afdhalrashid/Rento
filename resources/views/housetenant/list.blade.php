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
                    <div class="col-lg-2 col-md-2 order-md-1 order-last">
                        <h4>Penyewa</h4>
                        <p class="text-subtitle text-muted">Senarai Penyewa</p>
                    </div>
                    <div class="col-lg-4 order-md-2 order-first">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahpenyewa">
                            Tambah Penyewa</button>
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
                    <div class="col-sm-2 col-md-2 col-lg-2">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Maklumat Rumah</h4>
                            </div>
                            <div class="card-body">
                                @include('layouts.houseprofile2')
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-10 col-md-10 col-lg-10">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Maklumat Penyewa</h4>
                            </div>
                            <div class="card-body" style="overflow-x: auto;">
                                <table id="listhouse_table" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="">No</th>
                                            <th class="">Nama</th>
                                                                <th class="

                                                ">
                                                No
                                                Kad
                                                Pengenalan</th>
                                            <th class=""
                                                width=" 23%">Alamat
                                            </th>
                                            <th class="">No Telefon</th>
                                            <th class="">Emel</th>
                                                                <th class="

                                                ">
                                                Bangsa
                                            </th>
                                            <th class="">
                                                Berkahwin?</th>
                                            <th class="">Bekerja?</th>

                                                            <th width=" 340px">Tindakan</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($house->tenant as $tenant)

                                        <tr>
                                            <td class="">{{ ++$i }}</td>
                                            <td class="">{{ $tenant->tenant_name }}</td>
                                                                <td class="

                                                ">
                                                {{ $tenant->tenant_ic }}</td>
                                            <td class="">
                                                {{ $tenant->tenant_as_in_ic_address1 }},
                                                {{ $tenant->tenant_as_in_ic_address2 }},
                                                {{ $tenant->tenant_as_in_ic_poskod }},
                                                {{ $tenant->tenant_as_in_ic_daerah }},
                                                {{ $tenant->parameter_state->type_name }}</td>
                                            <td class="">{{ $tenant->tenant_phone_no }}</td>
                                                            <td class="
                                                ">
                                                {{ $tenant->tenant_email }}</td>
                                            <td class=" ">{{ $tenant->parameter_race->type_name }}</td>
                                            <td class="
                                                ">
                                                {{ $tenant->tenant_is_married }}</td>
                                            <td class="">
                                                {{ $tenant->tenant_is_work }}</td>
                                            <td>


                                                {{-- <a class="btn btn-info btn-sm" href="{{ route('house.show',$house->id) }}">Show</a> --}}

                                                {{-- <a class="btn btn-primary btn-sm" href="{{ route('house.edit',$house->id) }}">Kemaskini</a> --}}

                                                <button type="
                                                button" class="btn btn-primary btn-sm" data-toggle="tooltip"
                                                data-placement="top" title="Kemaskini"
                                                onclick="loadEditModal('{{ $house->id }}','{{ $tenant->id }}')">
                                                <i class="fa fa-pencil"
                                            aria-hidden="true"></i>
                                                </button>

                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip"
                                                data-placement="top" title="Hapus"
                                                    onclick="loadDeleteModal('{{ $house->id }}','{{ $tenant->id }}','{{ $tenant->tenant_name }}', '{{ $tenant->tenant_ic }}')"><i
                                                    class="fas fa-trash-alt"></i>
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


    <form action="{{ route('housetenant.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="modal" tabindex="-1" role="dialog" id="tambahpenyewa">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <h5 class="modal-title">

                            <p class="font-bold" style="font-size: 18px"><i class="fas fa-user-plus mx-2 pb-2"
                                    style="vertical-align: center;"></i>Tambah
                                penyewa
                            </p>
                            <div class="row ml-2" style="position: relative;">
                                <small>(* Maklumat wajib diisi)</small>

                            </div>
                        </h5>



                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-6 px-0">
                                    <div class="form-group">
                                        <label for="helpInputTop">Pilih profil penyewa</label>
                                        <small class="text-muted">cth.<i> Ahmad Zakiuddin</i></small>

                                        <select class="form-control form-select-sm shadow-sm"
                                            aria-label="Default select example" id="tenant_user_id" name="tenant_user_id">
                                            <option value="" selected>- Sila Pilih -</option>
                                            @foreach ($users_createdby_owner as $user)
                                                {{-- <option value="{{ $region->type_id }}">{{ $region->type_name }}</option> --}}

                                                @if (Request::old('tenant_user_id') == $user->id)
                                                    <option value="{{ $user->id }}" selected>{{ $user->name }} ({{ $user->email }})</option>
                                                @else
                                                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                                @endif
                                            @endforeach
                                        </select>

                                        {{-- <input type="text" class="form-control" id="helpInputTop" name="negeri" value="{{ old('negeri') }}"> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="form-group">
                                    <label for="helpInputTop">Nama penuh penyewa (*) </label>
                                    <small class="text-muted"><i>Seperti tertera di dalam kad pengenalan.</i></small>
                                    <input type="text" class="form-control shadow-sm alphaonly" maxlength="100"
                                        id="tenant_name" name="tenant_name" value="{{ old('tenant_name') }}">
                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label for="helpInputTop">No kad pengenalan (*) </label>
                                    <small class="text-muted">cth.<i> 8xxxx1x3xxx</i></small>
                                    <input type="text" class="form-control shadow-sm" id="tenant_ic" name="tenant_ic"
                                        value="{{ old('tenant_ic') }}">
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-sm-5 col-md-5 col-lg-5 px-0">
                                    <div class="form-group">
                                        <label for="helpInputTop">No telefon (HP) (*) </label>
                                        <small class="text-muted">cth.<i> 01833900328</i></small>
                                        <input type="text" class="form-control shadow-sm" id="tenant_phone_no"
                                            name="tenant_phone_no" value="{{ old('tenant_phone_no') }}">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="helpInputTop">Email (*) </label>
                                        <small class="text-muted">cth.<i> abu@gmail.com</i></small>
                                        <input type="email" class="form-control shadow-sm" id="tenant_email"
                                            name="tenant_email" value="{{ old('tenant_email') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="font-weight-bold" style="font-size: 14px;">Alamat Surat Menyurat
                                    Penyewa</label>
                                <div class="form-group">
                                    <label for="helpInputTop">No rumah dan jalan</label>
                                    <small class="text-muted">cth.<i> No. 32, Jln Manggis</i></small>
                                    <input type="text" class="form-control shadow-sm" id="helpInputTop"
                                        name="tenant_as_in_ic_address1" value="{{ old('tenant_as_in_ic_address1') }}">
                                </div>

                            </div>
                            <div class="row">

                                <div class="form-group">
                                    <label for="helpInputTop">Taman/Kampung/Desa</label>
                                    <small class="text-muted">cth.<i> Tmn Permai Indah</i></small>
                                    <input type="text" class="form-control shadow-sm" id="helpInputTop"
                                        name="tenant_as_in_ic_address2" value="{{ old('tenant_as_in_ic_address2') }}">
                                </div>

                            </div>
                            <div class="row">

                                <div class="col-sm-2 col-md-2 col-lg-2 px-0">
                                    <div class="form-group">
                                        <label for="helpInputTop">Poskod</label>
                                        <small class="text-muted">cth.<i> 40200</i></small>
                                        <input type="text" class="form-control shadow-sm" id="tenant_as_in_ic_poskod"
                                            name="tenant_as_in_ic_poskod" value="{{ old('tenant_as_in_ic_poskod') }}">
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label for="helpInputTop">Daerah</label>
                                        <small class="text-muted">cth.<i> Gombak</i></small>
                                        <input type="text" class="form-control shadow-sm alphaonly" maxlength="30"
                                            id="helpInputTop" name="tenant_as_in_ic_daerah"
                                            value="{{ old('tenant_as_in_ic_daerah') }}">
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-6 col-lg-6 px-0">
                                    <div class="form-group">
                                        <label for="helpInputTop">Negeri</label>
                                        <small class="text-muted">cth.<i> Selangor</i></small>
                                        {{ old('tenant_as_in_ic_negeri') }}
                                        <select class="form-control form-select-sm shadow-sm" id="tenant_as_in_ic_negeri"
                                            aria-label="Default select example" name="tenant_as_in_ic_negeri">
                                            <option value="" selected>- Sila Pilih -</option>
                                            @foreach ($global_states as $state)
                                                {{-- <option value="{{ $region->type_id }}">{{ $region->type_name }}</option> --}}

                                                @if (Request::old('tenant_as_in_ic_negeri') == $state->type_id)
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
                                            aria-label="Default select example" name="tenant_race">
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

                                <div class="col-sm-4 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label for="helpInputTop">Sudah bekerja</label>
                                        <small class="text-muted">cth.<i> Ya/Tidak</i></small>
                                        {{ old('tenant_is_work') }}
                                        <select class="form-control form-select-sm shadow-sm"
                                            aria-label="Default select example" name="tenant_is_work">
                                            <option value="" selected>- Sila Pilih -</option>
                                            <option value="Ya">Ya</option>
                                            <option value="Tidak">Tidak bekerja</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-4 col-md-4 col-lg-4 px-0">
                                    <div class="form-group">
                                        <label for="helpInputTop">Sudah berkeluarga</label>
                                        <small class="text-muted">cth.<i> Ya/Tidak</i></small>
                                        {{ old('tenant_is_married') }}
                                        <select class="form-control form-select-sm shadow-sm"
                                            aria-label="Default select example" name="tenant_is_married">
                                            <option value="" selected>- Sila Pilih -</option>
                                            <option value="Ya">Ya</option>
                                            <option value="Tidak">Bujang</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="font-weight-bold">Kenderaan Penyewa</label>
                            </div>
                            <div class="row">

                                {{-- <div class="col-sm-7 col-md-7 col-lg-7">
                                    <div class="form-group">
                                        <label for="tenant_vehicle_type_with_name">Jenis Kenderaan (*) </label>
                                        <small class="text-muted">cth.<i> Yamaha 150 (Y15) / Honda Civic</i></small>
                                        <input type="text" class="form-control shadow-sm" id="tenant_vehicle_type_with_name"
                                            name="tenant_vehicle_type_with_name"
                                            value="{{ old('tenant_vehicle_type_with_name') }}">
                                    </div>
                                </div> --}}
                                <div class="col-sm-5 col-md-5 col-lg-5 px-0">
                                    <div class="form-group">
                                        <label for="tenant_vehicle_type">Jenis Kenderaan</label>
                                        <small class="text-muted">cth.<i> Kereta</i></small>
                                        <select class="form-control form-select-sm shadow-sm"
                                            aria-label="Default select example" name="tenant_vehicle_type[]">
                                            <option value="" selected>- Sila Pilih -</option>
                                            @foreach ($global_vehicle_type as $vehicle_type)
                                                {{-- <option value="{{ $region->type_id }}">{{ $region->type_name }}</option> --}}

                                                @if (Request::old('tenant_vehicle_type') == $vehicle_type->type_id)
                                                    <option value="{{ $vehicle_type->type_id }}" selected>
                                                        {{ $vehicle_type->type_name }}</option>
                                                @else
                                                    <option value="{{ $vehicle_type->type_id }}">
                                                        {{ $vehicle_type->type_name }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4 col-lg-4 px-2">
                                    <div class="form-group">
                                        <label for="tenant_vehicle_count">Bilangan Kenderaan</label>
                                        <small class="text-muted">cth.<i> 1/2/3</i></small>
                                        <input type="text" class="form-control shadow-sm" id="tenant_vehicle_count"
                                            name="tenant_vehicle_count[]">
                                    </div>
                                </div>
                                <div class="col-sm-2 col-md-2 col-lg-2 px-1">
                                    <div class="form-group">
                                        <label for="helpInputTop">&nbsp;</label>
                                        <button id="new_item" class="btn-sm btn-success form-control"><i
                                                class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>

                            <div id="newUpload">

                            </div>

                            <div class="row">
                                <label class="font-weight-bold">Maklumat Majikan Penyewa</label>
                            </div>
                            <div class="row">
                                <div class="col-sm-5 col-md-5 col-lg-5 px-0">
                                    <div class="form-group">
                                        <label for="tenant_company_name">Nama Majikan(*) </label>
                                        <small class="text-muted">cth.<i> Nusajaya Sdn Bhd</i></small>
                                        <input type="Atext" class="form-control shadow-sm" id="tenant_company_name"
                                            name="tenant_company_name" value="{{ old('tenant_company_name') }}">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="tenant_company_phone">No telefon Majikan (*) </label>
                                        <small class="text-muted">cth.<i> 03-72323011</i></small>
                                        <input type="text" class="form-control shadow-sm" id="tenant_company_phone"
                                            name="tenant_company_phone" value="{{ old('tenant_company_phone') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label class="font-weight-bold">Alamat Majikan Penyewa</label>
                                <div class="form-group">
                                    <label for="tenant_company_address1">Alamat (1)</label>
                                    <small class="text-muted">cth.<i> No. 32, Jln Manggis</i></small>
                                    <input type="text" class="form-control shadow-sm" id="helpInputTop"
                                        name="tenant_company_address1" value="{{ old('tenant_company_address1') }}">
                                </div>

                            </div>
                            <div class="row">

                                <div class="form-group">
                                    <label for="tenant_company_address2">Alamat (2)</label>
                                    <small class="text-muted">cth.<i> Tmn Permai Indah</i></small>
                                    <input type="text" class="form-control shadow-sm" id="helpInputTop"
                                        name="tenant_company_address2" value="{{ old('tenant_company_address2') }}">
                                </div>

                            </div>
                            <div class="row">

                                <div class="col-sm-2 col-md-2 col-lg-2 px-0">
                                    <div class="form-group">
                                        <label for="tenant_company_poskod">Poskod</label>
                                        <small class="text-muted">cth.<i> 40200</i></small>
                                        <input type="text" class="form-control shadow-sm" id="tenant_company_poskod"
                                            name="tenant_company_poskod" value="{{ old('tenant_company_poskod') }}">
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label for="tenant_company_daerah">Daerah</label>
                                        <small class="text-muted">cth.<i> Gombak</i></small>
                                        <input type="text" class="form-control shadow-sm alphaonly" maxlength="30"
                                            id="helpInputTop" name="tenant_company_daerah"
                                            value="{{ old('tenant_company_daerah') }}">
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-6 col-lg-6 px-0">
                                    <div class="form-group">
                                        <label for="tenant_company_negeri">Negeri</label>
                                        <small class="text-muted">cth.<i> Selangor</i></small>
                                        {{ old('tenant_company_negeri') }}
                                        <select class="form-control form-select-sm shadow-sm"
                                            aria-label="Default select example" name="tenant_company_negeri">
                                            <option value="" selected>- Sila Pilih -</option>
                                            @foreach ($global_states as $state)
                                                {{-- <option value="{{ $region->type_id }}">{{ $region->type_name }}</option> --}}

                                                @if (Request::old('tenant_company_negeri') == $state->type_id)
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

                        {{-- <h5 class="modal-title">
                            <p class="">Kemaskini penyewa</p>
                        </h5> --}}
                        <h5 class="modal-title">
                            <p class="font-bold" style="font-size: 18px"><i class="fas fa-user-plus mx-2 pb-2"
                                    style="vertical-align: center;"></i>Kemaskini
                                penyewa
                            </p>
                        </h5>
                        <div class="row mt-5 ml-2" style="position: absolute;">
                            <small>(* Maklumat wajib diisi)</small>

                        </div>


                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-6 px-0">
                                    <div class="form-group">
                                        <label for="helpInputTop">Pilih profil penyewa</label>
                                        <small class="text-muted">cth.<i> Ahmad Zakiuddin</i></small>

                                        <select class="form-control form-select-sm shadow-sm"
                                            aria-label="Default select example" id="edit_tenant_user_id" name="edit_tenant_user_id">
                                            <option value="">- Sila Pilih -</option>
                                            @foreach ($users_createdby_owner as $user)
                                                {{-- <option value="{{ $region->type_id }}">{{ $region->type_name }}</option> --}}

                                                @if (Request::old('edit_tenant_user_id') == $user->id)
                                                    <option value="{{ $user->id }}" selected>{{ $user->name }}
                                                        ({{ $user->email }})</option>
                                                @else
                                                    <option value="{{ $user->id }}">{{ $user->name }}
                                                        ({{ $user->email }})</option>
                                                @endif
                                            @endforeach
                                        </select>

                                        {{-- <input type="text" class="form-control" id="helpInputTop" name="negeri" value="{{ old('negeri') }}"> --}}
                                    </div>
                                </div>
                            </div>
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
                                        <select class="form-control form-select-sm shadow-sm"
                                            aria-label="Default select example" id="edit_tenant_race"
                                            name="edit_tenant_race">
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

                                <div class="col-sm-4 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label for="helpInputTop">Sudah bekerja</label>
                                        <small class="text-muted">cth.<i> Ya/Tidak</i></small>
                                        <select class="form-control form-select-sm shadow-sm"
                                            aria-label="Default select example" name="edit_tenant_is_work"
                                            id="edit_tenant_is_work">
                                            <option value="" selected>- Sila Pilih -</option>
                                            <option value="Ya">Ya</option>
                                            <option value="Tidak">Tidak bekerja</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-4 col-md-4 col-lg-4 px-0">
                                    <div class="form-group">
                                        <label for="helpInputTop">Sudah berkeluarga</label>
                                        <small class="text-muted">cth.<i> Ya/Tidak</i></small>

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
                            <div class="row">
                                <label class="font-weight-bold">Kenderaan Penyewa</label>
                            </div>
                            <div id="edititem"></div>


                            <div class="row">
                                <label class="font-weight-bold">Maklumat Majikan Penyewa</label>
                            </div>
                            <div class="row">
                                <div class="col-sm-5 col-md-5 col-lg-5 px-0">
                                    <div class="form-group">
                                        <label for="edit_tenant_company_name">Nama Majikan(*) </label>
                                        <small class="text-muted">cth.<i> Nusajaya Sdn Bhd</i></small>
                                        <input type="Atext" class="form-control shadow-sm" id="edit_tenant_company_name"
                                            name="edit_tenant_company_name"
                                            value="{{ old('edit_tenant_company_name') }}">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="edit_tenant_company_phone">No telefon Majikan (*) </label>
                                        <small class="text-muted">cth.<i> 03-72323011</i></small>
                                        <input type="text" class="form-control shadow-sm" id="edit_tenant_company_phone"
                                            name="edit_tenant_company_phone"
                                            value="{{ old('edit_tenant_company_phone') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label class="font-weight-bold">Alamat Majikan Penyewa</label>
                                <div class="form-group">
                                    <label for="edit_tenant_company_address1">Alamat (1)</label>
                                    <small class="text-muted">cth.<i> No. 32, Jln Manggis</i></small>
                                    <input type="text" class="form-control shadow-sm" id="edit_tenant_company_address1"
                                        name="edit_tenant_company_address1"
                                        value="{{ old('edit_tenant_company_address1') }}">
                                </div>

                            </div>
                            <div class="row">

                                <div class="form-group">
                                    <label for="edit_tenant_company_address2">Alamat (2)</label>
                                    <small class="text-muted">cth.<i> Tmn Permai Indah</i></small>
                                    <input type="text" class="form-control shadow-sm" id="edit_tenant_company_address2"
                                        name="edit_tenant_company_address2"
                                        value="{{ old('edit_tenant_company_address2') }}">
                                </div>

                            </div>
                            <div class="row">

                                <div class="col-sm-2 col-md-2 col-lg-2 px-0">
                                    <div class="form-group">
                                        <label for="edit_tenant_company_poskod">Poskod</label>
                                        <small class="text-muted">cth.<i> 40200</i></small>
                                        <input type="text" class="form-control shadow-sm" id="edit_tenant_company_poskod"
                                            name="edit_tenant_company_poskod"
                                            value="{{ old('edit_tenant_company_poskod') }}">
                                    </div>
                                </div>
                                <div class="col-sm-4 col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label for="edit_tenant_company_daerah">Daerah</label>
                                        <small class="text-muted">cth.<i> Gombak</i></small>
                                        <input type="text" class="form-control shadow-sm alphaonly" maxlength="30"
                                            id="edit_tenant_company_daerah" name="edit_tenant_company_daerah"
                                            value="{{ old('edit_tenant_company_daerah') }}">
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-6 col-lg-6 px-0">
                                    <div class="form-group">
                                        <label for="edit_tenant_company_negeri">Negeri</label>
                                        <small class="text-muted">cth.<i> Selangor</i></small>
                                        {{ old('edit_tenant_company_negeri') }}
                                        <select class="form-control form-select-sm shadow-sm"
                                            aria-label="Default select example" id="edit_tenant_company_negeri"
                                            name="edit_tenant_company_negeri">
                                            <option value="" selected>- Sila Pilih -</option>
                                            @foreach ($global_states as $state)
                                                {{-- <option value="{{ $region->type_id }}">{{ $region->type_name }}</option> --}}

                                                @if (Request::old('edit_tenant_company_negeri') == $state->type_id)
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



                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Kemaskini</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="modal fade" id="modal_delete_house2" data-backdrop="static" data-bs-keyboard="false" tabindex="-1"
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
        // console.log(document.getElementsByName("tenant_phone_no"));

        setInputFilter(document.getElementById("tenant_phone_no"), function(value) {
            return /^\d*$/.test(value);
        });

        setInputFilter(document.getElementById("edit_tenant_phone_no"), function(value) {
            return /^\d*$/.test(value);
        });

        setInputFilter(document.getElementById("tenant_ic"), function(value) {
            return /^\d*$/.test(value);
        });

        setInputFilter(document.getElementById("edit_tenant_ic"), function(value) {
            return /^\d*$/.test(value);
        });

        setInputFilter(document.getElementById("tenant_as_in_ic_poskod"), function(value) {
            return /^\d*$/.test(value);
        });

        setInputFilter(document.getElementById("edit_tenant_as_in_ic_poskod"), function(value) {
            return /^\d*$/.test(value);
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

        $('[name="tenant_phone_no"]').on('keyup', function() {
            limitText(this, 12)
        });

        $('[name="tenant_ic"]').on('keyup', function() {
            limitText(this, 12)
        });

        $('[name="tenant_as_in_ic_poskod"]').on('keyup', function() {
            limitText(this, 5)
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

        $('#tenant_user_id').on('change', function() {
            // alert($("#tenant_user_id option:selected").text());
            text = $("#tenant_user_id option:selected").text();
            userArray = text.split('(');
            console.log(userArray);
            $('#tenant_name').val(userArray[0]);
            // userArray[1] = userArray[1].replace(/\)/, '');
            userArray2 = userArray[1].split(')');
            console.log(userArray2);
            $('#tenant_email').val(userArray2[0]);
        });

        $('#edit_tenant_user_id').on('change', function() {
            // alert($("#tenant_user_id option:selected").text());
            text = $("#edit_tenant_user_id option:selected").text();
            userArray = text.split('(');
            console.log(userArray);
            $('#edit_tenant_name').val(userArray[0]);
            // userArray[1] = userArray[1].replace(/\)/, '');
            userArray2 = userArray[1].split(')');
            console.log(userArray2);
            $('#edit_tenant_email').val(userArray2[0]);
        });

        $('#new_item').click(function(e) {
            e.preventDefault();

            // $('#new_item').prop("disabled", true);

            console.log($('#newUpload').children().length);

            var tenant_vehicle_type = $('select[name="tenant_vehicle_type[]"]');

            var tenant_vehicle_type_array = [];


            tenant_vehicle_type.each(function() {
                var aValue = $(this).val();
                tenant_vehicle_type_array.push(aValue);
                // console.log(aValue);
            });

            console.log(tenant_vehicle_type_array);

            var v = $('#newUpload').children().length;

            if (v >= 4) {
                window.alert('Hanya 5 muatnaik sahaja dibenarkan');
                return;
            }
            $.ajax({
                url: '/housetenant/vehicle/addItemHTML',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    tenant_vehicle_type_array: tenant_vehicle_type_array
                },
                success: function(data) {
                    // console.log(data);
                    // var content = $('<div>').append(data).find('#newUpload');
                    // $('#newUpload').html( content );

                    if (data == 'er') {
                        window.alert('Hanya 5 muatnaik sahaja dibenarkan');
                    } else {
                        var content = data;
                        // console.log(data);

                        $('#newUpload').append(content);
                        $('#new_item').prop("disabled", false);
                    }
                }
            });
        });

        function addnewEditItem() {


            // $('#new_item').prop("disabled", true);

            console.log($('#edititem').children().length);

            var tenant_vehicle_type = $('select[name="edit_tenant_vehicle_type[]"]');

            var tenant_vehicle_type_array = [];


            tenant_vehicle_type.each(function() {
                var aValue = $(this).val();
                tenant_vehicle_type_array.push(aValue);
                // console.log(aValue);
            });

            console.log(tenant_vehicle_type_array);

            var v = $('#edititem').children().length;

            if (v >= 4) {
                window.alert('Hanya 4 kenderaan sahaja dibenarkan');
                return;
            }
            $.ajax({
                url: '/housetenant/vehicle/addItemHTML',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    tenant_vehicle_type_array: tenant_vehicle_type_array,
                    type: 'edit'
                },
                success: function(data) {
                    // console.log(data);
                    // var content = $('<div>').append(data).find('#newUpload');
                    // $('#newUpload').html( content );

                    if (data == 'er') {
                        window.alert('Hanya 5 muatnaik sahaja dibenarkan');
                    } else {
                        var content = data;
                        // console.log(data);

                        $('#edititem').append(content);
                        // $('#new_item').prop("disabled", false);
                    }
                }
            });
        }

        function loadEditModal(house_id, tenant_id) {

            url = $('#editform').attr('action');
            new_url = url.replace('x', tenant_id);
            $('#editform').attr('action', new_url);
            $('#edititem').empty();

            $.ajax({
                type: "GET",
                url: '/housetenant/tenant/' + tenant_id, // This is what I have updated
                data: {}
            }).done(function(data) {
                console.log(data);
                $("#edit_tenant_user_id option[value=" + data['tenant_user_id'] + "]").attr('selected', 'selected');
                $('#edit_tenant_name').val(data['tenant_name']);
                $('#edit_tenant_ic').val(data['tenant_ic']);
                $('#edit_tenant_phone_no').val(data['tenant_phone_no']);
                $('#edit_tenant_email').val(data['tenant_email']);
                $('#edit_tenant_as_in_ic_address1').val(data['tenant_as_in_ic_address1']);
                $('#edit_tenant_as_in_ic_address2').val(data['tenant_as_in_ic_address2']);
                $('#edit_tenant_as_in_ic_poskod').val(data['tenant_as_in_ic_poskod']);
                $('#edit_tenant_as_in_ic_daerah').val(data['tenant_as_in_ic_daerah']);
                console.log(data['tenant_as_in_ic_negeri']);
                // $("#edit_tenant_as_in_ic_negeri").val(data['tenant_as_in_ic_negeri']).change();
                $("#edit_tenant_as_in_ic_negeri option[value=" + data['tenant_as_in_ic_negeri'] + "]").attr(
                    'selected', 'selected');
                $("#edit_tenant_race").val(data['tenant_race']).change();
                $("#edit_tenant_is_work").val(data['tenant_is_work']).change();
                $("#edit_tenant_is_married").val(data['tenant_is_married']).change();
                $("#edit_tenant_vehicle_plate_no").val(data['tenant_vehicle_plate_no']).change();
                $("#edit_tenant_vehicle_type_with_name").val(data['tenant_vehicle_type_with_name']).change();
                $("#edit_tenant_company_name").val(data['tenant_company_name']).change();
                $("#edit_tenant_company_phone").val(data['tenant_company_phone']).change();
                $("#edit_tenant_company_address1").val(data['tenant_company_address1']).change();
                $("#edit_tenant_company_address2").val(data['tenant_company_address2']).change();
                $("#edit_tenant_company_poskod").val(data['tenant_company_poskod']).change();
                $("#edit_tenant_company_daerah").val(data['tenant_company_daerah']).change();
                // $("#edit_tenant_company_negeri").val(data['tenant_company_negeri']).change();
                $("#edit_tenant_company_negeri option[value=" + data['tenant_company_negeri'] + "]").attr(
                    'selected', 'selected');
                // $('#edit_tenant_as_in_ic_negeri option[value=data['tenant_as_in_ic_negeri']]").attr('selected','selected');

                // var vehicles = data['vehicles'];
                // vehicles.forEach(function(vehicle) {
                //     content =
                //         $('#newUpload').append(content);
                // });

                var vehicle_htmls = data['vehicle_html'];
                vehicle_htmls.forEach(function(vehicle_html) {
                    $('#edititem').append(vehicle_html);
                });

                console.log(data['vehicle_html']);


            });

            $('#modal_editpenyewa').modal('show');
        }

        function loadDeleteModal(house_id, tenant_id, name, ic) { //not complete yet
            $('#modal_delete_house2 .modal-title').text('Anda pasti untuk hapus penyewa di bawah: ');
            $('#modal_delete_house2 .modal-body #maklumat_owner').html('<p>Nama Penyewa: ' + name +
                '</p>' +
                '<p>IC Penyewa: ' + ic + '</p>');
            $('#modal_delete_house2 #modal-confirm_delete').attr('onclick', 'confirmDelete(' + house_id + ',' +
                tenant_id +
                ')');
            $('#modal_delete_house2').modal('show');
        }

        function confirmDelete(houseid, tenantid) {
            console.log(tenantid);
            $('#modal_delete_house2 .msg').text('');
            $('#modal_delete_house2 .msg').hide();

            // return;
            $.ajax({
                url: '/housetenant/' + tenantid,
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
                    $('#modal_delete_house2 .msg').text(data.success);
                    // $('#modal_delete_house2 .modal-message').append($('<div>', {
                    //     text: data.success
                    // }));
                    // $('#modal_delete_house2').show();
                    // $('#modal_delete_house2 .msg').slideDown("slow");
                    // $('#modal_delete_house2 .msg').fadeOut(1500);

                    $("#modal_delete_house2 .msg").slideDown(700).delay(900).fadeOut(900, 'swing',
                        closeModal);


                },
                error: function(error) {
                    // Error logic goes here..!
                }
            });
        }

        function closeModal() {
            $('#modal_delete_house2').delay(100).modal('hide');
            location.reload();
        }
    </script>
@endsection
