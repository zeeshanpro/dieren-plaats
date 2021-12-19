@extends('front/layout/layout')
<?php $publicPath = env('ASSETS_PATH'); ?>
@section('showMiddleBar','true')
@section('optional_css')
  <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
 
@section('container')
<!--============== SEARCH BY TYPE STARS HERE ==============-->
<div class="inner_page_content_area">
      <div class="container">
          <div class="row">
              <div class="col-xs-5">
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-info d-block d-md-none mb-4" data-bs-toggle="modal" data-bs-target="#filters_menu">
            <i class="bi bi-funnel-fill me-1"></i> Filters
          </button>
        </div>  
              <div class="col-md-3 col-lg-2 left_sidebar d-none d-md-block" id="desktopFilter">
                  <h2>{{__('Filter by')}}</h2>
                  <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                          {{__('Price')}}
                        </button>
                      </h2>
                      <div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne">
                        <div class="accordion-body">
                          <div class="form-check">
                            <input class="form-check-input filter filterprice" data-minrange="0" data-maxrange="100"  type="checkbox" name="pricerange[]"  id="pricerange_100" data-belongs_to_attribute="Price">
                            <label class="form-check-label" for="pricerange_100">
                                €0 - €100.00
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input filter filterprice" data-minrange="100" data-maxrange="200" type="checkbox"  name="pricerange[]" id="pricerange_200"  data-belongs_to_attribute="Price">
                            <label class="form-check-label" for="pricerange_200">
                                €100.00 - €200.00
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input filter filterprice" data-minrange="200" data-maxrange="300"  type="checkbox"  name="pricerange[]" id="pricerange_300"  data-belongs_to_attribute="Price">
                            <label class="form-check-label" for="pricerange_300">
                                €200 - €300
                            </label>
                          </div>
                          <div class="row g-0 range pt-2">
                            <div class="col">
                              <input type="text" class="form-control " id="minrangetext" placeholder="€">
                            </div>
                            <div class="col-1 text-center">-</div>
                            <div class="col">
                              <input type="text" class="form-control " id="maxrangetext" placeholder="€">
                            </div>
                            <div class="col-1"><button id="customPrice"><i class="bi bi-chevron-right"></i></button></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    @inject( "adAttributeObj" , 'App\Repositories\Front\AdAttributeRepository' )
                    @php
                        $attributesResults = $adAttributeObj->listAttributes( $kindId );
                    @endphp  

                    <!-- Race -->
                    

                    <div class="accordion-item">
                      <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        {{__('Race')}}

                        </button>
                      </h2>
                      <div id="flush-collapseTwo" class="accordion-collapse collapse show" aria-labelledby="flush-headingTwo">
                        <div class="accordion-body" style="overflow-y: auto;max-height:300px;">
                       @foreach ($attributesResults['race'] as $attributeValues)
                            <div class="form-check">
                                <input class="form-check-input filter" data-filter_column="Race" type="checkbox" value="{{$attributeValues->id}}" <?php if( isset( $options_race ) and $options_race == $attributeValues->id ) echo 'checked'; ?> id="options_{{$attributeValues->id}}" data-belongs_to_attribute="Race">
                                <label class="form-check-label" for="options_{{$attributeValues->id}}">
                                   {{$attributeValues->title}} <span>(@if(isset( $attributeValues->race_ads_count))
                                      {{$attributeValues->race_ads_count}}
                                      @else
                                      0
                                      @endif
                                      )
                                    </span>



                                </label>
                            </div>
                        @endforeach
                        </div>
                      </div>
                    </div>
                  


                    <!-- Race Ends Here -->







                    @foreach ($attributesResults['result'] as $attribute)
                    @if(count($attribute->ad_attributeAdAttributeOptions)==0)
                    @continue
                    @endif
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        {{ $attribute->title }}

                        </button>
                      </h2>
                      <div id="flush-collapseTwo" class="accordion-collapse collapse show" aria-labelledby="flush-headingTwo">
                        <div class="accordion-body">
                        @foreach ($attribute->ad_attributeAdAttributeOptions as $attributeValues)
                            <div class="form-check">
                                <input class="form-check-input filter" data-filter_column="options" type="checkbox" value="{{$attributeValues->id}}" id="options_{{$attributeValues->id}}" data-belongs_to_attribute="{{ $attribute->title??'' }}">
                                <label class="form-check-label" for="options_{{$attributeValues->id}}">
                                   {{$attributeValues->title}} <span>(@if(isset( $attributesResults['arrayOfCountByOptions'][$attributeValues->id]))
                                      {{$attributesResults['arrayOfCountByOptions'][$attributeValues->id]}}
                                      @else
                                      0
                                      @endif
                                      )
                                    </span>



                                </label>
                            </div>
                        @endforeach
                        </div>
                      </div>
                    </div>
                    @endforeach
                    
                  </div>
              </div>
              <!-- RIGHT MAIN PANEL -->
              <div class="col-md-9">
                <div class="row">
                <x-loader/>
                  <div class="col">
                      <h2>{{$kind->title}}</h2>
                      <p class="text-grey">{{$result->currentPage()}} of {{ $result->lastPage() }} {{ Str::plural('Page', $result->lastPage())}}
