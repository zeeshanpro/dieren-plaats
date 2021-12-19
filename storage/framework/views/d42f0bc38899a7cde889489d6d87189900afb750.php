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
                <span class="base" data-ui-id="page-title-wrapper"><font style="vertical-align: inherit;">Kitten verkopen</font></span>    </h1>
            </div>
              <div class="col-md-12">
                  
                  <div class="static-content">
                  <p>Er is een poezenpiek in Nederland! Op heel veel sites en verkoopplatforms worden jonge kittens te koop aangeboden. Als je op zoek bent naar een betrouwbaar verkoopadres voor kittens, ben je op dierenplaats aan het juiste adres. Wij helpen je een geschikt thuis te vinden voor je kittens. Of je nu een particulier bent die wegens omstandigheden een kitten moet verkopen of een fokker die ervaring heeft met de verkoop van kittens: wij helpen jou om voor je kitten een baasje voor het leven te vinden.</p>
<h2>Hieronder vind je wat tips die je helpen bij je kitten verkopen:</h2>
<ul>
<li>Een kitten mag niet verkocht worden als het jonger is dan 8 weken</li>
<li>Wees transparant over de herkomst en de gezondheid van de kittens</li>
<li>Zorg dat de kittens voldoende gesocialiseerd zijn voordat ze naar hun nieuwe nestje gaan</li>
<li>Nodig de nieuwe baasjes eens uit om een kijkje te nemen. Op deze manier zie je vaak meteen of het een goede match is</li>
<li>Zorg dat de kittens op tijd hun entingen hebben gehad</li>
</ul>

                        </div>
              </div>
            </div>
        </div>
    </div> 
    <!-- /.content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front/layout/layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/front/landingpages/kitten-verkopen.blade.php ENDPATH**/ ?>