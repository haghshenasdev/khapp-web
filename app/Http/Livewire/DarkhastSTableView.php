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
            ->join('darkhast_types', 'darkhasts.type','=','darkhast_types.id')
            ->join('darkhast_statuses','darkhasts.status','=','darkhast_statuses.id')
            ->select(['darkhasts.id','darkhasts.charity','darkhasts.description','darkhasts.created_at','darkhasts.updated_at','darkhasts.status','darkhast_types.title','darkhast_statuses.status_title']);

        if (Gate::allows('admin')){
            $adminQuery = $query
                ->join('users','darkhasts.user','=','users.id');

            if (Gate::allows('see-all-darkhasts')){
                return $adminQuery
                    ->join('charities','darkhasts.charity','=','charities.id')->addSelect(['charities.shortname'])
                    ->addSelect(['users.name']);
            }

            if (Gate::allows('see-charity-darkhasts')){
                return $adminQuery->where('darkhasts.charity',Auth::user()->charity);
            }
        }

        return $query->where('user',Auth::id());
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
        if (Gate::allows('see-charity-darkhasts') or Gate::allows('see-all-darkhasts')) $row[] = $model->name;
        return $row;
    }
}
