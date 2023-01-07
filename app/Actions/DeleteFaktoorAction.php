<?php

namespace App\Actions;

use App\Models\Faktoor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use LaravelViews\Actions\Action;
use LaravelViews\Actions\Confirmable;
use LaravelViews\Views\View;

class DeleteFaktoorAction extends Action
{
    use Confirmable;
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
        try {
            $faktoor = \App\Models\Faktoor::query()->findOrFail($model->id);
            if (Gate::allows('delete-faktoors',[$faktoor])){
                $faktoor->delete();
            }else{
                $this->error('شما دسترسی حذف این فاکتور را ندارید .');
            }

            $this->success('فاکتور با موفقیت حذف شد.');
        } catch (\Exception $exception){
            $this->error('خطا در حذف فاکتور . ' . $exception->getMessage());
        }
    }

    public function renderIf($item, View $view)
    {
        return Gate::allows('delete-faktoors',$item);
    }
}
