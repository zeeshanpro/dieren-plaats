@extends('admin/layouts/layout')
@section('title','List Users')
@section('optional_css')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('container')

<style>
  .hide {
  display: none;
}
  </style>
<section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          

          
      <div class="card-tools">
                 <div class="input-group input-group-sm" style="width: 150px;">
                   <input type="text" name="table_search" class="form-control float-right" placeholder="Search" id="search">

                   <div class="input-group-append">
                     <button type="submit" class="btn btn-default"><i class="fas fa-search loader"></i></button>
                   </div>
                 </div>
               </div>

      <div class="card-tools  mr-4 hide">
                 <div class="input-group input-group-sm" style="width: 150px;">
                  <label class="mr-2">Type: </label>
                  <select class="form-control filter typechange" data-filter_column="type" >
                    <option value="">Select Type</option>
                    <option value="Normal">Normal User</option>
                    <option value="Breeder">Breeder</option>
                    <option value="Shelter">Shelter</option>
                   </select>
                 </div>
               </div>
          
        </div>
        <div class="card-body">
  <table class="table table-head-fixed table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <!-- <th>Type</th> -->
                      <th> Sub. Status</th>
                      <!-- <th># of Ads</th>
                      <th># of Exp Ads</th> -->
                      <th>Action</th>
                    </tr>
                  </thead>
                 
                 @include('admin.user.table_data')
 
                 </td></tr>


                </table>
        </div>
        <!-- /.card-body -->
        

      </div>
      <!-- /.card -->

    </section>
    
@endsection

@section('optional_scripts')
<script src="{{asset('admin_assets/dist/js/ajaxsearch.js')}}"></script>
<script src="{{asset('admin_assets/plugins/toastr/toastr.min.js')}}"></script>

<script type="text/javascript">
 $(document).ready(function(){

 ajaxSearch().init("{{ url('/admin/search_users') }}");
     // Date frtom on change
$( ".typechange" ).change(function() {
  if($(this).val()!="")
  ajaxSearch().reload();
});

     }); //on doc ready
</script>
<script type="text/javascript">
  toastr.options = {
  "progressBar": true,
  "timeOut": "3000"
}

var csrftokenval=$('meta[name="csrf-token"]').attr('content');
var spinner = $('#loader');
  // Delete Ad
$(document).on("click", '.deleteuser', function(event) { 
   event.preventDefault();
   
   if (confirm('You are about to delete user with id: ( ' + $(this).data('uid') + ' ) ?')) {
  // Save it!
  deleteUser($(this).data('uid'));
} else {
  // Do nothing!
  console.log('data was not deleted ');
}

});

//delete Ad ajax
function deleteUser(uid)
{
 if(uid=="")
   {
    toastr.error('Field Must Have ID');
    return;
   }
  spinner.show();
var jqxhr = $.ajax( {
  url: "{{route('admin-delete_user')}}",
  method:"POST",
  data:{"userId":uid},
  headers: { 'X-CSRF-TOKEN': csrftokenval }
  })
  .done(function(data) {
    
    spinner.hide();
   if(data.code==201)
   {
    toastr.success('User Deleted Successfuly');
   }
   else
   {
    toastr.error(data.msg);
   }
     ajaxSearch().reload();
  })
  .fail(function(data) {
   spinner.hide();
   console.log(data);
  toastr.error('User Not Deleted');
  });
}  
</script>

@endsection