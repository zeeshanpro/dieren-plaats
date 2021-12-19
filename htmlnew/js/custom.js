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
jQuery(".mega_open").click(function() {
	jQuery('.mega_menu').toggleClass('show');
});

jQuery(document).on('click','.fashion-menu-item .fashion-menu-link',function(){
	var active_div = jQuery(this).next();
	if (jQuery(window).width() > 991) {
		jQuery(this).next().addClass("active");
		jQuery(document).find('.fashion-menu-item-row').not(active_div).removeClass('active');
		jQuery(this).addClass('active');
		jQuery(document).find(".fashion-menu-item .fashion-menu-link").not(this).removeClass('active');
	}
});
jQuery(document).on('click','.fashion-menu-link',function(){
	if (!jQuery(this).next().hasClass('show')) {
		jQuery('.fashion-menu-item-row').removeClass('show');
		jQuery(this).next().addClass('show');
	}
	else if (jQuery(this).next().hasClass('show')) {
		jQuery(this).next().removeClass('show');
	}
	jQuery(this).addClass('show');
	jQuery(document).find(".fashion-menu-link").not(this).removeClass('show');
	return false;
});
jQuery(document).on('click' ,'.navbar-toggler', function(){
	jQuery('.mega-menu-toggle-bar').toggleClass('fa-times');
	jQuery('.mega-menu-toggle-bar').toggleClass('fa-bars');
});