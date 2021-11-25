
jQuery(document).ready(function($) {

$('.giving-widget__option').click(function(){
    var value = $(this).attr('value');
    var footerAmount = $(this).text();
    var footerMsg = $(this).attr('msg');
    $(this).addClass('giving-widget__option--active');
    $('.giving-widget__option').not(this).removeClass('giving-widget__option--active');
    $('#Amount').val(value);
    $('#footer-amount').text(footerAmount);
    $('#footer-msg').text(footerMsg);
    $('.christmas__amount--active').removeClass('christmas__amount--active');
});

$('#christmasDonate').click(function(){
    $([document.documentElement, document.body]).animate({
        scrollTop: $(".christmas__widget-container").offset().top - 100
    }, 500);
});


$('#unlock-freedom-bottom').click(function(){
  $("html, body").animate({ scrollTop: 0 }, "slow");
});

$('.christmas__amount').click(function(){
    $(this).addClass('christmas__amount--active');
    $('.giving-widget__option').removeClass('giving-widget__option--active');
    $('#Amount').show();
    $('#Amount').val('');
    $('#Amount').focus();
});

});

jQuery(window).load(function($) {
    var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
    };
    var popup = getUrlParameter('popup');
    if(popup == "true") {
       jQuery('#video-modal').modal('show');
    } else if(popup == "alt") {
      jQuery('#video-modal-alt').modal('show');
    } else {
      jQuery('#video-modal-alt').modal('hide');
    }

    
}); /* end of as page load scripts */

