@extends('front/layout/layout')
<?php $publicPath = env('ASSETS_PATH'); ?>
@section('showMiddleBar','true')
    @section('optional_css')
      <meta name="csrf-token" content="{{ csrf_token() }}" />
    @endsection
@section('container')
<!--============== BANNER STARS HERE ==============-->
<div class="banner_main">
        <div class="container">
            <div class="row">
              <div class="col-md-12">
                  <h6 class="mb-0">Welkom op Dieren-Plaats.nl!</h6>
                  <h2>VERKOOPPLATFORM VOOR<br>
                  <span>HUISDIEREN</span></h2>
                  <form method="get" action="{{url('searchads')}}" id="frmSearchIndex" style="display:contents" >
                  <div class="search_box input-group mt-3">
                    <input type="text" class="form-control" placeholder="{{__('Search the entire store')}}" aria-label="{{__('Search the entire store')}}" aria-describedby="searchIndex" name="q">
                    <button class="btn btn-outline-secondary" type="button" id="searchIndexBtn">{{__('Search')}}</button>
                  </div>
                </form>
              </div>
            </div>
        </div>
    </div> 
    <!--============== BANNER ENDS HERE ==============-->

    <!--============== SEARCH BY TYPE STARS HERE ==============-->
    @include( 'front.layout.components.middlemenu', [ 'iconstyle' => true ] )
  <!--============== SEARCH BY TYPE ENDS HERE ==============-->

  <!--============== HIGHLIGHTED HERE ==============-->
  @include('front.layout.components.adlisting')
  <!--============== HIGHLIGHTED ENDS HERE ==============-->


  <!--============== EXPECTED BABIES HERE ==============-->
  {{-- @include('front.layout.components.expectedBabies') --}}
  <!--============== EXPECTED BABIES ENDS HERE ==============-->

  <!--============== BREEDERS PANEL HERE ==============-->
  @include('front.layout.components.breeders')
  <!--============== BREEDERS ENDS HERE ==============-->

  <!--============== OUR MISSION HERE ==============-->
  <div class="our_mission_panel">
    <div class="container">
        <div class="row">
              <div class="col-md-5 mb-4">
                    <h5>{{__('Mission')}}</h5>
                    <h2 class="mb-3">{{__('Our mission')}}</h2>
                    <p>Speciaal v????r dierenvrienden d????r dierenvrienden is er dierenplaats: een platform waarop je dieren kunt kopen en verkopen. Je wil immers een dier kopen dat van een betrouwbare dierenvriend afkomstig is. Of je nu op zoek bent naar een hond of een hagedis: op dierenplaats vind je alle dieren onder ????n dak!</p>
                    <div class="stats_panel mt-4">
                        <div class="row">
                          <div class="col col-md-4">
                              <h2>25K</h2>
                              {{__('Pets')}}
                          </div>
                          <div class="col col-md-4">
                              <h2>78K</h2>
                              {{__('Images')}}
                          </div>
                          <div class="col col-md-4">
                            <h2>19K</h2>
                            {{__('Happy owners')}}
                        </div>
                        </div>
                    </div>
                    <a href="#" class="btn btn-primary btn-lg">{{__('Discover Now')}}</a>
					<div class="float_icon" style="margin-top:20px"><img src="{{ asset( $publicPath . 'front_assets/images/cage.svg') }}"></div>
              </div>  
              <div class="col-md-2"></div>
              <div class="col-md-5">
                  <img src="{{ asset( $publicPath . 'front_assets/images/ameer-basheer.jpg') }}" />
              </div>
        </div>
      </div>    
    </div>
    <!--============== OUR MISSION ENDS HERE ==============-->     
    
    
    <!--============== ABOUT US HERE ==============-->
    <div class="about_us_panel">
      <div class="container">
          <div class="row">
                <div class="col-md-7">
					<div class="float_icon flip3" style="left: 0;bottom: -140px;"><img src="{{ asset( $publicPath . 'front_assets/images/rabbit.svg') }}"></div>
                    <img src="{{ asset( $publicPath . 'front_assets/images/illusrtation.svg') }}" />
                </div>
                <div class="col-md-5">
                      <h5>{{__('About us')}}</h5>
                      <h2 class="mb-4">Dieren-Plaats</h2>
                      <p class="mb-4">Je hebt er goed over nagedacht: er komt een (huis)dier! Op dierenplaats worden dieren van alle soorten en maten aangeboden. Zowel fokkers als particulieren worden op dierenplaats zorgvuldig gescreend, gecontroleerd en geselecteerd. Zo komen alle dieren op hun pootjes terecht!

