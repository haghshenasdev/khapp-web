@extends('layouts.app')

@section('content')
    @include('layouts.toolbar-nav')
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">{{$darkhast->title}}</div>
                        @include('layouts.back-btn')
                    </div>
                </div>

                <div class="card-body">
                    <form method="post">
                        @csrf

                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">نوع درخواست :</label>
                            <select name="type" class="form-select" aria-label="Default select example">
                                @foreach($types as $type)
                                    <option value="{{$type->id}}"
                                            @if($type->title === $darkhast->title) selected @endif>
                                        {{$type->title}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('type')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        @can('admin')
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">وضعیت درخواست :</label>
                                <select name="type" class="form-select" aria-label="Default select example">
                                    @foreach($darkhast_statuses as $status)
                                        <option value="{{$status->id}}"
                                                @if($status->title === $darkhast->status_title) selected @endif>
                                            {{$status->status_title}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('type')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        @else
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">{{$darkhast->status_title}}}وضعیت درخواست :</label>
                            </div>
                        @endcan

                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">توضیحات :</label>
                            <textarea name="description" class="form-control" id="message-text">{{$darkhast->description}}</textarea>
                        </div>
                        @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <input class="btn btn-outline-success" type="submit" value="بروز رسانی">
                        <input class="btn btn-outline-danger" type="submit" value="حذف">

                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
