<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function multipleupload_index()
    {
        return view('test.multipleupload_index');
    }
}
