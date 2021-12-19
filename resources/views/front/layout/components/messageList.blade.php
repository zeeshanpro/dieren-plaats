<section id="messageRightSection" style="display:contents">
    <x-loader>
    </x-loader>
    <div class="col-md-7">
        <div class="message_window mb-3">
            <div class="window_header pb-3">
                <div class="thumb">
                    @if($otherPerson->Breeder->logo)
                    <img alt="No Image" src="{{url('/storage/app/public/uploads/users/thumb/'.$otherPerson->Breeder->logo)}}" style="border-radius:50%;height:60px">
                    </img>
                    @else
                    <img src="{{url('public/front_assets/images/default.jpg')}}" style="border-radius:50%;height:60px">
                    </img>
                    @endif
                </div>
                <div class="details">
                    <div class="row g-0">
                        <div class="col">
                            <strong>
                                {{$otherPerson->Breeder->company_name??$otherPerson->Breeder->owner_name}}
                            </strong>
                        </div>
                        <div class="col-4 text-end">
                            <div class="actions">
                                <a href="#">
                                    <i class="bi bi-slash-circle">
                                    </i>
                                </a>
                                <a href="#">
                                    <i class="bi bi-trash-fill">
                                    </i>
                                </a>
                                <a href="#">
                                    <i class="bi bi-archive-fill">
                                    </i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col desc">
                            <span class="date">
                                {{__('Member since')}}: {{$otherPerson->Breeder->created_at->format('d/m/Y')}}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <!--  <a class="text-grey ms-2" href="#">
                                <small>
                                    Review the seller
                                </small>
                            </a> -->
            <div class="text-center text-grey">
                <!--  Today - 9:00 AM -->
            </div>
            <div class="screen" id="screenMsg">
                <span class="text-grey ms-2">
                    <small>
                        Ad
                    </small>
                </span>
                <div class="order">
                    @if(isset($adDetail['adImages'][0]->filename) and $adDetail['adImages'][0]->filename)
                    <img src="{{url('storage/app/public/uploads/ads/thumb/'.$adDetail['adImages'][0]->filename)}}">
                        @else
                        <img src="{{url('public/front_assets/images/default.jpg')}}">
                            @endif
                            <div class="desc">
                                <span class="date">
                                    {{$adDetail->created_at->format('M d, Y')}}
                                </span>
                                <h6>
                                    {{$adDetail->title??''}}
                                </h6>
                                <div class="price">
                                    €{{$adDetail->amount??''}}
                                </div>
                            </div>
                        </img>
                    </img>
                </div>
                <script>
                    var lastMsgId = 0;
                    var usertype = "@php echo $usertype; @endphp";
                </script>
                @if( isset( $oldMsgs ) and $MsgCount > 0 )
                @php 
                    $result = $oldMsgs;
                @endphp
                @endif

                @forelse($result as $msgRow)
                <script>
                    lastMsgId = {{$msgRow->id}};
                </script>
                @php
                                    if(($usertype=="Seller" and $msgRow->ifsent==0)
                                    or ($usertype=="Buyer" and $msgRow->ifsent==1))
                                    {

                                      $positionClass="received"; //here received is actually sent only css class is acting reverse
                                    }
                                    else
                                    {
                                        $positionClass="sent";  //here sent is actually received only css class is acting reverse
                                    }
                                    @endphp
                <div class="{{$positionClass}}">
                    <div class="text">
                        {{$msgRow->msg}}
                    </div>
                </div>
                @empty
                @if(!isset($adId))
                <h3 class="rounded w-75 border">
                    No {{__('Messages')}}
                </h3>
                @endif
                @endforelse

                <script>
                    var element = document.getElementById("{{$adId}}_{{$user_id}}"); 
                                    element.setAttribute("data-lastmsgid", lastMsgId);
                </script>

                <input id="base_container" type="hidden" value="{{$adId}}_{{$user_id}}"/> 
                <!-- 
                                  <div class="sent1 mx-3">
                                    <div id="wave1">
                                        <span class="dot">
                                        </span>
                                        <span class="dot">
                                        </span>
                                        <span class="dot">
                                        </span>
                                    </div>
                                </div> -->
            </div>
            <div class="reply">
                <div class="row g-0">
                    <div class="col-11">
                        <textarea class="form-control" id="msgInputArea"></textarea>
                    </div>
                    <div class="col-1 text-end">
                        <button data-adid="{{$adId??'0'}}" data-lastmsgid="{{$lastMsgId??'0'}}" id="sendMessage">
                            <img src="{{asset('front_assets/images/reply-btn.gif')}}"/>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var elementBtn = document.getElementById("sendMessage"); 
            elementBtn.setAttribute("data-lastmsgid", lastMsgId);
    </script> 
</section>
