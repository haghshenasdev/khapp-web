<?php

namespace App\Charts;

use App\Models\Faktoor;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class CharityDaramadChart extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct($charities,$names)
    {
        $daramad = [];
        foreach ($charities as $charity){
            $fk = Faktoor::query()->where('charity',$charity->id)->where('is_pardakht',1);
            $daramad[] = $fk->sum('amount');
        }

        $this->labels($names);
        $this->dataset('کل درآمد', 'bar', $daramad)->backgroundColor('#6a994e');
        $this->title('درآمد خیریه ها');

        parent::__construct();
    }
}
