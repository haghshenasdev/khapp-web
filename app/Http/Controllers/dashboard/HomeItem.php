<?php

namespace App\Http\Controllers\dashboard;

use App\classes\HomeItemActionHandeler\hiHandeler;
use App\Http\Controllers\Controller;
use App\Models\homeItems;
use App\queries\Queries;
use App\Rules\CharityValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class HomeItem extends Controller
{
    public function index()
    {
        return view('dashboard.homeItems.HomeItems',['items' => Queries::getHomeItems()->get(['id','title','icon'])]);
    }

    public function show(Request $request)
    {

        $homeItem = Queries::getHomeItems()->findOrFail($request->integer('id'));
        $homeItem['image'] = $homeItem['icon'];
        return view('dashboard.homeItems.seHomeItems',['data' => $homeItem]);
    }

    public function update(Request $request)
    {
        $validData = $this->getValidator($request);

        $homeItems = \App\Models\HomeItem::query()->findOrFail($request->integer('id'));
        if (Gate::allows('update-homeItems',$homeItems)){
            $homeItems->update($validData);
        }else{
            abort(403);
        }

        return redirect()->back()->with(['success' => 'بروز رسانی با موفقیت انجام شد .']);
    }

    public function new()
    {
        return view('dashboard.homeItems.seHomeItems');
    }

    public function create(Request $request)
    {
        $validData = $this->getValidator($request);

        //insert data
        \App\Models\HomeItem::query()->insert($validData);

        return redirect()->back()->with(['success' => 'دکمه با موفقیت ایجاد شد .']);
    }

    public function delete(Request $request)
    {
        $type = \App\Models\HomeItem::query()->findOrFail($request->integer('id'));
        if (Gate::allows('delete-homeItems',$type)){
            $type->delete();
        }else{
            abort(403);
        }
        return redirect()->route('HomeItems');
    }

    private function getValidator(Request $request)
    {
        $validData = $request->validate([
            'image' => ['required'],
            'title' => ['required','string'],
            'action' => ['required','string'],
            'charity' => [Rule::requiredIf(Gate::allows('super-admin')),'exists:charities,id',new CharityValidator()],
        ]);

        $validData['icon'] = $validData['image'];
        unset($validData['image']);

        //item action handle
        $hiAction = (new hiHandeler)->getObjAction($validData['action']);
        $this->validateWith($hiAction->validateAndGetParams($request));
        $validData['action'] = $hiAction->toJson();

        if (!Gate::allows('super-admin')) $validData['charity'] = Auth::user()->charity;

        return $validData;
    }
}
