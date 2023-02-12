<?php

namespace App\Http\Livewire\tables;

use App\Actions\AOrDCharity;
use App\Actions\DeleteAction;
use App\Actions\ShowAction;
use App\Http\Livewire\Current;
use App\queries\Queries;
use LaravelViews\Views\TableView;

class CharitiesTableView extends TableView
{
    /**
     * Sets a model class to get the initial data
     */
    protected function repository()
    {
        return Queries::getCharities();
    }

    public $searchBy = ['shortname', 'fullname'];

    public $sortOrder = 'desc';

    public $sortBy = 'id';

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            'id',
            'نام کوتاه',
            'نام کامل',
            'عملیات',
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
            $model->shortname,
            $model->fullname,
        ];
    }

    protected function actionsByRow()
    {
        return [
            new AOrDCharity('خیریه',null),
            new DeleteAction('خیریه',null),
            new ShowAction('showCharity'),
        ];
    }
}
