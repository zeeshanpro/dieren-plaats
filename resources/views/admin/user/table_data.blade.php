 <tbody>
                    @if($result->count()<1)
           <tr>

             <td colspan="6">
           <h2 class="text-success text-center">No Record Available</h2>
           </td></tr>
           @endif
           <?php  $substatus="-"; ?>
                    @foreach($result as $row)
                    @if( $row->usertype!="Normal" && $row->latestRenewal)
                    @if(strtotime(date('Y-m-d')) <= strtotime($row->latestRenewal->renewal_date))
                        @php
                        $substatus="Active";
                        @endphp
                    @endif
                    @else
                    @if( $row->usertype=="Normal" )
                    @php
                     $substatus="-";
                    @endphp
                    @else
                    @php
                    $substatus="In-Active";
                    @endphp
                    @endif
                    @endif
                    <tr>
                        <td colspan="7">

            {{-- @dd($result) --}}
        </td>
                    </tr>
                    <tr>
                      <td><a href="/admin/view_user/{{$row->id}}">{{$row->id}}</a> </td>
                      <td><a href="/admin/view_user/{{$row->id}}">{{$row->name??'No Name'}}</a> </td>
                      <td class=" text-center">{{$row->usertype}} </td>
                      <td>
                        @if($substatus!="-")
                        <span class="badge bg-{{$substatus=="Active"?'success':'danger'}}">{{$substatus}}</span>
                        @else
                        {{$substatus}}
                        @endif
                    </td>
                      <td>{{$row->user_ads_count}}</td>
                    <td>{{$row->user_expected_babies_count}}</td>
                      <td>
                         <div class="btn-group">
                        <button type="button" class="btn btn-danger deleteuser" data-uid="{{$row->id}}">
                          <i class="fas fa-times"></i>
                        </button>
                        
                      </div>
                       </td>
                    </tr>
                   @endforeach
                 
                  <tr>
             <td colspan="8">
            <!-- /.card-body -->
               <div class="card-footer">
                @if($result instanceof \Illuminate\Pagination\LengthAwarePaginator )
                    {!! $result->links('pagination::bootstrap-4') !!}      
               @endif
            </div>
       <!-- /.card-footer-->
           </td></tr>
               
              </tbody>