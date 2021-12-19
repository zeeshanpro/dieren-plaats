<?php $__env->startSection('container'); ?>

Hoi admin,<br /><br />

Er is een bericht verstuurd<br /><br />

Klantnaam: <?php echo e($name); ?> <br />
Datum: <?php echo e($date); ?> <br />
Email: <?php echo e($email); ?> <br />
Bericht: <?php echo e($msg); ?> <br />

<?php $__env->stopSection(); ?>
<?php echo $__env->make('front/layout/emailLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/mailtemplates/contactus_website.blade.php ENDPATH**/ ?>