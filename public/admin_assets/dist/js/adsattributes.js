
 $(document).ready(function(){


 ajaxSearch().init("/admin/search_attributes");
     
toastr.options = {
  "progressBar": true,
  "timeOut": "3000"
}

var csrftokenval=$('meta[name="csrf-token"]').attr('content');
var spinner = $('#loader');

// Add new options

$('#addMoreOptions').on('click', function(event) {
  event.preventDefault();
  /* Act on the event */




var optid=$('.modal-body #optionUpdateId').val();
var opttitle=$('.modal-body #optionUpdateTitle').val();

var jqxhr = $.ajax( {
  url: "update_attribute_add_option",
  method:"POST",
  data:{"optid":optid,"title":opttitle},
  headers: { 'X-CSRF-TOKEN': csrftokenval }
  })
  .done(function(data) {
   if(data.code==201)
   {
    toastr.success('Option Saved Successfuly');
   }
   else
   {
    toastr.error(data.msg.title);
   }
    $('#modal-add-option').modal('hide');
     ajaxSearch().reload();
  })
  .fail(function(data) {
    console.log(data.responseJSON.message);
toastr.error('Option Not Saved');
  });

});     

     

//delete option
function deleteAttributeOption(optionid,attributeid)
{

  // toastr.info("Delete "+id);
   
   if(optionid=="" || attributeid=="")
   {
    toastr.error('Field Must Have ID');
    return;
   }
   spinner.show();
var jqxhr = $.ajax( {
  url: "attribute_delete_option",
  method:"POST",
  data:{"optionid":optionid,"attributeid":attributeid},
  headers: { 'X-CSRF-TOKEN': csrftokenval }
  })
  .done(function(data) {
    spinner.hide();
   if(data.code==201)
   {
    toastr.success('Option Deleted Successfuly');
   }
   else
   {
    toastr.error(data.msg);
   }
     ajaxSearch().reload();
  })
  .fail(function(data) {
   spinner.hide();
   console.log(data.responseJSON.message);
  toastr.error('Option Not Deleted');
  });
}    

// delete attribute options
$(document).on("click", '.deleteAttributeOptions', function(event) { 
   deleteAttributeOption($(this).data('optionid'),$(this).data('attributeid'));
});




//delete Attribute ajax
function deleteAttribute(attributeid)
{
   spinner.show();
  // toastr.info("Delete "+id);
   
   if(attributeid=="")
   {
    toastr.error('Field Must Have ID');
    return;
   }

var jqxhr = $.ajax( {
  url: "attribute_delete",
  method:"POST",
  data:{"attributeid":attributeid},
  headers: { 'X-CSRF-TOKEN': csrftokenval }
  })
  .done(function(data) {
    
    spinner.hide();
   if(data.code==201)
   {
    toastr.success('Attribute Deleted Successfuly');
   }
   else
   {
    toastr.error(data.msg);
   }
     ajaxSearch().reload();
  })
  .fail(function(data) {
   spinner.hide();
   console.log(data.responseJSON.message);
  toastr.error('Attribute Not Deleted');
  });
}   

//delete Attribute
$(document).on("click", '.deleteAttribute', function(event) { 
   event.preventDefault();
   deleteAttribute($(this).data('attributeid'));
});














//Edit option
function editAttributeOption(optionid,attributeid)
{
  
    var optionTitleValue=$('#optionTitleValue-'+optionid).val();
   if(optionid=="" || optionTitleValue.trim()=="" || attributeid=="")
   {
    toastr.error('Field Must Be Filled');
    return;
   }
 spinner.show();
   var jqxhr = $.ajax( {
  url: "attribute_update_option",
  method:"POST",
  data:{"optionid":optionid,"title":optionTitleValue,"attributeid":attributeid},
  headers: { 'X-CSRF-TOKEN': csrftokenval }
  })
  .done(function(data) {
    
    spinner.hide();
   if(data.code==201)
   {
    toastr.success('Attribute Option Updated Successfuly');
   }
   else
   {
    toastr.error(data.msg);
   }
     ajaxSearch().reload();
  })
  .fail(function(data) {
   spinner.hide();
   console.log(data.responseJSON.message);
  toastr.error('Attribute Option Updated Not Updated');
  });



 

}    

$(document).on("click", '.updateAttributeOptions', function(event) { 
editAttributeOption($(this).data('optionid'),$(this).data('attributeid'));
});
















//Edit Attribute
function editAttribute(attributeid)
{
  
   var attributeTitleValue=$('#attributeTitleValue-'+attributeid).val();
   if(attributeTitleValue.trim()=="" || attributeid=="")
   {
    toastr.error('Field Must Be Filled');
    return;
   }
 spinner.show();
   var jqxhr = $.ajax( {
  url: "attribute_update",
  method:"POST",
  data:{"title":attributeTitleValue,"attributeid":attributeid},
  headers: { 'X-CSRF-TOKEN': csrftokenval }
  })
  .done(function(data) {
    
    spinner.hide();
   if(data.code==201)
   {
    toastr.success('Attribute Updated Successfuly');
   }
   else
   {
    toastr.error(data.msg);
   }
     ajaxSearch().reload();
  })
  .fail(function(data) {
   spinner.hide();
   console.log(data.responseJSON.message);
  toastr.error('Attribute Updated Not Updated');
  });



}    



$(document).on("click", '.editAttribute', function(event) { 
editAttribute($(this).data('attributeid'));
});

//Save New Attribute
function saveNewAttribute()
{
  var newAttributeKind=$('#newAttributeKind').val();
  var newAttributeAttribute=$('#newAttributeAttribute').val();
  var newAttributeOptions=$('#newAttributeOptions').val();

  if(newAttributeKind.trim() =="" || newAttributeAttribute.trim() =="" || newAttributeOptions.trim() =="")
  {
    toastr.error('All Feilds Are Required');
    return;
  }
spinner.show();
  // toastr.info("Edit Attribute "+id);
  var jqxhr = $.ajax( {
  url: "create_attributes",
  method:"POST",
  data:{"title":newAttributeAttribute,"kind_id":newAttributeKind,"options":newAttributeOptions},
  headers: { 'X-CSRF-TOKEN': csrftokenval }
  })
  .done(function(data) {
   if(data.code==201)
   {
    toastr.success('Attribute Saved Successfuly');
   }
   else
   {
    toastr.error(data.msg);
   }
    spinner.hide();
     ajaxSearch().reload();
  })
  .fail(function(data) {
// console.log(data.responseJSON.message);
toastr.error('Option Not Saved');
spinner.hide();

  });
}    


$('#saveNewAttribute').on('click',function(event){

saveNewAttribute();
});





//add new option dialog

  
  $('#modal-add-option').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var aid = button.data('attributeid') // Extract info from data-* attributes
  var atitle = button.data('attributetitle') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('Update  : ' + atitle + ' ( ' + aid+' )' )
  modal.find('.modal-body input').val("")
  modal.find('.modal-body #optionUpdateId').val(aid);

});

  $('#modal-add-option').on('hidden.bs.modal', function (e) {
  // ajaxSearch().reload();

});


 }); //on doc ready