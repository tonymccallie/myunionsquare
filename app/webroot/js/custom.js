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
		self = $(this);
		self.css('cursor','wait');
		$.getJSON(href,function(data) {
			if(self.hasClass('unlike')) {
				href = href.replace('dislike','like');
				self.removeClass('unlike').html('<i class="icon-thumbs-up"></i> Like ('+data+')</a>').attr('href',href);
				
			} else {
				href = href.replace('like','dislike');
				self.addClass('unlike').html('<i class="icon-thumbs-up-alt"></i> Unlike ('+data+')</a>').attr('href',href);
				
			}
			self.css('cursor','default');
		});
		e.preventDefault();
	});
	getWeather();
	setInterval(getWeather, 300000);
	
});

function getWeather() {
	$.simpleWeather({
		location: 'Wichita Falls, TX',
		woeid: '',
		unit: 'f',
		success: function(weather) {
			if(weather.wind.speed === "") {
				weather.wind.speed = "0";
			} 
			$("#simple_weather").html('CURRENT WEATHER: '+weather.temp+'&deg;  '+weather.wind.direction+' '+weather.wind.speed+' '+weather.units.speed);
		},
		error: function(error) {
			$("#simple_weather").html('<p>'+error+'</p>');
		}
	});
}