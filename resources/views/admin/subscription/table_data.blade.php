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
                      <td><a href="javascript:void(0)"  data-toggle="modal" data-target="#modal-xl-details" data-uname="{{$row->user->name}}" 
                        data-stripe_id="{{$row->user->stripe_id}}" data-payment_intent="{{$row->paymentDetails->payment_intent}}" data-payment_method="{{$row->paymentDetails->payment_method}}" data-payment_method_type="{{$row->paymentDetails->payment_method_type}}" data-fingerprint="{{$row->paymentDetails->fingerprint}}" data-mandate="{{$row->paymentDetails->mandate}}" data-subscription="{{$row->paymentDetails->subscription}}" data-subscription_item="{{$row->paymentDetails->subscription_item}}" 
                        >{{$row->id}}</a> </td>
                      <td class="text-center"><a href="/admin/view_user/{{$row->user->id}}">{{$row->user->name}}</a><a href="javascript:void(0)"  data-toggle="modal" data-target="#modal-xl-details" data-uname="{{$row->user->name}}" 
                        data-stripe_id="{{$row->paymentDetails->stripe_id}}" data-payment_intent="{{$row->paymentDetails->payment_intent}}" data-payment_method="{{$row->paymentDetails->payment_method}}" data-payment_method_type="{{$row->paymentDetails->payment_method_type}}" data-fingerprint="{{$row->paymentDetails->fingerprint}}" data-mandate="{{$row->paymentDetails->mandate}}" data-subscription="{{$row->paymentDetails->subscription}}" data-subscription_item="{{$row->paymentDetails->subscription_item}}" 
                        >
                        <small class="d-block text-primary">( {{$row->user->stripe_id}} )</small>
                      </a>
                      </td>
                      <td class=" text-center">{{$row->user->usertype}} </td>
                      <td><small>{{$row->user->stripe_product_id??'No Id'}}</small></td>
                      <td>{{$row->paymentDetails->payment_method_type}}</td>
                    <td>{{$row->date_of_transaction}}</td>
                    <td>{{$row->renewal_date}}</td>
                    <td>
                        <div class="btn-group">
                        <a href="{{$row->paymentDetails->hosted_invoice_url??'#'}}" class="btn btn-success" target="_blank">
                          <i class="fas fa-file-pdf"></i>
                        </a>
                        

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