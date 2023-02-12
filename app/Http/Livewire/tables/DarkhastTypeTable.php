<?php

namespace App\Http\Livewire\tables;

use App\Actions\ActivateOrDeactiveAction;
use App\Actions\DeleteAction;
use App\Actions\ShowAction;
use App\Http\Livewire\Current;
use App\Models\charity;
use App\queries\Queries;
use Illuminate\Support\Facades\Gate;
use LaravelViews\Views\TableView;

class DarkhastTypeTable extends TableView
{
    /**
     * Sets a model class to get the initial data
     */
    protected function repository()
    {
        return Queries::getAllDarkhastsTypes(false);
    }

    public $searchBy = ['title', 'id'];

    public $sortOrder = 'desc';

    public $sortBy = 'id';

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        $headers = [
            'id',
            'عنوان',
            'زیر مجموعه',
        ];

        if (Gate::allows('see-all-darkhastType')) $headers[] = 'خیریه';
        return $headers;
    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model Current model for each row
     */
    public function row($model): array
    {
        $row = [
            $model->id,
            $model->title,
            is_null($model->sub) ? 'اصلی' : $model->sub,
        ];
        if (Gate::allows('see-all-darkhastType')) $row[] = charity::query()->find($model->charity,['shortname'])->shortname;
        return $row;
    }

    protected function actionsByRow()
    {
        return [
            new ActivateOrDeactiveAction('نوع درخواست','update-darkhastType'),
            new ShowAction('showDarkhastType'),
            new DeleteAction('نوع درخواست','delete-darkhastType'),
        ];
    }
}
