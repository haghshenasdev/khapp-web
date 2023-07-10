<?php

namespace App\classes\HomeItemActionHandeler\Actions;

use App\classes\HomeItemActionHandeler\hiAction;
use Illuminate\Http\Request;

class OpenTaj extends hiAction
{
    public string $fName = 'OpenMyUrl';

    public string $actionTitle = 'بازکردن صفحه تاج گل';

    public function __construct()
    {
    }

    public function vlidationRoules(): array
    {
        return [
        ];
    }

}
