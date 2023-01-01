<?php

namespace App\Http\Livewire;

use App\Actions\DeleteFaktoorAction;
use App\Actions\PayFaktoorAction;
use App\Models\Faktoor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use LaravelViews\Facades\Header;
use LaravelViews\Facades\UI;
use LaravelViews\Views\TableView;

class FaktoorsTableView extends TableView
{
    /**
     * Sets a model class to get the initial data
     */
    //protected $model = Faktoor::class;

    protected function repository()
    {
        if (Gate::allows('super-admin')){
            return \App\Models\Faktoor::query()->orderByDesc('id');
        }

        if (Gate::allows('charity-admin') or Gate::allows('employee-admin')){
            return \App\Models\Faktoor::query()
                ->where('charity',Auth::user()->charity)
                ->orderByDesc('id');
        }

        return \App\Models\Faktoor::query()->where('userid',Auth::id())->orderByDesc('id');
    }

    protected $paginate = 20;



    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            Header::title('مبلغ')->sortBy('amount'),
            Header::title('شماره ثبت')->sortBy('sabtid'),
            Header::title('وضعیت پرداخت')->sortBy('is_pardakht'),
            'عملیات'
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
            $model->amount,
            $model->sabtid,
            $model->is_pardakht ? UI::icon('check', 'success') : UI::icon('x', 'danger'),
        ];
    }

    protected function actionsByRow(): array
    {
        return[
            new DeleteFaktoorAction(),
            new PayFaktoorAction(),
        ];
    }
}
