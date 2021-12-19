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
                <span class="base" data-ui-id="page-title-wrapper"><font style="vertical-align: inherit;">Hond online verkopen</font></span>    </h1>
            </div>
              <div class="col-md-12">
                  
                  <div class="static-content">
                  <p>Een hond verdient natuurlijk een goed thuis. Dierenplaats screent kopers<br>en verkopers om malafide handel tegen te gaan. Zo kun jij met een gerust<br>hart jouw hond verkopen aan iemand die de hond een goed thuis kan<br>bieden. Voor het kopen en verkopen van honden gelden wel een aantal<br>regels. Door op de hoogte te zijn van deze regels voorkom je dat je een kat<br>(hond in dit geval) in de zak koopt. Als je een hond verkoopt, kan een<br>potentiële koper vragen naar de herkomst, benodigde vaccinaties,<br>identificatie in de vorm van een hondenpaspoort en eventueel de<br>bijbehorende gezondheidscertificaten. De wettelijk toegestane leeftijd om<br>een hond te verkopen is zeven weken. Pups die in Nederlands na 1 april<br>2013 zijn geboren, moeten daarbij binnen deze zeven weken gechipt zijn,<br>zodat ze identificeerbaar zijn. Als je een hond uit het buitenland hebt<br>ingevoerd, moet deze ook gechipt zijn.</p>
                        </div>
              </div>
            </div>
        </div>
    </div> 
    <!-- /.content -->
@endsection
