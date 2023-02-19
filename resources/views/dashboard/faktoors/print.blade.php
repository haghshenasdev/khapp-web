<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $data['title'] }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.rtl.min.css" integrity="sha384-WJUUqfoMmnfkBLne5uxXj+na/c7sesSJ32gI7GfCk4zO4GthUKhSEGyvQ839BC51" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet" type="text/css" />
    <style>
        body {
            font-family: Vazirmatn, sans-serif !important;
        }
    </style>

    @laravelViewsStyles
</head>
<body>

<div class="container-fluid">
    <div class="row align-items-center justify-content-between">
        <div class="col-auto row align-items-center">
            <div class="col-auto"><img src="{{ $data['logo'] }}" width="100px" height="100px"></div>
            <div class="col">{{ $data['title'] }} {{ $data['fullname'] }}</div>
        </div>
        <div class="col-auto">تاریخ : {{ \Morilog\Jalali\Jalalian::now() }}</div>
    </div>
</div>

@livewire('tables.faktoors-table-view')


@laravelViewsScripts

<script !src="">
    document.getElementsByClassName('md:flex items-center')[0].remove();
    window.print();
</script>
</body>
</html>
