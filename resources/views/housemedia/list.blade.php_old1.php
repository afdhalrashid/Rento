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
</style>
@endsection

@section('content')
<form action="{{ route('housemedia.store')}}" method="POST" enctype="multipart/form-data">
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

        @foreach($house['media'] as $media)
        @if($media->file_for == 'gambar sebelum')
        @php
        $imgbefore = $media
        @endphp
        @endif
        @if($media->file_for == 'gambar selepas')
        @php
        $imgafter = $media
        @endphp
        @endif
        @if($media->file_for == 'video sebelum')
        @php
        $videobefore = $media
        @endphp
        @endif

        @if($media->file_for == 'video selepas')
        @php
        $videoafter = $media
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
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h4>Dokumen</h4>
                    <p class="text-subtitle text-muted">Senarai Dokumen Penting Rumah </p>
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
                        <h4 class="card-title">Maklumat rumah</h4>
                    </div>
                    <div class="card-body">
                        @include('layouts.houseprofile2')
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Gambar rumah</h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Jenis gambar</th>
                                    <th scope="col">Upload</th>
                                    <th scope="col" style="width: 25%">Fail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Gambar sebelum</td>
                                    <td>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="house_image_before" name="house_image_before" value="{{old('house_image_before')}}" multiple="">
                                            <label class="custom-file-label" for="customFile">Pilih gambar sebelum</label>
                                        </div>
                                        {{-- @isset($imgbefore)
                                                <div class="my-2">
                                                    <span class="row mx-1">Nama fail: {{$imgbefore->name}}</span>
                                        <img src="{{asset($imgbefore->file_path)}}" id="category-img-tag1" width="300px" height="250px" style="padding:1rem;" />
                    </div>
                    @else
                    <div class="my-2">
                        <span class="mx-1"></span>
                        <img src="#" id="category-img-tag1" width="300px" height="250px" style="display: none;padding:1rem;" />
                    </div>
                    @endisset --}}

                    </td>
                    <td>
                        @isset($imgbefore)
                        <div class="my-0">

                            <img src="{{asset($imgbefore->file_path)}}" id="category-img-tag1" width="80px" height="75px" style="" data-toggle="tooltip" data-html="true" title="<em>Fail: </em> <u>{{$imgbefore->name}}</u>" />
                        </div>
                        @else
                        <div class="my-0">
                            <span class="mx-1"></span>
                            <img src="#" id="category-img-tag1" width="80px" height="75px" style="display: none;;" />
                        </div>
                        @endisset
                    </td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Gambar selepas</td>
                        <td>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="house_image_after" name="house_image_after" value="{{old('house_image_after')}}" multiple="">
                                <label class="custom-file-label" for="customFile">Pilih gambar selepas</label>
                            </div>
                            {{-- @isset($imgafter)
                                                <div class="my-2">
                                                    <span class="row mx-1">Nama fail: {{$imgafter->name}}</span>
                            <img src="{{asset($imgafter->file_path)}}" id="category-img-tag2" width="300px" height="250px" style="padding:1rem;" />
                </div>
                @else
                <div class="my-2">
                    <span class="mx-1"></span>
                    <img src="#" id="category-img-tag2" width="300px" height="250px" style="display: none;padding:1rem;" />
                </div>
                @endisset --}}

                </td>
                <td>
                    @isset($imgafter)
                    <div class="my-0">

                        <img src="{{asset($imgafter->file_path)}}" id="category-img-tag1" width="80px" height="75px" style="" data-toggle="tooltip" data-html="true" title="<em>Fail: </em> <u>{{$imgafter->name}}</u>" />
                    </div>
                    @else
                    <div class="my-0">
                        <span class="mx-1"></span>
                        <img src="#" id="category-img-tag1" width="80px" height="75px" style="display: none;;" />
                    </div>
                    @endisset
                </td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Video sebelum</td>
                    <td>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="house_video_before" name="house_video_before" value="{{old('house_video_before')}}" multiple="" accept="video/*">
                            <label class="custom-file-label" for="customFile">Pilih video sebelum</label>
                        </div>
                        @isset($videobefore)
                        <div class="my-2">
                            <span class="row mx-1">Nama fail: {{$videobefore->name}}</span>
                            <video id="video_before" width="300" height="300" controls>
                                <source src="{{asset($videobefore->file_path)}}">
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
                            <input type="file" class="custom-file-input" id="house_video_after" name="house_video_after" value="{{old('house_video_after')}}" multiple="">
                            <label class="custom-file-label" for="customFile">Pilih video selepas</label>
                        </div>
                        @isset($videoafter)
                        <div class="my-2">
                            <span class="row mx-1">Nama fail: {{$videoafter->name}}</span>
                            <video id="video_after" width="300" height="300" controls>
                                <source src="{{asset($videoafter->file_path)}}">
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

                </tbody>
                </table>

            </div>
        </div>
        <div class="row offset-md-5 offset-lg-5">
            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
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
@endsection

@section('js')
<script>
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
</script>
@endsection