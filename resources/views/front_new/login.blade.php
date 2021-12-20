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
                                  <a href="#"  >About us</a>
                              </li>
                              <li>
                                  <a href="#"  >Sell Equipment</a>
                              </li>
                              <li>
                                  <a href="#"  >Advertising</a>
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
                      <div class="wishlist">
                        <button type="submit" class="btn btn-outline-primary-2 login">
                            <span>Log in</span>

                        </button>
                        
                          
                      </div><!-- End .compare-dropdown -->

                      <div class="dropdown cart-dropdown">
                        <button type="submit" class="btn btn-outline-primary-2 register">
                            <span>Register</span>

                        </button>

                         
                      </div><!-- End .cart-dropdown -->
                  </div><!-- End .header-right -->
              </div><!-- End .container -->
          </div><!-- End .header-middle -->
      </header><!-- End .header -->

        <main class="main">
            

            <div class="login-page bg-image pt-5 pb-5" style="background-color: white;">
            	<div class="container">
            		<div class="form-box">
            			<div class="form-tab">
	            			<ul class="nav nav-pills nav-fill" role="tablist">
							    <li class="nav-item">
                    <span class="nav-link">Welcome Back</span>
							        <!-- <a class="nav-link" id="signin-tab-2" data-toggle="tab" href="#signin-2" role="tab" aria-controls="signin-2" aria-selected="false">Welcome Back</a> -->
							    </li>

							</ul>
                            <div class="text-center">
                                <span>Login to remora services</span>
                            </div>
							<div class="tab-content">

							    <div class="tab-pane fade show active" id="signin-2" role="tabpanel" aria-labelledby="register-tab-2">
							    	<form action="#">
							    		<div class="form-group">
							    			<label for="singin-email-2">Email</label>
							    			&nbsp;<input type="text" class="form-control" id="singin-email-2" name="singin-email" required style="padding-left:4rem;">
                        <span class="email_icon" ><i class="fa fa-envelope" aria-hidden="true"></i></span>
							    		</div>


							    		<div class="form-group">
							    			<label for="singin-password-2">Password</label>
							    			<input type="password" class="form-control" id="singin-password-2" name="singin-password" required style="padding-left:4rem;">
                        <span class="password_icon" ><i class="fa fa-lock" aria-hidden="true"></i></span>

							    		</div><!-- End .form-group -->
                                        <div class="form-footer">
                                        <a href="{{route('show_forgot_password')}}" class="forgot-link">Forgot Password?</a>
                                    </div>
							    		<div class="form-footer">
							    			<button type="submit" class="btn btn-outline-primary-2">
			                					<span>LOG IN</span>

			                				</button>


							    		</div><!-- End .form-footer -->
                                        <div class="m-4 text-center">
                                        
                                            <span>Don't have an account?</span> <a href="#">Register</a>
                                        </div>
							    	</form>

							    </div><!-- .End .tab-pane -->
							</div><!-- End .tab-content -->
							</div><!-- End .tab-content -->
						</div><!-- End .form-tab -->
            		</div><!-- End .form-box -->
            	</div><!-- End .container -->
            </div><!-- End .login-page section-bg -->
        </main><!-- End .main -->

        <footer class="footer ">
                    <div class="container">
                        <div class="row" style="padding-bottom:4%; padding-top:4%;">
							<div class="col-md-3">

                                <img src="{{ URL::to('public/assets/images/demos/demo-21/logo-footer.png') }}" class="footer-logo m-auto" alt="Footer Logo" width="100" height="25">
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

    <!-- Sign in / Register Modal -->
    <div class="modal fade" id="signin-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="icon-close"></i></span>
                    </button>

                    <div class="form-box">
                        <div class="form-tab">
                            <ul class="nav nav-pills nav-fill" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin" role="tab" aria-controls="signin" aria-selected="true">Sign In</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">Register</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="tab-content-5">
                                <div class="tab-pane fade show active" id="signin" role="tabpanel" aria-labelledby="signin-tab">
                                    <form action="#">
                                        <div class="form-group">
                                            <label for="singin-email">Username or email address *</label>
                                            <input type="text" class="form-control" id="singin-email" name="singin-email" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-group">
                                            <label for="singin-password">Password *</label>
                                            <input type="password" class="form-control" id="singin-password" name="singin-password" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-outline-primary-2">
                                                <span>LOG IN</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </button>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="signin-remember">
                                                <label class="custom-control-label" for="signin-remember">Remember Me</label>
                                            </div><!-- End .custom-checkbox -->

                                            <a href="" class="forgot-link">Forgot Your Password?</a>
                                        </div><!-- End .form-footer -->
                                    </form>
                                    <div class="form-choice">
                                        <p class="text-center">or sign in with</p>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <a href="#" class="btn btn-login btn-g">
                                                    <i class="icon-google"></i>
                                                    Login With Google
                                                </a>
                                            </div><!-- End .col-6 -->
                                            <div class="col-sm-6">
                                                <a href="#" class="btn btn-login btn-f">
                                                    <i class="icon-facebook-f"></i>
                                                    Login With Facebook
                                                </a>
                                            </div><!-- End .col-6 -->
                                        </div><!-- End .row -->
                                    </div><!-- End .form-choice -->
                                </div><!-- .End .tab-pane -->
                                <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                                    <form action="#">
                                        <div class="form-group">
                                            <label for="register-email">Your email address *</label>
                                            <input type="email" class="form-control" id="register-email" name="register-email" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-group">
                                            <label for="register-password">Password *</label>
                                            <input type="password" class="form-control" id="register-password" name="register-password" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-outline-primary-2">
                                                <span>SIGN UP</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </button>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="register-policy" required>
                                                <label class="custom-control-label" for="register-policy">I agree to the <a href="#">privacy policy</a> *</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .form-footer -->
                                    </form>
                                    <div class="form-choice">
                                        <p class="text-center">or sign in with</p>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <a href="#" class="btn btn-login btn-g">
                                                    <i class="icon-google"></i>
                                                    Login With Google
                                                </a>
                                            </div><!-- End .col-6 -->
                                            <div class="col-sm-6">
                                                <a href="#" class="btn btn-login  btn-f">
                                                    <i class="icon-facebook-f"></i>
                                                    Login With Facebook
                                                </a>
                                            </div><!-- End .col-6 -->
                                        </div><!-- End .row -->
                                    </div><!-- End .form-choice -->
                                </div><!-- .End .tab-pane -->
                            </div><!-- End .tab-content -->
                        </div><!-- End .form-tab -->
                    </div><!-- End .form-box -->
                </div><!-- End .modal-body -->
            </div><!-- End .modal-content -->
        </div><!-- End .modal-dialog -->
    </div><!-- End .modal -->

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
        $('.login').on('click',function(){
            window.location.href = "{{ route('login') }}";
        })

        $('.register').on('click',function(){
            window.location.href = "{{ route('register') }}";
        })
    </script>
</body>


<!-- molla/login.html  22 Nov 2019 10:04:03 GMT -->
</html>
