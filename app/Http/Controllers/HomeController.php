<?php

namespace App\Http\Controllers;

use App\Http\Controllers\api\v1\profile\Faktoor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        return view('home',
            [
                'faktoors' => $faktoors = \App\Models\Faktoor::all()->where('userid',Auth::id())->sortDesc(),
                'darkhasts' => $darkhasts = \App\Models\Darkhast::query()
                    ->where('user',Auth::id())
                    ->join('darkhast_types', 'darkhasts.type','=','darkhast_types.id')
                    ->join('darkhast_statuses','darkhasts.status','=','darkhast_statuses.id')
                    ->get(['darkhasts.id','darkhasts.description','darkhasts.created_at','darkhasts.updated_at','darkhasts.status','darkhast_types.title','darkhast_statuses.status_title'])
                    ->sortDesc(),
                'amar' => [
                    'sumAmount' => $faktoors->sum('amount'),
                    'countDarkhast' => $darkhasts->count(),
                ],
            ]
        );
    }

    public function delete(Request $request)
    {
        \App\Models\Faktoor::find($request->input('id'))->delete();
        return redirect('home');
    }
}
