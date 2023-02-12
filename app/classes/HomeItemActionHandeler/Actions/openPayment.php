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

    public function validator(Request $request): array
    {
        return $request->validate([
            'type' => ['required','numeric'],
            'title' => ['string'],
        ]);
    }
}
