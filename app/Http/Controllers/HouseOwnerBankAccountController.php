<?php

namespace App\Http\Controllers;

use App\Models\HouseOwnerBankAccount;
use App\Models\House;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HouseOwnerBankAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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

        $request->validate(
            [
                'house_id' => 'required',
                'radio_choose_doctype' => 'required',
                'new_bank_name' => 'required_if:radio_choose_doctype,option1',
                'bank_name' => 'required_if:radio_choose_doctype,option2',
                'account_no' => 'required',
                'account_name' => 'required',

            ],
            [
                'house_id.required' => 'Terdapat masalah',
                'new_bank_name.required_if' => 'Sila masukkan nama bank',
                'bank_name.required_if' => 'Sila pilih bank',
                'account_no.required' => 'Sila masukkan nombor akaun bank',
                'account_name.required' => 'Sila masukkan penama',

            ]
        );

        if ($request->radio_choose_doctype == 'option1') {
            $bank_name = $request->new_bank_name;
        }

        if ($request->radio_choose_doctype == 'option2') {
            $bank_name = $request->bank_name;
        }


        $acc = HouseOwnerBankAccount::create(
            [
                'house_id' => $request['house_id'],
                'bank_name' => $bank_name,
                'account_no' => $request['account_no'],
                'account_name' => $request['account_name'],

            ]

        );


        return back()
            ->with('success', 'Akaun bank berjaya ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HouseOwnerBankAccount  $houseOwnerBankAccount
     * @return \Illuminate\Http\Response
     */
    public function show(HouseOwnerBankAccount $houseOwnerBankAccount,$houseid)
    {
        // return $houseid;
        $user = Auth::user();

        if ($user->hasAnyRole('Owner') && Check_User_house($houseid) == 0)
            return view('error.404');

        $house = House::with('bank_accounts')->find($houseid);
        // dd($house);

        return view('houseowner_bankaccount.index', compact('house'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HouseOwnerBankAccount  $houseOwnerBankAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(HouseOwnerBankAccount $houseOwnerBankAccount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HouseOwnerBankAccount  $houseOwnerBankAccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HouseOwnerBankAccount $houseOwnerBankAccount)
    {
        //xde
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HouseOwnerBankAccount  $houseOwnerBankAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy($account_id)
    {
        $acc = HouseOwnerBankAccount::find($account_id);

        $acc->delete();


        return response()->json(
            [
                'success' => 'Maklumat berjaya dihapuskan'
            ]
        );
    }
}