<!DOCTYPE html>
<html lang="en">


<!-- molla/login.html  22 Nov 2019 10:04:03 GMT -->

<head>
    <title>Remora Services</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="keywords" content="Remora">
    <meta name="description" content="Remora Services">
    <meta name="author" content="Remora Services">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ URL::to('public/assets/images/icons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ URL::to('public/assets/images/icons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::to('public/assets/images/icons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ URL::to('public/assets/images/icons/site.html') }}">
    <link rel="mask-icon" href="{{ URL::to('public/assets/images/icons/safari-pinned-tab.svg') }}" color="#666666">
    <link rel="shortcut icon" href="{{ URL::to('public/assets/images/icons/favicon.ico') }}">
    <meta name="apple-mobile-web-app-title" content="Molla">
    <meta name="application-name" content="Molla">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="{{ URL::to('public/assets/images/icons/browserconfig.xml') }}">
    <meta name="theme-color" content="#ffffff">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{ URL::to('public/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('public/assets/css/plugins/owl-carousel/owl.carousel.css') }} ">
    <link rel="stylesheet" href="{{ URL::to('public/assets/css/plugins/magnific-popup/magnific-popup.css') }}">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ URL::to('public/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ URL::to('public/assets/css/skins/skin-demo-21.css') }}">
    <link rel="stylesheet" href="{{ URL::to('public/assets/css/demos/demo-21.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css"> -->



</head>

<body>
    <div class="page-wrapper">
        <header class="header">

            <div class="header-middle sticky-header">
                <div class="container">
                    <div class="header-left">
                        <button class="mobile-menu-toggler">
                            <span class="sr-only">Toggle mobile menu</span>
                            <i class="icon-bars"></i>
                        </button>

                        <a href="index.html" class="logo">
                            <img src="{{ URL::to('public/assets/images/demos/demo-21/logo.png') }}" alt="Remora Logo" width="100" height="25">
                        </a>

                        <nav class="main-nav">
                            <ul class="menu sf-arrows">
                                <li>
                                    <a href="product.html" class="sf-with-ul">Categories</a>

                                    <div class="megamenu megamenu-sm">
                                        <div class="row no-gutters">
                                            <div class="col-md-6">
                                                <div class="menu-col">
                                                    <div class="menu-title">Products</div><!-- End .menu-title -->
                                                    <ul>
                                                        <li><a href="#">prodcut 1</a></li>
                                                        <li><a href="#">prodcut 2</a></li>
                                                        <li><a href="#">prodcut 3</a></li>
                                                        <li><a href="#">prodcut 4</a></li>
                                                        <li><a href="#">prodcut 5</a></li>
                                                        <li><a href="#">prodcut 6</a></li>
                                                        <li><a href="#">prodcut 7</a></li>
                                                    </ul>
                                                </div><!-- End .menu-col -->
                                            </div><!-- End .col-md-6 -->
                                        </div><!-- End .row -->
                                    </div><!-- End .megamenu megamenu-sm -->
                                </li>
                                <li>
                                    <a href="#">About us</a>
                                </li>
                                <li>
                                    <a href="#">Sell Equipment</a>
                                </li>
                                <li>
                                    <a href="#">Advertising</a>
                                </li>

                            </ul><!-- End .menu -->
                        </nav><!-- End .main-nav -->
                    </div><!-- End .header-left -->

                    <div class="header-right">
                        <!-- <div class="header-search">
                          <a href="#" class="search-toggle" role="button" title="Search"><i class="icon-search"></i></a>
                          <form action="#" method="get">
                              <div class="header-search-wrapper">
                                  <label for="q" class="sr-only">Search</label>
                                  <input type="search" class="form-control" name="q" id="q" placeholder="Search in..." required>
                              </div>
                          </form>
                      </div> -->

                        @auth
                        <div class="wishlist add-product-btn">
                            <span> <i class="fa fa-sign-in"></i> </span>
                            <button type="submit" class="btn btn-outline-primary-2 ">
                                <span class="pr-2"><img src="{{ URL::to('public/assets/images/icons/add-icon.png') }}"></span> <span>Add Product</span>

                            </button>


                        </div><!-- End .compare-dropdown -->
                        <div class="pr-4 pl-4">
                            <a href="#" class="pr-3"> <img src="{{ URL::to('public/assets/images/icons/ring.png') }}" alt="ring-icon"></a>
                            <a href="#"> <img src="{{ URL::to('public/assets/images/icons/message-icon.png') }}" alt="message-icon"></a>
                        </div>

                        <div class="dropdown cart-dropdown">
                            <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                <img src="assets/images/dp.png" alt="dp" width="40px" height="40px">

                            </a>

                            <div class="dropdown-menu dropdown-menu-right">



                                <div class="dropdown-cart-action">
                                    <a href="cart.html" class="btn btn-primary">Log Out</a>

                                </div><!-- End .dropdown-cart-total -->
                            </div><!-- End .dropdown-menu -->
                        </div>
                        @endauth
                        @guest
                        <div class="wishlist">
                            <span> <i class="fa fa-sign-in"></i> </span>
                            <button type="submit" class="btn btn-outline-primary-2 login">
                                <span>Log in</span>

                            </button>


                        </div><!-- End .compare-dropdown -->

                        <div class="dropdown cart-dropdown wishlist">
                            <span> <i class="fa fa-user-circle"></i> </span>
                            <button type="submit" class="btn btn-outline-primary-2 register">
                                <span>Register</span>

                            </button>


                        </div><!-- End .cart-dropdown -->
                        @endguest
                    </div><!-- End .header-right -->
                </div><!-- End .container -->
            </div><!-- End .header-middle -->
        </header><!-- End .header -->


        <!-- Main content -->
        @section('container')
        @show


        <footer class="footer ">
            <div class="container mt-4">

                <div class="row justify-content-center">

                    <div class="col-sm-6 col-md-3 col-lg-3">
                        <div class="cta-heading text-left">
                            <h3 class="cta-title text-black">Subscribe Newsletter</h3><!-- End .cta-title -->
                            <p class="cta-desc text-gray">Receive the latest listings in your inbox</p>
                            <!-- End .cta-desc -->
                        </div><!-- End .text-center -->


                    </div><!-- End .col-sm-10 col-md-8 col-lg-6 -->

                    <div class="col-sm-6 col-md-6 col-lg-6">


                        <form action="#">
                            <div class="input-group input-group-round">
                                <input type="email" class="form-control form-control-white"
                                    placeholder="Enter your email" aria-label="Email Adress" required="">
                                <div class="input-group-append">
                                    <button class="btn btn-white" style="background-color: #06CF7D;" type="submit"><span
                                            class="text-white">Subscribe</span></button>
                                </div><!-- .End .input-group-append -->
                            </div><!-- .End .input-group -->
                        </form>
                    </div><!-- End .col-sm-10 col-md-8 col-lg-6 -->

                </div>
                <hr class="mt-0 mb-0 " style="background-color: #00000030; height: 1px;">

                <div class="row" style="padding-bottom:4%; padding-top:4%;">
                    <div class="col-md-3">

                        <img src="{{ URL::to('public/assets/images/demos/demo-21/logo-footer.png') }}" class="footer-logo m-auto"
                            alt="Footer Logo" width="100" height="25">
                    </div>

                    <div class="col-md-6 custom-footer-padding ">

                        <a class="pr-4" href="#">Market Place</a>
                        <a class="pr-4" href="#">Sell Product</a>
                        <a class="pr-4" href="#">About Us</a>
                        <a class="pr-4" href="#">Terms & Conditions</a>
                        <a href="#">Privacy Policy</a>

                    </div>

                    <div class="col-md-3">
                        <div class="social-icons social-icons-color">
                            <a href="#" class="social-icon social-facebook" title="Facebook" target="_blank"><img src="{{ URL::to('public/assets/images/facebook.png') }}"></a>
                            <a href="#" class="social-icon social-twitter" title="Twitter" target="_blank"><img src="{{ URL::to('public/assets/images/linkdin.png') }}"></a>
                            <a href="#" class="social-icon social-instagram" title="Instagram" target="_blank"><img src="{{ URL::to('public/assets/images/msg.png') }}"></a>
                        </div><!-- End .soial-icons -->
                    </div>

                </div><!-- End .container -->
            </div><!-- End .footer-bottom -->
        </footer><!-- End .footer -->


    </div><!-- End .page-wrapper -->
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

    <!-- Mobile Menu -->
    <div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

    <div class="mobile-menu-container">
        <div class="mobile-menu-wrapper">
            <span class="mobile-menu-close"><i class="icon-close"></i></span>

            <form action="#" method="get" class="mobile-search">
                <label for="mobile-search" class="sr-only">Search</label>
                <input type="search" class="form-control" name="mobile-search" id="mobile-search" placeholder="Search in..." required>
                <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
            </form>

            <nav class="mobile-nav">
                <ul class="mobile-menu">
                    <li class="active">
                        <a href="index.html">Home</a>
                    </li>
                    <li>
                        <a href="category.html">Category</a>
                        <ul>
                            <li><a href="#">Prodcut 1</a></li>
                            <li><a href="#">Prodcut 2</a></li>
                            <li><a href="#">Prodcut 3</a></li>
                            <li><a href="#">Prodcut 4</a></li>
                            <li><a href="#">Prodcut 5</a></li>
                            <li><a href="#">Prodcut 6</a></li>
                            <li><a href="#">Prodcut 7</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">About Us</a>
                    </li>
                    <li>
                        <a href="#">Sell Equipment</a>
                    </li>
                    <li>
                        <a href="#">Advertising</a>
                    </li>

                </ul>
            </nav><!-- End .mobile-nav -->

            <div class="social-icons">
                <a href="#" class="social-icon" target="_blank" title="Facebook"><i class="icon-facebook-f"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Twitter"><i class="icon-twitter"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Instagram"><i class="icon-instagram"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Youtube"><i class="icon-youtube"></i></a>
            </div><!-- End .social-icons -->
        </div><!-- End .mobile-menu-wrapper -->
    </div><!-- End .mobile-menu-container -->


    <!-- Plugins JS File -->
    <script src="{{ URL::to('public/assets/js/jquery.min.js') }}"></script>
    <script src="{{ URL::to('public/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ URL::to('public/assets/js/jquery.hoverIntent.min.js') }}"></script>
    <script src="{{ URL::to('public/assets/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ URL::to('public/assets/js/superfish.min.js') }}"></script>
    <script src="{{ URL::to('public/assets/js/owl.carousel.min.js') }}"></script>
    <!-- Main JS File -->
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <script src="{{ URL::to('public/assets/js/main.js') }}"></script>
    <script>
        $('.login').on('click', function() {
            window.location.href = "{{ route('login') }}";
        })

        $('.register').on('click', function() {
            window.location.href = "{{ route('register') }}";
        })
    </script>

</body>


<!-- molla/login.html  22 Nov 2019 10:04:03 GMT -->

</html>