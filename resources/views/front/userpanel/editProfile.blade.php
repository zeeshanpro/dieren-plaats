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
              <div class="col-md-10">
                <div class="row">
                    <form enctype="multipart/form-data" method="post" id="submitdetails" action="editprofile"> @csrf 
                    <div class="col pb-5">
                        <div class="shadow_box my_profile_section">
                          <div class="page-header">
                            <div class="row">
                                <div class="col">
                                    <h2>{{__('Profile info')}}</h2>
                                </div>
                                <div class="col text-end">
                                
                                    <h2><input type="submit" name="save" value="Save">
                                    <!-- <a href="" onclick="document.getElementById('submitdetails').submit();"><strong>Save</strong></a> -->
                                  </h2>
                                </div>
                            </div>
                          </div>

                          <div class="col-12">
                          @if ($errors->any())
                              <div class="alert alert-danger">
                                  <ul>
                                      @foreach ($errors->all() as $error)
                                          <li>{{ $error }}</li>
                                      @endforeach
                                  </ul>
                              </div>
                          @endif
                          @if (Session::has('message'))
                            <div class="alert alert-info">{{ Session::get('message') }}</div>
                          @endif
                          </div>
                          @normalUser
                          @else
                          <div class="row">
                            <div class="col-6 pt-4">
                                <div class="mb-3 pt-2">
                                  <label for="exampleFormControlTextarea1" class="form-label">Company {{__('Name')}}</label>
                                  <input type="text" class="form-control" id="exampleInputPassword1" name="company_name" value="{{ $data->Breeder->company_name ?? '' }}">
                                </div>
                            </div>
                            <div class="col-6 pt-4">
                              <div class="mb-3 pt-2">
                                <label for="exampleFormControlTextarea1" class="form-label">Owner {{__('Name')}}</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" name="owner_name" value="{{ $data->Breeder->owner_name ?? '' }}">
                              </div>
                            </div>
                          </div>
                          @endnormalUser
                          <div class="row">
                            <div class="col-6">
                                <div class="mb-3 pt-2">
                                  <label for="exampleFormControlTextarea1" class="form-label">{{__('About')}}</label>
                                  <textarea class="form-control" id="exampleFormControlTextarea1" name="company_about" rows="3">{{ $data->Breeder->company_about ?? '' }}</textarea>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mb-3 pt-2">
                                @normalUser
                                  <label for="exampleFormControlTextarea1" class="form-label">{{__('Profile Picture')}}</label>
                                @else
                                  <label for="exampleFormControlTextarea1" class="form-label">Company logo</label>
                                @endnormalUser  
                                  <div class="custom-file text-center" id="logoFile">
                                    <i class="bi bi-cloud-plus-fill"></i>
                                  </div>
                                  <span id="logoFilename"></span>
                                  <input type="file" name="companylogo" id="logoFileHidden" style="display:none">
                                </div>
                            </div>

                              <div class="col-2">
                                <div class="mb-3 pt-2">
                                  <label for="exampleFormControlTextarea1" class="form-label">Preview</label>
                                  <div class="custom-file text-center">
                                    <img src="{{ url('storage/app/public/uploads/users/thumb/'.$data->Breeder->logo) }}" class="rounded" id="imgPreview" style="height: 75px;width:75px;" alt="No Image" />
                                  </div>
                            </div>

                          </div>
                          <div class="row">
                              <div class="col-6">
                                <div class="mb-3 pt-2">
                                  <label for="phone" class="form-label">{{__('Phone')}}</label>
                                  <input type="text" class="form-control" id="phone" name="phone" value="{{ $data->Breeder->phone ?? '' }}">
                                </div>
                              </div>
                              <div class="col-6">
                                  <div class="mb-3 pt-2">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ $data->email ?? '' }}">
                                  </div>
                              </div>
                          </div>
                          @normalUser
                          @else
                          <div class="row">
                              <div class="col-6">
                                <div class="mb-3 pt-2">
                                  <label for="website" class="form-label">URL</label>
                                  <input type="text" class="form-control" id="website" name="website" value="{{ $data->Breeder->website ?? '' }}">
                                </div>
                              </div>
                              <div class="col-6">
                                  <div class="mb-3 pt-2">
                                    <label for="fb_url" class="form-label">Facebook Profile link</label>
                                    <input type="text" class="form-control" id="fb_url" name="fb_url" value="{{ $data->Breeder->fb_url ?? '' }}">
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-6">
                                <div class="mb-3 pt-2">
                                  <label for="insta_url" class="form-label">Instagram Profile link</label>
                                  <input type="text" class="form-control" id="insta_url" name="insta_url" value="{{ $data->Breeder->insta_url ?? '' }}">
                                </div>
                              </div>
                              <div class="col-6">
                                  <div class="mb-3 pt-2">
                                    <label for="linkedin_url" class="form-label">LinkedIn Profile link</label>
                                    <input type="text" class="form-control" id="linkedin_url" name="linkedin_url" value="{{ $data->Breeder->linkedin_url ?? '' }}">
                                  </div>
                              </div>
                          </div>
                          @endnormalUser  
                          <div class="row">
                              <div class="col pt-2">
                                <label for="exampleFormControlTextarea1" class="form-label">{{__('Location')}}</label>
                              </div>
                          </div>
                          <div class="row">
                            <div class="col-4">
                                <div class="mb-3 pt-2">
                                  <input type="text" class="form-control" id="street" name="street" placeholder="Street" value="{{ $data->Breeder->street ?? '' }}">
                                </div>
                            </div>
                            <div class="col-4">
                              <div class="mb-3 pt-2">
                                <input type="text" class="form-control" id="city" name="city" placeholder="{{__('City')}}" value="{{ $data->Breeder->city ?? '' }}">
                              </div>
                            </div>
                            <div class="col-4">
                              <div class="mb-3 pt-2">
                                <select class="form-select mb-3" aria-label=".form-select-lg example" name="country">
                                  <option selected>{{__('Country')}}</option>
                                  <option value="Nederland" selected>Nederland</option>
                                </select>
                              </div>
                            </div>

                          </div>
                          <div class="row">
                            <div class="col-6">
                                <div class="mb-3 pt-2">
                                @normalUser
                                  <label for="exampleFormControlTextarea1" class="form-label">Select kind of animals you have</label>
                                @else
                                  <label for="exampleFormControlTextarea1" class="form-label">Select kind of animals you breed</label>
                                @endnormalUser    
                                  <select class="form-select mb-3" aria-label=".form-select-lg example" name="kind" id="kindselect">
                                    <option selected>Select</option>
                                    @foreach ($kinds as $kind)
                                        <option value="{{$kind->id}}" <?php if( isset( $data->Breeder->breederKind->kind_id ) and $data->Breeder->breederKind->kind_id == $kind->id ) echo 'selected';?> >{{$kind->title}}</option>    
                                    @endforeach
                                  </select>
                                </div>
                            </div>


                            <div class="col-6">
                                <div class="mb-3 pt-2">
                                @normalUser
                                  <label for="exampleFormControlTextarea1" class="form-label">Select {{__('Race')}} of animals you have</label>
                                @else
                                  <label for="exampleFormControlTextarea1" class="form-label">Select {{__('Race')}} of animals you {{__('breed')}}</label>
                                @endnormalUser    
                                  <select class="form-select mb-3" aria-label=".form-select-lg example" name="race" id="raceselect">
                                    <option selected>Select</option>
                                     @inject( "raceMaster" , 'App\Repositories\Front\RaceRepository' )
                                @php
                                if( isset( $data->Breeder->breederKind->kind_id ) ){
                                    $raceResults = $raceMaster->listByKind($data->Breeder->breederKind->kind_id );
                                @endphp
                                @foreach ( $raceResults['result'] as $row)
                                      <option value="{{ $row->id }}" {{$row->id == $data->Breeder->breederKind->race_id  ? 'selected' : ''}} >{{ $row->title }}</option>
                                @endforeach
                                @php } @endphp
                                    </select>
                                    @error('race') <small class="text-danger">{{$message}}</small> @enderror
                                </div>
                            </div>


                          </div>
                        </div>
                    </div>
                    </form>
                </div>
                
            </div>

          </div>
      </div>
  </div> 
