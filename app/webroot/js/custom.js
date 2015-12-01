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
	
	$('.like').click(function(e) {
		href = this.href;
		rel = this.rel;
		count = $('#'+rel);
		self = $(this);
		self.css('cursor','wait');
		$.getJSON(href,function(data) {
			if(self.hasClass('unlike')) {
				count.html(parseInt(count.html())-1);
				href = href.replace('dislike','like');
				self.removeClass('unlike').html('<i class="icon-thumbs-up"></i>Like</a>').attr('href',href);
				
			} else {
				count.html(parseInt(count.html())+1);
				href = href.replace('like','dislike');
				self.addClass('unlike').html('<i class="icon-thumbs-up-alt"></i>Unlike</a>').attr('href',href);
				
			}
			self.css('cursor','default');
		});
		e.preventDefault();
	})
});