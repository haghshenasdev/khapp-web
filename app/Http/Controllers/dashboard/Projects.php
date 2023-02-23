<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\DarkhastType;
use App\Models\Project;
use App\queries\Queries;
use App\Rules\CharityValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Morilog\Jalali\CalendarUtils;

class Projects extends Controller
{
    public function index()
    {
        return view('dashboard.projects.projects');
    }

    public function show(Request $request)
    {

        $project = Queries::getProjects()->findOrFail($request->integer('id'));
        return view('dashboard.projects.seProjects',['data' => $project]);
    }

    public function update(Request $request)
    {
        $validData = $this->getValidator($request);

        $project = Project::query()->findOrFail($request->integer('id'));
        if (Gate::allows('update-projects',$project)){
            $project->update($validData);
        }else{
            abort(403);
        }

        return redirect()->back()->with(['success' => 'بروز رسانی با موفقیت انجام شد .']);
    }

    public function new()
    {
        return view('dashboard.projects.seProjects');
    }

    public function create(Request $request)
    {
        $validData = $this->getValidator($request);

        Project::query()->insert($validData);

        return redirect()->back()->with(['success' => 'پروژه با موفقیت ایجاد شد .']);
    }

    public function delete(Request $request)
    {
        $type = Project::query()->findOrFail($request->integer('id'));
        if (Gate::allows('delete-projects',$type)){
            $type->delete();
        }else{
            abort(403);
        }
        return redirect()->route('projects');
    }

    private function getValidator(Request $request): array
    {
        $validData = $request->validate([
            'pishraft' => ['required','numeric','max:100','min:0'],
            'title' => ['required','string'],
            'description' => ['required','string'],
            'image_head' => ['required','string'],
            'type' => [Rule::requiredIf(!$request->has('nullType')),'numeric'],
            'charity' => [Rule::requiredIf(Gate::allows('super-admin')),'exists:charities,id',new CharityValidator()],
        ]);

        if (!Gate::allows('super-admin')) $validData['charity'] = Auth::user()->charity;

        if ($request->has('nullType')){
            $validData['type'] = null;
        }else{
            //subtype support
            if ($request->has('subType') && $request->integer('subType') != 0) $validData['type'] = $request->integer('subType');
        }

        $validData['type_pay'] = $validData['type'];
        unset($validData['type']);
        $validData['slug'] = str_slug_persian($validData['title']);

        return $validData;
    }

}
