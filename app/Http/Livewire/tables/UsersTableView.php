<?php

namespace App\Http\Livewire\tables;

use App\Actions\ActivateOrDeactiveAction;
use App\Actions\DeleteAction;
use App\Actions\ShowAction;
use App\Http\Livewire\Current;
use App\queries\Queries;
use Illuminate\Support\Facades\Gate;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;
use Morilog\Jalali\Jalalian;

class UsersTableView extends TableView
{
    /**
     * Sets a model class to get the initial data
     */
    protected function repository()
    {
        return Queries::getUsers();
    }

    public $searchBy = ['name', 'email', 'phone'];

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
            'نام',
            'ایمیل',
            'تلفن',
            'تاریخ ثبت نام',
            'سطح دسترسی',
        ];
        if (Gate::allows('see-all-users')) $headers[] = 'خیریه';

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
            $model->name,
            $model->email,
            $model->phone,
            Jalalian::fromDateTime($model->created_at),
            $this->getAccessLevelString($model->access_level),
        ];
        if(Gate::allows('see-all-users')) $row[] = $model->shortname;

        return $row;
    }

    private function getAccessLevelString($accessInt): string
    {
        return match ($accessInt) {
            0 => 'مدیر کل',
            1 => 'مدیر خیریه',
            2 => 'کارمند خیریه',
            default => 'کاربر',
        };
    }

    protected function actionsByRow()
    {
        return [
            new ShowAction('showUser'),
//            new ActivateOrDeactiveAction('کاربر','update-user'),
            new DeleteAction('کاربر','delete-user')
        ];
    }
}
