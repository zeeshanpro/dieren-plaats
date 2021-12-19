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
                <span class="base" data-ui-id="page-title-wrapper"><font style="vertical-align: inherit;">Kat te koop</font></span>    </h1>
            </div>
              <div class="col-md-12">
                  
                  <div class="static-content">
                  <p>Op dierenplaats vind je katten die op zoek zijn naar een nieuw mandje. Bij ons kun je niet alleen je kat kopen, maar ook verkopen. Dierenplaats heeft alle expertise in huis om ervoor te zorgen dat jouw kat een tweede thuis krijgt met alle liefde en aandacht die jouw kat verdient. Ook kun je bij dierenplaats juist de persoon zijn die een kat een fijn en warm mandje kan geven. In onze database is het mogelijk te zoeken op leeftijd, ras, fokker en andere informatie die van belang zijn bij de aanschaf van een kat. Denk bij de aanschaf van een kat goed na over de verantwoordelijkheden en bepaal of jij een beestje genoeg liefde, aandacht en ruimte kunt bieden die iedere kat nodig heeft. Als het antwoord op bovenstaande vragen JA is, kun je op dierenplaats je hart ophalen! Geef jij een lieve volwassen kat een tweede kans of ga je voor een speelse kitten die je zelf gaat opvoeden? Wat je vraag ook is: dierenplaats is het antwoord! Op dierenplaats zijn zowel particulieren als fokkers aangesloten die allemaal hetzelfde doel voor ogen hebben: een warm nestje voor iedere kat.</p>
                        </div>
              </div>
            </div>
        </div>
    </div> 
    <!-- /.content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front/layout/layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/front/landingpages/kat-te-koop.blade.php ENDPATH**/ ?>