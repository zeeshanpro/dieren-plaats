@extends('front/layout/layout')
<?php $publicPath = env('ASSETS_PATH'); ?>
@section('optional_css')
<meta content="{{ csrf_token() }}" name="csrf-token"/>
    <link href="{{ asset( $publicPath . 'front_assets/css/my.css') }}" rel="stylesheet">
@endsection
@section('container')
<div class="inner_page_content_area">
    <div class="container">
        <div class="row pt-3">
            <div class="col-lg-2 left_sidebar col-12">
                @include('front.userpanel.sideMenu')
            </div>
            <!-- RIGHT MAIN PANEL -->
            <div class="col-lg-10 col-12">
                <div class="row">
                    
                     {{-- Messages List On Left Side --}}
                   @include( 'front.layout.components.messageListLeft',[$result,$myAds] )
                    
                            
                                
                {{-- Messages  List On Right Side --}}
                
                 <section id="messageRightSection" style="display:contents">
                    <div class="col-md-7">
                    <h3 class="w-75  p-4 mx-4 text-grey">No Conversation Selected </h3>
                </div>
                 </section>
               
                              
                       
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
<script src="{{ asset( $publicPath . 'front_assets/js/messaging.js') }}">
</script>
<script type="text/javascript">
   jQuery(document).ready(function() {
@if(isset($adId))
fetch_message_first_time({{$adId??'0'}}, {{$oldMsgId}});
@endif
});
</script>
@endsection
