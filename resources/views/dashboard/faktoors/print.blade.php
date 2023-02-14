<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>چاپ</title>

    @laravelViewsStyles
</head>
<body>
@livewire('tables.faktoors-table-view')


@laravelViewsScripts

<script !src="">
    document.getElementsByClassName('md:flex items-center')[0].remove();
    window.print();
</script>
</body>
</html>
