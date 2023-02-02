@extends('layouts.ShowOrEdit')

@section('delete-route')
    @isset($data)
        {{route('deleteProjects',['id' => $data['id']])}}
    @endisset
@endsection

@section('title')
    @isset($data)
        {{$data['title']}}
    @else
        افزودن پروژه جدید
    @endisset
@endsection

@section('header')
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>

        tinymce.init({

            selector: 'textarea#tiny',
            language: 'fa',

            plugins: [

                'a11ychecker', 'advlist', 'advcode', 'advtable', 'autolink', 'checklist', 'export',

                'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks',

                'powerpaste', 'fullscreen', 'formatpainter', 'insertdatetime', 'media', 'table', 'help', 'wordcount'

            ],

            toolbar: 'undo redo | a11ycheck casechange blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify |' +

                'bullist numlist checklist outdent indent | removeformat | code table help'

        })

    </script>
@endsection

@section('form-content')

    <div class="mb-3">
        <label for="amount" class="col-form-label">تصویر اصلی پروژه :</label>

        @isset($data)
            <livewire:photo-preview :url="$data['image_head']"/>
        @else
            <livewire:photo-preview/>
        @endisset
    </div>
    @error('image')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="mb-3">
        <label for="title" class="col-form-label">عنوان :</label>
        <input name="title" type="text" class="form-control" id="title"
               value="@isset($data){{$data['title']}}@else{{ old('title') }}@endisset">
    </div>
    @error('title')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="mb-3">
        <label for="pishraft" class="col-form-label">درصد پیشرفت پروژه :</label>
        <input name="pishraft" type="number" class="form-control" id="pishraft"
               value="@isset($data){{$data['pishraft']}}@else{{ old('pishraft') }}@endisset">
        <p class="mt-2">میزان پیشرفت پروژه از 100 درصد تایین می شود .</p>
    </div>
    @error('pishraft')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="mb-3">
        <label for="title" class="col-form-label">نوع پرداخت :</label>
        <input id="nullType" type="checkbox" name="nullType" onclick="hid()"
               @isset($data)@if($data['type_pay'] == null) checked @endif @else
            {{ old('nullType') }}
            @endisset>
        <label for="nullType">بدون امکان مشارکت در پروژه </label>

        @isset($data)
            <livewire:pay-type :data="$data['type_pay']">
        @else
            <livewire:pay-type/>
        @endisset

        <script>
            function hid() {
                document.getElementById('types').hidden = document.getElementById('nullType').checked;
            }
            hid();
        </script>

    </div>
    @error('type')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('subType')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    @can('see-all-projects')
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
        <textarea name="description" class="form-control" id="tiny">@isset($data)
                {{$data->description}}
            @endisset</textarea>
    </div>
    @error('description')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

@endsection
