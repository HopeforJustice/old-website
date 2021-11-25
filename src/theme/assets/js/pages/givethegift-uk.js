jQuery(document).ready(function($) {

	var billingIsDelivery = "N/A"
    var deliveryToWho = "Deliver to: N/A, "
    var sendToThem = "N/A"
    var publiciseAmount = "Publicise amount: N/A, "
    var form = $("#CreditCardForm");
    var giftChoice = "Gift choice: blue, "
    var giftType = "Delivery method: Post, "
    var postageAmount = 1.50

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

			    

			    if (currentIndex == 0 && newIndex == 1 && giftType == "Delivery method: Post, ") {
				    Total = parseFloat($('#Amount').val()) + parseFloat(postageAmount);
				    $(".givegift__total").html(parseFloat(Total).toFixed(2));
				    $('#Amount').val(parseFloat(Total).toFixed(2));
				    $(".givegift__subtotal").html(parseFloat(Total - postageAmount).toFixed(2));
				} else if (newIndex == 0){
					$('#Amount').val($('input[name=amountOption]:checked').val())
				} else if (currentIndex == 0 && newIndex == 1 && giftType == "Delivery method: Email, "){
					Total = parseFloat($('#Amount').val());
					$(".givegift__total").html(parseFloat(Total).toFixed(2));
					$('#Amount').val(parseFloat(Total).toFixed(2));
					$(".givegift__subtotal").html(parseFloat(Total).toFixed(2));
				} else if (newIndex < currentIndex) {
					return true
				}
				
				validateForm();
				
				
				if( $("#CreditCardForm").valid()==false) {
					$('#Amount').val(getNum());
				}
	        	
		       	return form.valid();

		       	
        },
        onStepChanged: function (event, currentIndex, priorIndex) { 
        	
        	//skip steps
        	if (priorIndex == 0 && currentIndex == 1 && sendToThem == "No") {
	       		$('#CreditCardForm').steps("setStep", 2);
	       	} else if (priorIndex == 2 && currentIndex == 1 && sendToThem == "No") {
	       		$('#CreditCardForm').steps("setStep", 0);
	       	} else if (priorIndex == 1 && currentIndex == 2 && giftType == "Delivery method: Email, ") {
	       		$('#CreditCardForm').steps("setStep", 3);
	       	} else if (priorIndex == 3 && currentIndex == 2 && giftType == "Delivery method: Email, ") {
	       		$('#CreditCardForm').steps("setStep", 1);
	       	}

        },
        onFinished: function (event, currentIndex) { 

        	//donorfy stuff
	        DisableSubmitButton();
            ResetErrorMessage();
            validateForm();
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
                DisplayErrorMessage('Please check your details');
            }
            ev.preventDefault();
            return false;
    	}

    });
    
    // make step buttons blue
	$("a[role=menuitem]").addClass("button button--solid button--blue");
	$("[role=menu]").addClass("givegift__space");

	//hide finishing step
	$("[href='#finish']").hide();
	
	//stop NaN from showing
	function getNum(val) {
	   if (isNaN(val)) {
	     return 0;
	   }
	   return val;
	}

	//date picker
	$("#gifteeEmailDate").datepicker({
		dateFormat: "dd/mm/yy"
	});

    //typed.js stuff 
    var typed = new Typed('.giftText', {
      strings: ['<b style=color:#0C7ABF;>freedom','<b style=color:#EC80A7;>hope','<b style=color:#F9B000;>justice'],
      typeSpeed: 100,
      backDelay: 2000,
      contentType: 'html',
      loop: true,
      loopCount: Infinity,
      showCursor: false,
      fadeOut:true,
    });


    //picture selection
    $('.gift__small-img').click(function() {
        var backgroundImage = $(this).css('background-image');
        $('#big').css('background-image', backgroundImage);
    });
   
    //design selection
    $('#orangeCircle').click(function() {
        $('#big').css('background-image', 'url(https://hopeforjustice.org/wp-content/uploads/2020/02/orangecard.jpg)');
        $('#small-1').css('background-image', 'url(https://hopeforjustice.org/wp-content/uploads/2020/02/orangecardinside1.jpg)');
        $('#small-2').css('background-image', 'url(https://hopeforjustice.org/wp-content/uploads/2020/02/orangecardinside2.jpg)');
        $('#small-3').css('background-image', 'url(https://hopeforjustice.org/wp-content/uploads/2020/02/orangecardinside3.jpg)');
        $('.gift__details-img').attr('src', 'https://hopeforjustice.org/wp-content/uploads/2020/02/orangecardinside2.jpg');
        giftChoice = "Gift choice: orange, "
        $(this).addClass("gift__circle--selected");
        $('#pinkCircle').removeClass("gift__circle--selected");
        $('#blueCircle').removeClass("gift__circle--selected");
        $('.gift__story-title').html("We helped Mey take the first<br> step to a brighter future");
    });

    $('#pinkCircle').click(function() {
        $('#big').css('background-image', 'url(https://hopeforjustice.org/wp-content/uploads/2020/02/pinkcard.jpg)');
        $('#small-1').css('background-image', 'url(https://hopeforjustice.org/wp-content/uploads/2020/02/pinkcardinside1.jpg)');
        $('#small-2').css('background-image', 'url(https://hopeforjustice.org/wp-content/uploads/2020/02/pinkcardinside2.jpg)');
        $('#small-3').css('background-image', 'url(https://hopeforjustice.org/wp-content/uploads/2020/02/pinkcardinside3.jpg)');
        $('.gift__details-img').attr('src', 'https://hopeforjustice.org/wp-content/uploads/2020/02/pinkcardinside2.jpg');
        giftChoice = "Gift choice: pink, "
        $(this).addClass("gift__circle--selected");
        $('#orangeCircle').removeClass("gift__circle--selected");
        $('#blueCircle').removeClass("gift__circle--selected");
        $('.gift__story-title').html("We helped Hanna to find her <br>way back home to her mum");
    });

    $('#blueCircle').click(function() {
        $('#big').css('background-image', 'url(https://hopeforjustice.org/wp-content/uploads/2020/02/bluecard.jpg)');
        $('#small-1').css('background-image', 'url(https://hopeforjustice.org/wp-content/uploads/2020/02/bluecardinside1.jpg)');
        $('#small-2').css('background-image', 'url(https://hopeforjustice.org/wp-content/uploads/2020/02/bluecardinside2.jpg)');
        $('#small-3').css('background-image', 'url(https://hopeforjustice.org/wp-content/uploads/2020/02/bluecardinside3.jpg)');
        $('.gift__details-img').attr('src', 'https://hopeforjustice.org/wp-content/uploads/2020/02/pinkcardinside2.jpg');
        giftChoice = "Gift choice: blue, "
        $(this).addClass("gift__circle--selected");
        $('#orangeCircle').removeClass("gift__circle--selected");
        $('#pinkCircle').removeClass("gift__circle--selected");
        $('.gift__story-title').html("We helped Emily and her son <br>find a safe place to live.");
    });



    //set gift amount value
    $("input[name='amountOption']").on("click",
        function() {
            $('#Amount').val($(this).val());
            $(this).parent().addClass("givegift__amount-options--selected");
            $("input[name='amountOption']").not(this).parent().removeClass("givegift__amount-options--selected");
    });

    //set subtotal and total
    $(".givegift__subtotal").html($('#Amount').val());
    $(".givegift__total").html($('#Amount').val() + postageAmount);

    //post by default
    $('.givegift__post-options').show();
    $('#gifteeEmail').hide();
    $('#gifteeEmail').val("N/A");
    $('#gifteeEmail').removeClass("required");
    giftType = "Delivery method: Post, "
    $("input[name='giftSendType']").prop('checked', false);
    $("input[name='billingIsDelivery']").prop('checked', false);
    billingIsDelivery = "unset"
    $("#isBilling").show();
    $('#emailBy').hide();
    $(".deliveryOptions").addClass("required");
    $('#deliveryCounty').removeClass('required');
    $(".givegift__delivery-options").show();

    //post or email conditional logic
    $("#Post-button").on("click",function() {
    	$('#CreditCardForm').steps("setStep", 0);
        $('.givegift__post-options').show();
        $('#gifteeEmail').hide();
        $('#gifteeEmail').val("N/A");
        $('#gifteeEmail').removeClass("required");
        giftType = "Delivery method: Post, "
        $("input[name='giftSendType']").prop('checked', false);
        $("input[name='billingIsDelivery']").prop('checked', false);
        billingIsDelivery = "unset"
        $("#isBilling").show();
        $('#emailBy').hide();
        $(".deliveryOptions").addClass("required");
        $('#deliveryCounty').removeClass('required');
        $(".givegift__delivery-options").show();
        $(this).addClass('button--solid');
        $(this).removeClass('button--hollow');
        $("#Email-button").removeClass('button--solid');
        $(".gift__small-text").html('Postage and admin fee: £1.50. Cards are sent by 1st Class post and should arrive within 3-5 working days after your order date. If you need it to arrive within the next 3 working days, please select Email as we cannot guarantee a posted card would arrive in time.');
        $(".givegift__delivery-options").show();
        $("#postalCharge").show();
    });

    //post or email conditional logic
    $("#Email-button").on("click",function() {
    	$('#CreditCardForm').steps("setStep", 0);
        $('.givegift__post-options').hide();
        $('#gifteeEmail').val("");
        $('#sendToMe').removeClass("required");
        $('#gifteeEmail').addClass("required");
        $('#gifteeEmail').show();
        $('#emailBy').show();
        $("#To").addClass("required");
        $("#From").addClass("required");
        $(".givegift__gift-details").show();
        $(".givegift__delivery-options").hide();
        $(".deliveryOptions").removeClass("required");
        giftType = "Delivery method: Email, "
        billingIsDelivery = "N/A"
        $("input[name='giftSendType']").prop('checked', false);
        $("input[name='billingIsDelivery']").prop('checked', false);
        $('#gifteeEmailDate').addClass("required");
        sendToThem = "Yes"
        $("#isBilling").hide();
        $(this).addClass('button--solid');
        $(this).removeClass('button--hollow');
        $("#Post-button").removeClass('button--solid');
        $(".gift__small-text").html('Orders for e-cards placed after 4pm will be processed the next working day. E-cards can be scheduled to arrive on a specific date.');
        $(".givegift__delivery-options").hide();
        $("#postalCharge").hide();
    });
    
    //send to conditional logic
    $("input[name='giftSendType']").on("click",
        function() {
            if ($(this).val() === 'sendToThem') {
                deliveryToWho = "Deliver to: The giftee, "
                billingIsDelivery = "unset"
                sendToThem = "Yes"
                $("#To").addClass("required");
                $("#From").addClass("required");
                $("#message").addClass("required");
                $("input[name='Publicise']").addClass("required");
                $(".givegift__gift-details").show();
                $("input[name='billingIsDelivery']").prop('checked', false);
                giftDetails = "To: " + $("#To").val() + ", " + "From: " +  $("#From").val() + ", "
                + " " + "Message: " + $("#message").val() + ", ";
                $("#isBilling").hide();
                $("#deliveryHeader").html("Recipient’s delivery address");
            } else {
                sendToThem = "No"
                deliveryToWho = "Deliver to: The giver, "
                $("#To").removeClass("required");
                $("#From").removeClass("required");
                $("#message").removeClass("required");
                $('.givegift__gift-details').hide();
                $("input[name='Publicise']").removeClass("required");
                $("input[name='billingIsDelivery']").prop('checked', false);
                giftDetails = "Gift details: To be written by giver, ";
                $("#isBilling").show();
                $("#deliveryHeader").html("Your delivery address");
            }
        });

    //send to conditional logic
    $("input[name='billingIsDelivery']").on("click",
        function() {
            if ($(this).val() === 'Yes') {
                billingIsDelivery = "Yes"
                $("#Title").val($("#deliveryTitle").val());
                $("#FirstName").val($("#deliveryFirstName").val());
                $("#LastName").val($("#deliveryLastName").val());
                $("#Address1").val($("#deliveryAddress1").val());
                $("#Address2").val($("#deliveryAddress2").val());
                $("#Town").val($("#deliveryTown").val());
                $("#County").val($("#deliveryCounty").val());
                $("#Postcode").val($("#deliveryPostcode").val());
            } else if ($(this).val() === 'No') {
                billingIsDelivery = "No"
                $("#Title").val("");
                $("#FirstName").val("");
                $("#LastName").val("");
                $("#Address1").val("");
                $("#Address2").val("");
                $("#Town").val("");
                $("#County").val("");
                $("#Postcode").val("");
            } else {
                billingIsDelivery = "N/A"
            }
        });

    //publicise amount
    $("input[name='Publicise']").on("click",
        function() {
            if ($(this).val() === 'Yes') {
                publiciseAmount = "Publicise amount: Yes, "
            } else if ($(this).val() === 'No') {
                publiciseAmount = "Publicise amount: No, "
            } else {
                publiciseAmount = "Publicise amount: Yes, "
            }
        });

    // Alert on click (dont need once form is processed - just for seeing the result)
    $(".test").on("click",function() {
        validateForm();
        if( $("#CreditCardForm").valid()==true){
            alert($('#Comment').val());
            Completed();
        } else {
            return false;
        }
    });


    function validateForm() {    
	    //validate the form
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
	                    min:5.00,
	                }
	            },
	            messages: {
	                giftChoice: "Please select your gift",
	                Amount: "Please enter the amount you wish to give",
	                giftSendType: "Please select how you would like to send your gift",
	                gifteeEmail: "Please enter the email you wish to send to",
	                To: "Please fill in the \'To\' field",
	                From: "Please fill in the \'From\' field",
	                message: "Please fill in the \'Message\' field",
	                dateReceived: "Please enter the date you wish the gift to be recieved on",
	                Title: "Please enter your title",
	                FirstName: "Please enter your first name",
	                LastName: "Please enter your last name",
	                Email: "Please enter your email address",
	                Address1: "Please enter your address",
	                Town: "Please enter your town/city",
	                County: "Please enter your county",
	                Postcode: "Please enter your post code",
	                Publicise: "Please tell us if you want to publicise the amount given",
	                deliveryFirstName: "Please enter the delivery first name",
	                deliveryLastName: "Please enter the delivery last name",
	                deliveryAddress1: "Please enter the delivery address",
	                deliveryTown: "Please enter the delivery town",
	                deliveryCounty: "Please enter the delivery county",
	                deliveryPostcode: "Please enter the delivery postcode",
	                GiftAid: "Please tell us if you are eligble for GiftAid",
	                gifteeEmailDate: "Please tell us when you would like the email to be sent",

	            },
	            errorElement : 'div',
	            errorLabelContainer: '.errors'
	        }).settings.ignore = ":disabled,:hidden";
	        
	        if( $("#CreditCardForm").valid()==true){


	            if (sendToThem === 'Yes') {
	                deliveryToWho = "Deliver to: The giftee, "
	                giftDetails = "To: " + $("#To").val() + ", " + "From: " +  $("#From").val() + ", "
	                + " " + "Message: " + $("#message").val() + ", ";
	                $("#isBilling").hide();
	            } else {
	                deliveryToWho = "Deliver to: The giver, "
	                giftDetails = "Gift details: To be written by giver, ";
	            }

	            emailBy = "Email by: " + $("#gifteeEmailDate").val() + ", ";

	            emailDelivery = "Email to: " + $("#gifteeEmail").val() + ", ";

	            inspiration = "What inspired the donation: " + $("#giftComment").val();
	            
	            if (billingIsDelivery === 'Yes') {
	                deliveryAddress = "Delivery Address: Same as billing, "
	            } else if (billingIsDelivery === 'No') {
	                deliveryAddress = "Delivery Address: " + $('#deliveryFirstName').val() + " " +
	                $('#deliveryLastName').val() + ", " + $('#deliveryAddress1').val()
	                + ", " + $('#deliveryAddress2').val() + ", " + $('#deliveryTown').val() + ", " +
	                $('#deliveryCounty').val() + ", " + $('#deliveryPostcode').val() + ", ";
	            } else if (billingIsDelivery === 'N/A'){
	                deliveryAddress = "Delivery address: N/A, "
	            } else {
	                deliveryAddress = "Delivery Address: " + $('#deliveryFirstName').val() + " " +
	                $('#deliveryLastName').val() + ", " + $('#deliveryAddress1').val()
	                + ", " + $('#deliveryAddress2').val() + ", " + $('#deliveryTown').val() + ", " +
	                $('#deliveryCounty').val() + ", " + $('#deliveryPostcode').val() + ", ";
	            }

	            var giftComment = giftChoice + giftType + 
	            deliveryToWho + emailDelivery + emailBy + deliveryAddress 
	            + publiciseAmount + giftDetails + inspiration
	            
	            $('#Comment').val(giftComment);
	        }
    }

