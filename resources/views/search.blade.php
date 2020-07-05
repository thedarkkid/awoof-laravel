@extends('layouts.master')

@section('content')
    <div class="min-vh-15"></div>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <section class="subcribe  fadeInUp bg-white" >
                <div class="col-md-2"></div>
                <div class="col-md-8 no-padding  text-dark">
                    <div class="sub-mail">
                        <form>
                            <input class="black-box" type="search" placeholder="ENTER PRODUCT NAME, STORE, ETC">
                            <!--  Button -->
                            <button class="text-uppercase" type="submit">search</button>
                        </form>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </section>
        </div>
    </div>
@endsection
