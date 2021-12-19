<?php $__env->startSection('container'); ?>

Hoi <?php echo e($name); ?>,<br /><br />

Welkom bij Dieren-Plaats.nl! Leuk dat jullie je aansluiten bij onze database. <br /><br />

Om in te loggen op onze website, gebruik je deze gegevens:<br /><br />

E-mail: <?php echo e($email); ?><br />
Wachtwoord: Opgegeven wachtwoord tijdens aanmaken van account<br /><br />

Wachtwoord vergeten? Klik <a href="<?php echo e($FORGETLINK); ?>">hier</a> om het opnieuw in te stellen.<br /><br />

<?php $__env->stopSection(); ?>

<?php echo $__env->make('front/layout/emailLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/mailtemplates/welcome_normal.blade.php ENDPATH**/ ?>