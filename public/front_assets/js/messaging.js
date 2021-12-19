 var leftCurrentElement=null;
 var loopRequest = null;
 jQuery(document).ready(function() {
 
     jQuery(document).on('click', '.message', function(event) {
         event.preventDefault();
         leftCurrentElement = jQuery(this);

$('.message').each(function(index) {
     $('.message').removeClass("active");
});

 leftCurrentElement.addClass("active");
         var currentElement = leftCurrentElement;
         

         var adId = currentElement.data('adid');
         var lastMsgId = currentElement.data('lastmsgid');
 // $("#newMsgCircle").addClass("d-none");
         fetch_message_first_time(adId, lastMsgId);
     });
     //Send Message
     jQuery(document).on('click', '#sendMessage', function(event) {
         event.preventDefault();
         var msg = $('#msgInputArea').val();
         if (msg.trim() == "") return;
         var currentElement = jQuery(this);
         var adId = currentElement.data('adid');
         var lastMsgId = currentElement.data('lastmsgid');
         send_message(adId, lastMsgId, msg);
     });
 });

 function send_message(adId, lastMsgId, msg) {
     if (adId == "" ||  msg.trim() == "") return;
     var textArea = $('#msgInputArea');
     var csrftokenval = $('meta[name="csrf-token"]').attr('content');
     var responsemsgs = jQuery(this);
     $(".loader").toggleClass('d-none');
     var jqxhr = $.ajax({
         url: '/sendConversationMsg',
         beforeSend : function()    {  
                 
                if(loopRequest != null) 
                {
                    loopRequest.abort();

                }
            
                                    },
         method: "POST",
         data: {
             "adId": adId,
             "lastMsgId": lastMsgId,
             "msg": msg,
         },
         headers: {
             'X-CSRF-TOKEN': csrftokenval
         }
     }).done(function(data) {
         $(".loader").toggleClass('d-none');
         if(data.lastMsgId)
         {
          $("#sendMessage").attr('data-lastmsgid', data.lastMsgId);
          $("#sendMessage").data('lastmsgid', data.lastMsgId);
             var element = document.getElementById( $('#base_container').val() ); 
            element.setAttribute("data-lastmsgid", data.lastMsgId);
            // leftCurrentElement.attr('data-lastmsgid', data.lastMsgId);
            // leftCurrentElement.data('lastmsgid', data.lastMsgId);
          $('#screenMsg').append('<div class="received"><div class="text">' + msg + '</div></div>');
         textArea.val("");
         // $("#screenMsg").animate({ scrollTop: $('#screenMsg').prop("scrollHeight")}, 1000);
         $("#screenMsg").scrollTop($('#screenMsg').prop("scrollHeight"));
         }
        
     }).fail(function(data) {
         $(".loader").addClass('d-none');
     });
 }

 function fetch_message_first_time(adId, lastMsgId) {
     if (adId == "" ) return;
     var csrftokenval = $('meta[name="csrf-token"]').attr('content');
     var responsemsgs = jQuery(this);
     $(".loader").toggleClass('d-none');
     var jqxhr = $.ajax({
         url: '/getConversationDetails',
         method: "POST",
         data: {
             "adId": adId,
             "lastMsgId": lastMsgId,
         },
         headers: {
             'X-CSRF-TOKEN': csrftokenval
         }
     }).done(function(data) {
         $(".loader").toggleClass('d-none');
         $('#messageRightSection').replaceWith(function() {
             return data;
         });
         
         leftCurrentElement.find('.newMsgCircle').addClass('d-none');
         $("#screenMsg").animate({ scrollTop: $('#screenMsg').prop("scrollHeight")}, 1000);
     }).fail(function(data) {
         $(".loader").addClass('d-none');
     });
 }



 function fetch_message_only() {
 
     var adId = $("#sendMessage").data('adid');
     var lastMsgId = $("#sendMessage").data('lastmsgid');

     
     if (adId == "" || lastMsgId == "" || adId == 0 || lastMsgId == 0 || adId == undefined || lastMsgId == "undefined") return;
     // console.log("Last msg id "+lastMsgId);
     var csrftokenval = $('meta[name="csrf-token"]').attr('content');
     var responsemsgs = jQuery(this);
     if( $.hasAjaxRunning()) 
     {
        console.log("Skipping This Time As Some Ajax Call Is Already Running");
        return;
     }
     loopRequest = $.ajax({
         url: '/getLatestConversationMsg',
         method: "POST",
         data: {
             "adId": adId,
             "lastMsgId": lastMsgId,
         },
         headers: {
             'X-CSRF-TOKEN': csrftokenval
         }
     }).done(function(data) {
    
    if(data.newMsgCount>0)
    {
        var typeOfMsg = "";
      data.result.forEach(function(finalData) {
       console.log(finalData);
       if( usertype == "Seller" ){
            if( finalData.ifsent == 1 ){
                typeOfMsg = "sent";
            } else {
                typeOfMsg = "received";
            }
       } else {
            if( finalData.ifsent == 1 ){
                typeOfMsg = "received";
            } else {
                typeOfMsg = "sent";
            }
       }

    $('#screenMsg').append('<div class="'+typeOfMsg+'"><div class="text">'+ finalData.msg +'</div></div>'); 

    $("#sendMessage").attr('data-lastmsgid', finalData.id);
    $("#sendMessage").data('lastmsgid', finalData.id);

    var element = document.getElementById( $('#base_container').val() ); 
    element.setAttribute("data-lastmsgid", finalData.id);
     // leftCurrentElement.attr('data-lastmsgid',  finalData.id);
     // leftCurrentElement.data('lastmsgid',  finalData.id);
    $("#screenMsg").animate({ scrollTop: $('#screenMsg').prop("scrollHeight")}, 1000);
      });

    }
        

     }).fail(function(data) {
         
     });

 }
 setInterval(function(){ fetch_message_only(); }, 10000);


$(function() {
    window.ajax_loading = false;
    $.hasAjaxRunning = function() {
        return window.ajax_loading;
    };
    $(document).ajaxStart(function() {
        window.ajax_loading = true;
        
    });
    $(document).ajaxStop(function() {
        window.ajax_loading = false;
        loopRequest=null;
       
    });
});