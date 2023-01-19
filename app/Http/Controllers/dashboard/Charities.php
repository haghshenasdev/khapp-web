<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\CharitiesMeta;
use App\Models\charity;
use App\queries\Queries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class Charities extends Controller
{
    public function index()
    {
        return view('dashboard.charities.charities');
    }

    public function new()
    {
        return view('dashboard.charities.seCharity');
    }

    public function create(Request $request)
    {
        $validatedData = $this->getCharitiesValidator($request);

        $charityId = charity::query()->insertGetId(
            $this->getCharityDataFromRequest($validatedData)
        );

        CharitiesMeta::query()->insert(
            $this->getCharityMetaDataFromRequest($validatedData,$charityId)
        );

        return redirect(route('charities'));
    }

    public function update(Request $request)
    {
        $validatedData = $this->getCharitiesValidator($request);
        $ch = charity::query()->findOrFail($request->integer('id'));

        if(Gate::allows('update-charity',$ch)){
            $ch->update(
                $this->getCharityDataFromRequest($validatedData)
            );
            $ch->save();

            CharitiesMeta::query()->update(
                $this->getCharityMetaDataFromRequest($validatedData,$ch->id)
            );
            return redirect()->back();
        }else abort(403);
    }

    public function show(Request $request)
    {
        $validateData = $request->validate([
            'id' => 'required|numeric'
        ]);

        $charity = Queries::getCharityAndMetas()->findOrFail($validateData['id']);

        return view('dashboard.charities.seCharity',['data' => $charity]);
    }

    public function delete(Request $request)
    {
        $ch = charity::query()->findOrFail($request->integer('id'));
        if (Gate::allows('delete-charity',$ch)){
            $ch->delete();
            CharitiesMeta::query()->where('charity','=',$request->integer('id'))->delete();
            return redirect()->route('charities');
        }else{
            abort(403);
        }
    }

    private function getCharitiesValidator(Request $request): array
    {
        return $request->validate([
            'shortname' => ['required','string'],
            'fullname' => ['required','string'],
            'phone' => ['required'],
            'website' => ['url'],
            'about' => ['string'],
        ]);
    }

    private function getCharityDataFromRequest(array $validatedData,) : array
    {
        return [
            'shortname' => $validatedData['shortname'],
            'fullname' => $validatedData['fullname'],
            'is_active' => 1,
        ];
    }

    private function getCharityMetaDataFromRequest(array $validatedData,int $charityId): array
    {
        return [
            'charity' => $charityId,
            'phone' => $validatedData['phone'],
            'website' => $validatedData['website'],
            'about' => $validatedData['about'],
        ];
    }
}
