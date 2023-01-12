@extends('layouts.app')

@section('content')
    @include('layouts.toolbar-nav')
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">پویش ها</div>

                <div class="card-body">

                    @livewire('pooyeshes-table-view')

                </div>
            </div>

        </div>
    </div>
@endsection
