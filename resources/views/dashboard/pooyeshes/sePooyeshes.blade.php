@extends('layouts.ShowOrEdit')

@section('delete-route')
    @isset($data)
        {{route('deletePooyeshes',['id' => $data['id']])}}
    @endisset
@endsection

@section('title')
    @isset($data)
        {{$data['title']}}
    @else
        افزودن پویش جدید
    @endisset
@endsection

@section('header')
    <link rel="stylesheet" href="https://unpkg.com/persian-datepicker@latest/dist/css/persian-datepicker.min.css">
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
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>

@endsection

@section('form-content')

    <div class="mb-3">
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
                   value="@isset($data){{$data['image']}}@else{{ old('image') }}@endisset">
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
        <label for="amount" class="col-form-label">مبلغ مورد نیاز :</label>
        @isset($data)
            <livewire:components.amount-component :amountFormat="$data['amount']"/>
        @else
            <livewire:components.amount-component/>
        @endisset
        <p class="mt-2">فقط اعداد انگلیسی وارد نمایید .</p>
        <p class="mt-2">اگر مبلغ پویش نا محدود است آن را 0 بگذارید .</p>
    </div>
    @error('amount')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="mb-3 row">
        <div class="col">
            <label for="start" class="col-form-label">تاریخ شروع :</label>
            <input class="range-from form-control" name="start"
                   value="@isset($data){{$data['start']}}@else{{ old('start') }}@endisset"/>
            @error('start')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

        </div>
        <div class="col">
            <label for="end" class="col-form-label">تاریخ پایان :</label>
            <input class="range-to form-control" name="end"
                   value="@isset($data){{$data['end']}}@else{{ old('end') }}@endisset"/>
            @error('end')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <p class="mt-2">در صورت نیاز به محدود کردن هر کدام آن را پر کنید .</p>
    </div>

    <div class="mb-3">
        <label for="title" class="col-form-label">نوع پرداخت :</label>
        @isset($data)
            <livewire:components.pay-type :data="$data['type_pay']">
                @else
                    <livewire:components.pay-type/>
        @endisset

    </div>
    @error('type')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('subType')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    @can('see-all-pooyeshes')
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

    <script src="https://unpkg.com/persian-date@latest/dist/persian-date.min.js"></script>
    <script src="https://unpkg.com/persian-datepicker@latest/dist/js/persian-datepicker.min.js"></script>
    <script>

        var to, from;
        to = $(".range-to").persianDatepicker({
            initialValueType: 'gregorian',
            initialValue: @if(isset($data) && !is_null($data['end'])) {{'true'}} @else {{'false'}} @endif,
            timePicker: {
                enabled: true,
                meridiem: {
                    enabled: true
                }
            },
            observer: true,
            format: 'YYYY-MM-DD H:m:s',
            onSelect: function (unix) {
                to.touched = true;
                if (from && from.options && from.options.maxDate != unix) {
                    var cachedValue = from.getState().selected.unixDate;
                    from.options = {maxDate: unix};
                    if (from.touched) {
                        from.setDate(cachedValue);
                    }
                }
            }
        });
        from = $(".range-from").persianDatepicker({
            initialValueType: 'gregorian',
            initialValue: @if(isset($data) && !is_null($data['start'])) {{'true'}} @else {{'false'}} @endif,
            timePicker: {
                enabled: true,
                meridiem: {
                    enabled: true
                }
            },
            observer: true,
            format: 'YYYY-MM-DD H:m:s',
            onSelect: function (unix) {
                from.touched = true;
                if (to && to.options && to.options.minDate != unix) {
                    var cachedValue = to.getState().selected.unixDate;
                    to.options = {minDate: unix};
                    if (to.touched) {
                        to.setDate(cachedValue);
                    }
                }
            }
        });
    </script>
@endsection
