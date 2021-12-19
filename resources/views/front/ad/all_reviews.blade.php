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
              <div class="col-2"></div>
              <div class="col-8">
                  <!-- PRODUCT DETAIL REVIEWS -->
                  <div class="review_section pt-4 mt-5 pb-4 review_single_page mb-5">
                    <div class="row">
                        <div class="col-12">
                              <div class="row">
                                  <div class="col">
                                      <h3>Client Reviews</h3>
                                  </div>
                                  <div class="col text-end">
                                      <div class="reviews xl pb-2">
                                        <i class="bi bi-star-fill active"></i> <i class="bi bi-star-fill active"></i> <i class="bi bi-star-fill active"></i> <i class="bi bi-star-fill active"></i> <i class="bi bi-star-fill"></i>
                                      </div>
                                      <span class="text-grey">Average reviews (200)</span>
                                  </div>
                              </div>
                              <!-- REVIEW -->
                             @forelse($breederReviews as $review)
                              <div class="review_box">
                                  <div class="row pt-4">
                                      <div class="col">
                                          <div class="user">
                                            @if($review->breeder_reviewUser->Breeder->logo)
                                            <img src="{{url('storage/app/public/uploads/users/thumb/'.$review->breeder_reviewUser->Breeder->logo)}}" class="user" />
                                            @else
                                            <img src="{{asset('front_assets/images/default.jpg')}}" class="user" />
                                            @endif 
                                            {{$review->breeder_reviewUser->name??'Unknown'}}
                                          </div>  
                                      </div>
                                      <div class="col text-end">
                                        <span class="text-grey">{{date('j/m/Y', strtotime($review->created_at))??'Unknown'}}</span>
                                    </div>
                                  </div>
                                  <div class="row pt-2">
                                      <div class="col">
                                        <div class="reviews pb-2">
                                          @include( 'front.layout.components.stars',['stars'=>$review->rating??1] )
                                        </div>
                                      </div>
                                  </div>
                                  <div class="row pt-2">
                                    <div class="col text-grey">
                                      <p>{{$review->opinion??'No Comment Added'}}</p>
                                    </div>
                                </div>
                              </div>
                                @empty
                                  <h3 class="p-4 border rounded">No Reviews Yet</h3>
                                  @endforelse

                           

                              
                        </div>
                    </div>
                  </div>  
                  <!-- PRODUCT DETAIL REVIEWS ENDS-->
              </div>
          </div>
      </div>
  </div> 
  <!--============== SEARCH BY TYPE ENDS HERE ==============-->
@endsection

      @section('optional_scripts')
     
      @endsection

  