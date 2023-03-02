<?php

namespace App\Charts;

use App\Models\Faktoor;
use App\queries\Queries;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use Illuminate\Support\Facades\Auth;
use Morilog\Jalali\Jalalian;

class CharityDaramadByMonthChart extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct()
    {
        $this->labels([
            'فروردین',
            'اردیبهشت',
            'خرداد',
            'تیر',
            'مرداد',
            'شهریور',
            'مهر',
            'آبان',
            'آذر',
            'دی',
            'بهمن',
            'اسفند',
        ]);
        $this->title("درآمد ماهیانه سال ".Jalalian::now()->getYear());

        $MonthDaramadSum = [];
        for ($i = 1; $i <= 12;$i++){
            $MonthDaramadSum[] = Queries::monthWhere(Faktoor::query()
                ->where('charity',Auth::user()->charity)
                ->where('is_pardakht',1),$i)->sum('amount');
        }
        $this->dataset('درآمد','line',$MonthDaramadSum);

        parent::__construct();
    }

}
