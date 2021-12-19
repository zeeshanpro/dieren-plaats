@extends('front/layout/registerLayout')
<?php $publicPath = env('ASSETS_PATH'); ?>
@section('container')
<div class="register_page">
      <div class="container">
          <div class="main_panel">
            <div class="row g-0">
                <!-- LEFT PANEL -->
                <div class="col-md-6 left_panel d-none d-md-block">
                    <h3>Om je op weg te helpen bij de aanschaf van een dier is dierenplaats in het leven geroepen. Dierenplaats is het platform waarop dieren gekocht en verkocht kunnen worden. Zo ben jij er zeker van dat jouw dier bij een goed baasje terecht komt en andersom!</h3>
                </div>

                <!-- RIGHT PANEL -->
                <div class="col-md-6 right_panel">
                    <div class="inner_panel">
                          <div class="max_width">
                            <h3>Wachtwoord Dierenplaats resetten</h3>
                            <p>{{__("You don't have an account?")}} <a href="{{route('register')}}" class="red"><strong>{{__('Create a free account')}}</strong></a></p>
                            @error('msg') <small class="text-danger">{{$message}}</small> @enderror
                            <div class="row"><x-notification/></div>
                            <form method="post" action="{{route('send_forgot_password_email')}}" >
                            @csrf
                              <div class="mb-3 mt-4">
                                <label for="exampleInputEmail1" class="form-label">{{__('Email address')}}</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
                              </div>
                              
                              
                              <div class="d-grid mt-5">
                                <button type="submit" class="btn btn-primary btn-lg">Reset</button>
                              </div>
                            </form>
                            <div class="or">
                                <span>Or</span>
                            </div>
                            <a href="{{ route('overtogoogle') }}" class="continue_with mb-3"><img src="{{ asset( $publicPath . 'front_assets/images/google-icon.png') }}" /> Continue with Google</a>
                            <!-- <a href="#" class="continue_with"><img src="{{ asset( $publicPath . 'front_assets/images/facebook-icon.png') }}" /> Continue with Facebook</a> -->
                          </div>
                    </div> 
                </div>
            </div>
          </div>  
      </div>  
     </div>
@endsection