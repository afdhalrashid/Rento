@extends('layouts.app')

@section('css')
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet"> --}}
    <link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" rel="stylesheet">
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

                        <h3><i class="fas fa-home"></i>&nbsp;@hasanyrole('Admin|Staf') Senarai
                            Pemilik/Pengurus Rumah @endhasanyrole
                            @hasanyrole('Owner')Senarai Rumah @endhasanyrole
                            @hasanyrole('Tenant')Maklumat Rumah @endhasanyrole
                        </h3>
                        <p class="text-subtitle text-muted">
                            @hasanyrole('Admin|Staf')@endhasanyrole
                            @hasanyrole('Owner')Senarai rumah di bawah jagaan anda @endhasanyrole
                            @hasanyrole('Tenant')Maklumat Rumah Sewa @endhasanyrole
                        </p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@hasanyrole('Admin|Staf') Senarai
                                Pemilik/Pengurus Rumah @else
                                    Senarai Rumah @endhasanyrole</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                @role('Owner')
                <div class="row">
                    <div class="col-lg-12 col-12 col-md-12 text-right">
                        <a href="{{ route('house.create') }}" type="button" class="btn-sm btn btn-success">
                            Tambah rumah</a>
                    </div>
                </div>
                @endrole
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
                        <div class="card-body" style="overflow-x: auto;">
                            <table id="listhouse_table" class="table">
                                <thead>
                                    <tr>
                                    <th class="">No</th>
                                    <th class="">@role('Owner') Nama Pemilik/Pengurus @else Nama @endrole </th>
                                                                                                                                                                            <th class="















                                                              ">
                                        @role('Owner') No Telefon @else No Telefon @endrole
                                        </th>
                                        <th class="">@role('Owner') Emel @else Emel @endrole
                                    </th>
                                    <th class="">Alamat</th>
                                                                                                                                                                        <th class="














                                                              ">
                                            Gambar
                                            Rumah
                                        </th>
                                        <th width=" 250px">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($houses as $house)
                                        <tr>
                                            <td class="">{{ ++$i }}</td>
                                    <td class="">{{ $house->namaowner }}</td>
                                                                                                                                                                            <td class="















                                                              ">
                                                {{ $house->phoneno_owner }}
                                            </td>
                                            <td class="">@role('Owner') <span style="">
                                            {{ $house->email_owner }}</span> @else
                                                {{ $house->email_owner }}@endrole</td>
                                            <td class="">{{ $house->address1 }}, {{ $house->address2 }}, {{ $house->poskod }},
                                                                                                                                                                {{ $house->daerah }}, {{ $house->negeri }}</td>
                                                                                                                                                            <td class=" ">
                                                               @foreach ($house->images as
                                                $image)
                                                <img class="hs_img" src="{{ asset($image->image_path) }}"
                                                    width="80px" height="75px" />
                                    @endforeach

                                    </td>
                                    <td>


                                        {{-- <a class="btn btn-info btn-sm" href="{{ route('house.show',$house->id) }}">Show</a> --}}
                                        @hasanyrole('Super Admin|Admin|Staf|Tenant')
                                        <a class="btn btn-primary btn-sm"
                                            href="{{ route('house.edit', $house->id) }}">Lihat</a>
                                        @endrole
                                        @role('Owner')
                                        <a class="btn btn-primary btn-sm" data-toggle="tooltip"
                                        data-placement="top" title="Kemaskini"
                                            href="{{ route('house.edit', $house->id) }}"><i class="fa fa-pencil"
                                            aria-hidden="true"></i></a>

                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip"
                                        data-placement="top" title="Hapus"
                                            onclick="loadDeleteModal('{{ $house->id }}','{{ $house->namaowner }}','{{ $house->icowner }}','{{ $house->address1 }} , {{ $house->address2 }} , {{$house->poskod}} , {{$house->daerah }} ,{{ $house->negeri }}')"><i
                                            class="fas fa-trash-alt"></i>
                                        </button>
                                        @endrole

                                        {{-- <a class="btn btn-danger btn-sm deletehouse" data-toggle="modal" data-userid="{{$house->id}}" data-target="#modal_delete_house">
                                      Hapus
                                    </a> --}}

                                        {{-- @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button> --}}

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

        <?php /*
                                                                        <div class="row" style=" overflow-x: auto;">
                                                                            <table id="listhouse_table" class="table table-striped">
                                                                                <thead>
                                                                                    <tr>
                                                                                    <th class="">No</th>
                                                                                    <th class="">@role('Owner') Nama Pemilik/Pengurus @else Nama Pemilik Rumah @endrole </th>
                                                                                                                                                                                            <th class="







                                                                                                              ">
                                                                                        @role('Owner') No Telefon @else No Telefon
                                                                                            Pemilik
                                                                                            Rumah @endrole
                                                                                        </th>
                                                                                        <th class="">@role('Owner') Emel @else Emel Pemilik Rumah @endrole
                                                                                    </th>
                                                                                    <th class="">Alamat Rumah</th>
                                                                                                                                                                                        <th class="






                                                                                                              ">
                                                                                            Gambar
                                                                                            Rumah
                                                                                        </th>
                                                                                        <th width=" 250px">Tindakan</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                @foreach ($houses as $house)
                                                                                    <tr>
                                                                                        <td class="">{{ ++$i }}</td>
                                                                                    <td class="">{{ $house->namaowner }}</td>
                                                                                                                                                                                            <td class="







                                                                                                              ">
                                                                                            {{ $house->phoneno_owner }}
                                                                                        </td>
                                                                                        <td class="">
                                                                                        {{ $house->email_owner }}</td>
                                                                                    <td class="">{{ $house->address1 }}, {{ $house->address2 }}, {{ $house->poskod }},
                                                                                                                                                                                            {{ $house->daerah }}, {{ $house->negeri }}</td>
                                                                                                                                                                                        <td class="










                                                                                            ">
                                                                                            @foreach ($house->images as $image)
                                                                                                <img class="hs_img" src="{{ asset($image->image_path) }}" width="80px"
                                                                                                    height="75px" />
                                                                                            @endforeach

                                                                                        </td>
                                                                                        <td>


                                                                                            {{-- <a class="btn btn-info btn-sm" href="{{ route('house.show',$house->id) }}">Show</a> --}}
                                                                                            @hasanyrole('Super Admin|Admin|Staf|Tenant')
                                                                                            <a class="btn btn-primary btn-sm" href="{{ route('house.edit', $house->id) }}">Lihat</a>
                                                                                            @endrole
                                                                                            @role('Owner')
                                                                                            <a class="btn btn-primary btn-sm" href="{{ route('house.edit', $house->id) }}">Kemaskini</a>

                                                                                            <button type="button" class="btn btn-danger btn-sm"
                                                                                                onclick="loadDeleteModal('{{ $house->id }}','{{ $house->namaowner }}','{{ $house->icowner }}')">Hapus
                                                                                            </button>
                                                                                            @endrole

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

        $('#modal_delete_house').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('whatever') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var row = button.closest("tr"); // Finds the closest row <tr>
            var houseid = row.find("td:nth-child(0)");
            var owner = row.find("td:nth-child(3)").text(); //Finds the 2nd <td> element
            var icowner = row.find("td:nth-child(4").text(); // Finds the 3rd <td> element
            var alamat = row.find("td:nth-child(6").text(); // Finds the 3rd <td> element

            console.log(houseid);

            $('#house_id').val(houseid);

            var modal = $(this)
            modal.find('.modal-title').text('Anda pasti untuk hapus rumah di bawah: ')
            modal.find('.modal-body #maklumat_owner').html('<p>Nama Pemilik: ' + owner + '</p>' +
                '<p>No telefon : ' + icowner + '</p>' +
                '<p>Alamat : ' + alamat + '</p>'
                )
        })

        $('#modal_delete_house2').on('show.bs.modal', function(event) {
            $('#modal_delete_house2 .msg').text('');
            $('#modal_delete_house2 .msg').hide();
        });

        $(document).on('click', '.deletehouse', function() {
            var houseID = $(this).attr('data-userid');
            $('#house_id').val(houseID);
        });

        function loadDeleteModal(id, name, ic, alamat) {
            $('#modal_delete_house2 .modal-title').text('Anda pasti untuk hapus pemilik rumah di bawah: ');
            $('#modal_delete_house2 .modal-body #maklumat_owner').html('<p>Nama Pemilik Rumah: ' + name + '</p>' +
                '<p>No telefon : ' + ic + '</p>'+
                '<p>Alamat : ' + alamat + '</p>'
                );
            $('#modal_delete_house2 #modal-confirm_delete').attr('onclick', 'confirmDelete(' + id + ')');
            $('#modal_delete_house2').modal('show');
        }

        function confirmDelete(id) {
            console.log(id);
            $('#modal_delete_house2 .msg').text('');
            $('#modal_delete_house2 .msg').hide();

            // return;
            $.ajax({
                url: '{{ url('house') }}/' + id,
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

                    $("#modal_delete_house2 .msg").slideDown(300).delay(300).fadeOut(500, 'swing', closeModal);


                },
                error: function(error) {
                    // Error logic goes here..!
                }
            });
        }

        function closeModal() {
            $('#modal_delete_house2').delay(500).modal('hide');
            location.reload();
        }
    </script>
@endsection
