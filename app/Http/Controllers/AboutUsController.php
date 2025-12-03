<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;

class AboutUsController extends Controller
{
    public function index()
    {

        $data = [
            'titles' => AboutUs::paginate(3)
        ];
        return view('aboutus/index')->with($data);
    }


    public function aboutUsDetail($id)
    {

        $item = AboutUs::findOrFail($id);

        return view('aboutus/aboutUsDetail')->with('item', $item);
    }
}
