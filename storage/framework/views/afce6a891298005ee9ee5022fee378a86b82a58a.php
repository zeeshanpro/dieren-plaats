<?php $__env->startSection('container'); ?>

Hello, <?php echo e($name); ?> 

Your OTP for Email verification is <?php echo e($otp); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('front/layout/emailLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/mailtemplates/registerOTPMail.blade.php ENDPATH**/ ?>