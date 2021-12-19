<?php $publicPath = env('ASSETS_PATH'); ?>
<div class="{{isset($cellColumn) ? 'col-11 ':'col-12 '}} col-md-5 col-lg-{{$cellColumn ?? '3'}} mb-md-3 p-0 px-md-2">
                <!-- IMAGE BOX -->
                <div class="image_box" style=" min-height: 440px;">
                     <div class="row p-0">
        <div class="col-5 col-md-12 align-self-center ">
                    <a href="{{url('ad/'.$row->adKind->title_slug.'/'.$row->title_slug)}}">@if(isset( $row->adImages ))
                    <?php if( count( $row->adImages ) > 0 and file_exists( 'storage/app/public/uploads/ads/thumb/'.$row->adImages[0]->filename ) ) {?>
                        <img src="{{ url('storage/app/public/uploads/ads/thumb/'. $row->adImages[0]->filename) }}" onerror="this.onerror=null;this.src='{{ asset( 'front_assets/images/noimage.jpg' ) }}';" >
                    <?php } else { ?>
                        <img src="{{ asset( 'front_assets/images/noimage.jpg' ) }}" >
                    <?php } ?>    
                        @endif
                    </a>
                    <?php if( isset( $topAdsArray ) and in_array(  $row->id , $topAdsArray ) ) {?>
                                        <span class="top_ad">Top Ad</span><?php } ?>
                    @php 
                    if( isset( $row->adUser->usertype ) and $row->adUser->usertype != 'Normal' )
                    { @endphp
                        <span class="bottom_ad_breeder">{{$row->adUser->usertype}}</span>
                        @php 
                    }
                        @endphp


       </div>

       <div class="col-7 col-md-12 px-0 px-md-2">
                    <div class="info">
                       
                       
                        @if(request()->routeIs('showMyAds'))
                        <span class="place_on_img"> 

                            <label class="switch">
                              <input type="checkbox" {{$row->status?'checked':''}} class="isAdPublished" data-id="{{$row->id}}">
                              <span class="slider round"></span>
                            </label>
                        </span>
                        @endif
                        <div class="row">
                            <div class="col-8 col-md-8">
                                <div class="date">
                                <?php echo  date('M d, Y', strtotime( $row->created_at ) ); ?> 
                                </div>
                                <div class="name">
                            <a title="{{$row->title}}" href="{{url('ad/'.$row->adKind->title_slug.'/'.$row->title_slug)}}">{{ Str::limit($row->title,35) ?? '' }}</a>
                                </div>
                                <div class="price">
                                    <a href="{{url('ad/'.$row->adKind->title_slug.'/'.$row->title_slug)}}">€ {{ $row->amount  ?? '-' }}</a>
                                </div>
                            </div>
                            
                            <div class="col-4 col-md-4 text-start text-md-end">
                                @if( isset( $myad ) and $myad == 1)
                                 <a href="{{route('showAdUpdateForm', ['adId'=>$row->id])}}">
                                    <i class="bi bi-pencil-square mx-1"> </i>
                                </a>
                                @endif
                              <a href="javascript:void(0);" class="save_me act_saveme {{($ifWatchLater?'active': '')}}" data-id="{{$row->id}}"><i class="bi bi-heart"></i><i class="bi bi-heart-fill"></i></a>
                                <div class="views">
                                    <img src="{{ asset( $publicPath . 'front_assets/images/show-icon.svg') }}" > {{ $row->ad_views_count  ?? '0' }}
                                </div>
                            </div>
                            <div class="col col-md-12">
                            @php
                                $counter = 0;
                            @endphp
                            @foreach ($row->adSelectedAttributes as $attributeAndOptions)
                                        <div class="feature_list">
                                        <img src="{{ asset( $publicPath . 'front_assets/images/paw-red.svg') }}" />
                                        @php
                                            if( isset( $row->adSelectedAttributes ) ){ @endphp
                                                {{ $row->adSelectedAttributes[$counter]->ad_selected_attributeAd_attribute_option->ad_attribute_optionAd_attribute->title }} :
                                        {{ $row->adSelectedAttributes[$counter]->ad_selected_attributeAd_attribute_option->title }}
                                        @php    }
                                        @endphp 
                                        </div>
                                        @php $counter++;  
                                        if( $counter == 2 ){
                                            break;
                                        }
                                        @endphp   
                            @endforeach
                            </div>
                        </div>
                  {{--       <div class="row justify-content-end mt-2">
                      <div class="col-6 ">
                                  <label class="switch">
                              <input type="checkbox" checked>
                              <span class="slider round"></span>
                            </label>
                          </div>
                        </div> --}}
                    </div> 

       </div> 
   </div>
   {{-- end row --}}
                </div>
            </div>