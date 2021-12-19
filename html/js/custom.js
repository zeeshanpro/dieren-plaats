jQuery( ".save_me" ).click(function() {
    jQuery(this).toggleClass("active");
});
jQuery( ".select_account_type" ).click(function() {
    jQuery('.select_account_type').removeClass("active");
    jQuery(this).toggleClass("active");
});
jQuery( ".confirm_payment" ).click(function() {
    jQuery('.confirm_payment').removeClass("active");
    jQuery(this).toggleClass("active");
});
jQuery('input:checked').parent().addClass('checked');
jQuery(":checkbox").on('click', function(){
    jQuery(this).parent().toggleClass("checked");
});
jQuery(".show_more_arrow").click(function() {
    jQuery(this).parent().parent().parent().find('.bottom_panel').toggleClass('hide');
    jQuery(this).toggleClass('up');
});
jQuery(".view_waiting_list").click(function() {
    jQuery(this).parent().parent().parent().find('.bottom_panel').toggleClass('hide');
	jQuery(this).toggleClass('up');
    if (jQuery(this).hasClass('up')) {
		jQuery(this).text('hide');
	}
	else{
		jQuery(this).text('view');
	}
});