<?php
namespace App\Http\Controllers;

use App\Models\Cate;

class AboutUsController extends Controller
{
    public function index()
    {
        
        $data = [
            'names' => Cate::pluck('name')
        ];
        return view('aboutus/index')->with($data);
    }
}
?>