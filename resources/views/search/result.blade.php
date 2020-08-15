@extends('layouts.master')
@section('extrastyles')
<style>
    .subcribe .sub-mail input{
        border-color: #bdbdbd;
    }
    .subcribe .sub-mail button{
        border-left-color: #bdbdbd;
    }
</style>
@endsection

@section('preloader')
    <div id="loader">
        <div class="loader">
            <div class="position-center-center">
{{--                <img src="{{asset('assets/sebian')}}/images/logo-dark.png" alt="">--}}
                <p class=" h2 text-uppercase">awoof</p>
                <p class="font-playfair text-center">Please Wait...</p>
                <div class="loading">
                    <div class="ball"></div>
                    <div class="ball"></div>
                    <div class="ball"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="content">

    <!--======= SUB BANNER =========-->
    <section class="sub-banner animate fadeInUp" data-wow-delay="0.4s">
        <div class="container">
            <h4 class="text-uppercase">Results FOR {{$query}}</h4>
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li><a href="{{ route('user.home') }}">Home</a></li>
                <li class="active">Search</li>
            </ol>
        </div>
    </section>

    <!--======= SEARCH BAR =========-->


    <section class="section-p-30px pages-in">
        <div class="container">
            <form method="GET" action="{{ route('user.products.search') }}">
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-6">
                        <div class="items-short-type animate fadeInUp mb-vh-3" data-wow-delay="0.4s">
                            <div class="view-num">
                                <div class="short-by">
                                    <p class="mr-5">Sort By</p>

                                    <select name="price_order" class="selectpicker">
                                        <option>Price</option>
                                        <option value="asc" {{ ($order["price"] == "asc")? "selected": "" }}>Lowest to highest</option>
                                        <option value="desc" {{ ($order["price"] == "desc")? "selected": "" }}>Highest to lowest</option>
                                    </select>
                                    <select name="rating_order" class="selectpicker">
                                        <option>Rating</option>
                                        <option value="asc" {{ ($order["rating"] == "asc")? "selected": "" }}>Lowest to Highest</option>
                                        <option value="desc" {{ ($order["rating"] == "desc")? "selected": "" }}>Highest to Lowest</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3"></div>
                </div>
                <div class="row justify-content-center">
                    <section class="subcribe  fadeInUp bg-white" >
                        <div class="col-md-2"></div>
                        <div class="col-md-8 no-padding  text-dark">
                            <div class="sub-mail">
                                    <input class="black-box" value="{{$query}}" name="query" type="search" placeholder="ENTER PRODUCT NAME, STORE, ETC">
                                    @error('query')
                                    <div class="col-md-6 mt-vh-1">
                                    <span class="h5 text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    </div>
                                    @enderror
                                    <button class="text-uppercase" type="submit">search</button>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </section>
                </div>
            </form>
        </div>
    </section>

    <!--======= PAGES INNER =========-->
    <section class="section-p-30px pages-in">
        <div class="container">
            <div class="row">
                <!--======= ITEMS =========-->
                <div class="col-sm-12 animate fadeInUp" data-wow-delay="0.4s">
                    <div class="items-short-type animate fadeInUp" data-wow-delay="0.4s">
                        <div class="short-by">
                            <p>Showing {{$products->firstItem()}}-{{$products->lastItem()}} of {{$products->total()}} products</p>
                        </div>
                    </div>

                    <!--======= Products =========-->
                    <div class="popurlar_product animate fadeInUp" data-wow-delay="0.4s">
                        <ul class="row">
                            <!-- Searched Products -->
                            @foreach($products as $product)
                            <li class="col-sm-3 animate fadeIn" data-wow-delay="0.2s">
                                <div class="items-in">
                                    <!-- Image -->
                                    <img src="{{$product["img"]}}" alt="" >
                                    <!-- Hover Details -->
                                    <div class="over-item">
                                        <ul class="animated fadeIn">
                                            <li class="full-w"> <a href="{{$product["link"]}}" class="btn">View In Store</a></li>
                                            <!-- Rating Stars -->
                                            @if(array_key_exists("rating_text", $product))
                                            <li class="stars">
                                                @for($i=1; $i<=$product["rating"]; $i++)
                                                    <i class="fa fa-star"></i>
                                                @endfor
                                            </li>
                                            @endif
                                        </ul>
                                    </div>
                                    <div class="details-sec">
                                        <p class="text-uppercase">
                                            <b>
                                                {{$product["store_name"]}}
                                            </b>
                                        </p>
                                    </div>
                                    <!-- Item Name -->
                                    <div class="details-sec">
                                        <a href="{{$product["link"]}}" target="_blank"> {{$product["name"]}} </a>
                                        <span>
                                            @if(array_key_exists("rating_text", $product))
                                                <div class="stars">
                                                    @for($i=1; $i<=$product["rating"]; $i++)
                                                        <i class="fa fa-star"></i>
                                                    @endfor
                                                </div>
                                            @endif
                                        </span>
                                        <span class="font-montserrat"> {{$product["_price"]}} </span>
                                    </div>
                                </div>
                            </li>
                            @endforeach

                        </ul>
                    </div>
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('extrascripts')
    <script src="{{asset('assets/sebian')}}/js/wow.min.js"></script>
    <script src="{{asset('assets/sebian')}}/js/owl.carousel.min.js"></script>
    <script src="{{asset('assets/sebian')}}/js/jquery.magnific-popup.min.js"></script>
    <script src="{{asset('assets/sebian')}}/js/jquery.isotope.min.js"></script>
    <script src="{{asset('assets/sebian')}}/js/main.js"></script>
@endsection
