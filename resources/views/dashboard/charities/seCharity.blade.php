@extends('layouts.ShowOrEdit')

@section('title')
    @isset($data)
        {{$data['shortname']}}
    @else
        خیریه جدید
    @endisset
@endsection

@section('delete-route')
    @isset($data)
        {{route('deleteCharity',['id' => $data['id']])}}
    @endisset
@endsection

@section('header')
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
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

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
        <script>
            var route_prefix = "/filemanager";
        </script>

        <div class="input-group">
   <span class="input-group-btn">
     <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
       <i class="fa fa-picture-o">انتخاب</i>
     </a>
   </span>
            <input id="thumbnail" class="form-control" type="text" name="logo"
                   value="@isset($data){{$data['logo']}}@else{{ old('logo') }}@endisset">
        </div>
        <img id="holder" style="margin-top:15px;max-height:100px;">

        <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
        <script>
            $('#lfm').filemanager('image');
        </script>

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
