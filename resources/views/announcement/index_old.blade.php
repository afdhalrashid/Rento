@extends('layouts.app')

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
                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahhebahan">
                    Tambah Hebahan</button>
            </div>
            @endrole
        </div>

        <div class="row">
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


        </div>

        @role ('Owner')
        <form action="{{ route('announcement.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="modal" tabindex="-1" role="dialog" id="tambahhebahan">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">

                            <h5 class="modal-title">
                                <p class="">Tambah hebahan</p>
                            </h5>
                            <div class="row mt-4 ml-2" style="position: fixed;">
                                <small>(* Maklumat wajib diisi)</small>

                            </div>


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

                                <div class="row custom-file">
                                    <textarea rows="10" id="message" class="form-control"
                                        name="message">{{ old('message') }}</textarea>
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
        <div class="modal fade" id="modal_delete_announcement" data-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true" style="z-index: 1060">
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
                        <div class="msg" style="position:absolute;float: left;left:0.6rem;color:rgba(4, 124, 40, 0.9)">
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
    <script>
        $('.datepicker').datepicker({
            clearBtn: true,
            format: "dd/mm/yyyy"
        });

        function loadDeleteModal(announcement_id, announcement_title) { //not complete yet
            $('#modal_delete_announcement .modal-title').text('Anda pasti untuk hapus kos berikut: ');
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

    </script>
@endsection
