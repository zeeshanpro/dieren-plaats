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
                <span class="base" data-ui-id="page-title-wrapper"><font style="vertical-align: inherit;">Raskat kopen</font></span>    </h1>
            </div>
              <div class="col-md-12">
                  
                  <div class="static-content">
                  <p style=""><h2><strong>Welk ras?</strong></h2>

<p>Je hebt de knoop doorgehakt: je koopt een kat en het liefst een raskat. In dat geval is de keuze reuze. Verdiep je eens in het karakter van verschillende kattenrassen. Niet alleen het uiterlijk verschilt bij ieder ras, maar ieder ras kent ook andere karaktertrekken. Een kortharig ras is wat makkelijker in de verzorging, omdat langharige rassen vaak geborsteld of gekamd moeten worden.</p>


<h2><strong>Waarom (g)een raskat?</strong></h2>

<p>Een van de vele voordelen van een raskat is dat het karakter vrij goed te voorspellen valt. Sommige rassen staan bekend om het vele kletsen en andere rassen zijn ontzettend aanhankelijk of trekken juist hun eigen plan. Welk karakter matcht met jouw karakter?</p>

<p>Hoewel het verleidelijk is een raskat aan te schaffen, zitten er ook wat haken en ogen aan. Het aantal katten met een stamboom is namelijk niet erg groot. Als een stamboom een vereiste is, zou het kunnen dat je even geduld moet hebben voor er een nestje is. Verdiep je daarbij ook in de fokkers, zodat je geen broodfokker treft. Dit zou als gevolg kunnen hebben dat je kat vaker dan gemiddeld last heeft van gezondheidsproblemen. Dat is niet alleen zielig voor de kat, maar ook voor je portemonnee.</p>
</p>
                        </div>
              </div>
            </div>
        </div>
    </div> 
    <!-- /.content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front/layout/layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/front/landingpages/raskat-kopen.blade.php ENDPATH**/ ?>