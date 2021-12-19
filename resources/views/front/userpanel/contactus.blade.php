@extends('front/layout/layout')
<?php $publicPath = env('ASSETS_PATH'); ?>
  @section('optional_css')
      <meta name="csrf-token" content="{{ csrf_token() }}" />
  @endsection
@section('container')
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
                                    <h2>{{__('Contact Us')}}</h2>
                                </div>
                            </div>
                          </div>  
                          <x-notification/>
                          <div class="row">
                            <div class="col-9 pt-3">
                                <h6>{{__('Happy to hear from you')}}</h6>
                                
                                <div class="mb-3 pt-2">
                                  <form method="post" action="{{route('userpanel_save_contactus')}}">
                                    @csrf
                                  <label for="contactus" class="form-label">{{__('Your Message')}}</label>
                            <textarea class="form-control" id="message" rows="6" name="message">{{old('message')??''}}</textarea>

                                </div>
                                <button type="submit" class="btn btn-primary btn-lg mt-3">{{__('Submit')}}</button>
                              </form>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
               
             
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
      @endsection
