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
                        <div class="row justify-content-center">
                           @if($User->usertype=="Shelter" || $User->usertype=="Breeder")
                            <div class="col col-md-4 left-side">
                                <img src="{{url('storage/app/public/uploads/users/thumb/'.$Breeder->logo??'')}}" alt="No Logo">
                            </div>
                            @endif
                            <div class="col-8 col-md-8">
                                <div class="name">
                                @if($User->usertype=="Normal")
                                  {{$User->name ?? ''}}
                                @else 
                                  {{$Breeder->company_name ?? $Breeder->owner_name}}
                                @endif
                                </div>
                                @if($User->usertype=="Shelter" || $User->usertype=="Breeder")
                                <div class="reviews pb-2">
                                  @include( 'front.layout.components.stars',['stars'=>$sellerReport['avg_rating']??'1'] )
                                  <span class="text-grey">({{ $sellerReport['no_of_reviews'] ?? 0 }})</span>
                                </div>
                                @endif
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

                         @if($User->usertype=="Shelter" || $User->usertype=="Breeder")
                        <div class="row">
                            <div class="col pt-3">
                                <p>{{$Breeder->compay_about ??'Nee Description Added'}}</p>
                            </div>
                        </div>
                        @endif



                        <div class="row">
                          <div class="col">
                            @if($User->usertype=="Shelter" || $User->usertype=="Breeder")
                              <div class="feature_list pb-2">

                                <img src="{{asset('front_assets/images/paw-grey.svg')}}" />  {{$Breeder->breederKind->breeder_kindKind->title??'none'}}
                              </div>
                              @endif
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
                              @if($User->usertype=="Shelter" || $User->usertype=="Breeder")
                              <div class="feature_list pb-2">
                                <i class="bi bi-link-45deg pe-2"></i> <a href="{{$Breeder->website??'#'}}" target="_blank">{{$Breeder->website ?? 'No Website'}}</a>
                              </div>
                              @endif

                              <div class="feature_list">
                                <i class="bi bi-telephone-fill pe-2"></i> {{$Breeder->phone ?? 'No Telefoonnummer'}}
                              </div>
                          </div>
                        </div>



                        @if($User->usertype=="Shelter" || $User->usertype=="Breeder")
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
                        @endif


                    </div>  
                  </div>
                  @if($User->usertype=="Shelter" || $User->usertype=="Breeder")
                   <div class="text-center">
                    @if(!$alreadyReviewed)
                    <a href="#" class="btn btn-info btn-lg" data-bs-toggle="modal" data-bs-target="#addReviewModal">{{__('Review the Seller')}}</a>
                    @endif
                  </div>
                  @endif
              </div>
              <!-- RIGHT MAIN PANEL -->
              <div class="col-md-9">
                <div class="row">
                    <div class="col">
                        <div class="inner_page_top_tabs">
                            <span class="underline">Ads</span>
                             @if($User->usertype=="Shelter" || $User->usertype=="Breeder")
                            <a href="{{url('profile/expectedbabies/'.$User->id.'/'. Str::slug($Breeder->owner_name ?? $User->name) )}}">{{__('Expected Babies')}}</a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row ">

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
                        @include( 'front.layout.components.subviews.adCell', [ 'row' => $row , 'ifWatchLater'=>$idExist,'cellColumn'=>4] )
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
  @if(!$alreadyReviewed)
  <!-- Modal -->
  <div class="modal fade" id="addReviewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
      <h2 class="modal-title" id="exampleModalLabel">Ad Review</h2>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body ps-2 pe-2">
        <div class="seller_name pb-4">

          <img src="{{url('storage/app/public/uploads/users/thumb/'.$Breeder->logo??'')}}" width="60" class="me-4" alt="No Image" />
          <strong>

            {{Str::ucfirst($Breeder->company_name ?? $Breeder->owner_name)}}
          </strong>
        </div>  
        <div class="reviews xxl text-center">

          <i class="bi bi-star-fill active  pe-1 ps-1 starrating" data-starcount="1" ></i> 
          <i class="bi bi-star-fill  pe-1 ps-1 starrating"  data-starcount="2" ></i> 
          <i class="bi bi-star-fill  pe-1 ps-1 starrating"  data-starcount="3" ></i> 
          <i class="bi bi-star-fill  pe-1 ps-1 starrating"  data-starcount="4" ></i> 
          <i class="bi bi-star-fill pe-1 ps-1 starrating"  data-starcount="5" ></i>
          <input type="hidden" name="stars" id="starCount" value="1">
        </div>
        <div class="row">
          <div class="col">
            <div class="mb-4 pt-3 ps-2 pe-2">
              <label for="opinion" class="form-label">{{__('Your opinion')}} <small class="text-success" id="message"></small></label>
              <textarea class="form-control" id="opinion" rows="6"></textarea>
            </div>
          </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-lg" data-bs-dismiss="modal">Discard</button>
        <button type="button" class="btn btn-primary btn-lg " id="submitRating">{{__('Submit')}}</button>
      </div>
    </div>
    </div>
  </div>
  @endif
@endsection
@section('optional_scripts')
@if(!$alreadyReviewed)
<script type="text/javascript">
var csrftokenval=$('meta[name="csrf-token"]').attr('content');
var responsemsg=jQuery("#message");
  jQuery("#submitRating").on('click',function(){
responsemsg.html("");
var StarCount=jQuery("#starCount").val();
var StarOpinion=jQuery("#opinion").val();

var StarForId="{{$User->id ?? '0'}}";

var jqxhr = $.ajax( {
  url: APP_URL+"/createreview",
  method:"POST",
  data:{"uid":StarForId,"stars":StarCount,"comment":StarOpinion},
  headers: { 'X-CSRF-TOKEN': csrftokenval }
  })
  .done(function(data) {
   if(data.code==201)
   {
   // console.log("success");
   responsemsg.html("Successfuly saved");
   }
   else
   {
      addStar(1);
      responsemsg.html(data.message);
   }
    
  })
  .fail(function(data) {
    addStar(1);
    responsemsg.html(data.responseJSON.message);
  
  });


  });

jQuery(".starrating").on('click',function(){
var selectedStar=jQuery(this).data('starcount');
if(selectedStar<2)
{
  selectedStar=1;
}

addStar(selectedStar);
jQuery("#starCount").val(selectedStar);

});

function addStar(sno){
  var cur=null;
$( ".starrating" ).each(function( index ) {
var selectedStar=jQuery(this).data('starcount');
var cur=jQuery(this);
if(selectedStar>1)
cur.removeClass('active');

if(selectedStar<=sno)
{
  cur.addClass('active');
}

});



}
</script>

@endif


      <script type="text/javascript">
        var APP_URL="{{url('/')}}";
      </script>
<script src="{{ asset( $publicPath . 'front_assets/js/adsaveforlater.js') }}"></script>
      @endsection