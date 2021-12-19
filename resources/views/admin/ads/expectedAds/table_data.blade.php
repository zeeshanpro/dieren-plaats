 <tbody>
                    @if($result->count()<1)
        <tr>
             <td colspan="8">

           <h2 class="text-success text-center">No Record Available</h2>
           </td>
       </tr>
           @endif
           <?php //print_r($result); ?>
                    @foreach($result as $row)

                       <tr>
                      <td><a href="{{url('/admin/expectedad_detail/'.$row->id)}}" >{{$row->id}}</a></td>
                      <td>
                        {{$row->expected_babieUser->name }}
                        
                      </td> 
                      <td>
                        <a href="{{url('/admin/expectedad_detail/'.$row->id)}}" >
                        <div class="containerImage mr-1">
                         <img src="{{ url('storage/app/public/uploads/expectedbabies/thumb/'.$row->father_pic) }}" class="image" alt="no image">
                         <span class="overlayImage">
                             {{$row->father }}
                         </span>   
                        </div>
                         <div class="containerImage">
                         <img src="{{ url('storage/app/public/uploads/expectedbabies/thumb/'.$row->mother_pic) }}" class="image" alt="no image">
                         <span class="overlayImage">
                            {{$row->mother}}
                         </span>   
                        </div>
                        </a>
                      </td>

                      <td class=" text-center">  {{$row->expected_babieKind->title }} </td>
                      <td>{{$row->expected_at}}</td>
  
                    <td>4</td>
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