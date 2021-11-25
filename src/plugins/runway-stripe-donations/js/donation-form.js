(function () {
  window.runway_donations = {};
  var $ = jQuery;

  function init_checkout(options) {
    var form = $('#donation-form-'+options.form_id);
    var amountInput = form.find('.donation-form__donation-input');
    var button = $('#donation-form-button-'+options.form_id);

    if(options.use_tabs) {
      init_tabs(amountInput, options);
    } else {
      set_donation_amount(amountInput, options, is_monthly(options));
    }

    // Ensure that users only enter numbers in the box.
    amountInput.change(function () {
      var amount = parseInt($(this).val(), 10);
      $(this).val(amount);
    });

    var checkoutHandler = StripeCheckout.configure({
      key: options.stripe_key,
      name: options.site_name,
      allowRememberMe: true,
      billingAddress: true,
      image: options.image_url,
      token: function(token) {
        field(form, 'email').val(token.email);
        field(form, 'stripeToken').val(token.id);
        form.submit();
      }
    });

    button.click(function (e) {

      if (form.parsley().validate()) {

        var amount = parseInt(amountInput.val(), 10);
        var monthly = is_monthly(options);

        field(form, 'donation_amount').val(amount);
        field(form, 'monthly').val(monthly);

        // Open Checkout with further options
        checkoutHandler.open({
          description: monthly ? "Monthly donation" : "One-off donation",
          amount: amount * 100,
          currency: options.currency,
          panelLabel: monthly ? "Donate {{amount}} monthly" : "Donate {{amount}}"
        });
        e.preventDefault();
      }
    });
  }

  function field(form, fieldName) {
    return form.find('input[name="'+fieldName+'"]');
  }

  function set_donation_amount(amountInput, options, isMonthly) {
    var defaultAmount = isMonthly ? options.amount_regular : options.amount_one_off;
    amountInput.val(defaultAmount);
  }

  function init_tabs(amountInput, options) {
    // If we've got a default one-off amount on the query string but not a default regular amount, then default to the one-off.
    // We use a timeout so it's processed after the tab code.
    setTimeout(function () {
      if(location.search.indexOf(options.setting_prefix+"amount_regular") === -1 && location.search.indexOf(options.setting_prefix+"amount_one_off") >= 0) {
        $("#donate-tabs__once .tab__link").click();
      }
    }, 0);

    // Deal with default donation amounts.
    var donationAmountEdited = false;
    var monthly = is_monthly(options);
    set_donation_amount(amountInput, options, monthly);

    $(".donate-tabs .tab__link").click(function () {
      if(!donationAmountEdited) {
        var monthly = $(this).parent().attr("id") === "donate-tabs__monthly";
        set_donation_amount(amountInput, options, monthly);
      }
    });

    amountInput.change(function () {
      donationAmountEdited = true;
    });
  }

  function is_monthly(options) {
    if(options.use_tabs) {
      return $("#donate-tabs__monthly .tab__link").hasClass("tab__active");
    } else {
      return !options.amount_regular_is_default;
    }
  }

  window.runway_donations.init_checkout = init_checkout;

})();
