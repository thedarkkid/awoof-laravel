@extends('layouts.master')

@section('content')
    <section class="section-p-30px conact-us no-padding-b animate fadeInUp" data-wow-delay="0.4s">

    <div class="container">
        <div class="tittle">
            <h5>{{ __('Reset Password') }}</h5>
        </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="contact section-p-30px no-padding-b">
                <div class="contact-form">
                    <form method="POST" role="form" id="contact_form" class="contact-form" action="{{ route('password.email') }}">
                        @csrf
                        <ul class="row">
                            <li class="form-group col-sm-12">
                                <label for="email" class=" sr-only col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                                       placeholder="EMAIL" required autocomplete="email" autofocus>

                                @error('email')
                                <div class="col-md-6">
                                    <span class="h5 text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                </div>
                                @enderror
                            </li>
                            <li class="form-group col-sm-12 mb-0">
                                <button type="submit" class=" pull-left btn text-white btn-lg btn-dark">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </li>
                        </ul>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
