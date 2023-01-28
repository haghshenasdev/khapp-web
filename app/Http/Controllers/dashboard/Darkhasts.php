<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Darkhast;
use App\Models\Type;
use App\queries\Queries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class Darkhasts extends Controller
{
    public function index()
    {
        return view('dashboard.darkhasts.darkhasts');
    }

    public function show(Request $request)
    {
        $validateData = $request->validate([
            'id' => 'required|numeric'
        ]);

        $darkhast = Queries::getDrakhasts()->findOrFail($validateData['id']);

        return view('dashboard.darkhasts.seDarkhast',[
            'data' => $darkhast,
            'types' => Queries::getDarkhastsTypes()->get(),
            'darkhast_statuses' => Queries::getDarkhastStatuses()->get(),
        ]);
    }

    public function new()
    {
        return view('dashboard.darkhasts.seDarkhast',[
            'types' => Queries::getDarkhastsTypes()->get(),
            'darkhast_statuses' => Queries::getDarkhastStatuses()->get(),
        ]);
    }

    public function create(Request $request)
    {
        $data = $this->darkhastValidatior($request);
        if (!isset($data['user'])) $data['user'] = Auth::id();
        if (!isset($data['charity'])) $data['charity'] = Auth::user()->charity;
        if (!isset($data['status'])) $data['status'] = 1;
        $insertedID = Darkhast::query()->insertGetId($data);
        return redirect(route('showDarkhasts').'?id='.$insertedID);
    }

    public function update(Request $request)
    {
        $data = $this->darkhastValidatior($request);
        $darkhast = Darkhast::query()->findOrFail($request->integer('id'));
        if (Gate::allows('update-darkhasts',$darkhast)){
            Darkhast::query()->update($data);
        }else{
            abort(403);
        }
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $darkhast = Darkhast::query()->findOrFail($request->integer('id'));
        if (Gate::allows('delete-darkhasts',$darkhast)){
            $darkhast->delete();
        }else{
            abort(403);
        }
        return redirect()->route('darkhasts');
    }

    private function darkhastValidatior(Request $request)
    {
        $rules = [
            'type' => 'required|exists:types,id',
            'description' => 'required|string',
        ];

        if (Gate::allows('update-darkhasts')){
            $rules['status'] = 'required|exists:darkhast_statuses,id';
            $rules['user'] = 'required|exists:users,id';
            if (Gate::allows('see-all-darkhasts')){
                $rules['charity'] = 'required|exists:charities,id';
            }
        }
        return $request->validate($rules);
    }
}
