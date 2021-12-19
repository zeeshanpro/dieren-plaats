 <tbody>
                  @if($result->count()<1)
           <tr>
             <td colspan="4">

           <h2 class="text-success text-center">No Record Available</h2>
           </td></tr>
           @endif
                   @foreach($result as $row)
                      @foreach ( $row->kindAdAttributes as $attributes )
                      <tr>
                      <td>{{$attributes->id}}</td>
                      <td>
                        {{$row->title}}
                      </td>
                      <td>
                        <div class="input-group input-group-sm" >
                          <input type="text" class="form-control text-info" value="{{$attributes->title}}" id="attributeTitleValue-{{$attributes->id}}">
                          <div class="input-group-append">
                            <button class="btn btn-outline-info btn-block"><i class="fas fa-edit  fa-lg editAttribute" data-attributeid="{{$attributes->id}}" ></i></button>
                          </div>
                          <div class="input-group-append">
                            <button class="btn btn-outline-danger btn-block "><i class="fas fa-times  fa-lg deleteAttribute" data-attributeid="{{$attributes->id}}"></i></button>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="row justify-content-start">
                    {{-- @foreach($row->ad_attributeAdAttributeOptions as $attr_option) --}}
                          @foreach ( $attributes->ad_attributeAdAttributeOptions as $options )
                          <div class="col-4 mb-2">
                          <div class="input-group input-group-sm" >
                            <input type="text" class="form-control" value="{{$options->title}}" id="optionTitleValue-{{$options->id}}">
                            <div class="input-group-append updateAttributeOptions" data-attributeid="{{$attributes->id}}" data-optionid="{{$options->id}}" >
                              <button class="btn btn-outline-info btn-block"><i class="fas fa-pen-square fa-lg"   ></i></button>
                            </div>
                            <div class="input-group-append deleteAttributeOptions"  data-attributeid="{{$attributes->id}}" data-optionid="{{$options->id}}" >
                                <button class="btn btn-outline-danger btn-block"><i class="fas fa-times  fa-lg " ></i></button>
                            </div>
                        </div>
                      
                      </div>
                        @endforeach 
                
                    </div><!-- End row -->

              </td>
                <td style="vertical-align: middle;text-align: center;">
                  <div class="row">
                    
                  
                   <div class="col-12 mb-2">
                  <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#modal-add-option" data-attributeid="{{$attributes->id}}" data-attributetitle="{{$attributes->title}}">
                  + Add New
                </button>
                </div>
                  </div>
                  <!-- end row -->
                </td>
                    </tr> 

                          
                      @endforeach
                    
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