@extends('layouts.master')

@section('content')
<section class="section-p-30px conact-us no-padding-b animate fadeInUp" data-wow-delay="0.4s">
    <div class="container">
        <div class="tittle">
            <h5>{{ __('Confirm Password') }}</h5>
            <p>{{ __('Please confirm your password before continuing.') }}</p>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="contact section-p-30px no-padding-b">
                    <div class="contact-form">
                        <form method="POST" id="contact_form" action="{{ route('password.confirm') }}">
                            @csrf
                            <ul class="row">
                                <li class="form-group col-sm-12">
                                    <label for="password" class="sr-only col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                           name="password" required autocomplete="current-password" placeholder="PASSWORD">


                                    @error('password')
                                    <div class="col-md-6">
                                        <span class="h5 text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    </div>
                                    @enderror
                                </li>

                                <li class="form-group col-sm-12 mb-0">
                                    <button type="submit" class="btn btn-dark pull-left btn-lg text-white">
                                        {{ __('Confirm Password') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="mt-vh-1 h3 pull-right" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
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
