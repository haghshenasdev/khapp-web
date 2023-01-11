<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use LaravelViews\Views\TableView;

class PooyeshesTableView extends TableView
{
    /**
     * Sets a model class to get the initial data
     */
    protected function repository()
    {
        if (Gate::allows('see-charity-pooyesh')){
            return \App\Models\Pooyesh::query()->where('charity',Auth::user()->charity);
        }
        return \App\Models\Pooyesh::query()
            ->join('charities','pooyeshes.charity','=','charities.id')
            ->select(['pooyeshes.id','pooyeshes.title','pooyeshes.amount','pooyeshes.charity','pooyeshes.start','pooyeshes.end','charities.shortname']);
    }

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            'id',
            'عنوان',
            'مبلغ',
            'شروع',
            'پایان',
        ];
    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model Current model for each row
     */
    public function row($model): array
    {
        return [
            $model->id,
            $model->title,
            number_format($model->amount),
            ($model->start == null) ? 'ندارد' : $model->start->diffforHumans(),
            ($model->end == null) ? 'ندارد' : $model->end->diffforHumans(),
        ];
    }
}
