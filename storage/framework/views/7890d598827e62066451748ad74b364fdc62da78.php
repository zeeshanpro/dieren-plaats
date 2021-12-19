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
    <meta name="description" content="Verkoopplatform voor Huisdieren Verkoopplatform voor Huisdieren Op dierenplaats worden dieren van alle soorten en maten aangeboden. Zowel fokkers als particulieren worden op dierenplaats zorgvuldig gescreend, gecontroleerd en geselecteerd. Zo komen alle dieren op hun pootjes terecht!p&gt;"/>
    <meta name="keywords" content="verkoop hond, verkoop kat, verkopen huisdier"/>
    <meta name="csrf-tokenbase" content="<?php echo e(csrf_token()); ?>" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
   
    <link href="<?php echo e(asset( $publicPath . 'front_assets/css/common.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset( $publicPath . 'front_assets/css/style.css')); ?>" rel="stylesheet">
   
    <link href="<?php echo e(asset( $publicPath . 'front_assets/css/my.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset( $publicPath . 'front_assets/css/megamenu.css')); ?>" rel="stylesheet">

    <script type="text/javascript">
      window.$crisp=[];
      window.CRISP_WEBSITE_ID="6a2d0fe8-4e2a-4d07-828b-ec3c9149bcf7";
      (function(){d=document;
      s=d.createElement("script");
      s.src="https://client.crisp.chat/l.js";
      s.async=1;d.getElementsByTagName("head")[0].appendChild(s);
      })();</script>
    <?php $__env->startSection('optional_css'); ?>
    <?php echo $__env->yieldSection(); ?>
    <title>Dieren Plaats - Verkoop platform voor huisdieren</title>
    <style type="text/css">
        .navigation-box {
    top: .4rem;
    right: .8rem;
    width: 2rem;
    position: absolute;
}
.breaking-box
{
    padding: 10px 35px;
}
@media (min-width: 768px){
    .breaking-caret:after {
        content: "";
        width: 0;
        height: 0;
        border-top: 20px solid transparent;
        border-left: 15px solid #007bff;
        border-bottom: 20px solid transparent;
        position: absolute;
        right: -15px;
        top: 0;
    }
}
    </style>
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
                    <div class="col col-md-7 left_panel">
                        <a href="<?php echo e(url('/')); ?>">
                            <div class="logo">
                            <img src="<?php echo e(asset( $publicPath . 'front_assets/images/logo-small.png')); ?>" />
                        </div>
                        </a>
                                
                               <?php echo $__env->make('front.layout.components.megamenu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>                         
                          <div class="search_box input-group">
                         <form method="get" action="<?php echo e(url('searchads')); ?>" id="frmSearchTop" style="display:contents" >
                            <input type="text" class="form-control" placeholder="<?php echo e(__('Search the entire store')); ?>" aria-label="Search the entire store" aria-describedby="searchTopBtn" id="searchTop" name="q" value="<?php echo e($query??''); ?>" style="width:80%" ></form>
                            <button class="btn btn-outline-secondary" type="button" id="searchTopBtn"><img src="<?php echo e(asset( $publicPath . 'front_assets/images/ico-search.svg')); ?>" /></button>
                          
                          </div>
                    </div>
                    <div class="col col-md-5 right_panel">
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
                                     
                                      <li> <span class="menu-inloggen">INGELOGD<span class="menu-inloggen-dot"><img class="menu-inloggen-dot" src="<?php echo e(url('public//front_assets/images/paw-red.svg')); ?>"/></span></span>
                                        <span class="menu-welcome">Welcome, <?php echo e(Str::before(Auth::user()->name, ' ')); ?></span>

                                      </li>
                                      <li><a class="dropdown-item" href="<?php echo e(route('showMyAds')); ?>"><?php echo e(__('My Ads')); ?></a></li>
                                      <li><a class="dropdown-item" href="<?php echo e(route('showMyExpectedBabies')); ?>">Mijn <?php echo e(__('Expected Babies')); ?></a></li> 
                                      <div class="dropdown-divider"></div>
                                      <li><a class="dropdown-item" href="<?php echo e(route('createad_showkinds')); ?>"><?php echo e(__('Create Ad')); ?></a></li>
                                      <li><a class="dropdown-item" href="<?php echo e(route('messages')); ?>"><?php echo e(__('Messages')); ?> 
                                         <?php if($unReadConversations>0): ?>
    <span class="badge badge-primary text-danger" style="background: beige;"><?php echo e($unReadConversations); ?> New</span>
                                        <?php endif; ?>

                                      </a></li>
                                      <div class="dropdown-divider"></div>
                                      <li><a class="dropdown-item" href="<?php echo e(route('showprofileform')); ?>"><?php echo e(__('My Profile')); ?></a></li>
                                      <li><form method="POST" action="<?php echo e(route('logout')); ?>">
                                  <?php echo csrf_field(); ?>
                                <button type="submit" class="py-1 btn btn-success text-white bg-danger  menu-logout">Logout &nbsp <i class="fa fa-sign-out-alt" aria-hidden="true"></i></button>
                                
                                </form></li>
                                    </ul>
                                <?php endif; ?>
                                <?php if(auth()->guard()->guest()): ?>
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="<?php echo e(asset( $publicPath . 'front_assets/images/user.svg')); ?>" />
                                      <?php echo e(__('Sign up')); ?>

                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                         <li> <span class="menu-inloggen">INLOGGEN<span class="menu-inloggen-dot"><img class="menu-inloggen-dot" src="<?php echo e(url('public//front_assets/images/paw-red.svg')); ?>"></span></span>
                                        <span class="menu-welcome">Welcome, terug.</span>

                                      </li>
                                      
                                      <li><a class="py-1 btn btn-success text-white bg-danger  menu-logout" href="/register"><?php echo e(__('Register')); ?></a></li>
                                      
                                      <li><a class="py-1 btn btn-success text-white bg-danger  menu-logout" href="/login"><?php echo e(__('Login')); ?></a></li>
                                    </ul>
                                <?php endif; ?>
                                  </li>
                                </ul>
                              </div>
                            </div>
                          </nav>
                          <a href="<?php echo e(route('showsavedads')); ?>" style="position:relative;left:-13px;"><img src="<?php echo e(asset( $publicPath . 'front_assets/images/actions-heart_outlined.svg')); ?>" /></a>
                          <a class="mx-1 plaats-advertentie" href="<?php echo e(route('createad_showkinds')); ?>" ><span class="d-none d-lg-inline">Plaats advertentie</span><i class="bi bi-plus-circle h5 text-white  plus" style="padding: 0 2px 0 5px;"></i>  </a>
                          <a href="#" class="mobile_menu" data-bs-toggle="modal" data-bs-target="#mobile_menu"><i class="bi bi-list"></i> </a>
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
        <div class="bottom_bar d-none d-md-block">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 left_panel">
                        <ul>
                            <li><a href="#"><i class="far fa-check-circle"></i> <?php echo e(__('Professional Breeders')); ?></a></li>
                            <li><a href="#"><i class="far fa-check-circle"></i> <?php echo e(__('Clean and vaccinated pets')); ?></a></li>
                            <li><a href="#"><i class="far fa-check-circle"></i> <?php echo e(__('Widest store in Netherland')); ?></a></li>
                        </ul>
                    </div>
                    <div class="col-md-5 right_panel text-right">
                        <ul>
                            <li class="<?php echo e(request()->routeIs('show_expectedbabies') ? 'underline' : ''); ?>"><a href="<?php echo e(url('expectedbabies')); ?>"><img src="<?php echo e(asset( $publicPath . 'front_assets/images/pawprinticon.svg')); ?>" /> <?php echo e(__('Expected Babies')); ?></a>

                            </li>
                            <li class="<?php echo e(request()->routeIs('listBreeders') ? 'underline' : ''); ?>"><a href="<?php echo e(url('breeders')); ?>"><img src="<?php echo e(asset( $publicPath . 'front_assets/images/bone.svg')); ?>" /> <?php echo e(__('Breeders')); ?></a>

                          </li>
                            <li class="<?php echo e(request()->routeIs('website_contactus') ? 'underline' : ''); ?>"><a href="<?php echo e(route('website_contactus')); ?>"><img src="<?php echo e(asset( $publicPath . 'front_assets/images/headphones.svg')); ?>" /> <?php echo e(__('Customer Service')); ?></a>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>




<div class="row m-0">
  <div class="col-12 d-block d-md-none my-2 ">
<div class="search_box input-group d-flex justify-content-center">
                         <form method="get" action="<?php echo e(url('searchads')); ?>" id="frmSearchTopOuter" style="display:contents">
                            <input type="text" class="form-control" placeholder="<?php echo e(__('Search the entire store')); ?>" aria-label="Search the entire store" aria-describedby="searchTopBtn" id="searchTop" name="q" value="<?php echo e($query??''); ?>" style="width:82%;border: 1px solid #f72442;">
                        </form>
                            <button type="button" id="searchTopBtnOuter" class="btn btn-primary px-3"><i class="bi bi-search"></i></button>
                          
                          </div>


<div class="row">
                <!--Breaking box-->
               
                <!--end breaking box-->
                <!--Breaking content-->
                <div class="col-12">
                    <div class="breaking-box">
                        <div id="carouselbreaking" class="carousel slide" data-bs-ride="carousel">
                            <!--breaking news-->
                            <div class="carousel-inner">
                                <!--post-->
                                <div class="carousel-item active">
                                   <a href="#"  class="text-black"><i class="far fa-check-circle text-danger me-1"></i> Professionele fokkers</a>
                                </div>
                                <!--post-->
                                <div class="carousel-item">
                                   <a href="#" class="text-black"><i class="far fa-check-circle text-danger me-1"></i> Gecontroleerde en gevaccineerde huisdieren</a>
                                </div>
                                <!--post-->
                                <div class="carousel-item">
                                <a href="#"  class="text-black"><i class="far fa-check-circle text-danger me-1"></i> Grootste database van NL</a>
                                </div>
                                <!--post-->
                                
                            </div>
                            <!--end breaking news-->
                            
                            <!--navigation slider-->
                            <div class="navigation-box p-2 d-none d-sm-block">
                                <!--nav left-->
                                <a class="carousel-control-prev text-primary" href="#carouselbreaking" role="button" data-bs-slide="prev">
                                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <!--nav right-->
                                <a class="carousel-control-next text-primary" href="#carouselbreaking" role="button" data-bs-slide="next">
                                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                            <!--end navigation slider-->
                        </div>
                    </div>
                </div>
                <!--end breaking content-->
            </div>
                           
  </div>
  <div>
</div>





       

</div>


    </header>
    <!--============== HEADER ENDS HERE ==============-->

    <!-- Main content -->
    <?php $__env->startSection('container'); ?>
    <?php echo $__env->yieldSection(); ?>
    <!-- /.content -->

    <!--============== FOOTER STARS HERE ==============-->
    <footer>
        <div class="container">
            <!-- FOOTER TOP -->
            <div class="footer_top">
                <div class="row">
                    <div class="col-md-6">
                        <h3><?php echo e(__('Stay Informed')); ?></h3>
                        <p><?php echo e(__('Subscribe and stay informed about your bids and promotions')); ?></p>
                    </div>
                    <div class="col-md-6 right_panel">

                        <div class="row">
                          <div class="col-12">
                          <span id="submsg" class="text-success"></span>
                        </div>
                        <div class="col-7">
                         <form action="https://dieren-plaats.us4.list-manage.com/subscribe/post?u=ba0567ad792433d503611b336&amp;id=9bb8c9b892" method="get" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                          <input type="text" class="form-control form-control-lg" id="subemail" placeholder="Enter your email" name="MERGE0">
                          <input type="hidden" name="id" value="9bb8c9b892">
                          <input type="hidden" name="u" value="ba0567ad792433d503611b336">
                      </form>
                        </div>
                        <div class="col-5 px-0">
                          <button   class="btn btn-primary" id="subsubmit"><?php echo e(__('Subscribe')); ?></button>
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
                    <p>Om je op weg te helpen bij de aanschaf
van een dier is dierenplaats in het leven
geroepen. Dierenplaats is het platform
waarop dieren gekocht en verkocht
kunnen worden. Zo ben jij er zeker
van dat jouw dier bij een goed baasje
terecht komt en andersom!</p>
                </div>
                <div class="col-md-3">
                    <h4 class="mb-3">Voordelen</h4>
                    <ul>
                      <li><img src="<?php echo e(asset( $publicPath . 'front_assets/images/checkmark_circle_outlined.svg')); ?>" /> Plaats je huisdier GRATIS op dieren-plaats.nl*</li>
                      <li><img src="<?php echo e(asset( $publicPath . 'front_assets/images/checkmark_circle_outlined.svg')); ?>" /> Wij willen een veilige plek creëren om je huisdier te kopen / verkopen</li>
                      <li><img src="<?php echo e(asset( $publicPath . 'front_assets/images/checkmark_circle_outlined.svg')); ?>" /> Zowel Fokkers als Particulieren worden gecheckt</li>
                    </ul>
                </div>
                <div class="col-md-4">
                  <h4 class="mb-3">Klantenservice</h4>
                  <div class="address_block">
                    <div><img src="<?php echo e(asset( $publicPath . 'front_assets/images/email-icon.svg')); ?>"/></div>
                    Email:<br>
                    info@dieren-plaats.nl
                  </div>
                  <div class="address_block">
                    <div><img src="<?php echo e(asset( $publicPath . 'front_assets/images/time-icon.svg')); ?>"/></div>
                    Openingstijden:<br>
                    Ma - Vrij / 9:00 - 17:00
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

            <a class="mx-1 text-primary" href="<?php echo e(route('createad_showkinds')); ?>" ><i class="bi bi-plus-circle h5 text-red  plus" style="padding-right: 5px;font-size: 15px;"></i><span>Plaats advertentie</span>  </a>


            <div class="search_box input-group mt-4 mb-4">
           
<form method="get" action="<?php echo e(url('searchads')); ?>" id="frmSearchTopMobile" style="display:contents" >
                            <input type="text" class="form-control" placeholder="<?php echo e(__('Search the entire store')); ?>" aria-label="Search the entire store" aria-describedby="searchTopBtn" id="searchTop" name="q" value="<?php echo e($query??''); ?>" style="width:80%" ></form>
                            <button class="btn btn-outline-secondary" type="button" id="searchTopBtnMobile"><img src="<?php echo e(asset( $publicPath . 'front_assets/images/ico-search.svg')); ?>" /></button>




            </div>


            <nav class="nav flex-column">
                 <ul style="list-style:none;" class="px-0">
                            <li class="<?php echo e(request()->routeIs('show_expectedbabies') ? 'activee' : ''); ?> pb-2"><a href="<?php echo e(url('expectedbabies')); ?>"><img src="<?php echo e(asset( $publicPath . 'front_assets/images/pawprinticon.svg')); ?>" /> <?php echo e(__('Expected Babies')); ?></a>

                            </li>
                            <li class="<?php echo e(request()->routeIs('listBreeders') ? 'activee' : ''); ?> pb-2"><a href="<?php echo e(url('breeders')); ?>"><img src="<?php echo e(asset( $publicPath . 'front_assets/images/bone.svg')); ?>" /> <?php echo e(__('Breeders')); ?></a>

                          </li>
                            <li class="pb-2"><a href="<?php echo e(route('website_contactus')); ?>"><img src="<?php echo e(asset( $publicPath . 'front_assets/images/headphones.svg')); ?>" /> <?php echo e(__('Customer Service')); ?></a>

                            </li>
                        </ul>
                     
                      
                    </nav>



            <div class="accordion" id="accordionPanelsStayOpenExample">
              <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="false" aria-controls="panelsStayOpen-collapseOne">
                  <?php echo e(__('View all')); ?> <?php echo e(__('Categories')); ?>

                  </button>
                </h2>
                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne">
                  <div class="accordion-body">
                    <nav class="nav flex-column">
                       <?php echo $__env->make( 'front.layout.components.middlemenu', [ 'mobileMenu' => true ] , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                     
                      
                    </nav>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                    <?php if(auth()->guard()->check()): ?>
                    <?php echo e(__('My Account')); ?>

                    <?php else: ?>
                    <?php echo e(__('Sign up')); ?>

                    <?php endif; ?>
                  </button>
                </h2>
                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                  <div class="accordion-body">
                   <nav class="nav flex-column">
                      <?php if(auth()->guard()->check()): ?>
                      <a class="dropdown-item" href="<?php echo e(route('showMyAds')); ?>"><?php echo e(__('My Ads')); ?></a>
                      <a class="dropdown-item" href="<?php echo e(route('showMyExpectedBabies')); ?>">Mijn <?php echo e(__('Expected Babies')); ?></a>

                        <div class="dropdown-divider"></div>
                       <a class="dropdown-item" href="<?php echo e(route('createad_showkinds')); ?>"><?php echo e(__('Create Ad')); ?></a>
                       <a class="dropdown-item" href="<?php echo e(route('messages')); ?>"><?php echo e(__('Messages')); ?> 
                       <?php if($unReadConversations>0): ?>
    <span class="badge badge-primary text-danger" style="background: beige;"><?php echo e($unReadConversations); ?> New</span>

                       <?php endif; ?>
                       </a>
                       <div class="d-block d-lg-none">
                       <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo e(route('showsavedads')); ?>"><?php echo e(__('Saved Ads')); ?></a>
                        <a class="dropdown-item" href="<?php echo e(route('show_logindetails_form')); ?>">Password</a>
                        <a class="dropdown-item" href="<?php echo e(route('userpanel_contactus')); ?>"><?php echo e(__('Contact Us')); ?></a>
                       <a class="dropdown-item"  href="<?php echo e(route('show_subscription_history')); ?>">Subscription</a>

                            </div>
                                        <div class="dropdown-divider"></div>
                                      <a class="dropdown-item" href="<?php echo e(route('showprofileform')); ?>"><?php echo e(__('My Profile')); ?></a>
                                      <form method="POST" action="<?php echo e(route('logout')); ?>">
                                  <?php echo csrf_field(); ?>
                                <button type="submit" class="py-1 logoutButton"><?php echo e(__('Logout')); ?> &nbsp <i class="fa fa-sign-out-alt" aria-hidden="true"></i></button>
                                </form>
                      <?php endif; ?>

                      <?php if(auth()->guard()->guest()): ?>
                      <a class="dropdown-item" href="/register"><?php echo e(__('Register')); ?></a>
                                    <a class="dropdown-item" href="/login"><?php echo e(__('Login')); ?></a>
                      <?php endif; ?>
                      
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
    
    <script src="<?php echo e(asset( $publicPath . 'front_assets/js/topbar.js')); ?>"></script>
    <script src="<?php echo e(asset( $publicPath . 'front_assets/js/custom.js')); ?>"></script>
    <script src="<?php echo e(asset( $publicPath . 'front_assets/js/subscribePublic.js')); ?>"></script>
    <script src="<?php echo e(asset( $publicPath . 'front_assets/js/loader.js')); ?>"></script>
    <!-- dynamic scripts -->
    <?php $__env->startSection('optional_scripts'); ?>
    <?php echo $__env->yieldSection(); ?>
    <script type="text/javascript">
        
      $('#searchTopBtn').on('click', function(event) {
        event.preventDefault();
        $('#frmSearchTop').submit();
      }); 
      $('#searchTopBtnMobile').on('click', function(event) {
        event.preventDefault();
        $('#frmSearchTopMobile').submit();
      });

     $('#searchTopBtnOuter').on('click', function(event) {
        event.preventDefault();
        $('#frmSearchTopOuter').submit();
      });

    </script>
    
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-156278633-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-156278633-1');
</script>


  </body>
</html>
<?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/front/layout/layout.blade.php ENDPATH**/ ?>