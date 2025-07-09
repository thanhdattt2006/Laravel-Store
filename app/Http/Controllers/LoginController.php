<?php

namespace App\Http\Controllers;
use Exception;
use App\Models\Account; 
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        
        try {
            
        }
        catch (Exception $ex) {

        }
        return view('login/index');
    }
}