Het doel van dierenplaats is om dieren aan een nieuw baasje te koppelen en voor jouw dier een geschikt baasje te vinden. Bij de aanschaf van een dier moet je natuurlijk wel rekening houden met bepaalde omstandigheden. Wat voor soort dier zoek je? Wat is je woonsituatie? Matchen jullie karakters? Welke eisen stel je aan het dier en welk dier past bij je?</p>
					  <div class="float_icon flip3" style="right: 0; bottom: -140px;"><img src="{{ asset( $publicPath . 'front_assets/images/dog.svg') }}"></div>
                </div>  
          </div>
        </div>    
      </div>
      <!--============== OUR MISSION ENDS HERE ==============--> 

      
      <!--============== WHY CHOOSE HERE ==============-->
    <div class="why_choose_panel">
      <div class="container">
          <div class="row">
                <div class="col-md-12 text-center">
						<div class="float_icon flip2" style="margin-left: -40px;bottom: 0;"><img src="{{ asset( $publicPath . 'front_assets/images/cat.svg') }}"></div>
                      <h5>waarom</h5>
                      <h2 class="mb-4">Kiezen voor Dieren-Plaats?</h2>
                      <p>Waarom kiezen voor dierenplaats? Je bent gek op dieren en op zoek naar de perfecte match. Dierenplaats helpt jou een maatje voor het leven te vinden. Wij vinden het vanzelfsprekend dat jouw toekomstige maatje uit een goed nest komt. Dierenplaats is het dierenplatform waarop zowel fokkers als particulieren dieren kunnen aankopen of verkopen. De fokkers die op dierenplaats actief zijn, zijn door dierenvrienden beoordeeld op ervaring en deskundigheid. Zo helpen we elkaar af te rekenen met broodfokkers. Je kunt een review plaatsen bij jouw fokker en reviews van anderen lezen, zodat je tot een weloverwogen besluit komt bij de aanschaf van je nieuwe huisgenoot.</p>
					  <div class="float_icon flip3" style="right: -40px;bottom: -50px;"><img src="{{ asset( $publicPath . 'front_assets/images/rabbit.svg') }}"></div>
                </div>  
          </div>
          <div class="blocks_section">
            <div class="row">
                <div class="col-md-6 pb-4">
                      <!-- IMAGE BOX -->
                      <div class="image_box type_4">
                        <div class="info">
                            <div class="row">
                                <div class="col-md-3 text-center left-side">
                                    <img src="{{ asset( $publicPath . 'front_assets/images/why-icon-1.png') }}" />
                                </div>
                                <div class="col-md-9">
                                    <div class="name">
                                      Gratis advertentie
                                    </div>
                                    <div class="desc">
                                        Omdat de plaatsing van een advertentie niet budgetgebonden hoeft te zijn
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div>
                </div>
                <div class="col-md-6 pb-4">
                    <!-- IMAGE BOX -->
                    <div class="image_box type_4">
                      <div class="info">
                          <div class="row">
                              <div class="col-md-3 text-center left-side">
                                  <img src="{{ asset( $publicPath . 'front_assets/images/why-icon-2.png') }}" />
                              </div>
                              <div class="col-md-9">
                                  <div class="name">
                                    Fokkers worden gecheckt
                                  </div>
                                  <div class="desc">
                                      Erkende fokkers, zodat je weet uit welk nest jouw dier komt
                                  </div>
                              </div>
                          </div>
                      </div>  
                  </div>
                </div>
                <div class="col-md-6">
                    <!-- IMAGE BOX -->
                    <div class="image_box type_4">
                      <div class="info">
                          <div class="row">
                              <div class="col-md-3 text-center left-side">
                                  <img src="{{ asset( $publicPath . 'front_assets/images/why-icon-3.png') }}" />
                              </div>
                              <div class="col-md-9">
                                  <div class="name">
                                      Zichtbare beoordeling <br>fokkers
                                  </div>
                                  <div class="desc">
                                      De beste fokkers, beoordeeld door dierenvrienden
                                  </div>
                              </div>
                          </div>
                      </div>  
                    </div>
                    <div class="float_icon flip2" style="margin-left: -80px; margin-top: -30px;"><img src="{{ asset( $publicPath . 'front_assets/images/pawprint.svg') }}"/></div>
                </div>
                <div class="col-md-6">
                  <!-- IMAGE BOX -->
                  <div class="image_box type_4">
                    <div class="info">
                        <div class="row">
                            <div class="col-md-3 text-center left-side">
                                <img src="{{ asset( $publicPath . 'front_assets/images/why-icon-4.png') }}" />
                            </div>
                            <div class="col-md-9">
                                <div class="name">
                                   Alle huisdieren onder <br>????n dak
                                </div>
                                <div class="desc">
                                    Echt ??lle dieren, behalve beunhazen ;-)
                                </div>
                            </div>
                        </div>
                    </div>  
                  </div>
                </div>
            </div>
          </div>
          
        </div>    
      </div>
      <!--============== OUR MISSION ENDS HERE ==============--> 
      @endsection

      @section('optional_scripts')
      <script type="text/javascript">
        var APP_URL="{{url('/')}}";
      </script>
<script src="{{ asset( $publicPath . 'front_assets/js/adsaveforlater.js') }}"></script>
<script src="{{ asset( $publicPath . 'front_assets/js/subscribe.js') }}"></script>
  <script type="text/javascript">
      $('#searchIndexBtn').on('click', function(event) {
        event.preventDefault();
        $('#frmSearchIndex').submit();
      });
    </script>
      @endsection

  