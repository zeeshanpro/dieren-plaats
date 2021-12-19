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
                            <h3>Login to Dierenplaats</h3>
                            <p>{{__("You don't have an account?")}} <a href="{{route('register')}}" class="red"><strong>{{__('Create a free account')}}</strong></a></p>
                            @error('msg') <small class="text-danger">{{$message}}</small> @enderror
                            <form method="post" action="/login" >
                            @csrf
                              <div class="mb-3 mt-4">
                                <label for="exampleInputEmail1" class="form-label">{{__('Email address')}}</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
                              </div>
                              <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">{{__('Password')}}</label>
                                <input type="password" class="form-control" name="password" id="exampleInputPassword1">
                              </div>
                              <div class="row">
                                  <div class="col">
                                    <div class="mb-3 form-check">
                                      <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                      <label class="form-check-label" for="exampleCheck1">Remember me</label>
                                    </div>
                                  </div>
                                  <div class="col text-end">
                                      <a href="{{route('show_forgot_password')}}" class="grey">{{__('Forgot Password?')}}</a>
                                  </div>
                              </div>
                              <div class="d-grid mt-5">
                                <button type="submit" class="btn btn-primary btn-lg">{{__('Login')}}</button>
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