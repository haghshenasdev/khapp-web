<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use LaravelViews\Facades\Header;
use LaravelViews\Views\TableView;

class UsersTableView extends TableView
{
    /**
     * Sets a model class to get the initial data
     */
    protected function repository()
    {
        if (Gate::allows('charity-admin')){
            return \App\Models\User::query()
                ->where('charity',Auth::user()->charity)
                ->orderByDesc('id');
        }

        return \App\Models\User::query()->orderByDesc('id');
    }

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            Header::title('id')->sortBy('id'),
            'نام',
            'ایمیل',
            'تلفن',
            'تاریخ ثبت نام',
            'خیریه',
            'سطح دسترسی',
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
            $model->id,
            $model->name,
            $model->email,
            $model->phone,
            $model->created_at,
            $model->charity,
            $this->getAccessLevelString($model->access_level),
        ];
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
}
