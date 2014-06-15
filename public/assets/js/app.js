$(document).ready(function () {
   $('.tooltip, .tooltip-top').tooltip({'placement':'top'});
   $('.tooltip-bottom').tooltip({'placement':'bottom'});
   $('.tooltip-left').tooltip({'placement':'left'});
	$('.tooltip-rigt').tooltip({'placement':'right'});

   $("form .form-control:first").focus();

   $('[data-toggle=offcanvas]').click(function () {
      $('.row-offcanvas, [data-toggle=offcanvas]').toggleClass('active')
   });

   $('body').css('min-height', $(window).innerHeight());

   $('.sidebar-offcanvas').css('min-height', ($(window).innerHeight() - 50));

   $('a.filter-toggle').on('click', function (evt) {
      evt.preventDefault(true);

      if($('body .filter').is(":visible"))
         $('.filter').css('display', 'none');
      else
         $('.filter').css('display', 'block');
   });

   $(".pick-a-color").pickAColor({
      showSpectrum            : true,
      showSavedColors         : true,
      saveColorsPerElement    : true,
      fadeMenuToggle          : true,
      showAdvanced            : true,
      showBasicColors         : true,
      showHexInput            : true,
      allowBlank              : true,
      inlineDropdown          : true
   });

});
