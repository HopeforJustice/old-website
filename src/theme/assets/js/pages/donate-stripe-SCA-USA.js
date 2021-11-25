
jQuery(document).ready(function($) {


//donation value display on widget
$('#become-a-guardian').click(function() {
    $('#display-amount-us').html($('#Amount').val());
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

var form = $("#CreditCardForm");

// different radio button names - only allow 1 to be selected
$(document).ready(function () {
    $('input[type=radio]').change(function() {
        // When any radio button on the page is selected,
        // then deselect all other radio buttons.
        $('input[type=radio]:checked').not(this).prop('checked', false);
    });
    // make the buttons orange
    $("[role=menuitem]").addClass("button button--orange button--solid");
    $("#gform_submit_button_6").addClass("button--orange");
});​


// // Toggling between forms - there is most certainly a better way...
// $("#donate-one-off-select").click(function() {
//     window.location.href = "/donate-us-once/";
// });

$("#currency").click(function() {
    alert('This page is for donations in US Dollars. If you would like to make a donation in another currency please email us on info.us@hopeforjustice.org or call (+1) 615-356-0946');
});

$("#givingAmountLink").click(function() {
    $('#CreditCardForm').steps("setStep", 0);
    $('#givingAmountLink').fadeOut(100);
    $(".donate-uk__message").fadeIn(100);
    $(".donate-uk").removeClass("donate-uk__background--cover");
    $(".donate-uk__wrapper").removeClass("donate-uk__wrapper--padding");
});

$("#CreditCardForm").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "fade",
    transitionEffectSpeed: 500,
    autoFocus: true,
    labels: 
    {
        finish: "Donate",
        next: "Next Step"
    },
    onStepChanging: function (event, currentIndex, newIndex) { 
        $("#currency").hide();

        /*
        $('#display').html($('#Amount').val());
        $('#givingAmountLink').css("display", "flex").hide().fadeIn(100);
        $(".donate-uk__options").fadeOut(100);
        $(".donate-uk").addClass("donate-uk__noback");
        $('.actions').fadeOut(100);
        $('.donate-uk__message').fadeOut(100);
        return true
        */
        
        //allow previous without validation
        $('a[href^="#next"]').show();
        
        if (newIndex < currentIndex && newIndex == 0) {
                
                $("html, body").animate({ scrollTop: 0 }, "slow");

                $("#donate-uk__msgheader").fadeOut(100, function() {
                    $(this).html("Become a <strong class=\"donate-uk__orange\">GUARDIAN</strong>").fadeIn(500);
                });

                $("#donate-uk__msgp").fadeOut(100, function(){
                    $(this).html("There are 40 MILLION people trapped in forced labour, sex trafficking and domestic servitude. Become a GUARDIAN to unlock freedom for them and to get children back home to their families.<br><br>Join us to prevent exploitation, rescue victims, restore lives and reform society. For $18 a month, or whatever you can afford to give, you can become a Hope for Justice GUARDIAN and help create a world free from slavery.").fadeIn(500);
                });
                
                $("html, body").animate({ scrollTop: 0 }, "slow");
                $(".donate-uk__options").fadeIn(100);
                $(".donate-uk").removeClass("donate-uk__noback");
                $('.actions').fadeIn(100);
                $('#givingAmountLink').fadeOut(100);
                $(".donate-uk__formwrap").removeClass("donate-uk__half");
                $(".donate-uk__msgwrap").removeClass("donate-uk__half");

                return true

        } else if (newIndex < currentIndex && newIndex == 1) {
                
                $("html, body").animate({ scrollTop: 0 }, "slow");

                $("#donate-uk__msgheader").fadeOut(100, function() {
                    $(this).html("Your giving will...").fadeIn(500);
                });

                $("#donate-uk__msgp").fadeOut(100, function(){
                    $(this).html("<strong class=\"donate-uk__orange\">PREVENT EXPLOITATION</strong> – Your donation will help fund our outreach teams and self-help groups to empower people to protect their own families from predatory traffickers.<br><br> <strong class=\"donate-uk__orange\">RESCUE VICTIMS</strong> – Millions are trapped in brutal exploitation around the world. Your donation will help fund our specialist identification and rescue teams.").fadeIn(500);
                });
                
                //removing the toggle and background image
                $(".donate-uk__options").fadeOut(100);
                $(".donate-uk").addClass("donate-uk__noback");
                $('.actions').fadeOut(100);
                $(".donate-uk__formwrap").removeClass("donate-uk__half");
                $(".donate-uk__msgwrap").removeClass("donate-uk__half");
                return true

        } else if (newIndex < currentIndex && newIndex == 2) {
                
                $("#donate-uk__msgp").fadeOut(100, function(){
                    $(this).html("<strong class=\"donate-uk__orange\">RESTORE LIVES</strong> – Rescue is not an event, it’s a process. Your donation helps survivors get the professional support they need to live new lives in freedom.<br><br><strong class=\"donate-uk__orange\">REFORM SOCIETY</strong> – Ending modern slavery will require change at all levels of society. Your donation will support reforming society").fadeIn(500);
                });

                $("html, body").animate({ scrollTop: 0 }, "slow");
                $(".donate-uk__message").fadeIn(100);
                $(".donate-uk").removeClass("donate-uk__background--cover");
                $(".donate-uk__formwrap").removeClass("donate-uk__half");
                $(".donate-uk__msgwrap").removeClass("donate-uk__half");
                return true

        } else if (newIndex < currentIndex && newIndex == 3) {
                
                $("#donate-uk__msgp").fadeOut(100, function(){
                    $(this).html("<strong class=\"donate-uk__orange\">RESTORE LIVES</strong> – Rescue is not an event, it’s a process. Your donation helps survivors get the professional support they need to live new lives in freedom.<br><br><strong class=\"donate-uk__orange\">REFORM SOCIETY</strong> – Ending modern slavery will require change at all levels of society. Your donation will support reforming society").fadeIn(500);
                });

                $("html, body").animate({ scrollTop: 0 }, "slow");
                $(".donate-uk__message").fadeIn(100);
                $(".donate-uk").removeClass("donate-uk__background--cover");
                $(".donate-uk__wrapper").removeClass("donate-uk__wrapper--padding");
                $(".wizard>.actions>ul").css("justify-content", "space-between");
                $(".donate-uk__formwrap").removeClass("donate-uk__half");
                $(".donate-uk__msgwrap").removeClass("donate-uk__half");
                return true

        }


        form.validate( {
            rules: {
                Email: {
                    required: true,
                    email: true
                },
                Comment: {
                    required: false,
                },
                Amount: {
                    required:true,
                    min:1.50
                }
            },
            messages: {
                Amount: "Please enter the amount you wish to give",
            },
            errorElement : 'div',
            errorLabelContainer: '.donate-uk__errorTxt'
        }).settings.ignore = ":disabled,:hidden";

        //if( $("#CreditCardForm").valid()==false){
        //return false
        //}
        if( $("#CreditCardForm").valid()==true && newIndex == 1) {
                $("html, body").animate({ scrollTop: 0 }, "slow");

                $("#donate-uk__msgheader").fadeOut(100, function() {
                    $(this).html("Your giving will...").fadeIn(500);
                });

                $("#donate-uk__msgp").fadeOut(100, function(){
                    $(this).html("<strong class=\"donate-uk__orange\">PREVENT EXPLOITATION</strong> – Your donation will help fund our outreach teams and self-help groups to empower people to protect their own families from predatory traffickers.<br><br> <strong class=\"donate-uk__orange\">RESCUE VICTIMS</strong> – Millions are trapped in brutal exploitation around the world. Your donation will help fund our specialist identification and rescue teams.").fadeIn(500);
                });
                
                //removing the toggle and background image
                $(".donate-uk__options").fadeOut(100);
                $(".donate-uk").addClass("donate-uk__noback");
                $('.actions').fadeOut(100);
                $(".wizard>.actions>ul").addClass("donate-uk__spacemob");
                $('.donate-alt__link').fadeOut(100);
                return form.valid();

        } else if( $("#CreditCardForm").valid()==true && newIndex == 2) {
                
                $("#donate-uk__msgp").fadeOut(100, function(){
                    $(this).html("<strong class=\"donate-uk__orange\">RESTORE LIVES</strong> – Rescue is not an event, it’s a process. Your donation helps survivors get the professional support they need to live new lives in freedom.<br><br><strong class=\"donate-uk__orange\">REFORM SOCIETY</strong> – Ending modern slavery will require change at all levels of society. Your donation will support reforming society.").fadeIn(500);
                });

                $("html, body").animate({ scrollTop: 0 }, "slow");
                $(".wizard>.actions>ul").addClass("donate-uk__spacemob");
                $('#payment-modal').find('a[href^="#next"]').hide();
                return form.valid();

        } else if( $("#CreditCardForm").valid()==true && newIndex == 3) {
                
                $("html, body").animate({ scrollTop: 0 }, "slow");
                $(".donate-uk").addClass("donate-uk__background--cover");
                $(".wizard>.actions>ul").addClass("donate-uk__spacemob");
                //awful hack to remove jquery steps finish and leave the donate button from the form
                $('a[href^="#next"]').hide();
                return form.valid();

        } else if( $("#CreditCardForm").valid()==true && newIndex == 4) {
                
                $("html, body").animate({ scrollTop: 0 }, "slow");
                $(".donate-uk__message").fadeOut(100);
                $(".donate-uk").addClass("donate-uk__background--cover");
                $(".wizard>.actions>ul").css("justify-content", "flex-start");
                $(".donate-uk__formwrap").addClass("donate-uk__half");
                $(".donate-uk__msgwrap").addClass("donate-uk__half");
                //awful hack to remove jquery steps finish and leave the donate button from the form
                $('a[href^="#finish"]').hide();
                $(".donate-uk__wrapper").addClass("donate-uk__wrapper--padding");
                return form.valid();

        } else if (newIndex == 0) {
                $("html, body").animate({ scrollTop: 0 }, "slow");
                $(".donate-uk__options").fadeIn(100);
                $(".donate-uk").removeClass("donate-uk__noback");
                $('.actions').fadeIn(100);
                $('#givingAmountLink').fadeOut(100);
                return true

        } else{
                return false
        }
            
        
    },

    onStepChanged: function (event, currentIndex, priorIndex) { 
        $('.actions').fadeIn(500);
        $('#display').html($('#Amount').val());

        if (currentIndex > 0) {
                $('#givingAmountLink').css("display", "flex").hide().fadeIn(100);
            }
 
    },

    onFinishing: function (event, currentIndex)
    {


        form.validate().settings.ignore = ":disabled";
        return form.valid();
    },
    onFinished: function (event, currentIndex) { 

    },
        
});

$("#CreditCardForm").fadeIn(100);

/*
(c) Donorfy Ltd 2020

Functions to support Credit Card Web Widget
Designed to use Stripe Elements

If you are making a change which would potentially break previously deployed web widgets then
1) create a new version of this file
2) update the references in webwidget_stripe_sca_creditcard_template and  donationpage_stripe_sca_creditcard_template.html
3) create a new demo version of the file


 */
// ReSharper disable UseOfImplicitGlobalInFunctionScope
// ReSharper disable AssignToImplicitGlobalInFunctionScope
if (typeof jQuery === 'undefined') {
    loadScript('https://ajax.aspnetcdn.com/ajax/jquery/jquery-1.9.1.min.js', function () {
        jQuery(document).ready(function () {
            load();
        });
    });

} else {
    jQuery(document).ready(function () {
        load();
    });
}

function GetBaseServiceUrl() {
       return "https://api.donorfy.com/api/stripe/";
}

function load() {

    if (typeof jQuery.validator === 'undefined') {
        loadScript('https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js');
    }

    var code = jQuery('#TenantCode').val();
    var id = jQuery('#WidgetId').val();
    if (id === "") {
        id = jQuery('#DonationPageId').val();
    }
    jQuery.ajax({
        dataType: 'json',
        url: GetBaseServiceUrl() + 'P0?id=' + id + '&code=' + code,
        method: 'POST',
        type: 'POST'
    }).done(function(data) {

        if (data.OK) {
            jQuery('#spinner').hide();
            var key = data.RequestData;
            stripe = Stripe(key);
            elements = stripe.elements();

            window.cardNumber = elements.create('cardNumber');
            window.cardNumber.mount('#card-number');

            window.cardExpiry = elements.create('cardExpiry');
            cardExpiry.mount('#card-expiry');

            window.cardCvc = elements.create('cardCvc');
            cardCvc.mount('#card-cvc');

            submitButton = document.getElementById('submitButton');
            submitButton.addEventListener('click',
                function(ev) {
                    DisableSubmitButton();
                    ResetErrorMessage();
                    if (ValidateForm()) {
                        try {
                            Process();
                        } catch (e) {
                            EnableSubmitButton();
                            console.log('Exception  ' + e);
                            ev.preventDefault();
                            return false;
                        }

                    } else {
                        EnableSubmitButton();
                        DisplayErrorMessage('please scroll up to see the details');
                    }
                    ev.preventDefault();
                    return false;
                });


            jQuery('input.numberOnly[type=text]').on('keypress',
                function(e) {
                    if (e.which !== 8 &&
                        e.which !== 44 &&
                        e.which !== 45 &&
                        e.which !== 46 &&
                        e.which !== 0 &&
                        (e.which < 48 || e.which > 57)) {
                        return false;
                    }
                    return true;
                });

            jQuery('input#Amount').blur(function() {

                if (this.value) {
                    var amt = parseFloat(this.value);
                    jQuery(this).val(amt.toFixed(2));
                }
            });


            jQuery("input[name='PaymentType']").on("click",
                function() {

                    if (jQuery(this).val() === 'Recurring') {
                        jQuery('#PaymentScheduleRow').show();
                    } else {
                        jQuery('#PaymentScheduleRow').hide();
                    }
                });

            try {
                InitialiseForm();
            } catch (e) {
                console.log('Exception calling InitialiseForm() ' + e);
            }
        } else {
            DisplayErrors(data.Errors);
        }
    }).fail(function(jqXHR, textStatus, errorThrown) {
        DisplayErrors(GetErrorArray(jqXHR));
        return "";
    });
    return "";
}

function loadScript(url, successFunction) {

    var script = document.createElement('script');
    script.src = url;
    var head = document.getElementsByTagName('head')[0],
        done = false;
    head.appendChild(script);
    script.onload = script.onreadystatechange = function () {
        if (!done && (!this.readyState || this.readyState === 'loaded' || this.readyState === 'complete')) {
            done = true;

            if (successFunction) {
                successFunction();
            }
            script.onload = script.onreadystatechange = null;
            head.removeChild(script);
        }
    };
}

function Initialise() {
    var code = jQuery('#TenantCode').val();
    var id = jQuery('#WidgetId').val();
    if (id === "") {
        id = jQuery('#DonationPageId').val();
    }
    jQuery.ajax({
        dataType: 'json',
        url: GetBaseServiceUrl() + 'P0?id=' + id + '&code=' + code,
        method: 'POST',
        type: 'POST'
    }).done(function(data) {

        if (data.OK) {
            return data.RequestData;
        } else {
            DisplayErrors(data.Errors);
        }
    }).fail(function(jqXHR, textStatus, errorThrown) {
        DisplayErrors(GetErrorArray(jqXHR));
        return "";
    });
    return "";
}

function ValidateForm() {
    jQuery('#CreditCardForm').validate().settings.ignore = ':disabled,:hidden';
    return jQuery('#CreditCardForm').valid();
}


function Process() {

    var code = jQuery('#TenantCode').val();
    var email = jQuery('#Email').val();
    var emailEnc = encodeURIComponent(email);
    var recurring = jQuery('#RecurringPayment').is(':checked');
    var id = jQuery('#WidgetId').val();
    if (id === "") {
        id = jQuery('#DonationPageId').val();
    }
    var amount = jQuery('#Amount').val();
    amount = amount.replace(/\D/g, '');

    var firstName = jQuery('#FirstName').length > 0 ? jQuery('#FirstName').val() : '';
    var lastName = jQuery('#LastName').length > 0 ? jQuery('#LastName').val() : '';
    var town = jQuery('#Town').length > 0 ? jQuery('#Town').val() : '';
    var address2 = jQuery('#Address2').length > 0 ? jQuery('#Address2').val() : '';
    var address1 = jQuery('#Address1').length > 0 ? jQuery('#Address1').val() : '';
    var postcode = jQuery('#Postcode').length > 0 ? jQuery('#Postcode').val() : '';
    var county = jQuery('#County').length > 0 ? jQuery('#County').val() : '';


    var siteKey = jQuery('#ReCaptchaSiteKey').val();
    var action = jQuery('#ReCaptchaAction').val();

    try {
        grecaptcha.ready(function() {
            grecaptcha.execute(siteKey, { action: action }).then(function(token) {
                jQuery.ajax({
                    dataType: 'json',
                    url: GetBaseServiceUrl() +
                        'P1?id=' +
                        id +
                        '&code=' +
                        code +
                        '&amount=' +
                        amount +
                        '&email=' +
                        emailEnc +
                        '&rec=' +
                        recurring +
                        '&token=' +
                        token,
                    method: 'POST',
                    type: 'POST'
                }).done(function(data) {
                    if (data.OK) {
                        jQuery('#submitButton').attr('data-secret', data.RequestData);
                        stripe.handleCardPayment(data.RequestData,
                            cardNumber,
                            {
                                save_payment_method: recurring,
                                receipt_email: email,
                                payment_method_data: {
                                    billing_details: {
                                        name: firstName + ' ' + lastName,
                                        email: email,
                                        address: {
                                            city: town,
                                            line1: address1,
                                            line2: address2,
                                            postal_code: postcode,
                                            state: county
                                        }
                                    }
                                }
                            }).then(function(result) {
                            if (result.error) {
                                DisplayErrorMessage(result.error.message);
                            } else {
                                PostPayment(result.paymentIntent.id);
                            }
                        });
                        var requestData = data.RequestData;
                        return requestData;
                    } else {
                        DisplayErrors(data.Errors);
                    }
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    DisplayErrors(GetErrorArray(jqXHR));
                });
            });
        });
    } catch (e) {
        console.log('Exception in Process ' + e);
    }
}


function PostPayment(token) {

    jQuery.ajax({
        dataType: 'json',
        url: GetBaseServiceUrl() + 'P2',
        data: GetPaymentPostData(token),
        method: 'POST',
        type: 'POST'
    }).done(function (data) {

        if (data.OK) {
            Completed();
        } else {
            DisplayErrors(data.Errors);
        }

    }).fail(function (jqXHR, textStatus, errorThrown) {
        DisplayErrors(GetErrorArray(jqXHR));
    });

}


function EnableSubmitButton() {
    jQuery('#submitButton').removeAttr('disabled');
    if (jQuery('#DonationPageId').val() !== '') {
        jQuery('#submitButton').button('reset');
    }
    jQuery('#PleaseWait').hide();
}

function DisableSubmitButton() {
    if (jQuery('#DonationPageId').val() !== '') {
        jQuery('#submitButton').button('loading');
    }
    jQuery('#submitButton').attr('disabled', 'disabled');
    jQuery('#PleaseWait').show();
}



function GetPaymentPostData(stripeToken) {

    return {
        title: jQuery('#Title').val(),
        firstName: jQuery('#FirstName').val(),
        lastName: jQuery('#LastName').val(),
        email: jQuery('#Email').val(),
        phone: jQuery('#Phone').val(),
        address1: jQuery('#Address1').val(),
        address2: jQuery('#Address2').val(),
        town: jQuery('#Town').val(),
        county: jQuery('#County').val(),
        postCode: jQuery('#Postcode').val(),
        country: jQuery('#Country').length > 0 ? jQuery('#Country').val() : '',
        token: stripeToken,
        giftAid: jQuery('#GiftAid').is(':checked'),
        keepInTouch: GetKeepInTouchValue(),
        amount: jQuery('#Amount').val(),
        cardType: jQuery('#CardType').val(),
        tenantCode: jQuery('#TenantCode').val(),
        widgetId: jQuery('#WidgetId').val(),
        recurring: jQuery('#RecurringPayment').is(':checked'),
        paymentSchedule: jQuery('input:radio[name=PaymentSchedule]:checked').val(),
        donationPageId: jQuery('#DonationPageId').val(),
        comment: jQuery('#Comment').val(),
        quantity: jQuery('#Quantity').length > 0 ? jQuery('#Quantity').val() : '1',
        additionalTitle: jQuery('#AdditionalTitle').length > 0 ? jQuery('#AdditionalTitle').val() : '',
        additionalFirstName: jQuery('#AdditionalFirstName').length > 0 ? jQuery('#AdditionalFirstName').val() : '',
        additionalLastName: jQuery('#AdditionalLastName').length > 0 ? jQuery('#AdditionalLastName').val() : '',
        additionalEmail: jQuery('#AdditionalEmail').length > 0 ? jQuery('#AdditionalEmail').val() : '',
        additionalPhone: jQuery('#AdditionalPhone').length > 0 ? jQuery('#AdditionalPhone').val() : '',
        additionalAddress1: jQuery('#AdditionalAddress1').length > 0 ? jQuery('#AdditionalAddress1').val() : '',
        additionalAddress2: jQuery('#AdditionalAddress2').length > 0 ? jQuery('#AdditionalAddress2').val() : '',
        additionalTown: jQuery('#AdditionalTown').length > 0 ? jQuery('#AdditionalTown').val() : '',
        additionalCounty: jQuery('#AdditionalCounty').length > 0 ? jQuery('#AdditionalCounty').val() : '',
        additionalPostcode: jQuery('#AdditionalPostcode').length > 0 ? jQuery('#AdditionalPostcode').val() : '',
        additionalCountry: jQuery('#AdditionalCountry').length > 0 ? jQuery('#AdditionalCountry').val() : '',
        activeTags: jQuery('#ActiveTags').length > 0 ? jQuery('#ActiveTags').val() : '',
        blockedTags: jQuery('#BlockedTags').length > 0 ? jQuery('#BlockedTags').val() : '',
        useAdditionalDetails: jQuery('#UseAdditionalDetails').length > 0 ? jQuery('#UseAdditionalDetails').val() : ''
    };
}

function GetKeepInTouchValue() {

    var keepInTouchValue = 0;

    jQuery('input.KeepInTouch[type=checkbox]:checked').each(function () {
        keepInTouchValue += parseInt(jQuery(this).val());
    });

    return keepInTouchValue;
}

function GetErrorArray(jqXHR) {

    var errors = [];

    var response = JSON.parse(jqXHR.responseText);

    if (response.ModelState) {
        for (var key in response.ModelState) {
            errors.push(response.ModelState[key]);
        }
    } else if (response.Message) {
        errors.push(response.Message);
    } else {
        errors.push('An unexpected error occurred.');
    }

    return errors;
}

function DisplayErrors(errors) {
    var errorMessage = '';
    jQuery.each(errors, function (index, value) {
        errorMessage += value + '<br/>';
    });
    DisplayErrorMessage(errorMessage);
}

function ResetErrorMessage() {
    jQuery('#Errors').html('');
    jQuery('#ErrorContainer').hide();
}

function DisplayErrorMessage(errorMessage) {
    jQuery('#PleaseWait').hide();
    jQuery('#ErrorContainer').show();
    jQuery('#Errors').html(errorMessage);
    EnableSubmitButton();
}

function Completed() {
    var redirectToPage = jQuery('#RedirectToPage').val();
    if (redirectToPage) {
        window.location = redirectToPage;
    } else {
        window.location = '/';
    }
}






//post code anywhere donorfy extensions
jQuery(document).ready(function() {
        var e = {
                key: "DN97-JG93-ZJ46-EW48"
            },
            d = [{
                element: "AddressSearch",
                field: "",
                mode: pca.fieldMode.SEARCH
            }, {
                element: "Address1",
                field: "Line1",
                mode: pca.fieldMode.POPULATE
            }, {
                element: "Address2",
                field: "Line2",
                mode: pca.fieldMode.POPULATE
            }, {
                element: "Town",
                field: "City",
                mode: pca.fieldMode.POPULATE
            }, {
                element: "County",
                field: "Province",
                mode: pca.fieldMode.POPULATE
            }, {
                element: "Postcode",
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
