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
                <span class="base" data-ui-id="page-title-wrapper"><font style="vertical-align: inherit;">Kat verkopen</font></span>    </h1>
            </div>
              <div class="col-md-12">
                  
                  <div class="static-content">
                  <p>Als je genoodzaakt bent je kat(ten) of kitten(s) te verkopen, dan ben je bij dierenplaats aan het juiste adres. Wij zijn namelijk op zoek naar blije baasjes die jouw kat een goed thuis kunnen bieden. Op dierenplaats.nl plaats je binnen enkele minuten een advertentie die door honderden potentiële baasjes wordt gelezen. Als jij een match hebt gevonden, kun je in contact komen met de nieuwe eigenaar.</p>
<h2>Houd bij de aan- en verkoop van je kat wel rekening met onderstaande feitjes:</h2>
<ul>
<li>Check waar je kat terecht komt. Komt zijn nieuwe thuis overeen met de huidige woonplek van de kat? Is de kat gewend om buiten te spelen of heb je een kat die binnenblijft?</li>
<li>Houd de kat in het begin een aantal weken binnen. Een verhuizing geeft (een kat) de nodige stress. Het is belangrijk dat hij aan de nieuwe omgeving kan wennen</li>
<li>Laat de kat wennen aan de nieuwe huisgenoten. Hoe verleidelijk het ook is: de nieuwe huisgenoot heeft even rust nodig om op verkenning te gaan en kan stapje voor stapje gaan wennen aan zijn nieuwe omgeving. Laat de kat daarom eerst wennen in één kamer alvorens je hem toegang tot de gehele woonplek verschaft</li>
<li>Neem de tijd! Laat je nieuwe huisgenoot eerst eens wennen aan jou en aan je omgeving. Geduld wordt beloond!</li>
</ul>

                        </div>
              </div>
            </div>
        </div>
    </div> 
    <!-- /.content -->
@endsection
