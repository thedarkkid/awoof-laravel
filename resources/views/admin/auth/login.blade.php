@extends('admin.layouts.authentication')
@section('title', 'Login')
@section('content')
<div class="row">
    <div class="col-lg-4 col-sm-12">
        <form class="card auth_form" method="POST" action="{{ route('admin.login') }}">
            @csrf

            <div class="header">
{{--                <img class="logo" src="{{asset('assets/images/logo.svg')}}" alt="">--}}
                <h5>{{ __('Login') }}</h5>
            </div>
            <div class="body">
                <div class="input-group mb-3">
                    <label for="email" class="col-md-4 col-form-label text-md-right sr-only">{{ __('E-Mail Address') }}</label>

                    <input id="email" placeholder="{{ __('E-Mail Address') }}" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    <div class="input-group-append">
                        <span class="input-group-text"><i class="zmdi zmdi-account-circle"></i></span>
                    </div>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

                <div class="input-group mb-3">
                    <label for="password" class="col-md-4 col-form-label text-md-right sr-only">{{ __('Password') }}</label>

                    <input id="password" placeholder="{{ __('Password') }}" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    <div class="input-group-append">
                        <span class="input-group-text"><i class="zmdi zmdi-lock"></i></span>
                    </div>

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="checkbox">
                    <input  type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">{{ __('Remember Me') }}</label>
                </div>

                <button type="submit" class="btn btn-primary btn-block waves-effect waves-light text-uppercase">{{ __('Log In') }}</button>

                <div class="form-group row mb-0">
                    <div class="col-md-10 offset-md-3">
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </div>

            </div>
        </form>
        <div class="copyright text-center">
            &copy;
            <script>document.write(new Date().getFullYear())</script>,
            <span>Developed by <a href="https://arkduo.org" target="_blank">Arkduo.org</a></span>
        </div>
    </div>
    <div class="col-lg-8 col-sm-12">
        <div class="card">
            <img src="{{asset('assets/images/signin.svg')}}" alt="Sign In"/>
        </div>
    </div>
</div>
@stop
