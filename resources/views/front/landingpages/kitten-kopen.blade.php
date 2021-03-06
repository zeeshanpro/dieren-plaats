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
                <span class="base" data-ui-id="page-title-wrapper"><font style="vertical-align: inherit;">Kitten kopen</font></span>    </h1>
            </div>
              <div class="col-md-12">
                  
                  <div class="static-content">
                  <p>Een belangrijke vraag bij de aanschaf van een kat is de leeftijd. Wil je namelijk een volwassen kat kopen of gaat je voorkeur uit naar een kitten? Het grootste verschil is dat een oudere kat meestal al is opgevoed. Een kitten daarentegen weet nog niet welke regels er gelden. Zo krabben ze graag aan de bank, springen ze (na een tijdje) op tafel en op het aanrecht en zijn ze ontzettend speels. Gewenst gedrag is natuurlijk aan te leren! Kortom; het kost veel tijd en moeite om een kitten op te voeden, maar je krijgt er veel voor terug. (Ook al zou je dit misschien niet direct zeggen…). Laat de kitten altijd even wennen. Dit kun je doen door een dekentje met zijn vertrouwde geur mee te nemen. Het is voor een kitten namelijk behoorlijk schrikken als hij ineens zijn moeder en broertjes of zusjes kwijt is! Geef een kitten veel aandacht, liefde en rust.</p>
                        </div>
              </div>
            </div>
        </div>
    </div> 
    <!-- /.content -->
@endsection
