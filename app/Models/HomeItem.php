<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeItem extends Model
{
    use HasFactory;

    protected $hidden = ['is_active','charity','id'];

    public function AllByCharity($charity): \Illuminate\Database\Eloquent\Collection
    {
        return $this->all()->where('charity',$charity)->where('is_active',1);
    }

}
