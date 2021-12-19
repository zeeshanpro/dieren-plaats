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
                <span class="base" data-ui-id="page-title-wrapper"><font style="vertical-align: inherit;">Puppy verkopen</font></span>    </h1>
            </div>
              <div class="col-md-12">
                  
                  <div class="static-content">
                  <p>Puppy’s zijn moeilijk te weerstaan. Dierenplaats helpt jou een baasje te vinden voor de puppy die je wil verkopen. Of je nu particulier bent of een geregistreerde fokker: wij helpen jou om een goed tehuis te vinden voor de pup. Zorg dat de pup alle benodigde vaccinaties heeft gehad en dat hij gechipt is: dat vergemakkelijkt de verkoop. Op deze manier kunnen we er samen voor zorgen dat malafide hondenhandel verdwijnt en dat alle pups die worden aangeboden aan de eisen van de verkoop voldoen. Wij geven om dierenwelzijn, dus wij streven naar 100% betrouwbaarheid van de particulieren en fokkers waarmee wij in zee gaan.</p>
<h2>Hieronder vind je enkele tips voor puppy verkopen:</h2>
<ul>
<li>Wees transparant over de gezondheid van de pup en beide ouders</li>
<li>Onderhoud contact met de nieuwe baasjes. Wie weet kun je nog een terugkomdag organiseren!</li>
<li>Nodig de nieuwe baasjes eens uit om te pup te bekijken. Zo krijgen zij ook een beeld van de huidige eigenaar en de omgeving waarin de pup is opgegroeid</li>
<li>Socialiseer de pup. Breng hem/haar zo veel mogelijk in contact met eventuele nestgenoten, andere huisdieren en kinderen</li>
<li>Verkoop je pup niet aan de eerste de beste geïnteresseerde die komt kijken. Ga niet over één nacht ijs en maak duidelijke afspraken, zodat beide partijen weten waar ze aan toe zijn</li>
<li>Laat de pup wennen aan zijn/haar nieuwe nestje. Geef de nieuwe baasjes eventueel wat bedenktijd of tijd om te wennen, zodat jullie er beide zeker van zijn dat de pup in een warm nestje terecht komt</li>
</ul>

                        </div>
              </div>
            </div>
        </div>
    </div> 
    <!-- /.content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front/layout/layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/front/landingpages/puppy-verkopen.blade.php ENDPATH**/ ?>