@extends('admin/layouts/layout')
@section('title','Ads Details')
<?php 
$publicPath = env('ASSETS_PATH');
?>
@section('optional_css')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" href="{{asset('admin_assets/plugins/toastr/toastr.css')}}">
<link rel="stylesheet" href="{{ asset( $publicPath . 'admin_assets/plugins/ekko-lightbox/ekko-lightbox.css') }}">
<style type="text/css">
  .imageStyle
  {
    border:1px solid lightgray;
    padding:2px;
    border-radius: 5px;
  }
  .defaultImageStyle
  {
  height: 70px!important;
  width: 125px!important;
  border-radius: 10px;
  position: relative;
  left: -16px;
}
a:hover + .delete, .delete:hover {
  position: absolute;
  right: 5px;
  top: -10px;
  border-radius: 50%;
  width: 20px;
  height: 20px;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 12px;
  cursor: pointer;
}

.delete {
  display: none;
}
.users-list > li {

  width: 50%;
}
.direct-chat-messages {

  height: 415px;

}
.users-list > li img {
  
  height: 60px;
  max-width: 60px;
  width: 60px;
  object-fit: cover;
}
</style>
@endsection
@section('container')
  <!-- Ekko Lightbox -->
  
<section class="content">
  @if(!isset($result->adUser))
            <h3>Invalid Data</h3>
            @php return @endphp

            @endif
  <?php
  $usertypeColor="bg-danger";
  $cardColor="card-danger";

  if(strtolower($result->adUser->usertype)=="breeder"){
    $usertypeColor="bg-warning";
    $cardColor="card-warning";
  }
    elseif(strtolower($result->adUser->usertype)=="shelter"){
    $usertypeColor="bg-danger";
    $cardColor="card-danger";
    }
      elseif(strtolower($result->adUser->usertype)=="normal"){
    $usertypeColor="bg-gray";
    $cardColor="card-gray";
    }
   

 
//echo "<pre>";
//print_r($result);
  ?>
  <form action="{{url('/admin/update_ad')}}" method="POST">
@csrf
    <div class="row ml-2">


      
      <!-- User details Starts Here -->
    <div class="col-12">


        
      <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-info">
                <h3 class="widget-user-username">{{$result->adUser->name}}</h3>
                <h5 class="widget-user-desc {{$usertypeColor}} d-inline px-2 rounded">{{$result->adUser->usertype}}</h5>
              </div>
              @isset($result->adUser->Breeder->logo)
              <div class="widget-user-image" {{(!$result->adUser->Breeder->logo ?' style="margin-left: -60px;"' : ' ')}}>
                @if($result->adUser->Breeder->logo)
                <img class="img-circle elevation-2" src="{{url('storage/app/public/uploads/users/thumb/'.$result->adUser->Breeder->logo) }}" alt="None" style="height:90px;">
                @else
                <img class="defaultImageStyle elevation-2" src="{{ url( $publicPath . 'public/admin_assets/logo.png')}}" alt="Default Image">
                @endif
              </div>
              @endisset
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">{{$result->adUser->email ?? 'No Email'}}</h5>
                      <span class="description-text text-info">Email</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">{{$result->adUser->Breeder->phone ?? 'No Phone'}}</h5>
                      <span class="description-text text-info">Phone Number</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4">
                    <div class="description-block">
                      <h5 class="description-header">2 todo</h5>
                      <span class="description-text text-info">Listings</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>



    </div>
      <!-- User details Ends Here -->

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

