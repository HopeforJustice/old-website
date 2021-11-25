<?php

function runway_stripe_install_roles() {
  remove_role('donor_adder');
  add_role('donor_adder', 'Donor Admin', array(
    'manage_donors' => true,
    'read' => true // Allows access to the admin area
  ));

  $administrator = get_role('administrator');
  $administrator->add_cap('manage_donors');
}

function runway_stripe_uninstall_roles() {
  remove_role('donor_adder');

  $administrator = get_role('administrator');
  $administrator->remove_cap('manage_donors');
  $administrator->remove_cap('add_donors'); // From a previous version of the plugin
}
