<?php

namespace App\Http\Controllers\api\v1\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class baseApiAuth extends Controller
{
    public function successResponse($text,$code)
    {
        $response = [
            'message' => $text,
            'status' => 'success'
        ];
        return response()->json($response,$code);
    }

    public function errorResponse($text,$code)
    {
        $response = [
            'message' => $text,
            'status' => 'error'
        ];
        return response()->json($response,$code);
    }
}
