<?php $publicPath = env('ASSETS_PATH'); ?>
  <?php $__env->startSection('optional_css'); ?>
      <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
      
  <?php $__env->stopSection(); ?>
<?php $__env->startSection('container'); ?>

<div class="inner_page_content_area">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-12">
                   <h2 class="border rounded  p-5 text-center">Binnenkort beschikbaar !</h2>
                </div>
        </div>


          

              
          </div>
      </div>
  </div> 

  <?php $__env->stopSection(); ?>
<?php $__env->startSection('optional_scripts'); ?>
  <script type="text/javascript">


  function fetch_data()
  { 
    $(".loader").toggleClass('d-none');
    $.ajax({
    url: "<?php echo e(route('search_breeders')); ?>?query=data"+add_filters(),
    success:function(data)
      {
        $(".loader").toggleClass('d-none'); 
        $(window).scrollTop( $(".loader").offset().top );
        $('#breederDataContainer').replaceWith(function(){
        return data;
        });


      }
    }).fail(function() {
   $(".loader").addClass('d-none');
  })
  }


  $(document).on('click', '#clearall', function(event){
    $('input:radio').each(function () { $(this).prop('checked', false); });
    fetch_data();
  });


  $(document).on('change', '.filter', function(event){
    fetch_data();
  });

  function add_filters()
  {
    var filter_string="";
    $( ".filter" ).each(function( index ) {
      var filter_column = $(this).data('filter_column');
      var element = $('[data-filter_column="' + filter_column + '"]');
      if( $(this).is(':checked') ){ 
        var value = $(this).val();
        filter_string += filter_column + "=" + value + "&";
      }
    });
    if( filter_string != "" )
    {
      filter_string="&"+ filter_string.slice(0,-1);
    }
    return filter_string;
  }
  </script>

   <?php $__env->stopSection(); ?>
<?php echo $__env->make('front/layout/layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dierenlara/domains/dieren-plaats.nl/public_html/resources/views/front/profile/breederList.blade.php ENDPATH**/ ?>