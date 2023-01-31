<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AmountComponent extends Component
{
    public $amount;

    public function render()
    {
        $this->numberFormat();
        return view('livewire.amount-component');
    }

    private function numberFormat()
    {
        if (is_string($this->amount)){
            $this->amount = trim(str_replace(',','',$this->amount));
            if (!ctype_digit($this->amount) or $this->amount == '') $this->amount = 0;
        }
        $this->amount = number_format($this->amount);
    }
}
