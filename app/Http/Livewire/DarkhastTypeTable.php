<?php

namespace App\Http\Livewire;

use App\Actions\ActivateOrDeactiveAction;
use App\Actions\DeleteAction;
use App\Actions\ShowAction;
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
        return Queries::getAllDarkhastsTypes();
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
