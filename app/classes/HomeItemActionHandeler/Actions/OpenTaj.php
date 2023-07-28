<?php

namespace App\classes\HomeItemActionHandeler\Actions;

use App\classes\HomeItemActionHandeler\hiAction;
use Illuminate\Http\Request;

class OpenTaj extends hiAction
{
    public string $fName = 'taj';

    public string $actionTitle = 'بازکردن صفحه تاج گل';

    public function __construct()
    {
        $this->params['null'] = "null";
    }

    public function vlidationRoules(): array
    {
        return [
        ];
    }

}
