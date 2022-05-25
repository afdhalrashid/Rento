@extends('layouts.app')

@section('css')
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet"> --}}
    <link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>


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

        .input-group-addon {
            padding: .5rem .75rem;
            margin-bottom: 0;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.2;
            color: #495057;
            text-align: center;
            background-color: #e9ecef;
            border: 1px solid rgba(0, 0, 0, .15);
            border-radius: .25rem;
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
            border-left: 0;
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

                        <h3><i class="fas fa-home"></i>Senarai Info Utiliti
                        </h3>

                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/houseutility/{{$houseid}}">Utiliti</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Senarai Info Utiliti </li>
                            </ol>
                        </nav>
                    </div>
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
                <button type="button" class="btn btn-sm btn-burs-y" data-toggle="modal" data-target="#tambahinfoutiliti">
                    Tambah Info Utiliti</button>
            </div>
            @endrole
        </div>

        <section class="section">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"></h4>
                        </div>
                        <div class="card-body" style="overflow-x: auto;">
                            <table id="listhouse_table" class="table">
                                <thead>
                                    <tr>
                                    <th class="">No</th>
                                    <th class="">Nama Utiliti</th>
                                    <th class="">No akaun</th>
                                    <th class="">ID Pengguna</th>
                                    <th class="">Kata Laluan</th>
                                    <th class="">Biller Code (JomPAY)</th>
                                    <th class="">Tarikh Akhir Bayaran</th>
                                    <th width=" 250px">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>@php $i =0; @endphp
                                    @foreach ($utility_info as $utility)
                                        <tr>
                                            <td class="">{{ ++$i }}</td>
                                            <td class="">{{ $utility->utility_name }}</td>
                                            <td class="">{{ $utility->account_no }}</td>
                                            <td class="">{{ $utility->user_account_id }}</td>
                                            <td class="">{{ $utility->user_account_password }}</td>
                                            <td class="">{{ $utility->biller_code }}</td>
                                            <td class="">{{ $utility->last_payment_date }}</td>
                                            <td class="">
                                                @role('Owner')
                                                <button type="button" class="btn    btn-secondary btn-sm" data-toggle="tooltip"
                                                data-placement="top" title="Kemaskini info"
                                                    onclick="loadEditModal('{{ $utility->id }}', '{{ $utility->utility_name }}', '{{ $utility->account_no }}',  '{{ $utility->user_account_id }}', '{{ $utility->user_account_password }}','{{ $utility->biller_code }}','{{ $utility->last_payment_date }}')">
                                                <i class="fa fa-pencil"></i>
                                                </button>

                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip"
                                                data-placement="top" title="Hapus info"
                                                    onclick="loadDeleteModal('{{ $utility->id }}', '{{ $utility->utility_name }}', '{{ $utility->account_no }}', '{{ $utility->biller_code }}')"><i
                                                    class="fas fa-trash"></i>
                                                </button>
                                                @endrole
                                            </td>

                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <form action="{{ route('houseutilityinfo.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="modal" tabindex="-1" role="dialog" id="tambahinfoutiliti">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">

                            <h5 class="modal-title">
                                <p class="">Tambah Info Utiliti</p>
                                <div class=" row ml-2"
                                    style="position: relative;">
                                    <small>(* Maklumat wajib diisi)</small>

                        </div>
                        </h5>



                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <input type="hidden" value="{{$houseid}}" name="house_id">
                                <div class="col-sm-6 col-md-6 col-lg-6 px-0">
                                    <div class="form-group">
                                        <label for="helpInputTop">Jenis Utiliti</label>
                                        <small class="text-muted">cth.<i> Elektrik</i></small>
                                        {{ old('utility_name') }}
                                        <select class="form-control form-select-sm shadow-sm"
                                            aria-label="Default select example" name="utility_name">
                                            <option value="" selected>- Sila Pilih -</option>
                                            @foreach ($global_utility_name as $utility_name)
                                                @if (Request::old('utility_name') == $utility_name->type_id)
                                                    <option value="{{ $utility_name->type_id }}" selected>
                                                        {{ $utility_name->type_name }}</option>
                                                @else
                                                    <option value="{{ $utility_name->type_id }}">
                                                        {{ $utility_name->type_name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6 px-2">
                                    <div class="form-group">
                                        <label for="helpInputTop">No akaun (*) </label>
                                        <small class="text-muted"><i>Cth: 456445389
                                                2021</i></small>
                                        <input type="text" class="form-control shadow-sm alphaonly" maxlength="100"
                                            id="account_no" name="account_no" value="{{ old('account_no') }}">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-6 px-0">
                                    <div class="form-group">
                                        <label for="helpInputTop">ID Pengguna (*) </label>
                                        <small class="text-muted"><i>Cth: 456445389
                                                2021</i></small>
                                        <input type="text" class="form-control shadow-sm alphaonly" maxlength="100"
                                            id="user_account_id" name="user_account_id" value="{{ old('user_account_id') }}">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6 px-2">
                                    <div class="form-group">
                                        <label for="helpInputTop">Kata Laluan (*) </label>
                                        <small class="text-muted"><i>Cth: ff332fa1!!
                                                2021</i></small>
                                                <div class="input-group" id="show_hide_password">
                                                    <input type="password" name="user_account_password" class="form-control" placeholder="Kata laluan"
                                                        value="{{ old('user_account_password') }}">
                                                    <div class="input-group-addon">
                                                        <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                                    </div>

                                                </div>
                                        {{-- <input type="password" class="form-control shadow-sm alphaonly" maxlength="100"
                                            id="password" name="password" value="{{ old('password') }}"> --}}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-6 px-0">
                                    <div class="form-group">
                                        <label for="helpInputTop">Biller Code (JomPAY) (*) </label>
                                        <small class="text-muted"><i>Cth: 456445389
                                                2021</i></small>
                                        <input type="text" class="form-control shadow-sm alphaonly" maxlength="100"
                                            id="biller_code" name="biller_code" value="{{ old('biller_code') }}">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6 px-2">
                                    <div class="form-group">
                                        <label for="helpInputTop">Tarikh Pembayaran Terakhir</label>
                                        <small class="text-muted">cth.<i> 20/04/2021</i></small>
                                        {{ old('last_payment_date') }}
                                        <div class="datepicker date input-group p-0 shadow-sm">
                                            <input name="last_payment_date" type="text" placeholder="Pilih tarikh"
                                                class="form-control py-1 px-3" id="last_payment_date">
                                            <div class="input-group-append"><span class="input-group-text px-4"><i
                                                        class="fa fa-clock-o"></i></span></div>
                                        </div>
                                    </div>
                                </div>
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

    {{-- Modal edit --}}

    <form id="editform" action="{{ route('houseutilityinfo.update', 'x') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal" tabindex="-1" role="dialog" id="editinfoutiliti">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <h5 class="modal-title">
                            <p class="">Kemaskini Info Utiliti</p>
                            <div class=" row ml-2"
                                style="position: relative;">
                                <small>(* Maklumat wajib diisi)</small>

                    </div>
                    </h5>



                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <input type="hidden" value="{{$houseid}}" name="house_id">
                            <div class="col-sm-6 col-md-6 col-lg-6 px-0">
                                <div class="form-group">
                                    <label for="helpInputTop">Jenis Utiliti</label>
                                    <small class="text-muted">cth.<i> Elektrik</i></small>
                                    {{ old('utility_name') }}
                                    <select class="form-control form-select-sm shadow-sm"
                                        aria-label="Default select example" id="edit_utility_name" name="utility_name">
                                        <option value="" selected>- Sila Pilih -</option>
                                        @foreach ($global_utility_name as $utility_name)
                                            @if (Request::old('utility_name') == $utility_name->type_id)
                                                <option value="{{ $utility_name->type_id }}" selected>
                                                    {{ $utility_name->type_name }}</option>
                                            @else
                                                <option value="{{ $utility_name->type_id }}">
                                                    {{ $utility_name->type_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6 px-2">
                                <div class="form-group">
                                    <label for="helpInputTop">No akaun (*) </label>
                                    <small class="text-muted"><i>Cth: 456445389
                                            2021</i></small>
                                    <input type="text" class="form-control shadow-sm alphaonly" maxlength="100"
                                        id="edit_account_no" name="account_no" value="{{ old('account_no') }}">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-6 px-0">
                                <div class="form-group">
                                    <label for="helpInputTop">ID Pengguna (*) </label>
                                    <small class="text-muted"><i>Cth: 456445389
                                            2021</i></small>
                                    <input type="text" class="form-control shadow-sm alphaonly" maxlength="100"
                                        id="edit_user_account_id" name="user_account_id" value="{{ old('user_account_id') }}">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6 px-2">
                                <div class="form-group">
                                    <label for="helpInputTop">Kata Laluan (*) </label>
                                    <small class="text-muted"><i>Cth: ff332fa1!!
                                            2021</i></small>
                                            <div class="input-group" id="show_hide_password">
                                                <input type="password"
                                                id="edit_user_account_password" name="user_account_password" class="form-control" placeholder="Kata laluan"
                                                    value="{{ old('user_account_password') }}">
                                                <div class="input-group-addon">
                                                    <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                                </div>

                                            </div>
                                    {{-- <input type="password" class="form-control shadow-sm alphaonly" maxlength="100"
                                        id="password" name="password" value="{{ old('password') }}"> --}}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-6 px-0">
                                <div class="form-group">
                                    <label for="helpInputTop">Biller Code (JomPAY) (*) </label>
                                    <small class="text-muted"><i>Cth: 456445389
                                            2021</i></small>
                                    <input type="text" class="form-control shadow-sm alphaonly" maxlength="100"
                                        id="edit_biller_code" name="biller_code" value="{{ old('biller_code') }}">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6 px-2">
                                <div class="form-group">
                                    <label for="helpInputTop">Tarikh Pembayaran Terakhir</label>
                                    <small class="text-muted">cth.<i> 20/04/2021</i></small>
                                    {{ old('last_payment_date') }}
                                    <div class="datepicker date input-group p-0 shadow-sm">
                                        <input id="edit_last_payment_date" name="last_payment_date" type="text" placeholder="Pilih tarikh"
                                            class="form-control py-1 px-3" id="last_payment_date">
                                        <div class="input-group-append"><span class="input-group-text px-4"><i
                                                    class="fa fa-clock-o"></i></span></div>
                                    </div>
                                </div>
                            </div>
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

    {{-- end modal edit --}}

    <!-- Modal -->
    <div class="modal fade" id="modal_delete_utility_info" data-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true" style="z-index: 1060">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Adakah anda pasti ingin hapus maklumat ini?</h5>

                </div>
                <div class="modal-body">
                    <div id="maklumat_utiliti"></div>
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

            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("fa-eye-slash");
                    $('#show_hide_password i').removeClass("fa-eye");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("fa-eye-slash");
                    $('#show_hide_password i').addClass("fa-eye");
                }
            });

            $("#show_hide_confirmpassword a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_confirmpassword input').attr("type") == "text") {
                    $('#show_hide_confirmpassword input').attr('type', 'password');
                    $('#show_hide_confirmpassword i').addClass("fa-eye-slash");
                    $('#show_hide_confirmpassword i').removeClass("fa-eye");
                } else if ($('#show_hide_confirmpassword input').attr("type") == "password") {
                    $('#show_hide_confirmpassword input').attr('type', 'text');
                    $('#show_hide_confirmpassword i').removeClass("fa-eye-slash");
                    $('#show_hide_confirmpassword i').addClass("fa-eye");
                }
            });


            var modal = document.getElementById("modal_image");
            var modalImg = document.getElementById("img01");
            var captionText = document.getElementById("caption");

            $(".hs_img").click(function() {
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

        $('.datepicker').datepicker({
            clearBtn: true,
            format: "dd/mm/yyyy"
        });

        function loadEditModal(utility_id, utility_name, account_no, user_account_id, user_account_password, biller_code, last_payment_date) {
            url = $('#editform').attr('action');
            new_url = url.replace('x', utility_id);
            $('#editform').attr('action', new_url);

            $('#edit_utility_name option[value="' + utility_name + '"]').attr('selected', 'true');
            $('#edit_account_no').val(account_no);
            $('#edit_user_account_id').val(user_account_id);
            $('#edit_user_account_password').val(user_account_password);
            $('#edit_biller_code').val(biller_code);

            // var parts = last_payment_date.split(' ');
            // // Please pay attention to the month (parts[1]); JavaScript counts months from 0:
            // // January - 0, February - 1, etc.
            // var mydate = new Date(parts[0], parts[1] - 1, parts[2]);
            // console.log(mydate.toDateString());

            $('#edit_last_payment_date').val(last_payment_date);
                $('#edit_last_payment_date').datepicker({
                    format: 'dd/mm/yyyy',
                    autoclose: true
                }).datepicker('update');
            $('#editinfoutiliti').modal('show');
        }

        $('#modal_delete_utility_info').on('show.bs.modal', function(event) {
            $('#modal_delete_utility_info .msg').text('');
            $('#modal_delete_utility_info .msg').hide();
        });

        function loadDeleteModal(id, utility_name, account_no, biller_code) {
            $('#modal_delete_utility_info .modal-title').text('Anda pasti untuk hapus info utiliti di bawah? ');
            $('#modal_delete_utility_info .modal-body #maklumat_utiliti').html('<p>Nama Utiliti: ' + utility_name + '</p>' +
                '<p>Akaun Utiliti: ' + account_no + '</p>' +
                '<p>Biller Code Utiliti: ' + biller_code + '</p>'
                );
            $('#modal_delete_utility_info #modal-confirm_delete').attr('onclick', 'confirmDelete(' + id + ')');
            $('#modal_delete_utility_info').modal('show');
        }

        function confirmDelete(id) {
            console.log(id);
            $('#modal_delete_utility_info .msg').text('');
            $('#modal_delete_utility_info .msg').hide();

            // return;
            $.ajax({
                url: '/houseutilityinfo/' + id,
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    '_method': 'delete',
                },
                success: function(data) {
                    console.log(data);
                    $('#modal_delete_utility_info .msg').text(data.success);
                    $("#modal_delete_utility_info .msg").slideDown(300).delay(300).fadeOut(500, 'swing', closeModal);


                },
                error: function(error) {
                    // Error logic goes here..!
                }
            });
        }

        function closeModal() {
            $('#modal_delete_utility_info').delay(500).modal('hide');
            location.reload();
        }
    </script>
@endsection
