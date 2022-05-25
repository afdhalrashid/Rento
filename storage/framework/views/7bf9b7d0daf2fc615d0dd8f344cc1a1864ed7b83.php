

<?php $__env->startSection('content'); ?>


    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <strong>Oops!</strong> Sila masukkan maklumat berikut: <br><br>
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>


        <?php if($message = Session::get('success')): ?>
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong><?php echo e($message); ?></strong>
            </div>
        <?php endif; ?>



        <div class="page-heading my-1">
            <?php echo $__env->make('layouts.nav_house', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="page-title">
                <div class="row">
                    <div class="col-lg-3 col-md-3 order-md-1 order-last">
                        <h4>Invois / Resit</h4>
                        <p class="text-subtitle text-muted">Jana invois dan resit rumah sewa </p>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 order-md-2 order-first">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahinvois"
                            onclick="$('#error').empty();">
                            Tambah Invois</button>
                        
                        <button type="button" class="btn btn-secondary" onclick="editLogo(<?php echo e($house->id); ?> );">
                            Logo Invois</button>
                    </div>

                    
                </div>
            </div>
            <input name="house_id" type="hidden" value="<?php echo e($house->id); ?>">
            <section class="section">
                <div class="row">
                    <div class="col-sm-3 col-md-3 col-lg-3">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Maklumat Rumah</h4>
                            </div>
                            <div class="card-body">
                                <?php echo $__env->make('layouts.houseprofile2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-9 col-md-9 col-lg-9">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Senarai Invois / Resit</h4>
                            </div>
                            <div class="card-body"  style="overflow-x: auto;">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama Invois</th>
                                            <th scope="col" style="width: 20%">No Invois</th>
                                            <th scope="col" style="width: 15%">Fail Invois</th>
                                            <th scope="col" style="width: 20%">No Resit</th>
                                            <th scope="col" style="width: 15%">Fail Resit</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $i = 0;
                                        ?>
                                        <?php $__currentLoopData = $house->invoice; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td class=""><?php echo e(++$i); ?></td>
                                                <td class=""><?php echo e($invoice->invoice_name); ?></td>
                                                            <td class="

                                                    ">
                                                    <?php echo e($invoice->invoice_number); ?></td>
                                                <td class="">
                                                    <?php if($invoice->invoice_save_path != ''): ?>
                                                        
                                                        

                                                        <a class="btn-sm btn-success" data-toggle="tooltip"
                                                        data-placement="top" title="Muat turun"
                                                            href="<?php echo e(route('downloadinvoice', $invoice->id)); ?>"><i
                                                            class="far fa-arrow-alt-circle-down"></i></a>
                                                        <a class="btn-sm btn-info" data-toggle="tooltip"
                                                        data-placement="top" title="Buka" href="<?php echo e(route('viewinvoice', $invoice->id)); ?>"
                                                            target="_blank"><i class="fas fa-external-link-alt"></i></a>
                                        <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($invoice->receipt != ''): ?>
                                                <?php echo e($invoice->receipt->receipt_number); ?>

                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($invoice->receipt != ''): ?>
                                                
                                                
                                                    <a class="btn-sm btn-success" data-toggle="tooltip"
                                                        data-placement="top" title="Muat turun"
                                                            href="<?php echo e(route('downloadreceipt',   $invoice->id)); ?>"><i
                                                            class="far fa-arrow-alt-circle-down"></i></a>
                                                        <a class="btn-sm btn-info" data-toggle="tooltip"
                                                        data-placement="top" title="Buka" href="<?php echo e(route('viewreceipt', $invoice->id)); ?>"
                                                            target="_blank"><i class="fas fa-external-link-alt"></i></a>
                                                <button type="button" class="btn-sm btn-light mx-1" data-toggle="tooltip"
                                                data-placement="top" title="Lampiran"
                                                    onclick="loadImageModal('<?php echo e($invoice->id); ?>','<?php echo e($invoice->payment_attachments->image_path); ?>')"><i
                                                        class="fa fa-paperclip" aria-hidden="true"></i>
                                                </button>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($invoice->receipt == ''): ?>
                                                <button type="button" class="btn-sm btn-info mx-1"
                                                    onclick="loadReceiptModal('<?php echo e($invoice->id); ?>','<?php echo e($invoice->invoice_number); ?>')">Resit
                                                </button>
                                            <?php endif; ?>
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="loadDeleteModal('<?php echo e($house->id); ?>','<?php echo e($invoice->id); ?>','<?php echo e($invoice->invoice_number); ?>')"><i class="far fa-trash-alt"></i>
                                            </button>
                                        </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </section>

        </div>
    </div>

    <form id="form_invoice" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('POST'); ?>
        <div class="modal" tabindex="-1" role="dialog" id="tambahinvois">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        

                        <h5 class="modal-title">

                            <p class="font-bold" style="font-size: 18px"><i class="fas fa-user-plus mx-2 pb-2"
                                    style="vertical-align: center;"></i>Tambah
                                invois
                            </p>
                            <div class="row ml-2" style="position: relative;">
                                <small>(* Maklumat wajib diisi)</small>

                            </div>

                            <div class="ml-3" id="error" style="font-size: 12px;"></div>
                        </h5>




                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-7 col-md-7 col-lg-7 px-0">
                                    <div class="form-group">
                                        <label for="helpInputTop">Nama invois (*) </label>
                                        <small class="text-muted"><i>Bayaran Sewa 2020</i></small>
                                        <input type="text" class="form-control shadow-sm" maxlength="100" id="invois_name"
                                            name="invois_name" value="<?php echo e(old('invois_name')); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-5 col-md-5 col-lg-5 px-0">
                                    <div class="form-group">
                                        <label for="helpInputTop">Pilih profil penyewa</label>
                                        <small class="text-muted">cth.<i> Ahmad Zakiuddin</i></small>
                                        <?php echo e(old('tenant_user_id')); ?>

                                        <select class="form-control form-select-sm shadow-sm"
                                            aria-label="Default select example" id="tenant_user_id" name="tenant_user_id">
                                            <option value="" selected>- Sila Pilih -</option>
                                            <?php $__currentLoopData = $users_createdby_owner; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                

                                                <?php if(Request::old('tenant_user_id') == $user->type_id): ?>
                                                    <option value="<?php echo e($user->id); ?>" selected><?php echo e($user->name); ?>

                                                        (<?php echo e($user->email); ?>)</option>
                                                <?php else: ?>
                                                    <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?>

                                                        (<?php echo e($user->email); ?>)</option>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>

                                        
                                    </div>


                                </div>

                                <div class="col-sm-6 col-md-6 col-lg-6 px-1">
                                    <div class="form-group">
                                        <label for="helpInputTop">Pilih akaun bank untuk rujukan penyewa</label>
                                        <small class="text-muted">cth.<i> Bank Islam</i></small>

                                        <select class="form-control form-select-sm shadow-sm"
                                            aria-label="Default select example" id="akaun_bank" name="akaun_bank">
                                            <option value="" selected>- Sila Pilih -</option>
                                            <?php $__currentLoopData = $house->bank_accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                

                                                <?php if(Request::old('akaun_bank') == $item->type_id): ?>
                                                    <option value="<?php echo e($item->id); ?>" selected>
                                                        <?php echo e($item->bank_name); ?>

                                                        / <?php echo e($item->account_no); ?> / <?php echo e($item->account_name); ?>

                                                    </option>
                                                <?php else: ?>
                                                    <option value="<?php echo e($item->id); ?>">
                                                        <?php echo e($item->bank_name); ?>

                                                        / <?php echo e($item->account_no); ?> / <?php echo e($item->account_name); ?>

                                                    </option>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>

                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 px-0">
                                    <div class="form-group">
                                        <label for="helpInputTop">Tarikh Invois</label>
                                        <small class="text-muted">cth.<i> 28/03/2020</i></small>
                                        <div class="datepicker date input-group p-0 shadow-sm">
                                            <input name="tarikh_invois" type="text" placeholder="Pilih tarikh"
                                                class="form-control py-1 px-3" id="tarikh_invois">
                                            <div class="input-group-append"><span class="input-group-text px-4"><i
                                                        class="fa fa-clock-o"></i></span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="helpInputTop">Tarikh Tamat Tempoh</label>
                                        <small class="text-muted">cth.<i> 28/03/2020</i></small>
                                        <div class="datepicker date input-group p-0 shadow-sm">
                                            <input name="tarikh_invois_tamat" type="text" placeholder="Pilih tarikh"
                                                class="form-control py-1 px-3" id="tarikh_invois_tamat">
                                            <div class="input-group-append"><span class="input-group-text px-4"><i
                                                        class="fa fa-clock-o"></i></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-6 px-0">
                                    <div class="form-group">
                                        <label for="helpInputTop">Item invois (*) </label>
                                        <small class="text-muted"><i>Bayaran Sewa Bulan Mac 2020</i></small>
                                        <input type="text" class="form-control shadow-sm alphaonly" maxlength="100"
                                            id="invois_item_name" name="invois_item_name[]"
                                            value="<?php echo e(old('invois_item_name.0')); ?>">
                                    </div>
                                </div>
                                <div class="col-sm-1 col-md-1 col-lg-1 px-1">
                                    <div class="form-group">
                                        <label for="helpInputTop">Unit (*) </label>
                                        
                                        <input type="text" class="form-control shadow-sm alphaonly" maxlength="100"
                                            id="invois_unit" name="invois_unit[]" value="<?php echo e(old('invois_unit.0')); ?>">
                                    </div>
                                </div>
                                <div class="col-sm-2 col-md-2 col-lg-2 px-1">
                                    <div class="form-group">
                                        <label for="helpInputTop">Harga/Unit (*) </label>
                                        
                                        <input type="text" class="form-control shadow-sm alphaonly" maxlength="100"
                                            id="invois_unit_price" name="invois_unit_price[]"
                                            value="<?php echo e(old('invois_unit_price.0')); ?>">
                                    </div>
                                </div>
                                <div class="col-sm-1 col-md-1 col-lg-1 px-1">
                                </div>
                                <div class="col-sm-1 col-md-1 col-lg-1 px-1">
                                    <div class="form-group">
                                        <label for="helpInputTop">&nbsp;</label>
                                        <button id="new_item" class="btn-sm btn-success form-control"><i
                                                class="fas fa-plus"></i></button>
                                    </div>
                                </div>


                                <input id="house_id" name="house_id" type="hidden" value="<?php echo e($house->id); ?>">


                            </div>

                            <div id="newUpload">

                            </div>


                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="button_generate_invoice" type="button" class="btn btn-primary">Hasilkan Invois</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="modal fade" id="modal_delete_doc" data-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                        style="position:absolute;float: left;left:0.6rem;color:rgba(4, 124, 40, 0.9)"></div>
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

    <form id="form_receipt" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('POST'); ?>
        <div class="modal fade" id="modal_create_receipt_modal" data-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Adakah anda pasti ingin keluarkan resit?</h5>

                    </div>
                    <div class="modal-body">
                        <div id="maklumat_owner"></div>
                        <input type="hidden" name="invoice_id" id="invoice_id">

                        <div class="row mx-3">

                            <div class="col-sm-12 col-md-12 col-lg-12 col px-0">
                                <div class="form-group">
                                    <label for="helpInputTop">Sertakan Resit Pembayaran Penyewa</label>
                                    <small class="text-muted"><i> </i></small>
                                    <div class="row custom-file">
                                        <input type="file" class="custom-file-input chooseFile"
                                            id="tenant_payment_attachment" name="tenant_payment_attachment"
                                            value="<?php echo e(old('tenant_payment_attachment')); ?>">
                                        <label class="custom-file-label" for="tenant_payment_attachment">Choose
                                            file</label>
                                    </div>
                                    <div class="row">
                                        <img src="" width="300px" height="250px" style="padding:1rem;display: none;" />
                                        <!--for preview purpose -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div id="message_receipt" class="msg"
                            style="position:absolute;float: left;left:0.6rem;color:rgba(4, 124, 40, 0.9)">
                        </div>
                        <div class="float-right">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>

                            <input type="hidden" id="invoice_id_for_receipt">
                            <button type="button" id="modal-confirm_resit" class="btn btn-success btn-sm" onclick="openx()">Keluarkan
                                resit</button>
                        </div>

                    </div>
                    <div class="modal-message" style="display: none;">

                    </div>
                </div>
            </div>
        </div>
    </form>

    <form id="form_invois_logo" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('POST'); ?>
        <div class="modal fade" id="logoinvois" data-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Logo invois/resit anda</h5>

                    </div>
                    <div class="modal-body">
                        <div id="maklumat_owner"></div>
                        <input type="hidden" name="house_id" id="house_id" value="<?php echo e($house->id); ?>">

                        <div class="row mx-3">

                            <div class="col-sm-12 col-md-12 col-lg-12 col px-0">
                                <div class="form-group">
                                    <label for="helpInputTop">Pilih logo invois anda</label>
                                    <small class="text-muted"><i> </i></small>
                                    <div class="row custom-file">
                                        <input type="file" class="custom-file-input chooseFile" id="logo_invois"
                                            name="logo_invois" value="<?php echo e(old('logo_invois')); ?>">
                                        <label class="custom-file-label" for="logo_invois">Choose file</label>
                                    </div>
                                    <div class="row">
                                        <img id="img_logo" src="" alt="none" width="300px" height="250px"
                                            style="padding:1rem;" />
                                        <!--for preview purpose -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div id="message_logo" class="msg"
                            style="position:absolute;float: left;left:0.6rem;color:rgba(4, 124, 40, 0.9)">
                        </div>
                        <div class="float-right">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>


                            <button type="button" id="button_confirm_logo" class="btn btn-success btn-sm"
                                onclick="addLogo();">Simpan</button>
                        </div>

                    </div>
                    <div class="modal-message_receipt" style="display: none;">

                    </div>
                </div>
            </div>
        </div>
    </form>

    
    <div id="modal_image" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <span id="btn_close2" class="close">&times;</span>
            <img class="modal-content" id="img01">
            <div id="caption"></div>
        </div>
    </div>
    

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        $(document).ready(function() {
            // $('#logoinvois').on('shown.bs.modal', function() {
            //     editLogo();
            // });

        });

        $('.datepicker').datepicker({
            clearBtn: true,
            format: "dd/mm/yyyy"
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

        $('#new_item').click(function(e) {
            e.preventDefault();

            $('#new_item').prop("disabled", true);

            console.log($('#newUpload').children().length);

            // var v = $('#newUpload').children().length;

            // if (v >= 4) {
            //     window.alert('Hanya 5 muatnaik sahaja dibenarkan');
            //     return;
            // }
            $.ajax({
                url: '/invois/addItemHTML',
                type: 'GET',
                success: function(data) {
                    // console.log(data);
                    // var content = $('<div>').append(data).find('#newUpload');
                    // $('#newUpload').html( content );

                    if (data == 'er') {
                        window.alert('Hanya 5 muatnaik sahaja dibenarkan');
                    } else {
                        var content = data;
                        console.log(data);

                        $('#newUpload').append(content);
                        $('#new_item').prop("disabled", false);
                    }





                }
            });
        });



        $('#button_generate_invoice').click(function(e) {
            e.preventDefault();
            $('#error').empty();
            $('#button_generate_invoice').prop('disabled', 'true');
            console.log('save invois')

            $house_id = $('#house_id').val();
            $.ajax({
                type: "get",
                url: "/invois/generate_invoice/",
                data: $('#form_invoice').serialize(),
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    var error_div = $('#error');
                    error_div.append(
                        '<div class="row msg" style="color: red;">' + response['fail'] +
                        '</div>');

                    $('#button_generate_invoice').prop('disabled', 'false');
                    $("#error .msg").slideDown(300).delay(300).fadeOut(2000, 'swing',
                        closeInvoiceModal);
                },
                error: function(err) {
                    if (err.status == 422) { // when status code is 422, it's a validation issue
                        console.log(err.responseJSON);
                        $('#success_message').fadeIn().html(err.responseJSON.message);

                        // you can loop through the errors object and show it to the user
                        console.warn(err.responseJSON.errors);
                        // display errors on each form field
                        $.each(err.responseJSON.errors, function(i, error) {
                            var error_div = $('#error');
                            error_div.append(
                                '<div class="row" style="color: red;">' + error[0] +
                                '</div>');

                            // var el = $(document).find('[name="' + i + '"]');
                            // el.after($('<span style="color: red;">' + error[0] + '</span>'));
                        });
                        $('#button_generate_invoice').prop('disabled', 'false');
                    }
                }
            });

        });

        function closeInvoiceModal() {
            $('#modal_delete_doc').delay(300).modal('hide');
            location.reload();
        }

        $('#tambahinvois').on('hidden.bs.modal', function() {
            location.reload();
        })

        $('#modal_create_receipt_modal').on('hidden.bs.modal', function() {
            location.reload();
        })

        setInputFilter(document.getElementById("item_price"), function(value) {
            return /^\d*$/.test(value);
        });

        $('[name="item_price"]').on('keyup', function() {
            limitText(this, 6)
        });

        function limitText(field, maxChar) {
            var ref = $(field),
                val = ref.val();
            if (val.length >= maxChar) {
                ref.val(function() {
                    console.log(val.substr(0, maxChar))
                    return val.substr(0, maxChar);
                });
            }
        }

        function loadDeleteModal(house_id, invoice_id, invoice_number) { //not complete yet
            $('#modal_delete_doc .modal-title').text('Anda pasti untuk hapus kos berikut: ');
            $('#modal_delete_doc .modal-body #maklumat_owner').html('<p>No Invois: ' + invoice_number);
            $('#modal_delete_doc #modal-confirm_delete').attr('onclick', 'confirmDelete(' + house_id + ',' + invoice_id +
                ')');
            $('#modal_delete_doc').modal('show');
        }

        function confirmDelete(houseid, invoice_id) {
            console.log(invoice_id);
            $('#modal_delete_doc .msg').text('');
            $('#modal_delete_doc .msg').hide();

            // return;
            $.ajax({
                url: '/houseinvoice/' + invoice_id,
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    '_method': 'delete',
                    'house_id': houseid,
                },
                success: function(data) {
                    console.log(data);
                    $('#modal_delete_doc .msg').text(data.success);

                    $("#modal_delete_doc .msg").slideDown(300).delay(300).fadeOut(300, 'swing', closeModal);


                },
                error: function(error) {
                    // Error logic goes here..!
                }
            });
        }

        function closeModal() {
            $('#modal_delete_doc').delay(300).modal('hide');
            location.reload();
        }

        function loadReceiptModal(invoice_id, invoice_number) {
            $('#modal_create_receipt_modal .modal-title').text('Anda pasti untuk keluarkan resit untuk invois berikut? ');
            $('#modal_create_receipt_modal .modal-body #maklumat_owner').html('<p>No Invois: ' + invoice_number);
            $('#invoice_id_for_receipt').val(invoice_id);
            // $('#modal_create_receipt_modal #modal-confirm_resit').attr('onclick', 'confirmCreateReceipt2(' + invoice_id +
            //     ')');
            $('#modal_create_receipt_modal').modal('show');
        }

        function openx(){
            var inv_id = $('#invoice_id_for_receipt').val();
            confirmCreateReceipt(inv_id);
        }

        function confirmCreateReceipt2(invoice_id) {

            console.log(invoice_id);
            $('#invoice_id').val(invoice_id);
            $('#modal_create_receipt_modal .msg').text('');
            $('#modal_create_receipt_modal .msg').hide();

            console.log($('#form_receipt').serialize());

            // return;
            $.ajax({
                url: '/invois/generate_receipt/',
                type: 'get',
                data: $('#form_receipt').serialize(),
                dataType: "json",
                enctype: 'multipart/form-data',
                success: function(data) {
                    console.log(data);
                    $('#modal_create_receipt_modal .msg').text(data.success);

                    // $("#modal_create_receipt_modal .msg").slideDown(300).delay(300).fadeOut(300, 'swing',
                    //     closeReceiptModal);


                },
                error: function(err) {
                    if (err.status == 422) { // when status code is 422, it's a validation issue
                        console.log(err.responseJSON);
                        // $('#message_receipt').fadeIn().html(err.responseJSON.message);

                        // you can loop through the errors object and show it to the user
                        console.warn(err.responseJSON.errors);
                        // display errors on each form field
                        $.each(err.responseJSON.errors, function(i, error) {
                            var error_div = $('#message_receipt');
                            error_div.append(
                                '<div class="row mx-2" style="color: red;">' + error[0] +
                                '</div>');
                            $('#message_receipt').fadeIn()

                            // var el = $(document).find('[name="' + i + '"]');
                            // el.after($('<span style="color: red;">' + error[0] + '</span>'));
                        });

                    }
                }
            });
        }

        function confirmCreateReceipt(invoice_id) {

            console.log(invoice_id);
            $('#invoice_id').val(invoice_id);
            $('#modal_create_receipt_modal .msg').text('');
            $('#modal_create_receipt_modal .msg').hide();

            var fd = new FormData();

            // //Form data
            // var form_data = $('#form_receipt').serializeArray();
            // $.each(form_data, function(key, input) {
            //     fd.append(input.name, input.value);
            // });

            // //File data
            // var file_data = $('input[name="tenant_payment_attachment"]')[0].files;
            // for (var i = 0; i < file_data.length; i++) {
            //     fd.append("tenant_payment_attachment[]", file_data[i]);
            // }

            // for (var pair of fd.entries()) {
            //     // console.log(pair[0] + ', ' + pair[1]);
            // }

            var form = $('#form_receipt')[0];
            var formData = new FormData(form);

            for (var pair of formData.entries()) {
                console.log(pair[0] + ', ' + pair[1]);
            }

            // console.log(formData);

            // return;
            $.ajax({
                url: '/invois/generate_receipt',
                type: 'post',
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                enctype: 'multipart/form-data',
                success: function(data) {
                    console.log(data);
                    // $('#modal_create_receipt_modal .msg').text(data.success);

                    $("#modal_create_receipt_modal .msg").slideDown(300).delay(300).fadeOut(300, 'swing',
                        closeReceiptModal);


                },
                error: function(err) {
                    if (err.status == 422) { // when status code is 422, it's a validation issue
                        console.log(err.responseJSON);
                        // $('#message_receipt').fadeIn().html(err.responseJSON.message);

                        // you can loop through the errors object and show it to the user
                        console.warn(err.responseJSON.errors);
                        // display errors on each form field
                        $.each(err.responseJSON.errors, function(i, error) {
                            var error_div = $('#message_receipt');
                            error_div.append(
                                '<div class="row mx-2" style="color: red;">' + error[0] +
                                '</div>');
                            $('#message_receipt').fadeIn()

                            // var el = $(document).find('[name="' + i + '"]');
                            // el.after($('<span style="color: red;">' + error[0] + '</span>'));
                        });

                    }
                }
            });
        }

        function confirmCreateReceipt_v1(invoice_id) {
            console.log(invoice_id);
            $('#modal_create_receipt_modal .msg').text('');
            $('#modal_create_receipt_modal .msg').hide();

            // return;
            $.ajax({
                url: '/invois/generate_receipt/',
                type: 'get',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    '_method': 'GET',
                    'invoice_id': invoice_id,
                },
                success: function(data) {
                    console.log(data);
                    $('#modal_create_receipt_modal .msg').text(data.success);

                    $("#modal_create_receipt_modal .msg").slideDown(300).delay(300).fadeOut(300, 'swing',
                        closeModal);


                },
                error: function(error) {
                    console.log(data);
                    $('#modal_create_receipt_modal .msg').text(data.success);
                }
            });
        }

        function closeReceiptModal() {
            $('#modal_create_receipt_modal').delay(300).modal('hide');
            location.reload();
        }

        function addLogo() {
            console.log('test');
            $('#logoinvois .msg').text('');
            $('#logoinvois .msg').hide();

            var form = $('#form_invois_logo')[0];
            var formData = new FormData(form);

            // var formData = new FormData();
            // var file_data = $('#logo_invois').prop('files')[0];
            // formData.append('logo_invois', file_data);

            for (var pair of formData.entries()) {
                console.log(pair[0] + ', ' + pair[1]);
            }

            // return;
            $.ajax({
                url: '/invois/add_logo',
                type: 'post',
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                enctype: 'multipart/form-data',
                success: function(data) {
                    console.log(data);
                    // $('#message_logo').text(data.success);

                    var error_div = $('#message_logo');
                    error_div.append(
                        '<div class="row mx-2" style="color: red;">' + data.success +
                        '</div>');
                    $('#message_logo').fadeIn()

                    // $("#modal_create_receipt_modal .msg").slideDown(300).delay(300).fadeOut(300, 'swing',
                    //     closeReceiptModal);


                },
                error: function(err) {
                    if (err.status == 422) { // when status code is 422, it's a validation issue
                        console.log(err.responseJSON);
                        // $('#message_receipt').fadeIn().html(err.responseJSON.message);

                        // you can loop through the errors object and show it to the user
                        console.warn(err.responseJSON.errors);
                        // display errors on each form field
                        $.each(err.responseJSON.errors, function(i, error) {
                            var error_div = $('#message_logo');
                            error_div.append(
                                '<div class="row mx-2" style="color: red;">' + error[0] +
                                '</div>');
                            $('#message_logo').fadeIn()

                            // var el = $(document).find('[name="' + i + '"]');
                            // el.after($('<span style="color: red;">' + error[0] + '</span>'));
                        });

                    }
                }
            });

        }


        function editLogo(house_id) {
            console.log('test');

            $.ajax({
                type: "GET",
                url: '/invois/get_logo', // This is what I have updated
                data: {
                    house_id: house_id,
                },
            }).done(function(data) {
                console.log(data);
                if (data != 'No') {
                    $('#img_logo').attr('src', data);
                }


                $('#logoinvois').modal('show');
            });
        }

        function loadImageModal(invoice_id, image_path) { //not complete yet
            // $('#modal_delete_doc .modal-title').text('Anda pasti untuk hapus kos berikut: ');
            // $('#modal_delete_doc .modal-body #maklumat_owner').html('<p>No Invois: ' + invoice_number);
            // $('#modal_delete_doc #modal-confirm_delete').attr('onclick', 'confirmDelete(' + house_id + ',' + invoice_id +
            //     ')');
            console.log(image_path);
            var modalImg = document.getElementById("img01");
            modalImg.src = "";
            modalImg.src = "/" + image_path;
            $('#modal_image').modal('show');
        }

        function deleteme(t) {

            console.log("hai");
            console.log(t.closest('.row').remove());



        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\Projects\LaravelProject\Rento\System\rento\resources\views/houseinvoice/list.blade.php ENDPATH**/ ?>