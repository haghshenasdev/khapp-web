@extends('layouts.app')

@section('content')
    @include('layouts.toolbar-nav')
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">خیریه {{$charity->shortname}}</div>
                        @include('layouts.back-btn')
                    </div>
                </div>

                <div class="card-body">

                </div>
            </div>

        </div>
    </div>
@endsection
