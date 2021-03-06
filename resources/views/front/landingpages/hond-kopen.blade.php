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
                <span class="base" data-ui-id="page-title-wrapper"><font style="vertical-align: inherit;">Hond kopen</font></span>    </h1>
            </div>
              <div class="col-md-12">
                  
                  <div class="static-content">
                  <p>Je overweegt een hond aan te schaffen: spannend! Weet echter wel<br>waaraan je begint! Veel mensen willen een hond of hebben een hond. Een<br>hond is ook het ideale gezelschapsdier. Maar voordat je een hond<br>aanschaft, moet je natuurlijk wel nadenken over een aantal belangrijke<br>zaken. Heb je wel tijd hebt voor een hond? Een hond heeft namelijk de<br>nodige beweging en aandacht nodig. Bovendien kost een hond ook geld.<br>Niet enkel de aanschaf van een mandje en andere benodigdheden moeten<br>worden voorzien, maar ook kosten voor eten en de dierenartsbezoeken.<br>Ook moet een hond worden opgevoed! Uiteraard staat er wel tegenover<br>dat je er jarenlang plezier en een trouwe vriend voor terugkrijgt. <br><a class="rank-math-link" href="https://www.dieren-plaats.nl/">Bekijk snel het aanbod van dierenplaats en vind de hond die bij je past. </a></p>
                        </div>
              </div>
            </div>
        </div>
    </div> 
    <!-- /.content -->
@endsection
