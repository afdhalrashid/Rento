<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\HouseInvoice;
use App\Models\HouseOwnerBankAccount;
use App\Models\HouseTenant;
use App\Models\User;
use App\Models\InvoiceItem;
use App\Models\InvoiceTenantPaymentAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
// invoice class
// use LaravelDaily\Invoices\Classes\Buyer;
// use LaravelDaily\Invoices\Classes\InvoiceItem;
// use LaravelDaily\Invoices\Invoice;
use PDF;

class HouseInvoiceController extends Controller
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
     * @param  \App\Models\HouseInvoice  $houseInvoice
     * @return \Illuminate\Http\Response
     */
    public function show($house_id)
    {
        if (Check_User_house($house_id) == 0) {
            return view('error.404');
        }

        $user = Auth::user();
        $nav_house = get_nav_menu($house_id, 8);
        $house = House::with('tenant','invoice','bank_accounts')->find($house_id);

        // dd($house);

        // All user for an owner
        $users_createdby_owner = User::where('created_by', $user->id)->where('status', 1)->orderBy('created_at', 'desc')->get();



        // All tenant tagged with the house
        $users_createdby_owner = User::join('house_tenants as ht','ht.tenant_user_id','users.id')->where('ht.house_id','=',$house_id)
        ->get();

        // dd($users_createdby_owner);

        // dd($house);
        // dd($house->invoice[37]->payment_attachments);
        // $house->cost = House::find($house->id)->cost;

        return view('houseinvoice.list', compact('house', 'nav_house', 'users_createdby_owner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HouseInvoice  $houseInvoice
     * @return \Illuminate\Http\Response
     */
    public function edit(HouseInvoice $houseInvoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HouseInvoice  $houseInvoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HouseInvoice $houseInvoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HouseInvoice  $houseInvoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(HouseInvoice $houseInvoice, $invoice_id)
    {
        if (Check_User_invoice($invoice_id) == 0)
            return view('error.404');

        $invoice = HouseInvoice::find($invoice_id);
        $invoice_items = InvoiceItem::where('invoice_id',$invoice_id);

        $invoice->delete();
        $invoice_items->delete();


        return response()->json(
            [
                'success' => 'Maklumat berjaya dihapuskan'
            ]
        );
    }

    public function generate_invoice()
    {

        // dd($_GET);

        $customer = new Buyer([
            'name' => 'John Doe',
            'custom_fields' => [
                'email' => 'test@example.com',
            ],
        ]);

        $item = (new InvoiceItem())->title('Service 1')->pricePerUnit(2);

        $invoice = Invoice::make()
            ->buyer($customer)
            ->discountByPercent(10)
            ->taxRate(15)
            ->shipping(1.99)
            ->addItem($item);

        $invoice->seller->name = $_GET['namaowner'];
        // $invoice->seller['address'] = $invoice->seller['icowner'];
        $invoice->seller->ic = $_GET['icowner'];

        // dd($invoice);

        return $invoice->stream();
    }

    public function generate_invoice_2()
    {
        // $pdf = App::make('dompdf.wrapper');
        // $pdf->loadHTML('<h1>Test</h1>');
        // return $pdf->stream();

        // dd($data['nama_owner']);

        $record = HouseInvoice::latest()->first();

        if ($record == null) {
            $expNum = array('INV', '0');
        } else {
            $expNum = explode('-', $record->invoice_number);
        }

        $invoice_date = date('Ymd');
        $invoice_due_date = date('Ymd', strtotime($invoice_date . ' + 15 days'));

        $nextInvoiceNumber = 'INV' . $invoice_date . '-' .
        sprintf("%06d", $expNum[1] + 1);

        $path = public_path('storage/uploads/invoice/');

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
            'invoice_number' => $nextInvoiceNumber,
            'invoice_date' => $invoice_date,
            'invoice_due_date' => $invoice_due_date,

        );

        $invoice_save_path = $path . $nextInvoiceNumber . '.pdf';

        $houseinvoice = HouseInvoice::create(
            [
                'house_id' => $_GET['house_id'],
                'invoice_number' => $nextInvoiceNumber,
                'invoice_name' => $_GET['invoice_name'],
                'invoice_save_path' => $invoice_save_path,
                'invoice_date' => $invoice_date,
                'invoice_due_date' => $invoice_due_date,

            ]
        );

        $pdf = PDF::loadView('houseinvoice.template.invoice_2', compact('data'))
            ->save($path . $nextInvoiceNumber . '.pdf');
        return $pdf->download('invoice.pdf');
    }

    public function generate_invoice_3(Request $request)
    {
        // return $request;
        // return view('houseinvoice.template.invoice_3');

        // $pdf = App::make('dompdf.wrapper');
        // $pdf->loadHTML('<h1>Test</h1>');
        // return $pdf->stream();

        // dd($data['nama_owner']);

        $request->validate(
            [
                'invois_name' => 'required',
                'invois_item_name.*' => 'required',
                'invois_unit.*' => 'required',
                'invois_unit_price.*' => 'required',
            ],
            [
                'invois_name.required' => 'Nama invois perlu diisi',
                'invois_item_name.required' => 'Nama item perlu diisi',
                'invois_unit.required' => 'Unit item perlu diisi',
                'invois_unit_price.required' => 'Harga per unit item perlu diisi',


            ]
        );

        $record = HouseInvoice::latest()->first();

        if ($record == null) {
            $expNum = array('INV', '0');
        } else {
            $expNum = explode('-', $record->invoice_number);
        }

        $invois_name = $_GET['invois_name'];
        $invoice_no_date = date('Ymdhis');
        // $invoice_due_date = date('Ymd', strtotime($invoice_date . ' + 15 days'));

        // Invoice date and expired
        // $invoice_date = date('M d Y');
        // $invoice_due_date = date('M d Y', strtotime($invoice_date . ' + 15 days'));
        $invoice_date = $_GET['tarikh_invois'];
        $invoice_due_date = $_GET['tarikh_invois_tamat'];

        $invoice_db_date = Carbon::createFromFormat('d/m/Y', $invoice_date)->format('Y-m-d');
        $invoice_due_db_date = Carbon::createFromFormat('d/m/Y', $invoice_due_date)->format('Y-m-d');

        // dd($invoice_db_date);

        // $invoice_db_date = date('Y-m-d');
        // $invoice_due_db_date = date('Y-m-d', strtotime($invoice_db_date . ' + 15 days'));

        $nextInvoiceNumber = 'INV' . $invoice_no_date . '-' .
        sprintf("%06d", $expNum[1] + 1);

        $db_path = 'storage/uploads/invoice/';
        $path = public_path($db_path );


        $house = House::find($_GET['house_id']);
        // dd($house);
        // $house->tenant = House::find($house->id)->tenant->first();
        $house->tenant = HouseTenant::find($_GET['tenant_user_id']);

        $account = HouseOwnerBankAccount::find($_GET['akaun_bank']);
        $image = base64_encode(file_get_contents(public_path($house->invoiceImage[0]->image_path)));

        // dd($image);

        if ($house->tenant == null) {
            return response()->json(['fail' => 'Tiada penyewa. Sila masukkan penyewa di dalam menu penyewa.']);
        }

        // dd($house);
        // dd($house->tenant->tenant_name);

        $data = array(
            'type'=>'Invoice',
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
            'item_name' => $_GET['invois_item_name'],
            'item_unit' => $_GET['invois_unit'],
            'item_price' => $_GET['invois_unit_price'],
            // 'invoice_image' => '/'. $house->invoiceImage[0]->image_path,
            'invoice_image' => $image,
            'invoice_number' => $nextInvoiceNumber,
            'invoice_date' => $invoice_date,
            'invoice_due_date' => $invoice_due_date,
            'bank_account' => $account,
            'payment'=> 0,

        );

        $invoice_save_path = $db_path . $nextInvoiceNumber . '.pdf';

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
        $HouseInvoice = new HouseInvoice();
        $HouseInvoice->house_id =  $house->id;
        $HouseInvoice->tenant_id =  $_GET['tenant_user_id'];
        $HouseInvoice->invoice_number= $nextInvoiceNumber;
        $HouseInvoice->invoice_name= $invois_name;
        $HouseInvoice->invoice_save_path= $invoice_save_path;
        $HouseInvoice->invoice_date= $invoice_db_date;
        $HouseInvoice->invoice_due_date= $invoice_due_db_date;
        $HouseInvoice->bank_account_id= $account->id;
        $HouseInvoice->save();

        $fileName = '';
        $real_file_path = '';

        foreach ($_GET['invois_item_name'] as $key => $item) {
            $itemModel = new InvoiceItem();
            $itemModel->invoice_id = $HouseInvoice->id;
            $itemModel->item_name = $item;
            $itemModel->item_count = $_GET['invois_unit'][$key];
            $itemModel->item_price = $_GET['invois_unit_price'][$key];

            $itemModel->save();
        }

        // return view('houseinvoice.template.invoice_4', compact('data'));

        $pdf = PDF::loadView('houseinvoice.template.invoice_4', compact('data'))->save($path . $nextInvoiceNumber . '.pdf');
        return response()->json(['fail' => 'Invoice telah disiapkan. Sila muat turun.']);
        // return $pdf->download('invoice.pdf');
    }

    public function getHTML(Request $request)
    {
        // return "test";
        try {
            return view('houseinvoice.addItem')->render();
        } catch (\Throwable $exception) {
            return "<h2>{{ $exception->getMessage() }}</h2>";
        }
    }

    public function download($invoice_id)
    {
        $user = Auth::user();

        try {

            $filter = function ($q) use ($invoice_id) {
                $q->where('id', $invoice_id);
            };

            $house = House::with(['invoice' => $filter])
            ->whereHas('invoice', $filter)
            ->where('created_by', $user->id)->first();

            // $house = House::with('invoice')->whereHas(
            //     "invoices",
            //     function ($q) use ($invoice_id) {
            //         $q->where('id', $invoice_id);
            //     }
            // )->where('created_by', $user->id)->get();


            // dd($doc);
        } catch (\Illuminate\Database\QueryException  $e) {
            return view('error.404');
        }

        if (count($house->invoice) == 0) {
            return view('error.404');
        }

        // $doc = HouseDoc::find($docid);
        $file = public_path() . "/" . $house->invoice[0]->invoice_save_path;
        $headers = array('Content-Type: application/pdf',);
        return response()->download($file, $house->invoice[0]->invoice_number.'.pdf', $headers);
    }

    public function view($invoice_id)
    {
        $user = Auth::user();

        try {

            $creditFilter = function ($q) use ($invoice_id) {
                $q->where('id', $invoice_id);
            };

            $house = House::with(['invoice' => $creditFilter])
            ->whereHas('invoice', $creditFilter)
            ->where('created_by', $user->id)->first();

            // $house = House::with('invoice')->whereHas(
            //     'invoice',
            //     function (Builder $q) use ($invoice_id) {
            //         $q->where('id', $invoice_id);
            //     }
            // )->where('created_by', $user->id)->get();


            // dd($house);
        } catch (\Illuminate\Database\QueryException  $e) {
            return view('error.404');
        }

        if (count($house->invoice) == 0) {
            return view('error.404');
        }

        // $doc = HouseDoc::find($docid);
        $file = public_path() . "/" . $house->invoice[0]->invoice_save_path;

        return response()->file($file);
    }
}