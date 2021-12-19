@extends('admin/layouts/layout')
@section('title','Ads Details')
<?php 
$publicPath = env('ASSETS_PATH');
?>
@section('optional_css')
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


</style>
@endsection
@section('container')
  <!-- Ekko Lightbox -->
  
<section class="content">
  <?php
  $usertypeColor="bg-danger";
  $cardColor="card-danger";

  if(strtolower($result->expected_babieUser->usertype)=="breeder"){
    $usertypeColor="bg-warning";
    $cardColor="card-warning";
  }
    elseif(strtolower($result->expected_babieUser->usertype)=="shelter"){
    $usertypeColor="bg-danger";
    $cardColor="card-danger";
    }
      elseif(strtolower($result->expected_babieUser->usertype)=="normal"){
    $usertypeColor="bg-gray";
    $cardColor="card-gray";
    }
   

 
//echo "<pre>";
//print_r($result);
  ?>
    <form action="{{url('/admin/update_expected_ad')}}" method="POST">
@csrf
    <div class="row ml-2">


      
      <!-- User details Starts Here -->
    <div class="col-12">
        
      <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-info">
                <h3 class="widget-user-username">{{$result->expected_babieUser->name}}</h3>
                <h5 class="widget-user-desc {{$usertypeColor}} d-inline px-2 rounded">{{$result->expected_babieUser->usertype}}</h5>
              </div>
              <div class="widget-user-image" {{(!$result->expected_babieUser->Breeder->logo ?' style="margin-left: -60px;"' : ' ')}}>
                @if($result->expected_babieUser->Breeder->logo)
                <img class="img-circle elevation-2" src="{{url('storage/app/public/uploads/users/thumb/'.$result->expected_babieUser->Breeder->logo) }}" alt="None" style="height:90px;">
                @else
                <img class="defaultImageStyle elevation-2" src="{{ url( $publicPath . 'public/admin_assets/logo.png')}}" alt="Default Image">
                @endif
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">{{$result->expected_babieUser->email}}</h5>
                      <span class="description-text text-info">Email</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">{{$result->expected_babieUser->Breeder->phone}}</h5>
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
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter title" value="{{old('title',$result->title)}}" name="title">
                     <input type="hidden" name="adId" value="{{$result->id}}">
                  </div>
                <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" rows="3" placeholder="Enter ..." name="desc">{{old('desc',$result->desc)}}</textarea>
                      </div>
               

              <!--  <div class="row">
                  <div class="col-lg-6">
                    <div class="input-group mb-3">
                  
                  <div class="input-group-prepend">
                    <span class="input-group-text">Views</span>
                  </div>
                  <input type="text" class="form-control" value="{{$result->ad_views_count}}">
                </div>
                   
                  </div>

                <div class="col-lg-6">
                    <div class="input-group mb-3">
                  
                  <div class="input-group-prepend">
                    <span class="input-group-text">Likes</span>
                  </div>
                  <input type="text" class="form-control" value="{{$result->likecount}}">
                </div>
                   
                  </div>


                </div> -->
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

                
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="expectedaddssubmit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

           


          </div>


          <!-- Attributes -->
          <div class="col-md-6">
            <div class="card  {{$cardColor}}">
              <div class="card-header">
                <h3 class="card-title">Other Info</h3>
              </div>
              <div class="card-body">
           


                   <!-- Gallery -->

        <div class="row mt-5">
          <div class="col-12">
            <div class="card card-outline  {{$cardColor}}">
              <div class="card-header">
                <h4 class="card-title">Parents</h4>
              </div>
              <div class="card-body">
                <div class="row">
                  
                  <div class="col-sm-3" >
                  
                    <a href="{{ url('storage/app/public/uploads/expectedbabies/thumb/'.$result->father_pic) }}" data-toggle="lightbox" data-title="Father : {{$result->father}}" data-gallery="gallery">
                      <img src="{{ url('storage/app/public/uploads/expectedbabies/thumb/'.$result->father_pic) }}" class="img-fluid mb-2 imageStyle" alt="None">
                     
                    </a>
                    <div class="text-center">Father</div>
                     <!-- <i class="fas fa-times text-white bg-danger p-1 delete" data-id="{{$result->id}}" ></i> -->
                  </div>

                   <div class="col-sm-3" >
                  
                    <a href="{{ url('storage/app/public/uploads/expectedbabies/thumb/'.$result->mother_pic) }}" data-toggle="lightbox" data-title="Mother : {{$result->mother}}" data-gallery="gallery">
                      <img src="{{ url('storage/app/public/uploads/expectedbabies/thumb/'.$result->mother_pic) }}" class="img-fluid mb-2 imageStyle" alt="None">
                     
                    </a>
                    <div class="text-center">Mother</div>
                     <!-- <i class="fas fa-times text-white bg-danger p-1 delete" data-id="{{$result->id}}" ></i> -->
                  </div>

                 
                  
                

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

<!-- AdminLTE for demo purposes -->
<script>
  $(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true,
        rightArrow:"<span class='text-gray'>❯</span>",
        leftArrow:"<span class='text-gray'>❮</span>",
      });
    });

    // $('.filter-container').filterizr({gutterPixels: 3});
    $('.btn[data-filter]').on('click', function() {
      $('.btn[data-filter]').removeClass('active');
      $(this).addClass('active');
    });
  })

  $(document).ready(function(){

    $('.delete').on('click',function(){
       event.preventDefault();
    alert($(this).data('id'));
    });
  
  });
</script>

@endsection