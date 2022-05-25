@extends('layouts.app')

@section('content')
    <form action="{{ route('house.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
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

            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">

                            <h3><i class="fas fa-home"></i>&nbsp;Rumah</h3>
                            <p class="text-subtitle text-muted">Rumah yang dimiliki</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Maklumat Rumah Baru</li>
                                </ol>
                            </nav>
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
                                            value="{{ old('address1') }}">
                                    </div>

                                </div>
                                <div class="row">

                                    <div class="form-group">
                                        <label for="helpInputTop">Taman/Kampung/Desa</label>
                                        <small class="text-muted">cth.<i> Tmn Permai Indah</i></small>
                                        <input type="text" class="form-control shadow-sm" id="helpInputTop" name="address2"
                                            value="{{ old('address2') }}">
                                    </div>

                                </div>
                                <div class="row">

                                    <div class="form-group">
                                        <label for="helpInputTop">Poskod</label>
                                        <small class="text-muted">cth.<i> 40200</i></small>
                                        <input type="text" class="form-control shadow-sm" id="helpInputTop" name="poskod"
                                            value="{{ old('poskod') }}">
                                    </div>

                                </div>
                                <div class="row">

                                    <div class="form-group">
                                        <label for="helpInputTop">Daerah</label>
                                        <small class="text-muted">cth.<i> Gombak</i></small>
                                        <input type="text" class="form-control shadow-sm" id="helpInputTop" name="daerah"
                                            value="{{ old('daerah') }}">
                                    </div>

                                </div>
                                <div class="row">

                                    <div class="form-group">
                                        <label for="helpInputTop">Negeri</label>
                                        <small class="text-muted">cth.<i> Selangor</i></small>
                                        {{ old('negeri') }}
                                        <select class="form-control form-select-sm shadow-sm"
                                            aria-label="Default select example" name="negeri">
                                            <option value="" selected>- Sila Pilih -</option>
                                            @foreach ($global_states as $state)
                                                {{-- <option value="{{ $region->type_id }}">{{ $region->type_name }}</option> --}}

                                                @if (Request::old('negeri') == $state->type_id)
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
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Maklumat Pemilik Rumah</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <div class="form-group">
                                        <label for="helpInputTop">Nama penuh</label>
                                        <small class="text-muted">cth.<i> Zakaria bin Idris</i></small>
                                        <input type="text" class="form-control shadow-sm" id="helpInputTop" name="namaowner"
                                            value="{{ old('namaowner') }}">
                                    </div>

                                </div>
                                <div class="row">

                                    <div class="form-group">
                                        <label for="helpInputTop">No kad pengenalan</label>
                                        <small class="text-muted">cth.<i> 8xxxx-1x-xxxx</i></small>
                                        <input type="text" class="form-control shadow-sm" id="helpInputTop" name="icowner"
                                            value="{{ old('icowner') }}">
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="form-group">
                                        <label for="helpInputTop">No telefon</label>
                                        <small class="text-muted">cth.<i> 0128922321</i></small>
                                        <input type="text" class="form-control shadow-sm" id="helpInputTop"
                                            name="phoneno_owner" value="{{ old('phoneno_owner') }}">
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="form-group">
                                        <label for="helpInputTop">Email</label>
                                        <small class="text-muted">cth.<i> hadif@gmail.com</i></small>
                                        <input type="email" class="form-control shadow-sm" id="helpInputTop"
                                            name="email_owner" value="{{ old('email_owner') }}">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Gambar rumah</h4>
                            </div>
                            <div class="card-body">
                                <div class="row py-3" style="display: inline-block;">
                                    <div class="my-1 custom-file col-lg-6 col-md-6 col-sm-6">
                                        <div class="row">
                                            <input id="img1" type="file" name="files[]" value="{{ old('files.0') }}"
                                                class="custom-file-input chooseFile">
                                        </div>
                                        <label class="custom-file-label" for="chooseFile">Pilih gambar 1</label>
                                        <div class="row">
                                            <img src="#" width="300px" height="250px" style="display: none;padding:1rem;" />
                                            <!--for preview purpose -->
                                        </div>

                                    </div>
                                    <div class="my-1 custom-file col-lg-6 col-md-6 col-sm-6">
                                        <div class="row">
                                            <input id="img2" type="file" name="files[]" value="{{ old('files.1') }}"
                                                class="custom-file-input chooseFile">
                                        </div>
                                        <label class="custom-file-label" for="chooseFile">Pilih gambar 2</label>
                                        <div class="row">
                                            <img src="#" width="300px" height="250px" style="display: none;padding:1rem;" />
                                            <!--for preview purpose -->
                                        </div>
                                    </div>
                                    <div class="my-1 custom-file col-lg-6 col-md-6 col-sm-6">
                                        <div class="row">
                                            <input type="file" name="files[]" class="custom-file-input chooseFile">
                                        </div>
                                        <label class="custom-file-label" for="chooseFile">Pilih gambar 3</label>
                                        <div class="row">
                                            <img src="#" width="300px" height="250px" style="display: none;padding:1rem;" />
                                            <!--for preview purpose -->
                                        </div>
                                    </div>
                                    <div class="my-1 custom-file col-lg-6 col-md-6 col-sm-6">
                                        <div class="row">
                                            <input type="file" name="files[]" class="custom-file-input chooseFile">
                                        </div>
                                        <label class="custom-file-label" for="chooseFile">Pilih gambar 4</label>
                                        <div class="row">
                                            <img src="#" width="300px" height="250px" style="display: none;padding:1rem;" />
                                            <!--for preview purpose -->
                                        </div>
                                    </div>
                                    <div class="my-1 custom-file col-lg-6 col-md-6 col-sm-6">
                                        <div class="row">
                                            <input type="file" name="files[]" class="custom-file-input chooseFile">
                                        </div>
                                        <label class="custom-file-label" for="chooseFile">Pilih gambar 5</label>
                                        <div class="row">
                                            <img src="#" width="300px" height="250px" style="display: none;padding:1rem;" />
                                            <!--for preview purpose -->
                                        </div>
                                    </div>
                                </div>
                                {{-- <div>Test</div> --}}
                            </div>

                        </div>
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

            <div class="row offset-md-5 offset-lg-5">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>

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

        // $("#chooseFile").change(function(){

        //     readURL(this);

        // });

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
    </script>
@endsection
