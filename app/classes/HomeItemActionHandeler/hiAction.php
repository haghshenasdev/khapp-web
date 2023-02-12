<?php

namespace App\classes\HomeItemActionHandeler;

use Illuminate\Http\Request;

abstract class hiAction
{
    public string $fName;

    public array $params;

    public string $actionTitle;

    public function toJson(): bool|string
    {
        return json_encode([
            'fnName' => $this->fName,
            'params' => $this->params
        ]);
    }

    public function validator(Request $request) : array
    {
        return [];
    }

    public function validateAndGetParams(Request $request)
    {
        $this->params = $this->validator($request);
    }
}
