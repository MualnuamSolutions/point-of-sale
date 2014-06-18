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

function stripslashes(str) {
  //       discuss at: http://phpjs.org/functions/stripslashes/
  //      original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  //      improved by: Ates Goral (http://magnetiq.com)
  //      improved by: marrtins
  //      improved by: rezna
  //         fixed by: Mick@el
  //      bugfixed by: Onno Marsman
  //      bugfixed by: Brett Zamir (http://brett-zamir.me)
  //         input by: Rick Waldron
  //         input by: Brant Messenger (http://www.brantmessenger.com/)
  // reimplemented by: Brett Zamir (http://brett-zamir.me)
  //        example 1: stripslashes('Kevin\'s code');
  //        returns 1: "Kevin's code"
  //        example 2: stripslashes('Kevin\\\'s code');
  //        returns 2: "Kevin\'s code"

  return (str + '')
    .replace(/\\(.?)/g, function(s, n1) {
      switch (n1) {
        case '\\':
          return '\\';
        case '0':
          return '\u0000';
        case '':
          return '';
        default:
          return n1;
      }
    });
}
