@extends('layouts.app')

@section('content')
    @include('layouts.toolbar-nav')
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">درخواست ها</div>

                <div class="card-body">
                    <a href="{{route('newDarkhasts')}}" class="btn btn-outline-success">
                        افزودن درخواست جدید
                    </a>

                    @livewire('tables.darkhast-s-table-view')

                </div>
            </div>

        </div>
    </div>
@endsection
