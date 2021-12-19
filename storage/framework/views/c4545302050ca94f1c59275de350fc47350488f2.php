<?php $__env->startSection('container'); ?>

Hoi <?php echo e($customer); ?>,<br /><br />

Je advertentie staat online.  <br />

<?php echo e($title_of_add); ?>  <?php echo e($link); ?><br /><br />

Wanneer je graag een niewue advertentie plaats klik dan hier. <?php echo e($link_to_new_ad); ?> <br />

Bekijk je profiel en je berichten via deze link <?php echo e($link_to_profile); ?><br />

<?php $__env->stopSection(); ?>
<?php echo $__env->make('front/layout/emailLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/mailtemplates/ad_placed.blade.php ENDPATH**/ ?>