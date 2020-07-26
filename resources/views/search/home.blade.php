@extends('layouts.master')

@section('content')
    <div class="min-vh-15"></div>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <section class="subcribe  fadeInUp bg-white" >
                <div class="col-md-2"></div>
                <div class="col-md-8 no-padding  text-dark">
                    <div class="sub-mail">
                        <form method="GET" action="{{ route('user.products.search') }}">
                            <input class="black-box"  name="query" type="search" placeholder="ENTER PRODUCT NAME, STORE, ETC">

                            @error('query')
                            <div class="col-md-6 mt-vh-1">
                                <span class="h5 text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            </div>
                            @enderror

                            <button class="text-uppercase" type="submit">search</button>
                        </form>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </section>
        </div>
    </div>
@endsection
