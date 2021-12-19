<div class="col-md-5 col-lg-{{$cellColumn ?? '3'}}">
                <!-- IMAGE BOX -->
                <!-- IMAGE BOX -->
            <div class="float_icon" style="margin-left: -80px; margin-top: -30px;">
                        <img src="{{ asset( $publicPath . 'front_assets/images/pawprint.svg') }}"/>
                    </div>
                <div class="image_box type_2">
                  <a href="javascript:void(0);"><img src="{{ url( 'storage/app/public/uploads/expectedbabies/thumb/'.$row->father_pic??$row->mother_pic) }}"></a>
                  <div class="info">
                      <div class="row g-0">
                          <div class="col-md-12">
                            <div class="name">
                              <img src="{{ url( 'storage/app/public/uploads/users/thumb/'.$row->expected_babieUser->Breeder->logo??'') }}" alt="No Image" style="width: 35px;height: 35px;border-radius: 100px;object-fit: cover;" /> <a href="javascript:void(0);">{{ $row->expected_babieUser->name ?? '' }}</a>
                            </div>
                          </div>
                          <div class="col col-md-6">
                              <ul class="detail_list">
                                  <li><label>Kind</label> {{ $row->expected_babieKind->title ?? '' }}</li>
                                  <li><label>Father</label> {{ $row->father ?? '' }}</li>
                                  <li><label>Mother</label> {{ $row->mother ?? '' }}</li>
                              </ul>
                          </div>
                          <div class="col col-md-6">
                            <ul class="detail_list">
                              <li><label>Race</label> {{ $row->expected_babieRace->title ?? '' }}</li>
                              <li><label>Listed</label> 6</li>
                              <li><label>D.E</label> {{ date('d/m/Y', strtotime($row->expected_at)); }}</li>
                          </ul>
                          </div>
                          <div class="col-md-12 text-center">
                            @php
                                        $isSubscribed=in_array($row->id,$subscribedBabies);
                                    @endphp
                              <a href="javascript:void(0);" class="btn {{$isSubscribed?'btn-primary':'btn-success'}} btn-lg subscribeBtn"  data-id="{{$row->id}}">
                                 @if(in_array($row->id,$subscribedBabies)) 
                                    Subscribed 
                                    @else 
                                    {{__('Subscribe')}}
                                    @endif
                                  </a>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
