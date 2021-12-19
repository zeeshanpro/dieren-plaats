 <tbody>
                    @if($result->count()<1)
           <tr>
             <td colspan="8">

           <h2 class="text-success text-center">No Record Available</h2>
           </td></tr>
           @endif
           <?php //print_r($result); ?>
                    @foreach($result as $row)
                        <tr>
                      <td><a href="{{url('/admin/adsdetail/'.$row->id)}}" >{{$row->id}}</a></td>
                      <td>
                        @if($row->adImages->count())
                        <a href="{{url('/admin/adsdetail/'.$row->id)}}" ><img src="{{ url('storage/app/public/uploads/ads/thumb/'.$row->adImages[0]->filename) }}" class="imageStyle" alt="None" style="width: 50px;height:50px;">
                        </a>
                        @else
                        No Image
                        @endif
                      </td>
                      <td>
                        <a class="btn btn-app" href="{{url('/admin/adsdetail/'.$row->id)}}">
                             <!-- <span class="badge bg-purple">Paid</span> -->
                           {{$row->title}}
                        </a>
                      </td>
                        <td>
                        {{$row->amount}}
                      </td>
                      <td class=" text-center"> {{$row->adKind->title}} </td>
                      <td>{{$row->adRace->title}}</td>
                      <td>
                        <!-- <img src="https://images-platform.99static.com/Zu1w4iNqj1REDpN60JWbG-wWEZM=/200x100:1000x900/500x500/top/smart/99designs-contests-attachments/66/66198/attachment_66198853" class="rounded" alt="User Image" style="width: 50px;height:50px;"> -->{{$row->adUser->name }}
                      </td>
                    <td>{{$row->adUser->usertype }}</td>
                    <td>
                         <div class="btn-group">
                        <button type="button" class="btn btn-danger deletead" data-aid="{{$row->id}}">
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