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
                            <i class="far fa-frown"></i>&nbsp;Maklum Balas Aduan
                        </h3>
                        <p class="text-subtitle text-muted">@role('Owner')Hantar maklumbalas kepada penyewa berkenaan aduan
                            yang dihantar
                            @endrole
                            @role('Tenant') Sejarah maklum balas dari pengurus/pemilik rumah terhadap aduan anda @endrole
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <form class="form-horizontal" role="form" method="POST" action="{{ route('ticketreplies.store') }}"
            enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="row">
                <div class="col-md-5 col-md-offset-1">
                    <div class="panel panel-default">
                        {{-- <div class="panel-heading">Hantar Aduan</div> --}}

                        <div class="panel-body py-3"
                            style="background-color: rgba(250, 235, 218, 0.822);border: 2px solid rgba(155, 126, 46, 0.555); border-radius: 25px;">
                            @include('includes.flash')

                            <input type="hidden" name="ticket_id" value="{{ $ticket->ticket_id }}">

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title" class="col-md-4 control-label">Tajuk</label>

                                <div class="col-md-12">
                                    <input id="title" type="text" class="form-control" name="title"
                                        value="{{ $ticket->title }}" disabled>

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
                                    <select id="category" type="category" class="form-control" name="category" disabled>
                                        <option value="">Pilih kategori</option>
                                        @foreach ($global_ticketcategory_types as $category)
                                            <option value="{{ $category->type_id }}" @if ($category->type_id == $ticket->category_id) selected @endif>
                                                {{ $category->type_name }}</option>
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
                                    <select id="priority" type="" class="form-control" name="priority" disabled>
                                        <option value="">Pilih keutamaan aduan</option>
                                        <option value="low" @if ($ticket->priority == 'low') selected @endif>Rendah</option>
                                        <option value="medium" @if ($ticket->priority == 'medium') selected @endif>Sederhana</option>
                                        <option value="high" @if ($ticket->priority == 'high') selected @endif>Tinggi</option>
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
                                    <textarea rows="10" id="message" class="form-control" name="message"
                                        disabled>{{ $ticket->message }}</textarea>

                                    @if ($errors->has('message'))
                                        <span class="help-block">
                                            <strong class="error">{{ $errors->first('message') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="message" class="col-md-4 control-label">Tarikh aduan</label>

                                <div class="col-md-12">
                                    <input rows="10" id="message" value="{{ $ticket->created_at }}"
                                        class="form-control" name="message" disabled />


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




                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="panel panel-default">
                        <div class="panel-body py-3"
                            style="background-color: rgba(250, 235, 218, 0.822);border: 2px solid rgba(155, 126, 46, 0.555); border-radius: 25px;">
                            <div class="form-group{{ $errors->has('files') ? ' has-error' : '' }}">
                                <div class="row mx-2">
                                    <label for="files" class="col-xl-10 col-lg-9 col-md-9 col-sm-9 control-label ">Lampiran
                                        (gambar/fail)</label>
                                    {{-- <button id="add_new_upload_element" class="btn btn-outline-secondary mx-2" type="button"><i class="fas fa-plus"></i></button> --}}
                                </div>
                                <div id="current_image" class="col-md-12">
                                    @foreach ($ticket->images as $image)


                                        <div class="custom-file">
                                            <input type="file" name="files[]" class="custom-file-input chooseFile" disabled>
                                            <label class="custom-file-label"
                                                for="chooseFile">{{ $image->image_name }}</label>
                                        </div>
                                        <div class="row">
                                            <img src="{{ asset($image->image_path) }}" width="300px" height="250px"
                                                style="padding:1rem;" />
                                            <!--for preview purpose -->
                                        </div>
                                        @if ($errors->has('files'))
                                            <span class="help-block">
                                                <strong class="error">{{ $errors->first('files') }}</strong>
                                            </span>
                                        @endif
                                    @endforeach
                                </div>
                                <div id="newUpload" class="col-md-12">

                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row my-5">
                <div class="form-group{{ $errors->has('reply') ? ' has-error' : '' }}">
                    <strong class="col-md-4 control-label" style="font-size: 1.2rem">Sejarah Maklumbalas Aduan</strong>

                    {{-- <p><label for="reply" class="col-md-8 control-label">Sejarah Maklumbalas</label></p> --}}
                    <div class="col-md-8 mt-4">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Maklumbalas</th>
                                    <th>Status aduan</th>
                                    <th>Tarikh dan masa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ticket->replies as $reply)
                                    <tr>
                                        <td>{{ $reply->reply }}</td>
                                        <td>{{ $reply->ticket_status }}</td>
                                        <td>{{ $reply->updated_at }}</td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>

                    @role('Owner')
                    <hr><br />

                    <p><label for="reply" class="col-md-8 control-label">Sila masukkan maklum balas baru di bawah</label>
                    </p>

                    <div class="col-md-12">
                        <textarea rows="10" id="reply" class="form-control" name="reply"></textarea>

                        @if ($errors->has('reply'))
                            <span class="help-block">
                                <strong class="error">{{ $errors->first('reply') }}</strong>
                            </span>
                        @endif
                    </div>
                    @endrole
                </div>
                @role('Owner')
                <div class="form-group{{ $errors->has('ticket_status') ? ' has-error' : '' }}">
                    <label for="ticket_status" class="col-md-4 control-label">Status Aduan</label>

                    <div class="col-md-12">
                        <select id="ticket_status" type="ticket_status" class="form-control" name="ticket_status">
                            <option value="">Pilih status</option>
                            @foreach ($global_ticket_status as $status)
                                <option value="{{ $status->type_id }}">{{ $status->type_name }}</option>
                            @endforeach
                        </select>

                        @if ($errors->has('ticket_status'))
                            <span class="help-block">
                                <strong class="error">{{ $errors->first('ticket_status') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="row col-md-12">
                    {{-- <div class="col-md-2">
                <button type="submit" class="btn btn-info" name="saveasdraft" value="draft">
                    <i class="fa fa-btn fa-ticket"></i> Simpan Maklumbalas
                </button>
            </div> --}}
                    <div class="col-md-4">

                        <button type="submit" class="btn btn-success" name="send" value="submit">
                            <i class="fa fa-btn fa-ticket"></i> Hantar Maklumbalas
                        </button>
                    </div>
                </div>
                @endrole
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script>
        $('#add_new_upload_element').click(function(e) {
            e.preventDefault();

            $('#add_new_upload_element').prop("disabled", true);

            var c_image = $('#current_image').children().length;

            var matches = 0;
            $(":input.custom-file-input").each(function(i, val) {
                matches++;
            });
            // var n_image = $('#newUpload').children().length;

            // all = c_image + n_image;

            console.log(matches);

            if (matches >= 5) {
                window.alert('Hanya 5 muatnaik sahaja dibenarkan');
                return;
            }
            $.ajax({
                url: '/tickets/addUploadHTML?v=' + matches,
                type: 'GET',
                success: function(data) {
                    console.log(data);
                    // var content = $('<div>').append(data).find('#newUpload');
                    // $('#newUpload').html( content );

                    if (data == 'er') {
                        window.alert('Hanya 5 muatnaik sahaja dibenarkan');
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
                var label = $(input).next("label");
                label.css("color", "#d44234");
                label.text(input.files[0].name);

                console.log(label);

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
