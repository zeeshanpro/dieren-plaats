 
  jQuery(document).on('click', '.subscribeBtn', function(event) {
    event.preventDefault();
    var csrftokenval=$('meta[name="csrf-token"]').attr('content');
    var responsemsgs=jQuery(this);
    
   var id=jQuery(this).data('id');
showLoader();
var jqxhr = $.ajax( {
  url: 'expectedad/subscribe',
  method:"POST",
  data:{"expectedAdId":id},
  headers: { 'X-CSRF-TOKEN': csrftokenval }
  })
  .done(function(data) {
    hideLoader();
   if(data.code==201)
   {
   // console.log("success");
   if(data.msg=="Unsubscribed Successfully")
     { 
      responsemsgs.removeClass('btn-primary').addClass('btn-success');
           responsemsgs.html("Subscribe");
         }
    else
{  
  responsemsgs.removeClass('btn-success').addClass('btn-primary');
  responsemsgs.html("Subscribed");
}
   }
   else
   {
      
  
   }
    
  })
  .fail(function(data) {
    hideLoader();
  
  
  });

  });


 