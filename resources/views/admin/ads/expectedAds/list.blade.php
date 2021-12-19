@extends('admin/layouts/layout')
@section('title','Expected Ads')
@section('optional_css')

<style>


.containerImage {
  position: relative;
  width: 70px;
  max-width: 70px;
  float: left;
}

.image {
  display: block;
  width: 100%;
  height: auto;
  border-radius:5px;
}

.overlayImage {
  position: relative; 
  bottom: 2px; 
  background: rgb(0, 0, 0);
  background: rgba(0, 0, 0, 0.5); /* Black see-through */
  color: #f1f1f1; 
  width: 100%;
  opacity:1;
  color: white;
  font-size: 12px;
  padding: 0px;
  text-align: center;
  display: block;
}


</style>
@endsection 
@section('container')
<section class="content">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">List Expected Ads</h3>
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
                      <th>Breeder </th>
                      <th>Father | Mother</th>
                      <th> Kind</th>
                      <th>Coming Date</th>
                      <th>Waiting #</th>
                    </tr>
                  </thead>
                  
                 

                     @include('admin.ads.expectedAds.table_data')
 
                 </td></tr>
                   
                  
                </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          Listing Expected Ads
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    
@endsection

@section('optional_scripts')
<script src="{{asset('admin_assets/dist/js/ajaxsearch.js')}}"></script>

<script type="text/javascript">
 $(document).ready(function(){

 ajaxSearch().init("/admin/search_expectedads");
     
     }); //on doc ready
</script>

@endsection