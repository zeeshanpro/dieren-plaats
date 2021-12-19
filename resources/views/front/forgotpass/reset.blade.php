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
                            <h3>Wachtwoord Dierenplaats Reset Password</h3>
                            @error('msg') <small class="text-danger">{{$message}}</small> @enderror
                            <div class="row"><x-notification/></div>
                            <form method="post" action="{{route('update_forgot_password')}}" >
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                              <div class="mb-3 mt-4">
                                <label for="exampleInputEmail1" class="form-label">{{__('Email address')}}</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
                              </div>

                               <div class="mb-3 mt-4">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                               <div class="mb-3 mt-4">
                               <label for="password-confirm" class="col-md-6 col-form-label text-md-right">Confirm Password</label>
                                 <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                               @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                          

                              <div class="d-grid mt-5">
                                <button type="submit" class="btn btn-primary btn-lg"> Reset Password</button>
                              </div>
                            </form>
                            
                          </div>
                    </div> 
                </div>
            </div>
          </div>  
      </div>  
     </div>
@endsection