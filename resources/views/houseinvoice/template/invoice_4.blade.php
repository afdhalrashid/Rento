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
                                        <img alt="" src="data:image/png;base64,{{ $data['invoice_image'] }}"
                                            style="height: 120px;width: 100px;margin-right:10px">
                                    </td>
                                    <td style="width: 100%;">
                                        <div class="subtitle"><b>{{ $data['nama_owner'] }}</b></div>
                                        {{-- <div class="small">{{ $data['ic_owner'] }}</div> --}}
                                        <div class="small">
                                            {!! $data['address_owner'] !!}<br>
                                            <br>
                                            Tel: {{ $data['phone_owner'] }}<br>
                                            Email: {{ $data['email_owner'] }}
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td width="5%"></td>
                    <td width="35%" style="text-align: right">
                        <div class="formrow small" style=""><b>
                            @if ($data['type'] == 'Invoice') INVOICE @else RECEIPT
                                @endif
                            </b></div>
                        <div class="formrow small" style="text-weight:bold"><b>
                            @if ($data['type'] == 'Invoice') INV#: @else REC#:
                                @endif
                                {{ $data['invoice_number'] }}
                            </b>
                        </div>
                        <div class="formrow small">Date: {{ $data['invoice_date'] }}</div>
                        <div class="formrow small">Expired: {{ $data['invoice_due_date'] }}</div>

                        <div class="formrow">Status: @if ($data['type'] == 'Invoice')
                            UNPAID @else PAID @endif
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
                            {{ $data['nama_tenant'] }}<br>
                            {{-- {{ $data['ic_tenant'] }}<br> --}}
                            {!! $data['address_tenant'] !!} <br>
                            Tel: {{ $data['phone_tenant'] }} <br />
                            Email: {{ $data['email_tenant'] }}
                        </div>
                    </td>
                    <td width="10%"></td>
                    {{-- <td width="45%" valign="top"><b>Deliver To: </b><br>-<br> 860, Jalan Samudra Selatan 1
                    Taman Samudra, 60182237679 <br><br><b>Shipping Method:</b> Poslaju <br></td> --}}
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
                @php
                    $i = 1;
                    $oldsub = 0;
                @endphp
                @foreach ($data['item_name'] as $key => $name)
                    <tr class="gridBorder">
                        <td valign="top" align="left">{{ $i++ }}</td>
                        <td valign="top" align="left"></td>
                        <td valign="top" align="left" width="70%">{{ $name }}</td>
                        <td valign="top" align="center">{{ $data['item_unit'][$key] }}</td>
                        <td valign="top" align="right">{{ $data['item_price'][$key] }}</td>
                        <td valign="top" align="right">
                            {{ $sub = $data['item_unit'][$key] * $data['item_price'][$key] }}
                        </td>
                    </tr>
                    @php
                        $oldsub = $oldsub + $sub;
                    @endphp
                @endforeach

                {{-- <tr class="gridBorder">
                    <td valign="top" align="left">1</td>
                    <td valign="top" align="left"></td>
                    <td valign="top" align="left" width="70%">Rumah sewa Banglo A (Januari) </td>
                    <td valign="top" align="center">1</td>
                    <td valign="top" align="right">1,200.00</td>
                    <td valign="top" align="right">1,200.00</td>
                </tr>

                <tr class="gridBorder">
                    <td valign="top" align="left">2</td>
                    <td valign="top" align="left"></td>
                    <td valign="top" align="left" width="70%">yhtfy <font class="small">(0001)</font>
                    </td>
                    <td valign="top" align="center">1</td>
                    <td valign="top" align="right">0.00</td>
                    <td valign="top" align="right">0.00</td>
                </tr>

                <tr class="gridBorder">
                    <td valign="top" align="left">3</td>
                    <td valign="top" align="left"></td>
                    <td valign="top" align="left" width="70%">Ayuman2 </td>
                    <td valign="top" align="center">1</td>
                    <td valign="top" align="right">550.00</td>
                    <td valign="top" align="right">550.00</td>
                </tr>

                <tr class="gridBorder">
                    <td valign="top" align="left">4</td>
                    <td valign="top" align="left"></td>
                    <td valign="top" align="left" width="70%">Ayuman2 </td>
                    <td valign="top" align="center">1</td>
                    <td valign="top" align="right">550.00</td>
                    <td valign="top" align="right">550.00</td>
                </tr> --}}

                <tr class="gridBorder2">
                    <td colspan="3"></td>
                    <td align="center">{{ array_sum($data['item_unit']) }}</td>
                    <td valign="top" align="right">Subtotal: </td>
                    <td valign="top" align="right">{{ $oldsub }}</td>
                </tr>

                <tr class="gridBorder2">
                    <td valign="top" align="right" colspan="5"><b>Total (MYR)</b>: </td>
                    <td valign="top" align="right"><b>{{ $oldsub }}</b></td>
                </tr>
                <tr class="gridBorder2">
                    <td valign="top" align="right" colspan="5">Payment: </td>
                    @if ($data['type'] == 'Receipt')
                        @php $data['payment'] = $oldsub @endphp
                    @endif
                    <td valign="top" align="right">{{ $data['payment'] }}</td>
                </tr>

                <tr class="gridBorder2">
                    <td valign="top" align="right" colspan="5">Balance: </td>
                    <td valign="top" align="right">{{ $oldsub - $data['payment'] }}</td>
                </tr>
            </tbody>
        </table>
        <br>
        @if ($data['type'] == 'Invoice')
        <br><br><br>Please do make payment to the account details as follows :<br>
        <br>
        <br>
        {{ $data['bank_account']['bank_name'] }} : {{ $data['bank_account']['account_no'] }} <br>
        Acc : {{ $data['bank_account']['account_name'] }}
        <br><br>
        <div style="font-style: italic;font-family:Monospace;font-size:10px">This is computer generated invoice, no signature required</div>
        {{-- <br>
        Maybank : 562209649154 <br>
        Acc : Hartaplus Capital Sdn. Bhd.
        <br><br> --}}
        @else
        <br><br><br>Thank you for your payment!<br>
        <br>
        <br>
        <div style="font-style: italic;font-family:Monospace;font-size:10px">This is computer generated receipt, no signature required</div>

        @endif

    </div>
</body>

</html>
