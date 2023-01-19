<?php

namespace App\Actions;

use App\Models\CharitiesMeta;
use Illuminate\Support\Facades\Gate;
use LaravelViews\Actions\Action;
use LaravelViews\Actions\Confirmable;
use LaravelViews\Views\View;

class DeleteCharityAction extends Action
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
        if (Gate::allows('super-admin')){
            $model->delete();
            CharitiesMeta::query()->where('charity',$model->id)->delete();
            $this->success('خیریه مورد نظر حذف شد!');
        }
    }

    public function getConfirmationMessage($item = null): string
    {
        return "آیا از حذف $item->shortname اطمینان دارید ؟ "." با این کار تمام اطلاعات این خیریه پاک می شود و قابل بازیابی نیستند . ترجیحا آن را غیر فعال کنید.";
    }

}
