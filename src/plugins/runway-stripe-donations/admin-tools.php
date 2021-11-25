<?php

defined('ABSPATH') or die("No script kiddies please!");

add_action('admin_menu', 'runway_stripe_tools_menu' );

function runway_stripe_tools_menu() {
  add_submenu_page('tools.php', 'Runway Stripe Data Download', 'Donation Data', 'manage_donors', 'runway-stripe-download', 'runway_stripe_download_tool_init');
  add_submenu_page('tools.php', 'Add Donor Manually', 'Add Donor Manually', 'manage_donors', 'runway-stripe-add-donor', 'runway_stripe_add_donor_init');
}

function runway_stripe_checkbox($label, $name, $default) {
  $checked = ($_SERVER['REQUEST_METHOD'] === 'GET' && $default || isset($_POST[$name]) && $_POST[$name] === 'on') ? ' checked="checked"' : '';
  ?>
  <p>
    <label>
      <input type="checkbox" name="<?php echo $name; ?>" <?php echo $checked; ?>/>
      <?php echo $label; ?>
    </label>
  </p>
  <?php
}

function runway_stripe_radio($label, $name, $value, $default) {
  $checked = ($_SERVER['REQUEST_METHOD'] === 'GET' && $default || isset($_POST[$name]) && $_POST[$name] === $value) ? ' checked="checked"' : '';
  ?>
  <p>
    <label>
      <input type="radio" class="tog" name="<?php echo $name; ?>" value="<?php echo $value; ?>" <?php echo $checked; ?>/>
      <?php echo $label; ?>
    </label>
  </p>
  <?php
}

function runway_stripe_datebox($label, $name, $default) {
  $value = $_SERVER['REQUEST_METHOD'] === 'GET' ? date('Y-m-d', $default) : $_POST[$name];
  ?>
  <label>
    <?php echo $label; ?>
    <input type="date" name="<?php echo $name; ?>" value="<?php echo $value; ?>" required />
  </label>
  <?php
}

function runway_stripe_select_list_from_request($name, $list, $default = '') {
  $selected_value = !empty($_REQUEST[$name]) ? $_REQUEST[$name] : $default;
  runway_stripe_select_list($name, $selected_value, $list);
}

function runway_stripe_select_list($name, $selected_value, $list) {
  echo "<select name=\"$name\">";
  foreach ($list as $list_item) {
    $item_value = isset($list_item['value']) ? $list_item['value'] : $list_item['name'];
    $selected = $selected_value == $item_value ? ' selected="selected"' : '';
    echo '<option value="'.esc_attr($item_value).'" '.$selected.'>'.esc_html($list_item['name']).'</option>';
  }
  echo '</select>';
}

function runway_stripe_print_headers($data) {
  echo '<tr>';
  foreach($data[0] as $key => $value) {
    echo "<th><span>$key</span></th>";
  }
  echo '</tr>';
}

function runway_stripe_print_body($data) {
  foreach($data as $index => $row) {
    $class = $index % 2 == 0 ? 'alternate' : '';
    echo "<tr class=\"$class\">";
    foreach($row as $key => $value) {
      echo '<td class="no-break">';
      if($key === 'Receipt Email' && $value) {
        $button_text = strrpos($value, 'Sent') === 0 ? 'Resend' : 'Send';
        echo '<input type="button" value="'.$button_text.'" class="button runway-stripe-send-email" data-stripe-charge="'.$row['Charge ID'].'" />';
        echo '<span>'.htmlspecialchars($value).'</span>';
      } else {
        echo htmlspecialchars($value);
      }
      echo '</td>';
    }
    echo '</tr>';
  }
}

function runway_stripe_campaigns_list_from_actual_data() {
  global $wpdb;

  $used_campaigns = $wpdb->get_col("
    SELECT DISTINCT(campaign)
    FROM {$wpdb->prefix}runway_stripe_data
    WHERE campaign != ''
    ORDER BY campaign"
  );

  array_unshift($used_campaigns, 'All campaigns', 'No campaign');
  $make_list_item = function($campaign) {
    return array('name' => $campaign);
  };

  runway_stripe_select_list_from_request('campaign', array_map($make_list_item, $used_campaigns));
}

