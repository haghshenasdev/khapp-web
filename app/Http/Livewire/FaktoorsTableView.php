<?php

namespace App\Http\Livewire;

use App\Actions\DeleteAction;
use App\Actions\DeleteFaktoorAction;
use App\Actions\PayFaktoorAction;
use App\Actions\ShowAction;
use App\Models\Faktoor;
use App\queries\Queries;
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
            Header::title('وضعیت پرداخت')->sortBy('is_pardakht'),
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
            $model->is_pardakht ? UI::icon('check', 'success') : UI::icon('x', 'danger'),
        ];
        if (Gate::allows('see-all-faktoors') or Gate::allows('see-charity-faktoors')) $rows[] = $model->name;
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
}
