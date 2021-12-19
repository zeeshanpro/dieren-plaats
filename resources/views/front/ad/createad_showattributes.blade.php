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
          <form method="post" action="{{route('saveAttributesOptions')}}">
            @csrf
          <input type="hidden" name="adId" value="{{$adData->id}}" />  
          <div class="row pt-3">
              <!-- RIGHT MAIN PANEL -->
              <div class="col-md-9">
                <div class="row">
                    <div class="col pb-5">
                        <div class="shadow_box my_profile_section">
                          <div class="page-header">
                            <div class="row">
                                <div class="col">
                                    <h2>More details</h2>
                                </div>
                                <div class="col text-end text-grey">
                                {{__('Step')}}: 3/4
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col pt-4">
                              <div class="add_more_details pb-5">
                              @inject( "attributesMaster" , 'App\Repositories\Front\AttributesAndOptionsRepository' )
                                @php
                                    $attributesResults = $attributesMaster->list( $adData->kind_id );
                                @endphp
                                @foreach ( $attributesResults['result'] as $row)
                                    <div class="pb-3 pt-4">
                                      <label>{{ $row->title }}</label>
                                    </div> 
                                    
                                      @foreach ( $row->ad_attributeAdAttributeOptions as $options)
                                          <div class="form-check form-check-inline me-5">
                                            <input class="form-check-input me-3" type="checkbox" <?php if( in_array( $options->id , $selectedAttributes ) ) echo 'checked'; ?> name="options[]" id="option{{ $options->id }}" value="{{ $options->id }}" />
                                            <label class="form-check-label" for="option{{ $options->id }}">{{ $options->title }}</label>
                                          </div>
                                      @endforeach
                                @endforeach
                              </div>
                            </div>
                          </div>

                        </div>
                    </div>
                </div>
                
              </div>

              <div class="col-md-3 left_sidebar">
                <div class="image_box type_3 mb-4">
                  <div class="info">
                      <div class="row">
                        <div class="col">
                            <div class="button_block">
                                <div class="d-grid gap-2">
                                  <input type="submit" class="btn btn-primary btn-lg" name="publish" value="Preview" />
                                  <a href="{{ route('showAdUpdateForm', [ 'adId' => $adData->id ] ) }}" class="btn btn-info btn-lg">{{__('Back')}}</a>
                                  <a href="{{ route('showMyAds') }}" class="btn btn-lg">{{__('Save as draft')}}</a>
                                </div>  
                            </div>
                            <div class="row">
                              <div class="col">
                                <div class="form-check border-top-grey pt-4 mt-2">
                                  <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                  <label class="form-check-label" for="flexCheckChecked">
                                  {{__("Promote your ad as 'top ad' for only €1 (7days).")}}  <a href="#" class="grey">Read more</a>
                                  </label>
                                </div>
                            </div>
                        </div>
                      </div>
                  </div>  
                </div>
              </div>
              <div class="image_box">
                <a href="#"><img src="{{ url('storage/app/public/uploads/ads/'.$adData->adImages[0]->filename) }}"></a>
                <div class="info">
                    <div class="row">
                        <div class="col">
                            <div class="date">
                                <?php echo date('M d, Y', strtotime( $adData['created_at'] ) ); ?>
                            </div>
                            <div class="name">
                                <a href="#">{{$adData->title}}</a>
                            </div>
                            <div class="price">
                                <a href="#">€ {{$adData->amount}}</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col col-md-6">
                        <ul class="detail_list">
                            <li><label>{{__('kind')}}</label> {{$adData->adKind->title}}</li>
                        </ul>
                      </div>
                      <div class="col col-md-6">
                        <ul class="detail_list">
                            <li><label>{{__('Rase')}}</label> {{$adData->adRace->title}}</li>
                        </ul>
                      </div>
                    </div>
                </div>  
            </div>
              
          </div>
          </form>
      </div>
  </div> 
@endsection