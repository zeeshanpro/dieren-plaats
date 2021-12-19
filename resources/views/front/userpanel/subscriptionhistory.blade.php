@extends('front/layout/layout')
<?php $publicPath = env('ASSETS_PATH'); ?>
  @section('optional_css')
      <meta name="csrf-token" content="{{ csrf_token() }}" />
      <link href="{{ asset( $publicPath . 'front_assets/css/register.css') }}" rel="stylesheet">
      <style type="text/css">
          .modal-dialog
          {
            max-width: 450px;
          }
      </style>
  @endsection
@section('container')
@inject('subHistory','App\Repositories\Front\UserRepository' )
@php

$allSubscriptions=$subHistory->getAllSubscriptions();
@endphp
<div class="inner_page_content_area">
      <div class="container">
          <div class="row pt-3">
              <div class="col-md-2 left_sidebar">
                    @include('front.userpanel.sideMenu')
              </div>
              <!-- RIGHT MAIN PANEL -->
              <div class="col-md-9">
                <div class="row">

                    <div class="col pb-5">
                        <div class="shadow_box my_profile_section">
                          <div class="page-header">
                            <div class="row">
                                <div class="col">
                                    <h2>Account Type</h2>
                                </div>
                            </div>
                          </div>  
                          <x-notification/>
                          <div class="row">
                            <div class="col-12 pt-3">
                            	<div class="row">
                               <div class="col-12">
                               	
                               			<div class="xxl h5 pt-2 fw-bold">Current Account Type</div>
                               
                               		<div class="xxl fs-5  text-muted">
                               		{{$usertype??'Un-known'}}
                               	</div>

                               	<a href="#" class="btn btn-outline-danger mt-2"  data-bs-toggle="modal" data-bs-target="#changeAccountTypeModal">Change Account Type</a>
                               	<hr style="width: 35%; height: 2px; color: #D8D8D8;" /> 

                               	<div class="xxl h5 pt-2 fw-bold">Membership Fee
                               			</div>
                               
                               		<div class="xxl fs-5  text-muted">
                               		{{$pricing??'0.00'}}
                               	</div>
                               	<hr style="width: 35%; height: 2px; color: #D8D8D8;" /> 

                               	<div class="xxl h5 pt-2 fw-bold">{{__('Next Renewal')}}
                               			</div>
                               
                               		<div class="xxl fs-5  text-muted">
                               		
                        
				                      {{$renewal_date??'-'}}
				                    
                               	</div>
                               	<hr style="width: 35%; height: 2px; color: #D8D8D8;" /> 



                               </div>
                                </div>
                                <div class="mb-3 pt-2">
                                 


						{{-- Subscription History code starts here --}}

                <div class=" xxl text-center h4 py-2 underlineNormal mb-4">
                {{__('Renewal History')}}
                </div>
                <div class="row">
                    <div class="col">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col" title="Date Of Transaction">
                                        {{__('Date')}}
                                        </th>
                                        <th scope="col">
                                        {{__('Amount')}}
                                        </th>
                                        <th scope="col">
                                            Type
                                        </th>
                                        <th scope="col">
                                        {{__('Invoice')}}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @forelse($allSubscriptions['result'] as $subRow)
                                    <tr>
                                        <th scope="row">
                                           {{date('d-M-Y',strtotime($subRow->date_of_transaction))}}
                                        </th>
                                        <td>
                                            € {{number_format($subRow->total/100,2)}}
                                        </td>
                                        <td>
                                            Monthly
                                        </td>
                                        <td>
                                           <a href="{{$subRow->paymentDetails->invoice_pdf??'#'}}" target="_blank"> <i class="bi bi-file-pdf h4 text-danger"></i>
                                           </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                      <td colspan="4">
                                    <h3 class="border rounded m-2 p-4 ">{{__('No Data Available')}}</h3>
                                      </td></tr>
                                    @endforelse
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>





						{{-- Subscription History code ends here --}}

                                </div>
                               
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
               
             
              </div>
          </div>
      </div>
  </div> 
  <div class="modal fade" id="changeAccountTypeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
      <h3 class="modal-title" id="exampleModalLabel">Change Account Type</h3>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body ps-2 pe-2">
         <div class="row g-0 justify-content-center">
                <!-- RIGHT PANEL -->
                <div class="col-12 ">
                    <div class="inner_panel">
                      <?php if( $usertype != 'Normal' ){ ?>
                          <div class="select_account_type" data-option="Normal" data-plan="">
                            <div class="row">
                              <div class="col-2 text-center">
                                  <img src="{{ asset( $publicPath . 'front_assets/images/animal-rights.svg') }}" />
                              </div>
                              <div class="col-10">
                                  <h5>{{__('Normal seller/buyer')}}</h5>
                                  <p>{{__('Free to add an advertisement, up to 3')}}</p>
                              </div>  
                            </div>  
                          </div>
                        <?php } ?>
                        <?php if( $usertype != 'Shelter' ){ ?>
                          <div class="select_account_type" data-option="Shelter" data-plan="price_1K7HkBBuir1vjVYcdajeTyy7"> 
                            <!-- price_1JxxQeCaEIG4B93yXx7Be3mO -->
                            <div class="row">
                              <div class="col-2 text-center">
                                  <img src="{{ asset( $publicPath . 'front_assets/images/animal-shelter.svg') }}" />
                              </div>
                              <div class="col-10">
                                  <h5>{{__('Animal shelter')}}</h5>
                                  <p>{{__('Animal shelter accounts are €1,- each month. They can add unlimited advertisements')}}</p>
                              </div>  
                            </div>  
                          </div>
                          
                          <?php } ?>
                          <?php if( $usertype != 'Shelter' ){ ?>
                          <div class="select_account_type" data-option="Breeder" data-plan="price_1K7HkuBuir1vjVYcJwPCY5Yq">
                            <!-- price_1JxxPNCaEIG4B93yTxn1GsRe -->
                            <div class="row">
                              <div class="col-2 text-center">
                                  <img src="{{ asset( $publicPath . 'front_assets/images/breeder-icn.svg') }}" />
                              </div>
                              <div class="col-10">
                                  <h5>{{__('Breeder')}}</h5>
                                  <p>{{__('Breeders need to pay €4.95 each month to use this site. They can add unlimited advertisements and they are able to add their breeder info in the account page')}}</p>
                              </div>
                            </div>  
                          </div>
                          <?php } ?>
                    </div> 
                </div>
            </div>
      </div>
      <div class="modal-footer">
      <form method="POST" action="{{route('proceedToChangeUserType')}}" id="frm_update_user_type">
       
         
          <input type="hidden" name="usertypeto" id="usertype" /> 
 @csrf
      </form> 
        <button type="button" class="btn btn-lg" data-bs-dismiss="modal">Discard</button>
        <button type="button" class="btn btn-primary btn-lg " id="submitUserType">{{__('Update')}}</button>
      </div>
    </div>
    </div>
  </div>
   @endsection
    @section('optional_scripts')
      <script type="text/javascript">
        var APP_URL="{{url('/')}}";

      </script>
<script src="{{ asset( $publicPath . 'front_assets/js/adsaveforlater.js') }}"></script>
<script type="text/javascript">
     jQuery('#usertype').val("");
     jQuery('input[name="_token"]').val("{{csrf_token()}}");
       jQuery('#submitUserType').on('click', function(event) {
        event.preventDefault();
        if(jQuery('#usertype').val()=="")
       {
        alert("Please select User Type");
        return;
       }
        jQuery('#frm_update_user_type').submit();
      });
</script>
      @endsection
