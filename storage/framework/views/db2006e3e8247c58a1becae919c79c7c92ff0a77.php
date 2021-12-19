<?php $__env->startSection('container'); ?>

Hoi <?php echo e($seller_name); ?>,<br /><br />

Iemand heeft je een vraag gesteld over de volgende advertentie: <br /><br />

<?php echo e($title_of_add); ?> ( <?php echo e($link); ?> )

Bericht: <br /><br />

<?php echo e($msg); ?>

<br /><br />
Klik hier om een bericht terug te sturen <?php echo e($link_to_message_back); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('front/layout/emailLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/mailtemplates/seller_received_msg.blade.php ENDPATH**/ ?>