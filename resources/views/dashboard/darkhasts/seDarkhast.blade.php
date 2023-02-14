@extends('layouts.ShowOrEdit')

@section('title')
    @isset($data)
        {{$data['title']}}
    @else
        درخواست جدید
    @endisset
@endsection

@section('delete-route')
    @isset($data)
        {{route('deleteDarkhast',['id' => $data['id']])}}
    @endisset
@endsection

@section('form-content')
    <div class="mb-3">
            <label for="message-text" class="col-form-label">نوع درخواست :</label>

        @isset($data)
            <livewire:components.darkhast-type :data="$data['type']">
        @else
            <livewire:components.darkhast-type />
        @endisset

        </div>
        @error('type')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        @can('update-darkhasts')
            <div class="mb-3">
                <label for="message-text" class="col-form-label">وضعیت درخواست :</label>
                <select name="status" class="form-select" aria-label="Default select example">
                    @foreach($darkhast_statuses as $status)
                        <option value="{{$status->id}}"
                                @if(isset($data) && $status->title === $data->status_title) selected @endif>
                            {{$status->status_title}}
                        </option>
                    @endforeach
                </select>
            </div>
            @error('type')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="mb-3">
                <label for="charity" class="col-form-label">کاربر:</label>

                <div class="row">
                    <div class="col">
                        <input name="user" type="number" class="form-control" id="user"
                               value="@isset($data){{$data['user']}}@else{{ old('user')}}@endisset">
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-outline-primary">دریافت نام و برسی</button>
                    </div>
                </div>
                <label for="charity" class="col-form-label">نام</label>
            </div>
            @error('user')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror


            @can('see-all-darkhasts')
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

        @else
            @isset($data)
            <div class="mb-3">
                <label for="message-text" class="col-form-label">وضعیت درخواست : {{$data->status_title}}</label>
            </div>
            @endisset
        @endcan

        <div class="mb-3">
            <label for="message-text" class="col-form-label">توضیحات :</label>
            <textarea name="description" class="form-control" id="message-text">@isset($data){{$data->description}}@endisset</textarea>
        </div>
        @error('description')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
@endsection
