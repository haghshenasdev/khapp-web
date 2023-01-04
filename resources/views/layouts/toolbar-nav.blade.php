<div class="row justify-content-center my-3 mx-0">
    <div class="col-md-7">
        <div class="card p-0">
            <div class="card-body">
                <ul class="nav justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('dashboard')}}">داشبورد</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('darkhasts')}}">درخواست ها</a>
                    </li>
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
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">پویش ها</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">پروژه ها</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">نوع ها </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">نوع پرداخت</a></li>
                            <li><a class="dropdown-item" href="#">نوع درخواست</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">تنظیمات</a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>
