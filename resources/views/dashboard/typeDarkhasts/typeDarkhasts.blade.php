@extends('layouts.app')

@section('content')
    @include('layouts.toolbar-nav')
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">نوع درخواست ها</div>

                <div class="card-body">
                    <a href="{{route('newDarkhastType')}}" class="btn btn-outline-success">
                        افزودن نوع درخواست جدید
                    </a>

                    @livewire('darkhast-type-table')

                </div>
            </div>

        </div>
    </div>
@endsection
