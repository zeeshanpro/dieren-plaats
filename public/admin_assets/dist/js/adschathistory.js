var urlRoute
function chatLoader()
{
    const self=
    {
        init: (path)=>{
          urlRoute=path;
           
        },
         reload: ()=>{
          reloadData();
           
        }

    }
    return self;

}




$(document).on('click', '.chatmember', function(event) {
  event.preventDefault();
var adid=$(this).data('adid');
var userid=$(this).data('userid');
fetch_data(userid,adid);

});
 function fetch_data(userid,adid)
 {
  
 
    
  $.ajax({
   url: urlRoute+"?userid="+userid+"&adid="+adid,
   success:function(data)
   {
  

    $('.direct-chat-messages').replaceWith(function(){
    return data;
});

   }
  })
 }

function reloadData()
{

  var query = $('#search').val();
  var column_name = $('#hidden_column_name').val();
  var sort_type = $('#hidden_sort_type').val();
  var page = $('#hidden_page').val();
  fetch_data(page, sort_type, column_name, query);


}


