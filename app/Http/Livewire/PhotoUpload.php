<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class PhotoUpload extends Component
{
    use WithFileUploads;

    public $photo;
    public $urlphoto;

    public $url;

    public $imageAddress;

    public function updatedPhoto()
    {

        $this->validate([

            'photo' => 'image|max:1024',

        ]);

    }

    public function urlphotoPreview()
    {
        $this->photo = $this->urlphoto = null;
        $this->validate([

            'url' => 'url',

        ]);
        $this->urlphoto = $this->url;
    }

    public function render()
    {
        return view('livewire.photo-upload');
    }

    public function add()
    {
        $this->urlphotoPreview();
        $this->imageAddress = $this->urlphoto;
    }
}
