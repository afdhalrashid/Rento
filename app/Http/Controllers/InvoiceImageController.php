<?php

namespace App\Http\Controllers;

use App\Models\InvoiceImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceImageController extends Controller
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function save_logo(Request $request)
    {

        // dd($request->all());
        $request->validate(
            [
                'logo_invois' => 'required|mimes:jpeg,jpg,png|max:500',
            ],
            [
                'logo_invois.required' => 'Pilih gambar',
                'logo_invois.mimes' => 'Jenis fail hanya jpeg,jpg,png',
                'logo_invois.max' => 'Saiz yang dibenarkan adalah kurang 500KB',

            ]
        );

        if ($request->exists('logo_invois')) {
            $file = $request->logo_invois;
            $fileModel = new InvoiceImage();
            $fileModel->image_index = 0;
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/invoice_logo', $fileName, 'public');
            $real_file_path = 'storage/' . $filePath;

            $fileModel->image_name = $fileName;

            $fileModel->image_path = $real_file_path;
            $fileModel['house_id'] = $request->house_id;
            $fileModel->image_for = "Logo pemilik rumah dalam invois";
            $saved = $fileModel->save();
        }

        if($saved){
            $c = InvoiceImage::where('house_id', $request->house_id)->orderBy('id', 'ASC')->count();
            if($c>1){
                $image = InvoiceImage::where('house_id', $request->house_id)->orderBy('id', 'ASC')->first();

                $image->delete();
            }
            return response()->json([
                'success' => 'Logo berjaya dimasukkan'
            ]);

        }
    }

    public function get_logo(Request $request)
    {
        // dd($request);
        // return 'test';
        $house_id = $_GET['house_id'];

        $user = Auth::user();

        if ($user->hasAnyRole('Owner') && Check_User_house($house_id) == 0)
            return view('error.404');

        $image = InvoiceImage::where('house_id', $house_id)->first();

        // dd($image);
        if ($image != null) {
            $image_path = "/" . $image->image_path;
            return $image_path;
        }else{
            return 'No';
        }

    }
}