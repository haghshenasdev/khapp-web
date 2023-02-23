<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\DarkhastType;
use App\Models\Type;
use App\queries\Queries;
use App\Rules\CharityValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $DarkhastType = Queries::getAllDarkhastsTypes(false)->findOrFail($request->integer('id'));
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

        if ($validData['sub'] != null) DarkhastType::query()->findOrFail($validData['sub']);

        DarkhastType::query()->insert($validData);

        return redirect()->back()->with(['success' => 'نوع درخواست با موفقیت ایجاد شد .']);
    }

    public function delete(Request $request)
    {
        $type = DarkhastType::query()->findOrFail($request->integer('id'));
        if (Gate::allows('delete-darkhastType',$type)){
            $type->delete();
        }else{
            abort(403);
        }
        return redirect()->route('DarkhastType');
    }

    private function getValidator(Request $request): array
    {
        $validData = $request->validate([
            'title' => ['required','string'],
            'description' => ['string','nullable'],
            'sub' => ['required','numeric'],
            'optional_sub_select' => ['bool'],
            'default' => ['bool'],
            'charity' => [Rule::requiredIf(Gate::allows('super-admin')),'exists:charities,id',new CharityValidator()],
        ]);

        if (!Gate::allows('super-admin')) $validData['charity'] = Auth::user()->charity;

        if ($validData['sub'] == 0) $validData['sub'] = null;
        if (!$request->has('default')) $validData['default'] = null;
        if (!$request->has('optional_sub_select')) $validData['optional_sub_select'] = null;

        return $validData;
    }

}
