<?php

namespace App\Http\Livewire;

use App\Actions\ActivateOrDeactiveAction;
use App\Actions\DeleteAction;
use App\Actions\ShowAction;
use App\queries\Queries;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use LaravelViews\Views\TableView;
use Morilog\Jalali\Jalalian;

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
            $model->title,
            number_format($model->amount),
            ($model->start == null) ? 'ندارد' : Jalalian::fromDateTime($model->start),
            ($model->end == null) ? 'ندارد' : Jalalian::fromDateTime($model->end),
        ];
    }

    protected function actionsByRow()
    {
        return [
            new ActivateOrDeactiveAction('پویش','update-pooyesh'),
            new ShowAction('showPooyeshes'),
            new DeleteAction('پویش','delete-pooyesh'),
        ];
    }
}
