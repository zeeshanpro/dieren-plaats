<?php $__env->startSection('container'); ?>

Hoi <?php echo e($customer); ?>,<br /><br />

Je advertentie wordt binnenkort offline gehaald<br /><br />

<?php echo e($Title_of_add); ?> ( <?php echo e($link); ?> ) <br /><br />

Wanneer dit niet klopt dan kan je via onderstaande knop de advertentie gratis verlengen<br /><br />

Advertentie verlengen -link to renew the ad-<br /><br />

Wil je de advertentie direct offline halen ? Klik dan hier <?php echo e($my_ads); ?><br />


<?php $__env->stopSection(); ?>
<?php echo $__env->make('front/layout/emailLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/mailtemplates/ad_almost_expire.blade.php ENDPATH**/ ?>