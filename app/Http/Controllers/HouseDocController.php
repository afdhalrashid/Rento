<?php

namespace App\Http\Controllers;

use App\Models\HouseDoc;
use App\Models\House;
use App\Models\Parameter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class HouseDocController extends Controller
{

    function __construct()
    {

        $this->middleware('role:Owner', ['only' => ['create', 'store']]);
        $this->middleware('role:Admin|Owner', ['only' => ['show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "test";
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

        $nav_house = get_nav_menu($request['house_id'], 1);

        // $this->validate(
        //     $request,
        //     [
        //         'filename' => 'required|mimes:pdf|max:2048'
        //     ],
        //     [
        //         'filename.required' => 'Fail pdf sahaja dibenarkan',
        //         'filename.mimes' => 'Fail pdf sahaja dibenarkan',
        //     ]
        // );

        $request->validate(
            [
                'file_spa' => '|mimes:pdf| max:2048',
                'file_valuation' => '|mimes:pdf| max:2048',
                'file_loan' => '|mimes:pdf| max:2048',
            ],
            [
                'file_spa.required' => 'Tiada fail SPA dilampirkan',
                'file_spa.mimes' => 'Fail pdf,word dan zip sahaja dibenarkan',
                'file_spa.max' => 'Fail telah melebihi saiz dibenarkan',
                'file_valuation.required' => 'Tiada fail Valuation dilampirkan',
                'file_valuation.mimes' => 'Fail pdf,word dan zip sahaja dibenarkan',
                'file_valuation.max' => 'Fail telah melebihi saiz dibenarkan',
                'file_loan.required' => 'Tiada fail Loan dilampirkan',
                'file_loan.mimes' => 'Fail pdf,word dan zip sahaja dibenarkan',
                'file_loan.max' => 'Fail telah melebihi saiz dibenarkan',
            ]
        );

        $request->request->add(
            [
                'created_by' => Auth::user()->id,
            ]
        );

        $fileModel = new HouseDoc();

        $status = 0;

        if ($request->hasfile('file_spa')) {
            $file = $request->file('file_spa');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public');

            $fileModel->name = time() . '_' . $file->getClientOriginalName();
            $fileModel->file_path = '/' . $filePath;
            $fileModel->file_for = 'dokumen SPA';
            $fileModel['house_id'] = $request['house_id'];
            $fileModel->save();
            $status = 1;
        } else {
            $status = 0;
        }

        $fileModel = new HouseDoc();

        if ($request->hasfile('file_valuation')) {
            $file = $request->file('file_valuation');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public');

            $fileModel->name = time() . '_' . $file->getClientOriginalName();
            $fileModel->file_path = '/' . $filePath;
            $fileModel->file_for = 'dokumen Valuation';
            $fileModel['house_id'] = $request['house_id'];
            $fileModel->save();
            $status = 1;
        } else {
            $status = 0;
        }

        $fileModel = new HouseDoc();

        if ($request->hasfile('file_loan')) {
            $file = $request->file('file_loan');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public');

            $fileModel->name = time() . '_' . $file->getClientOriginalName();
            $fileModel->file_path = '/' . $filePath;
            $fileModel->file_for = 'dokumen Loan';
            $fileModel['house_id'] = $request['house_id'];
            $fileModel->save();
            $status = 1;
        } else {
            $status = 0;
        }

        if ($status == 0) {
            return view('housedoc.list', compact('house', 'nav_house'))
                ->with('success', 'Tiada dokumen dimasukkan');
        }

        return view('housedoc.list', compact('house', 'nav_house'))
            ->with('success', 'Dokumen berjaya dimasukkan');
    }

    public function store(Request $request)
    {
        if (Check_User_house($request['house_id']) == 0)
            return view('error.404');
        // dd($request);

        $house = House::find($request['house_id']);

        $nav_house = get_nav_menu($request['house_id'], 1);

        // $this->validate(
        //     $request,
        //     [
        //         'filename' => 'required|mimes:pdf|max:2048'
        //     ],
        //     [
        //         'filename.required' => 'Fail pdf sahaja dibenarkan',
        //         'filename.mimes' => 'Fail pdf sahaja dibenarkan',
        //     ]
        // );

        if ($request->radio_choose_doctype == 'option1') {
            $file_for = $request->new_doc_type;
        }

        if ($request->radio_choose_doctype == 'option2') {
            $file_for = $request->list_doc_type;
        }

        // dd($file_for);

        $request->validate(
            [
                'doc_attachment' => 'required|mimes:pdf| max:2048',
            ],
            [
                'doc_attachment.required' => 'Tiada fail dilampirkan',
                'doc_attachment.mimes' => 'Fail pdf sahaja dibenarkan',
                'doc_attachment.max' => 'Fail telah melebihi saiz dibenarkan',
            ]
        );

        $fileModel = new HouseDoc();

        $status = 0;

        if ($request->hasfile('doc_attachment')) {
            $file = $request->file('doc_attachment');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/housedoc', $fileName, 'public');

            $fileModel->name = time() . '_' . $file->getClientOriginalName();
            $fileModel->file_path = '/' . $filePath;
            $fileModel->file_for = $file_for;
            $fileModel['house_id'] = $request['house_id'];
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
     * @param  \App\Models\HouseDoc  $houseDoc
     * @return \Illuminate\Http\Response
     */
    public function show($house_id)
    {
        if(!Auth::user()->hasRole('Admin')){
            if (Check_User_house($house_id) == 0 )
            return view('error.404');
        }

        $nav_house = get_nav_menu($house_id, 1);
        $house = House::find($house_id);
        $house->docs = House::find($house->id)->docs;

        // dd($house->file[0]['file_path']);
        // dd($house);

        $states = Parameter::where('parameter_name', 'state')
            ->orderBy('type_id')
            ->get();

        foreach ($states as $state)
            if ($house->negeri == $state->type_id)
                $house->negeri = $state->type_name;

        return view('housedoc.list', compact('house', 'nav_house'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HouseDoc  $houseDoc
     * @return \Illuminate\Http\Response
     */
    public function edit(HouseDoc $houseDoc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HouseDoc  $houseDoc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HouseDoc $houseDoc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HouseDoc  $houseDoc
     * @return \Illuminate\Http\Response
     */
    public function destroy(HouseDoc $houseDoc, $docid)
    {
        if (Check_User_doc($docid) == 0)
            return view('error.404');

        $doc = HouseDoc::find($docid);

        $doc->delete();


        return response()->json(
            [
                'success' => 'Maklumat berjaya dihapuskan'
            ]
        );
    }

    public function download($docid)
    {
        $user = Auth::user();

        try {

            // $doc = House::with('docs')->where('created_by', $user->id)
            //     ->whereHas(
            //         'docs',
            //         function ($q) use ($docid) {
            //             $q->where('id', '=', $docid);
            //         }
            //     )->get();

            // $doc = House::with(
            //     [
            //         "docs"
            //         => function ($q) use ($docid, $user) {
            //             $q->where('docs.id', '=', $docid);
            //         }
            //     ]
            // )->where('created_by', $user->id)->get();

            // $doc = House::with('docs')
            //     ->where(
            //         [
            //             'house_docs.id', '=', $docid,
            //             'houses.created_by', '=', $user->id
            //         ]
            //     )->get();

            // $doc = House::with(
            //     [
            //         'docs' => function ($query) use ($docid) {
            //             $query->where('id', $docid);
            //         },
            //     ]
            // )->where('created_by', $user->id)->first();

            // $doc = House::with('docs')->whereHas(
            //     "docs",
            //     function ($q) use ($docid) {
            //         $q->where('id', $docid);
            //     }
            // )->where('created_by', $user->id)->first();

            $filter = function ($q) use ($docid) {
                $q->where('id', $docid);
            };

            $doc = House::with(['docs' => $filter])
            ->whereHas('docs', $filter)
            ->where('created_by', $user->id)->first();


            // dd($doc);
            // dd($doc->docs[0]->file_path);

            // $doc = HouseDoc::with('House')
            //     ->where('houses.user_id', $user->id)->find($docid);

            // $doc = HouseDoc::with('House')
            //     ->where(
            //         [
            //             'house_docs.id', '=', $docid,
            //             'houses.user_id', '=', $user->id
            //         ]
            //     );

            // dd($doc);
        } catch (\Illuminate\Database\QueryException  $e) {
            return view('error.404');
        }

        if (count($doc->docs) == 0) {
            return view('error.404');
        }

        // $doc = HouseDoc::find($docid);
        $file = public_path() . "/storage" . $doc->docs[0]->file_path;
        $headers = array('Content-Type: application/pdf',);
        return response()->download($file, $doc->name, $headers);
    }

    public function view($docid)
    {
        $user = Auth::user();

        try {
            // $doc = House::with(
            //     [
            //         'docs' => function ($query) use ($docid) {
            //             $query->where('id', $docid);
            //         },
            //     ]
            // )->where('created_by', $user->id)->first();
            // $doc = House::with('docs')->whereHas(
            //     'docs',
            //     function (Builder $q) use ($docid) {
            //         $q->where('id', $docid);
            //     }
            // )->where('created_by', $user->id)->get();

            $filter = function ($q) use ($docid) {
                $q->where('id', $docid);
            };

            $doc = House::with(['docs' => $filter])
            ->whereHas('docs', $filter)
            ->where('created_by', $user->id)->first();


            // dd($doc[0]->docs);
        } catch (\Illuminate\Database\QueryException  $e) {
            return view('error.404');
        }

        if (count($doc->docs) == 0) {
            return view('error.404');
        }

        // $doc = HouseDoc::find($docid);
        $file = public_path() . "/storage" . $doc->docs[0]->file_path;
        return response()->file($file);
    }
}