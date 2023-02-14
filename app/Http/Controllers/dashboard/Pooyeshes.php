<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Pooyesh;
use App\Models\Project;
use App\Models\Type;
use App\queries\Queries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Morilog\Jalali\CalendarUtils;

class Pooyeshes extends Controller
{
    public function index()
    {
        return view('dashboard.pooyeshes.pooyeshes');
    }

    public function show(Request $request)
    {

        $pooyesh = Queries::getPooyeshes()->findOrFail($request->integer('id'));
        return view('dashboard.pooyeshes.sePooyeshes',['data' => $pooyesh]);
    }

    public function update(Request $request)
    {
        $validData = $this->getValidator($request);

        $pooyesh = Pooyesh::query()->findOrFail($request->integer('id'));
        if (Gate::allows('update-pooyesh',$pooyesh)){
            $pooyesh->update($validData);
        }else{
            abort(403);
        }

        return redirect()->back()->with(['success' => 'بروز رسانی با موفقیت انجام شد .']);
    }

    public function new()
    {
        return view('dashboard.pooyeshes.sePooyeshes');
    }

    public function create(Request $request)
    {
        $validData = $this->getValidator($request);

        Pooyesh::query()->insert($validData);

        return redirect()->back()->with(['success' => 'پویش با موفقیت ایجاد شد .']);
    }

    public function delete(Request $request)
    {
        $type = Pooyesh::query()->findOrFail($request->integer('id'));
        if (Gate::allows('delete-pooyesh',$type)){
            $type->delete();
        }else{
            abort(403);
        }
        return redirect()->route('pooyeshes');
    }

    private function getValidator(Request $request): array
    {
         $validData = $request->validate([
            'title' => ['required','string'],
            'description' => ['required','string'],
            'start' => '',
            'end' => '',
            'image' => ['required','string'],
            'amount' => ['required','numeric'],
            'type' => ['required','numeric'],
            'charity' => [Rule::requiredIf(Gate::allows('super-admin')),'exists:charities,id'],
        ]);

        if (!Gate::allows('super-admin')) $validData['charity'] = Auth::user()->charity;

        //subtype support
        if ($request->has('subType') && $request->integer('subType') != 0) $validData['type'] = $request->integer('subType');

        $validData['type_pay'] = $validData['type'];
        unset($validData['type']);
        
        //date time convert to standard format
        if (trim($validData['start']) != "") $validData['start'] = CalendarUtils::createDatetimeFromFormat('Y-m-d H:i:s', CalendarUtils::convertNumbers($validData['start'],true));
        if (trim($validData['end']) != "") $validData['end'] = CalendarUtils::createDatetimeFromFormat('Y-m-d H:i:s', CalendarUtils::convertNumbers($validData['end'],true));

        return $validData;
    }
}
