<html lang="en">

<head>
    <title>Your Sales Invoice # S2100092</title>
    <meta name="description" content="From Hartaplus Capital Sdn Bhd">
    <link rel='stylesheet' type='text/css' href='https://a3.niagawan.com/style.css?1623549291'>
    <style>
        html,
        body {
            height: 0%;
        }

        body,
        td {
            font-family: Arial;
            font-size: 12px;
            margin: 10px
        }

        .main {}

        .gridBorder td {
            border-bottom: 1px solid #000000;
            border-left: 0px solid #000000;
            font-size: 12px;
            padding: 5px;
        }

        .gridBorder2 td {
            border-bottom: 0px solid #000000;
            border-left: 0px solid #000000;
            font-size: 12px;
            padding: 5px;
        }

        .tableBorder {
            border-right: 1px solid #000000;
            border-left: 1px solid #000000;
            border-top: 1px solid #000000;
            border-bottom: 1px solid #000000;
        }

    </style>
</head>

<body>


    <div style="margin-left: 1%;
    margin-right: 5%;
    padding: 1%;
    width: 90%;
    border: 0px solid #000000;
    page-break-inside: avoid;
">


        <table border="0" width="100%">
            <tbody>
                <tr>
                    <td width="60%" valign="top">
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                        <img alt="" src="data:image/png;base64,<?php echo e($data['invoice_image']); ?>"
                                            style="height: 120px;width: 100px;margin-right:10px">
                                    </td>
                                    <td style="width: 100%;">
                                        <div class="subtitle"><b><?php echo e($data['nama_owner']); ?></b></div>
                                        
                                        <div class="small">
                                            <?php echo $data['address_owner']; ?><br>
                                            <br>
                                            Tel: <?php echo e($data['phone_owner']); ?><br>
                                            Email: <?php echo e($data['email_owner']); ?>

                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td width="5%"></td>
                    <td width="35%" style="text-align: right">
                        <div class="formrow small" style=""><b>
                            <?php if($data['type'] == 'Invoice'): ?> INVOICE <?php else: ?> RECEIPT
                                <?php endif; ?>
                            </b></div>
                        <div class="formrow small" style="text-weight:bold"><b>
                            <?php if($data['type'] == 'Invoice'): ?> INV#: <?php else: ?> REC#:
                                <?php endif; ?>
                                <?php echo e($data['invoice_number']); ?>

                            </b>
                        </div>
                        <div class="formrow small">Date: <?php echo e($data['invoice_date']); ?></div>
                        <div class="formrow small">Expired: <?php echo e($data['invoice_due_date']); ?></div>

                        <div class="formrow">Status: <?php if($data['type'] == 'Invoice'): ?>
                            UNPAID <?php else: ?> PAID <?php endif; ?>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <hr size="1">
        <br>

        <table width="100%" border="0">
            <tbody>
                <tr>
                    <td width="45%" valign="top"><b>Customer: </b><br>
                        <div class="small">
                            <?php echo e($data['nama_tenant']); ?><br>
                            
                            <?php echo $data['address_tenant']; ?> <br>
                            Tel: <?php echo e($data['phone_tenant']); ?> <br />
                            Email: <?php echo e($data['email_tenant']); ?>

                        </div>
                    </td>
                    <td width="10%"></td>
                    
                </tr>
            </tbody>
        </table>

        <br><br>


        <table width="100%" cellspacing="0" cellpadding="3" class="tableBorder">
            <tbody>
                <tr class="gridBorder">
                    <td width="5%"><b>No</b></td>
                    <td width="50%" colspan="2"><b>Description</b></td>
                    <td width="12%" align="center"><b>Unit</b></td>
                    <td width="12%" align="right"><b>Harga</b></td>
                    <td width="12%" align="right"><b>Jumlah</b></td>
                </tr>
                <?php
                    $i = 1;
                    $oldsub = 0;
                ?>
                <?php $__currentLoopData = $data['item_name']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="gridBorder">
                        <td valign="top" align="left"><?php echo e($i++); ?></td>
                        <td valign="top" align="left"></td>
                        <td valign="top" align="left" width="70%"><?php echo e($name); ?></td>
                        <td valign="top" align="center"><?php echo e($data['item_unit'][$key]); ?></td>
                        <td valign="top" align="right"><?php echo e($data['item_price'][$key]); ?></td>
                        <td valign="top" align="right">
                            <?php echo e($sub = $data['item_unit'][$key] * $data['item_price'][$key]); ?>

                        </td>
                    </tr>
                    <?php
                        $oldsub = $oldsub + $sub;
                    ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                

                <tr class="gridBorder2">
                    <td colspan="3"></td>
                    <td align="center"><?php echo e(array_sum($data['item_unit'])); ?></td>
                    <td valign="top" align="right">Subtotal: </td>
                    <td valign="top" align="right"><?php echo e($oldsub); ?></td>
                </tr>

                <tr class="gridBorder2">
                    <td valign="top" align="right" colspan="5"><b>Total (MYR)</b>: </td>
                    <td valign="top" align="right"><b><?php echo e($oldsub); ?></b></td>
                </tr>
                <tr class="gridBorder2">
                    <td valign="top" align="right" colspan="5">Payment: </td>
                    <?php if($data['type'] == 'Receipt'): ?>
                        <?php $data['payment'] = $oldsub ?>
                    <?php endif; ?>
                    <td valign="top" align="right"><?php echo e($data['payment']); ?></td>
                </tr>

                <tr class="gridBorder2">
                    <td valign="top" align="right" colspan="5">Balance: </td>
                    <td valign="top" align="right"><?php echo e($oldsub - $data['payment']); ?></td>
                </tr>
            </tbody>
        </table>
        <br>
        <?php if($data['type'] == 'Invoice'): ?>
        <br><br><br>Please do make payment to the account details as follows :<br>
        <br>
        <br>
        <?php echo e($data['bank_account']['bank_name']); ?> : <?php echo e($data['bank_account']['account_no']); ?> <br>
        Acc : <?php echo e($data['bank_account']['account_name']); ?>

        <br><br>
        <div style="font-style: italic;font-family:Monospace;font-size:10px">This is computer generated invoice, no signature required</div>
        
        <?php else: ?>
        <br><br><br>Thank you for your payment!<br>
        <br>
        <br>
        <div style="font-style: italic;font-family:Monospace;font-size:10px">This is computer generated receipt, no signature required</div>

        <?php endif; ?>

    </div>
</body>

</html>
<?php /**PATH F:\Projects\LaravelProject\Rento\System\rento\resources\views/houseinvoice/template/invoice_4.blade.php ENDPATH**/ ?>