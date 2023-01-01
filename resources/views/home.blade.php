@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">داشبورد</div>

                    <div class="card-body">
                        <div class="row m-5 text-center">
                            <div class="col m-2">مجموع کمک ها : {{$amar['sumAmount']}}</div>
                            <div class="col m-2">تعداد درخواست ها :{{$amar['countDarkhast']}}</div>
                            <div class="col m-2">ایتام تحت پوشش :</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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

        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">درخواست ها</div>

                    <div class="card-body">

                        @livewire('darkhast-s-table-view')

                    </div>
                </div>

            </div>
        </div>
        @can('see-users')
        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">کاربران</div>

                    <div class="card-body">
                        @livewire('users-table-view')
                    </div>
                </div>

            </div>
        </div>
        @endif

    </div>
    @laravelViewsScripts
@endsection
