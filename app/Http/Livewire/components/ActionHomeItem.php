<?php

namespace App\Http\Livewire\components;

use App\classes\HomeItemActionHandeler\hiAction;
use App\classes\HomeItemActionHandeler\hiHandeler;
use Livewire\Component;

class ActionHomeItem extends Component
{
    public $hiActionlist;

    public string $data;

    public $selected;

    public $selectedData;

    public $firstLoad = true;

    public function render()
    {
        $this->hiActionlist = (new hiHandeler())->getList();

        if ($this->firstLoad){
            if (!isset($this->data)){
                $this->select(array_key_first($this->hiActionlist));
            }else{
                $data = json_decode($this->data);
                $this->selected = $data->fnName;
                $this->select($data->fnName);
                $this->selectedData = (array) $data->params;
            }
            $this->firstLoad = false;
        }

        return view('livewire.action-home-item');
    }

    public $params = null;

    public function select($classname)
    {
        $this->params = (new hiHandeler())->getObjAction($classname)->params;
    }
}
