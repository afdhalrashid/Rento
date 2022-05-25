<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\House;
use App\Models\Parameter;
use App\Models\HouseTenant;
use App\Models\TicketImage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;
use Illuminate\Support\Facades\Schema;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $row_per_page = 10;

        // $houses = Ticket::where(
        //     'created_by',
        //     '=',
        //     $user->id
        // )->latest()->paginate($row_per_page);

        // foreach ($houses as $house) {
        //     $house->tickets = House::find($house->id)->tickets;
        // }

        // dd($user->roles);

        if ($user->hasAnyRole('Tenant')) {

            $tickets = Ticket::where(
                'user_id',
                '=',
                $user->id
            )->latest()->paginate($row_per_page);
        }
        $all_columns = Schema::getColumnListing('TICKETS');
        // dd($all_columns);

        if ($user->hasAnyRole('Owner')) {
            $tickets = Ticket::with('parameterCategory')->join('house_tenants', 'house_tenants.tenant_user_id', '=', 'tickets.user_id')
                ->join('users', 'users.id', '=', 'house_tenants.tenant_user_id')
                ->where('users.created_by', '=', $user->id)
                ->orderBy('tickets.created_at', 'DESC')
                // ->toSql();
               ->get();

            //    $tickets = Ticket::with('parameterCategory')
            //    ->select(
            //     'tickets.id',
            //     'tickets.ticket_number',
            //     'tickets.user_id',
            //     'tickets.title',
            //     'tickets.priority',
            //     'tickets.message',
            //     'tickets.category_id',
            //     'tickets.created_at',
            //     'house_tenants.created_at',
            //     'users.name',

            //     )
            //    ->join('house_tenants', 'house_tenants.tenant_user_id', '=', 'tickets.user_id')
            //     ->join('users', 'users.id', '=', 'house_tenants.tenant_user_id')
            //     ->where('users.created_by', '=', $user->id)
            //     ->orderBy('tickets.created_at', 'DESC')
            //     // ->toSql();
            //    ->get();
        }


        // dd($tickets);

        // foreach ($tickets as $ticket) {
        //     $ticket->images = Ticket::find($ticket->ticket_id)->images;
        //     // $ticket->images  = Ticket::where('ticket_id', 1)->first();
        // }

        if ($user->hasAnyRole('Tenant')) {

            $tickets = Ticket::with('images', 'parameterCategory','replies')
                ->where('user_id', $user->id)
                ->orderBy('tickets.created_at', 'DESC')
                // ->first()
                ->paginate($row_per_page);
        }

        // if ($user->hasAnyRole('Owner')) {
        //     $tickets = Ticket::with('images', 'parameterCategory', 'replies')
        //         // ->select('tickets.id', 'users.name', 'tickets.title', 'tickets.priority', 'tickets.message', 'tickets.status')
        //         ->join('house_tenants', 'house_tenants.tenant_user_id', '=', 'tickets.user_id')
        //         ->join('users', 'users.id', '=', 'house_tenants.tenant_user_id')
        //         ->where('users.created_by', '=', $user->id)
        //         ->where('tickets.status', '<>', 'Deraf')
        //         ->get();
        // }

        if ($user->hasAnyRole('Owner')) {
            $tickets = Ticket::with('images', 'parameterCategory', 'replies')
                ->select('tickets.id', 'tickets.ticket_number','tickets.ticket_id', 'tickets.category_id', 'tickets.user_id', 'tickets.created_at', 'users.name', 'tickets.title', 'tickets.priority', 'tickets.message', 'tickets.status', 'houses.id as house_id','houses.address1', 'houses.address2', 'houses.poskod', 'houses.daerah', 'parameters.type_name as negeri')
                ->join('house_tenants', 'house_tenants.tenant_user_id', '=', 'tickets.user_id')
                ->join('users', 'users.id', '=', 'house_tenants.tenant_user_id')
                ->join('houses', 'houses.id', '=', 'house_tenants.house_id')
                ->join('parameters', 'parameters.type_id', '=', 'houses.negeri')
                ->where('users.created_by', '=', $user->id)
                ->where('tickets.status', '<>', 'Deraf')
                ->orderBy('tickets.created_at', 'DESC')
                ->get();
        }


        // dd($tickets);
        // dd($tickets[0]->replies->first()->ticket_status);
        // dd($tickets[0]->images);


        return view('tickets.index', compact('tickets'))
            ->with('i', (request()->input('page', 1) - 1) * $row_per_page);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        session(['aduan_new_attachment_upload' => 0]);

        return view('tickets.create');
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
        // dd($request->file('files'));
        // $images = $request->file('files');
        // foreach ($images as $key => $file) {
        //     echo $file;
        // }

        // dd('0');

        $user = Auth::user();

        // $owner_email = User::select('email')->where('id', '=', function () use ($user) {
        //     User::select('created_by')->where('id', '=', $user->id);
        // })->get();

        $created_by = User::where('id', '=', $user->id)->first();

        // dd($created_by);

        $owner_email = User::select('email')->where('id', '=', $created_by->created_by)->first();

        // dd($owner_email);

        $request->validate(
            [
                'title' => 'required',
                'category' => 'required',
                'priority' => 'required',
                'message' => 'required',
                'files.*' => 'mimes:jpeg,jpg|max:2048',
                'files' => 'max:5',

            ],
            [
                'title.required' => 'Tajuk perlu diisi',
                'category.required' => 'Kategori perlu diisi',
                'priority.required' => 'Keutamaan perlu diisi',
                'message.required' => 'Maklumat aduan perlu diisi',
                'files.*' => 'Fail gambar jpeg dan jpg sahaja dibenarkan',
                "files.max" => "Hanya 5 fail untuk muatnaik",
            ]
        );

        $unique_id = bin2hex(random_bytes(20));

        $record = Ticket::latest()->first();

        // dd($record);

        if ($record == null) {
            $expNum = array('ADU', '0');
        } else {
            $expNum = explode('-', $record->ticket_number);
        }

        // dd($expNum);

        $nextTicketeNumber = '';

        if ($request->has('saveasdraft')) {
            if ($request->saveasdraft == 'draft') {
                $status = "Deraf";
            }
        }

        if ($request->has('send')) {
            if ($request->send == 'submit') {
                $status = "New";
            }
        }
        $nextTicketeNumber = 'ADU-' . sprintf("%06d", $expNum[1] + 1);

        // dd($unique_id);
        // dd($nextTicketeNumber);

        $ticket = Ticket::create(
            [
                'user_id' => Auth::user()->id,
                'category_id' => $request['category'],
                'ticket_number' => $nextTicketeNumber,
                'ticket_id' => $unique_id,
                'title' => $request['title'],
                'priority' => $request['priority'],
                'message' => $request['message'],
                'status' => $status,

            ]
        );

        // dd($ticket);

        if ($request->hasFile('files')) {
            $images = $request->file('files');
            foreach ($images as $key => $file) {
                $fileModel = new TicketImage();
                $fileModel->image_index = $key;
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file
                    ->storeAs('uploads/image', $fileName, 'public');

                $fileModel->image_name = time() . '_' .
                    $file->getClientOriginalName();

                $fileModel->image_path = 'storage/' . $filePath;
                $fileModel['ticket_id'] = $unique_id;
                $fileModel->image_for = "Gambar aduan";
                $fileModel->save();
            }
        }

        $details = [
            'title' => 'BURS | Aduan penyewa',
            'body' => $created_by->name . ' telah menghantar aduan kepada anda. Sila semak melalui laman BURS untuk maklumat lanjut. No aduan adalah '.$nextTicketeNumber
        ];

        if ($request->has('send')) {
            if ($request->send == 'submit') {
                Mail::to($owner_email->email)->send(new \App\Mail\SendMail($details));
            }
        }

        return redirect()
            ->route('tickets.index')
            ->with('success', 'Maklumat aduan berjaya dimasukkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show($ticket_id)
    {

        // dd($ticket_id);
        $user = Auth::user();

        try {
            if ($user->hasAnyRole('Owner')) {
                $ticket = Ticket::with('images', 'parameterCategory', 'replies')
                    // ->join('house_tenants', 'house_tenants.tenant_user_id', '=', 'tickets.user_id')
                    // ->join('users', 'users.id', '=', 'house_tenants.tenant_user_id')
                    // ->where('users.created_by', '=', $user->id)
                    ->where('tickets.status', '<>', 'Deraf')
                    ->where('tickets.id', '=', $ticket_id)
                    ->first();
            }

            if ($user->hasAnyRole('Tenant')) {
                $ticket = Ticket::with('images', 'parameterCategory', 'replies')
                    ->where('user_id', '=', $user->id)
                    ->where('id', '=', $ticket_id)
                    ->first();
            }
        } catch (\Throwable $th) {
            //throw $th;
        }




        // dd($ticket);

        return view('tickets.reply', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $ticket_id)
    {
        $user = Auth::user();

        // dd($user->id);

        // $ticket = Ticket::find($ticket_id)->first();
        // dd($ticket);

        // $ticket = Ticket::with('images')->where('id', $ticket_id)->get();


        // dd($ticket);

        $ticket = Ticket::with('images')
            ->where('id', $ticket_id)
            ->where('user_id', $user->id)->first();

        // dd($ticket);

        $countImagesAttached = count($ticket->images);

        // dd($countImagesAttached);

        //session(['aduan_new_attachment_upload' => ($countImagesAttached - 1)]);
        $request->session()->put(
            'aduan_new_attachment_upload',
            ($countImagesAttached - 1)
        );

        return view('tickets.edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        // dd($request);
        $request->validate(
            [
                'title' => 'required',
                'category' => 'required',
                'priority' => 'required',
                'message' => 'required',
                'files.*' => 'mimes:jpeg,jpg|max:2048',
                'files' => 'max:5',

            ],
            [
                'title.required' => 'Tajuk perlu diisi',
                'category.required' => 'Kategori perlu diisi',
                'priority.required' => 'Keutamaan perlu diisi',
                'message.required' => 'Maklumat aduan perlu diisi',
                'files.*' => 'Fail gambar jpeg dan jpg sahaja dibenarkan',
                "files.max" => "Hanya 5 fail untuk muatnaik",
            ]
        );

        $record = Ticket::latest()->first();

        if ($record == null) {
            $expNum = array('ADU', '0');
        } else {
            $expNum = explode('-', $record->ticket_number);
        }

        // $nextTicketeNumber = '';

        if ($request->has('saveasdraft')) {
            if ($request->saveasdraft == 'draft') {
                $status = "Deraf";
            }
        }
        // dd($expNum);
        if ($request->has('send')) {
            if ($request->send == 'submit') {
                $status = "New";
            }
        }
        // $nextTicketeNumber = 'ADU-' . sprintf("%06d", $expNum[1] + 1);

        // dd($unique_id);

        $ticket->update(
            [

                'category_id' => $request['category'],
                // 'ticket_number' => $nextTicketeNumber,
                'title' => $request['title'],
                'priority' => $request['priority'],
                'message' => $request['message'],
                'status' => $status,

            ]
        );

        // dd($ticket);
        // dd($request->file('files')[2]);

        $queryStatus = "";
        if ($request->hasFile('files')) {
            try {
                $images = $request->file('files');
                foreach ($images as $key => $file) {
                    TicketImage::where(
                        [
                            ['ticket_id', '=', $ticket->ticket_id],
                            ['image_index', '=', $key],
                        ]
                    )->delete();
                }
                $queryStatus = "Successful";
            } catch (Exception $e) {
                $queryStatus = "Not success";
            }
        }


        try {
            if ($queryStatus == "Successful" && $request->hasFile('files')) {
                $images = $request->file('files');
                foreach ($images as $key => $file) {
                    $fileModel = new TicketImage();
                    $fileModel->image_index = $key;
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $filePath = $file
                        ->storeAs('uploads/image', $fileName, 'public');

                    $fileModel->image_name = time() . '_' .
                        $file->getClientOriginalName();
                    $fileModel['ticket_id'] = $ticket->ticket_id;
                    $fileModel->image_path = 'storage/' . $filePath;
                    $fileModel->image_for = "Gambar aduan";
                    $fileModel->save();
                }
            }
        } catch (Exception $e) {
            $queryStatus = "Not success";
        }

        if ($queryStatus == "Not success") {
            return redirect()->route('tickets.index')
                ->with('success', 'Tiada kemaskini');
        }

        return redirect()
            ->route('tickets.index')
            ->with('success', 'Maklumat aduan berjaya dikemaskini.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy($ticket_id)
    {

        // dd($ticket_id);
        $ticket = Ticket::find($ticket_id);

        $ticket->delete();


        return response()->json(
            [
                'success' => 'Maklumat berjaya dihapuskan'
            ]
        );
    }

    // FUNCTION GETHTML NI SESSION MASALAH
    public function getHTML(Request $request)
    {
        // $v = $request->query('v');
        if ($request->session()->get('aduan_new_attachment_upload') > 4) {
            return "er";
        }

        if ($request->session()->has('aduan_new_attachment_upload')) {
            $v = $request->session()->get('aduan_new_attachment_upload');
            // echo 1;
        } else {
            $v = $request->session()->put('aduan_new_attachment_upload', 0);
            // echo 2;
        }
        $v = $v + 1;

        $request->session()->put('aduan_new_attachment_upload', $v);

        try {
            if ($v < 2) {
                return view('tickets.addUpload')->render();
            } else {
                return "er";
            }
        } catch (\Throwable $exception) {

            return "<h2>{{ $exception->getMessage() }}</h2>";
        }
    }

    public function get_tenant_info($tenant_id){
        if (Check_User_tenant($tenant_id) == 0)
        return view('error.404');


        $tenant = HouseTenant::find($tenant_id);

        return $tenant;
    }
}