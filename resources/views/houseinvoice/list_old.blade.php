@extends('layouts.app')

@section('content')
<form id="form_invoice">
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
                        <h4>Invois</h4>
                        <p class="text-subtitle text-muted">Hasilkan invois sewa </p>
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
            <input name="house_id" type="hidden" value="{{$house->id}}">
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
                    <div class="col-sm-9 col-md-9 col-lg-9">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Invois sewaan rumah</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-10 col-md-10 col-lg-10">
                                        <div class="form-group">
                                            <label for="helpInputTop">Tajuk invois</label>
                                            <small class="text-muted">cth.<i> Invois sewa bulan April 2021</i></small>
                                            <input type="text" class="form-control shadow-sm" id="helpInputTop" name="invoice_name" value="Invois Sewa Bulan April 2021">
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-1 mb-1">
                                    <label><strong>Info Pemilik Rumah</strong></label>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8 col-md-8 col-lg-8">
                                        <div class="form-group">
                                            <label for="helpInputTop">Nama penuh</label>
                                            <small class="text-muted">cth.<i> Zakaria bin Idris</i></small>
                                            <input type="text" class="form-control shadow-sm" id="helpInputTop" name="nama_owner" value="{{ $house->namaowner }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="helpInputTop">No kad pengenalan</label>
                                            <small class="text-muted">cth.<i> 8xxxx-1x-xxxx</i></small>
                                            <input type="text" class="form-control shadow-sm" id="helpInputTop" name="ic_owner" value="{{ $house->icowner }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="helpInputTop">Email</label>
                                            <small class="text-muted">cth.<i> harris_jay@gmail.com</i></small>
                                            <input type="text" class="form-control shadow-sm" id="helpInputTop" name="email_owner" value="{{ $house->namaowner }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="helpInputTop">No telefon</label>
                                            <small class="text-muted">cth. 0127678904<i> </i></small>
                                            <input type="text" class="form-control shadow-sm" id="helpInputTop" name="phone_owner" value="{{ $house->icowner }}">
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <div class="mt-1 mb-1">
                                    <label><strong>Info Penyewa Rumah</strong></label>
                                </div>
                                <div class="row">

                                    <div class="col-sm-8 col-md-8 col-lg-8">
                                        <div class="form-group">
                                            <label for="helpInputTop">Nama penuh</label>
                                            <small class="text-muted">cth.<i> Zakaria bin Idris</i></small>
                                            <input type="text" class="form-control shadow-sm" id="helpInputTop" name="nama_tenant" value="{{ $house->namaowner }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="helpInputTop">No kad pengenalan</label>
                                            <small class="text-muted">cth.<i> 8xxxx-1x-xxxx</i></small>
                                            <input type="text" class="form-control shadow-sm" id="helpInputTop" name="ic_tenant" value="{{ $house->icowner }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="helpInputTop">Email</label>
                                            <small class="text-muted">cth.<i> Zakaria bin Idris</i></small>
                                            <input type="text" class="form-control shadow-sm" id="helpInputTop" name="email_tenant" value="{{ $house->namaowner }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="helpInputTop">No telefon</label>
                                            <small class="text-muted">cth.<i> </i></small>
                                            <input type="text" class="form-control shadow-sm" id="helpInputTop" name="phone_tenant" value="{{ $house->icowner }}">
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <div class="mt-1 mb-1">
                                    <label><strong>Item</strong></label>
                                </div>
                                <div class="row">

                                    <div class="col-sm-8 col-md-8 col-lg-8">
                                        <div class="form-group">
                                            <label for="helpInputTop">Jenis item</label>
                                            <small class="text-muted">cth.<i> Sewaan</i></small>
                                            <input type="text" class="form-control shadow-sm" id="helpInputTop" name="item_type" value="Sewa rumah">
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-4 col-lg-4">
                                        <div class="form-group">
                                            <label for="helpInputTop">Harga item (RM)</label>
                                            <small class="text-muted">cth.<i> 20</i></small>
                                            <input id="item_price" type="text" class="form-control shadow-sm" id="helpInputTop" name="item_price" value="">
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="row offset-md-5 offset-lg-5">
                            <button id="button_generate_invoice" type="submit" class="btn btn-primary btn-sm">Hasilkan invois</button>
                        </div>
                    </div>


                </div></section>



        </div>
    </div>

</form>

@endsection

@section('js')
<script>
    $('#button_generate_invoice').click(function (e) {
        e.preventDefault();
        $.ajax({
        type: "get",
        url: "/invois/generate_invoice",
        data: $('#form_invoice').serialize() ,
        dataType: "json",
        success: function (response) {
            console.log(response);
        }
    });

    });

    setInputFilter(document.getElementById("item_price"), function(value) {
        return /^\d*$/.test(value);
    });

    $('[name="item_price"]' ).on('keyup', function() {
        limitText(this, 6)
    });

    function limitText(field, maxChar){
        var ref = $(field),
            val = ref.val();
        if ( val.length >= maxChar ){
            ref.val(function() {
                console.log(val.substr(0, maxChar))
                return val.substr(0, maxChar);
            });
        }
    }

</script>
@endsection