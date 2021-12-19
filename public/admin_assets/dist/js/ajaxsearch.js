var urlRoute
function ajaxSearch()
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





$('<input type="hidden" name="hidden_page" id="hidden_page" value="1" /><input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id" /><input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc" />').insertAfter('thead');

var css=`.spin {
       -webkit-animation:spin 4s linear infinite;
    -moz-animation:spin 4s linear infinite;
    animation:spin 1s linear infinite;
}
@-moz-keyframes spin { 
    100% { -moz-transform: rotate(360deg); } 
}
@-webkit-keyframes spin { 
    100% { -webkit-transform: rotate(360deg); } 
}
@keyframes spin { 
    100% { 
        -webkit-transform: rotate(360deg); 
        transform:rotate(360deg); 
    } 
}`;

$('head').append('<style type="text/css">.sorting{cursor: pointer;}.sorting i{display:inline;}\n'+ css+'</style>')

 function clear_icon()
 {
  var column_name = $('#hidden_column_name').val();
  $('#'+column_name+'_icon').html('');
  // $('#post_title_icon').html('');
 }

 function fetch_data(page, sort_type, sort_by, query)
 {
  if(query=="" || query==undefined)
    query="%";

  if($("#search").val().length < 3 && $("#search").val().length!=0 )
  {
    return;
  }
//console.log(add_filters());
    loadOnOff("on");
  $.ajax({
   url: urlRoute+"?page="+page+"&sortby="+sort_by+"&sorttype="+sort_type+"&query="+query+add_filters(),
   success:function(data)
   {
  
loadOnOff("off");
    $('tbody').replaceWith(function(){
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


 $(document).on('keyup', '#search', function(){
  var query = $('#search').val();
  var column_name = $('#hidden_column_name').val();
  var sort_type = $('#hidden_sort_type').val();
  var page = $('#hidden_page').val();
  fetch_data(page, sort_type, column_name, query);
 });

 $(document).on('click', '.sorting', function(){
  var column_name = $(this).data('column_name');
  var order_type = $(this).data('sorting_type');
  var reverse_order = '';
 
  if(order_type == 'asc')
  {
   $(this).data('sorting_type', 'desc');
   reverse_order = 'desc';
   clear_icon();
   $('#'+column_name+'_icon').html('<i class="fas fa-sort-down"></i>');
  }
  if(order_type == 'desc')
  {
   $(this).data('sorting_type', 'asc');
   reverse_order = 'asc';
   clear_icon();
   $('#'+column_name+'_icon').html('<i class="fas fa-sort-up"></i>');
  }
  $('#hidden_column_name').val(column_name);
  $('#hidden_sort_type').val(reverse_order);
  var page = $('#hidden_page').val();
  var query = $('#search').val();
  fetch_data(page, reverse_order, column_name, query);
 });

 $(document).on('click', '.pagination a', function(event){
  event.preventDefault();
  var page = $(this).attr('href').split('page=')[1];
  $('#hidden_page').val(page);
  var column_name = $('#hidden_column_name').val();
  var sort_type = $('#hidden_sort_type').val();

  var query = $('#search').val();

  $('li').removeClass('active');
        $(this).parent().addClass('active');
  fetch_data(page, sort_type, column_name, query);
 });


 function loadOnOff(action)
 {
  if(action=="on")
  {
  $(".loader").removeClass("fa-search").addClass("fa-circle-notch");
  $(".loader").addClass("spin");
}
  else if(action=="off")
  {
     $(".loader").removeClass("fa-circle-notch").addClass("fa-search");
     $(".loader").removeClass("spin");
   }
 }


function add_filters()
{
var filter_string="";
$( ".filter" ).each(function( index ) {
  
  var filter_column = $(this).data('filter_column');
    var value=$('[data-filter_column="' + filter_column + '"]').val();
filter_string+=filter_column+"="+value+"&";
   
});
if(filter_string!="")
{
filter_string="&"+ filter_string.slice(0,-1);
}
return filter_string;
}

