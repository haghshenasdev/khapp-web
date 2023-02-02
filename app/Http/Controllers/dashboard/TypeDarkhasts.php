<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\DarkhastType;
use App\queries\Queries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Morilog\Jalali\CalendarUtils;

class TypeDarkhasts extends Controller
{
    public function index()
    {
        return view('dashboard.typeDarkhasts.typeDarkhasts');
    }

    public function show(Request $request)
    {

        $DarkhastType = Queries::getAllDarkhastsTypes()->findOrFail($request->integer('id'));
        return view('dashboard.typeDarkhasts.setypeDarkhasts',['data' => $DarkhastType,'types' => Queries::getDarkhastsTypes()->get(['id','title','description','sub'])]);
    }

    public function update(Request $request)
    {
        $validData = $this->getValidator($request);

        $DarkhastType = DarkhastType::query()->findOrFail($request->integer('id'));
        if (Gate::allows('update-darkhastType',$DarkhastType)){
            $DarkhastType->update($validData);
        }else{
            abort(403);
        }

        return redirect()->back()->with(['success' => 'بروز رسانی با موفقیت انجام شد .']);
    }

    public function new()
    {
        return view('dashboard.typeDarkhasts.setypeDarkhasts',['types' => Queries::getDarkhastsTypes()->get(['id','title','description','sub'])]);
    }

    public function create(Request $request)
    {
        $validData = $this->getValidator($request);

        DarkhastType::query()->findOrFail($request->integer('id'))->update($validData);

        return redirect()->back()->with(['success' => 'نوع درخواست با موفقیت ایجاد شد .']);
    }

    private function getValidator(Request $request): array
    {
        $validData = $request->validate([
            'title' => ['required','string'],
            'description' => ['required','string'],
            'type' => [Rule::requiredIf(!$request->has('nullType')),'numeric'],
            'charity' => [Rule::requiredIf(Gate::allows('super-admin')),'exists:charities,id'],
        ]);

        return $validData;
    }

}
