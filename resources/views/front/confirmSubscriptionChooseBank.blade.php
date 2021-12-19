@extends('front/layout/registerLayout')
<?php $publicPath = env('ASSETS_PATH'); ?>
@section('container')
<div class="register_page">
      <div class="container">
          <div class="main_panel">
            <div class="row g-0">
                <!-- LEFT PANEL -->
                <div class="col-md-6 left_panel">
                    <h3>Lorem ipsum dolor sit amet, consetutur sadiscing slitr, sed diam noumy eirmod tempor invidunt ut.</h3>
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
                            <h3>{{__('Register to Dierenplaats')}}</h3>
                            <p>Heb je al een account bij ons? <a href="#" class="red"><strong>Log hier in</strong></a></p>
                            
                              <div class="mb-3 mt-5">
                                <p>Last step confirm payment €1 per month to create your account</p>
                              </div>
                                  <div class="confirm_payment">
                                      <div class="row g-0">
                                          <div class="col-11 left-side">
                                              <img src="{{ asset( $publicPath . 'front_assets/images/payment-logo.png') }}" />
                                              <h5>ABN Amro</h5>
                                          </div>
                                          <div class="col-1 text-end">
                                              <i class="bi bi-chevron-right"></i> 
                                          </div>
                                      </div>
                                  </div>  
                                    <div class="confirm_payment">
                                      <div class="row g-0">
                                          <div class="col-11 left-side">
                                              <img src="{{ asset( $publicPath . 'front_assets/images/payment-logo.png') }}" />
                                              <h5>ING</h5>
                                          </div>
                                          <div class="col-1 text-end">
                                              <i class="bi bi-chevron-right"></i> 
                                          </div>
                                      </div>
                                    </div>  
                                    <div class="confirm_payment">
                                      <div class="row g-0">
                                          <div class="col-11 left-side">
                                              <img src="{{ asset( $publicPath . 'front_assets/images/payment-logo.png') }}" />
                                              <h5>Rabobank</h5>
                                          </div>
                                          <div class="col-1 text-end">
                                              <i class="bi bi-chevron-right"></i> 
                                          </div>
                                      </div>
                                    </div>  
                                    <div class="confirm_payment">
                                      <div class="row g-0">
                                          <div class="col-11 left-side">
                                              <img src="{{ asset( $publicPath . 'front_assets/images/payment-logo.png') }}" />
                                              <h5>ASN Bank</h5>
                                          </div>
                                          <div class="col-1 text-end">
                                              <i class="bi bi-chevron-right"></i> 
                                          </div>
                                      </div>
                                  </div>  
                                  <div class="confirm_payment">
                                    <div class="row g-0">
                                        <div class="col-11 left-side">
                                            <img src="{{ asset( $publicPath . 'front_assets/images/payment-logo.png') }}" />
                                            <h5>Munq</h5>
                                        </div>
                                        <div class="col-1 text-end">
                                            <i class="bi bi-chevron-right"></i> 
                                        </div>
                                    </div>
                                </div>  
                                <div class="confirm_payment">
                                  <div class="row g-0">
                                      <div class="col-11 left-side">
                                          <img src="{{ asset( $publicPath . 'front_assets/images/payment-logo.png') }}" />
                                          <h5>Knab</h5>
                                      </div>
                                      <div class="col-1 text-end">
                                          <i class="bi bi-chevron-right"></i> 
                                      </div>
                                  </div>
                              </div>  
                              <div class="d-grid mt-5">
                                <a href="/" class="btn btn-primary btn-lg">Pay (€1)
                                    <!-- <button type="submit" class="btn btn-primary btn-lg">Pay (€1)</button> -->
                                </a>
                              </div>
                          </div>
                    </div> 
                </div>
            </div>
          </div>  
      </div>  
     </div>

@endsection