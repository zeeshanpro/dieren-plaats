<?php
$title         = View::getSection('title');
$showMiddleBar = View::getSection('showMiddleBar');
$publicPath    = env('ASSETS_PATH');

?><!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta name="csrf-tokenbase" content="<?php echo e(csrf_token()); ?>" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="<?php echo e(asset( $publicPath . 'front_assets/css/common.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset( $publicPath . 'front_assets/css/style.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset( $publicPath . 'front_assets/css/my.css')); ?>" rel="stylesheet">

    <title>Dieren Plaats - Sales Platform for Pets</title>
  </head>
  <body>
    <!--============== HEADER STARTS HERE ==============-->
    <header>
      <?php $msgCount = app('App\Repositories\Front\MessageRepository'); ?>
      <?php
      $unReadConversations=$msgCount->getUnreadMsgCount()['unReadConversations'];

      ?>

        <!-- TOP BAR -->
        <div class="top_bar">
            <div class="container">
                <div class="row">
                    <div class="col col-md-8 left_panel">
                        <a href="<?php echo e(url('/')); ?>"><div class="logo">
                            <img src="<?php echo e(asset( $publicPath . 'front_assets/images/logo-small.png')); ?>" />
                        </div>
                        </a>
                        <nav class="navbar navbar-expand-lg navbar-light">
                            <div class="container-fluid">
                              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                              </button>
                              <div class="collapse navbar-collapse" id="navbarNavDropdown">
                                <ul class="navbar-nav">
                                  <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                      <?php echo e(__('View all')); ?><br><strong><?php echo e(__('Categories')); ?></strong>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                      <li><a class="dropdown-item" href="#">Action</a></li>
                                      <li><a class="dropdown-item" href="#">Another action</a></li>
                                      <li><a class="dropdown-item" href="#">Something else here</a></li>
                                    </ul>
                                  </li>
                                </ul>
                              </div>
                            </div>
                          </nav>
                          <div class="search_box input-group">
                         <form method="get" action="<?php echo e(url('searchads')); ?>" id="frmSearchTop" style="display:contents" >
                            <input type="text" class="form-control" placeholder="<?php echo e(__('Search the entire store')); ?>" aria-label="Search the entire store" aria-describedby="searchTopBtn" id="searchTop" name="q" value="<?php echo e($query??''); ?>" style="width:85%" ></form>
                            <button class="btn btn-outline-secondary" type="button" id="searchTopBtn"><img src="<?php echo e(asset( $publicPath . 'front_assets/images/ico-search.svg')); ?>" /></button>
                          
                          </div>
                    </div>
                    <div class="col col-md-4 right_panel">
                        <nav class="navbar navbar-expand-lg navbar-light">
                            <div class="container-fluid">
                              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                              </button>
                              <div class="collapse navbar-collapse" id="navbarNavDropdown">
                                <?php if($unReadConversations>0): ?>
                                    <span  class="text-center myAccountBadge"><?php echo e($unReadConversations); ?></span>
                                <?php endif; ?>
                                <ul class="navbar-nav">
                                  <li class="nav-item dropdown">
                                  <?php if(auth()->guard()->check()): ?>
                                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="<?php echo e(asset( $publicPath . 'front_assets/images/user.svg')); ?>" />
                                      <?php echo e(__('My Account')); ?>

                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                     
                                      <li><a class="dropdown-item" href="<?php echo e(route('showMyAds')); ?>"><?php echo e(__('My Ads')); ?></a></li>
                                      <li><a class="dropdown-item" href="<?php echo e(route('showMyExpectedBabies')); ?>">Mijn <?php echo e(__('Expected Babies')); ?></a></li> 
                                      <div class="dropdown-divider"></div>
                                      <li><a class="dropdown-item" href="<?php echo e(route('createad_showkinds')); ?>"><?php echo e(__('Create Ad')); ?></a></li>
                                      <li><a class="dropdown-item" href="<?php echo e(route('messages')); ?>"><?php echo e(__('Messages')); ?> 
                                         <?php if($unReadConversations>0): ?>
    <span class="badge badge-primary text-danger" style="background: beige;"><?php echo e($unReadConversations); ?> <?php echo e(__('New')); ?></span>
                                        <?php endif; ?>

                                      </a></li>
                                      <div class="dropdown-divider"></div>
                                      <li><a class="dropdown-item" href="<?php echo e(route('showprofileform')); ?>"><?php echo e(__('My Profile')); ?></a></li>
                                      <li><form method="POST" action="<?php echo e(route('logout')); ?>">
                                  <?php echo csrf_field(); ?>
                                <button type="submit" class="py-1 logoutButton">Logout &nbsp <i class="fa fa-sign-out-alt" aria-hidden="true"></i></button>
                                </form></li>
                                    </ul>
                                <?php endif; ?>
                                <?php if(auth()->guard()->guest()): ?>
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="<?php echo e(asset( $publicPath . 'front_assets/images/user.svg')); ?>" />
                                      <?php echo e(__('Sign up')); ?>

                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                      <li><a class="dropdown-item" href="/register"><?php echo e(__('Register')); ?></a></li>
                                      <li><a class="dropdown-item" href="/login"><?php echo e(__('Login')); ?></a></li>
                                    </ul>
                                <?php endif; ?>
                                  </li>
                                </ul>
                              </div>
                            </div>
                          </nav>
                          <a href="<?php echo e(route('showsavedads')); ?>"><img src="<?php echo e(asset( $publicPath . 'front_assets/images/actions-heart_outlined.svg')); ?>" /></a>
                          <a href="#" class="mobile_menu" data-bs-toggle="modal" data-bs-target="#mobile_menu"><i class="bi bi-list"></i></a>
                    </div>

                </div>
            </div>
        </div>
        <!-- TOP BAR -->
        <!-- MIDDLE BAR -->
        <?php if($showMiddleBar=="true"): ?>
        <?php echo $__env->make('front.layout.components.middlemenu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
        <!-- MIDDLE BAR ENDS HERE -->

        <!-- BOTTOM BAR -->
        <div class="bottom_bar">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 left_panel">
                        <ul>
                            <li><a href="#"><img src="<?php echo e(asset( $publicPath . 'front_assets/images/checkmark_circle_outlined.svg')); ?>" /> <?php echo e(__('Professional Breeders')); ?></a></li>
                            <li><a href="#"><img src="<?php echo e(asset( $publicPath . 'front_assets/images/checkmark_circle_outlined.svg')); ?>" /> <?php echo e(__('Clean and vaccinated pets')); ?></a></li>
                            <li><a href="#"><img src="<?php echo e(asset( $publicPath . 'front_assets/images/checkmark_circle_outlined.svg')); ?>" /> <?php echo e(__('Widest store in Netherland')); ?></a></li>
                        </ul>
                    </div>
                    <div class="col-md-5 right_panel text-right">
                        <ul>
                            <li class="<?php echo e(request()->routeIs('show_expectedbabies') ? 'underline' : ''); ?>"><a href="<?php echo e(url('expectedbabies')); ?>"><img src="<?php echo e(asset( $publicPath . 'front_assets/images/bone.svg')); ?>" /> <?php echo e(__('Expected Babies')); ?></a>

                            </li>
                            <li class="<?php echo e(request()->routeIs('listBreeders') ? 'underline' : ''); ?>"><a href="<?php echo e(url('breeders')); ?>"><img src="<?php echo e(asset( $publicPath . 'front_assets/images/bone.svg')); ?>" /> <?php echo e(__('Breeders')); ?></a>

                          </li>
                            <li class=""><a href="#"><img src="<?php echo e(asset( $publicPath . 'front_assets/images/headphones.svg')); ?>" /> <?php echo e(__('Customer Service')); ?></a>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!--============== HEADER ENDS HERE ==============-->

    <!-- Main content -->
   <div class="banner_main">
        <div class="container">
            <div class="row">
              <div class="col-md-12">
                  <h6 class="mb-0">Welcome to Dieren-Plaats.nl</h6>
                  <h3>Thank you for paying to promote <a href="<?php echo e(route('ad_detail_page_slug', [ 'adId' => $adId, 'title' => Str::slug($adTitle), 'kind' => Str::slug($kind) ] )); ?>"><?php echo e($adTitle); ?></a></h3>
                  <small>Please check your email for details of payment confirmation</small>
                  
                  <div class="search_box input-group mt-3 py-5 d-flex justify-content-center w-75">
                   
                    <a href="<?php echo e(route('base_url')); ?>" class="btn btn-primary btn-lg">Continue</a>
                  </div>
                
              </div>
            </div>
        </div>
    </div> 
    <!-- /.content -->

    <!--============== FOOTER STARS HERE ==============-->
    <footer>
        <div class="container">
            <!-- FOOTER TOP -->
            <div class="footer_top">
                <div class="row">
                    <div class="col-md-6">
                        
                    </div>
                    <div class="col-md-6 right_panel">

                        <div class="row">
                          <div class="col-12">
                          <span id="submsg" class="text-success"></span>
                        </div>
                        <div class="col-7">
                         
                         
                        </div>
                        <div class="col-5 px-0">
                         
                        </div>
                          </div>

                        

                    </div>
                </div>
            </div>
            <!-- FOOTER BOTTOM -->
            <div class="footer_bottom">
              <div class="row">
                <div class="col-md-4">
                    <img src="<?php echo e(asset( $publicPath . 'front_assets/images/footer-logo.png')); ?>" class="mb-3" />
                    <p>To help you on your way to the purchase of an animal, animal place has been created. Animal place is the platform on which animals can be bought and sold. This way you can be sure that your animal will end up with a good owner and vice versa!</p>
                </div>
                <div class="col-md-3">
                    <h4 class="mb-3">Advantages</h4>
                    <ul>
                      <li><img src="<?php echo e(asset( $publicPath . 'front_assets/images/checkmark_circle_outlined.svg')); ?>" /> Place your add free</li>
                      <li><img src="<?php echo e(asset( $publicPath . 'front_assets/images/checkmark_circle_outlined.svg')); ?>" /> Safe place for rebuying pets</li>
                      <li><img src="<?php echo e(asset( $publicPath . 'front_assets/images/checkmark_circle_outlined.svg')); ?>" /> Breeders are checked</li>
                    </ul>
                </div>
                <div class="col-md-4">
                  <h4 class="mb-3">Contact</h4>
                  <div class="address_block">
                    <div><img src="<?php echo e(asset( $publicPath . 'front_assets/images/email-icon.svg')); ?>"/></div>
                    Email:<br>
                    info@dieren-plaats.nl
                  </div>
                  <div class="address_block">
                    <div><img src="<?php echo e(asset( $publicPath . 'front_assets/images/time-icon.svg')); ?>"/></div>
                    Opening hours:<br>
                    Mon - Fri / 9:00 - 17:00
                  </div>
                  <div class="social_block">
                      <a href="#"><img src="<?php echo e(asset( $publicPath . 'front_assets/images/facebook_square.svg')); ?>"/></a>
                      <a href="#"><img src="<?php echo e(asset( $publicPath . 'front_assets/images/pinterest.svg')); ?>"/></a>
                      <a href="#"><img src="<?php echo e(asset( $publicPath . 'front_assets/images/instagram.svg')); ?>"/></a>
                  </div>
                  <div class="playful-cat">
                    <img src="<?php echo e(asset( $publicPath . 'front_assets/images/playful-cat-bro.svg')); ?>" />
                  </div>
                </div>
              </div>
            </div>
            <div class="copyright text-center">
                Copyright 2021 Dieren-Plaats All Right reserved
            </div>
        </div>
    </footer>
    <!--============== FOOTER ENDS HERE ==============-->
    <!-- MOBILE NAVIGATION -->
    <div class="modal fade" id="mobile_menu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="search_box input-group mt-4 mb-4">
              <input type="text" class="form-control" placeholder="<?php echo e(__('Search the entire store')); ?>" aria-label="Search the entire store" aria-describedby="button-addon2">
              <button class="btn btn-outline-secondary" type="button" id="button-addon2"><img src="<?php echo e(asset( $publicPath . 'front_assets/images/ico-search.svg')); ?>"></button>
            </div>
            <div class="accordion" id="accordionPanelsStayOpenExample">
              <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                    View all Categories
                  </button>
                </h2>
                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                  <div class="accordion-body">
                    <nav class="nav flex-column">
                      <a class="nav-link active" aria-current="page" href="#">Active</a>
                      <a class="nav-link" href="#">Link</a>
                      <a class="nav-link" href="#">Link</a>
                      <a class="nav-link disabled">Disabled</a>
                    </nav>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                    <?php echo e(__('Sign up')); ?>

                  </button>
                </h2>
                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                  <div class="accordion-body">
                    <nav class="nav flex-column">
                      <a class="nav-link active" aria-current="page" href="#">Active</a>
                      <a class="nav-link" href="#">Link</a>
                      <a class="nav-link" href="#">Link</a>
                      <a class="nav-link disabled">Disabled</a>
                    </nav>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="<?php echo e(asset( $publicPath . 'front_assets/js/custom.js')); ?>"></script>
    <script src="<?php echo e(asset( $publicPath . 'front_assets/js/subscribePublic.js')); ?>"></script>
    <!-- dynamic scripts -->
    
    <script type="text/javascript">
      $('#searchTopBtn').on('click', function(event) {
        event.preventDefault();
        $('#frmSearchTop').submit();
      });
    </script>
  </body>
</html>
<?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/front/paidad/success.blade.php ENDPATH**/ ?>