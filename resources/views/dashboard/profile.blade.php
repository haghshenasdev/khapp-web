@extends('layouts.app')

@section('content')
    @include('layouts.toolbar-nav')
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    پروفایل کاربر
                    @can('super-admin')
                        <span class="badge rounded-pill text-bg-primary">مدیر کل</span>
                    @elsecan('charity-admin')
                        <span class="badge rounded-pill text-bg-primary">مدیر خیریه</span>
                    @elsecan('employee-admin')
                        <span class="badge rounded-pill text-bg-primary">کارمند خیریه</span>
                    @endcan
                </div>

                <div class="card-body">


                </div>
            </div>

        </div>
    </div>
@endsection
