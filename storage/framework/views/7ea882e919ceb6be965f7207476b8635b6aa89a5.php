<?php $__env->startSection('container'); ?>

Hoi <?php echo e($buyer_name); ?>,<br /><br />

Je hebt een antwoord ontvangen over de volgende advertentie: <br /><br />

<?php echo e($title_of_add); ?> ( <?php echo e($link); ?> )<br />

Bericht: <br />

<?php echo e($msg); ?><br /><br />

Klik hier om naar de chat te gaan. <?php echo e($link_to_message_back); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('front/layout/emailLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/mailtemplates/buyer_receive_msg.blade.php ENDPATH**/ ?>