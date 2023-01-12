<?php

namespace App\Http\Livewire;

use App\Actions\ShowAction;
use App\queries\Queries;
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
        return Queries::getPooyeshes();
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

    protected function actionsByRow()
    {
        return [
            new ShowAction('showPooyeshes'),
        ];
    }
}
