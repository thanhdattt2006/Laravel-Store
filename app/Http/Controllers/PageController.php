<?php

namespace App\Http\Controllers;

use App\Models\Photo;

class PageController extends Controller
{
    public function login()
    {
        $data = [
            'photos' => Photo::pluck('name')
        ];
        return view('page/login')->with($data);
    }
    public function tracking()
    {
        $data = [
            'photos' => Photo::pluck('name')
        ];
        return view('page/tracking')->with($data);
    }
    public function elementss()
    {
        $data = [
            'photos' => Photo::pluck('name')
        ];
        return view('page/elementss')->with($data);
    }
}
