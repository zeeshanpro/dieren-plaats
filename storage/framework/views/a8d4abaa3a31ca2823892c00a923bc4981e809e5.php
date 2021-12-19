<?php $publicPath = env('ASSETS_PATH'); ?>
<?php $__env->startSection('showMiddleBar','true'); ?>
    <?php $__env->startSection('optional_css'); ?>
      <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    <?php $__env->stopSection(); ?>
<?php $__env->startSection('container'); ?>

    <!-- Main content -->
   <div class="banner_main">
        <div class="container">
            <div class="row">
            <div class="page-title-wrapper">
                <h1 class="page-title">
                <span class="base" data-ui-id="page-title-wrapper"><font style="vertical-align: inherit;">Raskat verkopen</font></span>    </h1>
            </div>
              <div class="col-md-12">
                  
                  <div class="static-content">
                  <p>Op dierenplaats kun je je (ras)kat te koop aanbieden als particulier of fokker. Binnen enkele minuten plaats je een advertentie en word je in contact gebracht met honderden potentiële baasjes. Uiteraard bepaal je zelf aan wie je jouw raskat verkoopt. Wij begrijpen namelijk als geen ander dat er een klik moet zijn met het nieuwe baasje en dat je er zeker van wil zijn dat jouw raskat op zijn pootjes terecht komt. De overdracht van het oude nestje naar het nieuwe nestje heeft tijd nodig en wij begrijpen dat. Ga daarom ook niet voor de eerste de beste koper, maar wacht tot je de juiste match hebt gevonden. Daar helpen we je graag bij! Geef het nieuwe baasje altijd wat bedenktijd, zodat hij aan je kat kan wennen en andersom. Meld de gezondheidsstatus en -historie eerlijk aan het nieuwe baasje. Zo zorg je ervoor dat zij een goede keuze kunnen maken. Geef de nieuwe eigenaar ook wat tips over het karakter van de kat, het eten van de kat en geef wat van zijn favoriete speeltjes (of een vertrouwd dekentje) mee om te wennen. Misschien is het wel mogelijk om elkaar nog eens op te zoeken!</p>
                        </div>
              </div>
            </div>
        </div>
    </div> 
    <!-- /.content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front/layout/layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/front/landingpages/raskat-verkopen.blade.php ENDPATH**/ ?>