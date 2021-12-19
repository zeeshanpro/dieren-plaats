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
          <div class="row pt-3">
              <!-- RIGHT MAIN PANEL -->
              <div class="col-md-9">
                <div class="row">
                    <div class="col pb-5">
                        <div class="shadow_box my_profile_section">
                          <div class="page-header">
                            <div class="row">
                                <div class="col">
                                    <h2>{{__('Preview')}}</h2>
                                </div>
                                <div class="col text-end text-grey">
                                {{__('Step')}}: 4/4
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col pt-4">
                                  <!-- PRODUCT DETAIL PANEL -->
                                  <div class="product_detail_panel pb-5">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                              <div class="carousel-inner">
                                              @if(isset( $adData->adImages ))
                                                @foreach ($adData->adImages as $filename)
                                                    <div class="carousel-item @if ($loop->first) active @endif">
                                                    <img src="{{ url('storage/app/public/uploads/ads/'. $filename->filename) }}" class="d-block w-100" alt="...">
                                                    </div>
                                                @endforeach
                                              @endif
                                              </div>
                                              <div class="carousel-indicators">
                                              @if(isset( $adData->adImages ))
                                                @foreach ($adData->adImages as $filename)
                                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{$loop->iteration - 1}}" class="@if ($loop->first) active @endif" aria-current="true" aria-label="Slide {{$loop->iteration}}">
                                                    <img src="{{ url('storage/app/public/uploads/ads/thumb/'. $filename->filename) }}" class="d-block" alt="...">
                                                </button>
                                                @endforeach
                                              @endif
                                              </div>
                                              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                              </button>
                                              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                              </button>
                                            </div>
                                        </div>
                                        <div class="col-md-5 desc_panel">
                                            <h2>{{$adData->title}}</h2>
                                            <div class="price">
                                                €{{$adData->amount}}
                                            </div>
                                            <div class="date text-grey pb-3">
                                              <?php echo date('M d, Y', strtotime( $adData['created_at'] ) ); ?>
                                            </div>
                                            <h6 class="text-grey">{{__('Pet info')}}</h6>
                                            @php 
                                                $displayedAttributes = array();
                                                $firstIteration = true;
                                            @endphp
                                            @foreach ($adData->adSelectedAttributes as $attributeAndOptions)
                                                @php
                                                    $attributeTitle = $attributeAndOptions->ad_selected_attributeAd_attribute_option->ad_attribute_optionAd_attribute->title;
                                                    if( !in_array( $attributeTitle , $displayedAttributes ) ){
                                                        $displayedAttributes[] = $attributeTitle;
                                                        if( $firstIteration == false )
                                                            echo '</div>';
                                                        else 
                                                            $firstIteration = false ;    
                                                        @endphp
                                                        <div class="feature_list">
                                                        <img src="{{ asset( $publicPath . 'front_assets/images/paw-red.svg') }}" /> 
                                                        {{ $attributeAndOptions->ad_selected_attributeAd_attribute_option->ad_attribute_optionAd_attribute->title }} :
                                                        {{ $attributeAndOptions->ad_selected_attributeAd_attribute_option->title }}, 
                                                @php   } else { @endphp
                                                            {{ $attributeAndOptions->ad_selected_attributeAd_attribute_option->title }}
                                                @php    }
                                                @endphp
                                            @endforeach
                                            
                                            </div>
                                            <h6 class="text-grey mt-4">{{__('Description')}}</h6>
                                            <div class="desc">
                                            {{$adData->desc}}
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                                  <!-- PRODUCT DETAIL PANEL ENDS -->

                            </div>
                        </div>

                        </div>
                    </div>
                </div>
                
              </div>
              
             

              <div class="col-md-3 left_sidebar">
                <div class="image_box type_3 mb-4">
                  <div class="info">
                      <form method="post" action="{{route('publishad', [ 'adId' => $adData->id ] )}}">
                        <div class="row">
                          <div class="col">
                            <div class="button_block">
                                <div class="d-grid gap-2">
                                  @csrf
                                  <input type="hidden" name="adId" value="{{$adData->id}}" />
                                  <input type="submit" class="btn btn-primary btn-lg" name="Publish" value="{{__('Publish')}}" />
                                  <!-- <a href="#" class="btn btn-primary btn-lg">{{__('Publish')}}</a> -->
                                  <a href="{{ route('showattributespage', [ 'adId' => $adData->id ] ) }}" class="btn btn-info btn-lg">{{__('Back')}}</a>
                                  <a href="{{ route('showMyAds') }}" class="btn btn-lg">{{__('Save as draft')}}</a>
                                </div>  
                            </div>
                            <div class="row">
                              <div class="col">
                                <div class="form-check border-top-grey pt-4 mt-2">
                                  <input class="form-check-input" type="checkbox" value="1" name="promotead" id="flexCheckChecked" >
                                  <label class="form-check-label" for="flexCheckChecked">
                                    {{__("Promote your ad as 'top ad' for only €1 (7days).")}} 
                                    <a target="_blank" href="/benefit_of_paid_ads" class="grey">Read more</a>
                                  </label>
                                </div>
                            </div>
                          </div>
                        </div>
                      </form>
                  </div>  
                </div>
              </div>

              

          </div>
      </div>
  </div> 
@endsection