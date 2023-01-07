@extends('layouts.app')

@section('content')
    @include('layouts.toolbar-nav')
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">خیریه جدید</div>

                <div class="card-body">

                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">نام کوتاه:</label>
                            <input type="text" class="form-control" id="recipient-name">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">نام کامل:</label>
                            <input type="text" class="form-control" id="recipient-name">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">تلفن تماس:</label>
                            <input type="text" class="form-control" id="recipient-name">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">وبسایت:</label>
                            <input type="text" class="form-control" id="recipient-name">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">ایمیل:</label>
                            <input type="text" class="form-control" id="recipient-name">
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">توضیحات :</label>
                            <textarea class="form-control" id="message-text"></textarea>
                        </div>
                        <butten class="btn btn-outline-success" type="submit">افزودن</butten>
                        <a href="{{route('charities')}}" class="btn btn-primary">بازگشت</a>

                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection
