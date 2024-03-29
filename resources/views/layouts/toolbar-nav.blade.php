<div class="row justify-content-center my-3 mx-0">
    <div class="col-md-7">
        <div class="card p-0">
            <div class="card-body">
                <ul class="nav justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('dashboard')}}">داشبورد</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('faktoors')}}">فاکتور ها</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('darkhasts')}}">درخواست ها</a>
                    </li>
                    @can('file_manager')
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{url('filemanager')}}">مدیریت فایل</a>
                        </li>
                    @endcan
                    @can('see-users')
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('users')}}">کاربران</a>
                    </li>
                    @endcan
                    @can('see-charities')
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{route('charities')}}">خیریه ها</a>
                        </li>
                    @endcan
                    @can('see-pooyesh')
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('pooyeshes')}}">پویش ها</a>
                    </li>
                    @endcan
                    @can('see-projects')
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('projects')}}">پروژه ها</a>
                    </li>
                    @endcan
                    @can('see-types')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">نوع ها </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('PayType') }}">نوع پرداخت</a></li>
                            <li><a class="dropdown-item" href="{{route('DarkhastType')}}">نوع درخواست</a></li>
                        </ul>
                    </li>
                    @endcan

                    @can('see-homeItems')
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('HomeItems') }}">دکمه های نرم افزار</a>
                        </li>
                    @endcan

                    @can('see-sliders')
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('Sliders') }}">اسلایدر</a>
                        </li>
                    @endcan

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">تنظیمات</a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>
