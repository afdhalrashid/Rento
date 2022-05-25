@extends('layouts.app')

@section('css')
    <style>
        .card-big-shadow {
            max-width: 320px;
            position: relative;
        }

        .coloured-cards .card {
            margin-top: 30px;
        }

        .card[data-radius="none"] {
            border-radius: 0px;
        }

        .card {
            border-radius: 8px;
            box-shadow: 0 2px 2px rgba(204, 197, 185, 0.5);
            background-color: #FFFFFF;
            color: #252422;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
        }

        .description {
            text-align: left;
            padding-left: 1rem;
        }


        .card[data-background="image"] .title,
        .card[data-background="image"] .stats,
        .card[data-background="image"] .category,
        .card[data-background="image"] .description,
        .card[data-background="image"] .content,
        .card[data-background="image"] .card-footer,
        .card[data-background="image"] small,
        .card[data-background="image"] .content a,
        .card[data-background="color"] .title,
        .card[data-background="color"] .stats,
        .card[data-background="color"] .category,
        .card[data-background="color"] .description,
        .card[data-background="color"] .content,
        .card[data-background="color"] .card-footer,
        .card[data-background="color"] small,
        .card[data-background="color"] .content a {
            color: #272727;
        }

        .card.card-just-text .content {
            padding: 20px 8px;
            text-align: center;
            padding-bottom: 60px;
        }

        .card .content {
            padding: 20px 20px 10px 20px;
        }

        .card[data-color="blue"] .category {
            color: #7a9e9f;
        }

        .card .category,
        .card .label {
            font-size: 14px;
            margin-bottom: 0px;
        }

        .card-big-shadow:before {
            background-image: url("http://static.tumblr.com/i21wc39/coTmrkw40/shadow.png");
            background-position: center bottom;
            background-repeat: no-repeat;
            background-size: 100% 100%;
            bottom: -12%;
            content: "";
            display: block;
            left: -12%;
            position: absolute;
            right: 0;
            top: 0;
            z-index: 0;
        }

        h4,
        .h4 {
            font-size: 1.5em;
            font-weight: 600;
            line-height: 1.2em;
        }

        h6,
        .h6 {
            font-size: 0.9em;
            font-weight: 600;
            text-transform: uppercase;
        }

        .card .description {
            font-size: 16px;
            color: #66615b;
        }

        .content-card {
            margin-top: 30px;
        }

        a:hover,
        a:focus {
            text-decoration: none;
        }

        /*======== COLORS ===========*/
        .card[data-color="blue"] {
            background: #b8d8d8;
        }

        .card[data-color="blue"] .description {
            color: #506568;
        }

        .card[data-color="green"] {
            background: #d5e5a3;
        }

        .card[data-color="green"] .description {
            color: #60773d;
        }

        .card[data-color="green"] .category {
            color: #92ac56;
        }

        .card[data-color="yellow"] {
            background: #ffe28c;
        }

        .card[data-color="yellow"] .description {
            color: #b25825;
        }

        .card[data-color="yellow"] .category {
            color: #d88715;
        }

        .card[data-color="brown"] {
            background: #d6c1ab;
        }

        .card[data-color="brown"] .description {
            color: #75442e;
        }

        .card[data-color="brown"] .category {
            color: #a47e65;
        }

        .card[data-color="purple"] {
            background: #baa9ba;
        }

        .card[data-color="purple"] .description {
            color: #3a283d;
        }

        .card[data-color="purple"] .category {
            color: #5a283d;
        }

        .card[data-color="orange"] {
            background: #ff8f5e;
        }

        .card[data-color="orange"] .description {
            color: #772510;
        }

        .card[data-color="orange"] .category {
            color: #e95e37;
        }

        .card[data-color="red"] {
            background: #ff6060;
        }

        .card[data-color="red"] .description {
            color: #2b2b2b;
        }

        .card[data-color="red"] .title {
            color: #414141;
        }

        .card .note-date {
            color: rgb(31, 48, 51);
            font-size: 12px;
        }

    </style>
