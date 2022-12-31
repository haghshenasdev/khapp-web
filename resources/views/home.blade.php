@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">داشبورد</div>

                    <div class="card-body">
                        <div class="row m-5 text-center">
                            <div class="col bg-info rounded-2 m-2">مجموع کمک ها : {{$amar['sumAmount']}}</div>
                            <div class="col bg-info rounded-2 m-2">تعداد درخواست ها :{{$amar['countDarkhast']}}</div>
                            <div class="col bg-info rounded-2 m-2">ایتام تحت پوشش :</div>
                        </div>

                        <form action="{{route('logout')}}" method="post">
                            @csrf
                            <input class="btn btn-danger text-red-700" type="submit" value="خروج از حساب کاربری">
                        </form>
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

                        <table class="table">
                            <tr>
                                <th>آیدی</th>
                                <th>نوع</th>
                                <th>توضیحات</th>
                                <th>وضعیت</th>
                            </tr>
                            @foreach($darkhasts as $darkhast)
                                <tr>
                                    <td>{{$darkhast->id}}</td>
                                    <td>{{$darkhast->title}}</td>
                                    <td>{{$darkhast->description}}</td>
                                    <td>{{$darkhast->status_title}}</td>
                                </tr>
                            @endforeach
                        </table>

                        @if(count($darkhasts) == 0)
                            <h3 class="text-center">هیچ درخواستی وجود ندارد!</h3>
                        @endif
                    </div>
                </div>

            </div>
        </div>

        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">کاربران</div>

                    <div class="card-body">
                        @livewire('faktoors-table-view')
                    </div>
                </div>

            </div>
        </div>

    </div>
    @laravelViewsScripts
@endsection
