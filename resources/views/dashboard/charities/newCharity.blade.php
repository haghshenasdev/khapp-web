@extends('layouts.app')

@section('content')
    @include('layouts.toolbar-nav')
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">خیریه جدید</div>

                <div class="card-body">

                    <form method="post">
                        @csrf

                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">نام کوتاه:</label>
                            <input name="shortname" type="text" class="form-control" id="recipient-name">
                        </div>
                        @error('shortname')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">نام کامل:</label>
                            <input name="fullname" type="text" class="form-control" id="recipient-name">
                        </div>
                        @error('fullname')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">تلفن تماس:</label>
                            <input name="phone" type="text" class="form-control" id="recipient-name">
                        </div>
                        @error('phone')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">وبسایت:</label>
                            <input name="website" type="text" class="form-control" id="recipient-name">
                        </div>
                        @error('website')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">درباره خیریه :</label>
                            <textarea name="about" class="form-control" id="message-text"></textarea>
                        </div>
                        @error('about')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <input class="btn btn-outline-success" type="submit" value="افزودن">
                        <a href="{{route('charities')}}" class="btn btn-primary">بازگشت</a>

                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection
