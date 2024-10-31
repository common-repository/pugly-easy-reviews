jQuery(document).ready(function($){
	/* Interface */
	$(document).on('click', '.pugreviews-insertreview', function(){
		$('.pugreviews-reviewsave').prepend('<div class="pugreviews-panel pugreviews-inserteditem"><div class="pugreviews-reviewtext">Choose reviews that are as short as possible and straight to the point!</div><div class="pugreviews-name">Name, Location</div></div>');
		$('.pugreviews-settings').hide();
		$('.pugreviews-activereview').removeClass('pugreviews-activereview');
		setTimeout(function() {
			$('.pugreviews-inserteditem').removeClass('pugreviews-inserteditem');
		}, 300);
	});
	$(document).on('click', '.pugreviews-panel', function(){
		$('.pugreviews-settings').show();
		$('.pugreviews-activereview').removeClass('pugreviews-activereview');
		$(this).addClass('pugreviews-activereview');
		$('.pugreviews-setting-text').val($('.pugreviews-activereview').find('.pugreviews-reviewtext').html());
		$('.pugreviews-setting-name').val($('.pugreviews-activereview').find('.pugreviews-name').html());
	});
	$(document).on('click', '.pugreviews-toolup', function(){
		$('.pugreviews-activereview').insertBefore($('.pugreviews-activereview').prev());
	});
	$(document).on('click', '.pugreviews-tooldown', function(){
		$('.pugreviews-activereview').insertAfter($('.pugreviews-activereview').next());
	});
	$(document).on('click', '.pugreviews-delete', function(){
		$('.pugreviews-activereview').remove();
		$('.pugreviews-settings').hide();
	});
	$(document).on('input change keyup', '.pugreviews-setting-text', function(){
		$('.pugreviews-activereview').find('.pugreviews-reviewtext').html($(this).val());
	});
	$(document).on('input change keyup', '.pugreviews-setting-name', function(){
		$('.pugreviews-activereview').find('.pugreviews-name').html($(this).val());
	});
	/* Save */
	$(document).on('click', '#submit', function(){
    	if ($('.pugreviews-reviews').length) {
			$('#pugly_reviewscode').val('');
			$('.pugreviews-activereview').removeClass('pugreviews-activereview');
			$('.pugreviews-showpanel').removeClass('pugreviews-showpanel');
			$('.pugreviews-panel').first().addClass('pugreviews-showpanel');
			$('#pugly_reviewscode').val($('.pugreviews-reviewsave').html());
			$('.pugreviews-settings').hide();
		}
	});
});