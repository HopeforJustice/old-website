var hfj = (function(my, $) {

  my.pages = my.pages || {};

  var namespace = 'donate1';

  //containers
  var wrapper = '#' + namespace;
  var form = '.' + namespace + '__form';
  var fieldset = '.' + namespace + '__fields';
  var breadcrumbs = '.' + namespace + '__breadcrumbs';

  //states - note no '.' on these
  var wrapperSeq = namespace + '--sequential';
  var wrapperReady = namespace + '--ready';
  var fieldsetActive = namespace + '__fields__active';
  var breadcrumbActive = namespace + '__step__active';
  var amountPreActive = namespace + '__amount-pre__active';
  var submitActive = namespace + '__submit__progress';

  //elements

  var breadcrumb = '.' + namespace + '__breadcrumb';

  var amountPre = '.' + namespace + '__amount-pre';
  var amountUsr = '#' + namespace + '__amount-usr';
  var amountError = '.' + namespace + '__amount-err';

  var firstName = '#' + namespace + '__first-name';
  var lastName = '#' + namespace + '__last-name';
  var fullName = '#' + namespace + '__name';

  var cc = '#' + namespace + '__cc';
  var exp = '#' + namespace + '__exp';
  var cvc = '#' + namespace + '__cvc';

  var btn1 = '#' + namespace + '__btn1';
  var btn2 = '#' + namespace + '__btn2';
  var submit = '#' + namespace + '__submit';


  var currentStep = 1;

  var minDonation = 5;
  var maxDonation = 82000;


  function setActiveStep(step) {
    _stepInd = parseInt(step) - 1;
    if ($(wrapper).hasClass(wrapperSeq)) {
      $(wrapper).removeClass('donate1--step1 donate1--step2 donate1--step3');
      $(fieldset).removeClass(fieldsetActive);
      $(breadcrumb).removeClass(breadcrumbActive);
      $(wrapper).addClass('donate1--step' + step);
      $(breadcrumb).eq(_stepInd).addClass(breadcrumbActive);
      $(fieldset).eq(_stepInd).addClass(fieldsetActive);
      currentStep = step;
      }
    }

    function gotoStep(step) {
      var _goStep = step ? step : currentStep + 1;
      setActiveStep(_goStep);
    }

    function gotoNext() {
      var _step = $(this).closest(fieldset).data('next-step');
      gotoStep(_step);
    }

    function donateContainerSize() {
        if ((breakpoint.value == 'tablet' || breakpoint.value == 'desktop' || breakpoint.value == 'desktopLarge') && Modernizr.csstransforms3d) {
            var _stepsWidth = 0;
            var _widths = new Array();
            $(fieldset).each(function(i){
              var $step = $(this);
              _widths[i] = _stepsWidth;
              _stepsWidth += Math.ceil($step.outerWidth());
            });
            $(form).width(_stepsWidth);
            $(wrapper).addClass(wrapperSeq);
            setActiveStep(currentStep);
        } else {
            $(form).width('auto');
            $(wrapper).removeClass(wrapperSeq);
        }
    }

    function userAmount(callback) {
        var _value = $(amountUsr).val();
        $('#donate1__amnt').val(_value);
        $('#donate1__value-remind').text('kr' + _value);
        if(callback) callback();
    }

    function donateInit() {
      donateContainerSize();
      $(wrapper).addClass(wrapperReady);
    }

    function stripeResponseHandler(status, response) {
      var $form = $(wrapper);

      if (response.error) {
        // Show the errors on the form
        $form.find('.donate1__payment-err').text(response.error.message).show();
        $form.find('button').prop('disabled', false);
        $(submit).removeClass(submitActive);        
      } else {
        // response contains id and card, which contains additional card details
        var token = response.id;
        // Insert the token into the form so it gets submitted to the server
        $form.find('.donate1__payment-err').text('').hide();
        $form.append($('<input type="hidden" name="stripeToken" />').val(token));
        // and submit
        $form.get(0).submit();
      }
    }    

    my.pages.donate = function () {

        // Set up the card formatting
        $(cc).payment('formatCardNumber');
        $(cvc).payment('formatCardCVC');
        $(exp).payment('formatCardExpiry');      

        // set up whether we're doing the sliding panel version or the straight layout
        donateInit();


        // step 1
        $(btn1).click(function (e) {
           if ($(wrapper).parsley().validate('block1') === false) {
              return false;
            }else {
              userAmount(gotoNext);
            }
            e.preventDefault();            
        });

        // select preset amount
        $(amountPre).click(function(e) {
          var _value = $(this).data('donation-amount');
          $(amountPre).removeClass(amountPreActive);
          $(amountUsr).val('');
          $(amountError).text('').hide();
          $(this).addClass(amountPreActive);
          $('#donate1__value-remind').text('kr' + _value);
          $('#donate1__amnt').val(_value);
          gotoNext();
          e.preventDefault();
        });

        // clear the presets when "other amount" has focus
        $(amountUsr).focus(function() {
            $(amountPre).removeClass(amountPreActive);
            $('#donate1__amnt').val('');
        });

        // update the donation amount field when custom amount is entered - useful when mobile form
        $(amountUsr).keyup(function() {
            userAmount();
        });

        //step 2
        $(btn2).click(function(e) {
            if ($(wrapper).parsley().validate('block2') === false) {
                return false;
            }else {
                gotoNext();
            }
            e.preventDefault();
        });


        // navigate via breadcrumbs
        $(breadcrumb).on('click', function(e) {
            var _breadcrumbStep = parseInt($(this).index()) + 1;
            if(_breadcrumbStep < currentStep) {
                gotoStep(_breadcrumbStep);
            } else {
                e.preventDefault();
            }
        });

        $(window).smartresize(function(){
            // rethink the layout if you resize
            donateContainerSize();
        });


        $(wrapper).submit(function(event) {

          // make sure client-side validation is passed first before handing off to Stripe
          if (false === $(wrapper).parsley().validate()) {
          
            return;
          
          } else {

            var $form = $(this);

            var expiryVal = $(exp).payment('cardExpiryVal');
            var fullName = $(firstName).val() + ' ' + $(lastName).val();

            $form.append($('<input data-stripe="exp_year" type="hidden" />').val(expiryVal.year));
            $form.append($('<input data-stripe="exp_month" type="hidden" />').val(expiryVal.month));
            $form.append($('<input data-stripe="name" type="hidden" />').val(fullName));
            

            // Disable the submit button to prevent repeated clicks
            $form.find('button').prop('disabled', true);
            $(submit).addClass(submitActive);

            
            Stripe.card.createToken($form, stripeResponseHandler);

            // Prevent the form from submitting with the default action
            return false;
          }

        });

    };

return my;

} (hfj || {}, jQuery));