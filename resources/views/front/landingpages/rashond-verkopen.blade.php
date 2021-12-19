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
                <span class="base" data-ui-id="page-title-wrapper"><font style="vertical-align: inherit;">Rashond verkopen</font></span>    </h1>
            </div>
              <div class="col-md-12">
                  
                  <div class="static-content">
                  <p style="">Iedere hond heeft recht op een goed en fijn thuis. Als je je rashond wil verkopen, mag je op dierenplaats rekenen voor een succesvolle bemiddeling tussen koper en verkoper.
<br />
Hieronder vind je een aantal tips die je kunnen helpen als je je (ras)hond gaat verkopen.
<br />
Check goed wie er geïnteresseerd is in de aankoop van je hond. Wat zijn de (gezins)omstandigheden? Krijgt je hond voldoende tijd en aandacht? Komt de hond terecht bij jonge kinderen of andere huisdieren en is dat een goede match?
Laat je hond logeren! Op deze manier kan het potentiële nieuwe baasje aan zijn nieuwe viervoeter wennen en andersom. Het doel is natuurlijk dat je hond terecht komt in een warm nestje, dus een weekendje logeren in het nieuwe nestje is nooit verkeerd
Geef het nieuwe baasje wat lievelingsspulletjes mee van je hond, zodat hij wat bekende geuren om zich heen heeft. Denk hierbij aan een mandje, dekentje of het favoriete knuffeltje van je hond
Zorg dat de hond gechipt is en volledig is ingeënt. Hiermee voorkom je dat hij andere dieren of gezinsleden infecteert of dat hij door andere dieren geïnfecteerd wordt
</p>
                        </div>
              </div>
            </div>
        </div>
    </div> 
    <!-- /.content -->
@endsection
