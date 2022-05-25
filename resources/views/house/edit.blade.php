@extends('layouts.app')

@section('css')
    <style>
        .img-wraps {
            position: relative;
            display: flex;

            font-size: 0;
        }

        .img-wraps .closes {
            position: absolute;
            top: 5px;
            right: 8px;
            z-index: 100;
            background-color: #FFF;
            padding: 4px 3px;

            color: #000;
            font-weight: bold;
            cursor: pointer;

            text-align: center;
            font-size: 22px;
            line-height: 10px;
            border-radius: 50%;
            border: 1px solid red;
        }

    </style>
@endsection

@section('content')

    @if ($disable == 'false')

        <form action="{{ route('house.update', $house->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
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

        {{-- <div class="row">
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('house.index')}}">Senarai Rumah</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kemaskini Maklumat Rumah</li>
                    </ol>
                </nav>
            </div>
        </div> --}}

        <div class="page-heading my-1">
            @include('layouts.nav_house')
            {{-- <div class="row my-3">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                      <a class="nav-link" href="#">Kemaskini rumah</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('housedoc.index') }}">Dokumen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Perjanjian sewa</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Gambar/Video</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Maklumat penyewa</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Maklumat utiliti</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Maklumat cukai</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Kos</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Invois</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Resit</a>
                      </li>
                  </ul>
            </div> --}}
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        @role('Tenant')
                        <h4>Maklumat Rumah</h4>
                        <p class="text-subtitle text-muted">Maklumat untuk rujukan penyewa</p>
                        @endrole
                        @role('Owner')
                        <h4>Maklumat Rumah</h4>
                        <p class="text-subtitle text-muted">Maklumat Rumah Anda</p>
                        <p>Anda boleh mengemaskini maklumat rumah anda di sini</p>
                        @endrole

                    </div>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Alamat Rumah</h4>
                        </div>

                        <div class="card-body">
                            <div class="row">

                                <div class="form-group">
                                    <label for="helpInputTop">No rumah dan jalan</label>
                                    <small class="text-muted">cth.<i> No. 32, Jln Manggis</i></small>
                                    <input type="text" class="form-control shadow-sm" id="helpInputTop" name="address1"
                                        value="{{ old('address1', $house->address1) }}
                                                                                                                                                                                                                                                                                                                                    "
                                        maxlength="50">
                                </div>

                            </div>
                            <div class="row">

                                <div class="form-group">
                                    <label for="helpInputTop">Taman/Kampung/Desa</label>
                                    <small class="text-muted">cth.<i> Tmn Permai Indah</i></small>
                                    <input type="text" class="form-control shadow-sm" id="helpInputTop" name="address2"
                                        value="{{ old('address2', $house->address2) }}" maxlength="50">
                                </div>

                            </div>
                            <div class="row">

                                <div class="form-group">
                                    <label for="helpInputTop">Poskod</label>
                                    <small class="text-muted">cth.<i> 40200</i></small>
                                    <input type="number" class="form-control shadow-sm" id="helpInputTop" name="poskod"
                                        value="{{ old('poskod', $house->poskod) }}" maxlength="5"
                                        oninput="this.value=this.value.slice(0,this.maxLength)">
                                </div>

                            </div>
                            <div class="row">
                                <div class="">
                                    <div class=" form-group">
                                    <label for="helpInputTop">Daerah</label>
                                    <small class="text-muted">cth.<i> Gombak</i></small>
                                    <input type="text" class="form-control shadow-sm" id="helpInputTop" name="daerah"
                                        value="{{ old('daerah', $house->daerah) }}" maxlength="50">
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="form-group">
                                <label for="helpInputTop">Negeri</label>
                                <small class="text-muted">cth.<i> Selangor</i></small>
                                {{ old('negeri') }}
                                <select class="form-control form-select-sm shadow-sm" aria-label="Default select example"
                                    name="negeri">
                                    <option value="" selected>- Sila Pilih -</option>
                                    @foreach ($global_states as $state)
                                        {{-- <option value="{{ $region->type_id }}">{{ $region->type_name }}</option> --}}

                                        @if (Request::old('negeri') == $state->type_id)
                                            <option value="{{ $state->type_id }}" selected>{{ $state->type_name }}
                                            </option>
                                        @elseif ($house->negeri == $state->type_id)
                                            <option value="{{ $state->type_id }}" selected>{{ $state->type_name }}
                                            </option>
                                        @else
                                            <option value="{{ $state->type_id }}">{{ $state->type_name }}</option>
                                        @endif
                                    @endforeach
                                </select>

                                {{-- <input type="text" class="form-control" id="helpInputTop" name="negeri" value="{{ old('negeri') }}"> --}}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title float-left">
                            Maklumat Pemilik Rumah
                        </h4>
                        @role('Owner')
                        <div class="float-right"><a class="btn btn-sm btn-danger"
                                href="{{ route('houseowner_bankaccount.show', $house->id) }}">Senarai akaun bank (*)</a>
                        </div>
                        @endrole
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="form-group">
                                <label for="helpInputTop">Nama penuh</label>
                                <small class="text-muted">cth.<i> Zakaria bin Idris</i></small>
                                <input type="text" class="form-control shadow-sm" id="helpInputTop" name="namaowner"
                                    value="{{ old('namaowner', $house->namaowner) }}">
                            </div>

                        </div>
                        @role('Owner')
                        <div class="row">

                            <div class="form-group">
                                <label for="helpInputTop">No kad pengenalan</label>
                                <small class="text-muted">cth.<i> 8xxxx-1x-xxxx</i></small>
                                <input type="text" class="form-control shadow-sm" id="helpInputTop" name="icowner"
                                    value="{{ old('icowner', $house->icowner) }}">
                            </div>

                        </div>
                        @endrole

                        <div class="row">

                            <div class="form-group">
                                <label for="helpInputTop">No telefon</label>
                                <small class="text-muted">cth.<i> 0128922321</i></small>
                                <input type="text" class="form-control shadow-sm" id="helpInputTop" name="phoneno_owner"
                                    value="{{ old('phoneno_owner', $house->phoneno_owner) }}">
                            </div>

                        </div>

                        <div class="row">

                            <div class="form-group">
                                <label for="helpInputTop">Email</label>
                                <small class="text-muted">cth.<i> hadif@gmail.com</i></small>
                                <input type="email" class="form-control shadow-sm" id="helpInputTop" name="email_owner"
                                    value="{{ old('email_owner', $house->email_owner) }}">
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Gambar Rumah</h4>
                    </div>
                    <div class="card-body">
                        <div class="row py-3" style="display: inline-block;">
                            <div class="my-1 custom-file col-lg-6 col-md-6 col-sm-6">
                                <div class="row">
                                    <input id="img1" type="file" name="files[]" class="custom-file-input chooseFile"
                                        value="@if (count($house->images) > 0) {{ asset($house->images[0]['image_path']) }} @endif">
                                </div>
                                <label class="custom-file-label" for="chooseFile">Pilih gambar 1</label>
                                <div class="row">
                                    <div class="img-wraps">
                                        @if (count($house->images) > 0)
                                            <span class="closes" title="Hapus"
                                                onclick="loadDeleteModal('{{ $house->images[0]['id'] }}')">×</span>

                                            <img src="{{ asset($house->images[0]['image_path']) }}" width="300px"
                                                height="250px" style="padding:1rem;" />
                                        @else


                                            <img src="" width="300px" height="250px" style="padding:1rem;" />
                                        @endif



                                    </div>
                                </div>

                            </div>
                            <div class="my-1 custom-file col-lg-6 col-md-6 col-sm-6">
                                <div class="row">
                                    <input id="img2" type="file" name="files[]" class="custom-file-input chooseFile"
                                        value="@if (count($house->images) > 1) {{ asset($house->images[1]['image_path']) }} @endif">
                                </div>
                                <label class="custom-file-label" for="chooseFile">Pilih gambar 2</label>
                                <div class="row">
                                    <div class="img-wraps">
                                        @if (count($house->images) > 1)
                                            <span class="closes" title="Hapus"
                                                onclick="loadDeleteModal('{{ $house->images[1]['id'] }}')">×</span>

                                            <img src="{{ asset($house->images[1]['image_path']) }}" width="300px"
                                                height="250px" style="padding:1rem;" />
                                        @else


                                            <img src="" width="300px" height="250px" style="padding:1rem;" />
                                        @endif



                                    </div>
                                    {{-- <img src="@if (count($house->images) > 1) {{ asset($house->images[1]['image_path']) }} @endif" width="300px" height="250px"
                                        style="padding:1rem;" /> --}}
                                    <!--for preview purpose -->
                                </div>
                            </div>
                            <div class="my-1 custom-file col-lg-6 col-md-6 col-sm-6">
                                <div class="row">
                                    <input type="file" name="files[]" class="custom-file-input chooseFile"
                                        value="@if (count($house->images) > 2) {{ asset($house->images[2]['image_path']) }} @endif">
                                </div>
                                <label class="custom-file-label" for="chooseFile">Pilih gambar 3</label>
                                <div class="row">
                                    <div class="img-wraps">
                                        @if (count($house->images) > 2)
                                            <span class="closes" title="Hapus"
                                                onclick="loadDeleteModal('{{ $house->images[2]['id'] }}')">×</span>

                                            <img src="{{ asset($house->images[2]['image_path']) }}" width="300px"
                                                height="250px" style="padding:1rem;" />
                                        @else


                                            <img src="" width="300px" height="250px" style="padding:1rem;" />
                                        @endif



                                    </div>
                                    {{-- <img src="@if (count($house->images) > 2) {{ asset($house->images[2]['image_path']) }} @endif" width="300px" height="250px"
                                        style="padding:1rem;" /> --}}
                                    <!--for preview purpose -->
                                </div>
                            </div>
                            <div class="my-1 custom-file col-lg-6 col-md-6 col-sm-6">
                                <div class="row">
                                    <input id="img2" type="file" name="files[]" class="custom-file-input chooseFile"
                                        value="@if (count($house->images) > 3) {{ asset($house->images[3]['image_path']) }} @endif">
                                </div>
                                <label class="custom-file-label" for="chooseFile">Pilih gambar 4</label>
                                <div class="row">
                                    <div class="img-wraps">
                                        @if (count($house->images) > 3)
                                            <span class="closes" title="Hapus"
                                                onclick="loadDeleteModal('{{ $house->images[3]['id'] }}')">×</span>

                                            <img src="{{ asset($house->images[3]['image_path']) }}" width="300px"
                                                height="250px" style="padding:1rem;" />
                                        @else


                                            <img src="" width="300px" height="250px" style="padding:1rem;" />
                                        @endif



                                    </div>
                                    {{-- <img src="@if (count($house->images) > 3) {{ asset($house->images[3]['image_path']) }} @endif" width="300px" height="250px"
                                        style="padding:1rem;" /> --}}
                                    <!--for preview purpose -->
                                </div>
                            </div>
                            <div class="my-1 custom-file col-lg-6 col-md-6 col-sm-6">
                                <div class="row">
                                    <input id="img2" type="file" name="files[]" class="custom-file-input chooseFile"
                                        value="@if (count($house->images) > 4) {{ asset($house->images[4]['image_path']) }} @endif">
                                </div>
                                <label class="custom-file-label" for="chooseFile">Pilih gambar 5</label>
                                <div class="row">
                                    <img src="@if (count($house->images) > 4) {{ asset($house->images[4]['image_path']) }} @endif" width="300px" height="250px"
                                        style="padding:1rem;" />
                                    <!--for preview purpose -->
                                </div>
                            </div>
                        </div>
                        {{-- <div>Test</div> --}}
                    </div>

                </div>
                {{-- <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Gambar rumah</h4>
                        </div>
                        <div class="card-body">
                            <div class="custom-file">
                                <div class="row">
                                    <input type="file" name="file" class="custom-file-input" id="chooseFile">
                                </div>
                                <label class="custom-file-label" for="chooseFile">Select file</label>
                                <div class="row">
                                <img src="{{asset($house->file[0]['file_path'])}}" id="category-img-tag" width="300px" height="250px" style="padding:1rem;"  />   <!--for preview purpose -->
                                </div>
                            </div>
                        </div>
                    </div> --}}
            </div>
    </div>
    </section>

    {{-- <section class="section">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">xx</h4>
                </div>

            </div>
        </section> --}}
    @if ($disable == 'false')
        <div class="row offset-md-5 offset-lg-5">
            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
        </div>
    @endif
    </div>
    @if ($disable == 'false')
        </form>
    @endif

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
@endsection

