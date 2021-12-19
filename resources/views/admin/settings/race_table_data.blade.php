 <tbody>
                  @if($result->count()<1)
           <tr>
             <td colspan="4">

           <h2 class="text-success text-center">No Record Available</h2>
           </td></tr>
           @endif
                   @foreach($result as $row)
                    <tr>
                      <td>{{$row->id}}</td>
                      <td>
                        {{$row->title}}
                      </td>
                      <td>
                        {{$row->kind->title}}
                      </td>
                      <td>
                   {{$row->race_ads_count}}
                      </td>
                       <td>
                         {{$row->race_expected_babies_count}}
                       </td>
                       <td>
                         <div class="btn-group">
                        <button type="button" class="btn btn-success"  data-toggle="modal" data-target="#modal-edit-race" data-raceid="{{$row->id}}" data-racetitle="{{$row->title}}" data-kindid="{{$row->kind->id}}">
                          <i class="fas fa-edit"></i>
                        </button>
                        <button type="button" class="btn btn-danger deleteRace" data-raceid="{{$row->id}}">
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