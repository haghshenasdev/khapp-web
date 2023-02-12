<?php

namespace App\classes\HomeItemActionHandeler\Actions;

use App\classes\HomeItemActionHandeler\hiAction;
use Illuminate\Http\Request;

class OpenMyUrl extends hiAction
{
    public string $fName = 'OpenMyUrl';

    public string $actionTitle = 'بازکردن آدرس در سایت';

    public function __construct(string $url = null)
    {
        $this->params['url'] = $url;
    }

    public function validator(Request $request): array
    {
        return $request->validate([
            'url' => ['required','url']
        ]);
    }

}