@endsection

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

                        <h3><i class="fa fa-bullhorn" aria-hidden="true"></i>&nbsp;Senarai Nota</h3>
                        <p class="text-subtitle text-muted">Senarai nota anda</p>
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
            @hasanyrole('Admin|Staf|Owner')
            <div class="col-lg-4 order-md-2">
                <button type="button" class="btn btn-sm btn-burs-y" data-toggle="modal" data-target="#tambahnota">
                    Tambah Nota</button>
            </div>
            @endhasanyrole
        </div>

        <div class="container bootstrap snippets bootdeys">
            <div class="row">
                @foreach ($notes as $note)

                    <div class="col-md-4 col-sm-6 content-card">
                        <div class="card-big-shadow">
                            <div class="card card-just-text" data-background="color" data-color="{{ $note->colorid }}"
                                data-radius="none">
                                <div class="content">
                                    {{-- <h6 class="category">Best cards</h6> --}}
                                    <h4 class="title">{{ $note->title }}</h4>
                                    <p class="description">{!! nl2br($note->notes) !!}</p>
                                </div>
                                <div class="row">
                                    <div class="col-lg-5 col-md-5 col-sm-5"><button type="button"
                                            class="btn btn-danger btn-sm ml-1 mb-1" data-toggle="tooltip"
                                            data-placement="top" title="Hapus nota"
                                            onclick="loadDeleteModal('{{ $note->id }}','{{ $note->title }}')"><i
                                                class="fas fa-trash"></i>
                                        </button>
                                        <button type="button" class="btn btn-secondary btn-sm mb-1"
                                            onclick="loadEditModal('{{ $note->id }}','{{ $note->title }}',`{{ $note->notes }}`,'{{ $note->colorid }}')">
                                            <i class="fa fa-pencil"></i>
                                        </button>


                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 note-date font-italic mr-3 text-right">
                                        {{ $note->created_at }}
                                    </div>
                                </div>

                            </div> <!-- end card -->
                        </div>
                    </div>

                @endforeach

            </div>
        </div>

        @hasanyrole ('Admin|Staf|Owner')
        {{-- Add Hebahan --}}
        <form action="{{ route('notes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="modal" tabindex="-1" role="dialog" id="tambahnota">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">

                            <h5 class="modal-title">
                                <p class="">Tambah nota</p>
                            </h5>
                            <div class="
                                    row mt-4 ml-2" style="position: fixed;">
                                    <small>(* Maklumat wajib diisi)</small>

                        </div>


                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12 px-0">
                                    <div class="form-group">
                                        <label for="helpInputTop">Tajuk nota (*) </label>
                                        <small class="text-muted"><i>Cth: Sewa 2022 naik 5%</i></small>
                                        <input type="text" class="form-control shadow-sm alphaonly" maxlength="100"
                                            id="title" name="title" value="{{ old('title') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row" style="height: auto;">
                                <textarea rows="10" id="notes" class="form-control"
                                    name="notes">{{ old('notes') }}</textarea>
                            </div>
                            <div class="row mt-4">
                                {{-- <input type="color" id="notescolor" name="notescolor" value="#ff0000"> --}}

                                <div class="form-check pr-3">
                                    <input class="form-check-input" type="radio" name="notescolor" id="notescolor"
                                        value="blue" checked>
                                    <label class="form-check-label" for="notescolor">
                                        Biru
                                    </label>
                                </div>
                                <div class="form-check pr-3">
                                    <input class="form-check-input" type="radio" name="notescolor" id="notescolor"
                                        value="green">
                                    <label class="form-check-label" for="notescolor">
                                        Hijau
                                    </label>
                                </div>
                                <div class="form-check pr-3">
                                    <input class="form-check-input" type="radio" name="notescolor" id="notescolor"
                                        value="yellow">
                                    <label class="form-check-label" for="notescolor">
                                        Kuning
                                    </label>
                                </div>
                                <div class="form-check pr-3">
                                    <input class="form-check-input" type="radio" name="notescolor" id="notescolor"
                                        value="brown">
                                    <label class="form-check-label" for="notescolor">
                                        Coklat
                                    </label>
                                </div>
                                <div class="form-check pr-3">
                                    <input class="form-check-input" type="radio" name="notescolor" id="notescolor"
                                        value="purple">
                                    <label class="form-check-label" for="notescolor">
                                        Ungu
                                    </label>
                                </div>
                                <div class="form-check pr-3">
                                    <input class="form-check-input" type="radio" name="notescolor" id="notescolor"
                                        value="orange">
                                    <label class="form-check-label" for="notescolor">
                                        Oren
                                    </label>
                                </div>
                                <div class="form-check pr-3">
                                    <input class="form-check-input" type="radio" name="notescolor" id="notescolor"
                                        value="red">
                                    <label class="form-check-label" for="notescolor">
                                        Merah
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
    </div>
    </form>

    <form id="editform" action="{{ route('notes.update', 'x') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal" tabindex="-1" role="dialog" id="editnota">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <h5 class="modal-title">
                            <p class="">Kemaskini nota</p>
                            </h5>
                            <div class="
                                row mt-4 ml-2" style="position: fixed;">
                                <small>(* Maklumat wajib diisi)</small>

                    </div>


                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12 px-0">
                                <div class="form-group">
                                    <label for="helpInputTop">Tajuk nota (*) </label>
                                    <small class="text-muted"><i>Cth: Pengurangan sewaan untuk bulan Mei
                                            2021</i></small>
                                    <input type="text" class="form-control shadow-sm alphaonly" maxlength="100"
                                        id="edit_title" name="edit_title" value="{{ old('edit_title') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row" style="height: auto;">
                            <textarea rows="10" id="edit_notes" class="form-control"
                                name="edit_notes">{{ old('edit_notes') }}</textarea>
                        </div>
                        <div class="row mt-4">
                            {{-- <input type="color" id="notescolor" name="notescolor" value="#ff0000"> --}}

                            <div class="form-check pr-3">
                                <input class="form-check-input" type="radio" name="edit_notescolor" id="edit_notescolor"
                                    value="blue" checked>
                                <label class="form-check-label" for="edit_notescolor">
                                    Biru
                                </label>
                            </div>
                            <div class="form-check pr-3">
                                <input class="form-check-input" type="radio" name="edit_notescolor" id="edit_notescolor"
                                    value="green">
                                <label class="form-check-label" for="edit_notescolor">
                                    Hijau
                                </label>
                            </div>
                            <div class="form-check pr-3">
                                <input class="form-check-input" type="radio" name="edit_notescolor" id="edit_notescolor"
                                    value="yellow">
                                <label class="form-check-label" for="edit_notescolor">
                                    Kuning
                                </label>
                            </div>
                            <div class="form-check pr-3">
                                <input class="form-check-input" type="radio" name="edit_notescolor" id="edit_notescolor"
                                    value="brown">
                                <label class="form-check-label" for="edit_notescolor">
                                    Coklat
                                </label>
                            </div>
                            <div class="form-check pr-3">
                                <input class="form-check-input" type="radio" name="edit_notescolor" id="edit_notescolor"
                                    value="purple">
                                <label class="form-check-label" for="edit_notescolor">
                                    Ungu
                                </label>
                            </div>
                            <div class="form-check pr-3">
                                <input class="form-check-input" type="radio" name="edit_notescolor" id="edit_notescolor"
                                    value="orange">
                                <label class="form-check-label" for="edit_notescolor">
                                    Oren
                                </label>
                            </div>
                            <div class="form-check pr-3">
                                <input class="form-check-input" type="radio" name="edit_notescolor" id="edit_notescolor"
                                    value="red">
                                <label class="form-check-label" for="edit_notescolor">
                                    Merah
                                </label>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Kemaskini</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
        </div>
    </form>

    <!-- Modal delete-->
    <div class="modal fade" id="modal_delete_note" data-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true" style="z-index: 1060">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Adakah anda pasti ingin hapus maklumat ini?
                    </h5>

                </div>
                <div class="modal-body">
                    <div id="maklumat_note"></div>
                </div>
                <div class="modal-footer">
                    <div class="msg"
                        style="position:absolute;float: left;left:0.6rem;color:rgba(4, 124, 40, 0.9)">
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

    @endhasanyrole


    </div>

