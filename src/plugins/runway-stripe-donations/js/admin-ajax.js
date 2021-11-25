jQuery(function ($) {
  $('#runway_stripe_send_test_email').click(function () {
    email = prompt('Enter email address', runway_ajax_values.admin_email);

    var button = $(this);
    button.next().html('<img src="/wp-admin/images/loading.gif" />');
    button.attr('disabled', 'disabled');

    var data = {
      'action': 'runway_stripe_send_test_mail',
      'email': email,
      'api_key': jQuery('#runway_stripe_sparkpost_api_key').val(),
      'template_id': jQuery('#runway_stripe_sparkpost_template_id').val(),
    };

    jQuery.post(runway_ajax_values.ajax_url, data, function(response) {
      button.next().text(response);
      button.removeAttr('disabled');
    });
  });

  $('#runway-stripe-download-data #download').click(function (evt) {
    form = $(this).closest('form')
      .attr('action', runway_ajax_values.download_url)
      .submit();

    evt.preventDefault();

    // Set the action back once we're done.
    setTimeout(function () {
      form.attr('action', '');
    }, 0);

  });

  $('.runway-stripe-data-table .runway-stripe-send-email').click(function () {
    var button = $(this);
    button.next().html('<img src="/wp-admin/images/loading.gif" />');
    button.attr('disabled', 'disabled');

    var data = {
      'action': 'runway_stripe_send_receipt_mail',
      'charge_id': button.data('stripe-charge'),
      'stripe_account': runway_ajax_values.stripe_account
    };

    jQuery.post(runway_ajax_values.ajax_url, data, function(response) {
      button.next().text(response);
      button.removeAttr('disabled');
      if (response.indexOf('Sent') === 0) {
        button.attr('value', 'Resend');
      }
    });
  });

  function updateLogDisplay() {
    var url = runway_ajax_values.ajax_url + '?' + $.param({
      action: 'runway_stripe_get_log_entries',
      lastLogEntry: lastLogEntry
    });

    jQuery.get(url, function(response) {
      var newEntries = JSON.parse(response);
      if(newEntries.length) {
        lastLogEntry = newEntries[0].id;

        for(var i = newEntries.length - 1; i >= 0; i--) {

          var el = $('<tr></tr>')
            .toggleClass('log-table__row--error', newEntries[i].is_error === '1')
            .append([
              $('<th></th>').text(newEntries[i].created_dt),
              $('<td></td>').text(newEntries[i].message)
            ])
            .fadeIn(600);

          $('#runway-stripe-log-table').prepend(el);
        }
      }
    });
  }
  if($('#runway-stripe-log-table').length) {
    setInterval(updateLogDisplay, 5000);
  }
});
