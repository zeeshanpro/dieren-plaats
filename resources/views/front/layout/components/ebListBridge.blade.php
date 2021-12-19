<section style="display:contents;" id="ebDataContainer">
                    <div class="row">
                    <div class="col">
                      <div class="table_type_box_header">
                        <div class="row top_panel text-grey">
                            <div class="col  d-none d-lg-block">
                            {{__('Breeder')}}
                            </div>
                            <div class="col">
                                Parent
                            </div>
                            <div class="col  d-none d-lg-block">
                            {{__('kind')}}
                            </div>
                            <div class="col  d-none d-lg-block">
                            {{__('Race')}}
                            </div>
                            <div class="col">
                                Coming {{__('Date')}}
                            </div>
                            <div class="col d-none d-lg-block">
                                {{__('Father')}}
                            </div>
                            <div class="col d-none d-lg-block">
                            {{__('Mother')}}
                            </div>
                            <div class="col">
                                {{__('Waiting list')}}
                            </div>
                            <div class="col-2">
                            </div>
                        </div>
                    </div>
                        @forelse($expectedBabies as $erow)
                        <!-- TABLE TYPE BOX -->
                        <div class="table_type_box">
                            <div class="row top_panel">
                                <div class="col-3  d-none d-lg-block">
                                    <div class="seller_name">
                                        <img src="{{url('storage/app/public/uploads/users/thumb/'.$erow->expected_babieUser->Breeder->logo)}}">   
                                        <div class="info">
                                            <div class="name">
                                              <a href="{{url('profile/'.$erow->expected_babieUser->id.'/'.Str::slug($erow->expected_babieUser->Breeder->company_name??$erow->expected_babieUser->name))}}">{{$erow->expected_babieUser->Breeder->company_name??$erow->expected_babieUser->name}}</a>
                                            </div>
                                            <div class="reviews">
@include( 'front.layout.components.stars',['stars'=> $erow->expected_babieUser->Breeder->avgRating[0]->aggregate?? '0' ] )
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <img src="{{url('storage/app/public/uploads/expectedbabies/thumb/'.$erow->father_pic)}}" class="me-2">
                                </div>
                                <div class="col  d-none d-lg-block">
                                 {{$erow->expected_babieKind->title??'None'}}
                                </div>
                                <div class="col  d-none d-lg-block">
                                    {{$erow->expected_babieRace->title??'None'}}
                                </div>
                                <div class="col">
                                    {{date('d/M/Y',strtotime($erow->expected_at))??'None'}}
                                </div>
                                <div class="col  d-none d-lg-block">
                                    {{$erow->father??'None'}}
                                </div>
                                <div class="col  d-none d-lg-block">
                                     {{$erow->mother??'None'}}
                                </div>
                                <div class="col">
                                    {{$erow->expected_babie_expected_babies_subscribe_count??'0'}}
                                </div>
                                <div class="col-2 last" style="margin-right:45px">
                                    @php
                                        $isSubscribed=in_array($erow->id,$subscribedBabies);
                                    @endphp
                                  <a href="javascript:void(0);" class="btn btn-sm {{$isSubscribed?'btn-primary':'btn-success'}} subscribeBtn px-3 px-lg-4" data-id="{{$erow->id}}" >
                                    @if($isSubscribed)
                                    Subscribed
                                    @else
                                    {{__('Subscribe')}}
                                    @endif
                                  </a>
                                    <a class="accordion-button collapsed view_breeder_info bg-white"></a>
                                </div>
                            
                            

                          </div>

                          <div class="bottom_panel hide">
                              <div class="row">
                                  <div class="col">
                                      <div class="feature_list">
                                          <strong>{{__('Breeder')}} Info</strong>
                                      </div>
                                      <div class="feature_list">
                                        <img src="{{asset('front_assets/images/paw-grey.svg')}}" class="me-2"> {{$erow->expected_babieUser->Breeder->breederKind->breeder_kindKind->title??''}}
                                      </div>
                                      <div class="feature_list">
                                          <i class="bi bi-geo-alt-fill pe-2"></i>{{$erow->expected_babieUser->Breeder->street??'-'}}, {{$erow->expected_babieUser->Breeder->city??''}}
                                      </div>
                                      <?php 
                                      if( $erow->expected_babieUser->Breeder->website != '' ){ 
                                          if( substr( $erow->expected_babieUser->Breeder->website, 0, 7 ) == 'http://' or substr( $erow->expected_babieUser->Breeder->website, 0, 8 ) == 'https://' )
                                            $url = $erow->expected_babieUser->Breeder->website;
                                          else
                                            $url = 'http://'.$erow->expected_babieUser->Breeder->website;
                                          ?>
                                      <div class="feature_list">
                                        <i class="bi bi-link-45deg pe-2"></i><a target="_blank" href="{{$url}}">{{$erow->expected_babieUser->Breeder->website}}</a>
                                      </div>
                                      <?php } ?>
                                      @isset($erow->expected_babieUser->Breeder->phone)
                                        <div class="feature_list">
                                            <i class="bi bi-telephone-fill pe-2"></i> {{$erow->expected_babieUser->Breeder->phone}}
                                        </div>
                                      @endisset
                                  </div>
                                </div>
                            </div>

                            </div>
                           
                       
                        <!-- TABLE TYPE BOX END -->
                         @empty
                      <h3 class="border rounded p-4 m-2">Nee {{__('Expected Babies')}} </h3>
                        @endforelse
                 </div>
                      
                    </div>
                </div>

                 <!-- CONTENT BOTTOM PANEL-->
              <div class="row mt-4 mb-4">
                  <div class="col-auto me-auto">
                       {{ $expectedBabies->links('pagination::bootstrap-4') }}
                  </div>
                  <div class="col-auto">
                    
                  </div>
              </div>
</section>