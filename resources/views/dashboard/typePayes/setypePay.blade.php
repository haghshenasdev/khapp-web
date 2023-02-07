@extends('layouts.ShowOrEdit')

@section('delete-route')
    @isset($data)
        {{route('deletePayType',['id' => $data['id']])}}
    @endisset
@endsection

@section('title')
    @isset($data)
        {{$data['title']}}
    @else
        افزودن نوع پرداخت جدید
    @endisset
@endsection

@section('header')
    <link rel="stylesheet" href="https://unpkg.com/persian-datepicker@latest/dist/css/persian-datepicker.min.css">
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

@endsection

@section('form-content')

    <div class="mb-3">
        <label for="title" class="col-form-label">عنوان :</label>
        <input name="title" type="text" class="form-control" id="title"
               value="@isset($data){{$data['title']}}@else{{ old('title') }}@endisset">
    </div>
    @error('title')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="mb-3">
        <label for="default" class="col-form-label">پیش فرض :</label>
        <input type="checkbox" name="default" id="default" value="1" @isset($data)@if($data['default'] != null) checked="checked" @endif @endisset>
        <label for="default" class="col-form-label">به طور پیش فرض انتخاب شود</label>
    </div>
    @error('default')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="mb-3">
        <label for="optional_sub_select" class="col-form-label">انتخاب زیر مجموعه :</label>
        <input type="checkbox" name="optional_sub_select" id="optional_sub_select" value="1" @isset($data)@if($data['optional_sub_select'] != null) checked="checked" @endif @endisset>
        <label for="optional_sub_select" class="col-form-label">اختیاری بودن انتخاب زیر مجموعه</label>
    </div>
    @error('optional_sub_select')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="mb-3">
        <label for="title" class="col-form-label">زیر مجموعه :</label>
        <select name="sub" class="form-select" aria-label="Default select example">
            <option value="0">دسته اصلی</option>
            @foreach($types as $type)
                <option title="{{ $type->description }}" value="{{$type->id}}" @if(isset($data) && $type->id == $data['sub']) selected @endif>
                    {{$type->title}}
                </option>
            @endforeach
        </select>
    </div>
    @error('sub')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    @can('see-all-darkhastType')
        <div class="mb-3">
            <label for="charity" class="col-form-label">خیریه:</label>

            <div class="row">
                <div class="col">
                    <input name="charity" type="number" class="form-control" id="charity"
                           value="@isset($data){{$data['charity']}}@else{{ old('charity')}}@endisset">
                </div>
                <div class="col-auto">
                    <button class="btn btn-outline-primary">دریافت نام و برسی</button>
                </div>
            </div>
            <label for="charity" class="col-form-label">نام</label>
        </div>
        @error('charity')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    @endcan

    <div class="mb-3">
        <label for="tiny" class="col-form-label">توضیحات :</label>
        <textarea name="description" class="form-control" id="tiny">@isset($data){{$data->description}}@endisset</textarea>
    </div>
    @error('description')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

@endsection
