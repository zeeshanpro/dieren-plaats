@extends('front/layout/layout')
<?php $publicPath = env('ASSETS_PATH'); ?>
@section('container')

<div class="inner_page_content_area">
      <div class="container">
          <div class="row">
              <div class="col">
                  <h3>{{__('Add new ad')}}</h3>
              </div>
          </div>
          @if ( $OkToProceed == false )
          <p class="alert alert-info">{{$msg}}</p>
          @endif
          
          <div class="row pt-3">
              <!-- RIGHT MAIN PANEL -->
              <div class="col-lg-9 col-md-8">
                <div class="row">
                    <div class="col pb-5">
                        <div class="shadow_box my_profile_section">
                          <div class="page-header">
                            <div class="row">
                                <div class="col">
                                    <h2>{{__('Select animal kind')}}</h2>
                                </div>
                                <div class="col text-end text-grey">
                                {{__('Step')}}: 1/4
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col pt-4">
                                 <!-- SELECT ANIMAL KIND -->
                                 <div class="select_animal_kind">
                                    <div class="row">
                                 @inject( "kindMaster" , 'App\Repositories\Front\KindRepository' )
                                @php
                                    $kindResults = $kindMaster->list( 30 );
                                @endphp
                                @foreach ( $kindResults['result'] as $row)
                                        <div class="col-lg-3 col-6">
                                            <a href="javascript:void(0);" onclick="return onKindSelection('{{ $row->id }}');">
                                            <figure class="figure" id="figure_{{ $row->id }}">
                                              <img src="{{ url('storage/app/public/uploads/kind/thumb/'.($row->image ?? 'default.png')) }}" class="figure-img img-fluid rounded" alt="...">
                                              <figcaption class="figure-caption" >{{ $row->title }}</figcaption>
                                            </figure></a>
                                          </div>
                                @endforeach
                                    </div>
                                 </div>  
                                 <!-- / SELECT ANIMAL KIND -->
                            </div>
                          </div>

                        </div>
                    </div>
                </div>
                
              </div>

              <div class="col-lg-3 col-md-4 left_sidebar">
                <div class="image_box type_3 mb-4">
                  <div class="info d-none d-md-block py-5">
                      <div class="row">
                        <div class="col">
                            <div class="button_block">
                            @if ( $OkToProceed == false )
                              <span style="color:red;">{{$msg}}</span>
                            @endif
                                <div class="d-grid gap-2">  
                                  <a href="#" id="goto_createad_fillform" class="btn btn-primary btn-lg">{{__('Continue')}}</a>
                                  <a href="{{url('/')}}" class="btn btn-info btn-lg">{{__('Back')}}</a>
                                </div>
                            </div>
                      </div>
                  </div> 
                </div>
                <div class="info d-block d-md-none position-fixed bottom-0 end-0 bg-white w-100 py-4 shadow" style="z-index:999;">
                      <div class="row">
                        <div class="col-6">
                            <div class="button_block">
                            @if ( $OkToProceed == false )
                              <span style="color:red;">{{$msg}}</span>
                            @endif
                                <div class="d-grid gap-2">  
                                  <a href="#" id="goto_createad_fillform_btn" class="btn btn-primary ">{{__('Continue')}}</a>
                                  <!-- <a href="#" class="btn btn-lg">Save as Draft</a> -->
                                </div>
                            </div>
                      </div>
                      <div class="col-6">
                            <div class="button_block">
                                <div class="d-grid gap-2">  
                                  <a href="{{url('/')}}" class="btn btn-info ">{{__('Back')}}</a>
                                  <!-- <a href="#" class="btn btn-lg">Save as Draft</a> -->
                                </div>
                            </div>
                      </div>
                  </div>  
                  <!-- ending info here above -->
              </div>
              
          </div>
      </div>
  </div> 
<script>
  @if ( $OkToProceed == true )
    function onKindSelection( kind ){
        $('.figure').each( function() {
          $(this).css( 'border-width', '0' );
        } );
        var link = document.getElementById("goto_createad_fillform");
        link.setAttribute('href', kind + "/filldetails");

        var link_btn = document.getElementById("goto_createad_fillform_btn");
        link_btn.setAttribute('href', kind + "/filldetails");
        $("#figure_" + kind).css( 'border', '3px solid red' );
    }

    @endif
</script>
@endsection