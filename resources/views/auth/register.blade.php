@extends('layouts.master')

@section('content')
    <section class="section-p-30px conact-us no-padding-b animate fadeInUp" data-wow-delay="0.4s">
        <div class="container">
            <!-- Tittle -->
            <div class="tittle">
                <h5>{{ __('Register') }}</h5>
            </div>
            <div class="contact section-p-30px no-padding-b">
                <div class="contact-form">
                    <form method="POST" role="form" id="contact_form" class="contact-form" action="{{ route('register') }}">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <ul class="row">
                                    <li class="form-group col-sm-12">
                                        <label for="name" class="sr-only col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"
                                               required autocomplete="name" autofocus placeholder="NAME">

                                        @error('name')
                                        <div class="col-md-6 mt-vh-2">
                                            <span class="h5 text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        </div>
                                        @enderror
                                    </li>

                                    <li class="form-group col-sm-12">
                                        <label for="email" class=" sr-only col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                               name="email" value="{{ old('email') }}" required autocomplete="email"  placeholder="EMAIL">

                                        @error('email')
                                        <div class="col-md-6 mt-vh-2">
                                            <span class="h5 text-danger " role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        </div>
                                        @enderror
                                    </li>

                                    <li class="form-group col-sm-12">
                                        <label for="password" class="sr-only col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                               name="password" required autocomplete="new-password" placeholder="PASSWORD">

                                        @error('password')
                                        <div class="col-md-6 mt-vh-2">
                                            <span class="h5 text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        </div>
                                        @enderror
                                    </li>

                                    <li class="form-group col-sm-12">
                                        <label for="password-confirm" class="sr-only col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                               required autocomplete="new-password" placeholder="PASSWORD CONFIRMATION">
                                    </li>

                                    <li class="form-group col-sm-12w mb-0 ">
                                        <div class="col-md-6 pull-right offset-md-4">
                                            <button type="submit" class="btn text-white btn-primary btn-dark btn-lg">
                                                {{ __('Register') }}
                                            </button>
                                        </div>
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