//end of give the gift scripts




//url parameters
function setUrl() {
	
	if (giftType == "Delivery method: Email, "){
		deliveryMethod = 'Email'
	}else {
		deliveryMethod = 'Post'
	}

	if (giftChoice == "Gift choice: blue, "){
		cardChoice = 'Emily'
	}else if (giftChoice == "Gift choice: orange, "){
		cardChoice = 'Mey'
	}else {
		cardChoice = 'Hanna'
	}

	bg = $("#big").css('background-image');
    bg = bg.replace('url(','').replace(')','').replace(/\"/gi, "");
	Name = $('#FirstName').val();
	deliverBy = $('#gifteeEmailDate').val();

	deliveryAddressReciept = $('#deliveryFirstName').val() + " " +
    $('#deliveryLastName').val() + ", " + $('#deliveryAddress1').val()
    + ", " + $('#deliveryAddress2').val() + ", " + $('#deliveryTown').val() + ", " +
    $('#deliveryCounty').val() + ", " + $('#deliveryPostcode').val() + ", ";

    if (deliveryMethod == 'Email') {
			$('#RedirectToPage').val(
				$('#RedirectToPage').val() + '?amount=' + parseFloat(Total).toFixed(2)
				+ '&deliveryMethod=' + deliveryMethod + '&recepientAddress=' 
				+ $("#gifteeEmail").val() + '&deliverBy=' + deliverBy + '&cardChoice=' + cardChoice 
				+ '&Name=' + Name + '&Img=' + bg);
		} else {
			$('#RedirectToPage').val(
				$('#RedirectToPage').val() + '?amount=' + parseFloat(Total).toFixed(2)
				+ '&deliveryMethod=' + deliveryMethod + '&recepientAddress=' 
				+ deliveryAddressReciept + '&cardChoice=' + cardChoice 
				+ '&Name=' + Name + '&Img=' + bg);
		}

}


















// donorfy functions

/*
(c) Donorfy Ltd 2019
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
                    validateForm();
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
                        DisplayErrorMessage('Please check your details');
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


    jQuery.ajax({
        dataType: 'json',
        url: GetBaseServiceUrl() + 'P1?id=' + id + '&code=' + code + '&amount=' + amount + '&email=' + emailEnc + '&rec=' + recurring,
        method: 'POST',
        type: 'POST'
    }).done(function (data) {

        if (data.OK) {
            jQuery('#submitButton').attr('data-secret', data.RequestData);
            stripe.handleCardPayment(data.RequestData, cardNumber,
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
                }).then(function (result) {
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

    }).fail(function (jqXHR, textStatus, errorThrown) {
        DisplayErrors(GetErrorArray(jqXHR));
    });
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
	setUrl();
    var redirectToPage = jQuery('#RedirectToPage').val();
    if (redirectToPage) {
        window.location = redirectToPage;
    } else {
        window.location = '/';
    }
}

//end of Donorfy functions



});

//post code anywhere donorfy extensions
jQuery(document).ready(function() {
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


/*!
 * 
 *   typed.js - A JavaScript Typing Animation Library
 *   Author: Matt Boldt <me@mattboldt.com>
 *   Version: v2.0.11
 *   Url: https://github.com/mattboldt/typed.js
 *   License(s): MIT
 * 
 */
(function(t,e){"object"==typeof exports&&"object"==typeof module?module.exports=e():"function"==typeof define&&define.amd?define([],e):"object"==typeof exports?exports.Typed=e():t.Typed=e()})(this,function(){return function(t){function e(n){if(s[n])return s[n].exports;var i=s[n]={exports:{},id:n,loaded:!1};return t[n].call(i.exports,i,i.exports,e),i.loaded=!0,i.exports}var s={};return e.m=t,e.c=s,e.p="",e(0)}([function(t,e,s){"use strict";function n(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}Object.defineProperty(e,"__esModule",{value:!0});var i=function(){function t(t,e){for(var s=0;s<e.length;s++){var n=e[s];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(t,n.key,n)}}return function(e,s,n){return s&&t(e.prototype,s),n&&t(e,n),e}}(),r=s(1),o=s(3),a=function(){function t(e,s){n(this,t),r.initializer.load(this,s,e),this.begin()}return i(t,[{key:"toggle",value:function(){this.pause.status?this.start():this.stop()}},{key:"stop",value:function(){this.typingComplete||this.pause.status||(this.toggleBlinking(!0),this.pause.status=!0,this.options.onStop(this.arrayPos,this))}},{key:"start",value:function(){this.typingComplete||this.pause.status&&(this.pause.status=!1,this.pause.typewrite?this.typewrite(this.pause.curString,this.pause.curStrPos):this.backspace(this.pause.curString,this.pause.curStrPos),this.options.onStart(this.arrayPos,this))}},{key:"destroy",value:function(){this.reset(!1),this.options.onDestroy(this)}},{key:"reset",value:function(){var t=arguments.length<=0||void 0===arguments[0]||arguments[0];clearInterval(this.timeout),this.replaceText(""),this.cursor&&this.cursor.parentNode&&(this.cursor.parentNode.removeChild(this.cursor),this.cursor=null),this.strPos=0,this.arrayPos=0,this.curLoop=0,t&&(this.insertCursor(),this.options.onReset(this),this.begin())}},{key:"begin",value:function(){var t=this;this.options.onBegin(this),this.typingComplete=!1,this.shuffleStringsIfNeeded(this),this.insertCursor(),this.bindInputFocusEvents&&this.bindFocusEvents(),this.timeout=setTimeout(function(){t.currentElContent&&0!==t.currentElContent.length?t.backspace(t.currentElContent,t.currentElContent.length):t.typewrite(t.strings[t.sequence[t.arrayPos]],t.strPos)},this.startDelay)}},{key:"typewrite",value:function(t,e){var s=this;this.fadeOut&&this.el.classList.contains(this.fadeOutClass)&&(this.el.classList.remove(this.fadeOutClass),this.cursor&&this.cursor.classList.remove(this.fadeOutClass));var n=this.humanizer(this.typeSpeed),i=1;return this.pause.status===!0?void this.setPauseStatus(t,e,!0):void(this.timeout=setTimeout(function(){e=o.htmlParser.typeHtmlChars(t,e,s);var n=0,r=t.substr(e);if("^"===r.charAt(0)&&/^\^\d+/.test(r)){var a=1;r=/\d+/.exec(r)[0],a+=r.length,n=parseInt(r),s.temporaryPause=!0,s.options.onTypingPaused(s.arrayPos,s),t=t.substring(0,e)+t.substring(e+a),s.toggleBlinking(!0)}if("`"===r.charAt(0)){for(;"`"!==t.substr(e+i).charAt(0)&&(i++,!(e+i>t.length)););var u=t.substring(0,e),l=t.substring(u.length+1,e+i),c=t.substring(e+i+1);t=u+l+c,i--}s.timeout=setTimeout(function(){s.toggleBlinking(!1),e>=t.length?s.doneTyping(t,e):s.keepTyping(t,e,i),s.temporaryPause&&(s.temporaryPause=!1,s.options.onTypingResumed(s.arrayPos,s))},n)},n))}},{key:"keepTyping",value:function(t,e,s){0===e&&(this.toggleBlinking(!1),this.options.preStringTyped(this.arrayPos,this)),e+=s;var n=t.substr(0,e);this.replaceText(n),this.typewrite(t,e)}},{key:"doneTyping",value:function(t,e){var s=this;this.options.onStringTyped(this.arrayPos,this),this.toggleBlinking(!0),this.arrayPos===this.strings.length-1&&(this.complete(),this.loop===!1||this.curLoop===this.loopCount)||(this.timeout=setTimeout(function(){s.backspace(t,e)},this.backDelay))}},{key:"backspace",value:function(t,e){var s=this;if(this.pause.status===!0)return void this.setPauseStatus(t,e,!0);if(this.fadeOut)return this.initFadeOut();this.toggleBlinking(!1);var n=this.humanizer(this.backSpeed);this.timeout=setTimeout(function(){e=o.htmlParser.backSpaceHtmlChars(t,e,s);var n=t.substr(0,e);if(s.replaceText(n),s.smartBackspace){var i=s.strings[s.arrayPos+1];i&&n===i.substr(0,e)?s.stopNum=e:s.stopNum=0}e>s.stopNum?(e--,s.backspace(t,e)):e<=s.stopNum&&(s.arrayPos++,s.arrayPos===s.strings.length?(s.arrayPos=0,s.options.onLastStringBackspaced(),s.shuffleStringsIfNeeded(),s.begin()):s.typewrite(s.strings[s.sequence[s.arrayPos]],e))},n)}},{key:"complete",value:function(){this.options.onComplete(this),this.loop?this.curLoop++:this.typingComplete=!0}},{key:"setPauseStatus",value:function(t,e,s){this.pause.typewrite=s,this.pause.curString=t,this.pause.curStrPos=e}},{key:"toggleBlinking",value:function(t){this.cursor&&(this.pause.status||this.cursorBlinking!==t&&(this.cursorBlinking=t,t?this.cursor.classList.add("typed-cursor--blink"):this.cursor.classList.remove("typed-cursor--blink")))}},{key:"humanizer",value:function(t){return Math.round(Math.random()*t/2)+t}},{key:"shuffleStringsIfNeeded",value:function(){this.shuffle&&(this.sequence=this.sequence.sort(function(){return Math.random()-.5}))}},{key:"initFadeOut",value:function(){var t=this;return this.el.className+=" "+this.fadeOutClass,this.cursor&&(this.cursor.className+=" "+this.fadeOutClass),setTimeout(function(){t.arrayPos++,t.replaceText(""),t.strings.length>t.arrayPos?t.typewrite(t.strings[t.sequence[t.arrayPos]],0):(t.typewrite(t.strings[0],0),t.arrayPos=0)},this.fadeOutDelay)}},{key:"replaceText",value:function(t){this.attr?this.el.setAttribute(this.attr,t):this.isInput?this.el.value=t:"html"===this.contentType?this.el.innerHTML=t:this.el.textContent=t}},{key:"bindFocusEvents",value:function(){var t=this;this.isInput&&(this.el.addEventListener("focus",function(e){t.stop()}),this.el.addEventListener("blur",function(e){t.el.value&&0!==t.el.value.length||t.start()}))}},{key:"insertCursor",value:function(){this.showCursor&&(this.cursor||(this.cursor=document.createElement("span"),this.cursor.className="typed-cursor",this.cursor.innerHTML=this.cursorChar,this.el.parentNode&&this.el.parentNode.insertBefore(this.cursor,this.el.nextSibling)))}}]),t}();e["default"]=a,t.exports=e["default"]},function(t,e,s){"use strict";function n(t){return t&&t.__esModule?t:{"default":t}}function i(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}Object.defineProperty(e,"__esModule",{value:!0});var r=Object.assign||function(t){for(var e=1;e<arguments.length;e++){var s=arguments[e];for(var n in s)Object.prototype.hasOwnProperty.call(s,n)&&(t[n]=s[n])}return t},o=function(){function t(t,e){for(var s=0;s<e.length;s++){var n=e[s];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(t,n.key,n)}}return function(e,s,n){return s&&t(e.prototype,s),n&&t(e,n),e}}(),a=s(2),u=n(a),l=function(){function t(){i(this,t)}return o(t,[{key:"load",value:function(t,e,s){if("string"==typeof s?t.el=document.querySelector(s):t.el=s,t.options=r({},u["default"],e),t.isInput="input"===t.el.tagName.toLowerCase(),t.attr=t.options.attr,t.bindInputFocusEvents=t.options.bindInputFocusEvents,t.showCursor=!t.isInput&&t.options.showCursor,t.cursorChar=t.options.cursorChar,t.cursorBlinking=!0,t.elContent=t.attr?t.el.getAttribute(t.attr):t.el.textContent,t.contentType=t.options.contentType,t.typeSpeed=t.options.typeSpeed,t.startDelay=t.options.startDelay,t.backSpeed=t.options.backSpeed,t.smartBackspace=t.options.smartBackspace,t.backDelay=t.options.backDelay,t.fadeOut=t.options.fadeOut,t.fadeOutClass=t.options.fadeOutClass,t.fadeOutDelay=t.options.fadeOutDelay,t.isPaused=!1,t.strings=t.options.strings.map(function(t){return t.trim()}),"string"==typeof t.options.stringsElement?t.stringsElement=document.querySelector(t.options.stringsElement):t.stringsElement=t.options.stringsElement,t.stringsElement){t.strings=[],t.stringsElement.style.display="none";var n=Array.prototype.slice.apply(t.stringsElement.children),i=n.length;if(i)for(var o=0;o<i;o+=1){var a=n[o];t.strings.push(a.innerHTML.trim())}}t.strPos=0,t.arrayPos=0,t.stopNum=0,t.loop=t.options.loop,t.loopCount=t.options.loopCount,t.curLoop=0,t.shuffle=t.options.shuffle,t.sequence=[],t.pause={status:!1,typewrite:!0,curString:"",curStrPos:0},t.typingComplete=!1;for(var o in t.strings)t.sequence[o]=o;t.currentElContent=this.getCurrentElContent(t),t.autoInsertCss=t.options.autoInsertCss,this.appendAnimationCss(t)}},{key:"getCurrentElContent",value:function(t){var e="";return e=t.attr?t.el.getAttribute(t.attr):t.isInput?t.el.value:"html"===t.contentType?t.el.innerHTML:t.el.textContent}},{key:"appendAnimationCss",value:function(t){var e="data-typed-js-css";if(t.autoInsertCss&&(t.showCursor||t.fadeOut)&&!document.querySelector("["+e+"]")){var s=document.createElement("style");s.type="text/css",s.setAttribute(e,!0);var n="";t.showCursor&&(n+="\n        .typed-cursor{\n          opacity: 1;\n        }\n        .typed-cursor.typed-cursor--blink{\n          animation: typedjsBlink 0.4s infinite;\n          -webkit-animation: typedjsBlink 0.4s infinite;\n                  animation: typedjsBlink 0.4s infinite;\n        }\n        @keyframes typedjsBlink{\n          50% { opacity: 0.0; }\n        }\n        @-webkit-keyframes typedjsBlink{\n          0% { opacity: 1; }\n          50% { opacity: 0.0; }\n          100% { opacity: 1; }\n        }\n      "),t.fadeOut&&(n+="\n        .typed-fade-out{\n          opacity: 0;\n          transition: opacity .25s;\n        }\n        .typed-cursor.typed-cursor--blink.typed-fade-out{\n          -webkit-animation: 0;\n          animation: 0;\n        }\n      "),0!==s.length&&(s.innerHTML=n,document.body.appendChild(s))}}}]),t}();e["default"]=l;var c=new l;e.initializer=c},function(t,e){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var s={strings:["These are the default values...","You know what you should do?","Use your own!","Have a great day!"],stringsElement:null,typeSpeed:0,startDelay:0,backSpeed:0,smartBackspace:!0,shuffle:!1,backDelay:700,fadeOut:!1,fadeOutClass:"typed-fade-out",fadeOutDelay:500,loop:!1,loopCount:1/0,showCursor:!0,cursorChar:"|",autoInsertCss:!0,attr:null,bindInputFocusEvents:!1,contentType:"html",onBegin:function(t){},onComplete:function(t){},preStringTyped:function(t,e){},onStringTyped:function(t,e){},onLastStringBackspaced:function(t){},onTypingPaused:function(t,e){},onTypingResumed:function(t,e){},onReset:function(t){},onStop:function(t,e){},onStart:function(t,e){},onDestroy:function(t){}};e["default"]=s,t.exports=e["default"]},function(t,e){"use strict";function s(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}Object.defineProperty(e,"__esModule",{value:!0});var n=function(){function t(t,e){for(var s=0;s<e.length;s++){var n=e[s];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(t,n.key,n)}}return function(e,s,n){return s&&t(e.prototype,s),n&&t(e,n),e}}(),i=function(){function t(){s(this,t)}return n(t,[{key:"typeHtmlChars",value:function(t,e,s){if("html"!==s.contentType)return e;var n=t.substr(e).charAt(0);if("<"===n||"&"===n){var i="";for(i="<"===n?">":";";t.substr(e+1).charAt(0)!==i&&(e++,!(e+1>t.length)););e++}return e}},{key:"backSpaceHtmlChars",value:function(t,e,s){if("html"!==s.contentType)return e;var n=t.substr(e).charAt(0);if(">"===n||";"===n){var i="";for(i=">"===n?"<":"&";t.substr(e-1).charAt(0)!==i&&(e--,!(e<0)););e--}return e}}]),t}();e["default"]=i;var r=new i;e.htmlParser=r}])});
//# sourceMappingURL=typed.min.js.map

/*! jQuery UI - v1.12.1 - 2020-03-04
* http://jqueryui.com
* Includes: widget.js, keycode.js, widgets/datepicker.js
* Copyright jQuery Foundation and other contributors; Licensed MIT */

(function(t){"function"==typeof define&&define.amd?define(["jquery"],t):t(jQuery)})(function(t){function e(t){for(var e,i;t.length&&t[0]!==document;){if(e=t.css("position"),("absolute"===e||"relative"===e||"fixed"===e)&&(i=parseInt(t.css("zIndex"),10),!isNaN(i)&&0!==i))return i;t=t.parent()}return 0}function i(){this._curInst=null,this._keyEvent=!1,this._disabledInputs=[],this._datepickerShowing=!1,this._inDialog=!1,this._mainDivId="ui-datepicker-div",this._inlineClass="ui-datepicker-inline",this._appendClass="ui-datepicker-append",this._triggerClass="ui-datepicker-trigger",this._dialogClass="ui-datepicker-dialog",this._disableClass="ui-datepicker-disabled",this._unselectableClass="ui-datepicker-unselectable",this._currentClass="ui-datepicker-current-day",this._dayOverClass="ui-datepicker-days-cell-over",this.regional=[],this.regional[""]={closeText:"Done",prevText:"Prev",nextText:"Next",currentText:"Today",monthNames:["January","February","March","April","May","June","July","August","September","October","November","December"],monthNamesShort:["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],dayNames:["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],dayNamesShort:["Sun","Mon","Tue","Wed","Thu","Fri","Sat"],dayNamesMin:["Su","Mo","Tu","We","Th","Fr","Sa"],weekHeader:"Wk",dateFormat:"mm/dd/yy",firstDay:0,isRTL:!1,showMonthAfterYear:!1,yearSuffix:""},this._defaults={showOn:"focus",showAnim:"fadeIn",showOptions:{},defaultDate:null,appendText:"",buttonText:"...",buttonImage:"",buttonImageOnly:!1,hideIfNoPrevNext:!1,navigationAsDateFormat:!1,gotoCurrent:!1,changeMonth:!1,changeYear:!1,yearRange:"c-10:c+10",showOtherMonths:!1,selectOtherMonths:!1,showWeek:!1,calculateWeek:this.iso8601Week,shortYearCutoff:"+10",minDate:null,maxDate:null,duration:"fast",beforeShowDay:null,beforeShow:null,onSelect:null,onChangeMonthYear:null,onClose:null,numberOfMonths:1,showCurrentAtPos:0,stepMonths:1,stepBigMonths:12,altField:"",altFormat:"",constrainInput:!0,showButtonPanel:!1,autoSize:!1,disabled:!1},t.extend(this._defaults,this.regional[""]),this.regional.en=t.extend(!0,{},this.regional[""]),this.regional["en-US"]=t.extend(!0,{},this.regional.en),this.dpDiv=s(t("<div id='"+this._mainDivId+"' class='ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all'></div>"))}function s(e){var i="button, .ui-datepicker-prev, .ui-datepicker-next, .ui-datepicker-calendar td a";return e.on("mouseout",i,function(){t(this).removeClass("ui-state-hover"),-1!==this.className.indexOf("ui-datepicker-prev")&&t(this).removeClass("ui-datepicker-prev-hover"),-1!==this.className.indexOf("ui-datepicker-next")&&t(this).removeClass("ui-datepicker-next-hover")}).on("mouseover",i,n)}function n(){t.datepicker._isDisabledDatepicker(l.inline?l.dpDiv.parent()[0]:l.input[0])||(t(this).parents(".ui-datepicker-calendar").find("a").removeClass("ui-state-hover"),t(this).addClass("ui-state-hover"),-1!==this.className.indexOf("ui-datepicker-prev")&&t(this).addClass("ui-datepicker-prev-hover"),-1!==this.className.indexOf("ui-datepicker-next")&&t(this).addClass("ui-datepicker-next-hover"))}function o(e,i){t.extend(e,i);for(var s in i)null==i[s]&&(e[s]=i[s]);return e}t.ui=t.ui||{},t.ui.version="1.12.1";var a=0,r=Array.prototype.slice;t.cleanData=function(e){return function(i){var s,n,o;for(o=0;null!=(n=i[o]);o++)try{s=t._data(n,"events"),s&&s.remove&&t(n).triggerHandler("remove")}catch(a){}e(i)}}(t.cleanData),t.widget=function(e,i,s){var n,o,a,r={},l=e.split(".")[0];e=e.split(".")[1];var h=l+"-"+e;return s||(s=i,i=t.Widget),t.isArray(s)&&(s=t.extend.apply(null,[{}].concat(s))),t.expr[":"][h.toLowerCase()]=function(e){return!!t.data(e,h)},t[l]=t[l]||{},n=t[l][e],o=t[l][e]=function(t,e){return this._createWidget?(arguments.length&&this._createWidget(t,e),void 0):new o(t,e)},t.extend(o,n,{version:s.version,_proto:t.extend({},s),_childConstructors:[]}),a=new i,a.options=t.widget.extend({},a.options),t.each(s,function(e,s){return t.isFunction(s)?(r[e]=function(){function t(){return i.prototype[e].apply(this,arguments)}function n(t){return i.prototype[e].apply(this,t)}return function(){var e,i=this._super,o=this._superApply;return this._super=t,this._superApply=n,e=s.apply(this,arguments),this._super=i,this._superApply=o,e}}(),void 0):(r[e]=s,void 0)}),o.prototype=t.widget.extend(a,{widgetEventPrefix:n?a.widgetEventPrefix||e:e},r,{constructor:o,namespace:l,widgetName:e,widgetFullName:h}),n?(t.each(n._childConstructors,function(e,i){var s=i.prototype;t.widget(s.namespace+"."+s.widgetName,o,i._proto)}),delete n._childConstructors):i._childConstructors.push(o),t.widget.bridge(e,o),o},t.widget.extend=function(e){for(var i,s,n=r.call(arguments,1),o=0,a=n.length;a>o;o++)for(i in n[o])s=n[o][i],n[o].hasOwnProperty(i)&&void 0!==s&&(e[i]=t.isPlainObject(s)?t.isPlainObject(e[i])?t.widget.extend({},e[i],s):t.widget.extend({},s):s);return e},t.widget.bridge=function(e,i){var s=i.prototype.widgetFullName||e;t.fn[e]=function(n){var o="string"==typeof n,a=r.call(arguments,1),l=this;return o?this.length||"instance"!==n?this.each(function(){var i,o=t.data(this,s);return"instance"===n?(l=o,!1):o?t.isFunction(o[n])&&"_"!==n.charAt(0)?(i=o[n].apply(o,a),i!==o&&void 0!==i?(l=i&&i.jquery?l.pushStack(i.get()):i,!1):void 0):t.error("no such method '"+n+"' for "+e+" widget instance"):t.error("cannot call methods on "+e+" prior to initialization; "+"attempted to call method '"+n+"'")}):l=void 0:(a.length&&(n=t.widget.extend.apply(null,[n].concat(a))),this.each(function(){var e=t.data(this,s);e?(e.option(n||{}),e._init&&e._init()):t.data(this,s,new i(n,this))})),l}},t.Widget=function(){},t.Widget._childConstructors=[],t.Widget.prototype={widgetName:"widget",widgetEventPrefix:"",defaultElement:"<div>",options:{classes:{},disabled:!1,create:null},_createWidget:function(e,i){i=t(i||this.defaultElement||this)[0],this.element=t(i),this.uuid=a++,this.eventNamespace="."+this.widgetName+this.uuid,this.bindings=t(),this.hoverable=t(),this.focusable=t(),this.classesElementLookup={},i!==this&&(t.data(i,this.widgetFullName,this),this._on(!0,this.element,{remove:function(t){t.target===i&&this.destroy()}}),this.document=t(i.style?i.ownerDocument:i.document||i),this.window=t(this.document[0].defaultView||this.document[0].parentWindow)),this.options=t.widget.extend({},this.options,this._getCreateOptions(),e),this._create(),this.options.disabled&&this._setOptionDisabled(this.options.disabled),this._trigger("create",null,this._getCreateEventData()),this._init()},_getCreateOptions:function(){return{}},_getCreateEventData:t.noop,_create:t.noop,_init:t.noop,destroy:function(){var e=this;this._destroy(),t.each(this.classesElementLookup,function(t,i){e._removeClass(i,t)}),this.element.off(this.eventNamespace).removeData(this.widgetFullName),this.widget().off(this.eventNamespace).removeAttr("aria-disabled"),this.bindings.off(this.eventNamespace)},_destroy:t.noop,widget:function(){return this.element},option:function(e,i){var s,n,o,a=e;if(0===arguments.length)return t.widget.extend({},this.options);if("string"==typeof e)if(a={},s=e.split("."),e=s.shift(),s.length){for(n=a[e]=t.widget.extend({},this.options[e]),o=0;s.length-1>o;o++)n[s[o]]=n[s[o]]||{},n=n[s[o]];if(e=s.pop(),1===arguments.length)return void 0===n[e]?null:n[e];n[e]=i}else{if(1===arguments.length)return void 0===this.options[e]?null:this.options[e];a[e]=i}return this._setOptions(a),this},_setOptions:function(t){var e;for(e in t)this._setOption(e,t[e]);return this},_setOption:function(t,e){return"classes"===t&&this._setOptionClasses(e),this.options[t]=e,"disabled"===t&&this._setOptionDisabled(e),this},_setOptionClasses:function(e){var i,s,n;for(i in e)n=this.classesElementLookup[i],e[i]!==this.options.classes[i]&&n&&n.length&&(s=t(n.get()),this._removeClass(n,i),s.addClass(this._classes({element:s,keys:i,classes:e,add:!0})))},_setOptionDisabled:function(t){this._toggleClass(this.widget(),this.widgetFullName+"-disabled",null,!!t),t&&(this._removeClass(this.hoverable,null,"ui-state-hover"),this._removeClass(this.focusable,null,"ui-state-focus"))},enable:function(){return this._setOptions({disabled:!1})},disable:function(){return this._setOptions({disabled:!0})},_classes:function(e){function i(i,o){var a,r;for(r=0;i.length>r;r++)a=n.classesElementLookup[i[r]]||t(),a=e.add?t(t.unique(a.get().concat(e.element.get()))):t(a.not(e.element).get()),n.classesElementLookup[i[r]]=a,s.push(i[r]),o&&e.classes[i[r]]&&s.push(e.classes[i[r]])}var s=[],n=this;return e=t.extend({element:this.element,classes:this.options.classes||{}},e),this._on(e.element,{remove:"_untrackClassesElement"}),e.keys&&i(e.keys.match(/\S+/g)||[],!0),e.extra&&i(e.extra.match(/\S+/g)||[]),s.join(" ")},_untrackClassesElement:function(e){var i=this;t.each(i.classesElementLookup,function(s,n){-1!==t.inArray(e.target,n)&&(i.classesElementLookup[s]=t(n.not(e.target).get()))})},_removeClass:function(t,e,i){return this._toggleClass(t,e,i,!1)},_addClass:function(t,e,i){return this._toggleClass(t,e,i,!0)},_toggleClass:function(t,e,i,s){s="boolean"==typeof s?s:i;var n="string"==typeof t||null===t,o={extra:n?e:i,keys:n?t:e,element:n?this.element:t,add:s};return o.element.toggleClass(this._classes(o),s),this},_on:function(e,i,s){var n,o=this;"boolean"!=typeof e&&(s=i,i=e,e=!1),s?(i=n=t(i),this.bindings=this.bindings.add(i)):(s=i,i=this.element,n=this.widget()),t.each(s,function(s,a){function r(){return e||o.options.disabled!==!0&&!t(this).hasClass("ui-state-disabled")?("string"==typeof a?o[a]:a).apply(o,arguments):void 0}"string"!=typeof a&&(r.guid=a.guid=a.guid||r.guid||t.guid++);var l=s.match(/^([\w:-]*)\s*(.*)$/),h=l[1]+o.eventNamespace,c=l[2];c?n.on(h,c,r):i.on(h,r)})},_off:function(e,i){i=(i||"").split(" ").join(this.eventNamespace+" ")+this.eventNamespace,e.off(i).off(i),this.bindings=t(this.bindings.not(e).get()),this.focusable=t(this.focusable.not(e).get()),this.hoverable=t(this.hoverable.not(e).get())},_delay:function(t,e){function i(){return("string"==typeof t?s[t]:t).apply(s,arguments)}var s=this;return setTimeout(i,e||0)},_hoverable:function(e){this.hoverable=this.hoverable.add(e),this._on(e,{mouseenter:function(e){this._addClass(t(e.currentTarget),null,"ui-state-hover")},mouseleave:function(e){this._removeClass(t(e.currentTarget),null,"ui-state-hover")}})},_focusable:function(e){this.focusable=this.focusable.add(e),this._on(e,{focusin:function(e){this._addClass(t(e.currentTarget),null,"ui-state-focus")},focusout:function(e){this._removeClass(t(e.currentTarget),null,"ui-state-focus")}})},_trigger:function(e,i,s){var n,o,a=this.options[e];if(s=s||{},i=t.Event(i),i.type=(e===this.widgetEventPrefix?e:this.widgetEventPrefix+e).toLowerCase(),i.target=this.element[0],o=i.originalEvent)for(n in o)n in i||(i[n]=o[n]);return this.element.trigger(i,s),!(t.isFunction(a)&&a.apply(this.element[0],[i].concat(s))===!1||i.isDefaultPrevented())}},t.each({show:"fadeIn",hide:"fadeOut"},function(e,i){t.Widget.prototype["_"+e]=function(s,n,o){"string"==typeof n&&(n={effect:n});var a,r=n?n===!0||"number"==typeof n?i:n.effect||i:e;n=n||{},"number"==typeof n&&(n={duration:n}),a=!t.isEmptyObject(n),n.complete=o,n.delay&&s.delay(n.delay),a&&t.effects&&t.effects.effect[r]?s[e](n):r!==e&&s[r]?s[r](n.duration,n.easing,o):s.queue(function(i){t(this)[e](),o&&o.call(s[0]),i()})}}),t.widget,t.ui.keyCode={BACKSPACE:8,COMMA:188,DELETE:46,DOWN:40,END:35,ENTER:13,ESCAPE:27,HOME:36,LEFT:37,PAGE_DOWN:34,PAGE_UP:33,PERIOD:190,RIGHT:39,SPACE:32,TAB:9,UP:38},t.extend(t.ui,{datepicker:{version:"1.12.1"}});var l;t.extend(i.prototype,{markerClassName:"hasDatepicker",maxRows:4,_widgetDatepicker:function(){return this.dpDiv},setDefaults:function(t){return o(this._defaults,t||{}),this},_attachDatepicker:function(e,i){var s,n,o;s=e.nodeName.toLowerCase(),n="div"===s||"span"===s,e.id||(this.uuid+=1,e.id="dp"+this.uuid),o=this._newInst(t(e),n),o.settings=t.extend({},i||{}),"input"===s?this._connectDatepicker(e,o):n&&this._inlineDatepicker(e,o)},_newInst:function(e,i){var n=e[0].id.replace(/([^A-Za-z0-9_\-])/g,"\\\\$1");return{id:n,input:e,selectedDay:0,selectedMonth:0,selectedYear:0,drawMonth:0,drawYear:0,inline:i,dpDiv:i?s(t("<div class='"+this._inlineClass+" ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all'></div>")):this.dpDiv}},_connectDatepicker:function(e,i){var s=t(e);i.append=t([]),i.trigger=t([]),s.hasClass(this.markerClassName)||(this._attachments(s,i),s.addClass(this.markerClassName).on("keydown",this._doKeyDown).on("keypress",this._doKeyPress).on("keyup",this._doKeyUp),this._autoSize(i),t.data(e,"datepicker",i),i.settings.disabled&&this._disableDatepicker(e))},_attachments:function(e,i){var s,n,o,a=this._get(i,"appendText"),r=this._get(i,"isRTL");i.append&&i.append.remove(),a&&(i.append=t("<span class='"+this._appendClass+"'>"+a+"</span>"),e[r?"before":"after"](i.append)),e.off("focus",this._showDatepicker),i.trigger&&i.trigger.remove(),s=this._get(i,"showOn"),("focus"===s||"both"===s)&&e.on("focus",this._showDatepicker),("button"===s||"both"===s)&&(n=this._get(i,"buttonText"),o=this._get(i,"buttonImage"),i.trigger=t(this._get(i,"buttonImageOnly")?t("<img/>").addClass(this._triggerClass).attr({src:o,alt:n,title:n}):t("<button type='button'></button>").addClass(this._triggerClass).html(o?t("<img/>").attr({src:o,alt:n,title:n}):n)),e[r?"before":"after"](i.trigger),i.trigger.on("click",function(){return t.datepicker._datepickerShowing&&t.datepicker._lastInput===e[0]?t.datepicker._hideDatepicker():t.datepicker._datepickerShowing&&t.datepicker._lastInput!==e[0]?(t.datepicker._hideDatepicker(),t.datepicker._showDatepicker(e[0])):t.datepicker._showDatepicker(e[0]),!1}))},_autoSize:function(t){if(this._get(t,"autoSize")&&!t.inline){var e,i,s,n,o=new Date(2009,11,20),a=this._get(t,"dateFormat");a.match(/[DM]/)&&(e=function(t){for(i=0,s=0,n=0;t.length>n;n++)t[n].length>i&&(i=t[n].length,s=n);return s},o.setMonth(e(this._get(t,a.match(/MM/)?"monthNames":"monthNamesShort"))),o.setDate(e(this._get(t,a.match(/DD/)?"dayNames":"dayNamesShort"))+20-o.getDay())),t.input.attr("size",this._formatDate(t,o).length)}},_inlineDatepicker:function(e,i){var s=t(e);s.hasClass(this.markerClassName)||(s.addClass(this.markerClassName).append(i.dpDiv),t.data(e,"datepicker",i),this._setDate(i,this._getDefaultDate(i),!0),this._updateDatepicker(i),this._updateAlternate(i),i.settings.disabled&&this._disableDatepicker(e),i.dpDiv.css("display","block"))},_dialogDatepicker:function(e,i,s,n,a){var r,l,h,c,u,d=this._dialogInst;return d||(this.uuid+=1,r="dp"+this.uuid,this._dialogInput=t("<input type='text' id='"+r+"' style='position: absolute; top: -100px; width: 0px;'/>"),this._dialogInput.on("keydown",this._doKeyDown),t("body").append(this._dialogInput),d=this._dialogInst=this._newInst(this._dialogInput,!1),d.settings={},t.data(this._dialogInput[0],"datepicker",d)),o(d.settings,n||{}),i=i&&i.constructor===Date?this._formatDate(d,i):i,this._dialogInput.val(i),this._pos=a?a.length?a:[a.pageX,a.pageY]:null,this._pos||(l=document.documentElement.clientWidth,h=document.documentElement.clientHeight,c=document.documentElement.scrollLeft||document.body.scrollLeft,u=document.documentElement.scrollTop||document.body.scrollTop,this._pos=[l/2-100+c,h/2-150+u]),this._dialogInput.css("left",this._pos[0]+20+"px").css("top",this._pos[1]+"px"),d.settings.onSelect=s,this._inDialog=!0,this.dpDiv.addClass(this._dialogClass),this._showDatepicker(this._dialogInput[0]),t.blockUI&&t.blockUI(this.dpDiv),t.data(this._dialogInput[0],"datepicker",d),this},_destroyDatepicker:function(e){var i,s=t(e),n=t.data(e,"datepicker");s.hasClass(this.markerClassName)&&(i=e.nodeName.toLowerCase(),t.removeData(e,"datepicker"),"input"===i?(n.append.remove(),n.trigger.remove(),s.removeClass(this.markerClassName).off("focus",this._showDatepicker).off("keydown",this._doKeyDown).off("keypress",this._doKeyPress).off("keyup",this._doKeyUp)):("div"===i||"span"===i)&&s.removeClass(this.markerClassName).empty(),l===n&&(l=null))},_enableDatepicker:function(e){var i,s,n=t(e),o=t.data(e,"datepicker");n.hasClass(this.markerClassName)&&(i=e.nodeName.toLowerCase(),"input"===i?(e.disabled=!1,o.trigger.filter("button").each(function(){this.disabled=!1}).end().filter("img").css({opacity:"1.0",cursor:""})):("div"===i||"span"===i)&&(s=n.children("."+this._inlineClass),s.children().removeClass("ui-state-disabled"),s.find("select.ui-datepicker-month, select.ui-datepicker-year").prop("disabled",!1)),this._disabledInputs=t.map(this._disabledInputs,function(t){return t===e?null:t}))},_disableDatepicker:function(e){var i,s,n=t(e),o=t.data(e,"datepicker");n.hasClass(this.markerClassName)&&(i=e.nodeName.toLowerCase(),"input"===i?(e.disabled=!0,o.trigger.filter("button").each(function(){this.disabled=!0}).end().filter("img").css({opacity:"0.5",cursor:"default"})):("div"===i||"span"===i)&&(s=n.children("."+this._inlineClass),s.children().addClass("ui-state-disabled"),s.find("select.ui-datepicker-month, select.ui-datepicker-year").prop("disabled",!0)),this._disabledInputs=t.map(this._disabledInputs,function(t){return t===e?null:t}),this._disabledInputs[this._disabledInputs.length]=e)},_isDisabledDatepicker:function(t){if(!t)return!1;for(var e=0;this._disabledInputs.length>e;e++)if(this._disabledInputs[e]===t)return!0;return!1},_getInst:function(e){try{return t.data(e,"datepicker")}catch(i){throw"Missing instance data for this datepicker"}},_optionDatepicker:function(e,i,s){var n,a,r,l,h=this._getInst(e);return 2===arguments.length&&"string"==typeof i?"defaults"===i?t.extend({},t.datepicker._defaults):h?"all"===i?t.extend({},h.settings):this._get(h,i):null:(n=i||{},"string"==typeof i&&(n={},n[i]=s),h&&(this._curInst===h&&this._hideDatepicker(),a=this._getDateDatepicker(e,!0),r=this._getMinMaxDate(h,"min"),l=this._getMinMaxDate(h,"max"),o(h.settings,n),null!==r&&void 0!==n.dateFormat&&void 0===n.minDate&&(h.settings.minDate=this._formatDate(h,r)),null!==l&&void 0!==n.dateFormat&&void 0===n.maxDate&&(h.settings.maxDate=this._formatDate(h,l)),"disabled"in n&&(n.disabled?this._disableDatepicker(e):this._enableDatepicker(e)),this._attachments(t(e),h),this._autoSize(h),this._setDate(h,a),this._updateAlternate(h),this._updateDatepicker(h)),void 0)},_changeDatepicker:function(t,e,i){this._optionDatepicker(t,e,i)},_refreshDatepicker:function(t){var e=this._getInst(t);e&&this._updateDatepicker(e)},_setDateDatepicker:function(t,e){var i=this._getInst(t);i&&(this._setDate(i,e),this._updateDatepicker(i),this._updateAlternate(i))},_getDateDatepicker:function(t,e){var i=this._getInst(t);return i&&!i.inline&&this._setDateFromField(i,e),i?this._getDate(i):null},_doKeyDown:function(e){var i,s,n,o=t.datepicker._getInst(e.target),a=!0,r=o.dpDiv.is(".ui-datepicker-rtl");if(o._keyEvent=!0,t.datepicker._datepickerShowing)switch(e.keyCode){case 9:t.datepicker._hideDatepicker(),a=!1;break;case 13:return n=t("td."+t.datepicker._dayOverClass+":not(."+t.datepicker._currentClass+")",o.dpDiv),n[0]&&t.datepicker._selectDay(e.target,o.selectedMonth,o.selectedYear,n[0]),i=t.datepicker._get(o,"onSelect"),i?(s=t.datepicker._formatDate(o),i.apply(o.input?o.input[0]:null,[s,o])):t.datepicker._hideDatepicker(),!1;case 27:t.datepicker._hideDatepicker();break;case 33:t.datepicker._adjustDate(e.target,e.ctrlKey?-t.datepicker._get(o,"stepBigMonths"):-t.datepicker._get(o,"stepMonths"),"M");break;case 34:t.datepicker._adjustDate(e.target,e.ctrlKey?+t.datepicker._get(o,"stepBigMonths"):+t.datepicker._get(o,"stepMonths"),"M");break;case 35:(e.ctrlKey||e.metaKey)&&t.datepicker._clearDate(e.target),a=e.ctrlKey||e.metaKey;break;case 36:(e.ctrlKey||e.metaKey)&&t.datepicker._gotoToday(e.target),a=e.ctrlKey||e.metaKey;break;case 37:(e.ctrlKey||e.metaKey)&&t.datepicker._adjustDate(e.target,r?1:-1,"D"),a=e.ctrlKey||e.metaKey,e.originalEvent.altKey&&t.datepicker._adjustDate(e.target,e.ctrlKey?-t.datepicker._get(o,"stepBigMonths"):-t.datepicker._get(o,"stepMonths"),"M");break;case 38:(e.ctrlKey||e.metaKey)&&t.datepicker._adjustDate(e.target,-7,"D"),a=e.ctrlKey||e.metaKey;break;case 39:(e.ctrlKey||e.metaKey)&&t.datepicker._adjustDate(e.target,r?-1:1,"D"),a=e.ctrlKey||e.metaKey,e.originalEvent.altKey&&t.datepicker._adjustDate(e.target,e.ctrlKey?+t.datepicker._get(o,"stepBigMonths"):+t.datepicker._get(o,"stepMonths"),"M");break;case 40:(e.ctrlKey||e.metaKey)&&t.datepicker._adjustDate(e.target,7,"D"),a=e.ctrlKey||e.metaKey;break;default:a=!1}else 36===e.keyCode&&e.ctrlKey?t.datepicker._showDatepicker(this):a=!1;a&&(e.preventDefault(),e.stopPropagation())},_doKeyPress:function(e){var i,s,n=t.datepicker._getInst(e.target);return t.datepicker._get(n,"constrainInput")?(i=t.datepicker._possibleChars(t.datepicker._get(n,"dateFormat")),s=String.fromCharCode(null==e.charCode?e.keyCode:e.charCode),e.ctrlKey||e.metaKey||" ">s||!i||i.indexOf(s)>-1):void 0},_doKeyUp:function(e){var i,s=t.datepicker._getInst(e.target);if(s.input.val()!==s.lastVal)try{i=t.datepicker.parseDate(t.datepicker._get(s,"dateFormat"),s.input?s.input.val():null,t.datepicker._getFormatConfig(s)),i&&(t.datepicker._setDateFromField(s),t.datepicker._updateAlternate(s),t.datepicker._updateDatepicker(s))}catch(n){}return!0},_showDatepicker:function(i){if(i=i.target||i,"input"!==i.nodeName.toLowerCase()&&(i=t("input",i.parentNode)[0]),!t.datepicker._isDisabledDatepicker(i)&&t.datepicker._lastInput!==i){var s,n,a,r,l,h,c;s=t.datepicker._getInst(i),t.datepicker._curInst&&t.datepicker._curInst!==s&&(t.datepicker._curInst.dpDiv.stop(!0,!0),s&&t.datepicker._datepickerShowing&&t.datepicker._hideDatepicker(t.datepicker._curInst.input[0])),n=t.datepicker._get(s,"beforeShow"),a=n?n.apply(i,[i,s]):{},a!==!1&&(o(s.settings,a),s.lastVal=null,t.datepicker._lastInput=i,t.datepicker._setDateFromField(s),t.datepicker._inDialog&&(i.value=""),t.datepicker._pos||(t.datepicker._pos=t.datepicker._findPos(i),t.datepicker._pos[1]+=i.offsetHeight),r=!1,t(i).parents().each(function(){return r|="fixed"===t(this).css("position"),!r}),l={left:t.datepicker._pos[0],top:t.datepicker._pos[1]},t.datepicker._pos=null,s.dpDiv.empty(),s.dpDiv.css({position:"absolute",display:"block",top:"-1000px"}),t.datepicker._updateDatepicker(s),l=t.datepicker._checkOffset(s,l,r),s.dpDiv.css({position:t.datepicker._inDialog&&t.blockUI?"static":r?"fixed":"absolute",display:"none",left:l.left+"px",top:l.top+"px"}),s.inline||(h=t.datepicker._get(s,"showAnim"),c=t.datepicker._get(s,"duration"),s.dpDiv.css("z-index",e(t(i))+1),t.datepicker._datepickerShowing=!0,t.effects&&t.effects.effect[h]?s.dpDiv.show(h,t.datepicker._get(s,"showOptions"),c):s.dpDiv[h||"show"](h?c:null),t.datepicker._shouldFocusInput(s)&&s.input.trigger("focus"),t.datepicker._curInst=s))}},_updateDatepicker:function(e){this.maxRows=4,l=e,e.dpDiv.empty().append(this._generateHTML(e)),this._attachHandlers(e);var i,s=this._getNumberOfMonths(e),o=s[1],a=17,r=e.dpDiv.find("."+this._dayOverClass+" a");r.length>0&&n.apply(r.get(0)),e.dpDiv.removeClass("ui-datepicker-multi-2 ui-datepicker-multi-3 ui-datepicker-multi-4").width(""),o>1&&e.dpDiv.addClass("ui-datepicker-multi-"+o).css("width",a*o+"em"),e.dpDiv[(1!==s[0]||1!==s[1]?"add":"remove")+"Class"]("ui-datepicker-multi"),e.dpDiv[(this._get(e,"isRTL")?"add":"remove")+"Class"]("ui-datepicker-rtl"),e===t.datepicker._curInst&&t.datepicker._datepickerShowing&&t.datepicker._shouldFocusInput(e)&&e.input.trigger("focus"),e.yearshtml&&(i=e.yearshtml,setTimeout(function(){i===e.yearshtml&&e.yearshtml&&e.dpDiv.find("select.ui-datepicker-year:first").replaceWith(e.yearshtml),i=e.yearshtml=null},0))},_shouldFocusInput:function(t){return t.input&&t.input.is(":visible")&&!t.input.is(":disabled")&&!t.input.is(":focus")},_checkOffset:function(e,i,s){var n=e.dpDiv.outerWidth(),o=e.dpDiv.outerHeight(),a=e.input?e.input.outerWidth():0,r=e.input?e.input.outerHeight():0,l=document.documentElement.clientWidth+(s?0:t(document).scrollLeft()),h=document.documentElement.clientHeight+(s?0:t(document).scrollTop());return i.left-=this._get(e,"isRTL")?n-a:0,i.left-=s&&i.left===e.input.offset().left?t(document).scrollLeft():0,i.top-=s&&i.top===e.input.offset().top+r?t(document).scrollTop():0,i.left-=Math.min(i.left,i.left+n>l&&l>n?Math.abs(i.left+n-l):0),i.top-=Math.min(i.top,i.top+o>h&&h>o?Math.abs(o+r):0),i},_findPos:function(e){for(var i,s=this._getInst(e),n=this._get(s,"isRTL");e&&("hidden"===e.type||1!==e.nodeType||t.expr.filters.hidden(e));)e=e[n?"previousSibling":"nextSibling"];return i=t(e).offset(),[i.left,i.top]},_hideDatepicker:function(e){var i,s,n,o,a=this._curInst;!a||e&&a!==t.data(e,"datepicker")||this._datepickerShowing&&(i=this._get(a,"showAnim"),s=this._get(a,"duration"),n=function(){t.datepicker._tidyDialog(a)},t.effects&&(t.effects.effect[i]||t.effects[i])?a.dpDiv.hide(i,t.datepicker._get(a,"showOptions"),s,n):a.dpDiv["slideDown"===i?"slideUp":"fadeIn"===i?"fadeOut":"hide"](i?s:null,n),i||n(),this._datepickerShowing=!1,o=this._get(a,"onClose"),o&&o.apply(a.input?a.input[0]:null,[a.input?a.input.val():"",a]),this._lastInput=null,this._inDialog&&(this._dialogInput.css({position:"absolute",left:"0",top:"-100px"}),t.blockUI&&(t.unblockUI(),t("body").append(this.dpDiv))),this._inDialog=!1)},_tidyDialog:function(t){t.dpDiv.removeClass(this._dialogClass).off(".ui-datepicker-calendar")},_checkExternalClick:function(e){if(t.datepicker._curInst){var i=t(e.target),s=t.datepicker._getInst(i[0]);(i[0].id!==t.datepicker._mainDivId&&0===i.parents("#"+t.datepicker._mainDivId).length&&!i.hasClass(t.datepicker.markerClassName)&&!i.closest("."+t.datepicker._triggerClass).length&&t.datepicker._datepickerShowing&&(!t.datepicker._inDialog||!t.blockUI)||i.hasClass(t.datepicker.markerClassName)&&t.datepicker._curInst!==s)&&t.datepicker._hideDatepicker()}},_adjustDate:function(e,i,s){var n=t(e),o=this._getInst(n[0]);this._isDisabledDatepicker(n[0])||(this._adjustInstDate(o,i+("M"===s?this._get(o,"showCurrentAtPos"):0),s),this._updateDatepicker(o))},_gotoToday:function(e){var i,s=t(e),n=this._getInst(s[0]);this._get(n,"gotoCurrent")&&n.currentDay?(n.selectedDay=n.currentDay,n.drawMonth=n.selectedMonth=n.currentMonth,n.drawYear=n.selectedYear=n.currentYear):(i=new Date,n.selectedDay=i.getDate(),n.drawMonth=n.selectedMonth=i.getMonth(),n.drawYear=n.selectedYear=i.getFullYear()),this._notifyChange(n),this._adjustDate(s)},_selectMonthYear:function(e,i,s){var n=t(e),o=this._getInst(n[0]);o["selected"+("M"===s?"Month":"Year")]=o["draw"+("M"===s?"Month":"Year")]=parseInt(i.options[i.selectedIndex].value,10),this._notifyChange(o),this._adjustDate(n)},_selectDay:function(e,i,s,n){var o,a=t(e);t(n).hasClass(this._unselectableClass)||this._isDisabledDatepicker(a[0])||(o=this._getInst(a[0]),o.selectedDay=o.currentDay=t("a",n).html(),o.selectedMonth=o.currentMonth=i,o.selectedYear=o.currentYear=s,this._selectDate(e,this._formatDate(o,o.currentDay,o.currentMonth,o.currentYear)))},_clearDate:function(e){var i=t(e);this._selectDate(i,"")},_selectDate:function(e,i){var s,n=t(e),o=this._getInst(n[0]);i=null!=i?i:this._formatDate(o),o.input&&o.input.val(i),this._updateAlternate(o),s=this._get(o,"onSelect"),s?s.apply(o.input?o.input[0]:null,[i,o]):o.input&&o.input.trigger("change"),o.inline?this._updateDatepicker(o):(this._hideDatepicker(),this._lastInput=o.input[0],"object"!=typeof o.input[0]&&o.input.trigger("focus"),this._lastInput=null)},_updateAlternate:function(e){var i,s,n,o=this._get(e,"altField");o&&(i=this._get(e,"altFormat")||this._get(e,"dateFormat"),s=this._getDate(e),n=this.formatDate(i,s,this._getFormatConfig(e)),t(o).val(n))},noWeekends:function(t){var e=t.getDay();return[e>0&&6>e,""]},iso8601Week:function(t){var e,i=new Date(t.getTime());return i.setDate(i.getDate()+4-(i.getDay()||7)),e=i.getTime(),i.setMonth(0),i.setDate(1),Math.floor(Math.round((e-i)/864e5)/7)+1},parseDate:function(e,i,s){if(null==e||null==i)throw"Invalid arguments";if(i="object"==typeof i?""+i:i+"",""===i)return null;var n,o,a,r,l=0,h=(s?s.shortYearCutoff:null)||this._defaults.shortYearCutoff,c="string"!=typeof h?h:(new Date).getFullYear()%100+parseInt(h,10),u=(s?s.dayNamesShort:null)||this._defaults.dayNamesShort,d=(s?s.dayNames:null)||this._defaults.dayNames,p=(s?s.monthNamesShort:null)||this._defaults.monthNamesShort,f=(s?s.monthNames:null)||this._defaults.monthNames,g=-1,m=-1,_=-1,v=-1,b=!1,y=function(t){var i=e.length>n+1&&e.charAt(n+1)===t;return i&&n++,i},w=function(t){var e=y(t),s="@"===t?14:"!"===t?20:"y"===t&&e?4:"o"===t?3:2,n="y"===t?s:1,o=RegExp("^\\d{"+n+","+s+"}"),a=i.substring(l).match(o);if(!a)throw"Missing number at position "+l;return l+=a[0].length,parseInt(a[0],10)},k=function(e,s,n){var o=-1,a=t.map(y(e)?n:s,function(t,e){return[[e,t]]}).sort(function(t,e){return-(t[1].length-e[1].length)});if(t.each(a,function(t,e){var s=e[1];return i.substr(l,s.length).toLowerCase()===s.toLowerCase()?(o=e[0],l+=s.length,!1):void 0}),-1!==o)return o+1;throw"Unknown name at position "+l},x=function(){if(i.charAt(l)!==e.charAt(n))throw"Unexpected literal at position "+l;l++};for(n=0;e.length>n;n++)if(b)"'"!==e.charAt(n)||y("'")?x():b=!1;else switch(e.charAt(n)){case"d":_=w("d");break;case"D":k("D",u,d);break;case"o":v=w("o");break;case"m":m=w("m");break;case"M":m=k("M",p,f);break;case"y":g=w("y");break;case"@":r=new Date(w("@")),g=r.getFullYear(),m=r.getMonth()+1,_=r.getDate();break;case"!":r=new Date((w("!")-this._ticksTo1970)/1e4),g=r.getFullYear(),m=r.getMonth()+1,_=r.getDate();break;case"'":y("'")?x():b=!0;break;default:x()}if(i.length>l&&(a=i.substr(l),!/^\s+/.test(a)))throw"Extra/unparsed characters found in date: "+a;if(-1===g?g=(new Date).getFullYear():100>g&&(g+=(new Date).getFullYear()-(new Date).getFullYear()%100+(c>=g?0:-100)),v>-1)for(m=1,_=v;;){if(o=this._getDaysInMonth(g,m-1),o>=_)break;m++,_-=o}if(r=this._daylightSavingAdjust(new Date(g,m-1,_)),r.getFullYear()!==g||r.getMonth()+1!==m||r.getDate()!==_)throw"Invalid date";return r},ATOM:"yy-mm-dd",COOKIE:"D, dd M yy",ISO_8601:"yy-mm-dd",RFC_822:"D, d M y",RFC_850:"DD, dd-M-y",RFC_1036:"D, d M y",RFC_1123:"D, d M yy",RFC_2822:"D, d M yy",RSS:"D, d M y",TICKS:"!",TIMESTAMP:"@",W3C:"yy-mm-dd",_ticksTo1970:1e7*60*60*24*(718685+Math.floor(492.5)-Math.floor(19.7)+Math.floor(4.925)),formatDate:function(t,e,i){if(!e)return"";var s,n=(i?i.dayNamesShort:null)||this._defaults.dayNamesShort,o=(i?i.dayNames:null)||this._defaults.dayNames,a=(i?i.monthNamesShort:null)||this._defaults.monthNamesShort,r=(i?i.monthNames:null)||this._defaults.monthNames,l=function(e){var i=t.length>s+1&&t.charAt(s+1)===e;return i&&s++,i},h=function(t,e,i){var s=""+e;if(l(t))for(;i>s.length;)s="0"+s;return s},c=function(t,e,i,s){return l(t)?s[e]:i[e]},u="",d=!1;if(e)for(s=0;t.length>s;s++)if(d)"'"!==t.charAt(s)||l("'")?u+=t.charAt(s):d=!1;else switch(t.charAt(s)){case"d":u+=h("d",e.getDate(),2);break;case"D":u+=c("D",e.getDay(),n,o);break;case"o":u+=h("o",Math.round((new Date(e.getFullYear(),e.getMonth(),e.getDate()).getTime()-new Date(e.getFullYear(),0,0).getTime())/864e5),3);break;case"m":u+=h("m",e.getMonth()+1,2);break;case"M":u+=c("M",e.getMonth(),a,r);break;case"y":u+=l("y")?e.getFullYear():(10>e.getFullYear()%100?"0":"")+e.getFullYear()%100;break;case"@":u+=e.getTime();break;case"!":u+=1e4*e.getTime()+this._ticksTo1970;break;case"'":l("'")?u+="'":d=!0;break;default:u+=t.charAt(s)}return u},_possibleChars:function(t){var e,i="",s=!1,n=function(i){var s=t.length>e+1&&t.charAt(e+1)===i;return s&&e++,s};for(e=0;t.length>e;e++)if(s)"'"!==t.charAt(e)||n("'")?i+=t.charAt(e):s=!1;else switch(t.charAt(e)){case"d":case"m":case"y":case"@":i+="0123456789";break;case"D":case"M":return null;case"'":n("'")?i+="'":s=!0;break;default:i+=t.charAt(e)}return i},_get:function(t,e){return void 0!==t.settings[e]?t.settings[e]:this._defaults[e]},_setDateFromField:function(t,e){if(t.input.val()!==t.lastVal){var i=this._get(t,"dateFormat"),s=t.lastVal=t.input?t.input.val():null,n=this._getDefaultDate(t),o=n,a=this._getFormatConfig(t);try{o=this.parseDate(i,s,a)||n}catch(r){s=e?"":s}t.selectedDay=o.getDate(),t.drawMonth=t.selectedMonth=o.getMonth(),t.drawYear=t.selectedYear=o.getFullYear(),t.currentDay=s?o.getDate():0,t.currentMonth=s?o.getMonth():0,t.currentYear=s?o.getFullYear():0,this._adjustInstDate(t)
}},_getDefaultDate:function(t){return this._restrictMinMax(t,this._determineDate(t,this._get(t,"defaultDate"),new Date))},_determineDate:function(e,i,s){var n=function(t){var e=new Date;return e.setDate(e.getDate()+t),e},o=function(i){try{return t.datepicker.parseDate(t.datepicker._get(e,"dateFormat"),i,t.datepicker._getFormatConfig(e))}catch(s){}for(var n=(i.toLowerCase().match(/^c/)?t.datepicker._getDate(e):null)||new Date,o=n.getFullYear(),a=n.getMonth(),r=n.getDate(),l=/([+\-]?[0-9]+)\s*(d|D|w|W|m|M|y|Y)?/g,h=l.exec(i);h;){switch(h[2]||"d"){case"d":case"D":r+=parseInt(h[1],10);break;case"w":case"W":r+=7*parseInt(h[1],10);break;case"m":case"M":a+=parseInt(h[1],10),r=Math.min(r,t.datepicker._getDaysInMonth(o,a));break;case"y":case"Y":o+=parseInt(h[1],10),r=Math.min(r,t.datepicker._getDaysInMonth(o,a))}h=l.exec(i)}return new Date(o,a,r)},a=null==i||""===i?s:"string"==typeof i?o(i):"number"==typeof i?isNaN(i)?s:n(i):new Date(i.getTime());return a=a&&"Invalid Date"==""+a?s:a,a&&(a.setHours(0),a.setMinutes(0),a.setSeconds(0),a.setMilliseconds(0)),this._daylightSavingAdjust(a)},_daylightSavingAdjust:function(t){return t?(t.setHours(t.getHours()>12?t.getHours()+2:0),t):null},_setDate:function(t,e,i){var s=!e,n=t.selectedMonth,o=t.selectedYear,a=this._restrictMinMax(t,this._determineDate(t,e,new Date));t.selectedDay=t.currentDay=a.getDate(),t.drawMonth=t.selectedMonth=t.currentMonth=a.getMonth(),t.drawYear=t.selectedYear=t.currentYear=a.getFullYear(),n===t.selectedMonth&&o===t.selectedYear||i||this._notifyChange(t),this._adjustInstDate(t),t.input&&t.input.val(s?"":this._formatDate(t))},_getDate:function(t){var e=!t.currentYear||t.input&&""===t.input.val()?null:this._daylightSavingAdjust(new Date(t.currentYear,t.currentMonth,t.currentDay));return e},_attachHandlers:function(e){var i=this._get(e,"stepMonths"),s="#"+e.id.replace(/\\\\/g,"\\");e.dpDiv.find("[data-handler]").map(function(){var e={prev:function(){t.datepicker._adjustDate(s,-i,"M")},next:function(){t.datepicker._adjustDate(s,+i,"M")},hide:function(){t.datepicker._hideDatepicker()},today:function(){t.datepicker._gotoToday(s)},selectDay:function(){return t.datepicker._selectDay(s,+this.getAttribute("data-month"),+this.getAttribute("data-year"),this),!1},selectMonth:function(){return t.datepicker._selectMonthYear(s,this,"M"),!1},selectYear:function(){return t.datepicker._selectMonthYear(s,this,"Y"),!1}};t(this).on(this.getAttribute("data-event"),e[this.getAttribute("data-handler")])})},_generateHTML:function(t){var e,i,s,n,o,a,r,l,h,c,u,d,p,f,g,m,_,v,b,y,w,k,x,D,C,T,I,M,P,S,N,z,H,A,O,E,W,F,L,R=new Date,Y=this._daylightSavingAdjust(new Date(R.getFullYear(),R.getMonth(),R.getDate())),B=this._get(t,"isRTL"),j=this._get(t,"showButtonPanel"),K=this._get(t,"hideIfNoPrevNext"),q=this._get(t,"navigationAsDateFormat"),U=this._getNumberOfMonths(t),V=this._get(t,"showCurrentAtPos"),$=this._get(t,"stepMonths"),X=1!==U[0]||1!==U[1],G=this._daylightSavingAdjust(t.currentDay?new Date(t.currentYear,t.currentMonth,t.currentDay):new Date(9999,9,9)),J=this._getMinMaxDate(t,"min"),Q=this._getMinMaxDate(t,"max"),Z=t.drawMonth-V,te=t.drawYear;if(0>Z&&(Z+=12,te--),Q)for(e=this._daylightSavingAdjust(new Date(Q.getFullYear(),Q.getMonth()-U[0]*U[1]+1,Q.getDate())),e=J&&J>e?J:e;this._daylightSavingAdjust(new Date(te,Z,1))>e;)Z--,0>Z&&(Z=11,te--);for(t.drawMonth=Z,t.drawYear=te,i=this._get(t,"prevText"),i=q?this.formatDate(i,this._daylightSavingAdjust(new Date(te,Z-$,1)),this._getFormatConfig(t)):i,s=this._canAdjustMonth(t,-1,te,Z)?"<a class='ui-datepicker-prev ui-corner-all' data-handler='prev' data-event='click' title='"+i+"'><span class='ui-icon ui-icon-circle-triangle-"+(B?"e":"w")+"'>"+i+"</span></a>":K?"":"<a class='ui-datepicker-prev ui-corner-all ui-state-disabled' title='"+i+"'><span class='ui-icon ui-icon-circle-triangle-"+(B?"e":"w")+"'>"+i+"</span></a>",n=this._get(t,"nextText"),n=q?this.formatDate(n,this._daylightSavingAdjust(new Date(te,Z+$,1)),this._getFormatConfig(t)):n,o=this._canAdjustMonth(t,1,te,Z)?"<a class='ui-datepicker-next ui-corner-all' data-handler='next' data-event='click' title='"+n+"'><span class='ui-icon ui-icon-circle-triangle-"+(B?"w":"e")+"'>"+n+"</span></a>":K?"":"<a class='ui-datepicker-next ui-corner-all ui-state-disabled' title='"+n+"'><span class='ui-icon ui-icon-circle-triangle-"+(B?"w":"e")+"'>"+n+"</span></a>",a=this._get(t,"currentText"),r=this._get(t,"gotoCurrent")&&t.currentDay?G:Y,a=q?this.formatDate(a,r,this._getFormatConfig(t)):a,l=t.inline?"":"<button type='button' class='ui-datepicker-close ui-state-default ui-priority-primary ui-corner-all' data-handler='hide' data-event='click'>"+this._get(t,"closeText")+"</button>",h=j?"<div class='ui-datepicker-buttonpane ui-widget-content'>"+(B?l:"")+(this._isInRange(t,r)?"<button type='button' class='ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all' data-handler='today' data-event='click'>"+a+"</button>":"")+(B?"":l)+"</div>":"",c=parseInt(this._get(t,"firstDay"),10),c=isNaN(c)?0:c,u=this._get(t,"showWeek"),d=this._get(t,"dayNames"),p=this._get(t,"dayNamesMin"),f=this._get(t,"monthNames"),g=this._get(t,"monthNamesShort"),m=this._get(t,"beforeShowDay"),_=this._get(t,"showOtherMonths"),v=this._get(t,"selectOtherMonths"),b=this._getDefaultDate(t),y="",k=0;U[0]>k;k++){for(x="",this.maxRows=4,D=0;U[1]>D;D++){if(C=this._daylightSavingAdjust(new Date(te,Z,t.selectedDay)),T=" ui-corner-all",I="",X){if(I+="<div class='ui-datepicker-group",U[1]>1)switch(D){case 0:I+=" ui-datepicker-group-first",T=" ui-corner-"+(B?"right":"left");break;case U[1]-1:I+=" ui-datepicker-group-last",T=" ui-corner-"+(B?"left":"right");break;default:I+=" ui-datepicker-group-middle",T=""}I+="'>"}for(I+="<div class='ui-datepicker-header ui-widget-header ui-helper-clearfix"+T+"'>"+(/all|left/.test(T)&&0===k?B?o:s:"")+(/all|right/.test(T)&&0===k?B?s:o:"")+this._generateMonthYearHeader(t,Z,te,J,Q,k>0||D>0,f,g)+"</div><table class='ui-datepicker-calendar'><thead>"+"<tr>",M=u?"<th class='ui-datepicker-week-col'>"+this._get(t,"weekHeader")+"</th>":"",w=0;7>w;w++)P=(w+c)%7,M+="<th scope='col'"+((w+c+6)%7>=5?" class='ui-datepicker-week-end'":"")+">"+"<span title='"+d[P]+"'>"+p[P]+"</span></th>";for(I+=M+"</tr></thead><tbody>",S=this._getDaysInMonth(te,Z),te===t.selectedYear&&Z===t.selectedMonth&&(t.selectedDay=Math.min(t.selectedDay,S)),N=(this._getFirstDayOfMonth(te,Z)-c+7)%7,z=Math.ceil((N+S)/7),H=X?this.maxRows>z?this.maxRows:z:z,this.maxRows=H,A=this._daylightSavingAdjust(new Date(te,Z,1-N)),O=0;H>O;O++){for(I+="<tr>",E=u?"<td class='ui-datepicker-week-col'>"+this._get(t,"calculateWeek")(A)+"</td>":"",w=0;7>w;w++)W=m?m.apply(t.input?t.input[0]:null,[A]):[!0,""],F=A.getMonth()!==Z,L=F&&!v||!W[0]||J&&J>A||Q&&A>Q,E+="<td class='"+((w+c+6)%7>=5?" ui-datepicker-week-end":"")+(F?" ui-datepicker-other-month":"")+(A.getTime()===C.getTime()&&Z===t.selectedMonth&&t._keyEvent||b.getTime()===A.getTime()&&b.getTime()===C.getTime()?" "+this._dayOverClass:"")+(L?" "+this._unselectableClass+" ui-state-disabled":"")+(F&&!_?"":" "+W[1]+(A.getTime()===G.getTime()?" "+this._currentClass:"")+(A.getTime()===Y.getTime()?" ui-datepicker-today":""))+"'"+(F&&!_||!W[2]?"":" title='"+W[2].replace(/'/g,"&#39;")+"'")+(L?"":" data-handler='selectDay' data-event='click' data-month='"+A.getMonth()+"' data-year='"+A.getFullYear()+"'")+">"+(F&&!_?"&#xa0;":L?"<span class='ui-state-default'>"+A.getDate()+"</span>":"<a class='ui-state-default"+(A.getTime()===Y.getTime()?" ui-state-highlight":"")+(A.getTime()===G.getTime()?" ui-state-active":"")+(F?" ui-priority-secondary":"")+"' href='#'>"+A.getDate()+"</a>")+"</td>",A.setDate(A.getDate()+1),A=this._daylightSavingAdjust(A);I+=E+"</tr>"}Z++,Z>11&&(Z=0,te++),I+="</tbody></table>"+(X?"</div>"+(U[0]>0&&D===U[1]-1?"<div class='ui-datepicker-row-break'></div>":""):""),x+=I}y+=x}return y+=h,t._keyEvent=!1,y},_generateMonthYearHeader:function(t,e,i,s,n,o,a,r){var l,h,c,u,d,p,f,g,m=this._get(t,"changeMonth"),_=this._get(t,"changeYear"),v=this._get(t,"showMonthAfterYear"),b="<div class='ui-datepicker-title'>",y="";if(o||!m)y+="<span class='ui-datepicker-month'>"+a[e]+"</span>";else{for(l=s&&s.getFullYear()===i,h=n&&n.getFullYear()===i,y+="<select class='ui-datepicker-month' data-handler='selectMonth' data-event='change'>",c=0;12>c;c++)(!l||c>=s.getMonth())&&(!h||n.getMonth()>=c)&&(y+="<option value='"+c+"'"+(c===e?" selected='selected'":"")+">"+r[c]+"</option>");y+="</select>"}if(v||(b+=y+(!o&&m&&_?"":"&#xa0;")),!t.yearshtml)if(t.yearshtml="",o||!_)b+="<span class='ui-datepicker-year'>"+i+"</span>";else{for(u=this._get(t,"yearRange").split(":"),d=(new Date).getFullYear(),p=function(t){var e=t.match(/c[+\-].*/)?i+parseInt(t.substring(1),10):t.match(/[+\-].*/)?d+parseInt(t,10):parseInt(t,10);return isNaN(e)?d:e},f=p(u[0]),g=Math.max(f,p(u[1]||"")),f=s?Math.max(f,s.getFullYear()):f,g=n?Math.min(g,n.getFullYear()):g,t.yearshtml+="<select class='ui-datepicker-year' data-handler='selectYear' data-event='change'>";g>=f;f++)t.yearshtml+="<option value='"+f+"'"+(f===i?" selected='selected'":"")+">"+f+"</option>";t.yearshtml+="</select>",b+=t.yearshtml,t.yearshtml=null}return b+=this._get(t,"yearSuffix"),v&&(b+=(!o&&m&&_?"":"&#xa0;")+y),b+="</div>"},_adjustInstDate:function(t,e,i){var s=t.selectedYear+("Y"===i?e:0),n=t.selectedMonth+("M"===i?e:0),o=Math.min(t.selectedDay,this._getDaysInMonth(s,n))+("D"===i?e:0),a=this._restrictMinMax(t,this._daylightSavingAdjust(new Date(s,n,o)));t.selectedDay=a.getDate(),t.drawMonth=t.selectedMonth=a.getMonth(),t.drawYear=t.selectedYear=a.getFullYear(),("M"===i||"Y"===i)&&this._notifyChange(t)},_restrictMinMax:function(t,e){var i=this._getMinMaxDate(t,"min"),s=this._getMinMaxDate(t,"max"),n=i&&i>e?i:e;return s&&n>s?s:n},_notifyChange:function(t){var e=this._get(t,"onChangeMonthYear");e&&e.apply(t.input?t.input[0]:null,[t.selectedYear,t.selectedMonth+1,t])},_getNumberOfMonths:function(t){var e=this._get(t,"numberOfMonths");return null==e?[1,1]:"number"==typeof e?[1,e]:e},_getMinMaxDate:function(t,e){return this._determineDate(t,this._get(t,e+"Date"),null)},_getDaysInMonth:function(t,e){return 32-this._daylightSavingAdjust(new Date(t,e,32)).getDate()},_getFirstDayOfMonth:function(t,e){return new Date(t,e,1).getDay()},_canAdjustMonth:function(t,e,i,s){var n=this._getNumberOfMonths(t),o=this._daylightSavingAdjust(new Date(i,s+(0>e?e:n[0]*n[1]),1));return 0>e&&o.setDate(this._getDaysInMonth(o.getFullYear(),o.getMonth())),this._isInRange(t,o)},_isInRange:function(t,e){var i,s,n=this._getMinMaxDate(t,"min"),o=this._getMinMaxDate(t,"max"),a=null,r=null,l=this._get(t,"yearRange");return l&&(i=l.split(":"),s=(new Date).getFullYear(),a=parseInt(i[0],10),r=parseInt(i[1],10),i[0].match(/[+\-].*/)&&(a+=s),i[1].match(/[+\-].*/)&&(r+=s)),(!n||e.getTime()>=n.getTime())&&(!o||e.getTime()<=o.getTime())&&(!a||e.getFullYear()>=a)&&(!r||r>=e.getFullYear())},_getFormatConfig:function(t){var e=this._get(t,"shortYearCutoff");return e="string"!=typeof e?e:(new Date).getFullYear()%100+parseInt(e,10),{shortYearCutoff:e,dayNamesShort:this._get(t,"dayNamesShort"),dayNames:this._get(t,"dayNames"),monthNamesShort:this._get(t,"monthNamesShort"),monthNames:this._get(t,"monthNames")}},_formatDate:function(t,e,i,s){e||(t.currentDay=t.selectedDay,t.currentMonth=t.selectedMonth,t.currentYear=t.selectedYear);var n=e?"object"==typeof e?e:this._daylightSavingAdjust(new Date(s,i,e)):this._daylightSavingAdjust(new Date(t.currentYear,t.currentMonth,t.currentDay));return this.formatDate(this._get(t,"dateFormat"),n,this._getFormatConfig(t))}}),t.fn.datepicker=function(e){if(!this.length)return this;t.datepicker.initialized||(t(document).on("mousedown",t.datepicker._checkExternalClick),t.datepicker.initialized=!0),0===t("#"+t.datepicker._mainDivId).length&&t("body").append(t.datepicker.dpDiv);var i=Array.prototype.slice.call(arguments,1);return"string"!=typeof e||"isDisabled"!==e&&"getDate"!==e&&"widget"!==e?"option"===e&&2===arguments.length&&"string"==typeof arguments[1]?t.datepicker["_"+e+"Datepicker"].apply(t.datepicker,[this[0]].concat(i)):this.each(function(){"string"==typeof e?t.datepicker["_"+e+"Datepicker"].apply(t.datepicker,[this].concat(i)):t.datepicker._attachDatepicker(this,e)}):t.datepicker["_"+e+"Datepicker"].apply(t.datepicker,[this[0]].concat(i))},t.datepicker=new i,t.datepicker.initialized=!1,t.datepicker.uuid=(new Date).getTime(),t.datepicker.version="1.12.1",t.datepicker});

