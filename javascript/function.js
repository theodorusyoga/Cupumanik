$(document).ready(function() {
	$('.batiklink').hide();
	$('.furnilink').hide();
	$('.guesthouselink').hide();
	$('.preview').hide();

	window.setTimeout(onLoad, 750);

	function onLoad() {
		$('img.batiklink#img1').fadeIn(500);
		$('img.batiklink#img2').fadeIn(1000);
		$('img.batiklink#img3').fadeIn(1500);
		$('.preview').fadeIn('fast');
		$('div.batiklink').fadeIn('fast');
	}

	$('.submain .link').hover(function() {
		//hide first
		var id = this.id;
		$('.batiklink').hide();
		$('.furnilink').hide();
		$('.guesthouselink').hide();
		$('.preview').hide();
		// show
		$('img.' + id + '#img1').fadeIn(500);
		$('img.' + id + '#img2').fadeIn(1000);
		$('img.' + id + '#img3').fadeIn(1500);
		$('.preview').fadeIn('fast');
		$('div.' + id).fadeIn('fast');
	}, function() {
		var id = this.id;
		//hide first
		$('img.' + id + '#img1').hide();
		$('img.' + id + '#img2').hide();
		$('img.' + id + '#img3').hide();
		$('.preview').hide();
		$('div.' + id).hide();
		//show
		onLoad();
	});

});