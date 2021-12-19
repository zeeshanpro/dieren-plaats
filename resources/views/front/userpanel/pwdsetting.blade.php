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
                                    <h2>{{__('Password settings')}}</h2>
                                </div>
                            </div>
                          </div>
                          <div class="row">
                            <x-notification/>
                            <div class="col-6 pt-4">
                              <form method="post" action="{{route('update_logindetails')}}">
                                @csrf
                                <div class="mb-3 pt-2">
                                  <label for="currentPassword" class="form-label">Current Password</label>
                                  <input type="password" class="form-control" id="currentPassword" name="currentpass">
                                </div>
                                <div class="mb-3 pt-2">
                                  <label for="newpass" class="form-label">New Password</label>
                                  <input type="password" class="form-control" id="newpass" name="newpass">
                                </div>
                                <div class="mb-3 pt-2">
                                  <label for="newpass_confirmation" class="form-label">Confirm Password</label>
                                  <input type="password" class="form-control" id="newpass_confirmation" name="newpass_confirmation">
                                </div>
                                <button type="submit" class="btn btn-info btn-lg btn-lg-xl mt-3">Reset</button>
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
