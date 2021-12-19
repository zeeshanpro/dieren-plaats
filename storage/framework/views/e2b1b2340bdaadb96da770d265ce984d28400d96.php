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
                <span class="base" data-ui-id="page-title-wrapper"><font style="vertical-align: inherit;">Kat kopen</font></span>    </h1>
            </div>
              <div class="col-md-12">
                  
                  <div class="static-content">
                  <p>Katten zijn fantastische dieren die je huis bovendien met alle liefde en plezier muisvrij houden. Daarbij is het spinnende geluid van een tevreden kat natuurlijk moeilijk te weerstaan. Denk over een aantal zaken echter goed na voor je een kat aanschaft. Wil je een huiskat of een buitenkat? En ben je op zoek naar een schootkat of vind je het prima als een kat zijn eigen gang gaat? Heb je al eens stilgestaan bij de kosten die deze eigenwijze viervoeters met zich mee brengen? Dierenplaats helpt jou om je goed te informeren en uiteindelijk de perfecte match te vinden! Hieronder eerst wat zaken om bij stil te staan alvorens je overgaat tot de aanschaf van een kat.</p>

<h2><strong>Ras kat kopen of niet?</strong></h2>

<p>Ben je op zoek naar een raskat? Check dan van tevoren de eigenschappen van de verschillende rassen. Ieder ras kent namelijk niet alleen uiterlijke verschillen, maar ook qua karakter is ieder ras anders. Lees je in en koop geen kat in de zak!</p>

<h2><strong>Eten</strong></h2>

<p>Er bestaan tientallen (zo niet, honderden) verschillende soorten kattenvoeding. Als je een kitten koopt, is het raadzaam speciaal kittenvoer aan te schaffen. Wanneer de kat volwassen is, volstaat adultvoer. Houd er rekening mee dat niet iedere kat standaard zijn voer opeet. Katten zijn namelijk ontzettend kieskeurig en zullen hun eten uitvoerig voorproeven.</p>

<h2><strong>Binnenshuis of buitenshuis?</strong></h2>

<p>Katten zijn jagers en maken graag een (nachtelijke) wandeling buitenshuis. Wees wel voorzichtig met het naar buiten laten van de kat. Katten hebben namelijk geen verkeersdiploma en sommige weggebruikers evenmin. Mocht je de kat binnen houden, maak dan wat nestelplekjes en zorg ervoor dat hij voldoende kan spelen en kan spelen. Vergeet ook niet om een plantje kattengras in huis te zetten. Dit vergemakkelijkt het uitspugen van eventuele haarballen. Tenzij je hebt besloten een naaktkat aan te schaffen ;-)</p>

                        </div>
              </div>
            </div>
        </div>
    </div> 
    <!-- /.content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front/layout/layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/front/landingpages/kat-kopen.blade.php ENDPATH**/ ?>