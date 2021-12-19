@extends('front/layout/registerLayout')
<?php $publicPath = env('ASSETS_PATH'); ?>
@section('container')
<div class="register_page">
      <div class="container">
          <div class="main_panel  mt-3 mt-md-5">
            <div class="row g-0">
                <!-- LEFT PANEL -->
                <div class="col-md-6 left_panel d-none d-md-block">
                    <h3>Om je op weg te helpen bij de aanschaf van een dier is dierenplaats in het leven geroepen. Dierenplaats is het platform waarop dieren gekocht en verkocht kunnen worden. Zo ben jij er zeker van dat jouw dier bij een goed baasje terecht komt en andersom!</h3>
                </div>

                <!-- RIGHT PANEL -->
                <div class="col-md-6 right_panel">
                    <div class="inner_panel">
                          <div class="row top_panel pb-4">
                            <div class="col">
                                <a href="#" class="grey"><i class="bi bi-arrow-left"></i> {{__('Back')}}</a>
                            </div>
                            <div class="col text-end">
                                3/3
                            </div>
                         </div>
                          <div class="max_width">
                            
                          @if ($errors->any())
                              @foreach ($errors->all() as $error)
                                  <div><small class="text-danger">{{$error}}</small></div>
                              @endforeach
                          @endif
                            <h3>{{__('Register to Dierenplaats')}}</h3>
                            <p>Heb je al een account bij ons? <a href="#" class="red"><strong>Log hier in</strong></a></p>
                            <form action="/emailverify" method="post" class="digit-group" 
                                    data-group-name="digits" data-autosubmit="false" autocomplete="off">
                            @csrf
                              <div class="mb-3 mt-4">
                                <p>{{__('Please enter the 4 digits code sent to')}} {{ Session::get('email') }}</p>
                              </div>
                              <div class="row g-3 mb-3">
                                  <div class="col">
                                    <input type="text" name="otp1" id="otp1" class="form-control" style="text-align:center;" maxlength="1" onkeyup="clickEvent(this,'otp2')">
                                  </div>
                                  <div class="col">
                                    <input type="text" name="otp2" id="otp2" class="form-control" style="text-align:center;" maxlength="1" onkeyup="clickEvent(this,'otp3')">
                                  </div>
                                  <div class="col">
                                    <input type="text" name="otp3" id="otp3" class="form-control" style="text-align:center;" maxlength="1" onkeyup="clickEvent(this,'otp4')">
                                  </div>
                                  <div class="col">
                                    <input type="text" name="otp4" id="otp4" class="form-control" style="text-align:center;" maxlength="1" >
                                  </div>
                                  <div class="col"></div>
                              </div>
                              <a href="#" class="red"><strong>{{__('Resend code')}}</strong></a>
                              <div class="d-grid mt-5">
                                <button type="submit" class="btn btn-primary btn-lg">{{__('Continue')}}</button>
                              </div>
                              <input type="hidden" name="email" value="{{ Session::get('email') }}" />
                            </form>
                          </div>
                    </div> 
                </div>
            </div>
          </div>  
      </div>  
     </div>
@endsection
@section( 'optional_scripts' )

  <script>
    function clickEvent(first,last){
			if(first.value.length){
				document.getElementById(last).focus();
			}
		}   
  </script>
@endsection