@endsection
@section('optional_scripts')
<script type="text/javascript">
  jQuery(document).ready(function() {
    
  
  jQuery("#logoFile").click(function(e) {
    console.log('logoFile clicked');
    jQuery("#logoFileHidden").click();
});

jQuery('#logoFileHidden').change(function(e){
  var $in=$(this);
  jQuery('#logoFilename').html($in[0].files[0].name);


        const file = $in[0].files[0];
        console.log(file);
        if (file.type=="image/jpeg" || file.type=="image/png"){

          let reader = new FileReader();
          reader.onload = function(event){
            // console.log(event.target.result);
            $('#imgPreview').attr('src', event.target.result);
          }
          reader.readAsDataURL(file);
        
        }
      else
      {
         $('<div>Invalid Format</div>').insertAfter('#logoFilename').delay(3000).fadeOut();
            console.log("Invalid Format");
      }

});

jQuery('#kindselect').change(function(e){

var kindid=$(this).val();
if(kindid==""){
  return;
}
showLoader();
$.getJSON("{{route('get_races_by_kind')}}",{ kindId  : kindid }, function(result) {
  hideLoader();
var $dropdown = $("#raceselect");
$dropdown.empty();
$dropdown.append($("<option />").val("").text("Select"));
$.each(result, function() {
    $dropdown.append($("<option />").val(this.id).text(this.title));
});

});//end json

});





});
</script>
@endsection
