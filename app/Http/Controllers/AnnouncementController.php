<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\Announcement;
use App\Models\AnnouncementImage;
use App\Models\AnnouncementReceiver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->hasAnyRole('Owner')) {
            $announcements = Announcement::select(
                'announcements.id',
                'announcements.title',
                'announcements.announcement_type',
                'announcements.announcement_date',
                'announcements.created_by',
                'announcements.created_at',
                'owner.name'
                )
            ->join('users as owner', 'owner.id', '=', 'announcements.created_by')
            ->where('announcements.created_by', '=', $user->id)
            ->get();
        }

        // dd($announcements);

        if ($user->hasAnyRole('Tenant')) {
            $announcements = Announcement::select(
                'announcements.id',
                'announcements.title',
                'announcements.announcement_type',
                'announcements.announcement_date',
                'announcements.created_by',
                'announcements.created_at',
                'owner.name'
                )
                ->join('users as owner', 'owner.id', '=', 'announcements.created_by')
                ->join('users as tenant', 'tenant.created_by', '=', 'owner.id')
                ->join('announcement_receivers as ann_receivers', 'ann_receivers.announcement_id', '=', 'announcements.id')
                ->join('house_tenants as ht', 'ht.house_id', '=', 'ann_receivers.house_id')
                ->where('tenant.id', '=', $user->id)
                ->where('announcements.announcement_date', '<=', date('Y-m-d'))
                ->where('ht.tenant_user_id', '=', $user->id)
                ->get();
        }

        // dd($announcements_isu);
        return view('announcement.index', compact('announcements'));
    }
    public function index_old()
    {
        $user = Auth::user();

        if ($user->hasAnyRole('Owner')) {
            $announcements_isu = Announcement::where('created_by', '=', $user->id)->where('announcement_type', '=', 'Isu Semasa')->get();
            $announcements_rule = Announcement::where('created_by', '=', $user->id)->where('announcement_type', '=', 'Peraturan Sewaan')->get();
            $announcements_other = Announcement::where('created_by', '=', $user->id)->where('announcement_type', '=', 'Lain-lain')->get();
        }

        if ($user->hasAnyRole('Tenant')) {
            $announcements_isu = Announcement::join('users as owner', 'owner.id', '=', 'announcements.created_by')
                ->join('users as tenant', 'tenant.created_by', '=', 'owner.id')
                ->where('tenant.id', '=', $user->id)
                ->where('announcement_type', '=', 'Isu Semasa')
                ->get();

            $announcements_rule = Announcement::join('users as owner', 'owner.id', '=', 'announcements.created_by')
                ->join('users as tenant', 'tenant.created_by', '=', 'owner.id')
                ->where('tenant.id', '=', $user->id)
                ->where('announcement_type', '=', 'Peraturan Sewaan')
                ->get();

            $announcements_other = Announcement::join('users as owner', 'owner.id', '=', 'announcements.created_by')
                ->join('users as tenant', 'tenant.created_by', '=', 'owner.id')
                ->where('tenant.id', '=', $user->id)
                ->where('announcement_type', '=', 'Lain-lain')
                ->get();
        }

        // dd($announcements_isu);
        return view('announcement.index', compact('announcements_isu', 'announcements_rule', 'announcements_other'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('announcement.create');
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

        $request->validate(
            [
                'title' => 'required',
                'message' => 'required',
                'announcement_date' => 'required',
                'announcement_type' => 'required',
                'files.*' => 'mimes:jpeg,jpg,pdf|max:2048'
            ],
            [
                'title.required' => 'Sila masukkan tajuk hebahan',
                'message.required' => 'Sila masukkan maklumat hebahan',
                'announcement_date.required' => 'Sila masukkan tarikh hebahan akan dikeluarkan',
                'announcement_type.required' => 'Sila pilih jenis hebahan akan dikeluarkan',
                'files.*' => 'Fail gambar jpeg, jpg dan pdf sahaja dibenarkan',
            ]
        );

        $date_bayar = $request['announcement_date'];

        $announcement = Announcement::create(
            [
                'title' => $request['title'],
                'message' => $request['message'],
                'announcement_date' => $request['announcement_date'],
                'announcement_type' => $request['announcement_type'],
                'created_by' => $user->id,
            ]

        );

        if ($request->hasFile('files')) {
            $images = $request->file('files');
            foreach ($images as $key => $file) {
                $fileModel = new AnnouncementImage();
                $fileModel->image_index = $key;
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file
                    ->storeAs('uploads/announcement_image', $fileName, 'public');

                $fileModel->image_name = time() . '_' .
                    $file->getClientOriginalName();

                $fileModel->image_path = 'storage/' . $filePath;
                $fileModel['announcement_id'] = $announcement->id;
                $fileModel->image_for = "Gambar hebahan";
                $fileModel->save();
            }
        }

        return back()
            ->with('success', 'Maklumat hebahan berjaya dimasukkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function show($announcement_id)
    {
        // return $announcement_id;

        $data = Announcement::with('images')->find($announcement_id);

        // $data = array([
        //     'test'=>'2',
        //     'test1'=>'2',
        //     'test2'=>'2',
        // ]);

        // return response()->json(
        //     [
        //         'data' => $data
        //     ]
        // );


        return view('announcement.view',compact('data'))->render();

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function edit(Announcement $announcement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $announcement_id)
    {
        // dd($request->all());

        if (Check_User_announcement($announcement_id) == 0)
            return view('error.404');

        $request->validate(
            [
                'edit_title' => 'required',
                'edit_message' => 'required',
                'edit_announcement_date' => 'required',
                'edit_announcement_type' => 'required',
                'edit_files.*' => 'mimes:jpeg,jpg,pdf|max:2048'
            ],
            [
                'edit_title.required' => 'Sila masukkan tajuk hebahan',
                'edit_message.required' => 'Sila masukkan maklumat hebahan',
                'edit_announcement_date.required' => 'Sila masukkan tarikh hebahan akan dikeluarkan',
                'edit_announcement_type.required' => 'Sila pilih jenis hebahan akan dikeluarkan',
                'edit_files.*' => 'Fail gambar jpeg, jpg dan pdf sahaja dibenarkan',
            ]
        );

        $date_bayar = $request['edit_announcement_date'];

        $annoucement_to_edit = Announcement::find($announcement_id);

        $annoucement_to_edit->update(
            [
                'title' => $request['edit_title'],
                'message' => $request['edit_message'],
                'announcement_date' => $request['edit_announcement_date'],
                'announcement_type' => $request['edit_announcement_type'],
            ]
        );

        // $announcementImage = AnnouncementImage::where('announcement_id', $announcement_id);
        // $announcementImage->delete();

        if( $request['firstlink_delete'] == 'yes' ){
            $announcementImage = AnnouncementImage::where(
                [
                    ['announcement_id','=', $announcement_id],
                    ['image_index','=', 0],
                ]
            );
            $announcementImage->delete();
        }

        if( $request['secondlink_delete'] == 'yes' ){
            $announcementImage = AnnouncementImage::where(
                [
                    ['announcement_id','=', $announcement_id],
                    ['image_index','=', 1],
                ]
            );
            $announcementImage->delete();
        }

        if ($request->hasFile('edit_files')) {
            $announcementImage = AnnouncementImage::where('announcement_id', $announcement_id);
            $announcementImage->delete();

            $images = $request->file('edit_files');
            foreach ($images as $key => $file) {
                $fileModel = new AnnouncementImage();
                $fileModel->image_index = $key;
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file
                    ->storeAs('uploads/announcement_image', $fileName, 'public');

                $fileModel->image_name = time() . '_' .
                    $file->getClientOriginalName();

                $fileModel->image_path = 'storage/' . $filePath;
                $fileModel['announcement_id'] = $annoucement_to_edit->id;
                $fileModel->image_for = "Gambar hebahan";
                $fileModel->save();
            }
        }

        return back()
            ->with('success', 'Maklumat hebahan berjaya dikemaskini');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return \Illuminate\Http\Response
     */
    public function destroy($announcement_id)
    {
        $ann = Announcement::find($announcement_id);

        $ann->delete();


        return response()->json(
            [
                'success' => 'Maklumat berjaya dihapuskan'
            ]
        );
    }

    public function get_announcement_info($announcement_id)
    {
        return Announcement::with('images')->find($announcement_id);
    }

    public function get_announcement_houses()
    {
        $announcement_id = $_GET['announcement_id'];
        // dd($announcement_id);
        $listhouse_announced = AnnouncementReceiver::where('announcement_id',$announcement_id )->get();

        $user = Auth::user();

        if ($user->hasAnyRole('Owner')) {
            $listhouse_to_announce = House::where(
                'created_by',
                '=',
                $user->id
            )->get();
        }
        $houses = $listhouse_to_announce;

        // return response()->json([
        //     'name' => $listhouse_to_announce,
        //     'state' => 'CA'
        // ]);

        // $listhouse_to_announce = json_encode($listhouse_to_announce);
        // dd($listhouse_to_announce);

        return view('announcement._listhouse', compact('houses','listhouse_announced'))->render();
    }

    public function save_house_to_annouce(Request $request)
    {
        // dd($request->all());

        $announcement_id = $request['listhouse_announcement_id'];
        $houses = $request['check_house'];

        // first to delete all house that receive the announcement
        $ann = AnnouncementReceiver::where('announcement_id',$announcement_id);
        $ann->delete();

        // Insert
        foreach ($houses as $key => $value) {

            $announcement = AnnouncementReceiver::create(
                [
                    'announcement_id' => $announcement_id,
                    'house_id' => $value,
                ]

            );

            if(!$announcement->id){
                return view('error.404');
            }
        }
    }
}