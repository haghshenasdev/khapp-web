<?php

namespace App\Http\Livewire\components;

use App\queries\Queries;
use Livewire\Component;

class DarkhastType extends Component
{
    public $data = null;
    public $mainType = null;
    public $subTypeId = null;

    public $firstLoad = true;

    public $typedata = null;

    public function render()
    {
        if ($this->firstLoad){
            if ($this->data != null){
                $this->typedata = $dt = \App\Models\DarkhastType::query()->find($this->data);
                if ($dt->sub == null){
                    $this->mainType = $dt->id;
                }else{
                    $this->subTypeId = $dt->id;
                    $this->mainType = $dt->sub;
                    $dt = \App\Models\DarkhastType::query()->find($this->mainType);
                }
                if (!is_null($dt)) $this->showSub($dt,$dt->optional_sub_select);
            }else{
                $default = Queries::getDarkhastsTypes()->where('default',1)->first();
                if (is_null($default)) $default = Queries::getDarkhastsTypes()->first();
                $this->showSub($default,$default->optional_sub_select);
            }
            $this->firstLoad = false;
        }
        return view('livewire.type-component',[
            'types' => Queries::getDarkhastsTypes()->get(),
        ]);
    }

    public $subTypes = null;

    public $description = null;

    public $subDescription = null;

    public bool $optional_sub_select = false;

    public function showSub($type,$optional_sub_select)
    {
        $this->optional_sub_select = $optional_sub_select == 1;
        $this->subTypes = Queries::getDarkhastsTypes($type['id'])->get();
        $this->description = $type['description'];
    }

    public function subSelect($subType)
    {
        $this->subDescription = $subType['description'];
    }

    public function selectOther()
    {
        $this->subDescription = null;
    }
}