@section('js')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#category-img-tag').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
                $('#category-img-tag').show();
            }
        }

        $("#chooseFile").change(function() {
            readURL(this);
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

        function loadDeleteModal(id) {
            $('#modal_delete_house2 .modal-title').text('Anda pasti untuk hapus gambar? ');
            // $('#modal_delete_house2 .modal-body #maklumat_owner').html('<p>Nama Pengguna: ' + name + '</p>' +
            //     '<p>Emel Pengguna: ' + email + '</p>');
            $('#modal_delete_house2 #modal-confirm_delete').attr('onclick', 'confirmDelete(' + id + ')');
            $('#modal_delete_house2').modal('show');
        }

        function confirmDelete(id) {
            console.log(id);
            $('#modal_delete_house2 .msg').text('');
            $('#modal_delete_house2 .msg').hide();

            // return;
            $.ajax({
                url: '{{ url('houseimage') }}/' + id,
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    '_method': 'delete',
                },
                success: function(data) {
                    console.log(data);
                    $('#modal_delete_house2 .msg').text("Wow");
                    // $('#modal_delete_house2 .modal-message').append($('<div>', {
                    //     text: data.success
                    // }));
                    // $('#modal_delete_house2').show();
                    // $('#modal_delete_house2 .msg').slideDown("slow");
                    // $('#modal_delete_house2 .msg').fadeOut(1500);

                    $("#modal_delete_house2 .msg").slideDown(300).delay(300).fadeOut(200, 'swing', closeModal);


                },
                error: function(error) {
                    // Error logic goes here..!
                }
            });
        }

        function closeModal() {
            $('#modal_delete_house2').delay(200).modal('hide');
            location.reload();
        }
    </script>
@endsection
