@extends('admin/layouts/layout')
@section('title','Settings')
{{-- http://image.intervention.io/getting_started/installation --}}
@section('container')
<section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Change Settings</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <style type="text/css">
          .updateImage
          {
             display: inline;
            position: absolute;
            right: 35%;
            cursor: pointer;
           
          }
.proIage img
          { 
            border: 1px solid lightgray;
          }
        

        </style>
        <div class="card-body">
          @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
          @endif
        <div class="row">
          <div class="col-6">
           <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Update Profile</p>

      <form action="/admin/adminsettings" method="post">
      @csrf
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Full name" name="name" value="{{$admin->name}}">
          @error('name') <small class="text-danger">{{$message}}</small> @enderror
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
          <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Phone" name="phone" value="{{$admin->Breeder->phone}}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email" value="{{$admin->email}}">
          @error('email') <small class="text-danger">{{$message}}</small> @enderror
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>  
        </div>
        
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Owner Name" name="owner_name" value="{{$admin->Breeder->owner_name}}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>  
        </div>

        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Company Name" name="company_name" value="{{$admin->Breeder->company_name}}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>  
        </div>

        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Street" name="street" value="{{$admin->Breeder->street}}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>  
        </div>

        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="City" name="city" value="{{$admin->Breeder->city}}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>  
        </div>

        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Country" name="country" value="{{$admin->Breeder->country}}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>  
        </div>

        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Facebook Link" name="fb_url" value="{{$admin->Breeder->fb_url}}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>  
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Instagram Link" name="insta_url" value="{{$admin->Breeder->insta_url}}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>  
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="LinkedIn Profile" name="linkedin_url" value="{{$admin->Breeder->linkedin_url}}">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>  
        </div>

        <div class="">
        <p class="">About Website</p>
        </div>
        <div class="input-group mb-3">
          <textarea class="form-control" name="company_about" cols="20" rows="10">{{$admin->Breeder->company_about}}</textarea>
        </div>

        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Retype password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
     
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Update</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->    
          </div>



        </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          Footer
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    
@endsection

@section('optional_scripts')
<script>
$('#updateImage').click(function(){ $('#profileImge').trigger('click'); });

$(document).ready(()=>{
      $('#profileImge').change(function(){
        const file = this.files[0];
        console.log(file);
        if (file.type=="image/jpeg" || file.type=="image/png"){

          let reader = new FileReader();
          reader.onload = function(event){
            // console.log(event.target.result);
            $('#img_profile').attr('src', event.target.result);
          }
          reader.readAsDataURL(file);
        
         //submit form
       $("#imageUploadForm").submit();

        }
      else
      {
         $('<div>Invalid Format</div>').insertAfter('#img_profile').delay(3000).fadeOut();
        console.log("Invalid Format");
      }

     });


//Ajax Upload Pic

      $('#imageUploadForm').on('submit',(function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                type:'POST',
                url: $(this).attr('action'),
                data:formData,
                cache:false,
                contentType: false,
                processData: false,
                success:function(data){
                    $('<div>'+data.success+'</div>').insertAfter('#img_profile').delay(13000).fadeOut();
                },
                error: function(response){
                  $('<div>'+response.responseJSON.message+'</div>').insertAfter('#img_profile').delay(3000).fadeOut();
                }
            });
      }));

    });
</script>

@endsection