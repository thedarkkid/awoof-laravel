@extends('layouts.master')
@section('content')
    <section class="section-p-30px conact-us no-padding-b animate fadeInUp" data-wow-delay="0.4s">
        <div class="container">
            <!-- Tittle -->
            <div class="tittle">
                <h5>{{ __('Login') }}</h5>
            </div>
            <div class="contact section-p-30px no-padding-b">
                <div class="contact-form">
                    <form method="POST" role="form" id="contact_form" class="contact-form" action="{{ route('login') }}">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-md-8 ">
                                <ul class="row">
                                    <li class="col-sm-12 form-group">
                                        <label for="email" >
                                            <span class="sr-only">{{ __('E-Mail Address') }}</span>
                                        </label>
                                        <input id="email" placeholder="EMAIL" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" >

                                        @error('email')
                                        <div class="col-md-6 mt-vh-1">
                                            <span class="h5 text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                            </span>
                                        </div>
                                        @enderror
                                    </li>
                                    <li class="form-group col-sm-12">
                                        <label for="password" class="col-md-4 col-form-label sr-only text-md-right">{{ __('Password') }}</label>
                                        <input id="password" type="password" placeholder="PASSWORD" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                        @error('password')
                                            <div class="col-md-6 mt-vh-2">
                                                <span class="h5 text-danger " role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            </div>
                                        @enderror
                                    </li>
                                    <li class="ml-vh-2">
                                        <div class="checkbox">
                                            <input class="styled" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="text-uppercase" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </li>

                                    <li class="form-group col-sm-12 ">
                                        <button type="submit" class="btn btn-lg btn-dark text-white pull-left">
                                            {{ __('Login') }}
                                        </button>
                                    </li>
                                    <li class="form-group col-sm-12">

                                        @if (Route::has('password.request'))
                                            <a class="h3 " href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
