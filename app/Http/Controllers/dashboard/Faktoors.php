<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\CharitiesMeta;
use App\queries\Queries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Faktoors extends Controller
{
    public function index()
    {
        return view('dashboard.faktoors.faktoors');
    }

    public function print()
    {
        $data = Queries::getCharityAndMetas()->first(['logo','fullname']);
        $data['title'] = 'لیست پرداخت ها';
        return view('dashboard.faktoors.print',compact('data'));
    }

    public function show(Request $request)
    {
        $faktoor = Queries::getFaktoors()->findOrFail($request->integer('id'),'sabtid');
        return redirect(route('showFaktoor',$faktoor->sabtid));

//        return view('dashboard.faktoors.seFaktoor',['data' => $faktoor]);
    }
}
