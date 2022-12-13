<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Support\Facades\Auth;

class Pay
{
    public function index($charity)
    {
        return response()->json([
            'data' => Auth::user()->name,
            'charity' => $charity
        ]);
    }
}
