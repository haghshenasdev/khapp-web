@extends('layouts.app')

@section('content')
    @include('layouts.toolbar-nav')
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">نوع پرداخت ها</div>

                <div class="card-body">
                    <a href="{{route('newPayType')}}" class="btn btn-outline-success">
                        افزودن نوع پرداخت جدید
                    </a>

                    @livewire('pay-type-table')

                </div>
            </div>

        </div>
    </div>
@endsection
