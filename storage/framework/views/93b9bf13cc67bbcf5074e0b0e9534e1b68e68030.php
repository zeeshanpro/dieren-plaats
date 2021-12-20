<?php 
$title = View::getSection('title');
$title = explode("/",$title);
$publicPath = env('ASSETS_PATH');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo e(config('app.name', 'DIEREN PLAATS')); ?> | <?php echo e($title[0]); ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo e(asset( $publicPath . 'admin_assets/plugins/fontawesome-free/css/all.min.css')); ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo e(asset( $publicPath . 'admin_assets/dist/css/adminlte.min.css')); ?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style type="text/css">
    .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link.active, .sidebar-light-primary .nav-sidebar > .nav-item > .nav-link.active
    {
      background-color:#17a2b8 !important;
    }
  </style>
<!-- dynamic css -->
<?php $__env->startSection('optional_css'); ?>
    <?php echo $__env->yieldSection(); ?>

</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="dashboard" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item">
      <form method="POST" action="<?php echo e(route('logout')); ?>">
        <?php echo csrf_field(); ?>
      <button type="submit" class="btn btn-info">Logout &nbsp <i class="fa fa-sign-out-alt" aria-hidden="true"></i></button>

      </form>

        <!-- <a title="Log out" class="nav-link" href="<?php echo e(route('logout')); ?>">Logout &nbsp; <i class="fa fa-sign-out-alt" aria-hidden="true"></i></a> -->
      </li>
      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo e(url('/admin/dashboard')); ?>" class="brand-link">
      <img src="<?php echo e(asset( $publicPath . 'admin_assets/logo.png')); ?>" alt="Hoppie Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8;height:33px;width:33px">
      <span class="brand-text font-weight-light"><?php echo e(config('app.name', 'DIEREN PLAATS')); ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo e(asset( $publicPath . 'admin_assets/logo.png')); ?>" class="img-circle elevation-2" alt="User Image" style="height:33px;width:33px;">
        </div>
        <div class="info">
          <a href="<?php echo e(('/admin/adminsettings')); ?>" class="d-block">Admin</a>
        </div>
      </div>
      <?php $adMaster = app('App\Repositories\AdRepository'); ?>
            <?php
                $adResults = $adMaster->showCountsForLeftBar();
            ?>
                

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item ">
            <a href="<?php echo e(route('admin-dashboard')); ?>" class="nav-link active">
              <i class="nav-icon fas fa-chart-line"></i>
              <p>
                Dashboard
              </p>
            </a>
      

          </li>
          <li class="nav-item">
            <a href="<?php echo e(url('/admin/listusers')); ?>" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Users     <span class="badge badge-info right"><?php echo e($adResults['userCount']); ?></span>           
              </p>
            </a>
          </li>
           <li class="nav-item">
            <a href="<?php echo e(url('/admin/listsubscription')); ?>" class="nav-link">
              <i class="nav-icon fas fa-registered"></i>
              <p>
                Subscriptions                
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="javascript::void(0);" class="nav-link">
              <i class="nav-icon fab fa-buysellads"></i>
              <p>
                Ads
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"><?php echo e($adResults['adCount']); ?></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo e(url('/admin/listads')); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
             <!--  <li class="nav-item">
                <a href="<?php echo e(url('/admin/list_unclaimed_gifts')); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Unclaimed</p>
                </a>
              </li> -->
              
            </ul>
          </li>  
          <li class="nav-item has-treeview">
            <a href="<?php echo e(url('/admin/listexpectedads')); ?>" class="nav-link">
              <i class="nav-icon fas fa-ad"></i>
              <p>
                Expected Ads
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"><?php echo e($adResults['expectedBabieCount']); ?></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo e(url('/admin/listexpectedads')); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
          
              
            </ul>
          </li>
         

            <li class="nav-item has-treeview">
            <a href="javascript::void(0);" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Settings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo e(url('/admin/listkind')); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kind</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo e(url('/admin/listrace')); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Race</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="<?php echo e(url('/admin/listattributes')); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Attributes</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

            <h1><?php echo e($title[0]); ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?php echo e($title[0]); ?> <?php echo e(isset($title[1])? "/ ". $title[1]:""); ?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <?php $__env->startSection('container'); ?>
    <?php echo $__env->yieldSection(); ?>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.2
    </div>
    <strong>Copyright &copy; 2021-2025 <?php echo e(config('app.name', 'DIEREN PLAATS')); ?>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo e(asset( $publicPath . 'admin_assets/plugins/jquery/jquery.min.js')); ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo e(asset( $publicPath . 'admin_assets/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo e(asset( $publicPath . 'admin_assets/dist/js/adminlte.min.js')); ?>"></script>
<!-- AdminLTE for demo purposes -->

<script src="<?php echo e(asset( $publicPath . 'admin_assets/dist/js/demo.js')); ?>"></script>

<script type="text/javascript">
 $(document).ready(function() {
   $(function(){
   var current = location.pathname;
   $('nav li a').each(function(){
       var $this = $(this);
       // if the current path is like this link, make it active
       if($this.attr('href').indexOf(current) !== -1){
           $this.addClass('active');
       
         $(this).closest('.has-treeview').addClass('menu-open');
       }
       else
       {
         $this.removeClass('active');
       }
   })
})
 });

</script>

<!-- dynamic scripts -->
<?php $__env->startSection('optional_scripts'); ?>

    <?php echo $__env->yieldSection(); ?>

</body>
</html><?php /**PATH C:\xampp7.4\htdocs\dieren-plaats\resources\views/admin/layouts/layout.blade.php ENDPATH**/ ?>