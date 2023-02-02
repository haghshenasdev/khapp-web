<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\queries\Queries;
use Illuminate\Http\Request;
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
        if (Gate::allows('update-project',$project)){
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

        Project::query()->findOrFail($request->integer('id'))->update($validData);

        return redirect()->back()->with(['success' => 'پروژه با موفقیت ایجاد شد .']);
    }

    private function getValidator(Request $request): array
    {
        $validData = $request->validate([
            'pishraft' => ['required','numeric','max:100','min:0'],
            'title' => ['required','string'],
            'description' => ['required','string'],
            'image' => ['required','string'],
            'type' => [Rule::requiredIf(!$request->has('nullType')),'numeric'],
            'charity' => [Rule::requiredIf(Gate::allows('super-admin')),'exists:charities,id'],
        ]);

        $validData['image_head'] = $validData['image'];

        if ($request->has('nullType')){
            $validData['type'] = null;
        }else{
            //subtype support
            if ($request->has('subType') && $request->integer('subType') != 0) $validData['type'] = $request->integer('subType');
        }

        $validData['type_pay'] = $validData['type'];

        return $validData;
    }

}
