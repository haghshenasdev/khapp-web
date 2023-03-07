<?php

namespace App\Http\Livewire\tables;

use App\Actions\ActivateOrDeactiveAction;
use App\Actions\DeleteAction;
use App\Actions\ShowAction;
use App\Http\Livewire\Current;
use App\queries\Queries;
use LaravelViews\Facades\UI;
use LaravelViews\Views\TableView;

class SlidersTable extends TableView
{
    /**
     * Sets a model class to get the initial data
     */
    protected function repository(): \Illuminate\Database\Eloquent\Builder
    {
        return Queries::getSliders(null,false);
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
            'عکس',
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
            UI::avatar($model->image),
        ];
    }

    protected function actionsByRow()
    {
        return [
            new ShowAction('showSlider'),
            new ActivateOrDeactiveAction('اسلاید','update-sliders'),
            new  DeleteAction('دکمه صفحه اصلی نرم افزار','delete-sliders'),
        ];
    }
}
