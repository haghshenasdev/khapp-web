@extends('layouts.app')

@section('content')
    @include('layouts.toolbar-nav')
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">پویش ها</div>

                <div class="card-body">
                    <a href="{{route('newHomeItem')}}" class="btn btn-outline-success">
                        افزودن دکمه جدید
                    </a>

                    <div class="row">
                        <div class="col-12 col-lg">@livewire('tables.home-items-table')</div>

                        {{--phone--}}
                        <div class="col">
                            <div class="card">
                                <img class="w-100 card-img" src="/assets/app/dashboard/app_moucap.png" alt="" srcset="">
                                <div class="container text-center card-img-overlay">
                                    <div class="row row-cols-4 mx-5" style="margin-top: 320px">
                                        @foreach($items as $item)
                                            <a href="{{ route('showHomeItem',['id' => $item->id])}}" class="card-link">
                                                <div class="col text-center">
                                                    <div class="bg-blue-800 p-1" style="border-radius: 20px">
                                                        <img src="{{ $item->icon }}">
                                                    </div>
                                                    <p class="small">{{ $item->title }}</p>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
