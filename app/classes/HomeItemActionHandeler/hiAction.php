<?php

namespace App\classes\HomeItemActionHandeler;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

abstract class hiAction
{
    public string $fName;

    public array|null $params = null;

    public string $actionTitle;

    public function toJson(): bool|string
    {
        return json_encode([
            'fnName' => $this->fName,
            'params' => $this->params
        ]);
    }

    public function vlidationRoules() : array
    {
        return [];
    }

    public function validateAndGetParams(Request $request)
    {
        $obj = Validator::make($this->GetHIParamsFromRequest($request),$this->vlidationRoules());
        $this->params = $obj->getData();
        return $obj;
    }

    private function GetHIParamsFromRequest(Request $request)
    {
        $params = [];
        foreach ($request->all() as $key => $value){
            if (str_starts_with($key,'hi-prop-')) {
                $params[str_replace('hi-prop-','',$key)] = $value;
            }
        }

        return $params;
    }
}
