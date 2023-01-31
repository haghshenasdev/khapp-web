<?php

namespace App\Actions;

class AOrDCharity extends ActivateOrDeactiveAction
{

    public function getConfirmationMessage($item = null): string
    {
        $acOrDe = ($item->is_active) ? "غیر فعال" : "فعال";
        return "آیا از ".$acOrDe." کردن ".$item->shortname." اطمینان دارید ؟ ";
    }
}
