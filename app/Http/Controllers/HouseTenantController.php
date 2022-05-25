<?php

namespace App\Http\Controllers;


use App\Models\House;
use App\Models\HouseTenant;
use App\Models\HouseTenantVehicle;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HouseTenantController extends Controller
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
                'tenant_user_id' => 'required',
                'tenant_as_in_ic_address1' => 'required',
                'tenant_as_in_ic_address2' => 'required',
                'tenant_as_in_ic_poskod' => 'required',
                'tenant_as_in_ic_daerah' => 'required',
                'tenant_as_in_ic_negeri' => 'required',
                'tenant_name' => 'required',
                'tenant_ic' => 'required',
                'tenant_phone_no' => 'required',
                'tenant_email' => 'required',
                'tenant_race' => 'required',
                'tenant_is_work' => 'required',
                'tenant_is_married' => 'required',
                'tenant_vehicle_count.*' => 'required_with:tenant_vehicle_type',
                'tenant_vehicle_type.*' => 'required_with:tenant_vehicle_count',
                'tenant_company_name' => 'required',
                'tenant_company_phone' => 'required',
                // 'tenant_company_address1' => 'required',
                // 'tenant_company_address2' => 'required',
                // 'tenant_company_poskod' => 'required',
                // 'tenant_company_daerah' => 'required',
                // 'tenant_company_negeri' => 'required',
                // 'file' => 'required|image|mimes:jpeg,jpg|max:2048'
            ],
            [
                'tenant_user_id.required' => 'Sila pilih profil pengguna penyewa',
                'tenant_as_in_ic_address1.required' => 'No rumah dan jalan perlu diisi',
                'tenant_as_in_ic_address2.required' => 'Taman/Kampung/Desa perlu diisi',
                'tenant_as_in_ic_poskod.required' => 'Poskod perlu diisi',
                'tenant_as_in_ic_daerah.required' => 'Daerah perlu diisi',
                'tenant_as_in_ic_negeri.required' => 'Negeri perlu diisi',
                'tenant_name.required' => 'Nama penuh penyewa rumah perlu diisi',
                'tenant_ic.required' => 'No kad pengenalan penyewa rumah perlu diisi',
                'tenant_phone_no.required' => 'No telefon penyewa rumah perlu diisi',
                'tenant_email.required' => 'Emel penyewa rumah perlu diisi',
                'tenant_race.required' => 'Bangsa penyewa rumah perlu diisi',
                'tenant_is_work.required' => 'Soalan adakah penyewa rumah sudah bekerja perlu dijawab',
                'tenant_is_married.required' => 'Soalan adakah penyewa rumah sudah berkeluarga perlu dijawab',
                'tenant_vehicle_count.required' => 'Bilangan kenderaan penyewa rumah perlu diisi',
                'tenant_vehicle_type.required' => 'Jenis dan nama kenderaan penyewa rumah perlu diisi',
                'tenant_company_name.required' => 'Nama majikan penyewa rumah perlu diisi',
                'tenant_company_phone.required' => 'No telefon majikan penyewa rumah perlu diisi',
                // 'tenant_company_address1.required' => 'Alamat (1) majikan perlu diisi',
                // 'tenant_company_address2.required' => 'Alamat (2) majikan perlu diisi',
                // 'tenant_company_poskod.required' => 'Poskod majikan perlu diisi',
                // 'tenant_company_daerah.required' => 'Daerah majikan perlu diisi',
                // 'tenant_company_negeri.required' => 'Negeri majikan perlu diisi',

                // 'file.required' => 'Fail gambar jpeg dan jpg sahaja dibenarkan',
            ]
        );

        // dd($request);

        $housetenant = HouseTenant::create($request->all());

        $vehicles_count = $request['tenant_vehicle_count'];
        $vehicles_type = $request['tenant_vehicle_type'];

        // dd($vehicles_count);

        foreach ($vehicles_count as $key1 => $data1) {
            $fileModel = new HouseTenantVehicle();
            $fileModel->vehicle_count = $data1;
            $fileModel->vehicle_type = $vehicles_type[$key1];
            $fileModel->tenant_id = $housetenant->id;
            $fileModel->save();
        }
        // $housetenant_vehicles = HouseTenantVehicle::create(
        //     [
        //         'house_id' => $housetenant->id,
        //         'vehicle_count' => $request['vehicle_count'],
        //         'vehicle_type_with_name' => $request['vehicle_type_with_name'],
        //     ]
        // );



        // dd($housetenant);

        return back()
            ->with('success', 'Maklumat penyewa berjaya dimasukkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HouseTenant  $houseTenant
     * @return \Illuminate\Http\Response
     */
    public function show($house_id)
    {
        if (Check_User_house($house_id) == 0)
            return view('error.404');


        $user = Auth::user();
        $nav_house = get_nav_menu($house_id, 4);
        $house = House::find($house_id);

        $house->tenant = House::find($house->id)->tenant;
        $users_createdby_owner = User::where('created_by', $user->id)->orderBy('created_at', 'desc')->get();
        // dd($house);
        return view('housetenant.list', compact('house', 'nav_house', 'users_createdby_owner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HouseTenant  $houseTenant
     * @return \Illuminate\Http\Response
     */
    public function edit(HouseTenant $houseTenant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HouseTenant  $houseTenant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $tenant_id)
    {
        if (Check_User_house($request['house_id']) == 0)
            return view('error.404');

        $request->validate(
            [
                'edit_tenant_user_id' => 'required',
                'edit_tenant_as_in_ic_address1' => 'required',
                'edit_tenant_as_in_ic_address2' => 'required',
                'edit_tenant_as_in_ic_poskod' => 'required',
                'edit_tenant_as_in_ic_daerah' => 'required',
                'edit_tenant_as_in_ic_negeri' => 'required',
                'edit_tenant_name' => 'required',
                'edit_tenant_ic' => 'required',
                'edit_tenant_phone_no' => 'required',
                'edit_tenant_email' => 'required',
                'edit_tenant_race' => 'required',
                'edit_tenant_is_work' => 'required',
                'edit_tenant_is_married' => 'required',
                'edit_tenant_vehicle_count.*' => 'required_with:edit_tenant_vehicle_type',
                'edit_tenant_vehicle_type.*' => 'required_with:edit_tenant_vehicle_count',
                'edit_tenant_company_name' => 'required',
                'edit_tenant_company_phone' => 'required',
                'edit_tenant_company_address1' => 'required',
                'edit_tenant_company_address2' => 'required',
                'edit_tenant_company_poskod' => 'required',
                'edit_tenant_company_daerah' => 'required',
                'edit_tenant_company_negeri' => 'required',
                // 'file' => 'required|image|mimes:jpeg,jpg|max:2048'
            ],
            [
                'edit_tenant_user_id.required' => 'Sila pilih profil pengguna penyewa',
                'edit_tenant_as_in_ic_address1.required' => 'No rumah dan jalan perlu diisi',
                'edit_tenant_as_in_ic_address2.required' => 'Taman/Kampung/Desa perlu diisi',
                'edit_tenant_as_in_ic_poskod.required' => 'Poskod perlu diisi',
                'edit_tenant_as_in_ic_daerah.required' => 'Daerah perlu diisi',
                'edit_tenant_as_in_ic_negeri.required' => 'Negeri perlu diisi',
                'edit_tenant_name.required' => 'Nama penuh penyewa rumah perlu diisi',
                'edit_tenant_ic.required' => 'No kad pengenalan penyewa rumah perlu diisi',
                'edit_tenant_phone_no.required' => 'No telefon penyewa rumah perlu diisi',
                'edit_tenant_email.required' => 'Emel penyewa rumah perlu diisi',
                'edit_tenant_race.required' => 'Bangsa penyewa rumah perlu diisi',
                'edit_tenant_is_work.required' => 'Soalan adakah penyewa rumah sudah bekerja perlu dijawab',
                'edit_tenant_is_married.required' => 'Soalan adakah penyewa rumah sudah berkeluarga perlu dijawab',
                'edit_tenant_vehicle_count.required' => 'Bilangan kenderaan penyewa rumah perlu diisi',
                'edit_tenant_vehicle_type.required' => 'Jenis dan nama kenderaan penyewa rumah perlu diisi',
                'edit_tenant_company_name.required' => 'Nama majikan penyewa rumah perlu diisi',
                'edit_tenant_company_phone.required' => 'No telefon majikan penyewa rumah perlu diisi',
                // 'edit_tenant_company_address1.required' => 'Alamat (1) majikan perlu diisi',
                // 'edit_tenant_company_address2.required' => 'Alamat (2) majikan perlu diisi',
                // 'edit_tenant_company_poskod.required' => 'Poskod majikan perlu diisi',
                // 'edit_tenant_company_daerah.required' => 'Daerah majikan perlu diisi',
                // 'edit_tenant_company_negeri.required' => 'Negeri majikan perlu diisi',
                // 'file.required' => 'Fail gambar jpeg dan jpg sahaja dibenarkan',
            ]
        );

        // dd($request);

        $housetenant = HouseTenant::find($tenant_id);
        $housetenant->update(
            [
                'tenant_user_id' => $request['edit_tenant_user_id'],
                'tenant_name' => $request['edit_tenant_name'],
                'tenant_ic' => $request['edit_tenant_ic'],
                'tenant_phone_no' => $request['edit_tenant_phone_no'],
                'tenant_email' => $request['edit_tenant_email'],
                'tenant_as_in_ic_address1'
                => $request['edit_tenant_as_in_ic_address1'],
                'tenant_as_in_ic_address2'
                => $request['edit_tenant_as_in_ic_address2'],
                'tenant_as_in_ic_poskod'
                => $request['edit_tenant_as_in_ic_poskod'],
                'tenant_as_in_ic_daerah' => $request['edit_tenant_as_in_ic_daerah'],
                'tenant_as_in_ic_negeri' => $request['edit_tenant_as_in_ic_negeri'],
                'tenant_race' => $request['edit_tenant_race'],
                'tenant_is_married' => $request['edit_tenant_is_married'],
                'tenant_is_work' => $request['edit_tenant_is_work'],

                // 'tenant_vehicle_plate_no' => $request['edit_tenant_vehicle_plate_no'],
                // 'tenant_vehicle_type_with_name' => $request['edit_tenant_vehicle_type_with_name'],
                'tenant_company_name' => $request['edit_tenant_company_name'],
                'tenant_company_phone' => $request['edit_tenant_company_phone'],
                // 'tenant_company_address1' => $request['edit_tenant_company_address1'],
                // 'tenant_company_address2' => $request['edit_tenant_company_address2'],
                // 'tenant_company_poskod' => $request['edit_tenant_company_poskod'],
                // 'tenant_company_daerah' => $request['edit_tenant_company_daerah'],
                // 'tenant_company_negeri' => $request['edit_tenant_company_negeri'],
                'updated_at' => \Carbon\Carbon::now()

            ]
        );

        $tenant_vehicles = HouseTenantVehicle::where('tenant_id', $tenant_id);
        $tenant_vehicles->delete();

        $vehicles_count = $request['edit_tenant_vehicle_count'];
        $vehicles_type = $request['edit_tenant_vehicle_type'];

        foreach ($vehicles_count as $key1 => $data1) {
            $fileModel = new HouseTenantVehicle();
            $fileModel->vehicle_count = $data1;
            $fileModel->vehicle_type = $vehicles_type[$key1];
            $fileModel->tenant_id = $housetenant->id;
            $fileModel->save();
        }

        return back()
            ->with('success', 'Maklumat penyewa berjaya dikemaskini');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HouseTenant  $houseTenant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $tenant_id)
    {

        // return response()->json(
        //     [
        //         'success' => $request->all()
        //     ]
        // );

        if (Check_User_tenant($tenant_id) == 0)
            return view('error.404');

        $tenant = HouseTenant::find($tenant_id);

        $tenant->delete();


        return response()->json(
            [
                'success' => 'Maklumat berjaya dihapuskan'
            ]
        );
    }

    public function get_tenant_info($tenant_id)
    {
        if (Check_User_tenant($tenant_id) == 0)
            return view('error.404');
        // else
        //     return "OK";

        $tenant = HouseTenant::find($tenant_id);

        // dd($tenant);

        foreach ($tenant->vehicles as $key => $vehicle) {
            $vehicle_html[] = view('housetenant.editItem', compact('vehicle', 'key'))->render();
        }

        $tenant->vehicle_html = $vehicle_html;


        // dd($tenant_vehicle_type_array);



        // dd($vehicle_html);

        return $tenant;
        // return json_encode(array("tenant" => $tenant, "tenant_vehicle" => "valueB"));

        // return $tenant_id;
        // return Auth::id();
    }

    public function getHTML(Request $request)
    {
        // return $tenant_vehicle_type_array;
        $type = 0;

        $tenant_vehicle_type_array = $request['tenant_vehicle_type_array'];
        if (isset($request['type'])) {
            $type = $request['type'];
        }

        // return "test";

        // return $tenant_vehicle_type_array;
        try {
            if ($type == 'edit') {
                return view('housetenant.addItem_edit', compact('tenant_vehicle_type_array'))->render();
            }
            return view('housetenant.addItem', compact('tenant_vehicle_type_array'))->render();
        } catch (\Exception $exception) {

            return "<h2>{{ $exception->getMessage() }}</h2>";
        }
    }
}