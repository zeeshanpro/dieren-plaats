var csrftokenval=$('meta[name="csrf-token"]').attr('content');
heartElement=null;
var textElement=null;
jQuery( ".act_saveme" ).click(function() {
 jQuery(this).toggleClass("active");
  var id = jQuery(this).data('id')
  heartElement=jQuery(this);
  saveforlater(id,funChangeHeartCss);
});

jQuery( ".act_saveme_addetail" ).click(function() {

  heartElement=jQuery(this).find('.bi-heart-fill');
   textElement=jQuery(this).find('span');
 
 heartElement.toggleClass("text-grey").toggleClass("text-red");
 if(heartElement.hasClass('text-red'))
    {
      textElement.html("Bewaar voor later");
      
    }
  else
  {
    textElement.html("Bewaar voor later");
   
  }

  var id = jQuery(this).data('id')
  console.log(id);
 
  saveforlater(id,funChangeHeartCssForAdDetailButton);
});


//save saveforlater ajax
function saveforlater(id,changeHeartCss)
{
 showLoader();
var jqxhr = $.ajax( {
  url: APP_URL+"/ad/saveforlater",
  method:"POST",
  data:{"adId":id},
  headers: { 'X-CSRF-TOKEN': csrftokenval }
  })
  .done(function(data) {
    hideLoader();
   if(data.code==201)
   {
   // console.log("success");
   }
   else
   {
    changeHeartCss();

   
   }
    
  })
  .fail(function(data) {
   changeHeartCss();
  hideLoader();
  });
}

function funChangeHeartCss()
{
    heartElement.toggleClass("active");  

}

function funChangeHeartCssForAdDetailButton()
{ 

    heartElement.toggleClass("text-grey").toggleClass("text-red");

    if(heartElement.hasClass('text-red'))
    {
      textElement.html("Saved for later");
    
    }
  else
  {
    textElement.html("Bewaar voor later");
  
  }

   

}