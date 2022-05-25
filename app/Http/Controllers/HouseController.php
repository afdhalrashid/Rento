<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\Parameter;
use App\Models\File;
use App\Models\HouseImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        // $this->middleware('permission:house-list|house-create|house-edit|house-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:house-create', ['only' => ['create', 'store']]);

        // $this->middleware('permission:house-edit', ['only' => ['edit', 'update']]);
        // $this->middleware(['role_or_permission:Staf|Tenant|house-edit'], ['only' => ['edit']]);
        $this->middleware(['role:Super Admin|Admin|Staf|Tenant|Owner'], ['only' => ['edit']]);
        $this->middleware(['role_or_permission:house-edit'], ['only' => ['update']]);
        $this->middleware('permission:house-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $user = Auth::user();
        $row_per_page = 10;

        if ($user->hasAnyRole('Owner')) {
            $houses = House::where(
                'created_by',
                '=',
                $user->id
            )->latest()->paginate($row_per_page);
        }

        if ($user->hasAnyRole('Super Admin', 'Admin', 'Staf')) {
            $houses = House::paginate($row_per_page);
        }

        if ($user->hasAnyRole('Tenant')) {
            $houses = House::with('tenant')
                ->whereHas(
                    "tenant",
                    function ($q) use ($user) {
                        $q->where("tenant_user_id", $user->id);
                    }
                )->latest()->paginate($row_per_page);
        }

        // dd($houses);

        $states = Parameter::where('parameter_name', 'state')
            ->orderBy('type_id')
            ->get();

        foreach ($houses as $house)
            foreach ($states as $state)
                if ($house->negeri == $state->type_id)
                    $house->negeri = $state->type_name;

        foreach ($houses as $house) {
            $house->images = House::find($house->id)->images;
        }

        // dd($houses);


        return view('house.index', compact('houses'))
            ->with('i', (request()->input('page', 1) - 1) * $row_per_page);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('house.create');
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
                'address1' => 'required',
                'address2' => 'required',
                'poskod' => 'required',
                'daerah' => 'required',
                'negeri' => 'required',
                'namaowner' => 'required',
                'icowner' => 'required',
                'phoneno_owner' => 'required',
                'email_owner' => 'required',
                // 'files' => 'required',
                'files.*' => 'mimes:jpeg,jpg|max:2048'
            ],
            [
                'address1.required' => 'No rumah dan jalan perlu diisi',
                'address2.required' => 'Taman/Kampung/Desa perlu diisi',
                'poskod.required' => 'Poskod perlu diisi',
                'daerah.required' => 'Daerah perlu diisi',
                'negeri.required' => 'Negeri perlu diisi',
                'namaowner.required' => 'Nama penuh pemilik rumah perlu diisi',
                'icowner.required' => 'No kad pengenalan pemilik rumah perlu diisi',
                'phoneno_owner.required' => 'No telefon pemilik rumah perlu diisi',
                'email_owner.required' => 'Emel pemilik rumah perlu diisi',
                // 'files.required' => 'Sila muat naik gambar rumah',
                'files.*' => 'Fail gambar jpeg dan jpg sahaja dibenarkan',
            ]
        );

        $request->request->add(
            [
                'created_by' => Auth::user()->id,
            ]
        );

        $house = House::create($request->all());

        if ($request->hasFile('files')) {
            $images = $request->file('files');
            foreach ($images as $key => $file) {
                $fileModel = new HouseImage();
                $fileModel->image_index = $key;
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file
                    ->storeAs('uploads/image', $fileName, 'public');

                $fileModel->image_name = time() . '_' .
                    $file->getClientOriginalName();

                $fileModel->image_path = 'storage/' . $filePath;
                $fileModel['house_id'] = $house->id;
                $fileModel->image_for = "Gambar rumah";
                $fileModel->save();
            }
        }

        return redirect()
            ->route('house.index')
            ->with('success', 'Maklumat rumah berjaya dimasukkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\House  $house
     * @return \Illuminate\Http\Response
     */
    public function show(House $house)
    {
        //return view('house.show', compact('house'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\House  $house
     * @return \Illuminate\Http\Response
     */
    public function edit(House $house)
    {
        $user = Auth::user();

        if ($user->hasAnyRole('Owner') && Check_User_house($house->id) == 0)
            return view('error.404');

        $nav_house = get_nav_menu($house->id, 0);
        // $nav_house = array(
        //     0 => array(
        //         'pagename' => 'Kemaskini rumah',
        //         'pageurl' => route('house.edit', $house->id),
        //         'is_active' => 'active'
        //     ),
        //     1 => array(
        //         'pagename' => 'Dokumen',
        //         'pageurl' => "/housedoc/$house->id",
        //         'is_active' => ''
        //     ),
        //     2 => array(
        //         'pagename' => 'Perjanjian sewa',
        //         'pageurl' => "/houseagreement/$house->id",
        //         'is_active' => ''
        //     ),
        //     3 => array(
        //         'pagename' => 'Iklan/Video/Gambar',
        //         'pageurl' => "/housemedia/$house->id",
        //         'is_active' => ''
        //     ),
        //     4 => array(
        //         'pagename' => 'Kemaskini rumah',
        //         'pageurl' => '',
        //         'is_active' => ''
        //     ),
        //     5 => array(
        //         'pagename' => 'Kemaskini rumah',
        //         'pageurl' => '',
        //         'is_active' => ''
        //     )

        // );

        // dd($nav_house);
        $house->images = House::find($house->id)->images;

        $disable = 'false';
        if ($user->hasAnyRole('Admin', 'Staf', 'Tenant')) {
            $disable = 'true';
        }

        // dd($house->images[0]['image_path']);
        return view('house.edit', compact('house', 'nav_house', 'disable'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\House  $house
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, House $house)
    {

        // dd($request);
        // dd($request->file('files'));
        $request->validate(
            [
                'address1' => 'required',
                'address2' => 'required',
                'poskod' => 'required',
                'daerah' => 'required',
                'negeri' => 'required',
                'namaowner' => 'required',
                'icowner' => 'required',
                'phoneno_owner' => 'required',
                'email_owner' => 'required',
                // 'files' => 'required',
                'files.*' => 'mimes:jpeg,jpg|max:2048'
            ],
            [
                'address1.required' => 'No rumah dan jalan perlu diisi',
                'address2.required' => 'Taman/Kampung/Desa perlu diisi',
                'poskod.required' => 'Poskod perlu diisi',
                'daerah.required' => 'Daerah perlu diisi',
                'negeri.required' => 'Negeri perlu diisi',
                'namaowner.required' => 'Nama penuh pemilik rumah perlu diisi',
                'icowner.required' => 'No kad pengenalan pemilik rumah perlu diisi',
                'phoneno_owner.required' => 'No telefon pemilik rumah perlu diisi',
                'email_owner.required' => 'Emel pemilik rumah perlu diisi',
                // 'files.required' => 'Sila muat naik gambar rumah',
                'files.*' => 'Fail gambar jpeg dan jpg sahaja dibenarkan',

            ]
        );
        $house->update($request->all());

        $queryStatus = "";
        if ($request->hasFile('files')) {
            try {
                $images = $request->file('files');
                foreach ($images as $key => $file) {
                    HouseImage::where(
                        [
                            ['house_id', '=',  $house->id],
                            ['image_index', '=', $key],
                        ]
                    )->delete();
                }
                // HouseImage::where('house_id', $house->id)->delete();
                $queryStatus = "Successful";
            } catch (Exception $e) {
                $queryStatus = "Not success";
            }
        }


        try {
            if ($queryStatus == "Successful" && $request->hasFile('files')) {
                $images = $request->file('files');
                foreach ($images as $key => $file) {
                    $fileModel = new HouseImage();
                    $fileModel->image_index = $key;
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $filePath = $file
                        ->storeAs('uploads/image', $fileName, 'public');

                    $fileModel->image_name = time() . '_' .
                        $file->getClientOriginalName();

                    $fileModel->image_path = 'storage/' . $filePath;
                    $fileModel['house_id'] = $house->id;
                    $fileModel->image_for = "Gambar rumah";
                    $fileModel->save();
                }
            }
        } catch (Exception $e) {
            $queryStatus = "Not success";
        }

        if ($queryStatus == "Not success") {
            return redirect()->route('house.index')
                ->with('success', 'Tiada kemaskini');
        }

        return redirect()->route('house.index')
            ->with('success', 'Rumah anda telah berjaya dikemaskini');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\House  $house
     * @return \Illuminate\Http\Response
     */
    // public function destroy(House $house)
    // {
    //     dd($house->id);
    //     $house->delete();

    //     return redirect()->route('house.index')
    //                     ->with('success','Maklumat berjaya dihapuskan');
    // }
    public function destroy($id)
    {
        $house = House::find($id);

        $house->delete();


        return response()->json(
            [
                'success' => 'Maklumat berjaya dihapuskan'
            ]
        );
    }

    public function list_house_by_user($user_id)
    {
        $request = Request::capture();
        $path = $request->path();
        $input = $request->all();

        $user = Auth::user();
        $row_per_page = 10;

        if ($user->hasAnyRole('Super Admin','Admin', 'Staf')) {
            $houses = House::where('created_by', $user_id)->paginate($row_per_page);
        }


        $states = Parameter::where('parameter_name', 'state')
            ->orderBy('type_id')
            ->get();

        foreach ($houses as $house)
            foreach ($states as $state)
                if ($house->negeri == $state->type_id)
                    $house->negeri = $state->type_name;

        foreach ($houses as $house) {
            $house->images = House::find($house->id)->images;
        }

        // dd($houses);


        return view('house.index', compact('houses'))
            ->with('i', (request()->input('page', 1) - 1) * $row_per_page);
    }
}