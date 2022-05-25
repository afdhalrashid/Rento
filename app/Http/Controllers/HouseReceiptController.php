<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\HouseReceipt;
use App\Models\HouseInvoice;
use App\Models\HouseTenant;
use App\Models\InvoiceTenantPaymentAttachment;
use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HouseReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HouseReceipt  $houseReceipt
     * @return \Illuminate\Http\Response
     */
    public function show($house_id)
    {
        //
        if (Check_User_house($house_id) == 0)
            return view('error.404');

        $nav_house = get_nav_menu($house_id, 9);
        $house = House::find($house_id);
        // $house->cost = House::find($house->id)->cost;

        return view('housereceipt.list', compact('house', 'nav_house'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HouseReceipt  $houseReceipt
     * @return \Illuminate\Http\Response
     */
    public function edit(HouseReceipt $houseReceipt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HouseReceipt  $houseReceipt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HouseReceipt $houseReceipt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HouseReceipt  $houseReceipt
     * @return \Illuminate\Http\Response
     */
    public function destroy(HouseReceipt $houseReceipt)
    {
        //
    }

    public function generate_receipt_2()
    {
        // $pdf = App::make('dompdf.wrapper');
        // $pdf->loadHTML('<h1>Test</h1>');
        // return $pdf->stream();
        // dd($data['nama_owner']);

        $record = HouseReceipt::latest()->first();

        if ($record == null)
            $expNum = array('INV', '0');
        else
            $expNum = explode('-', $record->receipt_number);

        // dd($expNum);

        $receipt_date = date('Ymd');
        $receipt_due_date = date('Ymd', strtotime($receipt_date . ' + 15 days'));

        $nextreceiptNumber = 'REC' . $receipt_date . '-' .
            sprintf("%06d", $expNum[1] + 1);

        // dd($nextreceiptNumber);

        $path = public_path('storage/uploads/receipt/');


        $data = array(

            'nama_owner' => $_GET['nama_owner'],
            'ic_owner' => $_GET['ic_owner'],
            'email_owner' => $_GET['email_owner'],
            'phone_owner' => $_GET['phone_owner'],
            'nama_tenant' => $_GET['nama_tenant'],
            'ic_tenant' => $_GET['ic_tenant'],
            'email_tenant' => $_GET['email_tenant'],
            'phone_tenant' => $_GET['phone_tenant'],
            'item_type' => $_GET['item_type'],
            'item_price' => $_GET['item_price'],
            'receipt_number' => $nextreceiptNumber,
            'receipt_date' => $receipt_date,
            'receipt_due_date' => $receipt_due_date,

        );


        // dd($data);

        $receipt_save_path = $path . $nextreceiptNumber . '.pdf';

        // return view('housereceipt.template.receipt_2', compact('data'));

        $housereceipt = HouseReceipt::create(
            [
                'house_id' => $_GET['house_id'],
                'receipt_number' => $nextreceiptNumber,
                'receipt_name' => $_GET['receipt_name'],
                'receipt_save_path' => $receipt_save_path,
                'receipt_date' => $receipt_date,
                'receipt_due_date' => $receipt_due_date,
            ]

        );

        $pdf = PDF::loadView('housereceipt.template.receipt_2', compact('data'))
            ->save($path . $nextreceiptNumber . '.pdf');
        return $pdf->download('receipt.pdf');
    }

    public function generate_receipt_3(Request $request)
    {
        $invoice = HouseInvoice::find($_GET['invoice_id']);

        // dd($invoice);

        $receipt_number = str_replace("INV",'REC',$invoice->invoice_number);

        $db_path = 'storage/uploads/receipt/';
        $path = public_path($db_path );

        $house = House::find($invoice->house_id);
        $house->tenant = House::find($house->id)->tenant->first();

        foreach ($invoice['invoice_items'] as $key => $value) {
            $item_name[] = $value['item_name'];
            $item_unit[] = $value['item_count'];
            $item_price[] = $value['item_price'];
        }

        // dd($item_name);

        $invoice_due_date = Carbon::createFromFormat('Y-m-d', $invoice->invoice_due_date)->format('M d Y');
        $invoice_date = Carbon::createFromFormat('Y-m-d', $invoice->invoice_date)->format('M d Y');

        $data = array(
            'type'=>'Receipt',
            'nama_owner' => $house->namaowner,
            'ic_owner' => $house->icowner,
            'email_owner' => $house->email_owner,
            'phone_owner' =>$house->phoneno_owner,
            'address_owner' => $house->address1 . ', '.$house->address2. ', '.$house->poskod.', '.$house->daerah.', '.$house->parameter_state->type_name,
            'nama_tenant' => $house->tenant->tenant_name,
            'ic_tenant' => $house->tenant->tenant_ic,
            'address_tenant' => $house->tenant->tenant_as_in_ic_address1 . ', '.$house->tenant->tenant_as_in_ic_address2. ', '.$house->tenant->tenant_as_in_ic_poskod.', '.
            $house->tenant->tenant_as_in_ic_daerah.', '.$house->tenant->parameter_state->type_name,
            'email_tenant' => $house->tenant->tenant_email,
            'phone_tenant' => $house->tenant->tenant_phone_no,
            'item_name' => $item_name,
            'item_unit' => $item_unit,
            'item_price' => $item_price,
            'invoice_number' => $receipt_number,
            'invoice_date' => $invoice_date,
            'invoice_due_date' => $invoice_due_date,
            'bank_account' => $invoice->bank_account,
            'payment'=> 0,

        );

        $receipt_save_path = $db_path . $receipt_number . '.pdf';

        // $houseinvoice = HouseInvoice::create(
        //     [
        //         'house_id' => $house->id,
        //         'invoice_number' => $nextInvoiceNumber,
        //         'invoice_name' => '',
        //         'invoice_save_path' => $invoice_save_path,
        //         'invoice_date' => $invoice_db_date,
        //         'invoice_due_date' => $invoice_due_db_date,

        //     ]
        // );
        $rec = new HouseReceipt();
        $rec->house_id =  $house->id;
        $rec->invoice_id =  $invoice->id;
        $rec->receipt_number= $receipt_number;
        $rec->receipt_name= $invoice->invoice_name;
        $rec->receipt_save_path= $receipt_save_path;

        $rec->save();

        // return view('houseinvoice.template.invoice_3', compact('data'));

        $pdf = PDF::loadView('houseinvoice.template.invoice_4', compact('data'))->save($path . $receipt_number . '.pdf');
        return $pdf->download('receipt.pdf');
    }

    public function generate_receipt_4(Request $request)
    {
        // dd($request->tenant_payment_attachment);
        // dd($request->exists('tenant_payment_attachment'));
        // dd("test");
        // dd($request->all());
        $request->validate(
            [
                'tenant_payment_attachment' => 'required|mimes:jpeg,jpg,pdf|max:2048',
            ],
            [
                'tenant_payment_attachment.required' => 'Sila muatnaik lampiran bukti pembayaran.',
                'tenant_payment_attachment.mimes' => 'Jenis fail hanya jpeg,jpg,pdf',
                'tenant_payment_attachment.max' => 'Saiz yang dibenarkan adalah kurang 2MB',

            ]
        );


        $invoice = HouseInvoice::find($request->invoice_id);

        // dd($invoice);

        $receipt_number = str_replace("INV",'REC',$invoice->invoice_number);

        $db_path = 'storage/uploads/receipt/';
        $path = public_path($db_path );

        $house = House::find($invoice->house_id);
        // $house->tenant = House::find($house->id)->tenant->first();
        $house->tenant = HouseTenant::find($invoice->tenant_id);

        // dd($house->tenant);

        foreach ($invoice['invoice_items'] as $key => $value) {
            $item_name[] = $value['item_name'];
            $item_unit[] = $value['item_count'];
            $item_price[] = $value['item_price'];
        }

        // dd($item_name);

        // $invoice_due_date = Carbon::createFromFormat('Y-m-d', $invoice->invoice_due_date)->format('M d Y');
        // $invoice_date = Carbon::createFromFormat('Y-m-d', $invoice->invoice_date)->format('M d Y');
        // $invoice_due_date = Carbon::createFromFormat('Y-m-d', $invoice->invoice_due_date)->format('d/m/Y');
        // $invoice_date = Carbon::createFromFormat('Y-m-d', $invoice->invoice_date)->format('d/m/Y');

        $invoice_date = date_format(date_create($invoice->invoice_date),"d/m/Y");
        $invoice_due_date = date_format(date_create($invoice->invoice_due_date),"d/m/Y");

        // return $invoice_date;

        $image = base64_encode(file_get_contents(public_path($house->invoiceImage[0]->image_path)));

        $data = array(
            'type'=>'Receipt',
            'nama_owner' => $house->namaowner,
            'ic_owner' => $house->icowner,
            'email_owner' => $house->email_owner,
            'phone_owner' =>$house->phoneno_owner,
            'address_owner' => $house->address1 . ', '.$house->address2. ', '.$house->poskod.', '.$house->daerah.', '.$house->parameter_state->type_name,
            'nama_tenant' => $house->tenant->tenant_name,
            'ic_tenant' => $house->tenant->tenant_ic,
            'address_tenant' => $house->tenant->tenant_as_in_ic_address1 . ', '.$house->tenant->tenant_as_in_ic_address2. ', '.$house->tenant->tenant_as_in_ic_poskod.', '.
            $house->tenant->tenant_as_in_ic_daerah.', '.$house->tenant->parameter_state->type_name,
            'email_tenant' => $house->tenant->tenant_email,
            'phone_tenant' => $house->tenant->tenant_phone_no,
            'item_name' => $item_name,
            'item_unit' => $item_unit,
            'item_price' => $item_price,
            'invoice_image' => $image,
            'invoice_number' => $receipt_number,
            'invoice_date' => $invoice_date,
            'invoice_due_date' => $invoice_due_date,
            'bank_account' => $invoice->bank_account,
            'payment'=> 0,

        );

        $receipt_save_path = $db_path . $receipt_number . '.pdf';

        // $houseinvoice = HouseInvoice::create(
        //     [
        //         'house_id' => $house->id,
        //         'invoice_number' => $nextInvoiceNumber,
        //         'invoice_name' => '',
        //         'invoice_save_path' => $invoice_save_path,
        //         'invoice_date' => $invoice_db_date,
        //         'invoice_due_date' => $invoice_due_db_date,

        //     ]
        // );
        $rec = new HouseReceipt();
        $rec->house_id =  $house->id;
        $rec->invoice_id =  $invoice->id;
        $rec->receipt_number= $receipt_number;
        $rec->receipt_name= $invoice->invoice_name;
        $rec->receipt_save_path= $receipt_save_path;

        $rec->save();

        // dd($invoice->id);

        if ($request->exists('tenant_payment_attachment')) {
            $file = $request->tenant_payment_attachment;
            // foreach ($files as $key => $file) {
            //     $fileModel = new InvoiceTenantPaymentAttachment();
            //     $fileModel->image_index = $key;
            //     $fileName = time() . '_' . $file->getClientOriginalName();
            //     $filePath = $file->storeAs('uploads', $fileName, 'public');
            //     $real_file_path = 'storage/' . $filePath;

            //     $fileModel->image_name = time() . '_' .
            //         $file->getClientOriginalName();

            //     $fileModel->image_path = $real_file_path;
            //     $fileModel['invoice_id'] = $invoice->id;
            //     $fileModel->image_for = "Bukti pembayaran penyewa";
            //     $fileModel->save();
            // }

            $findPaymentAttachment = InvoiceTenantPaymentAttachment::find($invoice->id);

            // dd($findPaymentAttachment);
            if(!empty($findPaymentAttachment)){
                // dd("here");
                $findPaymentAttachment->delete();
            }
            // dd("here");

            $fileModel = new InvoiceTenantPaymentAttachment();
            $fileModel->image_index = 0;
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/invoice_payment', $fileName, 'public');
            $real_file_path = 'storage/' . $filePath;

            $fileModel->image_name = time() . '_' .
                $file->getClientOriginalName();

            $fileModel->image_path = $real_file_path;
            $fileModel['invoice_id'] = $invoice->id;
            $fileModel->image_for = "Bukti pembayaran penyewa";
            $fileModel->save();


        }

        // return view('houseinvoice.template.invoice_3', compact('data'));

        $pdf = PDF::loadView('houseinvoice.template.invoice_4', compact('data'))->save($path . $receipt_number . '.pdf');
        // sleep(5);
        return response()->json(['success' => 'Resit telah disiapkan. Sila muat turun.']);
        // return $pdf->download('receipt.pdf');
    }

    public function download($invoice_id)
    {
        $user = Auth::user();

        try {

            // $house = House::with('invoice')->whereHas(
            //     "invoice",
            //     function ($q) use ($invoice_id) {
            //         $q->where('id', $invoice_id);
            //     }
            // )->where('created_by', $user->id)->first();

            // $house = House::with(array('invoice' => function($query) use ($invoice_id) {
            //     $query->where('id', '=', $invoice_id)->first();
            // }))->where('created_by', $user->id)->first();

            $filter = function ($q) use ($invoice_id) {
                $q->where('id', $invoice_id);
            };

            $house = House::with(['invoice' => $filter])
            ->whereHas('invoice', $filter)
            ->where('created_by', $user->id)->first();



            // dd($house);
        } catch (\Illuminate\Database\QueryException  $e) {
            return view('error.404');
        }

        if (count($house->invoice) == 0) {
            return view('error.404');
        }

        // $doc = HouseDoc::find($docid);
        $file = public_path() . "/" . $house->invoice[0]->receipt->receipt_save_path;
        $headers = array('Content-Type: application/pdf',);
        return response()->download($file, $house->invoice[0]->receipt->receipt_number.'.pdf', $headers);
    }

    public function view($invoice_id)
    {
        $user = Auth::user();

        try {

            // $house = House::with('invoice')->whereHas(
            //     "invoice",
            //     function ($q) use ($invoice_id) {
            //         $q->where('id', $invoice_id);
            //     }
            // )->where('created_by', $user->id)->first();

            // $house = House::with(array('invoice' => function($query) use ($invoice_id) {
            //     $query->where('id', '=', $invoice_id)->first();
            // }))->where('created_by', $user->id)->first();

            $filter = function ($q) use ($invoice_id) {
                $q->where('id', $invoice_id);
            };

            $house = House::with(['invoice' => $filter])
            ->whereHas('invoice', $filter)
            ->where('created_by', $user->id)->first();


            // dd($house);
        } catch (\Illuminate\Database\QueryException  $e) {
            return view('error.404');
        }

        if (count($house->invoice) == 0) {
            return view('error.404');
        }

        // $doc = HouseDoc::find($docid);
        $file = public_path() . "/" . $house->invoice[0]->receipt->receipt_save_path;

        return response()->file($file);
    }
}