<div class="col-md-6">
            <!-- general form elements -->
            <div class="card {{$cardColor}}">
              <div class="card-header">
                <h3 class="card-title">Ads Detail</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form>
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Title</label>
                    <input type="text" class="form-control" name="title" id="exampleInputEmail1" placeholder="Enter title" value="{{old('title',$result->title ?? '')}}">
                    <input type="hidden" name="adId" value="{{$result->id}}">
                  </div>
                <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="desc" rows="3" placeholder="Enter ...">{{old('desc',$result->desc ?? '')}}</textarea>
                      </div>
               

               <div class="row">
                 <div class="col-lg-4">
                    <div class="input-group mb-3">
                  
                  <div class="input-group-prepend">
                    <span class="input-group-text">Amount</span>
                  </div>
                  <input type="text" class="form-control" name="amount" value="{{old('amount',$result->amount ?? '')}}">
                </div>
                    <!-- /input-group -->
                  </div>

                  <div class="col-lg-4">
                    <div class="input-group mb-3">
                  
                  <div class="input-group-prepend">
                    <span class="input-group-text">Views</span>
                  </div>
                  <input type="text" class="form-control" value="{{$result->ad_views_count ?? ''}}" disabled="">
                </div>
                    <!-- /input-group -->
                  </div>
                   

                <div class="col-lg-4">
                    <div class="input-group mb-3">
                  
                  <div class="input-group-prepend">
                    <span class="input-group-text">Likes</span>
                  </div>
                  <input type="text" class="form-control" value="{{$result->likecount ?? ''}}" disabled="">
                </div>
                    <!-- /input-group -->
                  </div>


                </div>
                <!-- Race -->
                  <div class="form-group">
                  <label for="kind">Kind</label>
                  <select class="custom-select form-control-border" id="kind" name="kindid">
                    @foreach($kinds as $kind)
                    <option value="{{$kind->id}}" {{(old('kindid',$result->kind_id)==$kind->id?' selected' : '')}}>{{$kind->title}}</option>
                    @endforeach

                  </select>
                </div>
                <!-- Kind -->
                <div class="form-group">
                  <label for="race">Race</label>
                  <select class="custom-select form-control-border" id="race" name="raceid">
                     @foreach($races as $race)
                    <option value="{{$race->id}}" {{(old('raceid',$result->race_id)==$race->id?' selected' : '')}}>{{$race->title}}</option>
                    @endforeach
                    
                  </select>
                </div>

                <div class="form-group">
                  <label for="race">Publishing Status</label>
                  <input class="form-check-inpu" name="status" type="checkbox" value="1" {{($result->status ? ' checked' : ' ')}}  >
                </div>
                
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <Button  type="submit" name="adssubmit" class="btn btn-primary">Update</button>
                </div>
             
            </div>
            <!-- /.card -->

           





<div class="row">
              
              <!-- /.col -->
{{-- List Members --}}
              <div class="col-md-4">
                <!-- USERS LIST -->
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Members</h3>

                   
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                    <ul class="users-list clearfix">

                      @forelse($msgUsers as $member)
                      <li>
                        <a class="chatmember" href="javascript:void(0);" data-adid="{{$result->id??'-1'}}" data-userid="{{$member->id??'-1'}}">
                        @if($member->Breeder->logo)
                        <img src="{{url('storage/app/public/uploads/users/thumb/'.$member->Breeder->logo) }}" alt="{{$member->name??'None'}}">
                        @else
                        <img src="{{asset('/admin_assets/dist/img/default-150x150.png') }}" alt="{{$member->name??'None'}}">
                        @endif
                        <small style="line-height:13px; display:flex;">{{$member->name??'None'}}</small>
                      </a>
                       
                      </li>
                      @empty
                      <li>No Chat Members</li>
                      @endforelse
                     
                    </ul>
                    <!-- /.users-list -->
                  </div>
                  <!-- /.card-body -->
                 
                  <!-- /.card-footer -->
                </div>
                <!--/.card -->
              </div>



              {{-- Chat --}}
              <div class="col-md-8">
                <!-- DIRECT CHAT -->
                <div class="card direct-chat direct-chat-warning">
                  <div class="card-header">
                    <h3 class="card-title">Direct Chat</h3>

                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <!-- Conversations are loaded here -->
                   {{-- @include('admin.layouts.component.chatdata') --}}
                   <div class="direct-chat-messages">
                   </div>

                    
                    <!-- /.direct-chat-pane -->
                  </div>
                  <!-- /.card-body -->
               
                  <!-- /.card-footer-->
                </div>
                <!--/.direct-chat -->
              </div>
              <!-- /.col -->
            </div>



















          </div>


          <!-- Attributes -->
          <div class="col-md-6">
            <div class="card  {{$cardColor}}">
              <div class="card-header">
                <h3 class="card-title">Attributes</h3>
              </div>
              <div class="card-body">
                <div class="row">
             
                  <!-- col 2 -->
                  
                    @foreach($attributes as $attribute)
                      <div class="col-4">
                         <div class="form-group">
                            <label>{{$attribute->title}}</label>
                               @foreach($attribute->ad_attributeAdAttributeOptions as $attributeOption)
                           <div class="form-check">

                                 @if(old('attributeOptionsId') !== null)

                                  <input class="form-check-inpu" name="attributeOptionsId[]" type="checkbox" value="{{$attributeOption->id}}" {{(in_array($attributeOption->id,old('attributeOptionsId') )?' checked' : ' ')}}  >
                                @else

                                   <input class="form-check-inpu" name="attributeOptionsId[]" type="checkbox" value="{{$attributeOption->id}}" {{(in_array($attributeOption->id, $selectedAttributes)?' checked' : ' ')}}  >
                                 @endif


                                


                              <label class="form-check-label">{{$attributeOption->title ?? 'No Title'}}</label>
                            </div>
                             @endforeach
                  
                </div>
                  </div>
                     @endforeach

                  

                </div>

                   <!-- Gallery -->

        <div class="row mt-5">
          <div class="col-12">
            <div class="card card-outline  {{$cardColor}}">
              <div class="card-header">
                <h4 class="card-title">Gallery</h4>
                <div class="spinner-border text-dark ml-5" role="status" id="loader" style="display:none">
              <span class="sr-only">Loading...</span>
              </div>
              </div>
              <div class="card-body">
                <div class="row">
                   @if($result->adImages->count()<1)
                   <div class="col-12 align-self-center">
                  <h3 class="text-center" style="display: block;">No Photo Available</h3>
                  </div>
                   @endif
                  @foreach($result->adImages as $image)
                  <div class="col-sm-3" id="g-{{$image->id}}" >
                  
                    <a href="{{ url('storage/app/public/uploads/ads/thumb/'.$image->filename) }}" data-toggle="lightbox" data-title="{{$result->title}}" data-gallery="gallery">
                      <img src="{{ url('storage/app/public/uploads/ads/thumb/'.$image->filename) }}" class="img-fluid mb-2 imageStyle" alt="None">
                     
                    </a>
                     <i class="fas fa-times text-white bg-danger p-1 delete" data-imageid="{{$image->id}}" data-adid="{{$result->id}}" ></i>
                  </div>
                  @endforeach
                  
                

                </div>
              </div>
            </div>
          </div>
        </div>
      <!-- Gallery Ends Here -->

              </div>
              <!-- /.card-body -->
            </div>
          </div>
         
          <!-- attributes ends here -->


