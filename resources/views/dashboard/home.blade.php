@extends('layouts.app')

@section('content')
    @include('layouts.toolbar-nav')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">داشبورد</div>

                    <div class="card-body">
                        <div class="row m-5 text-center">
                            <div class="col m-2">مجموع کمک ها : {{number_format($amar['sumAmount'],0,'.',',')}}</div>
                            <div class="col m-2">تعداد درخواست ها :{{$amar['countDarkhast']}}</div>
                            <div class="col m-2">ایتام تحت پوشش :</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @can('see-charities')
        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">آمار خیریه ها</div>

                    <div class="card-body">

                    </div>
                </div>

            </div>
        </div>
        @endcan

        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">فاکتور ها</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                            @livewire('faktoors-table-view')
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
