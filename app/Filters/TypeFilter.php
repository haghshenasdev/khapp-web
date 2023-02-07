<?php

namespace App\Filters;

use App\queries\Queries;
use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Filters\Filter;

class TypeFilter extends Filter
{
    protected $title = 'نوع';

    /**
     * Modify the current query when the filter is used
     *
     * @param Builder $query Current query
     * @param $value Value selected by the user
     * @return Builder Query modified
     */
    public function apply(Builder $query, $value, $request): Builder
    {
        return $query->where('type', $value);
    }

    /**
     * Defines the title and value for each option
     *
     * @return Array associative array with the title and values
     */
    public function options(): Array
    {
        $types = Queries::getAllTypes()->get(['id','title']);
        $arrType = [];
        foreach ($types as $type){
            $arrType[$type->title] = $type->id;
        }
        return $arrType;
    }
}
