<?php

namespace App\Http\Controllers;

use App\Models\HouseAgreementLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HouseAgreementLinkController extends Controller
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

        $request->validate(
            [
                'url_name' => 'required',

            ],
            [
                'url_name.required' => 'Sila masukkan URL Borang',
            ]
        );

        $link_created = HouseAgreementLink::create(
            [
                'house_id' => $request['house_id'],
                'links' => $request['url_name'],
                'created_by' => Auth::user()->id,

            ]

        );

        if(!$link_created->id){
            $result = "Fail";
            $return_message = "Link gagal disimpan";
        }else{
            $result = "Success";
            $return_message = "Link berjaya disimpan";
        }


        return back()
            ->with('success', $return_message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HouseAgreementLink  $houseAgreementLink
     * @return \Illuminate\Http\Response
     */
    public function show(HouseAgreementLink $houseAgreementLink, $houseid)
    {
        $user = Auth::user();

        if ($user->hasAnyRole('Owner') && Check_User_house($houseid) == 0)
            return view('error.404');

        // return "test";

        $agreement_links = HouseAgreementLink::where('house_id',$houseid)->get();
        // dd($agreement_links);

        return view('houseagreement.links', compact('houseid','agreement_links'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HouseAgreementLink  $houseAgreementLink
     * @return \Illuminate\Http\Response
     */
    public function edit(HouseAgreementLink $houseAgreementLink)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HouseAgreementLink  $houseAgreementLink
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HouseAgreementLink $houseAgreementLink)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HouseAgreementLink  $houseAgreementLink
     * @return \Illuminate\Http\Response
     */
    public function destroy($link_id)
    {
        $link = HouseAgreementLink::find($link_id);

        $link->delete();


        return response()->json(
            [
                'success' => 'Maklumat berjaya dihapuskan'
            ]
        );
    }
}