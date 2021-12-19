@extends('admin/layouts/layout')
@section('title','List Subscribers')

@section('container')
<section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          

        <div class="row">  
      
                   
                     <div class="col-3">
                      <div class="card-tools  d-flex justify-content-end">
      <div class="input-group input-group-sm" style="width: 150px;">
                         <input type="date" name="dtfrom" class="form-control filter dtchange" data-filter_column="date_from"  placeholder="Search" id="dtfrom">
                       </div>

                       </div>

                 </div>
                    <div class="col-1">
                      <div class="card-tools  d-flex justify-content-center">
                                TO

                       </div>

                 </div>
                    <div class="col-3">
                      <div class="card-tools  d-flex justify-content-start">
      <div class="input-group input-group-sm" style="width: 150px;">
                         <input type="date" name="dtto" class="form-control filter dtchange" data-filter_column="date_to"  placeholder="Search" id="dtto">
                       </div>

                       </div>

                 </div>
                 <div class="col-4">
                     <div class="card-tools">
      
                  <div class="input-group input-group-sm" style="width: 150px;">
                   <input type="text" name="table_search" class="form-control float-right" placeholder="Search" id="search">

                   <div class="input-group-append">
                     <button type="submit" class="btn btn-default"><i class="fas fa-search loader"></i></button>
                   </div>
                 </div>
                 </div>
                     
                  
               </div>

</div>



          
        </div>
        <div class="card-body">
  <table class="table table-head-fixed table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th class="text-center">Name</th>
                      <th>Type</th>
                      <th> Plan ID</th>
                      <th>Payment Method</th>
                      <th>Date Of Transaction</th>
                      <th>Renewal Date</th>
                    </tr>
                  </thead>
                 
                 @include('admin.subscription.table_data')
 
                 </td></tr>


                </table>
        </div>
        <!-- /.card-body -->
        

      </div>
      <!-- /.card -->




<div class="modal fade" id="modal-xl-details" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Extra Large Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              
             <div class="row">
         
          <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fas fa-info"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Stripe Id</span>
                <span class="info-box-number" id="stripe_id">0</span>
              </div>
             
            </div>
            
          </div>

          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="fas fa-info"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Payment Method Type</span>
                <span class="info-box-number" id="payment_method_type">0</span>
              </div>
             
            </div>
            
          </div>


          <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="fas fa-info"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Payment Method</span>
                <span class="info-box-number" id="payment_method">0</span>
              </div>
             
            </div>
            
          </div>


          <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-primary"><i class="fas fa-info"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Payment Intent</span>
                <span class="info-box-number" id="payment_intent">0</span>
              </div>
             
            </div>
            
          </div>


          <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="fas fa-info"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Fingerprint</span>
                <span class="info-box-number" id="fingerprint">0</span>
              </div>
             
            </div>
            
          </div>

          
          <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-secondary"><i class="fas fa-info"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Mandate</span>
                <span class="info-box-number" id="mandate">0</span>
              </div>
             
            </div>
            
          </div>


          <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="fas fa-info"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Subscription</span>
                <span class="info-box-number" id="subscription">0</span>
              </div>
             
            </div>
            
          </div>


          <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="fas fa-info"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Subscription Item</span>
                <span class="info-box-number" id="subscription_item">0</span>
              </div>
             
            </div>
            
          </div>
       
        
          <!-- /.col -->
        </div>






            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    </section>
    
@endsection

@section('optional_scripts')
<script src="{{asset('admin_assets/dist/js/ajaxsearch.js')}}"></script>

<script type="text/javascript">
 $(document).ready(function(){

 ajaxSearch().init("/admin/search_subscriptions");
     
     }); //on doc ready


// Date frtom on change
$( ".dtchange" ).change(function() {
  ajaxSearch().reload();
});


//Modal Related Js

  $('#modal-xl-details').on('show.bs.modal', function (event) {

  var button = $(event.relatedTarget) // Button that triggered the modal
  var subscription_item = button.data('subscription_item') 
  var subscription = button.data('subscription') 
  var mandate = button.data('mandate') 
  var fingerprint = button.data('fingerprint') 
  var payment_method_type = button.data('payment_method_type') 
  var payment_method = button.data('payment_method') 
  var payment_intent = button.data('payment_intent') 
  var stripe_id = button.data('stripe_id') 
  var uname = button.data('uname') 
  var modal = $(this)
  
  modal.find('.modal-title').text('Subsctiption Details For  : ' + uname + '( ' + stripe_id + ' )' );

  $.each(button.data(), function(i, v) {
   // console.log( '"' + i + '":"' + v + '",');
   if(v=="")
   {
    $('#'+i).closest('.col-md-4').hide();
   }
   else
   {
    if(i !='target' && i!="toggle")
    {
      // console.log((i) + " .. " + eval(i));
    modal.find('.modal-body #'+i).text(eval(i) );
    $('#'+i).closest('.col-md-4').show();
  
  }
   }
});



});

  $('#modal-edit-kind').on('hidden.bs.modal', function (e) {
  // ajaxSearch().reload();

});


</script>



@endsection