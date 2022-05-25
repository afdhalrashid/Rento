@extends('layouts.app')

@section('css')
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet"> --}}
    <link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        .ticket_img {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .ticket_img:hover {
            opacity: 0.7;
        }

        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            padding-top: 100px;
            /* Location of the box */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.9);
            /* Black w/ opacity */
        }

        /* Modal Content (image) */
        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }

        /* Caption of Modal Image */
        #caption {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            height: 150px;
        }

        /* Add Animation */
        .modal-content,
        #caption {
            -webkit-animation-name: zoom;
            -webkit-animation-duration: 0.6s;
            animation-name: zoom;
            animation-duration: 0.6s;
        }

        @-webkit-keyframes zoom {
            from {
                -webkit-transform: scale(0)
            }

            to {
                -webkit-transform: scale(1)
            }
        }

        @keyframes zoom {
            from {
                transform: scale(0)
            }

            to {
                transform: scale(1)
            }
        }

        /* The Close Button */
        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        /* 100% Image Width on Smaller Screens */
        @media only screen and (max-width: 700px) {
            .modal-content {
                width: 100%;
            }
        }

        .cell {
            max-width: 50px;
            white-space: nowrap;
            overflow: hidden;
        }

        .expand:hover {
            max-width: initial;
            white-space: pre-wrap;
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

        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">

                        <h3><i class="fas fa-home"></i>&nbsp;Senarai Aduan</h3>
                        <p class="text-subtitle text-muted">Senarai aduan anda</p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Senarai Aduan</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Senarai Rumah Dipantau</h2>
            </div>
            <div class="pull-right py-1">
                <a class="btn btn-success btn-sm" href="{{ route('house.create') }}"> Create New House</a>
            </div>
        </div>
    </div> --}}

        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <p>{{ $message }}</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <section class="section">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"></h4>
                        </div>
                        <div class="card-body" style="overflow-x: auto; height: 60vh; overflow-y: auto;">
                            <table id="listhouse_table" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="">No</th>
                                    <th class="">No Aduan</th>
                                                                @role("Owner")<th
                                            class="">Nama Penyewa</th>
                                    <th class="" width="
                                            200px">
                                            Alamat Rumah</th>
                                        @endrole
                                        <th class="">Tajuk</th>
                                    <th class="">Kategori</th>
                                                                                                                                                                                <th class="
















                                                              ">
                                            Keutamaan
                                        </th>
                                        <th class="">Aduan</th>
                                        <th class="">Status</th>
                                                                                                                                                                            <th class="















                                                              ">
                                            Gambar
                                        </th>
                                        <th class=" ">Dihantar pada</th>
                                        <th width=" 150px">Tindakan</th>
                                    </tr>
                                </thead>
                                @foreach ($tickets as $ticket)
                                    <tr>
                                        <td class="">{{ ++$i }}</td>
                                    <td class="" width="
                                            10%">
                                            {{ $ticket->ticket_number }}</td>
                                        @role("Owner")
                                        <td class=""><a href=" #"
                                            onclick="load_view_tenant_modal('{{ $ticket->user_id }}')"
                                            class="link-info">{{ $ticket->name }}</a></td>
                                        <td class="" width=" 15%"><a
                                                href="house/{{ $ticket->house_id }}/edit">{{ $ticket->address1 }},
                                                {{ $ticket->address2 }},
                                                {{ $ticket->poskod }},
                                                {{ $ticket->daerah }}, {{ $ticket->negeri }}</a></td>

                                        @endrole
                                        <td class="">{{ $ticket->title }}</td>
                                    <td class="">{{ $ticket->parameterCategory->type_name }}</td>
                                                                                                                                                                                <td class="




















                                            ">
                                            {{ $ticket->priority }}
                                        </td>
                                        <td class="cell expand" width=" 20%">{{ $ticket->message }}
                                        </td>
                                        <td class=" ">
                                            {{-- @role('Tenant')
                                            {{ $ticket->replies->first()->ticket_status }}
                                            @endrole --}}
                                            @hasanyrole('Owner|Tenant')
                                            @if (count($ticket->replies) > 0)
                                                <label
                                                    class="
                                            badge @if ($ticket->replies->first()->ticket_status == 'Dibuka') badge-danger @endif @if ($ticket->replies->first()->ticket_status == 'Sedang diproses')
                                            badge-warning
                                @endif
                                @if ($ticket->replies->first()->ticket_status == 'Selesai')
                                    badge-success
                                @endif
                                ">{{ $ticket->replies->first()->ticket_status }}
                                                </label>
                                            @endif
                                            @endrole
                                        </td>
                                        <td class="" width=" 10%">

                                            @foreach ($ticket->images as $image)
                                                <img class="ticket_img" src="{{ asset($image->image_path) }}"
                                                    width="80px" height="75px" />
                                            @endforeach

                                        </td>
                                        <td class="">{{ $ticket->created_at }}</td>
                                    <td>


                                        {{-- <a class="btn btn-info btn-sm" href="{{ route('house.show',$house->id) }}">Show</a> --}}
                                        @hasanyrole('Tenant')
                                        @if ($ticket->status == 'Deraf')
                                            <a class="btn btn-primary btn-sm" data-toggle="tooltip"
                                            data-placement="top" title="Kemaskini aduan" href="{{ route('tickets.edit', $ticket->id) }}">
                                            <i class="fa fa-pencil-alt"
                                                aria-hidden="true"></i></a>

                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip"
                                            data-placement="top" title="Hapus aduan"
                                                onclick="loadDeleteModal('{{ $ticket->id }}','{{ $ticket->title }}','{{ $ticket->ticket_number }}')"><i class="fas fa-trash-alt"></i>
                                            </button>
                                        @else
                                            <a class="btn btn-primary btn-sm" data-toggle="tooltip"
                                            data-placement="top" title="Lihat aduan"
                                                href="{{ route('tickets.show', $ticket->id) }}"><i
                                                class="fas fa-eye"></i></a>

                                @endif
                                @endhasanyrole

                                @hasanyrole('Owner')
                                <a class="btn btn-primary btn-sm" data-toggle="tooltip"
                                data-placement="top" title="Lihat aduan"
                                    href="{{ route('tickets.show', $ticket->id) }}"><i
                                    class="fas fa-eye"></i></a>

                                @endhasanyrole

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
                </div>
            </div>
        </section>


        <?php /*
                                                                                                                <div class="row" style=" overflow-x: auto;">
                                                                                                                    <table id="listhouse_table" class="table table-striped">
                                                                                                                        <thead>
                                                                                                                            <tr>
                                                                                                                                <th class="">No</th>
                                                                                                                            <th class="">No Aduan</th>
                                                                                                                                                                                                                    @role(" Owner")
                                                                                                                                    <th class="">Nama Penyewa</th>
                                                                                                                            <th class="" width=" 200px">
                                                                                                                                    Alamat Rumah</th>
                                                                                                                                @endrole
                                                                                                                                <th class="">Tajuk</th>
                                                                                                                            <th class="">Kategori</th>
                                                                                                                                                                                                                    <th class="



                                                                                                                                                      ">
                                                                                                                                    Keutamaan
                                                                                                                                </th>
                                                                                                                                <th class="">Aduan</th>
                                                                                                                                <th class="">Status</th>
                                                                                                                                                                                                                <th class="


                                                                                                                                                      ">
                                                                                                                                    Gambar
                                                                                                                                </th>
                                                                                                                                <th class=" ">Dihantar pada</th>
                                                                                                                                <th width=" 150px">Tindakan</th>
                                                                                                                            </tr>
                                                                                                                        </thead>
                                                                                                                        @foreach ($tickets as $ticket)
                                                                                                                            <tr>
                                                                                                                                <td class="">{{ ++$i }}</td>
                                                                                                                            <td class="" width=" 10%">
                                                                                                                                    {{ $ticket->ticket_number }}</td>
                                                                                                                                @role("Owner")
                                                                                                                                <td class=""><a href=" #" onclick="load_view_tenant_modal('{{ $ticket->user_id }}')"
                                                                                                                                    class="link-info">{{ $ticket->name }}</a></td>
                                                                                                                                <td class="" width=" 15%"><a
                                                                                                                                        href="house/{{ $ticket->house_id }}/edit">{{ $ticket->address1 }},
                                                                                                                                        {{ $ticket->address2 }},
                                                                                                                                        {{ $ticket->poskod }},
                                                                                                                                        {{ $ticket->daerah }}, {{ $ticket->negeri }}</a></td>

                                                                                                                                @endrole
                                                                                                                                <td class="">{{ $ticket->title }}</td>
                                                                                                                            <td class="">{{ $ticket->parameterCategory->type_name }}</td>
                                                                                                                                                                                                                    <td class="







                                                                                                                                    ">
                                                                                                                                    {{ $ticket->priority }}
                                                                                                                                </td>
                                                                                                                                <td class="cell expand" width=" 20%">{{ $ticket->message }}
                                                                                                                                </td>
                                                                                                                                <td class=" ">
                                                                                                                                    @role('Tenant')
                                                                                                                                    {{ $ticket->status }}
                                                                                                                                    @endrole
                                                                                                                                    @role('Owner')
                                                                                                                                    @if (count($ticket->replies) > 0)
                                                                                                                                        <label
                                                                                                                                            class="
                                                                                                                                    badge @if ($ticket->replies->first()->ticket_status == 'Telah Buka') badge-danger @endif @if ($ticket->replies->first()->ticket_status == 'Sedang diproses')
                                                                                                                                    badge-warning
                                                                                                                        @endif
                                                                                                                        @if ($ticket->replies->first()->ticket_status == 'Selesai')
                                                                                                                            badge-success
                                                                                                                        @endif
                                                                                                                        ">{{ $ticket->replies->first()->ticket_status }}
                                                                                                                                        </label>
                                                                                                                                    @endif
                                                                                                                                    @endrole
                                                                                                                                </td>
                                                                                                                                <td class="" width=" 10%">

                                                                                                                                    @foreach ($ticket->images as $image)
                                                                                                                                        <img class="ticket_img" src="{{ asset($image->image_path) }}" width="80px"
                                                                                                                                            height="75px" />
                                                                                                                                    @endforeach

                                                                                                                                </td>
                                                                                                                                <td class="">{{ $ticket->created_at }}</td>
                                                                                                                            <td>


                                                                                                                                {{-- <a class="btn btn-info btn-sm" href="{{ route('house.show',$house->id) }}">Show</a> --}}
                                                                                                                                @hasanyrole('Tenant')
                                                                                                                                @if ($ticket->status == 'Deraf')
                                                                                                                                    <a class="
                                                                                                                                    btn btn-primary btn-sm" href="{{ route('tickets.edit', $ticket->id) }}">Kemaskini</a>

                                                                                                                                    <button type="button" class="btn btn-danger btn-sm"
                                                                                                                                        onclick="loadDeleteModal('{{ $ticket->id }}','{{ $ticket->title }}','{{ $ticket->message }}')">Hapus
                                                                                                                                    </button>
                                                                                                                                @else
                                                                                                                                    <a class="btn btn-primary btn-sm" href="{{ route('tickets.show', $ticket->id) }}">Lihat</a>

                                                                                                                        @endif
                                                                                                                        @endhasanyrole

                                                                                                                        @hasanyrole('Owner')
                                                                                                                        <a class="btn btn-primary btn-sm" href="{{ route('tickets.show', $ticket->id) }}">Lihat</a>

                                                                                                                        @endhasanyrole

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
                                                                                                                */
        ?>

        {{-- {!! $houses->links("pagination::bootstrap-4") !!} --}}

        {{-- Modal delete --}}
        <!-- Button trigger modal -->


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


                            <button type="submit" id="modal-confirm_delete" class="btn btn-danger btn-sm">Ya</button>
                        </div>

                    </div>
                    <div class="modal-message" style="display: none;">

                    </div>
                </div>
            </div>
        </div>
        {{-- End --}}

        {{-- Modal image --}}
        <div id="modal_image" class="modal" tabindex="-1" role="dialog">
            <span id="btn_close2" class="close">&times;</span>
            <img class="modal-content" id="img01">
            <div id="caption"></div>
        </div>
        {{-- End --}}

        <!-- Modal view tenant info -->
        <div class="modal fade" id="modal_view_tenant_info" data-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="z-index: 1060">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Info Penyewa</h5>

                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
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


                                <div class="col-sm-4 col-md-4 col-lg-4">
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

                                <div class="col-sm-4 col-md-4 col-lg-4 px-0">
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


    </div>

