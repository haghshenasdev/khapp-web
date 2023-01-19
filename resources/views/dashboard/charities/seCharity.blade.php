@extends('layouts.ShowOrEdit')

@section('title')
    خیریه جدید
@endsection

@section('delete-route')
    @isset($data)
        {{route('deleteCharity',['id' => $data['id']])}}
    @endisset
@endsection

@section('form-content')

    <div class="mb-3">
        <label for="recipient-name" class="col-form-label">نام کوتاه:</label>
        <input name="shortname" type="text" class="form-control" id="recipient-name"
               value="@isset($data){{$data['shortname']}}@else{{ old('shortname') }}@endisset">
    </div>
    @error('shortname')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="mb-3">
        <label for="recipient-name" class="col-form-label">نام کامل:</label>
        <input name="fullname" type="text" class="form-control" id="recipient-name"
               value="@isset($data){{$data['fullname']}}@else{{ old('fullname')}}@endisset">
    </div>
    @error('fullname')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="mb-3">
        <label for="recipient-name" class="col-form-label">تلفن تماس:</label>
        <input name="phone" type="text" class="form-control" id="recipient-name"
               value="@isset($data){{$data['phone']}}@else{{ old('phone')}}@endisset">
    </div>
    @error('phone')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="mb-3">
        <label for="recipient-name" class="col-form-label">وبسایت:</label>
        <input name="website" type="text" class="form-control" id="recipient-name"
               value="@isset($data) {{$data['website']}} @else {{ old('website') }} @endisset">
    </div>
    @error('website')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="mb-3 container">
        <label for="recipient-name" class="col-form-label">تم رنگی:</label>
        <div class="row row-cols-auto">
            <input name="color1" type="color" class="form-control form-control-color col" id="exampleColorInput"
                   value="#457b9d" title="Choose your color">
            <input name="color2" type="color" class="form-control form-control-color col" id="exampleColorInput"
                   value="#1d3557" title="Choose your color">
        </div>
    </div>
    @error('color1')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('color2')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="mb-3">
        <label for="logo" class="col-form-label">لوگو خیریه :</label>
        <input type="file" class="form-control" name="logo"/>
        <label class="col-form-label">فقط تصویر با فرمت png در ابعاد 100*100 پیکسل مورد قبول است.</label>
    </div>
    @error('logo')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="mb-3">
        <label for="message-text" class="col-form-label">درباره خیریه :</label>
        <textarea name="about" class="form-control" id="message-text">@isset($data){{$data['about']}}@else{{ old('about') }}@endisset</textarea>
    </div>
    @error('about')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
@endsection
