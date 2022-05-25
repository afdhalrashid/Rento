<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\Parameter;
use App\Models\HouseMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HouseMediaController extends Controller
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
        // dd($request);

        if (Check_User_house($request['house_id']) == 0)
            return view('error.404');
        // dd($request);

        $house = House::find($request['house_id']);

        $request->validate(
            [
                'house_image_before' => 'image|mimes:jpeg,jpg|max:2048',
                'house_image_after' => 'image|mimes:jpeg,jpg|max:2048',
                'house_video_before' => 'file|mimes:mp4|max:5048',
                'house_video_after' => 'file|mimes:mp4|max:5048',
            ],
            [
                'house_image_before' => 'Fail gambar jpeg dan jpg sahaja dibenarkan',
                'house_image_after.required' => 'Fail gambar jpeg dan jpg sahaja dibenarkan',
                'house_video_before.required' => 'Fail video mp4 sahaja dibenarkan',
                'house_video_after.required' => 'Fail video mp4  sahaja dibenarkan',
            ]
        );

        $request->request->add(
            [
                'created_by' => Auth::user()->id,
            ]
        );

        $fileModel = new HouseMedia;

        if ($request->hasfile('house_image_before')) {
            $file = $request->file('house_image_before');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public');

            $fileModel->name = time() . '_' . $file->getClientOriginalName();
            $fileModel->file_path = 'storage/' . $filePath;
            $fileModel->file_for = 'gambar sebelum';
            $fileModel['house_id'] = $house->id;
            $fileModel->save();
        }

        $fileModel = new HouseMedia;

        if ($request->hasfile('house_image_after')) {
            $file = $request->file('house_image_after');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public');

            $fileModel->name = time() . '_' . $file->getClientOriginalName();
            $fileModel->file_path = 'storage/' . $filePath;
            $fileModel->file_for = 'gambar selepas';
            $fileModel['house_id'] = $house->id;
            $fileModel->save();
        }

        $fileModel = new HouseMedia;

        if ($request->hasfile('house_video_before')) {
            $file = $request->file('house_video_before');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public');

            $fileModel->name = time() . '_' . $file->getClientOriginalName();
            $fileModel->file_path = 'storage/' . $filePath;
            $fileModel->file_for = 'video sebelum';
            $fileModel['house_id'] = $house->id;
            $fileModel->save();
        }


        $fileModel = new HouseMedia;

        if ($request->hasfile('house_video_after')) {
            $file = $request->file('house_video_after');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public');

            $fileModel->name = time() . '_' . $file->getClientOriginalName();
            $fileModel->file_path = 'storage/' . $filePath;
            $fileModel->file_for = 'video selepas';
            $fileModel['house_id'] = $house->id;
            $fileModel->save();
        }


        // return redirect()
        //     ->route('house.index')
        //     ->with('success', 'Maklumat rumah berjaya dimasukkan.');

        return back()
            ->with('success', 'Gambar dan video berjaya dimasukkan');
    }

    public function store(Request $request)
    {
        // dd($request);

        if (Check_User_house($request['house_id']) == 0)
            return view('error.404');
        // dd($request);

        $house = House::find($request['house_id']);

        $request->validate(
            [
                'house_image_before.*' => 'image|mimes:jpeg,jpg|max:2048',
                'house_image_after.*' => 'image|mimes:jpeg,jpg|max:2048',
                'house_video_before' => 'file|mimes:mp4|max:5048',
                'house_video_after' => 'file|mimes:mp4|max:5048',
                // 'house_url_youtube' => 'required',
            ],
            [
                'house_image_before.*' => 'Fail gambar jpeg dan jpg sahaja dibenarkan',
                'house_image_after.*' => 'Fail gambar jpeg dan jpg sahaja dibenarkan',
                'house_video_before.required' => 'Fail video sebelum perlu dimuatnaik',
                'house_video_after.required' => 'Fail video selepas perlu dimuatnaik',
                'house_video_before.mimes' => 'Fail video mp4 sahaja dibenarkan',
                'house_video_after.mimes' => 'Fail video mp4  sahaja dibenarkan',
                'house_video_before.max' => 'Fail video bersaiz maksimum 5MB sahaja dibenarkan',
                'house_video_after.max' => 'Fail video bersaiz maksimum 5MB sahaja dibenarkan',
                // 'house_url_youtube.required' => 'Tiada pautan Youtube dimasukkan',
            ]
        );

        if ($request->hasFile('house_image_before')) {
            try {
                $images = $request->file('house_image_before');
                foreach ($images as $key => $file) {
                    HouseMedia::where(
                        [
                            ['house_id', '=',  $house->id],
                            ['image_index', '=', $key],
                            ['file_for', '=', 'gambar sebelum'],
                        ]
                    )->delete();
                }
                // HouseImage::where('house_id', $house->id)->delete();
                $queryStatus = "Successful";
            } catch (Exception $e) {
                $queryStatus = "Not success";
            }
        }


        if ($request->hasfile('house_image_before')) {
            $files = $request->file('house_image_before');

            foreach ($files as $key => $file) {
                $fileModel = new HouseMedia();
                $fileModel->image_index = $key;
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('uploads/housemedia', $fileName, 'public');

                $fileModel->name = time() . '_' . $file->getClientOriginalName();
                $fileModel->file_path = 'storage/' . $filePath;
                $fileModel->file_for = 'gambar sebelum';
                $fileModel['house_id'] = $house->id;
                $fileModel->save();
            }
        }

        if ($request->hasFile('house_image_after')) {
            try {
                $images = $request->file('house_image_after');
                foreach ($images as $key => $file) {
                    HouseMedia::where(
                        [
                            ['house_id', '=',  $house->id],
                            ['image_index', '=', $key],
                            ['file_for', '=', 'gambar selepas'],
                        ]
                    )->delete();
                }
                // HouseImage::where('house_id', $house->id)->delete();
                $queryStatus = "Successful";
            } catch (Exception $e) {
                $queryStatus = "Not success";
            }
        }



        if ($request->hasfile('house_image_after')) {
            $files = $request->file('house_image_after');

            foreach ($files as $key => $file) {
                $fileModel = new HouseMedia;
                $fileModel->image_index = $key;
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('uploads/housemedia', $fileName, 'public');

                $fileModel->name = time() . '_' . $file->getClientOriginalName();
                $fileModel->file_path = 'storage/' . $filePath;
                $fileModel->file_for = 'gambar selepas';
                $fileModel['house_id'] = $house->id;
                $fileModel->save();
            }
        }

        if ($request->hasFile('house_video_before')) {
            try {
                HouseMedia::where(
                    [
                        ['house_id', '=',  $house->id],
                        ['image_index', '=', 1],
                        ['file_for', '=', 'video sebelum'],
                    ]
                )->delete();

                $queryStatus = "Successful";
            } catch (Exception $e) {
                $queryStatus = "Not success";
            }
        }


        $fileModel = new HouseMedia;

        if ($request->hasfile('house_video_before')) {
            $file = $request->file('house_video_before');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/housemedia', $fileName, 'public');
            $fileModel->image_index = 1;
            $fileModel->name = time() . '_' . $file->getClientOriginalName();
            $fileModel->file_path = 'storage/' . $filePath;
            $fileModel->file_for = 'video sebelum';
            $fileModel['house_id'] = $house->id;
            $fileModel->save();
        }

        if ($request->hasFile('house_video_after')) {
            try {
                HouseMedia::where(
                    [
                        ['house_id', '=',  $house->id],
                        ['image_index', '=', 1],
                        ['file_for', '=', 'video selepas'],
                    ]
                )->delete();

                $queryStatus = "Successful";
            } catch (Exception $e) {
                $queryStatus = "Not success";
            }
        }


        $fileModel = new HouseMedia;

        if ($request->hasfile('house_video_after')) {
            $file = $request->file('house_video_after');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/housemedia', $fileName, 'public');
            $fileModel->image_index = 1;
            $fileModel->name = time() . '_' . $file->getClientOriginalName();
            $fileModel->file_path = 'storage/' . $filePath;
            $fileModel->file_for = 'video selepas';
            $fileModel['house_id'] = $house->id;
            $fileModel->save();
        }

        $url = HouseMedia::where('house_id', '=', $house->id)->where('file_for', '=', 'URL Youtube')->get();

        if (count($url) < 1) {
            $fileModel = new HouseMedia;
            $fileModel->image_index = 1;
            $fileModel->name = 'Youtube';
            $fileModel->file_path = $request->house_url_youtube;
            $fileModel->file_for = 'URL Youtube';
            $fileModel['house_id'] = $house->id;
            $fileModel->save();
        } else {
            $url = HouseMedia::where('house_id', '=', $house->id)->where('file_for', '=', 'URL Youtube');
            $url->update(
                [
                    'file_path' =>  $request->house_url_youtube
                ]
            );
        }



        // return redirect()
        //     ->route('house.index')
        //     ->with('success', 'Maklumat rumah berjaya dimasukkan.');

        return back()
            ->with('success', 'Gambar/video berjaya dimasukkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HouseMedia  $houseMedia
     * @return \Illuminate\Http\Response
     */
    public function show($house_id)
    {
        // return "show";

        if (Check_User_house($house_id) == 0)
            return view('error.404');

        $nav_house = get_nav_menu($house_id, 3);

        $house = House::find($house_id);

        // dd($house);
        $house->media = House::find($house->id)->media;

        // dd($house->file[0]['file_path']);
        // dd($house);

        return view('housemedia.list', compact('house', 'nav_house'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HouseMedia  $houseMedia
     * @return \Illuminate\Http\Response
     */
    public function edit(HouseMedia $houseMedia)
    {
        return "edit";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HouseMedia  $houseMedia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HouseMedia $houseMedia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HouseMedia  $houseMedia
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $houseMedia = HouseMedia::find($id);

        $houseMedia->delete();


        return response()->json(
            [
                'success' => 'Maklumat berjaya dihapuskan'
            ]
        );
    }
}