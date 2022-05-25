<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\HouseUtility;
use  App\Models\Parameter as Parameter;
use Illuminate\Http\Request;

class HouseUtilityController extends Controller
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
        // dd($request);

        if (Check_User_house($request['house_id']) == 0)
            return view('error.404');

        $request->validate(
            [
                'bil_type' => 'required',
                'bil_tahun' => 'required',
                'bil_bulan' => 'required',
                'tarikh_bayar_bil' => 'required',
                'bil_jumlah' => 'required',
                'utility_attachment' => '|mimes:jpeg,jpg,pdf|max:2048',
                'bil_remark' => '',
            ],
            [
                'bil_type.required' => 'Jenis bil perlu dipilih dari senarai',
                'bil_tahun.required' => 'Tahun bil perlu dipilih dari senarai',
                'bil_bulan.required' => 'Bulan bil perlu dipilih dari senarai',
                'tarikh_bayar_bil.required' => 'Sila pilih tarikh pembayaran bil',
                'bil_jumlah.required' => 'Sila masukkan jumlah pembayaran bil',
                'utility_attachment.required' =>
                'Fail gambar jpeg, jpg dan pdf sahaja dibenarkan',

            ]
        );

        // dd($request);

        // $date_bayar = (date("Y-m-d", strtotime($request['tarikh_bayar_bil'])));
        $date_bayar = $request['tarikh_bayar_bil'];
        $fileName = '';
        $real_file_path = '';

        if ($request->hasfile('utility_attachment')) {
            $file = $request->file('utility_attachment');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public');
            $real_file_path = 'storage/' . $filePath;
        }

        $houseutility = HouseUtility::create(
            [
                'house_id' => $request['house_id'],
                'utility_type' => $request['bil_type'],
                'year' => $request['bil_tahun'],
                'month' => $request['bil_bulan'],
                'value' => $request['bil_jumlah'],
                'image_name' => $fileName,
                'image_path' => $real_file_path,
                'remark' => $request['bil_remark'],
                'payment_date' => $date_bayar,
            ]

        );

        // dd($housetenant);

        return back()
            ->with('success', 'Maklumat bil berjaya dimasukkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HouseUtility  $houseUtility
     * @return \Illuminate\Http\Response
     */
    public function show($house_id)
    {
        if (Check_User_house($house_id) == 0)
            return view('error.404');

        $nav_house = get_nav_menu($house_id, 5);
        $house = House::find($house_id);
        $house->utility = House::find($house->id)->utility;

        // dd($house);
        // dd($house->utility[0]->utility_type);

        $global_houseutility_types = Parameter::where(
            'parameter_name',
            'utility_type'
        )
            ->orderBy('type_id')
            ->get();
        // dd($global_houseutility_types);

        foreach ($global_houseutility_types as $utility_type)
            foreach ($house->utility as $utility)
                if ($utility['utility_type'] == $utility_type->type_id)
                    $utility['utility_type'] = $utility_type->type_name;

        // dd($house);
        return view('houseutility.list', compact('house', 'nav_house'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HouseUtility  $houseUtility
     * @return \Illuminate\Http\Response
     */
    public function edit(HouseUtility $houseUtility)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HouseUtility  $houseUtility
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HouseUtility $houseUtility)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HouseUtility  $houseUtility
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $utility_id)
    {
        if (Check_User_utility($utility_id) == 0)
            return view('error.404');

        $utility = HouseUtility::find($utility_id);

        $utility->delete();


        return response()->json(
            [
                'success' => 'Maklumat berjaya dihapuskan'
            ]
        );
    }

    public function download($utility_id)
    {
        if (Check_User_utility($utility_id) == 0)
            return view('error.404');

        $utility = HouseUtility::find($utility_id);
        // dd($utility);
        if (!$utility->exists()) {
            return view('error.404');
        }
        $file = public_path() . "/" . $utility->image_path;
        $headers = array('Content-Type: application/pdf',);
        return response()->download($file, $utility->name, $headers);
    }

    public function view($utility_id)
    {
        if (Check_User_utility($utility_id) == 0)
            return view('error.404');

        $utility = HouseUtility::find($utility_id);


        if (!$utility->exists()) {
            return view('error.404');
        }
        $file = public_path() . "/" . $utility->image_path;
        return response()->file($file);
    }
}
