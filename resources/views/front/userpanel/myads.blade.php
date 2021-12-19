@extends('front/layout/layout')
<?php $publicPath = env('ASSETS_PATH'); ?>
  @section('optional_css')
      <meta name="csrf-token" content="{{ csrf_token() }}" />
  @endsection
@section('container')


<div class="inner_page_content_area">
      <div class="container">
          <div class="row pt-3">
              <div class="col-md-3 left_sidebar">
                  <div class="image_box type_3 mb-4">
                    <div class="info">
                        <div class="row">
                        <?php if( $User->usertype != 'Normal' ) {?>
                            <div class="col col-md-4 left-side">
                                <img src="{{url('storage/app/public/uploads/users/thumb/'.$Breeder->logo??'')}}" alt="No Logo">
                            </div>
                            <?php } ?>
                            <div class="col-8 col-md-8">
                                <div class="name">
                                 {{$Breeder->owner_name ?? $User->name}}
                                </div>
                                <?php if( $User->usertype != 'Normal' ) {?>
                                <div class="reviews pb-2">
                                  @include( 'front.layout.components.stars',['stars'=>$sellerReport['avg_rating']??'1'] )
                                  <!-- <i class="bi bi-star-fill active"></i> <i class="bi bi-star-fill active"></i> <i class="bi bi-star-fill active"></i> <i class="bi bi-star-fill active"></i> <i class="bi bi-star-fill"></i>  --><span class="text-grey">({{$sellerReport['no_of_reviews']??0}})</span>
                                </div>
                                <?php } ?>
                                <span class="badge bg-info">{{$User->usertype ?? 'No User'}}</span>
                            </div>
                        </div>
                        <div class="row mt-3 text-center">
                            <div class="col">
                                <div class="stats">
                                    {{$User->user_ads_count ?? '0'}} <span class="text-grey">Ad</span>
                                </div>
                            </div>
                            <div class="col-8">
                              <div class="stats">
                              {{$views ?? '0'}} <span class="text-grey">View</span>
                            </div>
                          </div>
                        </div>
                        <?php if( $User->usertype != 'Normal' ) {?>
                        <div class="row">
                            <div class="col pt-3">
                                <p>{{$Breeder->compay_about ??'Nee '. __("Description").' Added'}}</p>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="row">
                          <div class="col">
                          <?php if( $User->usertype != 'Normal' ) {?>
                              <div class="feature_list pb-2">
                                <img src="{{asset('front_assets/images/paw-grey.svg')}}" />  {{$Breeder->breederKind->breeder_kindKind->title??'none'}}
                              </div>
                             <?php } ?> 
                              <div class="feature_list pb-2">
                                  <i class="bi bi-geo-alt-fill pe-2"></i> 
                                  @php
                                  $address = '';
                                  if( isset( $Breeder->street ) )
                                    $address = $Breeder->street.', ';
                                  if( isset( $Breeder->city ) )
                                    $address .= $Breeder->city.', ';
                                  if(isset($Breeder->country))
                                    $address .= $Breeder->country.'';
                                    else
                                    $address.="Netherland";
                                @endphp
                                {{$address }}
                              </div>
                              <?php if( $User->usertype != 'Normal' ) {?>
                              <div class="feature_list pb-2">
                                <i class="bi bi-link-45deg pe-2"></i> <a href="{{$Breeder->website??'#'}}" target="_blank">{{$Breeder->website ?? 'No Website'}}</a>
                              </div>
                              <?php } ?>
                              <div class="feature_list">
                                <i class="bi bi-telephone-fill pe-2"></i> {{$Breeder->phone ?? 'No Telefoonnummer'}}
                              </div>
                          </div>
                        </div>
                        <?php if( $User->usertype != 'Normal' ) {?>
                        <div class="row">
                          <div class="col">
                              <div class="social_links">
                                  @if(isset( $postCreator->fb_url ))
                              <a href="{{$postCreator->fb_url}}"><i class="bi bi-facebook"></i></a>
                              @endif
                              @if(isset( $postCreator->insta_url ))
                              <a href="{{$postCreator->insta_url}}"><i class="bi bi-instagram"></i></a>
                              @endif
                              @if(isset( $postCreator->linkedin_url ))
                              <a href="{{$postCreator->linkedin_url}}"><i class="bi bi-linkedin"></i></a>
                              @endif
                              </div>
                          </div>
                        </div>
                        <?php } ?>    
                    </div>  
                  </div>
                  
              </div>
              <!-- RIGHT MAIN PANEL -->
              <div class="col-md-9">
              <?php if( $User->usertype != 'Normal' ) {?>
                <div class="row ">
                    <div class="col">
                        <div class="inner_page_top_tabs">
                            <span class="underline">Ads</span>
                            <a href="{{url('profile/expectedbabies/'.$User->id.'/'. Str::slug($Breeder->owner_name ?? $User->name) )}}">{{__('Expected Babies')}}</a>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <div class="row justify-content-center justify-content-md-start">

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
                        @include('front.layout.components.subviews.adCell', [ 'row' => $row , 'ifWatchLater'=>$idExist,'cellColumn'=>4, 'myad' => 1 ] )
                    @empty
                    <h3 class="p-5 border rounded">{{__('No Ads Available')}}</h3>
                    @endforelse




              </div>
              <!-- CONTENT BOTTOM PANEL-->
              <div class="row mt-4 mb-4">
              <div class="col-auto me-auto">
                  {{ $result->links('pagination::bootstrap-4') }}
                </div>
              </div>

            </div>

          </div>
      </div>
  </div> 
  
@endsection
@section('optional_scripts')



      <script type="text/javascript">
        var APP_URL="{{url('/')}}";
        jQuery(document).ready(function($) {

          $(document).on('change', '.isAdPublished', function(event) {
            event.preventDefault();
            
            togglePublish($(this));

          });


          function togglePublish(element)
          {
            var csrftokenval=$('meta[name="csrf-token"]').attr('content');

    showLoader();
    
   var id=element.data('id');

var jqxhr = $.ajax( {
  url: 'ad/playpause',
  method:"POST",
  data:{"adId":id},
  headers: { 'X-CSRF-TOKEN': csrftokenval }
  })
  .done(function(data) {
   
    hideLoader();
   if(data.code==201)
   {
   // console.log("success");
   if(data.status=="0")
     { 
     element.prop('checked',false);

         }
    else if(data.status=="1")
{  
 element.prop('checked',true);

}
   }
   else
   {
      element.prop('checked',!element.is(':checked'));
  
   }
    
  })
  .fail(function(data) {
   
     hideLoader();
   element.prop('checked', !element.is(':checked'));
  
  });
          }
          
        });


      </script>
<script src="{{ asset( $publicPath . 'front_assets/js/adsaveforlater.js') }}"></script>
      @endsection