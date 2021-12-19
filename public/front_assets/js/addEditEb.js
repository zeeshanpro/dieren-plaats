//Delete Expected Baby
jQuery(document).on('click', '#ebDelete', function(event) {
    event.preventDefault();
    var csrftokenval = $('meta[name="csrf-token"]').attr('content');
    var responsemsgs = jQuery(this);
    var id = jQuery(this).data('id');
    var jqxhr = $.ajax({
        url: 'expectedad/delete',
        method: "POST",
        data: {
            "expectedId": id
        },
        headers: {
            'X-CSRF-TOKEN': csrftokenval
        }
    }).done(function(data) {
        if (data.code == 201) {
            // console.log("success");
             setTimeout(function() {
                            window.location.reload();
                          }, 500);

        } else {}
    }).fail(function(data) {});
});
//Image Preview Script
function imageFileAndPreview(Ffile, previewHolder, filenameLabel) {
    var $in = $(Ffile);
    const file = $in[0].files[0];
    jQuery(filenameLabel).html(file.name);
    if (file.type == "image/jpeg" || file.type == "image/png") {
        let reader = new FileReader();
        reader.onload = function(event) {
            $(previewHolder).attr('src', event.target.result);
        }
        reader.readAsDataURL(file);
    } else {
        $('<div>Invalid Format</div>').insertAfter(filenameLabel).delay(3000).fadeOut();
        console.log("Invalid Format");
    }
}
jQuery(document).ready(function() {
    jQuery("#logoFileMother").click(function(e) {
        jQuery("#logoFileMotherHidden").click();
    });
    jQuery('#logoFileMotherHidden').change(function(e) {
        imageFileAndPreview(this, '#imgMotherPreview', '#logoFilenameMother');
    });
    //Edit Mother File Treatment
    jQuery("#edlogoFileMother").click(function(e) {
        jQuery("#edlogoFileMotherHidden").click();
    });
    jQuery('#edlogoFileMotherHidden').change(function(e) {
        imageFileAndPreview(this, '#edimgMotherPreview', '#edlogoFilenameMother');
    });
});
jQuery(document).ready(function() {
    jQuery("#logoFileFather").click(function(e) {
        jQuery("#logoFileFatherHidden").click();
    });
    jQuery('#logoFileFatherHidden').change(function(e) {
        imageFileAndPreview(this, '#imgFatherPreview', '#logoFilenameFather');
    });
    //Edit Father File Treatment
    jQuery("#edlogoFileFather").click(function(e) {
        jQuery("#edlogoFileFatherHidden").click();
    });
    jQuery('#edlogoFileFatherHidden').change(function(e) {
        imageFileAndPreview(this, '#edimgFatherPreview', '#edlogoFilenameFather');
    });
    //=================================================
    //Add New Expected Babies
    $(document).on("click", '#btnAddExpectedBabies', function(event) {
        event.preventDefault();
        $('#frmAddExpectedBabies').submit();
    });
    $('#frmAddExpectedBabies').on('submit', (function(e) {
        e.preventDefault();
        addExpectedBabies(this);
    }));
    //Update Existing Expected Babies
    $(document).on("click", '#btnUpdateExpectedBabies', function(event) {
        event.preventDefault();
        $('#frmUpdateExpectedBabies').submit();
    });
    $('#frmUpdateExpectedBabies').on('submit', (function(e) {
        e.preventDefault();
        updateExpectedBabies(this);
    }));
});

