<?php $__env->startSection('container'); ?>

Hoi <?php echo e($customer); ?>, <br /><br />

Er was onlangs een aanvraag gedaan om het wachtwoord van je account te wijzigen.<br /><br />

Als jij de aanvraag hebt ingediend dan kan je via onderstaande knop een nieuw wachtwoord aanmaken:<br /><br />

<a href="<?php echo e(route('base_url')); ?>/reset-password/<?php echo e($token); ?>">NEW PASS BUTTON</a> <br /><br />

Indien je deze aanvraag niet hebt ingediend, kan je deze email negeren en zal het wachtwoord ongewijzigd blijven.

<?php $__env->stopSection(); ?>
<?php echo $__env->make('front/layout/emailLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/mailtemplates/forgot_password.blade.php ENDPATH**/ ?>