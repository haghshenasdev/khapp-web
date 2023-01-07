<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;

class ProjectsTableView extends TableView
{
    /**
     * Sets a model class to get the initial data
     */
    protected function repository()
    {
        if (Gate::allows('see-charity-projects')){
            return \App\Models\Project::query()->where('charity',Auth::user()->charity);
        }
        return \App\Models\Project::query()
            ->join('charities','projects.charity','=','charities.id')
            ->select(['projects.id','projects.title','projects.pishraft','projects.charity','charities.shortname']);
    }

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        $headers = [
            Header::title('id')->sortBy('id'),
            'عنوان',
            'پیشرفت پروژه',
        ];
        if (Gate::allows('see-all-projects')) $headers[] = 'خیریه';

        return $headers;
    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model Current model for each row
     */
    public function row($model): array
    {
        $rows = [
            $model->id,
            $model->title,
            $this->ShowprogressBarHtml($model->pishraft),
        ];
        if(Gate::allows('see-all-users')) $rows[] = $model->shortname;
        return $rows;
    }

    private function ShowprogressBarHtml($pishraft): string
    {
        return "<div class='progress'>
                <div class='progress-bar bg-danger' style='width: $pishraft%;' role='progressbar' aria-valuenow='$pishraft%' aria-valuemin='0' aria-valuemax='100'>$pishraft%</div>
              </div>";
    }
}
