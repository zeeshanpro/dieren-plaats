<?php 
$title=View::getSection('title');
$title=explode("/",$title);
$publicPath = env('ASSETS_PATH');
?><!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
          <link href="<?php echo e(asset( $publicPath . 'front_assets/css/common.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset( $publicPath . 'front_assets/css/register.css')); ?>" rel="stylesheet">
    <title>Dieren Plaats - Verkoop platform voor huisdieren</title>
  </head>
  <body>

  <?php $__env->startSection('container'); ?>
  
    <?php echo $__env->yieldSection(); ?>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="<?php echo e(asset( $publicPath . 'front_assets/js/custom.js')); ?>"></script>
    <?php $__env->startSection('optional_scripts'); ?>
    <?php echo $__env->yieldSection(); ?>
  </body>
</html><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/front/layout/registerLayout.blade.php ENDPATH**/ ?>