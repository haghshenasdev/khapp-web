<?php

namespace App\Actions;

use App\Models\CharitiesMeta;
use Illuminate\Support\Facades\Gate;
use LaravelViews\Views\View;

class DeleteCharity extends DeleteAction
{
    public function handle($model, View $view)
    {
        if (Gate::allows('super-admin')){
            $model->delete();
            CharitiesMeta::query()->where('charity',$model->id)->delete();
            $this->success("$this->title_text مورد نظر حذف شد!");
        }else{
            $this->error('شما دسترسی این کار را ندارید!');
        }
    }

    public function getConfirmationMessage($item = null): string
    {
        return "آیا از حذف $item->shortname اطمینان دارید ؟ "." با این کار تمام اطلاعات این خیریه پاک می شود و قابل بازیابی نیستند . ترجیحا آن را غیر فعال کنید.";
    }
}
