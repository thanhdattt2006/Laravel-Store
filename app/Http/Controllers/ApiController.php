<?php

namespace App\Http\Controllers;
class ApiController extends Controller
{
  public function api()
  {
    $message = "nothing";
    $status = "good";
    return response()->json([
      'message' => $message,
      'status' => $status
    ], 200);
  }
}
