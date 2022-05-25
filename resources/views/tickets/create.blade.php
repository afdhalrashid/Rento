@extends('layouts.app')

@section('title', 'Open Ticket')

@section('css')
    <style>
        .error {
            color: crimson;
            font-size: 0.75rem;

        }

    </style>
@endsection

@section('content')
    <div id="main">
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">

                        <h3><i class="fas fa-comments"></i>
                            <i class="far fa-frown"></i>&nbsp;Aduan
                        </h3>
                        <p class="text-subtitle text-muted">Hantar aduan kepada pemilik rumah</p>
                    </div>
                </div>
            </div>
        </div>
        <form class="form-horizontal" role="form" method="POST" action="{{ route('tickets.store') }}"
            enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="row">
                <div class="col-md-5 col-md-offset-1">
                    <div class="panel panel-default">
                        {{-- <div class="panel-heading">Hantar Aduan</div> --}}

                        <div class="panel-body">
                            @include('includes.flash')



                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title" class="col-md-4 control-label">Tajuk</label>

                                <div class="col-md-12">
                                    <input id="title" type="text" class="form-control" name="title"
                                        value="{{ old('title') }}">

                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                            <strong class="error">{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                                <label for="category" class="col-md-4 control-label">Kategori</label>

                                <div class="col-md-12">
                                    <select id="category" type="category" class="form-control" name="category">
                                        <option value="">Pilih kategori</option>
                                        @foreach ($global_ticketcategory_types as $category)
                                            <option value="{{ $category->type_id }}">{{ $category->type_name }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('category'))
                                        <span class="help-block">
                                            <strong class="error">{{ $errors->first('category') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('priority') ? ' has-error' : '' }}">
                                <label for="priority" class="col-md-4 control-label">Keutamaan</label>

                                <div class="col-md-12">
                                    <select id="priority" type="" class="form-control" name="priority">
                                        <option value="">Pilih keutamaan aduan</option>
                                        <option value="Low">Rendah</option>
                                        <option value="Medium">Sederhana</option>
                                        <option value="High">Tinggi</option>
                                    </select>

                                    @if ($errors->has('priority'))
                                        <span class="help-block">
                                            <strong class="error">{{ $errors->first('priority') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                                <label for="message" class="col-md-12 control-label">Maklumat aduan</label>

                                <div class="col-md-12">
                                    <textarea rows="10" id="message" class="form-control"
                                        name="message">{{ old('message') }}</textarea>

                                    @if ($errors->has('message'))
                                        <span class="help-block">
                                            <strong class="error">{{ $errors->first('message') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <?php
                            /*
                                                                                                                <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                                                                                                                    <div class="row my-2 mx-2">
                                                                                                                        <label for="message" class="col-lg-10 col-md-9 col-sm-10 control-label ">Lampiran
                                                                                                                            (gambar/fail)</label>
                                                                                                                        <button id="add_new_upload_element" class="btn btn-outline-secondary mx-2"
                                                                                                                            type="button"><i class="fas fa-plus"></i></button>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-12">

                                                                                                                        <div class="custom-file">
                                                                                                                            <input id="img1" type="file" name="files[]" class="custom-file-input chooseFile">
                                                                                                                            <label class="custom-file-label" for="chooseFile">Muatnaik</label>
                                                                                                                        </div>
                                                                                                                        {{-- <div class="input-group-append">
                                                                                                                        <button id="add_new_upload_element" class="btn btn-outline-secondary mx-2" type="button"><i class="fas fa-plus"></i></button>
                                                                                                                        </div> --}}

                                                                                                                        <div class="row">
                                                                                                                            <img src="#" width="300px" height="250px" style="display: none;padding:1rem;" />
                                                                                                                            <!--for preview purpose -->
                                                                                                                        </div>
                                                                                                                        @if ($errors->has('message'))
                                                                                                                            <span class="help-block">
                                                                                                                                <strong class="error">{{ $errors->first('message') }}</strong>
                                                                                                                            </span>
                                                                                                                        @endif
                                                                                                                    </div>
                                                                                                                    <div id="newUpload" class="col-md-12">

                                                                                                                    </div>


                                                                                                                </div> */
                            ?>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-info" name="saveasdraft" value="draft">
                                        <i class="fa fa-btn fa-ticket"></i> Simpan Aduan
                                    </button>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">

                                    <button type="submit" class="btn btn-success" name="send" value="submit">
                                        <i class="fa fa-btn fa-ticket"></i> Hantar Aduan
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group{{ $errors->has('files') ? ' has-error' : '' }}">
                        <div class="row my-2 mx-2">
                            <label for="files" class="col-xl-10 col-lg-9 col-md-9 col-sm-9 control-label ">Lampiran
                                (gambar/fail)</label>
                            <button id="add_new_upload_element" class="btn btn-outline-secondary mx-2" type="button"><i
                                    class="fas fa-plus"></i></button>
                        </div>
                        <div class="col-md-12">

                            <div class="custom-file">
                                <input id="img1" type="file" name="files[]" class="custom-file-input chooseFile">
                                <label class="custom-file-label" for="chooseFile">Muatnaik</label>
                            </div>
                            <div class="row">
                                <img src="#" width="300px" height="250px" style="display: none;padding:1rem;" />
                                <!--for preview purpose -->
                            </div>
                            @if ($errors->has('files'))
                                <span class="help-block">
                                    <strong class="error">{{ $errors->first('files') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div id="newUpload" class="col-md-12">

                        </div>


                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script>
        $('#add_new_upload_element').click(function(e) {
            e.preventDefault();

            $('#add_new_upload_element').prop("disabled", true);

            console.log($('#newUpload').children().length);

            var v = $('#newUpload').children().length;

            if (v >= 1) {
                window.alert('Hanya 2 muatnaik sahaja dibenarkan');
                return;
            }
            $.ajax({
                url: 'addUploadHTML?v=' + v,
                type: 'GET',
                success: function(data) {
                    // console.log(data);
                    // var content = $('<div>').append(data).find('#newUpload');
                    // $('#newUpload').html( content );

                    if (data == 'er') {
                        window.alert('Hanya 2 muatnaik sahaja dibenarkan');
                    } else {
                        var content = data;
                        console.log(data);

                        $('#newUpload').append(content);
                        $('#add_new_upload_element').prop("disabled", false);
                    }





                }
            });
        });

        $('.remove_new_upload_element').on('click', function(event) {
            event.stopPropagation();
            event.stopImmediatePropagation();
            console.log("test");
        });

        function readURL2(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                // var image = $(input).parent().parent().find("img");
                var image = $(input).closest('.custom-file').next().find("img");

                reader.onload = function(e) {
                    image.attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
                image.show();
            }
        }

        $(".chooseFile").change(function() {
            console.log(this);

            readURL2(this);

        });
    </script>

@endsection
