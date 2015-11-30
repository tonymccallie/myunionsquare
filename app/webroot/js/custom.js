var testvar = null;
$(document).ready(function() {
	$('.dropdown-toggle').dropdown();
	$(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({
		animation_speed:'normal',
		theme:'facebook',
		slideshow:3000, 
		autoplay_slideshow: false, 
		social_tools:'',
		show_title:false
	});
	
	$('#bank_login').submit(function(e) {
		var self = this;
		e.preventDefault();
		self.submit()
		setTimeout(function() {
			$('#UserIDTextbox').val('');
		}, 1000);
	});
});