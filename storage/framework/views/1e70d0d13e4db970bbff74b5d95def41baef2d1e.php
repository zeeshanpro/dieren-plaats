<?php $publicPath = env('ASSETS_PATH'); ?>
  <?php $__env->startSection('optional_css'); ?>
      <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    <?php $__env->stopSection(); ?>
<?php $__env->startSection('container'); ?>

<?php echo $__env->make( 'front.layout.components.middlemenu', [ 'iconstyle' => true, 'hideViewAll' => true ] , \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('front/layout/layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/front/kind/showall.blade.php ENDPATH**/ ?>