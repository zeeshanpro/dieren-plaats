$(document).ready(function() {


ajaxSearch().init("/admin/search_kind");
     
toastr.options = {
  "progressBar": true,
  "timeOut": "3000"
}

var csrftokenval=$('meta[name="csrf-token"]').attr('content');
var spinner = $('#loader');



$("#kindImageUpload").click(function() {
    $("#kind_file").click();
});

$('#kind_file').change(function(e){
  var $in=$(this);
  $('#kindfilename').html($in[0].files[0].name);
  console.log($in[0].files[0]);
    $('#kindfilenamediv').show();
    
});



$("#kindIconImageUpload").click(function() {
    $("#kind_icon_file").click();
});

$('#kind_icon_file').change(function(e){
  var $in=$(this);
  $('#kindiconfilename').html($in[0].files[0].name);
   $('#kindiconfilenamediv').show();
});


function resetFormKindAfterSave()
{
   $('#kindiconfilename').html("");
   $('#kindfilename').html("");
    $('#kindform').trigger("reset");
    $('#kindfilenamediv').hide();
    $('#kindiconfilenamediv').hide();

}



$(document).on("click", '#addNewKind', function(event) { 
   event.preventDefault();
   $('#kindform').submit();
});



$('#kindform').on('submit',(function(e) {
   e.preventDefault();
  var formData = new FormData(this);


var kindTitle=$('#newKindValue').val();

  if(kindTitle.trim()=="")
   {
    toastr.error('Field Must Enter Kind Title');
    return;
   }
   spinner.show();
var jqxhr = $.ajax( {
  url: "create_kind",
  method:"POST",
  data: formData,
  cache:false,
  contentType: false,
  processData: false,
  headers: { 'X-CSRF-TOKEN': csrftokenval }
  })
  .done(function(data) {
    console.log(data);
    spinner.hide();
   if(data.code==201)
   {
    toastr.success('Kind Saved Successfuly');
    resetFormKindAfterSave();
   }
   else
   {
    toastr.error(data.msg);
   }
    
     ajaxSearch().reload();
  })
  .fail(function(data) {
    spinner.hide();
    console.log(data);
toastr.error('Kind Not Saved');
  });

}));     



// Delete Race

//delete Race ajax
function deleteKind(kindid)
{
 
  // toastr.info("Delete "+id);
   
   if(kindid=="")
   {
    toastr.error('Field Must Have ID');
    return;
   }
  spinner.show();
var jqxhr = $.ajax( {
  url: "delete_kind",
  method:"POST",
  data:{"kindid":kindid},
  headers: { 'X-CSRF-TOKEN': csrftokenval }
  })
  .done(function(data) {
    
    spinner.hide();
   if(data.code==201)
   {
    toastr.success('Kind Deleted Successfuly');
   }
   else
   {
    toastr.error(data.msg);
   }
     ajaxSearch().reload();
  })
  .fail(function(data) {
   spinner.hide();
   console.log(data);
  toastr.error('Kind Not Deleted');
  });
}   

//delete Race
$(document).on("click", '.deleteKind', function(event) { 
   event.preventDefault();
   deleteKind($(this).data('kindid'));
});






// Edit section

$("#kindImageEditUpload").click(function() {
    $("#kind_edit_file").click();
});

$('#kind_edit_file').change(function(e){
  var $in=$(this);
  $('#kindeditfilename').html($in[0].files[0].name);
});

$("#kindImageIconEditUpload").click(function() {
    $("#kind_icon_edit_file").click();
});

$('#kind_icon_edit_file').change(function(e){
  var $in=$(this);
  $('#kindiconeditfilename').html($in[0].files[0].name);
});


function resetFormKindAfterEdit()
{
   $('#kindiconeditfilename').html("");
   $('#kindeditfilename').html("");
    $('#kindeditform').trigger("reset");
}



$(document).on("click", '#editKind', function(event) { 
   event.preventDefault();

   $('#kindeditform').submit();
});


// Update Kind

$('#kindeditform').on('submit',(function(e) { 
e.preventDefault();
  /* Act on the event */
var formData = new FormData(this);
var kindid=$('.modal-body #kindUpdateId').val();
var kindtitle=$('.modal-body #kindUpdateTitle').val();
if(kindtitle.trim()=="" || kindid=="")
   {
    toastr.error('Field Must Enter Kind Title');
    return;
   }
spinner.show();
var jqxhr = $.ajax( {
  url: "update_kind",
  method:"POST",
  data: formData,
  cache:false,
  contentType: false,
  processData: false,
  headers: { 'X-CSRF-TOKEN': csrftokenval }
  })
  .done(function(data) {
   if(data.code==201)
   {
    toastr.success('Kind Updated Successfuly');
    resetFormKindAfterEdit();
   }
   else
   {
    toastr.error(data.msg);
   }
   spinner.hide();
    $('#modal-edit-kind').modal('hide');
     ajaxSearch().reload();
  })
  .fail(function(data) {
    console.log(data.responseJSON.message);
    toastr.error('Kind Not Updated');
    spinner.hide();
  });

}));     




//Update new Race dialog

  
  $('#modal-edit-kind').on('show.bs.modal', function (event) {
    $('#kindeditfilename').html("");
    $('#kindiconeditfilename').html("");
  var button = $(event.relatedTarget) // Button that triggered the modal
  var kid = button.data('kindid') // Extract info from data-* attributes
  var ktitle = button.data('kindtitle') // Extract info from data-* attributes
  var currImage = button.data('currimage') // Extract info from data-* attributes
  var currIconImage = button.data('curriconimage') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  
  modal.find('.modal-title').text('Update Kind : ' + ktitle + ' ( ' + kid+' )' )
  modal.find('.modal-body #kindUpdateTitle').val(ktitle)
  modal.find('.modal-body #kindUpdateId').val(kid);
 // modal.find('.modal-body #kindUpdateImagePreview').src("storage/app/public/uploads/ads/thumb/"+currImage);
 modal.find('.modal-body #kindUpdateImagePreview').attr('src', "../storage/app/public/uploads/kind/thumb/"+currImage);
 modal.find('.modal-body #kindUpdateImageIconPreview').attr('src', "../storage/app/public/uploads/kindicon/thumb/"+currIconImage);

});

  $('#modal-edit-kind').on('hidden.bs.modal', function (e) {
  // ajaxSearch().reload();

});

	

});


