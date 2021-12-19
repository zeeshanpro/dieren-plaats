$(document).ready(function() {


ajaxSearch().init("/admin/search_races");
     
toastr.options = {
  "progressBar": true,
  "timeOut": "3000"
}

var csrftokenval=$('meta[name="csrf-token"]').attr('content');
var spinner = $('#loader');


$('#addNewRace').on('click', function(event) {
  event.preventDefault();
  /* Act on the event */

var raceTitle=$('#newRaceValue').val();
var raceKindId=$('#newAttributeKind').val();
  if(raceTitle.trim()=="" && raceKindId=="")
   {
    toastr.error('Field Must Enter Race Title And Kind');
    return;
   }
   spinner.show();
var jqxhr = $.ajax( {
  url: "create_race",
  method:"POST",
  data:{"title":raceTitle,"kindid":raceKindId},
  headers: { 'X-CSRF-TOKEN': csrftokenval }
  })
  .done(function(data) {
    spinner.hide();
   if(data.code==201)
   {
    toastr.success('Race Saved Successfuly');
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
toastr.error('Race Not Saved');
  });

});     



// Delete Race

//delete Race ajax
function deleteRace(Raceid)
{
   spinner.show();
  // toastr.info("Delete "+id);
   
   if(Raceid=="")
   {
    toastr.error('Field Must Have ID');
    return;
   }

var jqxhr = $.ajax( {
  url: "delete_race",
  method:"POST",
  data:{"raceid":Raceid},
  headers: { 'X-CSRF-TOKEN': csrftokenval }
  })
  .done(function(data) {
    
    spinner.hide();
   if(data.code==201)
   {
    toastr.success('Race Deleted Successfuly');
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
  toastr.error('Race Not Deleted');
  });
}   

//delete Race
$(document).on("click", '.deleteRace', function(event) { 
   event.preventDefault();
   deleteRace($(this).data('raceid'));
});










// Update Race

$('#editRace').on('click', function(event) {
  event.preventDefault();
  /* Act on the event */

var raceid=$('.modal-body #raceUpdateId').val();
var racetitle=$('.modal-body #raceUpdateTitle').val();
var raceKindId=$('#updateAttributeKind').val();
if(racetitle.trim()=="" || raceid=="" || raceKindId=="" )
   {
    toastr.error('Field Must Enter Race Title And Kind');
    return;
   }

var jqxhr = $.ajax( {
  url: "update_race",
  method:"POST",
  data:{"raceid":raceid,"title":racetitle,"kindid":raceKindId},
  headers: { 'X-CSRF-TOKEN': csrftokenval }
  })
  .done(function(data) {
   if(data.code==201)
   {
    toastr.success('Race Updated Successfuly');
   }
   else
   {
    toastr.error(data.msg);
   }
    $('#modal-edit-race').modal('hide');
     ajaxSearch().reload();
  })
  .fail(function(data) {
    console.log(data.responseJSON.message);
toastr.error('Race Not Updated');
  });

});     




//Update new Race dialog

  
  $('#modal-edit-race').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var rid = button.data('raceid') // Extract info from data-* attributes
  var rtitle = button.data('racetitle') // Extract info from data-* attributes
  var rkindid = button.data('kindid') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('Update Race : ' + rtitle + ' ( ' + rid+' )' )
  modal.find('.modal-body input').val(rtitle)
  modal.find('.modal-body #raceUpdateId').val(rid);
  $("#updateAttributeKind").val(rkindid).change();

});

  $('#modal-edit-race').on('hidden.bs.modal', function (e) {
  // ajaxSearch().reload();

});

	

});


