<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Date;
use LaravelViews\Filters\Filter;
use Morilog\Jalali\Jalalian;

class MonthFiletr extends Filter
{
    protected $title = 'فیلتر بر اساس ماه';

    /**
     * Modify the current query when the filter is used
     *
     * @param Builder $query Current query
     * @param $value Value selected by the user
     * @return Builder Query modified
     */
    public function apply(Builder $query, $value, $request): Builder
    {
        if (is_null($value)) return $query;

        if ($value == 'current') return $this->monthWhere($query,date('n'));
        if ($value == 'before') return $this->monthWhere($query,date('n') - 1);

        return $this->monthWhere($query,$value);
    }

    private function monthWhere(Builder $query,$val)
    {
        return $query->whereMonth('faktoors.created_at', $val);
    }

    /**
     * Defines the title and value for each option
     *
     * @return Array associative array with the title and values
     */
    public function options(): Array
    {
        return [
            'این ماه' => 'current',
            'ماه قبل' => 'before',
            'فروردین' => '1',
            'اردیبهشت' => '2',
            'خرداد' => '3',
            'تیر' => '4',
            'مرداد' => '5',
            'شهریور' => '6',
            'مهر' => '7',
            'آبان' => '8',
            'آذر' => '9',
            'دی' => '10',
            'بهمن' => '11',
            'اسفند' => '12',
        ];
    }
}
