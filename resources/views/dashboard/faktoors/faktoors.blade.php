@extends('layouts.app')

@section('content')
    @include('layouts.toolbar-nav')
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">فاکتور ها</div>

                <div class="card-body">

                    <button onclick="window.open('{{ route('printfaktoors') }}' + window.location.search,'_blank')" class="btn btn-outline-primary">چاپ</button>

                    @livewire('faktoors-table-view')
                </div>
            </div>

        </div>
    </div>
@endsection