</p>
                  </div>
                  <div class="col d-flex justify-content-end">
                   <div class="mb-3 pt-2 w-50">
                                <select class="form-select mb-3" aria-label=".form-select-lg example" name="dropsort" id="dropsort">
                                  <option selected="" value="null">{{__('Sort by')}} </option>
                                  <option value="datedesc">{{__('Latest First')}}</option>
                                  <option value="dateasc">{{__('Oldest First')}}</option>
                                  <option value="priceasc">{{__('Price Low - High')}}</option>
                                  <option value="pricedesc">{{__('Price High - Low')}}</option>
                                </select>
                              </div>
                    
                  </div>
                </div>
                <div class="row mb-4">
                  <div class="col" id="ftag">
                    
                      <a href="javascript:void(0);" id="clearall">{{__('clear all')}}</a>
                  </div>
                </div>
                
                @include('front.layout.components.adListBridge', [ 'result' => $result, 'topAdsArray' => $topAdsArray] );

            </div>

              <div class="col-md-1 pt-5 d-none d-md-block">
                  <img src="{{ asset( $publicPath . 'front_assets/images/advertisement.svg') }}" />
              </div>
          </div>
      </div>
  </div> 
  <!--============== SEARCH BY TYPE ENDS HERE ==============-->

<!-- FILTERS POPUP FOR MOBILE -->
  <div class="modal fade" id="filters_menu" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="staticBackdropLabel">Filter Results</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <div class="col-md-3 col-lg-2 left_sidebar">
                  <h2>{{__('Filter by')}}</h2>
                  <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                          {{__('Price')}}
                        </button>
                      </h2>
                      <div id="flush-collapseOne" class="accordion-collapse collapse show" aria-labelledby="flush-headingOne">
                        <div class="accordion-body">
                          <div class="form-check">
                            <input class="form-check-input filter filterprice" data-minrange="0" data-maxrange="100"  type="checkbox" name="pricerange[]"  id="pricerange_100" data-belongs_to_attribute="Price">
                            <label class="form-check-label" for="pricerange_100">
                                €0 - €100.00
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input filter filterprice" data-minrange="100" data-maxrange="200" type="checkbox"  name="pricerange[]" id="pricerange_200"  data-belongs_to_attribute="Price">
                            <label class="form-check-label" for="pricerange_200">
                                €100.00 - €200.00
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input filter filterprice" data-minrange="200" data-maxrange="300"  type="checkbox"  name="pricerange[]" id="pricerange_300"  data-belongs_to_attribute="Price">
                            <label class="form-check-label" for="pricerange_300">
                                €200 - €300
                            </label>
                          </div>
                          <div class="row g-0 range pt-2">
                            <div class="col">
                              <input type="text" class="form-control " id="minrangetext" placeholder="€">
                            </div>
                            <div class="col-1 text-center">-</div>
                            <div class="col">
                              <input type="text" class="form-control " id="maxrangetext" placeholder="€">
                            </div>
                            <div class="col-1"><button id="customPrice"><i class="bi bi-chevron-right"></i></button></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    @inject( "adAttributeObj" , 'App\Repositories\Front\AdAttributeRepository' )
                    @php
                        $attributesResults = $adAttributeObj->listAttributes($kindId);
                        //dd($attributesResults);
                    @endphp 

                    <!-- Race -->
                    

                    <div class="accordion-item mb-4">
                      <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        {{__('Race')}}

                        </button>
                      </h2>
                      <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo">
                        <div class="accordion-body" style="overflow-y: auto;max-height:300px;">
                       @foreach ($attributesResults['race'] as $attributeValues)
                            <div class="form-check">
                                <input class="form-check-input filter" data-filter_column="Race" type="checkbox" value="{{$attributeValues->id}}" id="options_{{$attributeValues->id}}" data-belongs_to_attribute="Race">
                                <label class="form-check-label" for="options_{{$attributeValues->id}}">
                                   {{$attributeValues->title}} <span>(@if(isset( $attributesResults->race_ads_count))
                                      {{$attributesResults->race_ads_count}}
                                      @else
                                      0
                                      @endif
                                      )
                                    </span>



                                </label>
                            </div>
                        @endforeach
                        </div>
                      </div>
                    </div>
                  


                    <!-- Race Ends Here -->






                    @foreach ($attributesResults['result'] as $attribute)
                    @if(count($attribute->ad_attributeAdAttributeOptions)==0)
                    @continue
                    @endif
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        {{ $attribute->title }}

                        </button>
                      </h2>
                      <div id="flush-collapseTwo" class="accordion-collapse collapse show" aria-labelledby="flush-headingTwo">
                        <div class="accordion-body">
                        @foreach ($attribute->ad_attributeAdAttributeOptions as $attributeValues)
                            <div class="form-check">
                                <input class="form-check-input filter" data-filter_column="options" type="checkbox" value="{{$attributeValues->id}}" id="options_{{$attributeValues->id}}" data-belongs_to_attribute="{{ $attribute->title??'' }}">
                                <label class="form-check-label" for="options_{{$attributeValues->id}}">
                                   {{$attributeValues->title}} <span>(@if(isset( $attributesResults['arrayOfCountByOptions'][$attributeValues->id]))
                                      {{$attributesResults['arrayOfCountByOptions'][$attributeValues->id]}}
                                      @else
                                      0
                                      @endif
                                      )
                                    </span>



                                </label>
                            </div>
                        @endforeach
                        </div>
                      </div>
                    </div>
                    @endforeach
                    
                  </div>
              </div>
      </div>
    </div>
    </div>
  </div>



  <!--  Mobile popup ends here -->


    @endsection
    @section('optional_scripts')
      <script type="text/javascript">
        var APP_URL="{{url('/')}}";
      </script>
<script src="{{ asset( $publicPath . 'front_assets/js/adsaveforlater.js') }}"></script>


<script src="{{ asset( $publicPath . 'front_assets/js/adlistfilters.js') }}"></script>

<script type="text/javascript">
  $(document).ready(function() {

  adListSearchFilter().init("{{route('search_adlistings')}}?kindId={{$kindId}}&");
});

$('#filters_menu').on('show.bs.modal', function (e) {
 $('#desktopFilter').remove();
})

</script>

      @endsection