function runway_stripe_campaigns_for_account($accountId, $isLinkedToSalesforce) {
  global $wpdb;

  if($isLinkedToSalesforce) {
    return $wpdb->get_col("
      SELECT name
      FROM {$wpdb->prefix}runway_stripe_salesforce_campaigns
      ORDER BY name"
    );
  } else {
    return $wpdb->get_col("
      SELECT DISTINCT campaign
      FROM {$wpdb->prefix}runway_stripe_data
      WHERE account_id = {$accountId}
      AND campaign IS NOT NULL
      AND campaign <> ''
      ORDER BY campaign;"
    );
  }
}

function runway_stripe_account_name($account, $options) {
  $name = $options["account_{$account}_name"];
  return $name ? $name : "Account $account";
}

function runway_stripe_download_tool_init() {
  if ( !current_user_can( 'manage_donors' ) )  {
    wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
  }

  global $runway_stripe_account_count;
  global $wpdb;

  $options = get_option('runway_stripe_options');

  $data = null;
  if(isset($_POST['action']) && $_POST['action'] === 'Search') {
    $wpdb->show_errors();
    $data = runway_stripe_fetch_data($options);
    $wpdb->hide_errors();
  }
  ?>
  <style type="text/css">
    .runway-stripe-data-table td {
      vertical-align: middle;
    }
    .runway-stripe-data-table td input[type='button'] {
      margin-right: 5px;
    }
    .runway-stripe-data-table td input[type='button'] + span {
      display: inline-block;
      padding-top: 5px;
    }
  </style>
  <div class="wrap">
    <h2>Runway Stripe Data Download</h2>
    <form id="runway-stripe-download-data" method="post" action="">
      <table class="form-table">
        <tr>
          <th>
            Stripe account
          </th>
          <td>
            <?php
            $accounts = array();
            for($account = 1; $account <= $runway_stripe_account_count; $account++) {
              $accounts[] = array('value' => $account, 'name' => runway_stripe_account_name($account, $options));
            }
            runway_stripe_select_list_from_request('stripe_account', $accounts);
            ?>
          </td>
        </tr>
        <tr>
          <th>
            Campaign
          </th>
          <td>
            <?php
            runway_stripe_campaigns_list_from_actual_data();
            ?>
          </td>
        </tr>
        <tr>
          <th>
            Transactions included
          </th>
          <td>
            <?php
            runway_stripe_checkbox('Refunds', 'include_refunds', true);
            runway_stripe_checkbox('Payments', 'include_payments', true);
            ?>
            <p class="description">Only successful payments are included</p>
          </td>
        </tr>
        <tr>
          <th>
            Givers included
          </th>
          <td>
            <?php
            runway_stripe_checkbox('One-off', 'include_one_offs', true);
            runway_stripe_checkbox('Recurring', 'include_recurring', true);
            ?>
          </td>
        </tr>
        <tr>
          <th>
            Aggregation
          </th>
          <td>
            <?php
            runway_stripe_checkbox('Group by giver and campaign', 'group_by_giver_and_campaign', false);
            ?>
          </td>
        </tr>
        <tr>
          <th>
            Date range
          </th>
          <td>
            <p>
              <?php
              runway_stripe_datebox('From', 'date_range_start', strtotime("first day of last month"));
              runway_stripe_datebox('to', 'date_range_end', strtotime("last day of last month"));
              ?>
            </p>
            <p class="description">
              Transactions on both dates are included.
            </p>
          </td>
        </tr>
        <tr>
          <th>
            Date behaviour
          </th>
          <td>
            <?php
            runway_stripe_radio('Transactions remitted within this date range', 'date_type', 'remitted', true);
            runway_stripe_radio('Transactions completed within this date range', 'date_type', 'completed', false);
            ?>
          </td>
        </tr>
      </table>
      <p class="submit">
        <input type="submit" name="action" class="button button-primary" value="Search">
        <input type="button" name="action" id="download" class="button" value="Download">
      </p>
    </form>
    <?php if ($data) { ?>
      <table class="wp-list-table widefat runway-stripe-data-table">
        <thead>
          <?php runway_stripe_print_headers($data); ?>
        </thead>
        <tfoot>
          <?php runway_stripe_print_headers($data); ?>
        </tfoot>
        <tbody id="the-list">
          <?php runway_stripe_print_body($data); ?>
        </tbody>
      </table>
    <?php } elseif (is_array($data)) { ?>
      <div class="error">
        <p>
          No transactions were found with the filter you specified.
        </p>
      </div>
    <?php } ?>
  </div>
  <?
}

