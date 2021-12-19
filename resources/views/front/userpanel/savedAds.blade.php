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

                  @foreach ( $savedAds as $row)
                   
                        @include( 'front.layout.components.subviews.adCell', [ 'row' => $row , 'ifWatchLater'=>true,'cellColumn'=>4] )
                    @endforeach


                 
              </div>
                <!-- CONTENT BOTTOM PANEL-->
              <div class="row mt-4 mb-4">
                  <div class="col-auto me-auto">
                      <nav aria-label="Page navigation example">
                        <ul class="pagination">
                          <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                              <span aria-hidden="true"><i class="bi bi-chevron-left"></i></span>
                            </a>
                          </li>
                          <li class="page-item active"><a class="page-link" href="#">1</a></li>
                          <li class="page-item"><a class="page-link" href="#">2</a></li>
                          <li class="page-item"><a class="page-link" href="#">3</a></li>
                          <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                              <span aria-hidden="true"><i class="bi bi-chevron-right"></i></span>
                            </a>
                          </li>
                        </ul>
                      </nav>
                  </div>
                  <div class="col-auto">
                    <div class="page_per">
                      <select class="form-select" aria-label="Default select example">
                        <option selected>9</option>
                        <option value="1">15</option>
                        <option value="2">20</option>
                        <option value="3">30</option>
                      </select>
                      <label>Item per page</label>
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
