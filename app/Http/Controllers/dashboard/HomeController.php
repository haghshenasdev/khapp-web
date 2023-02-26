<?php

namespace App\Http\Controllers\dashboard;

use App\Charts\CharityDaramadChart;
use App\Charts\CharityPayment;
use App\Http\Controllers\Controller;
use App\Models\charity;
use App\Models\Faktoor;
use App\Models\User;
use App\queries\Queries;
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


        $darkhasts = \App\Models\Darkhast::all('id');

        if (Gate::allows('see-all-darkhasts')) {

        } elseif (Gate::allows('see-charity-darkhasts')) {
            $darkhasts->where('charity', Auth::user()->charity);
        } else {
            $darkhasts->where('user', Auth::id());
        }

        $data = [
            'amar' => [
                'sumAmount' => Queries::getFaktoorsSum(),
                'countDarkhast' => $darkhasts->count(),
            ]
        ];

        if (Gate::allows('see-charities')){
            $charities = charity::all('id','shortname')->where('id','!=','0');
            $charityNames = $charities->pluck('shortname');
            $data['chart'] = new CharityPayment($charities,$charityNames);
            $data['daramadChart'] = new CharityDaramadChart($charities,$charityNames);
        }

        return view('dashboard.home',$data);
    }

}
