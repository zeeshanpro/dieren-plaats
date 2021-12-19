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
                <span class="base" data-ui-id="page-title-wrapper"><font style="vertical-align: inherit;">Hond te koop</font></span>    </h1>
            </div>
              <div class="col-md-12">
                  
                  <div class="static-content">
                  <p style="">Een puppy kun je vormen, maar het kost veel tijd en moeite om een pup op te voeden. 
                      Daarbij moet je ook rekenen op enkele uurtjes nachtrust. Een volwassen hond kost je daarentegen 
                      vaak minder kruim. Allereerst geeft het een goed gevoel om een volwassen hond een tweede of een 
                      derde kans te geven. Daarbij kun je in sommige gevallen al van te voren weten welk karakter je in 
                      huis haalt! Ga goed na of de hond gewend is aan kinderen, hoe die met vreemde mensen omgaat, 
                      en of hij/zij met andere dieren omgaat. Kan de hond tegen ritjes in de auto, en kan hij/zij alleen 
                      zijn? Op dierenplaats vind je naast puppy’s ook (jong)volwassen honden die op zoek zijn naar een 
                      warm nestje. Omdat wij dierenliefhebbers zijn, worden alle honden die op dierenplaats worden aangeboden, 
                      zorgvuldig gescand. Desondanks is het aan te raden zelf kritisch te zijn bij de aanschaf van een hond. 
                      Neem de tijd om uit te zoeken welke hond je in huis wil nemen. Denk hierbij aan de eigenschappen en de 
                      behoeftes van een hond. Ben je op zoek naar een sportief type of heb je liever een hond die gezellig 
                      naast je op de bank kruipt? Ga je voor een professionele fokker of voor een eenmalige fokker? Zijn er 
                      medebewoners, kinderen of andere huisdieren in huis? Zorg dat je van tevoren antwoord hebt op je 
                      belangrijkste vragen. Zo ga je voorbereid op pad!</p>
                        <p><!-- /wp:paragraph --></p>
                        </div>
              </div>
            </div>
        </div>
    </div> 
    <!-- /.content -->
@endsection
