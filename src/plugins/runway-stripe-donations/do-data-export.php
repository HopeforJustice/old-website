<?php

require_once(__DIR__.'/util.php');

runway_stripe_load_wordpress_core();

$options = get_option('runway_stripe_options');

$data = runway_stripe_fetch_data($options);
$filename = "Donation data {$_POST['date_range_start']} - {$_POST['date_range_end']}.csv";

header('Content-Type: application/csv');
header('Content-Disposition: attachment; filename="'.$filename.'";');

$f = fopen('php://output', 'w');

// Headers first
fputcsv($f, array_keys($data[0]));

foreach ($data as $line) {
  fputcsv($f, $line);
}
