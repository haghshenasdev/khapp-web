@extends('layouts.ShowOrEdit')

@section('title')
    @isset($data)
        پرداخت شده برای {{$data['title']}}
    @else
        فاکتور جدید
    @endisset
@endsection

@section('delete-route')
    @isset($data)
        {{route('deleteDarkhast',['id' => $data['id']])}}
    @endisset
@endsection

@section('form-content')
    <div class="mb-3">
        <label for="charity" class="col-form-label">کاربر:</label>

        <div class="row">
            <div class="col">
                <input name="userid" type="number" class="form-control" id="user"
                       value="@isset($data){{$data['userid']}}@else{{ old('userid')}}@endisset">
            </div>
            <div class="col-auto">
                <button class="btn btn-outline-primary">دریافت نام و برسی</button>
            </div>
        </div>
        <label for="charity" class="col-form-label">نام</label>
    </div>
    @error('userid')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="mb-3">
        <label for="message-text" class="col-form-label">توضیحات :</label>
        <textarea name="description" class="form-control" id="message-text">@isset($data){{$data->description}}@endisset</textarea>
    </div>
    @error('description')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
@endsection
