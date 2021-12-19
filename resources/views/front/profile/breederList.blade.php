@extends('front/layout/layout')
<?php $publicPath = env('ASSETS_PATH'); ?>
  @section('optional_css')
      <meta name="csrf-token" content="{{ csrf_token() }}" />
      
  @endsection
@section('container')

<div class="inner_page_content_area">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-12">
                   <h2 class="border rounded  p-5 text-center">Binnenkort beschikbaar !</h2>
                </div>
        </div>


          {{-- <div class="row">

            <x-loader/>
            
              <div class="col-md-2 left_sidebar">
                  <h2 class="d-inline">{{__('Filter by')}}</h2>
                  <small><a href="javascript:void(0)" class="mx-1" id="clearall">( {{__('clear all')}} )</a></small>
                  <div class="accordion accordion-flush" id="accordionFlushExample">
                   
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        {{__('kind')}}
                        </button>
                      </h2>
                      <div id="flush-collapseTwo" class="accordion-collapse collapse show" aria-labelledby="flush-headingTwo">
                        <div class="accordion-body">
                        @inject( "kindObj" , 'App\Repositories\Front\KindRepository' )
                        @php
                            $kindResults = $kindObj->listWithCount();
                        @endphp
                          @if( $kindResults['code'] == 200 )
                              @foreach ( $kindResults['result'] as $row)
                              <div class="form-check">
                                <input class="form-check-input filter" data-filter_column="kind" name="kind" value="{{$row->id}}" type="radio" id="{{$row->id}}">
                                <label class="form-check-label" for="kind_dog">
                                {{$row->title}} <span>( 
                                  @if ( isset( $kindResults['noOfBreedersArray'][ $row->id ] ) )
                                    {{$kindResults['noOfBreedersArray'][ $row->id ]}}
                                  @else
                                    0
                                  @endif
                                  )</span>
                                </label>
                              </div>
                              @endforeach
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="flush-headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                            Rating
                        </button>
                      </h2>
                      @inject( "kindObj" , 'App\Repositories\Front\BreederReviewRepository' )
                        @php
                            $kindResults = $kindObj->getBreederCountByReviewRange( );
                        @endphp
                      <div id="flush-collapseThree" class="accordion-collapse collapse show" aria-labelledby="flush-headingThree">
                        <div class="accordion-body">
                          <div class="form-check">
                            <input class="form-check-input filter" type="radio" data-filter_column="rating" name="rating" value="5" id="rating_5">
                            <label class="form-check-label" for="flexCheckDefault">
                                5 Stars <span>({{ isset($kindResults['5']) ? $kindResults['5'] : '0' }})</span>
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input filter" type="radio" data-filter_column="rating" name="rating" value="4" id="rating_4">
                            <label class="form-check-label" for="flexCheckDefault">
                                4 Stars <span>({{ isset($kindResults['4']) ? $kindResults['4'] : '0' }})</span>
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input filter" type="radio" data-filter_column="rating" name="rating" value="3" id="rating_3">
                            <label class="form-check-label" for="flexCheckDefault">
                                3 Stars <span>({{ isset($kindResults['3']) ? $kindResults['3'] : '0' }})</span>
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input filter" type="radio" data-filter_column="rating" name="rating" value="2" id="rating_2">
                            <label class="form-check-label" for="flexCheckDefault">
                                2 Stars <span>({{ isset($kindResults['2']) ? $kindResults['2'] : '0' }})</span>
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input filter" type="radio" data-filter_column="rating" name="rating" value="1" id="rating_1">
                            <label class="form-check-label" for="flexCheckDefault">
                                1 Star <span>({{ isset($kindResults['1']) ? $kindResults['1'] : '0' }})</span>
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
              </div>
              <!-- RIGHT MAIN PANEL -->

                  @include('front.layout.components.breederListBridge', $result );

            </div> --}}

              
          </div>
      </div>
  </div> 

  @endsection
@section('optional_scripts')
  <script type="text/javascript">


  function fetch_data()
  { 
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
    $('input:radio').each(function () { $(this).prop('checked', false); });
    fetch_data();
  });


  $(document).on('change', '.filter', function(event){
    fetch_data();
  });

  function add_filters()
  {
    var filter_string="";
    $( ".filter" ).each(function( index ) {
      var filter_column = $(this).data('filter_column');
      var element = $('[data-filter_column="' + filter_column + '"]');
      if( $(this).is(':checked') ){ 
        var value = $(this).val();
        filter_string += filter_column + "=" + value + "&";
      }
    });
    if( filter_string != "" )
    {
      filter_string="&"+ filter_string.slice(0,-1);
    }
    return filter_string;
  }
  </script>

   @endsection