// parsley extension to use in conjunction with jQuery payment to test for valid credit card details

window.ParsleyConfig = {
    validators: {
      donationvalue: {
        fn: function (value, elems) {
          elems = elems.split(",");
          // check to see if a preset is selected or a valid number has been entered
          if ((value != '' && !isNaN(value)) || jQuery('.'+elems[0]).hasClass(elems[1])) {
            return true;
          } else {
            return false;
          }
        },
        priority: 460
      },     
      donationmax: {
        fn: function (value, limit) {
          if (value == '') {
            return true;
          } else {
            if(parseInt(value) < parseInt(limit)) {
              return true;
            } else {
              return false;
            }
          }
        },
        priority: 450
      },
      donationmin: {
        fn: function (value, limit) {
          if (value == '') {
            return true;
          } else {
            if(parseInt(value) > parseInt(limit)) {
              return true;
            } else {
              return false;
            }
          }
        },
        priority: 450
      },      
      creditcard: {
        fn: function (value) {
          if (jQuery.payment.validateCardNumber(value)) {
            return true;
          } else {
            return false;
          }          
        },
        priority: 32
      },
      cvc: {
        fn: function(value) {
          if(jQuery.payment.validateCardCVC(value)) {
            return true;
          } else {
            return false;
          }
        },
        priority: 32        
      },
      expiry: {
        fn: function(value) {
          var expiryVal = jQuery.payment.cardExpiryVal(value);
          if(jQuery.payment.validateCardExpiry(expiryVal.month, expiryVal.year)) {
            return true;
          } else {
            return false;
          }
        }
      }
    },
    i18n: {
      en: {
        donationvalue: 'Please enter a donation amount',
        donationmax: 'We are unable to receive donations of more that %s online. Please contact us to make your donation.',
        donationmin: 'Unfortunately we are unable to receive donations of less than %s online.',        
        creditcard: 'This doesn\'t look like a valid credit card number',
        cvc: 'This doesn\'t look like a valid cvc number',
        expiry: 'This doesn\'t look like a valid expiry date'
      },
      no: {
        donationvalue: 'Vennligst oppgi beløp',
        donationmax: 'Vi har dessverre ikke anledning til å motta mer enn %s på nett. Vær vennlig å ta kontakt med oss for å gi din gave.',
        donationmin: 'Vi har dessverre ikke anledning til å motta gaver under %s på nett.',        
        creditcard: 'Dette ser ikke ut som et gyldig cvc nummer',
        cvc: 'Dette ser ikke ut som et gyldig kortnummer',
        expiry: 'Dette ser ikke ut som en gyldig utløpsdato'        
      }
    } 
  };