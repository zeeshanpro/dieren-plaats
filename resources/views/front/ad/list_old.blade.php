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
              <div class="col-md-2 left_sidebar">
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
                              <input type="text" class="form-control filter" id="minrangetext" placeholder="€">
                            </div>
                            <div class="col-1 text-center">-</div>
                            <div class="col">
                              <input type="text" class="form-control filter" id="maxrangetext" placeholder="€">
                            </div>
                            <div class="col-1"><button><i class="bi bi-chevron-right"></i></button></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    @inject( "adAttributeObj" , 'App\Repositories\Front\AdAttributeRepository' )
                    @php
                        $attributesResults = $adAttributeObj->listAttributes();
                        //dd($attributesResults);
                    @endphp  
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
                                    {{$attributeValues->title}} <span>(20)</span>
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
                  <div class="col">
                      <h2>{{$kind->title}}</h2>
                      <p class="text-grey">20 of 200 items</p>
                  </div>
                  <div class="col text-end">
                      <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                          {{__('Sort by')}}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                          <li><a class="dropdown-item" href="#">Action</a></li>
                          <li><a class="dropdown-item" href="#">Another action</a></li>
                          <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                      </div>
                  </div>
                </div>
                <div class="row mb-4">
                  <div class="col" id="ftag">
                     <!--  <div class="filter_tag mt-1">
                          €0 - €999.99 <a href="#"><i class="bi bi-x"></i></a>
                      </div>
                      <div class="filter_tag mt-1">
                        vaccinated : yes <a href="#"><i class="bi bi-x"></i></a>
                      </div>
                      <div class="filter_tag mt-1">
                        0 to 7 weeks <a href="#"><i class="bi bi-x"></i></a>
                      </div> -->
                      <a href="javascript:void(0);" id="clearall">{{__('clear all')}}</a>
                  </div>
                </div>
                <div class="row">
                  <?php 
                if( isset( $savedAdsIds ) )
                    $adids = explode(',', $savedAdsIds);
                else
                    $adids = array();
                    ?>
                   
                   @forelse ( $result as $row)
                   <?php 
                    $idExist = in_array($row->id , $adids); 
                    ?>
                        @include( 'front.layout.components.subviews.adCell', [ 'row' => $row , 'ifWatchLater'=>$idExist,'cellColumn' => 4] )
                        @empty
                        <h3 class="border rounded m-2 p-4 w-75">No Data Available</h3>
                    @endforelse


              </div>
              <!-- CONTENT BOTTOM PANEL-->
              <div class="row mt-4 mb-4">
                <div class="col-auto me-auto">
                  {{ $result->links('pagination::bootstrap-4') }}
                </div>
              </div>

            </div>

              <div class="col-md-1 pt-5 d-none d-md-block">
                  <img src="{{ asset( $publicPath . 'front_assets/images/advertisement.svg') }}" />
              </div>
          </div>
      </div>
  </div> 
  <!--============== SEARCH BY TYPE ENDS HERE ==============-->
@endsection
    @section('optional_scripts')
      <script type="text/javascript">
        var APP_URL="{{url('/')}}";
      </script>
<script src="{{ asset( $publicPath . 'front_assets/js/adsaveforlater.js') }}"></script>
<script type="text/javascript">


  $(document).on('change', '.filter', function(event){
    fetch_data();
   });

  $(document).on('change', '.filter', function(event){
    var checkboxId=$(this).attr("id");
    var attributeTitle=$(this).data('belongs_to_attribute');
     var label=($("label[for='" + checkboxId + "']").get(0).innerText);
     
     //remove data in brackets
     var part = label.substring(
    label.lastIndexOf("(") + 1, 
    label.lastIndexOf(")")
      );
    label=label.replace("("+ part +")", "");
     // code for remove data in brackets ends here


    if( $(this).is(':checked') ){ 
   $("#ftag").prepend('<div class="filter_tag mt-1">'+ attributeTitle + ": " + label + '<a href="javascript:void(0);" ><i class="bi bi-x filter_remove" data-checkboxid="' + checkboxId + '" data-label="' + label + '"></i></a></div>');
    }
    else
    {
      $('.filter_tag:contains("' + label + '")').remove();
    }
  });

$(document).on('click', '.filter_remove', function(event){
    var label=$(this).data('label');
    var checkboxId=$(this).data('checkboxid');

    $('.filter_tag:contains("' + label + '")').remove();
    $('#'+checkboxId).prop('checked', false); // Unchecks it
    
  });






  function fetch_data()
  {
    add_filters();
    
    return ;

    $(".loader").toggleClass('d-none');
    $.ajax({
    url: "{{route('search_breeders')}}?query=data"+add_filters(),
    success:function(data)
      {
        $(".loader").toggleClass('d-none'); 
        $(window).scrollTop( $(".loader").offset().top );
        $('#breederDataContainer').replaceWith(function(){
        return data;
        });
      }
    }).fail(function() {
   $(".loader").addClass('d-none');
  })
  }


  $(document).on('click', '#clearall', function(event){
    $('input:checkbox').each(function () { $(this).prop('checked', false); });
       $('#minrangetext').val(""); 
     $('#maxrangetext').val("");
     $('.filter_tag').remove();
  });



  function add_filters()
  {
    var filter_string = "";
    var options_string = '';
    $( ".filter" ).each(function( index ) {
      var filter_column = $(this).data('filter_column');
      var attributeTitle=$(this).data('belongs_to_attribute');
      //var element = $('[data-filter_column="' + filter_column + '"]');
      if( $(this).is(':checked')  && attributeTitle!="Price"){ 
        var value = $(this).val();
        
          options_string += value + ",";
       
      }
    });
    filter_string += "options=" + options_string.slice(0,-1);
    // if( filter_string != "" )
    // {
    //   filter_string="&"+ filter_string.slice(0,-1);
    // }
    console.log( filter_string+"&"+add_filters_price() );
    return filter_string+"&"+add_filters_price();
  }

    function add_filters_price()
  {
    var filter_string = "";
    
    var minrangetext=$('#minrangetext').val(); 
       var maxrangetext=$('#maxrangetext').val();
    var _array = [];
    $( ".filterprice" ).each(function( index ) {
      var filter_column = $(this).data('filter_column');
      var minrange = $(this).data('minrange');
      var maxrange = $(this).data('maxrange');
      
      
       minrangetext = minrangetext.replace(/[^0-9]/g,''); 

    
       maxrangetext = maxrangetext.replace(/[^0-9]/g,'');
     
      if( $(this).is(':checked') ){ 
        _array.push(minrange)
        _array.push(maxrange)
            }
    });
// console.log("MinRangeText : " + minrangetext + "  MaxRangeText : " + maxrangetext);
if(minrangetext!="" && minrangetext>=0 && maxrangetext!="" && maxrangetext>=0)
{
  _array.push(minrangetext);
  _array.push(maxrangetext);

}

if(_array.length>0)
{
    maxrange=Math.max.apply(Math,_array); 
    minrange=Math.min.apply(Math,_array); 
  }
  else
  {
    maxrange=0;
    minrange=0;
  }

    filter_string += "pricerange=" + minrange+","+maxrange;
    
  
    return filter_string;
  }
  </script>
      @endsection
