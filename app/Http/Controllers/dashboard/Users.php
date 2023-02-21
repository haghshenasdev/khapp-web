<?php

namespace App\Http\Controllers\dashboard;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class Users extends Dashboard
{
    public string $viewFolder = 'dashboard.users';
    public string $showAllTemplate = 'users';
    public string $oneTemplate = 'seUser';
    public string $canUpdate = 'update-user';
    public string $canDelete = 'delete-user';
    public string $routeShowAll = 'users';

    public function repository(): \Illuminate\Database\Eloquent\Builder
    {
        return \App\queries\Queries::getUsers();
    }

    public function update(Request $request)
    {
        $validData = $this->getValidator($request,false);

        $item = $this->repository()->findOrFail($request->integer('id'));
        if (Gate::allows($this->canUpdate,$item)){
            $item->update($validData);
        }else{
            abort(403);
        }

        return redirect()->back()->with(['success' => 'بروز رسانی با موفقیت انجام شد .']);
    }

    public function getValidator(Request $request,$forCreate = true): array
    {
        $ruls =[
            'name' => ['required', 'string', 'max:255'],
            'address' => ['string','nullable'],
            'access_level' => ['required','numeric'],
            'phone' => ['unique:'.User::class,'required','regex:/(09)[0-9]{9}/','digits:11','numeric'],
            'email' => ['unique:'.User::class,'string', 'email', 'max:255'],
            'charity' => [Rule::requiredIf(Gate::allows('see-all-users')),'exists:charities,id'],
            'password' => [Rule::requiredIf($forCreate), 'confirmed']
        ];

        // for updating , جلوگیری از تداخل یونیک بودن
        if (!$forCreate){
            $u = User::query()->find($request->integer('id'),['phone','email']);

            if ($u->phone == $request->get('phone')) unset($ruls['phone'][0]);
            if ($u->email == $request->get('email')) unset($ruls['email'][0]);
        }

        $validData =  $request->validate($ruls);
        if (!Gate::allows('see-all-users')) $validData['charity'] = Auth::user()->charity;

        // access_level validator
        switch ($validData['access_level']){
            case 0:
                abort_if(!Gate::allows('super-admin'),403);
                break;
            case 2:
            case 1:
                abort_if((!Gate::allows('charity-admin') and !Gate::allows('super-admin')),403);
                break;
            default :
                $validData['access_level'] = null;
        }

        //pass hash
        if ($request->has('password')) $validData['password'] = Hash::make($validData['password']);

        return $validData;
    }

}
