 <div class="direct-chat-messages">
                      <!-- Message. Default to the left Buyer -->
                      @forelse($result as $row)
                      @if($row->ifsent==1)
                      <div class="direct-chat-msg">
                        <div class="direct-chat-infos clearfix">
                          <span class="direct-chat-name float-left">{{$row->messageUser->name??'None'}}</span>
                          <span class="direct-chat-timestamp float-right">{{$row->created_at->format('d M h:i A')}}</span>
                        </div>
                        <!-- /.direct-chat-infos -->
                         @if($row->messageUser->Breeder->logo)
                <img class="direct-chat-img" src="{{url('storage/app/public/uploads/users/thumb/'.$row->messageUser->Breeder->logo) }}" alt="None" style="height:40px;">
                @else
                <img class="direct-chat-img" src="{{asset('/admin_assets/dist/img/default-150x150.png') }}" alt="{{$member->name??'None'}}" alt="Default Image">
                @endif
                        
                        <!-- /.direct-chat-img -->
                        <div class="direct-chat-text">
                         {{$row->msg??'-'}}
                        </div>
                        <!-- /.direct-chat-text -->
                      </div>
                      <!-- /.direct-chat-msg -->

                      @else

                      <!-- Message to the right Seller -->
                      <div class="direct-chat-msg right">
                        <div class="direct-chat-infos clearfix">
                          <span class="direct-chat-name float-right">{{$row->messageAd->adUser->name??'None'}}</span>
                          <span class="direct-chat-timestamp float-left">{{$row->created_at->format('d M h:i A')}}</span>
                        </div>
                        <!-- /.direct-chat-infos -->
                        @if($row->messageUser->Breeder->logo)
                        <img class="direct-chat-img" src="{{url('storage/app/public/uploads/users/thumb/'.$row->messageAd->adUser->Breeder->logo) }}" alt="None" style="height:40px;">
                        @else
                        <img class="direct-chat-img" src="{{asset('/admin_assets/dist/img/default-150x150.png') }}" alt="{{$member->name??'None'}}" alt="Default Image">
                        @endif
                
                        <!-- /.direct-chat-img -->
                        <div class="direct-chat-text">
                           {{$row->msg??'-'}}
                        </div>
                        <!-- /.direct-chat-text -->
                      </div>
                      <!-- /.direct-chat-msg -->
                      @endif
                        @empty 
                        @endforelse
                   


                    </div>
                    <!--/.direct-chat-messages-->