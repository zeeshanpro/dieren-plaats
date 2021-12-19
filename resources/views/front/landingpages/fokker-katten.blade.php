@extends('front/layout/layout')
<?php $publicPath = env('ASSETS_PATH'); ?>
@section('showMiddleBar','true')
    @section('optional_css')
      <meta name="csrf-token" content="{{ csrf_token() }}" />
    @endsection
@section('container')

    <!-- Main content -->
   <div class="banner_main">
        <div class="container">
            <div class="row">
            <div class="page-title-wrapper">
                <h1 class="page-title">
                <span class="base" data-ui-id="page-title-wrapper"><font style="vertical-align: inherit;">Fokker katten</font></span>    </h1>
            </div>
              <div class="col-md-12">
                  
                  <div class="static-content">
                  <p>Als je hebt besloten om een kat aan te schaffen, is de tweede stap om eens goed te kijken naar het soort kat dat je wil. Je kunt er natuurlijk voor kiezen om een huis-tuin-en-keukenkat in huis te nemen, maar misschien ben je wel op zoek naar een bepaald ras. Op dierenplaats vind je katten die door particulieren worden aangeboden, maar ook katten die door fokkers worden aangeboden. De fokkers in ons systeem zijn aangesloten bij een fokvereniging, zodat de kans op een kat in de zak is uitgesloten. Of je nu op zoek bent naar een particuliere verkoper of een fokker: wij matchen jou met allerlei kattenliefhebbers. Mocht je een kat bij een fokker kopen, dan kun je er zeker van zijn dat de fokker is aangesloten bij een vereniging. Het doel hiervan is dat het type kat, de gezondheid en de leefomstandigheden van de kat maximaal gewaarborgd worden. Daarnaast is het vaak mogelijk de ouders en broertjes/zusjes te leren kennen!</p>
                        </div>
              </div>
            </div>
        </div>
    </div> 
    <!-- /.content -->
@endsection
