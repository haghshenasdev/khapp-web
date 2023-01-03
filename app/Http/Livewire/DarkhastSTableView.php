<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
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
        $query = \App\Models\Darkhast::query()
            ->orderByDesc('id')
            ->join('darkhast_types', 'darkhasts.type','=','darkhast_types.id')
            ->join('darkhast_statuses','darkhasts.status','=','darkhast_statuses.id')
            ->select(['darkhasts.id','darkhasts.charity','darkhasts.description','darkhasts.created_at','darkhasts.updated_at','darkhasts.status','darkhast_types.title','darkhast_statuses.status_title']);

        if (Gate::allows('see-all-darkhasts')){
            return $query;
        }

        if (Gate::allows('see-charity-darkhasts')){
            return $query->where('darkhasts.charity',Auth::user()->charity);
        }

        return $query->where('user',Auth::id());
    }

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            Header::title('id')->sortBy('id'),
            Header::title('نوع')->sortBy('title'),
            'توضیحات',
            Header::title('وضعیت')->sortBy('status_title'),
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
            $model->description,
            $model->status_title,
        ];
    }
}