@endsection

@section('js')

    <script>
        function loadEditModal(note_id, note_title, note_notes, note_colorid) {
            url = $('#editform').attr('action');
            new_url = url.replace('x', note_id);
            $('#editform').attr('action', new_url);

            $('#edit_title').val(note_title);
            $('#edit_notes').val(note_notes);
            $("input[name=edit_notescolor][value=" + note_colorid + "]").prop('checked', true);
            $('#editnota').modal('show');
        }

        function loadDeleteModal(note_id, note_title) { //not complete yet
            $('#modal_delete_note .modal-title').text('Anda pasti untuk hapus nota berikut: ');
            $('#modal_delete_note .modal-body #maklumat_note').html('<p>Tajuk nota: ' +
                note_title + '</p>');
            $('#modal_delete_note #modal-confirm_delete').attr('onclick', 'confirmDelete(' + note_id + ')');
            $('#modal_delete_note').modal('show');
        }

        function confirmDelete(note_id) {
            console.log(note_id);
            $('#modal_delete_note .msg').text('');
            $('#modal_delete_note .msg').hide();

            // return;
            $.ajax({
                url: '/notes/' + note_id,
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    '_method': 'delete',
                },
                success: function(data) {
                    console.log(data);
                    $('#modal_delete_note .msg').text(data.success);

                    $("#modal_delete_note .msg").slideDown(300).delay(300).fadeOut(300, 'swing',
                        closeModal);


                },
                error: function(error) {
                    // Error logic goes here..!
                }
            });
        }

        function closeModal() {
            $('#modal_delete_note').delay(300).modal('hide');
            location.reload();
        }
    </script>
@endsection
