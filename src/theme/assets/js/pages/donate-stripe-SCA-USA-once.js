
jQuery(document).ready(function($) {

    $("#currency").click(function() {
        alert('This page is for donations in US Dollars. If you would like to make a donation in another currency please email us on info.us@hopeforjustice.org or call (+1) 615-356-0946');
    });

    // Toggling between forms - there is most certainly a better way...
    $("#donate-monthly-select").click(function() {
        window.location.href = "/donate/us/";
    });

});

jQuery(document).on("gform_confirmation_loaded", function (e, form_id) {
  alert("yes");
});