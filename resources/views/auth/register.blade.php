@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $title ?? __('Register') }}</div>

                    <div class="card-body">
                        @isset($route)
                            <form method="POST" action="{{ $route }}">
                                @else
                                    <form method="POST" action="{{ route('register') }}">
                                        @endisset
                                        @csrf

                                        <div class="row mb-3">
                                            <label for="name"
                                                   class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                            <div class="col-md-6">
                                                <input id="name" type="text"
                                                       class="form-control @error('name') is-invalid @enderror"
                                                       name="name" value="{{ old('name') }}" required
                                                       autocomplete="name" autofocus>

                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="phone"
                                                   class="col-md-4 col-form-label text-md-end">شماره موبایل</label>

                                            <div class="col-md-6">
                                                <input id="phone" type="text"
                                                       class="form-control @error('phone') is-invalid @enderror"
                                                       name="phone" value="{{ old('phone') }}" required
                                                       autocomplete="phone" autofocus>

                                                @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="email"
                                                   class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                            <div class="col-md-6">
                                                <input id="email" type="email"
                                                       class="form-control @error('email') is-invalid @enderror"
                                                       name="email" value="{{ old('email') }}" required
                                                       autocomplete="email">

                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="password"
                                                   class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                            <div class="col-md-6">
                                                <input id="password" type="password"
                                                       class="form-control @error('password') is-invalid @enderror"
                                                       name="password" required autocomplete="new-password">

                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="password-confirm"
                                                   class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                            <div class="col-md-6">
                                                <input id="password-confirm" type="password" class="form-control"
                                                       name="password_confirmation" required
                                                       autocomplete="new-password">
                                            </div>
                                        </div>


                                        @isset($route)
                                            <div class="row mb-4"></div>

                                            <div class="row mb-3">
                                                <label for="fullname"
                                                       class="col-md-4 col-form-label text-md-end">نام خیریه</label>

                                                <div class="col-md-6">
                                                    <input id="fullname" type="text" class="form-control"
                                                           name="fullname" required
                                                           autocomplete="fullname">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="shortname"
                                                       class="col-md-4 col-form-label text-md-end">نام کوتاه</label>

                                                <div class="col-md-6">
                                                    <input id="shortname" type="text" class="form-control"
                                                           name="shortname" required
                                                           autocomplete="shortname">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="about"
                                                       class="col-md-4 col-form-label text-md-end">درباره خیریه</label>

                                                <div class="col-md-6">
                                                    <textarea name="about" class="form-control" id="about" cols="30" rows="10" required>{{ old('about') }}</textarea>
                                                </div>
                                            </div>


                                        @endisset

                                        <div class="row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Register') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
