<?php

namespace App\Http\Livewire\tables;

use App\Actions\DeleteAction;
use App\Actions\ShowAction;
use App\Http\Livewire\Current;
use App\queries\Queries;
use Illuminate\Support\Facades\Gate;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;

class DarkhastSTableView extends TableView
{
    /**
     * Sets a model class to get the initial data
     */
    protected function repository()
    {
        return Queries::getDrakhasts();
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
            Header::title('id')->sortBy('id'),
            Header::title('نوع')->sortBy('title'),
            'توضیحات',
            Header::title('وضعیت')->sortBy('status_title'),
        ];
        if (Gate::allows('see-all-darkhasts')) $headers[] = 'خیریه';
        if (Gate::allows('see-charity-darkhasts') or Gate::allows('see-all-darkhasts')) $headers[] = 'کاربر';
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
            $model->description,
            $model->status_title,
        ];
        if (Gate::allows('see-all-darkhasts')) $row[] = $model->shortname;
        if (Gate::allows('see-charity-darkhasts') or Gate::allows('see-all-darkhasts')) $row[] = $model->name . '<br>' . $model->phone;
        return $row;
    }

    protected function actionsByRow()
    {
        return [
            new ShowAction('showDarkhasts'),
            new DeleteAction('درخواست','delete-darkhasts'),
        ];
    }
}
