<?php

namespace App\Http\Controllers;

use App\Models\House;
use  App\Models\Parameter as Parameter;
use App\Models\HouseTax;
use Illuminate\Http\Request;

class HouseTaxController extends Controller
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
        if (Check_User_house($request['house_id']) == 0)
            return view('error.404');

        $request->validate(
            [
                'tax_type' => 'required',
                'tax_tahun' => 'required',
                'tax_bulan' => 'required',
                'tarikh_bayar_tax' => 'required',
                'tax_jumlah' => 'required',
                'tax_attachment' => '|mimes:jpeg,jpg,pdf|max:2048',
                'tax_remark' => '',
            ],
            [
                'tax_type.required' => 'Jenis cukai perlu dipilih dari senarai',
                'tax_tahun.required' => 'Tahun cukai perlu dipilih dari senarai',
                'tax_bulan.required' => 'Bulan cukai perlu dipilih dari senarai',
                'tarikh_bayar_tax.required' => 'Sila pilih tarikh pembayaran cukai',
                'tax_jumlah.required' => 'Sila masukkan jumlah pembayaran cukai',
                'tax_attachment.required' =>
                'Fail gambar jpeg, jpg dan pdf sahaja dibenarkan',

            ]
        );

        // dd($request);

        // $date_bayar = (date("Y-m-d", strtotime($request['tarikh_bayar_tax'])));
        $date_bayar = $request['tarikh_bayar_tax'];
        $fileName = '';
        $real_file_path = '';

        if ($request->hasfile('tax_attachment')) {
            $file = $request->file('tax_attachment');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public');
            $real_file_path = 'storage/' . $filePath;
        }

        $housetax = HouseTax::create(
            [
                'house_id' => $request['house_id'],
                'tax_type' => $request['tax_type'],
                'year' => $request['tax_tahun'],
                'month' => $request['tax_bulan'],
                'value' => $request['tax_jumlah'],
                'image_name' => $fileName,
                'image_path' => $real_file_path,
                'remark' => $request['tax_remark'],
                'payment_date' => $date_bayar,
            ]

        );

        // dd($housetenant);

        return back()
            ->with('success', 'Maklumat cukai berjaya dimasukkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HouseTax  $houseTax
     * @return \Illuminate\Http\Response
     */
    public function show($house_id)
    {
        if (Check_User_house($house_id) == 0)
            return view('error.404');

        $nav_house = get_nav_menu($house_id, 6);
        $house = House::find($house_id);
        $house->tax = House::find($house->id)->tax;

        // dd($house);
        // dd($house->tax[0]->tax_type);

        $global_housetax_types = Parameter::where(
            'parameter_name',
            'tax_type'
        )
            ->orderBy('type_id')
            ->get();
        // dd($global_housetax_types);

        foreach ($global_housetax_types as $tax_type)
            foreach ($house->tax as $tax)
                if ($tax['tax_type'] == $tax_type->type_id)
                    $tax['tax_type'] = $tax_type->type_name;

        // dd($house);
        return view('housetax.list', compact('house', 'nav_house'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HouseTax  $houseTax
     * @return \Illuminate\Http\Response
     */
    public function edit(HouseTax $houseTax)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HouseTax  $houseTax
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HouseTax $houseTax)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HouseTax  $houseTax
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $tax_id)
    {
        if (Check_User_tax($tax_id) == 0)
            return view('error.404');

        $tax = HouseTax::find($tax_id);

        $tax->delete();


        return response()->json(
            [
                'success' => 'Maklumat berjaya dihapuskan'
            ]
        );
    }

    public function download($tax_id)
    {
        if (Check_User_tax($tax_id) == 0)
            return view('error.404');

        $tax = HouseTax::find($tax_id);
        // dd($tax);
        if (!$tax->exists()) {
            return view('error.404');
        }
        $file = public_path() . "/" . $tax->image_path;
        $headers = array('Content-Type: application/pdf',);
        return response()->download($file, $tax->name, $headers);
    }

    public function view($tax_id)
    {
        if (Check_User_tax($tax_id) == 0)
            return view('error.404');

        $tax = HouseTax::find($tax_id);


        if (!$tax->exists()) {
            return view('error.404');
        }
        $file = public_path() . "/" . $tax->image_path;
        return response()->file($file);
    }
}
