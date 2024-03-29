<?php

namespace App\classes\HomeItemActionHandeler\Actions;

use App\classes\HomeItemActionHandeler\hiAction;
use Illuminate\Http\Request;

class openPayment extends hiAction
{
    public string $fName = 'openPayment';

    public string $actionTitle = 'بازکردن صفحه پرداخت ها';

    public function __construct(string $type = null,string $title = null)
    {
        $this->params['type'] = $type;
        $this->params['title'] = $title;
    }

    public function vlidationRoules(): array
    {
        return [
            'type' => ['required','numeric'],
            'title' => ['required','string'],
        ];
    }
}
