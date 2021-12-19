

  var urlRouteAdListFilter
function adListSearchFilter()
{
    const self=
    {
        init: (path)=>{
          urlRouteAdListFilter=path;
           
        },
         reload: ()=>{
          fetch_data();
           
        }

    }
    return self;

}
   $(document).on('click', '#customDate', function(event){
     var minrangetext=$('#minrangetext').val(); 
     var maxrangetext=$('#maxrangetext').val();

    if(minrangetext!="" && maxrangetext!="")
    {
       $('.filter_tag:contains("Date")').remove();
    
     $("#ftag").prepend('<div class="filter_tag mt-1">'+ "Date" + ": " + minrangetext + " To " + maxrangetext + '<a href="javascript:void(0);" ><i class="bi bi-x filter_remove_custom" data-checkboxid="idnone" data-label="'  + minrangetext + " To " + maxrangetext +  '"></i></a></div>');
     fetch_data();
    }
    else
    {
      alert("Please enter Date Range To Apply Date Search.");
    }

   
   });

   $(document).on('click', '.filter_remove_custom', function(event){
    var label=$(this).data('label');
    $('.filter_tag:contains("' + label + '")').remove();
    $('#minrangetext').val(""); 
     $('#maxrangetext').val("");

    fetch_data();
    
  });





    $(document).on('change', '.filterKind', function(event){
   $('.filter_tag:contains("Kind")').remove();
   });    
    $(document).on('change', '.filterComingmonth', function(event){
    $('.filter_tag:contains("Month")').remove();
   });

  $(document).on('change', '.filter', function(event){
    fetch_data();
   });

  $(document).on('change', '#dropsort', function(event){
    fetch_data();
   });

  $(document).on('change', '.filter', function(event){
    var checkboxId=$(this).attr("id");
    var attributeTitle=$(this).data('belongs_to_attribute');
   

     var label=($("label[for='" + checkboxId + "']").get(0).innerText);
     
     //remove data in brackets
     var part = label.substring(
    label.lastIndexOf("(") + 1, 
    label.lastIndexOf(")")
      );
    label=label.replace("("+ part +")", "");
     // code for remove data in brackets ends here


    if( $(this).is(':checked') ){ 
   $("#ftag").prepend('<div class="filter_tag mt-1">'+ attributeTitle + ": " + label + '<a href="javascript:void(0);" ><i class="bi bi-x filter_remove" data-checkboxid="' + checkboxId + '" data-label="' + label + '"></i></a></div>');
    }
    else
    {
      $('.filter_tag:contains("' + label + '")').remove();
    }

  });

$(document).on('click', '.filter_remove', function(event){
    var label=$(this).data('label');
    var checkboxId=$(this).data('checkboxid');

    $('.filter_tag:contains("' + label + '")').remove();
    $('#'+checkboxId).prop('checked', false); // Unchecks it

    fetch_data();
    
  });

  function fetch_data()
  { 

    console.log(urlRouteAdListFilter+add_filters());
      $(".loader").toggleClass('d-none');
        $.ajax({
        url: urlRouteAdListFilter+add_filters(),
        success:function(data)
          {
            $(".loader").toggleClass('d-none'); 
            $(window).scrollTop( $(".loader").offset().top );
            $('#ebDataContainer').replaceWith(function(){
            return data;
            });
          }
        }).fail(function() {
        $(".loader").addClass('d-none');
      })
  }


  $(document).on('click', '#clearall', function(event){
    $('input:checkbox').each(function () { $(this).prop('checked', false); });
    $('input:radio').each(function () { $(this).prop('checked', false); });
      $('#minrangetext').val(""); 
     $('#maxrangetext').val("");
     $('.filter_tag').remove();
     fetch_data();
  });



  function add_filters()
  {
    var filter_string = "";
  
  filter_string+=add_filterKind();
  filter_string+="&"+add_filterRace();
  filter_string+="&"+add_filterMonth();
  filter_string+="&"+add_filterSubscription();
  filter_string+="&sortby="+ $('#dropsort').val();
     

    return filter_string;
  }



   function add_filterKind()
  {
    var filter_string = "";
    var options_string = '';
    $( ".filterKind" ).each(function( index ) {
      var filter_column = $(this).data('filter_column');
      var attributeTitle=$(this).data('belongs_to_attribute');
     
      if( $(this).is(':checked')){ 
        var value = $(this).val();
        
          options_string += value ;
       
      }
    });
    filter_string += "kindId=" + options_string;
   
     


    return filter_string;
  }
   function add_filterRace()
  {
    var filter_string = "";
    var options_string = '';
    $( ".filterRace" ).each(function( index ) {
      var filter_column = $(this).data('filter_column');
      var attributeTitle=$(this).data('belongs_to_attribute');
     
      if( $(this).is(':checked')){ 
        var value = $(this).val();
        
          options_string += value+ ","; 

  
       
      }
    });

    filter_string += "raceId=" + options_string.slice(0,-1);
   
        return filter_string;
  }
  
     function add_filterMonth()
  {
    var filter_string = "";
    var options_string = '';
    var minrangetext=$('#minrangetext').val(); 
    var maxrangetext=$('#maxrangetext').val();
    var dateRange="";
    $( ".filterComingmonth" ).each(function( index ) {
      var filter_column = $(this).data('filter_column');
      var attributeTitle=$(this).data('belongs_to_attribute');
     
      if( $(this).is(':checked')){ 
        var value = $(this).val();
        
          options_string += value ;
       
      }
    });
    if(minrangetext!="" && maxrangetext!="")
    {
      dateRange=minrangetext+","+maxrangetext;
    }
    filter_string += "month=" + options_string + "&date="+dateRange;
   
        return filter_string;
  }
  

     function add_filterSubscription()
  {
    var filter_string = "";
    var options_string = '';
    $( ".filterSubscription" ).each(function( index ) {
      var filter_column = $(this).data('filter_column');
      var attributeTitle=$(this).data('belongs_to_attribute');
     
      if( $(this).is(':checked')){ 
        var value = $(this).val();
        
          options_string += value+"," ;
       
      }
    });
    filter_string += "subscription=" + options_string.slice(0,-1);
   
        return filter_string;
  }
  


  // function add_filters()
  // {
  //   var filter_string = "";
  //   var options_string = '';
  //   $( ".filter" ).each(function( index ) {
  //     var filter_column = $(this).data('filter_column');
  //     var attributeTitle=$(this).data('belongs_to_attribute');
  //     //var element = $('[data-filter_column="' + filter_column + '"]');
  //     if( $(this).is(':checked')  && attributeTitle!="Price"){ 
  //       var value = $(this).val();
        
  //         options_string += value + ",";
       
  //     }
  //   });
  //   filter_string += "options=" + options_string.slice(0,-1);
  //    filter_string+="&sortby="+ $('#dropsort').val();
  //    console.log( filter_string );


  //   return filter_string;
  // }