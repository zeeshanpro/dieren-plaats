 <tbody>
                  @if($result->count()<1)
           <tr>
             <td colspan="3">

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
                   {{$row->kind_ads_count}}
                      </td>
                       

                        <td>
                          {{$row->kind_breeder_kinds_count}}
                        </td>
                        <td>
                          {{$row->kind_expected_babies_count}}
                        </td>
                           <td>
                         <div class="btn-group">
                        <button type="button" class="btn btn-success"  data-toggle="modal" data-target="#modal-edit-kind" data-kindid="{{$row->id}}" data-kindtitle="{{$row->title}}" data-currimage="{{$row->image}}" data-curriconimage="{{$row->icon}}">
                          <i class="fas fa-edit"></i>
                        </button>
                        <button type="button" class="btn btn-danger deleteKind" data-kindid="{{$row->id}}">
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