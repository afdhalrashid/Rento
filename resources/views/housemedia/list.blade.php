@extends('layouts.app')

@section('css')

    <style>
        .hs_img {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .hs_img:hover {
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

        .img-wraps .closes {
            position: absolute;
            top: 5px;
            right: -7px;
            z-index: 1;
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
    <form action="{{ route('housemedia.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
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
                        $imgbefore[] = $media;
                    @endphp
                @endif
                @if ($media->file_for == 'gambar selepas')
                    @php
                        $imgafter[] = $media;
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

                @if ($media->file_for == 'URL Youtube')
                    @php
                        $url_youtube = $media;
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
                            <h4>Dokumen</h4>
                            <p class="text-subtitle text-muted">Senarai Dokumen Penting Rumah </p>
                        </div>

                        {{-- <div class="col-lg-4 order-md-2 order-first">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahmedia">
                            Tambah video/gambar</button>
                    </div> --}}
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
                        <div class="col-sm-8 col-md-8 col-lg-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Gambar Rumah</h4>
                                </div>
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Jenis Gambar</th>
                                                <th scope="col">Muatnaik</th>
                                                <th scope="col" style="width: 55%">Fail</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Gambar sebelum</td>
                                                <td>

                                                    @for ($i = 1; $i < 6; $i++)
                                                        <div class="row">
                                                            <div class="custom-file my-1">
                                                                <input type="file" class="custom-file-input"
                                                                    id="house_image_before" name="house_image_before[]"
                                                                    multiple="">
                                                                <label class="custom-file-label" for="customFile">Pilih
                                                                    gambar sebelum {{ $i }}</label>
                                                            </div>
                                                        </div>
                                                    @endfor

                                                </td>
                                                <td>
                                                    @isset($imgbefore)
                                                        <div class="row mx-2">
                                                            @foreach ($imgbefore as $imgbf)

                                                                <div class="my-0 mx-1 img-wraps"
                                                                    style="position:relative;padding-top:20px;
                                                                                                                                                                                                                                                                                                                                                                                                                            display:inline-block;">
                                                                    <span class="badge badge-light"
                                                                        style="position: absolute;
                                                                                                                                                                                                                                                                                                                                                                                                                               left:0px;top:10px;background:rgb(255, 176, 58);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            text-align: center;color:white;padding:3px 5px;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            font-size:12px;">{{ $imgbf->image_index + 1 }}</span><span class="closes" title="Hapus"
                                                onclick="loadDeleteModal('{{ $imgbf->id }}')">×</span>
                                                                    <img src="{{ asset($imgbf->file_path) }}"
                                                                        id="category-img-tag1" width="80px" height="75px"
                                                                        style="" data-toggle="tooltip" data-html="true"
                                                                        title="<em>Fail: </em> <u>{{ $imgbf->name }}</u>" />
                                                                </div>

                                                            @endforeach
                                                        </div>
                                                    @else
                                                        <div class="my-0">
                                                            <span class="mx-1"></span>
                                                            <img src="#" id="category-img-tag1" width="80px" height="75px"
                                                                style="display: none;" />
                                                        </div>
                                                    @endisset
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">2</th>
                                                <td>Gambar selepas</td>
                                                <td>
                                                    @for ($i = 1; $i < 6; $i++)
                                                        <div class="row">
                                                            {{-- <label class="strong">{{$i}}</label> --}}
                                                            <div class="custom-file my-1">

                                                                <input type="file" class="custom-file-input"
                                                                    id="house_image_after" name="house_image_after[]"
                                                                    multiple="">
                                                                <label class="custom-file-label" for="customFile">Pilih
                                                                    gambar selepas {{ $i }}</label>
                                                            </div>
                                                        </div>
                                                    @endfor

                                                </td>
                                                <td>
                                                    @isset($imgafter)
                                                        <div class="row mx-2">
                                                            @foreach ($imgafter as $imgaf)
                                                                <div class="my-0 mx-1 img-wraps"
                                                                    style="position:relative;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        padding-top:20px;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        display:inline-block;">
                                                                    <span class="badge badge-light"
                                                                        style="position: absolute;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            left:0px;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            top:10px;background:rgb(255, 111, 111);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            text-align: center;color:white;padding:3px 5px;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            font-size:12px;">{{ $imgaf->image_index + 1 }}</span><span class="closes" title="Hapus"
                                                onclick="loadDeleteModal('{{ $imgaf->id }}')">×</span>

                                                                    <img src="{{ asset($imgaf->file_path) }}"
                                                                        id="category-img-tag1" width="80px" height="75px"
                                                                        style="" data-toggle="tooltip" data-html="true"
                                                                        title="<em>Fail: </em> <u>{{ $imgaf->name }}</u>" />
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        <div class="my-0">
                                                            <span class="mx-1"></span>
                                                            <img src="#" id="category-img-tag1" width="80px" height="75px"
                                                                style="display: none;;" />
                                                        </div>
                                                    @endisset
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">3</th>
                                                <td>Video sebelum</td>
                                                <td>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="house_video_before"
                                                            name="house_video_before"
                                                            value="{{ old('house_video_before') }}" multiple=""
                                                            accept="video/*">
                                                        <label class="custom-file-label" for="customFile">Pilih video
                                                            sebelum</label>
                                                    </div>
                                                    @isset($videobefore)
                                                        <div class="my-2 img-wraps">
                                                            <span class="row mx-1 ">Nama fail:
                                                                {{ $videobefore->name }}</span><a class="" title="Hapus"
                                                                onclick="loadDeleteModal('{{ $videobefore->id }}')"><i
                                                                class="fas fa-trash-alt"></i></a>
                                                            <video id="video_before" width="300" height="300" controls>
                                                                <source src="{{ asset($videobefore->file_path) }}">
                                                            </video>
                                                        </div>
                                                    @else
                                                        <div class="my-2">
                                                            <span class="mx-1"></span>
                                                            <video id="video_before" width="300" height="300" controls></video>
                                                        </div>
                                                    @endisset

                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">4</th>
                                                <td>Video selepas</td>
                                                <td>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="house_video_after"
                                                            name="house_video_after"
                                                            value="{{ old('house_video_after') }}" multiple="">
                                                        <label class="custom-file-label" for="customFile">Pilih video
                                                            selepas</label>
                                                    </div>
                                                    @isset($videoafter)
                                                        <div class="my-2">
                                                            <span class="row mx-1">Nama fail:
                                                                {{ $videoafter->name }}</span><a class="" title="Hapus"
                                                                onclick="loadDeleteModal('{{ $videoafter->id }}')"><i
                                                                class="fas fa-trash-alt"></i></a>
                                                            <video id="video_after" width="300" height="300" controls>
                                                                <source src="{{ asset($videoafter->file_path) }}">
                                                            </video>
                                                        </div>
                                                    @else
                                                        <div class="my-2">
                                                            <span class="mx-1"></span>
                                                            <video id="video_after" width="300" height="300" controls></video>
                                                        </div>
                                                    @endisset

                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">5</th>
                                                <td>Pautan Youtube</td>
                                                <td>
                                                    <div class="row mx-2">
                                                        <input type="text" class="form-control shadow-sm"
                                                            id="house_url_youtube" name="house_url_youtube"
                                                            value="@isset($url_youtube){{ $url_youtube->file_path }}@else{{ old('house_url_youtube') }}@endisset">@isset($url_youtube)<a
                                                            class="btn-sm btn-info mx-2 my-2"
                                                            href="{{ $url_youtube->file_path }}" target="_blank"><i
                                                            class="fas fa-external-link-alt"></i></a>@endisset

                                                </div>

                                            </td>
                                        </tr>

                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <div class="row offset-md-5 offset-lg-5">
                            <button id="submit_form" type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        </div>
                    </div>
                </div>
            </section>



        </div>
    </div>

</form>
{{-- Modal image --}}
<div id="modal_image" class="modal" tabindex="-1" role="dialog">
    <span id="btn_close" class="close">&times;</span>
    <img class="modal-content" id="img01">
    <div id="caption"></div>
</div>
{{-- End --}}

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
    $("#house_video_before").on("change", function() {
        if (this.files[0].size > 5000000) {
            alert("Maaf, video anda telah melebihi had 5MB.");
            $(this).val(null);
            $(this).val('Pilih video sebelum');
        }
    });

    $("#house_video_after").on("change", function() {
        if (this.files[0].size > 5000000) {
            alert("Maaf, video anda telah melebihi had 5MB.");
            $(this).val(null);
            $(this).val('Pilih video selepas');
        }
    });

    // $("#submit_form").click(function(e) {
    //     var video_before = document.getElementById("house_video_before");
    //     var video_after = document.getElementById('house_video_after');

    //     console.log(video_before.value);
    //     console.log(video_after.value);

    //     // return false;

    //     if (video_before.value == true) {
    //         let video_before_size = video_before.files[0].size;
    //         if (video_before_size > 5000000) {
    //             alert("Hanya video bersaiz maksimum 5 Mb");
    //             e.preventDefault();
    //         }
    //     }

    //     if (video_after.value == true) {
    //         let video_after_size = video_after.files[0].size;
    //         if (video_after_size > 5000000) {
    //             alert("Hanya video bersaiz maksimum 5 Mb");
    //             e.preventDefault();
    //         }
    //     }


    // });

    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    function readURL1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#category-img-tag1').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
            $('#category-img-tag1').show();
        }
    }

    function readURL2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#category-img-tag2').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
            $('#category-img-tag2').show();
        }
    }

    $("#house_image_before").change(function() {
        readURL1(this);
    });

    $("#house_image_after").change(function() {
        readURL2(this);
    });

    const input = document.getElementById('house_video_before');
    const video = document.getElementById('video_before');
    const videoSource = document.createElement('source');

    input.addEventListener('change', function() {
        const files = this.files || [];

        if (!files.length) return;

        const reader = new FileReader();

        reader.onload = function(e) {
            videoSource.setAttribute('src', e.target.result);
            video.appendChild(videoSource);
            video.load();
            video.play();
        };

        reader.onprogress = function(e) {
            console.log('progress: ', Math.round((e.loaded * 100) / e.total));
        };

        reader.readAsDataURL(files[0]);
    });

    const input2 = document.getElementById('house_video_after');
    const video2 = document.getElementById('video_after');

    input2.addEventListener('change', function() {
        const files = this.files || [];

        if (!files.length) return;

        const reader = new FileReader();

        reader.onload = function(e) {
            videoSource.setAttribute('src', e.target.result);
            video2.appendChild(videoSource);
            video2.load();
            video2.play();
        };

        reader.onprogress = function(e) {
            console.log('progress: ', Math.round((e.loaded * 100) / e.total));
        };

        reader.readAsDataURL(files[0]);
    });

    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();

        // Click image modal
        var modal = document.getElementById("modal_image");
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");

        $("img").click(function() {
            var img = $(this);
            modal.style.display = "block";
            modalImg.src = this.src;
            captionText.innerHTML = this.alt;
        });


        var span = document.getElementById("btn_close");

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

    });

    $("#submit_form").click(function(e) {
        var video_before = document.getElementById("house_video_before");
        var video_after = document.getElementById('house_video_after');

        let video_before_size = video_before.files[0].size;
        let video_after_size = video_after.files[0].size;

        if (video_before_size > 5000000) {
            alert("Hanya video bersaiz maksimum 5 Mb");
            e.preventDefault();
        }

        if (video_after_size > 5000000) {
            alert("Hanya video bersaiz maksimum 5 Mb");
            e.preventDefault();
        }
    });

    function loadDeleteModal(id) {
            $('#modal_delete_house2 .modal-title').text('Anda pasti untuk hapus gambar/video? ');
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
            url: '/housemedia/' + id,
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
