<?php

namespace App\Charts;

use App\Models\Faktoor;
use App\Models\User;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class CharityPayment extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct($charities,$names)
    {
        $fkCount = [];
        $userCount = [];
        foreach ($charities as $charity){
            $fk = Faktoor::query()->where('charity',$charity->id);
            $fkCount[] = $fk->count();
            $userCount[] = User::query()->where('charity',$charity->id)->count();
        }
        $this->labels($names);
        $this->dataset('کاربر', 'bar', $userCount)->backgroundColor('#219ebc');
        $this->dataset('فاکتور', 'bar', $fkCount)->backgroundColor('#8ecae6');
        $this->title('آمار خیریه ها');

        parent::__construct();
    }
}
