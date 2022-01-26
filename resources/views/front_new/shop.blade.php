@extends('front_new/layout/layout')
@section('container')
<main class="main">
    <div class="container d-flex align-items-center">
        <ol class="breadcrumb mt-2">
            <li class="breadcrumb-item theme-color-blue "><a href="index.html">Home</a></li>
            <li class="breadcrumb-item " aria-current="page">Marine & Offshore</li>
            <li class="breadcrumb-item active " aria-current="page">Deck Equipment</li>
        </ol>


    </div>
    <div class="container">
        <h2 class="theme-color-blue mt-1">Deck Equipment <span class="custom-results-2000">2000 Results</span></h2>

    </div>
    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="toolbox">
                        <div class="toolbox-left">
                            <!-- <div class="toolbox-info">
                                Showing <span>9 of 56</span> Products
                            </div>End .toolbox-info -->
                            <div class="chip chip-custom">
                                Marine & Offshore
                                <img src="{{ URL::to('assets/images/icons/close-icon.svg') }}">
                            </div>
                            <div class="chip chip-custom">
                                Deck Equipment
                                <img src="{{ URL::to('assets/images/icons/close-icon.svg') }}">
                            </div>
                        </div><!-- End .toolbox-left -->

                        <div class="toolbox-right">
                            <div class="toolbox-sort">
                                <!-- <label for="sortby">Sort by:</label> -->

                                <img src="{{ URL::to('assets/images/icons/close-icon.svg') }}" >
                                <div class="select-custom">
                                    <select name="sortby" id="sortby" class="form-control">
                                    <option value="" disabled selected hidden >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sort By:</option> 
                                        <option value="">Lowest price</option>
                                        <option value="">Highest price</option>
                                        <option value="">Alphabet A-z</option>
                                        <option value="">Alphabet Z-a</option>
                                        
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="btn-group">
                                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span><img src="{{ URL::to('assets/images/icons/close-icon.svg') }}"></span>  Sort by:
                                </button>
                                <div class="dropdown-menu">
                                    <button class="dropdown-item" type="button">Action</button>
                                    <button class="dropdown-item" type="button">Another action</button>
                                    <button class="dropdown-item" type="button">Something else here</button>
                                </div>
                            </div> -->
                        </div><!-- End .toolbox-sort -->
                        <!-- <div class="toolbox-layout"> -->




                        <!-- </div>End .toolbox-layout -->
                        <!-- </div>End .toolbox-right -->

                    </div><!-- End .toolbox -->

                    <div class="products mb-3">
                        <div class="row justify-content-center">
                            <div class="col-6 col-md-4 col-lg-4">
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
                                </div>
                            </div><!-- End .col-sm-6 col-lg-4 -->

                            <div class="col-6 col-md-4 col-lg-4">
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
                                </div>
                            </div><!-- End .col-sm-6 col-lg-4 -->

                            <div class="col-6 col-md-4 col-lg-4">
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
                                </div>
                            </div><!-- End .col-sm-6 col-lg-4 -->

                            <div class="col-6 col-md-4 col-lg-4">
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
                                </div>
                            </div><!-- End .col-sm-6 col-lg-4 -->

                            <div class="col-6 col-md-4 col-lg-4">
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
                                </div>
                            </div><!-- End .col-sm-6 col-lg-4 -->

                            <div class="col-6 col-md-4 col-lg-4">
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
                                </div>
                            </div><!-- End .col-sm-6 col-lg-4 -->
                            <div class="col-6 col-md-4 col-lg-4">
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
                                </div>
                            </div><!-- End .col-sm-6 col-lg-4 -->

                            <div class="col-6 col-md-4 col-lg-4">
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
                                </div>
                            </div><!-- End .col-sm-6 col-lg-4 -->

                            <div class="col-6 col-md-4 col-lg-4">
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
                                </div>
                            </div><!-- End .col-sm-6 col-lg-4 -->
                            <div class="col-6 col-md-4 col-lg-4">
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
                                </div>
                            </div><!-- End .col-sm-6 col-lg-4 -->

                            <div class="col-6 col-md-4 col-lg-4">
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
                                </div>
                            </div><!-- End .col-sm-6 col-lg-4 -->

                            <div class="col-6 col-md-4 col-lg-4">
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
                                </div>
                            </div><!-- End .col-sm-6 col-lg-4 -->
                        </div><!-- End .row -->
                    </div><!-- End .products -->

                </div><!-- End .col-lg-9 -->
                <aside class="col-lg-3 order-lg-first ">
                    <div class="sidebar sidebar-shop custom-filter-border p-2">
                        <div class="widget-clean">
                            <label class="custom-font-size-filter">Filters by:</label>

                        </div><!-- End .widget widget-clean -->

                        <div class="widget widget-collapsible">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true" aria-controls="widget-1">
                                    Category
                                </a>
                            </h3><!-- End .widget-title -->

                            <div class="collapse show" id="widget-1">
                                <div class="widget-body">
                                    <div class="filter-items filter-items-count">
  
                                        <div class="custom-font-styling-label">
                                            <label class="custom-font-styling-label">One
                                                <!-- <input type="radio" name="radio"> -->
                                                <input type="radio" name="radio" checked>
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="custom-font-styling-label">two
                                                <input type="radio" name="radio">
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="custom-font-styling-label">three
                                                <input type="radio" name="radio">
                                                <span class="checkmark"></span>
                                            </label>
                                            <!-- <input type="radio"  style="background-color: red;">
                                            <label class="checkmark" for="html">HTML</label><br>
                                            <span class="item-count">(3)</span>
                                            <input type="radio" id="css" name="fav_language" value="CSS">
                                            <label for="css">CSS</label><br>
                                            <span class="item-count">(3)</span>
                                            <input type="radio" id="javascript" name="fav_language" value="JavaScript">
                                            <label for="javascript">JavaScript</label>
                                            <span class="item-count">(3)</span> -->

                                            <!-- </div> -->

                                        </div>
                                    </div><!-- End .widget-body -->
                                </div><!-- End .collapse -->
                            </div><!-- End .widget -->

                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-2" role="button" aria-expanded="true" aria-controls="widget-2">
                                        Sub-category:
                                    </a>
                                </h3><!-- End .widget-title -->

                                <div class="collapse show" id="widget-2">
                                    <div class="widget-body">
                                        <div class="filter-items filter-items-count">
                                            <div class="filter-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="size-1">
                                                    <label class="custom-control-label" for="size-1">Deck Equipment &nbsp; <span> (2) </span></label>
                                                    <!-- <span class="item-count">(2)</span> -->
                                                </div><!-- End .custom-checkbox -->
                                            </div><!-- End .filter-item -->

                                            <div class="filter-item filter-items-count">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="size-2">
                                                    <label class="custom-control-label" for="size-2">Subsea equipment &nbsp; <span> (2) </span></label>

                                                </div><!-- End .custom-checkbox -->
                                            </div><!-- End .filter-item -->

                                            <div class="filter-item filter-items-count">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" checked="" id="size-3">
                                                    <label class="custom-control-label" for="size-3">Renewables &nbsp; <span> (2) </span></label>

                                                </div><!-- End .custom-checkbox -->
                                            </div><!-- End .filter-item -->


                                        </div><!-- End .filter-items -->
                                    </div><!-- End .widget-body -->
                                </div><!-- End .collapse -->
                            </div><!-- End .widget -->

                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-2" role="button" aria-expanded="true" aria-controls="widget-2">
                                        Sub-category:
                                    </a>
                                </h3><!-- End .widget-title -->

                                <div class="collapse show" id="widget-2">
                                    <div class="widget-body">
                                        <div class="filter-items filter-items-count">
                                            <div class="filter-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="size-1">
                                                    <label class="custom-control-label" for="size-1">Deck Equipment &nbsp; <span> (2) </span></label>

                                                </div><!-- End .custom-checkbox -->
                                            </div><!-- End .filter-item -->



                                            <div class="filter-item filter-items-count">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" checked="" id="size-3">
                                                    <label class="custom-control-label" for="size-3">Renewables &nbsp; <span> (2) </span></label>

                                                </div><!-- End .custom-checkbox -->
                                            </div><!-- End .filter-item -->


                                        </div><!-- End .filter-items -->
                                    </div><!-- End .widget-body -->
                                </div><!-- End .collapse -->
                            </div><!-- End .widget -->

                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-2" role="button" aria-expanded="true" aria-controls="widget-2">
                                        Sub-category:
                                    </a>
                                </h3><!-- End .widget-title -->

                                <div class="collapse show" id="widget-2">
                                    <div class="widget-body">
                                        <div class="filter-items filter-items-count">
                                            <div class="filter-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="size-1">
                                                    <label class="custom-control-label" for="size-1">Deck Equipment &nbsp; <span> (2) </span></label>

                                                </div><!-- End .custom-checkbox -->
                                            </div><!-- End .filter-item -->



                                            <div class="filter-item filter-items-count">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" checked="" id="size-3">
                                                    <label class="custom-control-label" for="size-3">Renewables &nbsp; <span> (2) </span></label>

                                                </div><!-- End .custom-checkbox -->
                                            </div><!-- End .filter-item -->


                                        </div><!-- End .filter-items -->
                                    </div><!-- End .widget-body -->
                                </div><!-- End .collapse -->
                            </div><!-- End .widget -->

                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-5" role="button" aria-expanded="true" aria-controls="widget-5">
                                        Price
                                    </a>
                                </h3><!-- End .widget-title -->

                                <div class="collapse show" id="widget-5">
                                    <div class="widget-body">
                                        <div class="filter-price">
                                            <div class="filter-price-text">
                                                Price Range:
                                                <span id="filter-price-range">$0 - $750</span>
                                            </div><!-- End .filter-price-text -->

                                            <div id="price-slider" class="noUi-target noUi-ltr noUi-horizontal">
                                                <div class="noUi-base">
                                                    <div class="noUi-connects">
                                                        <div class="noUi-connect" style="transform: translate(0%, 0px) scale(0.75, 1);"></div>
                                                    </div>
                                                    <div class="noUi-origin" style="transform: translate(-100%, 0px); z-index: 5;">
                                                        <div class="noUi-handle noUi-handle-lower" data-handle="0" tabindex="0" role="slider" aria-orientation="horizontal" aria-valuemin="0.0" aria-valuemax="550.0" aria-valuenow="0.0" aria-valuetext="$0">
                                                            <div class="noUi-touch-area"></div>
                                                            <div class="noUi-tooltip">$0</div>
                                                        </div>
                                                    </div>
                                                    <div class="noUi-origin" style="transform: translate(-25%, 0px); z-index: 4;">
                                                        <div class="noUi-handle noUi-handle-upper" data-handle="1" tabindex="0" role="slider" aria-orientation="horizontal" aria-valuemin="200.0" aria-valuemax="1000.0" aria-valuenow="750.0" aria-valuetext="$750">
                                                            <div class="noUi-touch-area"></div>
                                                            <div class="noUi-tooltip">$750</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- End #price-slider -->
                                        </div><!-- End .filter-price -->
                                    </div><!-- End .widget-body -->
                                </div><!-- End .collapse -->
                            </div><!-- End .widget -->
                        </div><!-- End .sidebar sidebar-shop -->
                </aside><!-- End .col-lg-3 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div>


</main><!-- End .main -->
@endsection