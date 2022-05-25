<?php

namespace App\Http\Controllers;

use App\Models\HouseUtilityInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HouseUtilityInfoController extends Controller
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
        // return $request->all();
        $user = Auth::user();
        if (Check_User_house($request['house_id']) == 0)
            return view('error.404');

        $request->validate(
            [
                'utility_name' => 'required',
                'account_no' => 'required',
                'user_account_id' => 'required',
                'user_account_password' => 'required',
                'biller_code' => 'required',
                'last_payment_date' => 'required',
            ],
            [
                'utility_name.required' => 'Sila pilih jenis utiliti',
                'account_no.required' => 'Sila masukkan nombor akaun',
                'user_account_id.required' => 'Sila masukkan user id',
                'user_account_password.required' => 'Sila masukkan password',
                'biller_code.required' => 'Sila masukkan biller code',
                'last_payment_date.required' => 'Sila pilih tarikh bayaran terakhir',

            ]
        );

        // dd($request);

        // Add parameter into request
        $request->request->add(['created_by' => $user->id]);
        $houseUtilityInfo = HouseUtilityInfo::create($request->all());

        if ($houseUtilityInfo->exists) {
            return back()
            ->with('success', 'Maklumat utiliti berjaya dimasukkan');
         } else {
            return back()
            ->with('success', 'Maklumat utiliti gagal dimasukkan');
         }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HouseUtilityInfo  $houseUtilityInfo
     * @return \Illuminate\Http\Response
     */
    public function show(HouseUtilityInfo $houseUtilityInfo, $houseid)
    {
        $user = Auth::user();

        if ($user->hasAnyRole('Owner') && Check_User_house($houseid) == 0)
            return view('error.404');

        // return "test";

        $utility_info = HouseUtilityInfo::where('house_id',$houseid)->get();
        // dd($agreement_links);

        return view('houseutility.info', compact('houseid','utility_info'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HouseUtilityInfo  $houseUtilityInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(HouseUtilityInfo $houseUtilityInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HouseUtilityInfo  $houseUtilityInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        // dd($id);
        // dd($request->all());

        $user = Auth::user();

        if (Check_User_house($request['house_id']) == 0)
            return view('error.404');

        $request->validate(
            [
                'utility_name' => 'required',
                'account_no' => 'required',
                'user_account_id' => 'required',
                'user_account_password' => 'required',
                'biller_code' => 'required',
                'last_payment_date' => 'required',
            ],
            [
                'utility_name.required' => 'Sila pilih jenis utiliti',
                'account_no.required' => 'Sila masukkan nombor akaun',
                'user_account_id.required' => 'Sila masukkan user id',
                'user_account_password.required' => 'Sila masukkan password',
                'biller_code.required' => 'Sila masukkan biller code',
                'last_payment_date.required' => 'Sila pilih tarikh bayaran terakhir',

            ]
        );

        $request->request->add(['created_by' => $user->id]);

        $houseUtilityInfo = HouseUtilityInfo::find($id);
        $result = $houseUtilityInfo->update($request->all());

        if ($result > 0) {
            return back()
            ->with('success', 'Maklumat utiliti berjaya dikemaskini');
         } else {
            return back()
            ->with('success', 'Maklumat utiliti gagal dikemaskini');
         }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HouseUtilityInfo  $houseUtilityInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        // $houseUtilityInfo = HouseUtilityInfo::find($id);
        $houseUtilityInfo = HouseUtilityInfo::where(
            [
                ['id', '=',  $id],
                ['created_by', '=', $user->id],
            ]
        );

        $houseUtilityInfo->delete();


        return response()->json(
            [
                'success' => 'Maklumat berjaya dihapuskan'
            ]
        );
    }
}
