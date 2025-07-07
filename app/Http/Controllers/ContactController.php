<?php
namespace App\Http\Controllers;

use App\Models\Cate;

class ContactController extends Controller
{
    public function index()
    {
        
        $data = [
            'names' => Cate::pluck('name')
        ];
        return view('contact/index')->with($data);
    }
}
?>