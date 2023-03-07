<?php

namespace App\Http\Controllers\dashboard;

use App\Models\User;
use App\queries\Queries;
use App\Rules\CharityValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class Sliders extends Dashboard
{
    public string $viewFolder = 'dashboard.sliders';
    public string $showAllTemplate = 'sliders';
    public string $oneTemplate = 'seSliders';
    public string $canUpdate = 'update-sliders';
    public string $canDelete = 'delete-sliders';
    public string $routeShowAll = 'Sliders';

    public function repository(): \Illuminate\Database\Eloquent\Builder
    {
        return \App\queries\Queries::getSliders(null,false);
    }

    public function index()
    {
        return view($this->viewFolder . '.' .$this->showAllTemplate,['sliders' => Queries::getSliders()->get('image')]);
    }

    public function getValidator(Request $request): array
    {
        $ruls =[
            'image' => ['required', 'url', 'regex:~^(?:https|http)://(?:[a-z0-9\-]+\.)+[a-z]{2,6}(?:/[^/#?]+)+\.(?:jpe?g|gif|png)$~'],
            'charity' => [Rule::requiredIf(Gate::allows('see-all-sliders')),'exists:charities,id',new CharityValidator()],
        ];

        $validData =  $request->validate($ruls);

        return $validData;
    }

}
