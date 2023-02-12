<?php

namespace App\Http\Livewire\tables;

use App\Actions\DeleteAction;
use App\Actions\PayFaktoorAction;
use App\Actions\ShowAction;
use App\Filters\CreatedDateTimeFilter;
use App\Filters\InvokedDateTimeFilter;
use App\Filters\InvokedFiletr;
use App\Filters\MonthFiletr;
use App\Filters\TypeFilter;
use App\Http\Livewire\Current;
use App\queries\Queries;
use Illuminate\Support\Facades\Gate;
use LaravelViews\Facades\Header;
use LaravelViews\Facades\UI;
use LaravelViews\Views\TableView;
use Morilog\Jalali\Jalalian;

class FaktoorsTableView extends TableView
{
    /**
     * Sets a model class to get the initial data
     */
    //protected $model = Faktoor::class;

    protected function repository()
    {
        return Queries::getFaktoors();
    }

    public $searchBy = ['amount', 'sabtid'];

    protected $paginate = 20;



    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        $headers = [
            Header::title('مبلغ')->sortBy('amount'),
            Header::title('شماره ثبت')->sortBy('sabtid'),
            'شماره تراکنش',
            Header::title('وضعیت پرداخت')->sortBy('is_pardakht'),
            Header::title('نوع')->sortBy('title'),
            Header::title('تاریخ پرداخت')->sortBy('updated_at'),
        ];
        if (Gate::allows('see-all-faktoors')
        or Gate::allows('see-charity-faktoors')) $headers[] = "کاربر";
        if (Gate::allows('see-all-faktoors')) $headers[] = "خیریه";


        $headers[] = 'عملیات';
        return $headers;
    }

    public $sortOrder = 'desc';

    public $sortBy = 'id';

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model Current model for each row
     */
    public function row($model): array
    {
        $rows = [
            number_format($model->amount),
            $model->sabtid,
            $model->ResNum,
            $model->is_pardakht ? UI::icon('check', 'success') : UI::icon('x', 'danger'),
            $model->title,
            is_null($model->updated_at) ? '' : Jalalian::fromDateTime($model->updated_at),
        ];
        if (Gate::allows('see-all-faktoors') or Gate::allows('see-charity-faktoors')) $rows[] = $model->name . '<br>' . $model->phone;
        if (Gate::allows('see-all-faktoors')) $rows[] = $model->shortname;
        return $rows;
    }

    protected function actionsByRow(): array
    {
        return[
            new PayFaktoorAction(),
            new DeleteAction('فاکتور','delete-faktoors'),
            new ShowAction('showfaktoor'),
        ];
    }

    protected function filters(): array
    {
        return [
            new MonthFiletr(),
            new InvokedFiletr(),
            new TypeFilter(),
            new CreatedDateTimeFilter(),
            new InvokedDateTimeFilter(),
        ];
    }
}
