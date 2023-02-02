<?php

namespace App\Http\Controllers;

use App\Models\charity;
use App\Models\Faktoor;
use App\Models\Menu;
use App\Models\Type;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class Home extends Controller
{
    public function show()
    {
        return view('welcome');
    }

    public function showFK($sabtid)
    {
        $fk = Faktoor::query()->where('sabtid','=',$sabtid)
            ->join('types','faktoors.type','=','types.id')
            ->join('users','faktoors.userid','=','users.id')
            ->firstOrFail(['faktoors.*','types.title','types.description','users.name']);

        if (!is_null($fk->created_at)) $fk->created_at = Jalalian::fromDateTime($fk->created_at);
        if (!is_null($fk->updated_at)) $fk->updated_at = Jalalian::fromDateTime($fk->updated_at);

        return view('pay.verify', [
            'message' => $fk->is_pardakht ? 'فاکتور پرداخت شده است .' : 'فاکتور پرداخت نشده است .',
            'success' => $fk->is_pardakht,
            'charity' => charity::query()
                ->find($fk->charity, 'shortname')
                ->shortname,
            'data' => $fk,
        ]);
    }
}
