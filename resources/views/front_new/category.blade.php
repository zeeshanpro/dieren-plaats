@extends('front_new/layout/layout')
@section('container')
<main class="main">

    <div class="container d-flex align-items-center">
        <ol class="breadcrumb mt-2">
            <li class="breadcrumb-item theme-color-blue "><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active " aria-current="page">{{$kind->title}}</li>
        </ol>


    </div>
    <div class="container">
        <h2 class="theme-color-blue mt-1">{{$kind->title}}</h2>
        <div class="heading-left">
            <h2 class="title  mb-3 theme-color-gray">Subcategories</h2><!-- End .title text-center mb-2 -->
        </div><!-- End .heading-left -->
    </div>

    @inject( "adAttributeObj" , 'App\Repositories\Front\AdAttributeRepository' )
    @php
    $attributesResults = $adAttributeObj->listAttributes( $kindId );
    @endphp

    <div class="container">

        <div class="row justify-content-center">
        @foreach ($attributesResults['race'] as $attributeValues)
            <div class="col-md-6 col-lg-4">
                <div class="banner">
                    <a href="{{ route('shop',['category' => $kind->title_slug , 'subcategory' => $attributeValues->title_slug]) }}">
                        <img src="{{ URL::to('assets/images/banners/3cols/banner-4.jpg') }}" alt="Banner">
                    </a>

                    <div class="banner-content">

                        <h3 class="banner-title text-white">{{$attributeValues->title}}</h3><!-- End .banner-title -->

                    </div><!-- End .banner-content -->
                </div><!-- End .banner -->
            </div><!-- End .col-md-6 -->
            @endforeach
            
        </div><!-- End .row -->
    </div>
    <div class="container for-you">
        <div>
            <div class="heading-left">
                <h2 class="title  mb-3 theme-color-gray">Featured Products </h2><!-- End .title text-center mb-2 -->
            </div><!-- End .heading-left -->


        </div><!-- End .heading -->

        <div class="products">
            <div class="row justify-content-center">
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="product product-2">
                        <figure class="product-media">
                            <span class="product-label label-circle label-sale custom-position-tag">Sell</span>
                            <a href="product.html">
                                <img src="{{ URL::to('assets/images/cat-bulldozer-mike-burgquist.png') }}" alt="Product image" class="product-image">
                            </a>




                        </figure><!-- End .product-media -->




                        <div class="product-body">

                            <b>
                                <h1 class="product-title"><a href="product.html">Winch - CAT</a></h1>
                            </b><!-- End .product-title -->
                            <div class="product-price mb-0">
                                <span>€ 80,000</span>
                                <div class="custom-icon-tag-product">

                                    <img src="{{ URL::to('assets/images/tag-prod.png') }}" alt="tag">

                                </div>

                            </div><!-- End .product-price -->
                            <div>
                                <span>Condition:</span> <span>Used</span> <br>
                                <span>Brand:</span> <span>CAT</span>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
                            </div>


                        </div><!-- End .product-body -->
                    </div><!-- End .product -->
                </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->

                <div class="col-6 col-md-4 col-lg-3">
                    <div class="product product-2">
                        <figure class="product-media">
                            <span class="product-label label-circle label-sale custom-position-tag product-label-rent">Rent</span>
                            <a href="product.html">
                                <img src="{{ URL::to('assets/images/cat-bulldozer-mike-burgquist.png') }}" alt="Product image" class="product-image">
                            </a>




                        </figure><!-- End .product-media -->




                        <div class="product-body">

                            <b>
                                <h1 class="product-title"><a href="product.html">Winch - CAT</a></h1>
                            </b><!-- End .product-title -->
                            <div class="product-price mb-0">
                                <span>€ 80,000</span>
                                <div class="custom-icon-tag-product">

                                    <img src="{{ URL::to('assets/images/tag-prod-blue.png') }}" alt="tag">

                                </div>

                            </div><!-- End .product-price -->
                            <div>
                                <span>Condition:</span> <span>Used</span> <br>
                                <span>Brand:</span> <span>CAT</span>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
                            </div>


                        </div><!-- End .product-body -->
                    </div><!-- End .product -->
                </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->

                <div class="col-6 col-md-4 col-lg-3">
                    <div class="product product-2">
                        <figure class="product-media">
                            <span class="product-label label-circle label-sale custom-position-tag">Sell</span>
                            <a href="product.html">
                                <img src="{{ URL::to('assets/images/cat-bulldozer-mike-burgquist.png') }}" alt="Product image" class="product-image">
                            </a>




                        </figure><!-- End .product-media -->




                        <div class="product-body">

                            <b>
                                <h1 class="product-title"><a href="product.html">Winch - CAT</a></h1>
                            </b><!-- End .product-title -->
                            <div class="product-price mb-0">
                                <span>€ 80,000</span>
                                <div class="custom-icon-tag-product">

                                    <img src="{{ URL::to('assets/images/Icon color.png') }}" alt="tag">

                                </div>

                            </div><!-- End .product-price -->
                            <div>
                                <span>Condition:</span> <span>Used</span> <br>
                                <span>Brand:</span> <span>CAT</span>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
                            </div>


                        </div><!-- End .product-body -->
                    </div><!-- End .product -->
                </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->

                <div class="col-6 col-md-4 col-lg-3">
                    <div class="product product-2">
                        <figure class="product-media">
                            <span class="product-label label-circle label-sale custom-position-tag product-label-rent">Rent</span>
                            <a href="product.html">
                                <img src="{{ URL::to('assets/images/cat-bulldozer-mike-burgquist.png') }}" alt="Product image" class="product-image">
                            </a>




                        </figure><!-- End .product-media -->




                        <div class="product-body">

                            <b>
                                <h1 class="product-title"><a href="product.html">Winch - CAT</a></h1>
                            </b><!-- End .product-title -->
                            <div class="product-price mb-0">
                                <span>€ 80,000</span>
                                <div class="custom-icon-tag-product">

                                    <img src="{{ URL::to('assets/images/tag-prod-blue.png') }}" alt="tag">

                                </div>

                            </div><!-- End .product-price -->
                            <div>
                                <span>Condition:</span> <span>Used</span> <br>
                                <span>Brand:</span> <span>CAT</span>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
                            </div>


                        </div><!-- End .product-body -->
                    </div><!-- End .product -->
                </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->


            </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->
        </div><!-- End .row -->
    </div><!-- End .products -->

    <div class="container for-you">
        <div>



        </div><!-- End .heading -->

        <div class="products">
            <div class="row justify-content-center">
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="product product-2">
                        <figure class="product-media">
                            <span class="product-label label-circle label-sale custom-position-tag">Sell</span>
                            <a href="product.html">
                                <img src="{{ URL::to('assets/images/cat-bulldozer-mike-burgquist.png') }}" alt="Product image" class="product-image">
                            </a>




                        </figure><!-- End .product-media -->




                        <div class="product-body">

                            <b>
                                <h1 class="product-title"><a href="product.html">Winch - CAT</a></h1>
                            </b><!-- End .product-title -->
                            <div class="product-price mb-0">
                                <span>€ 80,000</span>
                                <div class="custom-icon-tag-product">

                                    <img src="{{ URL::to('assets/images/tag-prod.png') }}" alt="tag">

                                </div>

                            </div><!-- End .product-price -->
                            <div>
                                <span>Condition:</span> <span>Used</span> <br>
                                <span>Brand:</span> <span>CAT</span>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
                            </div>


                        </div><!-- End .product-body -->
                    </div><!-- End .product -->
                </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->

                <div class="col-6 col-md-4 col-lg-3">
                    <div class="product product-2">
                        <figure class="product-media">
                            <span class="product-label label-circle label-sale custom-position-tag product-label-rent">Rent</span>
                            <a href="product.html">
                                <img src="{{ URL::to('assets/images/cat-bulldozer-mike-burgquist.png') }}" alt="Product image" class="product-image">
                            </a>




                        </figure><!-- End .product-media -->




                        <div class="product-body">

                            <b>
                                <h1 class="product-title"><a href="product.html">Winch - CAT</a></h1>
                            </b><!-- End .product-title -->
                            <div class="product-price mb-0">
                                <span>€ 80,000</span>
                                <div class="custom-icon-tag-product">

                                    <img src="{{ URL::to('assets/images/tag-prod-blue.png') }}" alt="tag">

                                </div>

                            </div><!-- End .product-price -->
                            <div>
                                <span>Condition:</span> <span>Used</span> <br>
                                <span>Brand:</span> <span>CAT</span>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
                            </div>


                        </div><!-- End .product-body -->
                    </div><!-- End .product -->
                </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->

                <div class="col-6 col-md-4 col-lg-3">
                    <div class="product product-2">
                        <figure class="product-media">
                            <span class="product-label label-circle label-sale custom-position-tag">Sell</span>
                            <a href="product.html">
                                <img src="{{ URL::to('assets/images/cat-bulldozer-mike-burgquist.png') }}" alt="Product image" class="product-image">
                            </a>




                        </figure><!-- End .product-media -->




                        <div class="product-body">

                            <b>
                                <h1 class="product-title"><a href="product.html">Winch - CAT</a></h1>
                            </b><!-- End .product-title -->
                            <div class="product-price mb-0">
                                <span>€ 80,000</span>
                                <div class="custom-icon-tag-product">

                                    <img src="{{ URL::to('assets/images/Icon color.png') }}" alt="tag">

                                </div>

                            </div><!-- End .product-price -->
                            <div>
                                <span>Condition:</span> <span>Used</span> <br>
                                <span>Brand:</span> <span>CAT</span>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
                            </div>


                        </div><!-- End .product-body -->
                    </div><!-- End .product -->
                </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->

                <div class="col-6 col-md-4 col-lg-3">
                    <div class="product product-2">
                        <figure class="product-media">
                            <span class="product-label label-circle label-sale custom-position-tag product-label-rent">Rent</span>
                            <a href="product.html">
                                <img src="{{ URL::to('assets/images/cat-bulldozer-mike-burgquist.png') }}" alt="Product image" class="product-image">
                            </a>




                        </figure><!-- End .product-media -->




                        <div class="product-body">

                            <b>
                                <h1 class="product-title"><a href="product.html">Winch - CAT</a></h1>
                            </b><!-- End .product-title -->
                            <div class="product-price mb-0">
                                <span>€ 80,000</span>
                                <div class="custom-icon-tag-product">

                                    <img src="{{ URL::to('assets/images/tag-prod-blue.png') }}" alt="tag">

                                </div>

                            </div><!-- End .product-price -->
                            <div>
                                <span>Condition:</span> <span>Used</span> <br>
                                <span>Brand:</span> <span>CAT</span>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
                            </div>


                        </div><!-- End .product-body -->
                    </div><!-- End .product -->
                </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->


            </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->
        </div><!-- End .row -->
    </div><!-- End .products -->
    <div class="container heading-left mt-2">
        <h2 class="title  mb-3 theme-color-gray">About the category </h2><!-- End .title text-center mb-2 -->
        <p class="mt-0 mb-2">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
            Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea.</p>
        <a href="#">
            <h6 class="theme-color-blue mb-2">Read more <i class="fa fa-angle-right"></i></h6>
        </a>
    </div><!-- End .heading-left -->
</main><!-- End .main -->
@endsection