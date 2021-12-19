 jQuery(document).on('click', '#subsubmit', function(event) {
    event.preventDefault();
    var csrftokenval=$('meta[name="csrf-tokenbase"]').attr('content');
    var responsemsgs=jQuery("#submsg");
       responsemsgs.text("");
    
   var id=jQuery("#subemail").val();
   if(id.trim()=="")
   {
    responsemsgs.text('Please enter Email address');
    return;
   }

var jqxhr = $.ajax( {
  url: '/email_subscribe',
  method:"POST",
  data:{"email":id},
  headers: { 'X-CSRF-TOKEN': csrftokenval }
  })
  .done(function(data) {
   if(data.code==201)
   {
   // console.log("success");
    responsemsgs.text(data.msg);
   }
    else
{  
 responsemsgs.text(data.msg);
}   
  })
  .fail(function(data) {
    
  responsemsgs.text(data.msg);
  
  }).always(function() {
    $( "#mc-embedded-subscribe-form").submit();
  });

  });