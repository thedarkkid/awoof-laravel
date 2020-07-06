@extends('layouts.master')

@section('content')
    <section class="section-p-30px conact-us no-padding-b animate fadeInUp" data-wow-delay="0.4s">

        <div class="container">
            <div class="tittle">
                <h5>{{ __('Reset Password') }}</h5>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="contact section-p-30px no-padding-b">
                        <div class="contact-form">
                            <form method="POST" id="contact_form" action="{{ route('password.update') }}">
                                @csrf

                                <input type="hidden" name="token" value="{{ $token }}">
                                <ul class="row">
                                    <li class="form-group col-sm-12">
                                        <label for="email" class="sr-only col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                               name="email" value="{{ $email ?? old('email') }}" required placeholder="EMAIL" autocomplete="email" autofocus>

                                        @error('email')
                                        <div class="col-md-6">
                                            <span class="h5 text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        </div>
                                        @enderror
                                    </li>

                                    <li class="form-group col-sm-12">
                                        <label for="password" class="sr-only col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                               name="password" placeholder="PASSWORD" required autocomplete="new-password">

                                        <div class="col-md-6">
                                            @error('password')
                                            <div class="col-md-6">
                                                <span class="h5 text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            </div>
                                            @enderror
                                        </div>
                                    </li>

                                    <li class="form-group col-sm-12">
                                        <label for="password-confirm" class="sr-only col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                                        <input id="password-confirm" type="password" class="form-control"
                                               name="password_confirmation" placeholder="PASSWORD CONFIRMATION" required autocomplete="new-password">
                                    </li>

                                    <li class="form-group col-sm-12 ">
                                        <button type="submit" class=" pull-left btn btn-dark btn-lg text-white">
                                            {{ __('Reset Password') }}
                                        </button>
                                    </li>
                                </ul>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
