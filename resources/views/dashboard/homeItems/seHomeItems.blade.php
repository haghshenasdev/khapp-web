@extends('layouts.ShowOrEdit')

@section('delete-route')
    @isset($data)
        {{route('deleteHomeItem',['id' => $data['id']])}}
    @endisset
@endsection

@section('title')
    @isset($data)
        {{$data['title']}}
    @else
        افزودن دکمه جدید
    @endisset
@endsection

@section('form-content')

    <div class="mb-3">
        <label for="image" class="col-form-label">آیکون دکمه :</label>

        @isset($data)
            <livewire:components.photo-preview :url="$data['image']"/>
        @else
            <livewire:components.photo-preview />
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
        <label for="title" class="col-form-label">عملیات :</label>
        @isset($data)
            <livewire:components.action-home-item :data="$data['action']">
                @else
                    <livewire:components.action-home-item />
        @endisset
    </div>
    @error('action')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    @can('see-all-homeItems')
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

@endsection
