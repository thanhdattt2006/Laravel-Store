<?php
namespace App\Http\Controllers;

use App\Models\Photo;

class CategoryController extends Controller
{
    public function index()
    {
        $data = [
            'photos' => Photo::pluck('name')  
        ];
        return view('cate/index')->with($data);
    }

    
}
?>