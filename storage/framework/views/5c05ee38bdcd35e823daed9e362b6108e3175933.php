<!DOCTYPE html>
<html lang="en">


<!-- Remora/login.html  22 Nov 2019 10:04:03 GMT -->

<head>
    <title>Remora Services</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="keywords" content="Remora">
    <meta name="description" content="Remora Services">
    <meta name="author" content="Remora Services">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(URL::to('public/assets/images/icons/apple-touch-icon.png')); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(URL::to('public/assets/images/icons/favicon-32x32.png')); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(URL::to('public/assets/images/icons/favicon-16x16.png')); ?>">
    <link rel="manifest" href="<?php echo e(URL::to('public/assets/images/icons/site.html')); ?>">
    <link rel="mask-icon" href="<?php echo e(URL::to('public/assets/images/icons/safari-pinned-tab.svg')); ?>" color="#666666">
    <link rel="shortcut icon" href="<?php echo e(URL::to('public/assets/images/icons/favicon_new.ico')); ?>">
    <meta name="apple-mobile-web-app-title" content="Remora">
    <meta name="application-name" content="Remora">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="<?php echo e(URL::to('public/assets/images/icons/browserconfig.xml')); ?>">
    <meta name="theme-color" content="#ffffff">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="<?php echo e(URL::to('public/assets/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(URL::to('public/assets/css/plugins/owl-carousel/owl.carousel.css')); ?> ">
    <link rel="stylesheet" href="<?php echo e(URL::to('public/assets/css/plugins/magnific-popup/magnific-popup.css')); ?>">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="<?php echo e(URL::to('public/assets/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(URL::to('public/assets/css/skins/skin-demo-21.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(URL::to('public/assets/css/demos/demo-21.css')); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet"  href="<?php echo e(URL::to('public/assets/css/skins/intlTelInput.css')); ?>">
    <!-- <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css"> -->



</head>

<body>
    <div class="page-wrapper">
    <header class="header">

<div class="header-middle sticky-header">
<<<<<<< HEAD
    <div class="container">
=======
    <div class="container-fluid" style="height:70px;">
>>>>>>> a1b86081e0cd2ffbe83ba4d152d3f774c55f5fc9
        <div class="header-left">
            <button class="mobile-menu-toggler">
                <span class="sr-only">Toggle mobile menu</span>
                <i class="icon-bars"></i>
            </button>

            <a href="<?php echo e(URL::to('/')); ?>" class="logo">
                <img src="<?php echo e(URL::to('public/assets/images/demos/demo-21/logo.png')); ?>" alt="Remora Logo" width="100" height="25">
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

            <?php if(auth()->guard()->check()): ?>
            <div class="wishlist add-product-btn">
                <span> <i class="fa fa-sign-in"></i> </span>
                <button type="submit" class="btn btn-outline-primary-2 ">
                    <span class="pr-2"><img src="<?php echo e(URL::to('public/assets/images/icons/add-icon.png')); ?>"></span> <span>Add Product</span>

                </button>


            </div><!-- End .compare-dropdown -->
            <div class="pr-4 pl-4">
                <a href="#" class="pr-3"> <img src="<?php echo e(URL::to('public/assets/images/icons/ring.png')); ?>" alt="ring-icon"></a>
                <a href="#"> <img src="<?php echo e(URL::to('public/assets/images/icons/message-icon.png')); ?>" alt="message-icon"></a>
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
            <?php endif; ?>
            <?php if(auth()->guard()->guest()): ?>
            <div class="wishlist">
                <span> <i class="fa fa-sign-in"></i> </span>
                
                <button type="submit" class="btn btn-primary-custom-hdr-before">Login</button>
                   

                </button>


            </div><!-- End .compare-dropdown -->

            <div class="dropdown cart-dropdown wishlist">
                <span> <i class="fa fa-user-circle"></i> </span>
                <button type="submit" class="btn btn-primary-custom-hdr">Register</button>

                </button>


            </div><!-- End .cart-dropdown -->
            <?php endif; ?>
        </div><!-- End .header-right -->
    </div><!-- End .container -->
</div><!-- End .header-middle -->
</header><!-- End .header -->



        <!-- Main content -->
        <?php $__env->startSection('container'); ?>
        <?php echo $__env->yieldSection(); ?>

        <footer class="footer ">
                    <div class="container-fluid">
                        <div class="row" style="padding-bottom:7rem; padding-top:5rem;">
							<div class="col-md-3">

                                <img src="<?php echo e(URL::to('public/assets/images/demos/demo-21/logo-footer.png')); ?>" class="footer-logo m-auto" alt="Footer Logo" width="150" height="35">
                          </div>

						   <div class="col-md-7 custom-footer-menu pt-2 theme-color-gray">

                                   <a  href="#">Market Place</a>
                                   <a  href="#">Sell Product</a>
                                    <a  href="#">About Us</a>
                                     <a  href="#">Terms & Conditions</a>
                                     <a href="#">Privacy Policy</a>

							</div>

                            <div class="col-md-2">
                                <div class="social-icons social-icons-color">
                                <a href="#" class="social-icon social-facebook" title="Facebook" target="_blank"><img src="<?php echo e(URL::to('public/assets/images/facebook.png')); ?>"></a>
                            <a href="#" class="social-icon social-twitter" title="Twitter" target="_blank"><img src="<?php echo e(URL::to('public/assets/images/linkdin.png')); ?>"></a>
                            <a href="#" class="social-icon social-instagram" title="Instagram" target="_blank"><img src="<?php echo e(URL::to('public/assets/images/msg.png')); ?>"></a>
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
    <script src="<?php echo e(URL::to('public/assets/js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(URL::to('public/assets/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(URL::to('public/assets/js/jquery.hoverIntent.min.js')); ?>"></script>
    <script src="<?php echo e(URL::to('public/assets/js/jquery.waypoints.min.js')); ?>"></script>
    <script src="<?php echo e(URL::to('public/assets/js/superfish.min.js')); ?>"></script>
    <script src="<?php echo e(URL::to('public/assets/js/owl.carousel.min.js')); ?>"></script>
    <script src="<?php echo e(URL::to('public/assets/js/intlTelInput.js')); ?>"></script>
    <!-- Main JS File -->
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <script src="<?php echo e(URL::to('public/assets/js/main.js')); ?>"></script>
    <script>
        $('.login').on('click', function() {
            window.location.href = "<?php echo e(route('login')); ?>";
        })

        $('.register').on('click', function() {
            window.location.href = "<?php echo e(route('register')); ?>";
        })
    </script>
  <script>
        var input = document.querySelector("#phone");
        window.intlTelInput(input, {
          utilsScript: "<?php echo e(URL::to('public/assets/js/utils.js')); ?>",
        });
      </script>
</body>


<!-- Remora/login.html  22 Nov 2019 10:04:03 GMT -->

</html><?php /**PATH C:\xampp\htdocs\dieren-plaats\resources\views/front_new/layout/login_layout.blade.php ENDPATH**/ ?>