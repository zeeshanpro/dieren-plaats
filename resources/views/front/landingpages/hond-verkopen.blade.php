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
                <span class="base" data-ui-id="page-title-wrapper"><font style="vertical-align: inherit;">Hond verkopen</font></span>    </h1>
            </div>
              <div class="col-md-12">
                  
                  <div class="static-content">
                  <p>Ondanks dat je vast heel goed hebt nagedacht toen je een hond<br>aanschafte, is het in sommige gevallen toch onoverkomelijk dat het dier op<br>zoek moet naar een ander baasje. Gelukkig is het op dierenplaats mogelijk<br>je hond te verkopen als je er wegens omstandigheden niet meer voor kunt<br>zorgen. Op dierenplaats zijn veel potentiële nieuwe baasjes die jouw hond<br>een fijne plek kunnen bieden. Het is al vervelend genoeg om afstand te<br>nemen van je hond, dus je moet er het beste van zien te maken. De<br>redenen waarom baasjes afstand van hun hond, kunnen heel verschillend<br>zijn. Zo is een veel gehoorde reden dat de hond een andere plek moet<br>krijgen in verband met allergieën, een verhuizing van een ouder echtpaar,<br>ziekte van de hond en de daarbij komende kosten of een echtscheiding en<br>huisvestingsproblemen. Ondanks dat je vast gek bent op je hond, gun jij<br>hem een mandje waar hij alle liefde en aandacht krijgt die hij verdient ;-)<br>Kortom: je gaat op zoek naar een nieuw thuis voor jouw hond en<br>dierenplaats helpt jou daar bij!</p>
                        </div>
              </div>
            </div>
        </div>
    </div> 
    <!-- /.content -->
@endsection
