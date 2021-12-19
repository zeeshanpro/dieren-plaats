<div class="col-md-5">
    @php
    $msginfo=array();
    @endphp
                        <!-- MESSAGES LIST -->
                        <div class="messages_list">
                          
                        @if( isset( $adId ) )
<!-- MESSAGE -->
                            <div class="message active " id="{{$adId??'0'}}_{{ Auth::id() ??'0'}}" data-adid="{{$adId??'0'}}" data-lastmsgid="@if( isset($msgCount) and $msgCount > 0 ) {{$oldMsgs[ $msgCount - 1 ]->id }}@endif">
                                <div class="thumb">
                                    
                                    @if($otherPerson->Breeder->logo)
                                    <img src="{{url('/storage/app/public/uploads/users/thumb/'.$otherPerson->Breeder->logo)}}" style="border-radius:50%;height:60px;object-fit: cover;">
                                    </img>
                                    @else
                                <img src="{{url('public/front_assets/images/default.jpg')}}"  style="border-radius:50%;height:60px">
                                    </img>
                                    @endif
                                    
                                </div>
                                <div class="details">
                                    <div class="row g-0">
                                        <div class="col">
                                            <strong>
                                                
                                            {{$otherPerson->Breeder->company_name ?? $otherPerson->Breeder->owner_name}}
                                            
                                            </strong>
                                        </div>
                                        <div class="col-3 text-end">
                                            <span class="date">
                                                {{date('d/m/Y',strtotime($dateOfContact))??''}} 
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        @if( isset($msgCount) )
                                        <div class="col desc">
                                            {{Str::limit($oldMsgs[ $msgCount - 1 ]->msg, 25)}}
                                        </div>
                                        <div class="col-3 text-end">
                                            <span class="text-info" style="font-size:12px;">
                                            <i class="bi bi-circle-fill"></i>
                                            </span>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>


                        @endif

                          @foreach($result as $row)
                          @php
                          if( isset( $adId ) and $row->ad_id==$adId)
                          continue;
                          @endphp
                            <!-- MESSAGE -->
                            <div class="message" id="{{$row->ad_id??'0'}}_{{$row->user_id??'0'}}" data-adid="{{$row->ad_id??'0'}}" data-lastmsgid="{{$row->id}}">
                                <div class="thumb">
                                    @if( Auth::id() == $row->user_id )
                                    @if($row->messageAd->adUser->Breeder->logo)
                                    <img src="{{url('/storage/app/public/uploads/users/thumb/'.$row->messageAd->adUser->Breeder->logo)}}" style="border-radius:50%;height:60px;object-fit: cover;">
                                    </img>
                                    @else
                                <img src="{{url('public/front_assets/images/default.jpg')}}"  style="border-radius:50%;height:60px">
                                    </img>
                                    @endif
                                    @else

                                    @if($row->messageUser->Breeder->logo)
                                    <img src="{{url('/storage/app/public/uploads/users/thumb/'.$row->messageUser->Breeder->logo)}}" style="border-radius:50%;height:60px;object-fit: cover;">
                                    </img>
                                    @else
                                <img src="{{url('public/front_assets/images/default.jpg')}}"  style="border-radius:50%;height:60px">
                                    </img>
                                    @endif

                                    @endif
                                </div>
                                <div class="details">
                                    <div class="row g-0">
                                        <div class="col">
                                            <strong>
                                                 @if( Auth::id() == $row->user_id )
                                            {{$row->messageAd->adUser->Breeder->company_name??$row->messageAd->adUser->Breeder->owner_name}}
                                            @else
                                            {{$row->messageUser->Breeder->company_name??$row->messageUser->Breeder->owner_name}}

                                            @endif
                                            </strong>
                                        </div>
                                        <div class="col-3 text-end">
                                            <span class="date">
                                                {{$row->created_at->format('d/m/Y')}}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col desc">
                                            {{Str::limit($row->msg, 25)}}
                                        </div>
                            @if( ( (Auth::id() == $row->user_id and  $row->ifsent == 0 ) or 
                            ( in_array($row->ad_id,$myAds) and $row->ifsent == 1 ) ) and 
                            $row->isread == 0)
                                        <div class="col-3 text-end newMsgCircle"  data-gs="{{$row->ad_id}}">
                                            <span class="text-info" style="font-size:12px;">

                                            <i class="bi bi-circle-fill"></i>
                                            </span>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <input type="hidden"  value="0" id="lastmsgid">
                            

                        </div>
                    </div>
