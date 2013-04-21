
$(document).ready(function(){
	$('.btn').click(function(){
		$('form').submit();
	});
	
	$('.carousel').carousel({
		interval: 5000
	});
});
