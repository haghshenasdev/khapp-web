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
            $this->amount = str_replace(',','',$this->amount);
        }
        $this->amount = number_format($this->amount);
    }
}
