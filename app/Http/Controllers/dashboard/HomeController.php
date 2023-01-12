<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $faktoors = \App\Models\Faktoor::all('amount');

        if (Gate::allows('see-all-faktoors')){

        }elseif (Gate::allows('see-charity-faktoors')){
            $faktoors->where('charity',Auth::user()->charity);
        }else{
            $faktoors->where('userid',Auth::id());
        }

        $darkhasts = \App\Models\Darkhast::all('id');

        if (Gate::allows('see-all-darkhasts')){

        }elseif (Gate::allows('see-charity-darkhasts')){
            $darkhasts->where('charity',Auth::user()->charity);
        }else{
            $darkhasts->where('user',Auth::id());
        }

        return view('dashboard.home',
            [
                'amar' => [
                    'sumAmount' => $faktoors->sum('amount'),
                    'countDarkhast' => $darkhasts->count(),
                ],
            ]
        );
    }
}
