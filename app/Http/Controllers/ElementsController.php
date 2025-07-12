<?php
namespace App\Http\Controllers;

use App\Models\Cate;

class ElementsController extends Controller
{
    public function index()
    {
        return view('elements/index');
    }
}
?>