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
                <span class="base" data-ui-id="page-title-wrapper"><font style="vertical-align: inherit;">Rashond kopen</font></span>    </h1>
            </div>
              <div class="col-md-12">
                  
                  <div class="static-content">
                  <p style="">Als je overweegt een (ras)hond te kopen, is het natuurlijk raadzaam over een aantal zaken na te denken. Allereerst is het verstandig om onderzoek te doen naar het type ras dat je wil aanschaffen. Het fokken van rashonden heeft namelijk als nadelige bijkomstigheid dat er mogelijk aangeboren gezondheidsproblemen worden veroorzaakt. Sommige rassen zijn dusdanig doorgefokt (vanwege uiterlijke kenmerken of genetische kenmerken) dat de gezondheid van de hond in het geding komt. Dit is natuurlijk niet de bedoeling als je lang van een gezonde hond wil genieten! Om je optimaal voor te bereiden, kun je informatie inwinnen van een rasvereniging. Van ieder hondenras bestaat namelijk een rasvereniging met contactgegevens van fokkers. Hieronder vind je enkele tips die je kunnen helpen bij de aanschaf van een rashond.
<br />
· Ga eens een kijkje nemen bij de huidige eigenaar. Wat is de huidige woonsituatie van de hond en komt deze overeen met jouw woonsituatie? Denk hierbij aan (buiten)ruimte, kinderen, andere huisdieren, etc.
<br />
· Laat je nieuwe viervoeter eens een tijdje bij je logeren. Op deze manier kun je wennen aan de aanwezigheid van je nieuwe huisdier en andersom
<br />
· Zorg dat de hond gechipt is en volledig is ingeënt. Dit kan een hoop gezondheidsproblemen voorkomen voor zowel de nieuwe hond als eventuele huisdieren die je al hebt
<br />
· Check goed waar de hond vandaan komt en wat de volledige gezondheidshistorie is van de hond die je wil aanschaffen. Op deze manier voorkom je een miskoop
</p>
                        </div>
              </div>
            </div>
        </div>
    </div> 
    <!-- /.content -->
@endsection
