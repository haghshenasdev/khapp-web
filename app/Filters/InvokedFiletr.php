<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Filters\BooleanFilter;

class InvokedFiletr extends BooleanFilter
{
    protected $title = 'وضعیت پرداخت';
    /**
     * Modify the current query when the filter is used
     *
     * @param Builder $query Current query
     * @param Array $value Associative array with the boolean value for each of the options
     * @return Builder Query modified
     */
    public function apply(Builder $query, $value): Builder
    {
        if ($value['is_pardakht']){
            return $query->where('is_pardakht', true);
        }
        if ($value['not_pardakht']){
            return $query->where('is_pardakht', false);
        }
        return $query;
    }

    /**
     * Defines the title and value for each option
     *
     * @return Array associative array with the title and values
     */
    public function options(): Array
    {
        return [
            'پرداخت شده' => 'is_pardakht',
            'پرداخت نشده' => 'not_pardakht',
        ];
    }
}
