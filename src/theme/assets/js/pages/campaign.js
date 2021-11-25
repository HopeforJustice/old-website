jQuery(document).ready(function($) {

$(".iwd__amount").on('click', function(){
    $("#Amount").val($(this).attr('val'));
});

$("#creative").on('click', function(){
    $(this).toggleClass("campaign__drop-down-icon--open");
    $('#creativeContent').toggleClass("campaign__drop-down-desc-content--open")
});
$("#thinking").on('click', function(){
    $(this).toggleClass("campaign__drop-down-icon--open");
    $('#thinkingContent').toggleClass("campaign__drop-down-desc-content--open")
});
$("#physical").on('click', function(){
    $(this).toggleClass("campaign__drop-down-icon--open");
    $('#physicalContent').toggleClass("campaign__drop-down-desc-content--open")
});
//fit homepage video
$("#iwdVid").fitVids();

$(".campaign__findOutMore").on('click', function(){
    $('.activity').find("input").val("HC 200 Info Request");
    $('#field_111_55').hide();
});

$(".campaign__signUp").on('click', function(){
    $('.activity').find("input").val("HC 200 Sign Up");
    $('#field_111_55').show();
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

var amount = getUrlParameter('Amount');
if(amount !== undefined) {
    jQuery('#payment-modal').modal('show');
    jQuery('.ginput_amount').val(amount);
}        

    
}); /* end of as page load scripts */