@extends('layouts.app')

@section('content')
    @include('layouts.toolbar-nav')
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">خیریه ها</div>

                <div class="card-body">
                    <a href="{{route('newCharity')}}" class="btn btn-outline-success">
                        افزودن خیریه جدید
                    </a>

                    @livewire('charities-table-view')

                </div>
            </div>

        </div>
    </div>
@endsection
<script>
    import DangerButton from "@/Components/DangerButton";
    export default {
        components: {DangerButton}
    }
</script>
