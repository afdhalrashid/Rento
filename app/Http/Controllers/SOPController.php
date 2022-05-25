<?php

namespace App\Http\Controllers;

use App\Models\SOP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use app\Models\User;

class SOPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $sops = SOP::get();
        // dd(User::select('name')->where('id', 3)->first()['name']);
        // dd($sops);

        return view('sop.index', compact('sops'));
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
        $user = Auth::user();

        if ($request->radio_choose_soptype == 'option1') {
            $file_for = $request->new_sop_type;
        }

        if ($request->radio_choose_soptype == 'option2') {
            $file_for = $request->list_sop_type;
        }

        $request->validate(
            [
                'sop_name' => 'required',
                'sop_attachment' => 'required|mimes:pdf| max:2048',
            ],
            [
                'sop_name.required' => 'Tiada nama SOP diberikan',
                'sop_attachment.required' => 'Tiada fail dilampirkan',
                'sop_attachment.mimes' => 'Fail pdf sahaja dibenarkan',
                'sop_attachment.max' => 'Fail telah melebihi saiz dibenarkan',
            ]
        );

        $fileModel = new SOP();

        $status = 0;

        if ($request->hasfile('sop_attachment')) {
            $file = $request->file('sop_attachment');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/sop', $fileName, 'public');

            $fileModel->file_name = time() . '_' . $file->getClientOriginalName();
            $fileModel->file_path = '/' . $filePath;
            $fileModel->file_for = $file_for;
            $fileModel['sop_name'] = $request['sop_name'];
            $fileModel['created_by'] = $user->id;
            $fileModel->save();
            $status = 1;
        } else {
            $status = 0;
        }

        if ($status == 0) {
            return back()
                ->with('success', 'Tiada dokumen dimasukkan');
            // return view('housedoc.list', compact('house', 'nav_house'))
            //     ->with('success', 'Tiada dokumen dimasukkan');
        }

        // return view('housedoc.list', compact('house', 'nav_house'))
        // ->with('success', 'Dokumen berjaya dimasukkan');
        return back()
            ->with('success', 'Dokumen berjaya dimasukkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SOP  $sOP
     * @return \Illuminate\Http\Response
     */
    public function show(SOP $sOP)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SOP  $sOP
     * @return \Illuminate\Http\Response
     */
    public function edit(SOP $sOP)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SOP  $sOP
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SOP $sOP)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SOP  $sOP
     * @return \Illuminate\Http\Response
     */
    public function destroy(SOP $sOP, $sopid)
    {
        $doc = SOP::find($sopid);

        $doc->delete();


        return response()->json(
            [
                'success' => 'Maklumat berjaya dihapuskan'
            ]
        );
    }

    public function download($sopid)
    {
        $user = Auth::user();

        try {

            $sop = SOP::where('id', $sopid)->first();
        } catch (\Illuminate\Database\QueryException  $e) {
            return view('error.404');
        }

        // if (count($sop) == 0) {
        //     return view('error.404');
        // }

        // $doc = HouseDoc::find($docid);
        $file = public_path() . "/storage" . $sop->file_path;
        $headers = array('Content-Type: application/pdf',);
        return response()->download($file, $sop->name, $headers);
    }

    public function view($sopid)
    {
        $user = Auth::user();

        try {

            $sop = SOP::where('id', $sopid)->first();
        } catch (\Illuminate\Database\QueryException  $e) {
            return view('error.404');
        }

        // if (count($sop) == 0) {
        //     return view('error.404');
        // }

        // $doc = HouseDoc::find($docid);
        $file = public_path() . "/storage" . $sop->file_path;

        return response()->file($file);
    }
}