<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AmountComponent extends Component
{
    public $amount;

    public $amountFormat = 0;

    public function render()
    {
        $this->numberFormat();
        return view('livewire.amount-component');
    }

    private function numberFormat()
    {
        if (is_string($this->amountFormat)){
            $this->amountFormat = trim(str_replace(',','',$this->amountFormat));
            if (!ctype_digit($this->amountFormat) or $this->amountFormat == '') $this->amountFormat = $this->amount = 0;
        }
        $this->amount = $this->amountFormat;
        $this->amountFormat = number_format($this->amount);
    }
}