@endsection

@section('js')

    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#listhouse_table').DataTable({
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


            var modal = document.getElementById("modal_image");
            var modalImg = document.getElementById("img01");
            var captionText = document.getElementById("caption");

            $(".ticket_img").click(function() {
                var img = $(this);
                modal.style.display = "block";
                modalImg.src = this.src;
                captionText.innerHTML = this.alt;
            });

            // Get the image and insert it inside the modal - use its "alt" text as a caption
            // var img = document.getElementById("myImg");
            // img.onclick = function(){
            // modal.style.display = "block";
            // modalImg.src = this.src;
            // captionText.innerHTML = this.alt;
            // }

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modal.style.display = "none";
            }
        });

        function load_view_tenant_modal_old(id) {
            $.ajax({
                type: "get",
                url: "tickets/tenant/" + id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log(response);
                    $('#maklumat_penyewa').append();
                    $('#modal_view_tenant_info').modal('show');
                }
            });
        }

        function load_view_tenant_modal(tenant_id) {
            $('#edititem').empty();
            $.ajax({
                type: "GET",
                url: '/housetenant/tenant/' + tenant_id, // This is what I have updated
                data: {}
            }).done(function(data) {
                console.log(data);

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
                console.log(data['vehicle_html']);
                vehicle_htmls.forEach(function(vehicle_html) {
                    $('#edititem').append(vehicle_html);

                });


                $("#modal_view_tenant_info :input").prop("disabled", true);
                document.querySelector(
                        "#modal_view_tenant_info > div > div > div.modal-footer > div.float-right > button")
                    .disabled = false;

                if (document.querySelector("#edititem > div:nth-child(1) > div.col-sm-2.col-md-2.col-lg-2.px-1") !=
                    null) {
                    document.querySelector("#edititem > div:nth-child(1) > div.col-sm-2.col-md-2.col-lg-2.px-1")
                        .remove();
                }

                // console.log(data['vehicle_html']);
                $('#modal_view_tenant_info').modal('show');

            });

            $('#modal_editpenyewa').modal('show');
        }

        $('#modal_delete_house').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('whatever') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var row = button.closest("tr"); // Finds the closest row <tr>
            var houseid = row.find("td:nth-child(0)");
            var owner = row.find("td:nth-child(3)").text(); //Finds the 2nd <td> element
            var icowner = row.find("td:nth-child(4").text(); // Finds the 3rd <td> element

            console.log(houseid);

            $('#house_id').val(houseid);

            var modal = $(this)
            modal.find('.modal-title').text('Anda pasti untuk hapus aduan di bawah: ')
            modal.find('.modal-body #maklumat_owner').html('<p>Nama Pemilik Rumah: ' + owner + '</p>' +
                '<p>IC Pemilik Rumah: ' + icowner + '</p>')
        });

        $('#modal_delete_house2').on('show.bs.modal', function(event) {
            $('#modal_delete_house2 .msg').text('');
            $('#modal_delete_house2 .msg').hide();
        });

        $(document).on('click', '.deletehouse', function() {
            var houseID = $(this).attr('data-userid');
            $('#house_id').val(houseID);
        });

        function loadDeleteModal(id, title, ticket_number) {
            $('#modal_delete_house2 .modal-title').text('Anda pasti untuk hapus aduan di bawah: ');
            $('#modal_delete_house2 .modal-body #maklumat_owner').html('<p>Tajuk aduan: ' + title + '</p>' + '<p>No Aduan: ' +
                ticket_number + '</p>');
            $('#modal_delete_house2 #modal-confirm_delete').attr('onclick', 'confirmDelete(' + id + ')');
            $('#modal_delete_house2').modal('show');
        }

        function confirmDelete(id) {
            console.log(id);
            $('#modal_delete_house2 .msg').text('');
            $('#modal_delete_house2 .msg').hide();

            // return;
            $.ajax({
                url: '/tickets/' + id,
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    '_method': 'delete',
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

                    $("#modal_delete_house2 .msg").slideDown(700).delay(500).fadeOut(500, 'swing', closeModal);


                },
                error: function(error) {
                    // Error logic goes here..!
                }
            });
        }

        function closeModal() {
            $('#modal_delete_house2').delay(500).modal('hide');
            location.reload();location.reload();
        }
    </script>
@endsection
