
jQuery(document).ready(function($) {


//donation value
$('#become-a-guardian').click(function() {
    $('#display-amount').html($('#Amount').val());
});

$("#currency").click(function() {
    alert('This page is for donations in GBP. If you would like to make a donation in another currency please email us on supporters@hopeforjustice.org or call 0300 008 8000');
});


//video open
$("#watch-thecla").click(function(){
  $("#video-overlay").removeClass("video-overlay--hidden");
  $('body, html').toggleClass("video-overlay--no-scroll");
        window.location.hash = "modal";
    $("#video")[0].src += "&autoplay=1";
    ev.preventDefault();
});

//video close

$("#exit-thecla").on("click", function(event) {
    $('.video-overlay').toggleClass("video-overlay--hidden");
    $('body, html').toggleClass("video-overlay--no-scroll");
    $("#video")[0].src =- "&autoplay=1";
    //ev.preventDefault();
});


});



