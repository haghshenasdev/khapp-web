<?php

namespace App\Models;

use App\Models\Traits\CahrityFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pooyesh extends Model
{
    use HasFactory;

    protected $table = 'pooyeshes';

    protected $hidden = ['is_active','charity','id'];

    public function AllByCharity($charity): \Illuminate\Database\Eloquent\Collection
    {
        return $this->all()->where('charity',$charity)->where('is_active',1);
    }

}
