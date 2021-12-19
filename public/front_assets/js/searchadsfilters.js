

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
  


 $(document).on('click', '#customPrice', function(event){
     var minrangetext=$('#minrangetext').val(); 
       var maxrangetext=$('#maxrangetext').val();

       minrangetext = minrangetext.replace(/[^0-9]/g,''); 

    
       maxrangetext = maxrangetext.replace(/[^0-9]/g,'');
     

    if(minrangetext!="" && minrangetext>=0 && maxrangetext!="" && maxrangetext>=0)
    {
       $('.filter_tag:contains("Custom Price")').remove();
    
     $("#ftag").prepend('<div class="filter_tag mt-1">'+ "Custom Price" + ": " + minrangetext + "-" + maxrangetext + '<a href="javascript:void(0);" ><i class="bi bi-x filter_remove_custom" data-checkboxid="idnone" data-label="'  + minrangetext + "-" + maxrangetext +  '"></i></a></div>');

    }

    fetch_data();
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

var q=encodeURI($('#searchTop').val());
      $(".loader").toggleClass('d-none');
        $.ajax({
        url: urlRouteAdListFilter+add_filters() + "&q=" + q  ,
        success:function(data)
          {
            $(".loader").toggleClass('d-none'); 
            $(window).scrollTop( $(".loader").offset().top );
            $('#adDataContainer').replaceWith(function(){
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
    var options_string = '';
    $( ".filter" ).each(function( index ) {
      var filter_column = $(this).data('filter_column');
      var attributeTitle=$(this).data('belongs_to_attribute');
      //var element = $('[data-filter_column="' + filter_column + '"]');
      if( $(this).is(':checked')  && attributeTitle!="Price" &&  attributeTitle!="Kind"){ 
        var value = $(this).val();
        
          options_string += value + ",";
       
      }
    });
    filter_string+="?"+add_filterKind();
    filter_string += "&options=" + options_string.slice(0,-1);
     filter_string+="&sortby="+ $('#dropsort').val();
     console.log( filter_string+"&"+add_filters_price() );


    return filter_string+"&"+add_filters_price();
  }

  function add_filters_price()
  {
    var filter_string = "";
    
    var minrangetext=$('#minrangetext').val(); 
       var maxrangetext=$('#maxrangetext').val();
    var _array = [];
    $( ".filterprice" ).each(function( index ) {
      var filter_column = $(this).data('filter_column');
      var minrange = $(this).data('minrange');
      var maxrange = $(this).data('maxrange');
      
      
       minrangetext = minrangetext.replace(/[^0-9]/g,''); 

    
       maxrangetext = maxrangetext.replace(/[^0-9]/g,'');
     
      if( $(this).is(':checked') ){ 
        _array.push(minrange)
        _array.push(maxrange)
            }
    });
    if(minrangetext!="" && minrangetext>=0 && maxrangetext!="" && maxrangetext>=0)
    {
      if($('.filter_tag:contains("Custom Price")').length>0)
      {
      _array.push(minrangetext);
      _array.push(maxrangetext);

      }
    }

    if(_array.length>0)
    {
      maxrange=Math.max.apply(Math,_array); 
      minrange=Math.min.apply(Math,_array); 
    }
    else
    {
      maxrange=0;
      minrange=0;
    }

    filter_string += "pricerange=" + minrange+","+maxrange;
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