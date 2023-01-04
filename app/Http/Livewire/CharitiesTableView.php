<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use LaravelViews\Facades\UI;
use LaravelViews\Views\TableView;

class CharitiesTableView extends TableView
{
    /**
     * Sets a model class to get the initial data
     */
    protected function repository()
    {
        return \App\Models\charity::query()
            ->orderByDesc('id');
    }

    public $searchBy = ['shortname', 'fullname'];

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
            'وضعیت',
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
            $model->is_active ? UI::icon('check', 'success') : UI::icon('x', 'danger')
        ];
    }
}
