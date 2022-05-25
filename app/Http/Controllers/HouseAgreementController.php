<?php

namespace App\Http\Controllers;

use App\Models\HouseAgreement;
use App\Models\House;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HouseAgreementController extends Controller
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
    public function store_old(Request $request)
    {
        if (Check_User_house($request['house_id']) == 0)
            return view('error.404');
        // dd($request);

        $house = House::find($request['house_id']);

        $request->validate(
            [
                'file_agreement' => 'required|mimes:pdf| max:2048',

            ],
            [
                'file_agreement.required' => 'Tiada fail SPA dilampirkan',
                'file_agreement.mimes' => 'Fail pdf,word dan zip sahaja dibenarkan',
                'file_agreement.max' => 'Fail telah melebihi saiz dibenarkan',
            ]
        );

        $request->request->add(
            [
                'created_by' => Auth::user()->id,
            ]
        );

        // delete old agreement


        $fileModel = new HouseAgreement();

        if ($request->hasfile('file_agreement')) {
            $file = $request->file('file_agreement');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public');

            $fileModel->name = time() . '_' . $file->getClientOriginalName();
            $fileModel->file_path = '/' . $filePath;
            $fileModel->file_for = 'agreement stamping';
            $fileModel['house_id'] = $request['house_id'];
            $fileModel->save();
        }

        // return view('houseagreement.list', compact('house', 'nav_house'))
        //     ->with('success', 'Dokumen berjaya dimasukkan');

        return back()
            ->with('success', 'Dokumen berjaya dimasukkan');
    }

    public function store(Request $request)
    {
        if (Check_User_house($request['house_id']) == 0)
            return view('error.404');
        // dd($request);

        $house = House::find($request['house_id']);

        $nav_house = get_nav_menu($request['house_id'], 2);

        if ($request->radio_choose_agreementtype == 'option1') {
            $file_for = $request->new_agreement_type;
        }

        if ($request->radio_choose_agreementtype == 'option2') {
            $file_for = $request->list_agreement_type;
        }

        $request->validate(
            [
                'agreement_attachment' => 'required|mimes:pdf| max:2048',
            ],
            [
                'agreement_attachment.required' => 'Tiada fail dilampirkan',
                'agreement_attachment.mimes' => 'Fail pdf,word dan zip sahaja dibenarkan',
                'agreement_attachment.max' => 'Fail telah melebihi saiz dibenarkan',
            ]
        );



        // delete old agreement


        $fileModel = new HouseAgreement();

        $status = 0;

        if ($request->hasfile('agreement_attachment')) {
            $file = $request->file('agreement_attachment');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/houseagreement', $fileName, 'public');

            $fileModel->name = time() . '_' . $file->getClientOriginalName();
            $fileModel->file_path = '/' . $filePath;
            $fileModel->file_for = $file_for;
            $fileModel['house_id'] = $request['house_id'];
            $fileModel->save();
        } else {
            $status = 0;
        }

        if ($status == 0) {
            return back()
                ->with('success', 'Tiada dokumen dimasukkan');

            // return view('houseagreement.list', compact('house', 'nav_house'))
            // ->with('success', 'Tiada dokumen dimasukkan');
        }

        // return view('houseagreement.list', compact('house', 'nav_house'))
        //     ->with('success', 'Dokumen berjaya dimasukkan');

        return back()
            ->with('success', 'Dokumen berjaya dimasukkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HouseAgreement  $houseAgreement
     * @return \Illuminate\Http\Response
     */
    public function show($house_id)
    {
        $user = Auth::user();

        if ($user->hasAnyRole('Owner') && Check_User_house($house_id) == 0)
            return view('error.404');

        $disable = 'false';

        if ($user->hasAnyRole('Owner'))
            $nav_house = get_nav_menu($house_id, 2);
        else
            $nav_house = get_nav_menu($house_id, 1);

        // dd($nav_house);

        $house = House::find($house_id);
        $house->agreements = House::find($house->id)->agreements
            ->sortByDesc('created_at')->take(1);
        $house->agreements = House::find($house->id)->agreements
            ->sortByDesc('created_at');


        if ($user->hasAnyRole('Admin', 'Staf', 'Tenant')) {
            $disable = 'true';
        }

        // dd($house);

        return view('houseagreement.list', compact('house', 'nav_house', 'disable'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HouseAgreement  $houseAgreement
     * @return \Illuminate\Http\Response
     */
    public function edit(HouseAgreement $houseAgreement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HouseAgreement  $houseAgreement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HouseAgreement $houseAgreement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HouseAgreement  $houseAgreement
     * @return \Illuminate\Http\Response
     */
    public function destroy(HouseAgreement $houseAgreement, $agg_id)
    {
        if (Check_User_agg($agg_id) == 0)
            return view('error.404');

        $agg = HouseAgreement::find($agg_id);

        $agg->delete();


        return response()->json(
            [
                'success' => 'Maklumat berjaya dihapuskan'
            ]
        );
    }

    public function download($agreementid)
    {
        $agreement = HouseAgreement::find($agreementid);
        $file = public_path() . "/storage" . $agreement->file_path;
        $headers = array('Content-Type: application/pdf',);
        return response()->download($file, $agreement->name, $headers);
    }

    public function view($agreementid)
    {
        $agreement = HouseAgreement::find($agreementid);
        $file = public_path() . "/storage" . $agreement->file_path;
        return response()->file($file);
    }


}