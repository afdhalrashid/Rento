<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = Note::where('created_by', Auth::user()->id)->get();

        // dd($notes);

        return view('notes.index', compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $user = Auth::user();

        $request->validate(
            [
                'title' => 'required',
                'notes' => 'required',
                'notescolor' => 'required',
            ],
            [
                'title.required' => 'Sila masukkan tajuk nota',
                'notes.required' => 'Sila masukkan nota',
                'notescolor.required' => 'Sila pilih warna nota anda',
            ]
        );


        $note = Note::create(
            [
                'title' => $request['title'],
                'notes' => $request['notes'],
                'colorid' => $request['notescolor'],
                'created_by' => $user->id,
            ]

        );

        $success = 0;

        if(!$note->id){
            $success = 0;
        }else{
            $success = 1;
        }

        if($success == 1){
            return back()
            ->with('success', 'Nota anda berjaya dimasukkan');
        }

        if($success == 0){
            return back()
            ->with('success', 'Nota anda gagal dimasukkan');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $note_id)
    {
        $user = Auth::user();

        $request->validate(
            [
                'edit_title' => 'required',
                'edit_notes' => 'required',
                'edit_notescolor' => 'required',
            ],
            [
                'edit_title.required' => 'Sila masukkan tajuk nota',
                'edit_notes.required' => 'Sila masukkan nota',
                'edit_notescolor.required' => 'Sila pilih warna nota anda',
            ]
        );

        $note = Note::find($note_id);

        $save = $note->update(
            [
                'title' => $request['edit_title'],
                'notes' => $request['edit_notes'],
                'colorid' => $request['edit_notescolor'],
                'created_by' => $user->id,
            ]

        );

        $success = 0;

        if(!$save){
            $success = 0;
        }else{
            $success = 1;
        }

        if($success == 1){
            return back()
            ->with('success', 'Nota anda berjaya dikemaskini');
        }

        if($success == 0){
            return back()
            ->with('success', 'Nota anda gagal dikemaskini');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy($note_id)
    {
        $ann = Note::find($note_id);

        $ann->delete();


        return response()->json(
            [
                'success' => 'Nota berjaya dihapuskan'
            ]
        );
    }
}