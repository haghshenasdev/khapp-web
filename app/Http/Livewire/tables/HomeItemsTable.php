<?php

namespace App\Http\Livewire\tables;

use App\Actions\ActivateOrDeactiveAction;
use App\Actions\DeleteAction;
use App\Actions\ShowAction;
use App\Http\Livewire\Current;
use App\queries\Queries;
use LaravelViews\Views\TableView;

class HomeItemsTable extends TableView
{
    /**
     * Sets a model class to get the initial data
     */
    protected function repository(): \Illuminate\Database\Eloquent\Builder
    {
        return Queries::getHomeItems(false);
    }

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            'عنوان',
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
            $model->title,
        ];
    }

    protected function actionsByRow()
    {
        return [
            new ShowAction('showHomeItem'),
            new ActivateOrDeactiveAction('دکمه صفحه اصلی نرم افزار','update-homeItems'),
            new  DeleteAction('دکمه صفحه اصلی نرم افزار','delete-homeItems'),
        ];
    }
}
