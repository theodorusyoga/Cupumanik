$(document).ready(function(){
	$('.batiklink').hide();
	$('.furnilink').hide();
	$('.guesthouselink').hide();
	$('.preview').hide();
	
	$('.link').hover(function(){
		var id = this.id;
		$('img.' + id + '#img1').fadeIn(500);
		$('img.' + id + '#img2').fadeIn(1000);
		$('img.' + id + '#img3').fadeIn(1500);
		$('.preview').fadeIn('fast');
		$('div.' + id).fadeIn('fast');
	}, function(){
		var id = this.id;
		$('img.' + id + '#img1').hide();
		$('img.' + id + '#img2').hide();
		$('img.' + id + '#img3').hide();
		$('.preview').hide();
		$('div.' + id).hide();
	})
});