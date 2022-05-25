<?php

namespace App\Http\Controllers;

use App\Models\House;
use  App\Models\Parameter as Parameter;
use App\Models\HouseCost;
use Illuminate\Http\Request;

class HouseCostController extends Controller
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
                'cost_type' => 'required',
                'cost_tahun' => 'required',
                'cost_bulan' => 'required',
                'tarikh_bayar_cost' => 'required',
                'cost_jumlah' => 'required',
                'cost_attachment' => '|mimes:jpeg,jpg,pdf|max:2048',
                'cost_remark' => '',
            ],
            [
                'cost_type.required' => 'Jenis kos perlu dipilih dari senarai',
                'cost_tahun.required' => 'Tahun kos perlu dipilih dari senarai',
                'cost_bulan.required' => 'Bulan kos perlu dipilih dari senarai',
                'tarikh_bayar_cost.required' => 'Sila pilih tarikh pembayaran kos',
                'cost_jumlah.required' => 'Sila masukkan jumlah pembayaran kos',
                'cost_attachment.required' =>
                'Fail gambar jpeg, jpg dan pdf sahaja dibenarkan',

            ]
        );

        // dd($request);

        // $date_bayar = (date("Y-m-d", strtotime($request['tarikh_bayar_cost'])));
        $date_bayar = $request['tarikh_bayar_cost'];
        $fileName = '';
        $real_file_path = '';

        // dd($date_bayar);

        if ($request->hasfile('cost_attachment')) {
            $file = $request->file('cost_attachment');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public');
            $real_file_path = 'storage/' . $filePath;
        }

        $housecost = HouseCost::create(
            [
                'house_id' => $request['house_id'],
                'cost_type' => $request['cost_type'],
                'year' => $request['cost_tahun'],
                'month' => $request['cost_bulan'],
                'value' => $request['cost_jumlah'],
                'image_name' => $fileName,
                'image_path' => $real_file_path,
                'remark' => $request['cost_remark'],
                'payment_date' => $date_bayar,
            ]

        );

        // dd($housetenant);

        return back()
            ->with('success', 'Maklumat kos berjaya dimasukkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HouseCost  $houseCost
     * @return \Illuminate\Http\Response
     */
    public function show($house_id)
    {
        if (Check_User_house($house_id) == 0)
            return view('error.404');

        $nav_house = get_nav_menu($house_id, 7);
        $house = House::find($house_id);
        $house->cost = House::find($house->id)->cost;

        // dd($house);
        // dd($house->utility[0]->utility_type);

        $global_housecost_types = Parameter::where(
            'parameter_name',
            'cost_type'
        )
            ->orderBy('type_id')
            ->get();
        // dd($global_houseutility_types);

        foreach ($global_housecost_types as $cost_type)
            foreach ($house->cost as $cost)
                if ($cost['cost_type'] == $cost_type->type_id)
                    $cost['cost_type'] = $cost_type->type_name;

        // dd($house);
        return view('housecost.list', compact('house', 'nav_house'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HouseCost  $houseCost
     * @return \Illuminate\Http\Response
     */
    public function edit(HouseCost $houseCost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HouseCost  $houseCost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HouseCost $houseCost)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HouseCost  $houseCost
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $cost_id)
    {
        if (Check_User_cost($cost_id) == 0)
            return view('error.404');

        $cost = HouseCost::find($cost_id);

        $cost->delete();


        return response()->json(
            [
                'success' => 'Maklumat berjaya dihapuskan'
            ]
        );
    }

    public function download($cost_id)
    {
        if (Check_User_cost($cost_id) == 0)
            return view('error.404');

        $cost = HouseCost::find($cost_id);
        // dd($cost);
        if (!$cost->exists()) {
            return view('error.404');
        }
        $file = public_path() . "/" . $cost->image_path;
        $headers = array('Content-Type: application/pdf',);
        return response()->download($file, $cost->name, $headers);
    }

    public function view($cost_id)
    {
        if (Check_User_cost($cost_id) == 0)
            return view('error.404');

        $cost = HouseCost::find($cost_id);


        if (!$cost->exists()) {
            return view('error.404');
        }
        $file = public_path() . "/" . $cost->image_path;
        return response()->file($file);
    }
}
