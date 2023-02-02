<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PhotoPreview extends Component
{
    public $image;

    public $url;

    public function render()
    {
        return view('livewire.photo-preview');
    }

    public function show()
    {
        if (str_starts_with($this->url,'/')) $this->url = url($this->url);
        $this->image = $this->url;
    }
}
