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
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>

        var editor_config = {

            selector: 'textarea#tiny',
            language: 'fa',
            path_absolute : "/",

            relative_urls: false,

            plugins: [

                'a11ychecker', 'advlist', 'advcode', 'advtable', 'autolink', 'checklist', 'export',

                'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks',

                'powerpaste', 'fullscreen', 'formatpainter', 'insertdatetime', 'media', 'table', 'help', 'wordcount'

            ],

            toolbar: 'undo redo | a11ycheck casechange blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify |' +

                'bullist numlist checklist outdent indent | removeformat | code table help',
            file_picker_callback : function(callback, value, meta) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                var cmsURL = editor_config.path_absolute + 'filemanager?editor=' + meta.fieldname;
                if (meta.filetype == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.openUrl({
                    url : cmsURL,
                    title : 'Filemanager',
                    width : x * 0.8,
                    height : y * 0.8,
                    resizable : "yes",
                    close_previous : "no",
                    onMessage: (api, message) => {
                        callback(message.content);
                    }
                });
            }

        };
        tinymce.init(editor_config);

    </script>
@endsection

@section('form-content')

    <div class="mb-3">
        <label for="amount" class="col-form-label">تصویر اصلی پروژه :</label>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
        <script>
            var route_prefix = "/filemanager";
        </script>

        <label for="amount" class="col-form-label">تصویر پویش :</label>

        <div class="input-group">
   <span class="input-group-btn">
     <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
       <i class="fa fa-picture-o">انتخاب</i>
     </a>
   </span>
            <input id="thumbnail" class="form-control" type="text" name="image"
                   value="@isset($data){{$data['image_head']}}@else{{ old('image') }}@endisset">
        </div>
        <img id="holder" style="margin-top:15px;max-height:100px;">

        <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
        <script>
            $('#lfm').filemanager('image');
        </script>

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
            <livewire:components.pay-type :data="$data['type_pay']">
                @else
                    <livewire:components.pay-type/>
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
