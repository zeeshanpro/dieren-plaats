@extends('admin/layouts/layout')
@section('title','List Ads')
@section('optional_css')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style type="text/css">
  .imageStyle
  {
    border:1px solid lightgray;
    padding:2px;
    border-radius: 5px;
  }
 
</style>
@endsection
@section('container')
<section class="content">
  <?php
  //echo "<pre>";
  // print_r($result);
  // return;
  ?>
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">List Ads</h3>

         
        <div class="card-tools">
                 <div class="input-group input-group-sm" style="width: 150px;">
                   <input type="text" name="table_search" class="form-control float-right" placeholder="Search" id="search">

                   <div class="input-group-append">
                     <button type="submit" class="btn btn-default"><i class="fas fa-search loader"></i></button>
                   </div>
                 </div>
               </div>
          
        </div>
        <div class="card-body">
  <table class="table table-head-fixed">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Pic </th>
                      <th>Title </th>
                      <th>Price </th>
                      <th>Kind</th>
                      <th> Race</th>
                      <th>User</th>
                      <th>User Type</th>
                      <th>Action </th>
                    </tr>
                  </thead>
               

                   @include('admin.ads.ads.table_data')
 
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

 ajaxSearch().init("/admin/search_ads");
     
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
$(document).on("click", '.deletead', function(event) { 
   event.preventDefault();
  
      if (confirm('You are about to delete Ad with id: ( ' + $(this).data('aid') + ' ) ?')) {
  // Save it!
  deleteAd($(this).data('aid'));
} else {
  // Do nothing!
  console.log('data was not deleted ');
}

});

//delete Ad ajax
function deleteAd(adid)
{
 
  // toastr.info("Delete "+id);
   
   if(adid=="")
   {
    toastr.error('Field Must Have ID');
    return;
   }
  spinner.show();
var jqxhr = $.ajax( {
  url: "{{route('admin-delete_ad')}}",
  method:"POST",
  data:{"adId":adid},
  headers: { 'X-CSRF-TOKEN': csrftokenval }
  })
  .done(function(data) {
    
    spinner.hide();
   if(data.code==201)
   {
    toastr.success('Ad Deleted Successfuly');
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
  toastr.error('Ad Not Deleted');
  });
}  
</script>

@endsection