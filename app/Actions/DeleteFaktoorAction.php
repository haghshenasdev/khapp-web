<?php

namespace App\Actions;

use App\Models\Faktoor;
use LaravelViews\Actions\Action;
use LaravelViews\Views\View;

class DeleteFaktoorAction extends Action
{
    /**
     * Any title you want to be displayed
     * @var String
     * */
    public $title = "حذف";

    /**
     * This should be a valid Feather icon string
     * @var String
     */
    public $icon = "trash";

    /**
     * Execute the action when the user clicked on the button
     *
     * @param $model Model object of the list where the user has clicked
     * @param $view Current view where the action was executed from
     */
    public function handle($model, View $view)
    {
        \App\Models\Faktoor::find($model->id)->delete();
        $this->success('فاکتور با موفقیت حذف شد.');
    }
}
