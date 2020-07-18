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
            <h4 class="text-uppercase">Results</h4>
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">SHOP</li>
            </ol>
        </div>
    </section>

    <!--======= SEARCH BAR =========-->

    <section class="section-p-30px pages-in">
        <div class="container">
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
    </section>

    <!--======= PAGES INNER =========-->
    <section class="section-p-30px pages-in">
        <div class="container">
            <div class="row">
                <!--======= ITEMS =========-->
                <div class="col-sm-12 animate fadeInUp" data-wow-delay="0.4s">
                    <div class="items-short-type animate fadeInUp" data-wow-delay="0.4s">

                        <!--======= GRID LIST STYLE =========-->
                        <div class="grid-list"> <a href="#."><i class="fa fa-th-large"></i></a> <a href="#."><i class="fa fa-th-list"></i></a> </div>

                        <!--======= SHORT BY =========-->
                        <div class="short-by">
                            <select class="selectpicker">
                                <option>Short by</option>
                                <option>Short by</option>
                            </select>
                            <p>Showing 1-12 of 30 products</p>
                        </div>

                        <!--======= VIEW ITEM NUMBER =========-->
                        <div class="view-num">
                            <div class="short-by">
                                <select class="selectpicker">
                                    <option>By Price</option>
                                    <option>100$ - 200$</option>
                                    <option>100$ - 200$</option>
                                    <option>100$ - 200$</option>
                                    <option>100$ - 200$</option>
                                    <option>100$ - 200$</option>
                                </select>
                                <select class="selectpicker">
                                    <option>By Color</option>
                                    <option>RED</option>
                                    <option>BLUE</option>
                                    <option>GREEN</option>
                                    <option>YELLOW</option>
                                </select>
                                <select class="selectpicker">
                                    <option>By Size</option>
                                    <option>Small</option>
                                    <option>Large </option>
                                    <option>X Large</option>
                                    <option>XX Large</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!--======= Products =========-->
                    <div class="popurlar_product animate fadeInUp" data-wow-delay="0.4s">
                        <ul class="row">
                            <!-- Searched Products -->

                            <li class="col-sm-3 animate fadeIn" data-wow-delay="0.2s">
                                <div class="items-in">
                                    <!-- Image -->
                                    <img src="{{asset('assets/sebian')}}/images/new-item-1.jpg" alt="">
                                    <!-- Hover Details -->
                                    <div class="over-item">
                                        <ul class="animated fadeIn">
                                            <li> <a href="images/new-item-1.jpg" data-lighter><i class="ion-search"></i></a></li>
                                            <li> <a href="#."><i class="ion-shuffle"></i></a></li>
                                            <li> <a href="#."><i class="fa fa-heart-o"></i></a></li>
                                            <li class="full-w"> <a href="#." class="btn">ADD TO CART</a></li>
                                            <!-- Rating Stars -->
                                            <li class="stars"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i></li>
                                        </ul>
                                    </div>
                                    <!-- Item Name -->
                                    <div class="details-sec"> <a href="#.">LOOSE-FIT TRENCH COAT</a> <span class="font-montserrat">129.00 USD</span> </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!--======= PAGINATION =========-->
                    <ul class="pagination animate fadeInUp" data-wow-delay="0.4s">
                        <li><a href="#.">1</a></li>
                        <li><a href="#.">2</a></li>
                        <li><a href="#.">3</a></li>
                        <li><a href="#.">4</a></li>
                        <li><a href="#.">5</a></li>
                        <li><a href="#."><i class="fa fa-angle-right"></i></a></li>
                    </ul>
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
    <script src="{{asset('assets/sebian')}}/js/jquery.flexslider-min.js"></script>
    <script src="{{asset('assets/sebian')}}/js/jquery.nouislider.min.js"></script>

    <!-- SLIDER REVOLUTION 4.x SCRIPTS  -->
    <script type="text/javascript" src="{{asset('assets/sebian')}}/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
    <script type="text/javascript" src="{{asset('assets/sebian')}}/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
    <script src="{{asset('assets/sebian')}}/js/main.js"></script>
    <script>
        jQuery(document).ready(function($) {

            //  Price Filter ( noUiSlider Plugin)
            $("#price-range").noUiSlider({
                range: {
                    'min': [ 0 ],
                    'max': [ 1000 ]
                },
                start: [40, 940],
                connect:true,
                serialization:{
                    lower: [
                        $.Link({
                            target: $("#price-min")
                        })
                    ],
                    upper: [
                        $.Link({
                            target: $("#price-max")
                        })
                    ],
                    format: {
                        // Set formatting
                        decimals: 2,
                        prefix: '$'
                    }
                }
            })
        })
    </script>
@endsection
