<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Mail;

class TicketReplyController extends Controller
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
                'reply' => 'required',
                'ticket_status' => 'required',

            ],
            [
                'reply.required' => 'Sial masukkan maklumbalas anda',
                'ticket_status.required' => 'Sila pilih status aduan',
            ]
        );

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

        $ticket = TicketReply::create(
            [
                'reply' => $request['reply'],
                'reply_by' => Auth::user()->id,
                'ticket_id' => $request['ticket_id'],
                'reply_status' => $status,
                'ticket_status' => $request['ticket_status'],
            ]
        );

        $ticket = Ticket::with('house_tenant')->where('ticket_id',$request['ticket_id'])->first();


        $details = [
            'title' => 'BURS | Aduan penyewa',
            'body' => 'Pemilik rumah telah menghantar maklumbalas kepada anda. Sila semak melalui laman BURS untuk maklumat lanjut. No aduan adalah '.$ticket->ticket_number
        ];

        Mail::to($ticket->house_tenant->tenant_email)->send(new \App\Mail\SendMail($details));

        return redirect()
            ->route('tickets.index')
            ->with('success', 'Maklumbalas anda untuk aduan penyewa berjaya dihantar.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TicketReply  $ticketReply
     * @return \Illuminate\Http\Response
     */
    public function show(TicketReply $ticketReply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TicketReply  $ticketReply
     * @return \Illuminate\Http\Response
     */
    public function edit(TicketReply $ticketReply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TicketReply  $ticketReply
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TicketReply $ticketReply)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TicketReply  $ticketReply
     * @return \Illuminate\Http\Response
     */
    public function destroy(TicketReply $ticketReply)
    {
        //
    }
}