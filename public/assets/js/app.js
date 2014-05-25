$(function(){
   $('.tooltip, .tooltip-top').tooltip({'placement':'top'});
   $('.tooltip-bottom').tooltip({'placement':'bottom'});
   $('.tooltip-left').tooltip({'placement':'left'});
	$('.tooltip-rigt').tooltip({'placement':'right'});

   $("form .form-control:first").focus();
});