function addExpectedBabies(ths) {
    var submitForm = true;
    var formData = new FormData(ths);
    console.log(formData);
    var mother = $('#mother').val();
    if (mother.trim() == "") {
        $("#mother_errormsg").text("Please enter mother name");
        submitForm = false;
    }
    var father = $('#father').val();
    if (father.trim() == "") {
        $("#father_errormsg").text("Please enter father name");
        submitForm = false;
    }
    var race = $('#race_id').val();
    if (race.trim() == "" || !$.isNumeric(race)) {
        $("#race_errormsg").text("Please select race");
        submitForm = false;
    }
    var kind = $('#kind_id').val();
    if (kind == "" || !$.isNumeric(kind)) {
        $("#kind_errormsg").text("Please select kind");
        submitForm = false;
    }
    var expected_at = $('#expected_at').val();
    if (expected_at == undefined || expected_at == "") {
        $("#expected_at_errormsg").text("Please select the expected date.");
        submitForm = false;
    }
    if (submitForm == true) {
        var csrftokenval = $('meta[name="csrf-token"]').attr('content');
        $(".loader").toggleClass('d-none');
        var jqxhr = $.ajax({
            url: "expectedad/create",
            method: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': csrftokenval
            }
        }).done(function(data) {
            console.log(data);
            $(".loader").toggleClass('d-none');
            if (data.code == 201) {
                $('#successmsg').text('Expected Ad Saved Successfully!!');
                setTimeout(function() {
                    window.location.reload();
                }, 1200);
            } else {
                $('#errormsg').text(data.msg);
            }
            //ajaxSearch().reload();
        }).fail(function(data) {
            $(".loader").toggleClass('d-none');
            console.log(data);
        });
    }
}
//update Expected Babies
function updateExpectedBabies(ths) {
   $('#edsuccessmsg').text('');
      $('#ederrormsg').text( '' );
    var submitForm = true;
    var formData = new FormData(ths);
    console.log(formData);
    var mother = $('#edit_mother').val();
    if (mother.trim() == "") {
        $("#edmother_errormsg").text("Please enter mother name");
        submitForm = false;
    }
    var father = $('#edit_father').val();
    if (father.trim() == "") {
        $("#edfather_errormsg").text("Please enter father name");
        submitForm = false;
    }
    var race = $('#edrace').val();
    if (race.trim() == "" || !$.isNumeric(race)) {
        $("#edrace_errormsg").text("Please select race");
        submitForm = false;
    }
    var kind = $('#edkind').val();
    if (kind == "" || !$.isNumeric(kind)) {
        $("#edkind_errormsg").text("Please select kind");
        submitForm = false;
    }
    var expected_at = $('#edexpectedData').val();
    if (expected_at == undefined || expected_at == "") {
        $("#edexpected_at_errormsg").text("Please select the expected date.");
        submitForm = false;
    }
    if (submitForm == true) {
          var csrftokenval = $('meta[name="csrf-token"]').attr('content');
          $(".loader").toggleClass('d-none');
        var jqxhr = $.ajax( {
                        url: "expectedad/update",
                        method:"POST",
                        data: formData,
                        cache:false,
                        contentType: false,
                        processData: false,
                        headers: { 'X-CSRF-TOKEN': csrftokenval }
                      })
                      .done(function(data) {
                        console.log(data);
                        $(".loader").toggleClass('d-none');
                        if(data.code==201)
                        {
                          $('#edsuccessmsg').text('Expected Ad Saved Updated!!');
                          setTimeout(function() {
                            window.location.reload();
                          }, 1200);
                        }
                        else
                        {
                          $('#ederrormsg').text( data.msg );
                        }
                        //ajaxSearch().reload();
                    })
                    .fail(function(data) {
                      $(".loader").toggleClass('d-none');
                      console.log(data);
                    });
    }
}

function clearLabelsOnEditOpen() {
     $('#edsuccessmsg').text('');
      $('#ederrormsg').text( '' );
    $("#edmother_errormsg").text("");
    $("#edfather_errormsg").text("");
    $("#edrace_errormsg").text("");
    $("#edkind_errormsg").text("");
    $("#edexpected_at_errormsg").text("");
    $('#edlogoFilenameMother').text("Current Pic");
    $('#edlogoFilenameFather').text("Current Pic");
}
$('#modal-edit-expected-babies').on('show.bs.modal', function(event) {
    clearLabelsOnEditOpen();
    var button = $(event.relatedTarget)
    var ktitle = "Data "
    var kid = button.data('kind')
    var ebid = button.data('ebid')
    var race = button.data('race')
    var father = button.data('father')
    var currImageFather = button.data('father_pic')
    var mother = button.data('mother')
    var currImageMother = button.data('mother_pic')
    ktitle = "Father: (" + father + ") Mother: (" + mother + ')';
    // Date Treatment
    var expectedDate = button.data('expecteddate')
    var finalExpectedDate = expectedDate;
    if (expectedDate != "") {
        var now = new Date(expectedDate);
        var day = ("0" + now.getDate()).slice(-2);
        var month = ("0" + (now.getMonth() + 1)).slice(-2);
        finalExpectedDate = now.getFullYear() + "-" + (month) + "-" + (day);
    }
    var modal = $(this)
    modal.find('.modal-title').text('Update Data: ' + ktitle)
    modal.find('.modal-body #edexpectedData').val(finalExpectedDate)
    modal.find('.modal-body #edkind').val(kid);
    modal.find('.modal-body #ebId').val(ebid);
    modal.find('.modal-body #edrace').val(race);
    modal.find('.modal-body #edit_father').val(father);
    modal.find('.modal-body #edit_mother').val(mother);
    modal.find('.modal-body #edimgFatherPreview').attr('src', "../storage/app/public/uploads/expectedbabies/thumb/" + currImageFather);
    modal.find('.modal-body #edimgMotherPreview').attr('src', "../storage/app/public/uploads/expectedbabies/thumb/" + currImageMother);
});
$('#modal-edit-kind').on('hidden.bs.modal', function(e) {
    // ajaxSearch().reload();
});