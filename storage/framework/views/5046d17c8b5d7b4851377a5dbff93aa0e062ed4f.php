<?php $__env->startSection('container'); ?>

This Is Title Too Add "<?php echo e($title_of_add??''); ?>"
<br/>

My Name As A Seller Is <?php echo e($seller_name??''); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('front/layout/emailLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/mailtemplates/testtemplate.blade.php ENDPATH**/ ?>