function runway_stripe_add_donor_init() {
  if ( !current_user_can( 'manage_donors' ) )  {
    wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
  }

  global $runway_stripe_account_count,
    $runway_stripe_available_currencies;

  $options = get_option('runway_stripe_options');

  $account_details = array();
  for($account = 1; $account <= $runway_stripe_account_count; $account++) {
    $isLinkedToSalesforce = $options["salesforce_stripe_account"] == $account;
    $account_details[$account] = array(
      'value' => $account,
      'name' => runway_stripe_account_name($account, $options),
      'key' => $options["account_{$account}_publishable_key"],
      'currency' => $options["account_{$account}_currency"],
      'linked_to_salesforce' => $isLinkedToSalesforce,
      'campaigns'=> runway_stripe_campaigns_for_account($account, $isLinkedToSalesforce)
    );
  }

  $cancel_url = remove_query_arg(array('message', 'error_message'));

  global $runway_stripe_available_currencies;
  $currency_options = array_map(function ($c) { return array('name' => $c); }, $runway_stripe_available_currencies);

  ?>
  <style type="text/css">
    .form-table td label + label {
      margin-left: 20px;
    }
    #currency_warning {
      color: rgba(255, 0, 0, 0.7);
    }
    #currency_warning .dashicons-warning {
      vertical-align: bottom;
    }
    input[name="campaign"] {
      display: block;
      margin-top: 5px;
    }
  </style>
  <script src="https://checkout.stripe.com/checkout.js"></script>
  <script type="text/javascript">
    jQuery(function ($) {

      var accounts = <?php echo json_encode($account_details); ?>;

      // From http://stackoverflow.com/a/5158301/152347
      function getParameterByName(name) {
        var match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);
        return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
      }

      function refreshElementDisplay(updateCampaigns) {
        var $accounts = $("select[name='account']");
        var $currencies = $("select[name='currency']");
        var $campaigns = $("#campaigns");

        var selectedAccount = accounts[$accounts.val()];

        if(updateCampaigns) {
          updateCampaignList(selectedAccount);
        }
        $("#currency_warning").toggle(selectedAccount.currency !== $currencies.val());
        $("#salesforce_campaign_message").toggle(selectedAccount.linked_to_salesforce);
        $("input[name='campaign']").toggle($campaigns.val() === "(Other)");
      }

      function updateCampaignList(account) {
        var $campaigns = $("#campaigns");
        var currentlySelected = $campaigns.val();

        $campaigns.empty();
        $campaigns.append($("<option>", { value: "", html: "(None)" }));
        $(account.campaigns).each(function(i, v){
            $campaigns.append($("<option>", { value: v, html: v }));
        });
        if(!account.linked_to_salesforce) {
          $campaigns.append($("<option>", { value: "(Other)", html: "(Other)" }));
        }

        // Try selecting what was picked previously.
        $campaigns.val(currentlySelected);
        // If that value wasn't there then revert to (None).
        if($campaigns.val() === null) {
          $campaigns.val('');
        }
        $("#campaigns").change(); // This doesn't trigger automatically.
      }

      function setCampaignFromQueryString() {
        var selectedCampaign = getParameterByName('campaign');
        if(selectedCampaign) {
          var optionExists = !!$("#campaigns option").filter(function (i, o) { return o.value === selectedCampaign; }).length;
          if(optionExists) {
            $("#campaigns").val(selectedCampaign);
            $("#campaigns").change(); // This doesn't trigger automatically.
          } else {
            $("#campaigns").val('(Other)');
            $("#campaigns").change(); // This doesn't trigger automatically.
            $("input[name='campaign']").val(selectedCampaign);
          }
        }
      }

      $("#donation_amount").change(function () {
        var amount = parseInt($(this).val(), 10);
        $(this).val(amount);
      });

      $("select[name='account']").change(function () {
        var account = accounts[$(this).val()];
        $("select[name='currency']").val(account.currency || 'USD');
        refreshElementDisplay(true);
      });

      $("select[name='currency']").change(function () {
        refreshElementDisplay(false);
      });

      $("#campaigns").change(function () {
        var newValue = $(this).val();

        if(newValue === "(Other)") {
          newValue = '';
        }

        $("input[name='campaign']").val(newValue);
        refreshElementDisplay(false);
      });
      refreshElementDisplay(true);
      setCampaignFromQueryString();

      var checkoutHandler = StripeCheckout.configure({
        name: <?php echo json_encode(get_bloginfo('name')); ?>,
        allowRememberMe: false,
        address: true,
        image: <? echo json_encode($options['image_url']); ?>,
        token: function(token) {
          $("#email").val(token.email);
          $("#stripeToken").val(token.id);
          $("#return_url").val(<?php echo json_encode($cancel_url); ?> + '&' + $.param({
            account: $("select[name='account']").val(),
            currency: $("select[name='currency']").val(),
            campaign: $("input[name='campaign']").val(),
            message: 'Donor added successfully'
          }));
          $("#stripe_donate").attr('disabled', true);
          document.forms["donation"].submit();
        }
      });

      $("#stripe_donate").click(function (e) {
        var amount = parseInt($("#donation_amount").val(), 10);
        var account = accounts[$("select[name='account']").val()];
        var currency = $("select[name='currency']").val();
        var monthly = $("input[name='monthly'][value='true']").is(":checked");

        // Open Checkout with further options
        checkoutHandler.open({
          key: account.key,
          description: monthly ? "Monthly donation" : "One-off donation",
          amount: amount * 100,
          currency: currency,
          panelLabel: monthly ? "Donate {{amount}} monthly" : "Donate {{amount}}"
        });

        e.preventDefault();
      });
    });
  </script>
  <div class="wrap">
    <h2>Runway Stripe - Add Donor Manually</h2>

    <?php if(isset($_GET['message'])) { ?>
      <div class="updated">
        <p><?php echo $_GET['message']; ?></p>
      </div>
    <?php } ?>
    <?php if(isset($_GET['error_message'])) { ?>
      <div class="error">
        <p><?php echo $_GET['error_message']; ?></p>
      </div>
    <?php } ?>

    <form id="donation" method="post" action="<?php echo plugins_url('take-payment.php', __FILE__); ?>">
      <table class="form-table">
        <tr>
          <th>
            Stripe account
          </th>
          <td>
            <?php runway_stripe_select_list_from_request('account', $account_details); ?>
          </td>
        </tr>
        <tr>
          <th>
            Amount
          </th>
          <td>
            <input type="number" step="any" min="1" required="required" id="donation_amount" name="donation_amount" value="18" class="regular-text" />
          </td>
        </tr>
        <tr>
          <th>
            Currency
          </th>
          <td>
            <?php runway_stripe_select_list_from_request('currency', $currency_options, $options["account_1_currency"]); ?>
            <p id="currency_warning" class="description" style="display: none;">
              <span class="dashicons dashicons-warning"></span>
              This isn't the default currency for this Stripe account so any payments will incur a currency conversion charge.
            </p>
          </td>
        </tr>
        <tr>
          <th>
            Campaign
          </th>
          <td>
            <select id="campaigns"></select>
            <input type="text" name="campaign" class="regular-text" />
            <p id="salesforce_campaign_message" class="description">
              Campaign not here?
              Only campaigns that are marked as "In Progress" in Salesforce appear here.
              Campaigns linked to Classy are also excluded.
              After updating a campaign in Salesforce you may have to wait an hour before it appears here.
            </p>
          </td>
        </tr>
        <tr>
          <th>
            Monthly
          </th>
          <td>
            <label>
              <input type="radio" name="monthly" value="true" checked="checked" />
              Yes
            </label>
            <label>
              <input type="radio" name="monthly" value="false" />
              No
            </label>
          </td>
        </tr>
        <tr>
          <th>
            Phone number
          </th>
          <td>
            <input type="text" id="phone_number" name="phone_number" class="regular-text" />
          </td>
        </tr>
        <tr>
          <th>
            <label for="email_opt_out">
              Opt out of emails
            </label>
          </th>
          <td>
            <input type="checkbox" id="email_opt_out" name="email_opt_out" />
          </td>
        </tr>
      </table>
      <input type="hidden" id="email" name="email" />
      <input type="hidden" id="stripeToken" name="stripeToken" />
      <input type="hidden" id="return_url" name="return_url" />
      <input type="hidden" id="cancel_url" name="cancel_url" value="<?php echo $cancel_url; ?>" />
      <input type="hidden" id="_wpnonce" name="_wpnonce" value="<?php echo wp_create_nonce('runway-stripe-donate_take-payment'); ?>" />

      <p class="submit">
        <input type="submit" id="stripe_donate" name="action" class="button button-primary" value="Add donor">
      </p>
    </form>
  </div>
  <?php
}
