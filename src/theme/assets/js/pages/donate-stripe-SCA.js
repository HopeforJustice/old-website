//
// Functions for one off giving UK 
//

jQuery(document).ready(function($) {

// send to monthly page on click
$("#donate-monthly-select").click(function() {
    window.location.href = "/donate/uk/";
});

// alert to tell user to call if they want to give in another currency
$("#currency").click(function() {
    alert('This page is for donations in GBP. If you would like to make a donation in another currency please email us on supporters@hopeforjustice.org or call 0300 008 8000');
});


    //post code anywhere on gravity forms next page load
    jQuery(document).on('gform_page_loaded', function(){

        var e = {
                key: "DN97-JG93-ZJ46-EW48",
                bar: {
                    showCountry: false
                },
                countries: {
                    codesList: "GBR"
                }
            },
            d = [{
                element: "input_69_58",
                field: "",
                mode: pca.fieldMode.SEARCH
            }, {
                element: "input_69_56_1",
                field: "Line1",
                mode: pca.fieldMode.POPULATE
            }, {
                element: "input_69_56_2",
                field: "Line2",
                mode: pca.fieldMode.POPULATE
            }, {
                element: "input_69_56_3",
                field: "City",
                mode: pca.fieldMode.POPULATE
            }, {
                element: "input_69_56_4",
                field: "Province",
                mode: pca.fieldMode.POPULATE
            }, {
                element: "input_69_56_5",
                field: "PostalCode",
                mode: pca.fieldMode.POPULATE
            }, {
                element: "Country",
                field: "CountryName",
                mode: pca.fieldMode.COUNTRY
            }],
            o = new pca.Address(d, e);
        o.listen("populate", function() {
            document.getElementById("AddressSearch").value = ""
        }), o.load()
    });


});