</div> <!-- row end -->
 </form>




    </section>
    
@endsection

@section('optional_scripts')

<!-- Ekko Lightbox -->
<script src="{{ asset( $publicPath . 'admin_assets/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
<!-- Page specific script -->
<!-- Filterizr-->
<script src="{{ asset( $publicPath . 'admin_assets/plugins/filterizr/jquery.filterizr.min.js') }}"></script>

<script src="{{asset('admin_assets/plugins/toastr/toastr.min.js')}}"></script>
<script src="{{asset('admin_assets/dist/js/adschathistory.js')}}"></script>
<script type="text/javascript">
 $(document).ready(function(){

 chatLoader().init("/admin/adsdetail_getmsg");
     
     }); //on doc ready
</script>

<!-- AdminLTE Lib -->
<script>
  $(function () {

    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });

    // $('.filter-container').filterizr({gutterPixels: 3});
    $('.btn[data-filter]').on('click', function() {
      $('.btn[data-filter]').removeClass('active');
      $(this).addClass('active');
    });
  })

  $(document).ready(function(){ 
      var csrftokenval=$('meta[name="csrf-token"]').attr('content');
      toastr.options = {
      "progressBar": true,
      "timeOut": "3000"
      }
     

    $('.delete').on('click',function(){
       event.preventDefault();
       deleteAdImage($(this).data('adid'),$(this).data('imageid'));

    });
  

//delete Ads ajax
function deleteAdImage(adid,imageid)
{

var element=$('#g-'+imageid);





      
 var spinner = $('#loader');
  // toastr.info("Delete "+id);
   
   if(adid=="" || imageid=="")
   {
    toastr.error('Field Must Have ID');
    return;
   }
  spinner.show();
var jqxhr = $.ajax( {
  url: "/admin/update_ad/remove_adImage",
  method:"POST",
  data:{"adId":adid,"imageId":imageid},
  headers: { 'X-CSRF-TOKEN': csrftokenval }
  })
  .done(function(data) {
    
    spinner.hide();
   if(data.code==201)
   {
    toastr.success('Image Deleted Successfuly');
   element.hide('slow', function(){ element.remove(); });
   }
   else
   {
    toastr.error("Error : " + data.msg);
   }
    //reload page here

  })
  .fail(function(data) {
   spinner.hide();
   console.log(data);
  toastr.error('Image Not Deleted');
  });
}   





  });
</script>

@endsection