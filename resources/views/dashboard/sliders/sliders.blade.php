@extends('layouts.app')

@section('content')
    @include('layouts.toolbar-nav')
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">اسلایدر</div>

                <div class="card-body">
                    <a href="{{route('newSlider')}}" class="btn btn-outline-success">
                        افزودن اسلاید جدید
                    </a>

                    <div class="row">
                        <div class="col-12 col-lg">@livewire('tables.sliders-table')</div>

                        {{--phone--}}
                        <div class="col">
                            <div class="card">
                                <img class="w-100 card-img" src="/assets/app/dashboard/app_moucap.png" alt="" srcset="">
                                <div class="container text-center card-img-overlay">
                                    <div id="carouselExampleInterval" class="carousel slide mx-5" style="margin-top: 300px" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            @foreach($sliders as $slide)
                                            <div class="carousel-item active" data-bs-interval="10000">
                                                <img src="{{  $slide->image  }}" class="d-block w-100" alt="...">
                                            </div>
                                            @endforeach
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
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
