@extends('front_new/layout/layout')
@section('container')
<main class="main">
    <div class="container d-flex align-items-center mt-1 mb-1">
        <ol class="breadcrumb">
            <li class="breadcrumb-item theme-color-blue "><a href="index.html">Home</a></li>
            <li class="breadcrumb-item " aria-current="page">Marine &amp; Offshore</li>
            <li class="breadcrumb-item active " aria-current="page">Deck Equipment</li>
        </ol>


    </div>
    <div class="container">
        <div class="product-details-top mb-2">
            <div class="row">
                <div class="col-md-6">
                    <div class="product-gallery">
                        <figure class="product-main-image">
                            <img id="product-zoom" src="{{ URL::to('public/assets/images/products/single/extended/3.jpg') }}" data-zoom-image="{{ URL::to('public/assets/images/products/single/extended/3-big.jpg') }}" alt="product image">

                            <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                <i class="icon-arrows"></i>
                            </a>
                        </figure><!-- End .product-main-image -->

                        <div id="product-zoom-gallery" class="product-image-gallery">
                            <a class="product-gallery-item" href="#" data-image="{{ URL::to('public/assets/images/products/single/extended/1.jpg') }}" data-zoom-image="{{ URL::to('public/assets/images/products/single/extended/1-big.jpg') }}">
                                <img src="{{ URL::to('public/assets/images/products/single/extended/1-small.jpg') }}" alt="product side">
                            </a>

                            <a class="product-gallery-item" href="#" data-image="{{ URL::to('public/assets/images/products/single/extended/2.jpg') }}" data-zoom-image="{{ URL::to('public/assets/images/products/single/extended/2-big.jpg') }}">
                                <img src="{{ URL::to('public/assets/images/products/single/extended/2-small.jpg') }}" alt="product cross">
                            </a>

                            <a class="product-gallery-item active" href="#" data-image="{{ URL::to('public/assets/images/products/single/extended/3.jpg') }}" data-zoom-image="{{ URL::to('public/assets/images/products/single/extended/3-big.jpg') }}">
                                <img src="{{ URL::to('public/assets/images/products/single/extended/3-small.jpg') }}" alt="product with model">
                            </a>

                            <a class="product-gallery-item" href="#" data-image="{{ URL::to('public/assets/images/products/single/extended/4.jpg') }}" data-zoom-image="{{ URL::to('public/assets/images/products/single/extended/4-big.jpg') }}">
                                <img src="{{ URL::to('public/assets/images/products/single/extended/4-small.jpg') }}" alt="product back">
                            </a>
                            <a class="product-gallery-item" href="#" data-image="{{ URL::to('public/assets/images/products/single/extended/4.jpg') }}" data-zoom-image="{{ URL::to('public/assets/images/products/single/extended/4-big.jpg') }}">
                                <img src="{{ URL::to('public/assets/images/products/single/extended/4-small.jpg') }}" alt="product back">
                            </a>

                        </div><!-- End .product-image-gallery -->
                    </div><!-- End .product-gallery -->
                </div><!-- End .col-md-6 -->

                <div class="col-md-6">
                    <div class="product-details">
                        <h1 class="product-title">Winch - CAT</h1><!-- End .product-title -->

                        <div class="ratings-container">
                            <div class="ratings">
                                <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
                            </div><!-- End .ratings -->
                            <a class="ratings-text" href="#product-review-link" id="review-link">( 2 Reviews )</a>
                        </div><!-- End .rating-container -->

                        <div class="product-price">
                            $70.00
                        </div><!-- End .product-price -->

                        <div class="product-content">
                            <p>Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero eu augue. Morbi purus libero, faucibus adipiscing. Sed lectus. </p>
                        </div><!-- End .product-content -->

                        <div class="details-filter-row details-row-size">
                            <label>Color:</label>

                            <div class="product-nav product-nav-dots">
                                <a href="#" class="active" style="background: #eab656;"><span class="sr-only">Color name</span></a>
                                <a href="#" style="background: #333333;"><span class="sr-only">Color name</span></a>
                                <a href="#" style="background: #3a588b;"><span class="sr-only">Color name</span></a>
                                <a href="#" style="background: #caab97;"><span class="sr-only">Color name</span></a>
                            </div><!-- End .product-nav -->
                        </div><!-- End .details-filter-row -->

                        <div class="details-filter-row details-row-size">
                            <label for="size">Size:</label>
                            <div class="select-custom">
                                <select name="size" id="size" class="form-control">
                                    <option value="#" selected="selected">Select a size</option>
                                    <option value="s">Small</option>
                                    <option value="m">Medium</option>
                                    <option value="l">Large</option>
                                    <option value="xl">Extra Large</option>
                                </select>
                            </div><!-- End .select-custom -->

                            <a href="#" class="size-guide"><i class="icon-th-list"></i>size guide</a>
                        </div><!-- End .details-filter-row -->

                        <div class="details-filter-row details-row-size">
                            <label for="qty">Qty:</label>
                            <div class="product-details-quantity">
                                <input type="number" id="qty" class="form-control" value="1" min="1" max="10" step="1" data-decimals="0" required="" style="display: none;">
                                <div class="input-group  input-spinner">
                                    <div class="input-group-prepend"><button style="min-width: 26px" class="btn btn-decrement btn-spinner" type="button"><i class="icon-minus"></i></button></div><input type="text" style="text-align: center" class="form-control " required="" placeholder="">
                                    <div class="input-group-append"><button style="min-width: 26px" class="btn btn-increment btn-spinner" type="button"><i class="icon-plus"></i></button></div>
                                </div>
                            </div><!-- End .product-details-quantity -->
                        </div><!-- End .details-filter-row -->

                        <div class="product-details-action">
                            <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>

                            <div class="details-action-wrapper">
                                <a href="#" class="btn-product btn-wishlist" title="Wishlist"><span>Add to Wishlist</span></a>
                                <a href="#" class="btn-product btn-compare" title="Compare"><span>Add to Compare</span></a>
                            </div><!-- End .details-action-wrapper -->
                        </div><!-- End .product-details-action -->

                        <div class="product-details-footer">
                            <div class="product-cat">
                                <span>Category:</span>
                                <a href="#">Women</a>,
                                <a href="#">Shoes</a>,
                                <a href="#">Sandals</a>,
                                <a href="#">Yellow</a>
                            </div><!-- End .product-cat -->

                            <div class="social-icons social-icons-sm">
                                <span class="social-label">Share:</span>
                                <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                <a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                            </div>
                        </div><!-- End .product-details-footer -->
                    </div><!-- End .product-details -->
                </div><!-- End .col-md-6 -->
            </div><!-- End .row -->
        </div><!-- End .product-details-top -->
    </div>

</main><!-- End .main -->
@endsection