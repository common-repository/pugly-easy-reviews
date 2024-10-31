jQuery(document).ready(function($){
	var starspin = 0;
	$(document).on('click', '.pugreviews-nextbutton', function(){
		starspin = parseInt(starspin) + 360;
		$('.pugreviews-stars').find('i').css('transform','rotate('+starspin+'deg)');
		$('.pugreviews-showpanel').addClass('pugreviews-temp');
		$('.pugreviews-temp').removeClass('pugreviews-showpanel');
		if ($('.pugreviews-temp').next().hasClass('pugreviews-panel')) {
			$('.pugreviews-temp').next().addClass('pugreviews-showpanel');
			$('.pugreviews-temp').removeClass('pugreviews-temp');
			$('.pugreviews-panel').slideUp();
			$('.pugreviews-showpanel').slideDown();
		} else {
			$('.pugreviews-panel').first().addClass('pugreviews-showpanel');
			$('.pugreviews-temp').removeClass('pugreviews-temp');
			$('.pugreviews-panel').slideUp();
			$('.pugreviews-showpanel').slideDown();
		}
	});
	$(document).on('click', '.pugreviews-button', function(){
		$(this).addClass('pugreviews-reviews');
		$('.pugreviews-reviews').removeClass('pugreviews-button');
		$('.pugreviews-panel').css('display','none');
		$('.pugreviews-showpanel').slideDown();
	});
	$(document).on('click', '.pugreviews-closebutton', function(){
		$('.pugreviews-reviews').addClass('pugreviews-button');
		$('.pugreviews-button').removeClass('pugreviews-reviews');
	});
});